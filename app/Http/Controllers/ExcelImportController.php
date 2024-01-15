<?php

namespace App\Http\Controllers;

use App\Exceptions\DatabaseException;
use App\Exceptions\FileFormatException;
use App\Exceptions\StorageException;
use App\Http\Helpers\DBTransaction;
use App\Http\Helpers\SapReportParser;
use App\Imports\UsersImport;
use App\Models\SapReport;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Account;
use Maatwebsite\Excel\Facades\Excel;

// Imports the Account model

class ExcelImportController extends Controller
{
    /**
     * Handle the upload of an Excel file.
     *
     * @param Request $request
     * @param Account $account // Use Account instead of User
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function upload(Request $request, Account $account): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,csv',
        ]);

        $report = $request->file('excel_file');

        try {
            $this->storeFile($report, $account);
        } catch (Exception $e) {

            return response(trans('sap_reports.upload.failed'), 500);
        }

        return response(trans('sap_reports.upload.success'), 201);
    }

    /**
     * Store the uploaded file in storage in an account-specific directory.
     *
     * @param UploadedFile $file
     * @param Account $account // Use Account instead of User
     * @throws Exception
     */
    private function storeFile(UploadedFile $file, Account $account): void
    {
        $accountOwner = $account->user->first();
        $reportPath = $this->saveReportFileToUserStorage($accountOwner, $file);

        $absoluteReportPath = Storage::path($reportPath);
        $exportedOrUploadedOn = $this->getDateExportedOrToday($absoluteReportPath);

        // Process the Excel file
        Excel::import(new UsersImport, $file);

        $createRecordTransaction = new DBTransaction(
            fn () => $this->createReportRecord($account, $reportPath),
            fn () => Storage::delete($reportPath)
        );

        $createRecordTransaction->run();
    }
    private function saveReportFileToUserStorage(User $user, UploadedFile $report): string
    {
        $reportsDirectoryPath = SapReport::getReportsDirectoryPath($user);
        $reportPath = Storage::putFile($reportsDirectoryPath, $report);

        if (!$reportPath) {
            throw new StorageException('File not saved.');
        }

        return $reportPath;
    }

    private function createReportRecord(Account $account, string $reportPath): void
    {
        $absoluteReportPath = Storage::path($reportPath);
        $exportedOrUploadedOn = $this->getDateExportedOrToday($absoluteReportPath);

        $report = $account->sapReports()->create([
            'path' => $reportPath,
            'exported_or_uploaded_on' => $exportedOrUploadedOn,
        ]);

        if (!$report->exists) {
            throw new DatabaseException('Record not saved.');
        }
    }

    private function getDateExportedOrToday(string $reportPath): \Illuminate\Support\Carbon|\Carbon\Traits\Creator
    {

        return now();

    }

    /**
     * Process the parsed data from the Excel file.
     *
     * @param array $data
     * @return void
     */
    private function processData(array $data)
    {
        // Implement the logic to process and save the data to the database
        // This could involve iterating over the data array and saving each row to the database
    }
}
