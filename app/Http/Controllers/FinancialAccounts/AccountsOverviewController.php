<?php

namespace App\Http\Controllers\FinancialAccounts;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

/**
 * Manages the 'financial accounts' view.
 */
class AccountsOverviewController extends Controller
{
    /**
     * Fills the 'accounts overview' view with a list of accounts belonging to the current user
     *
     * @return Application|Factory|View
     * the view filled with data
     */
    public function show()
    {
        return view('finances.index', [
            'accounts' => Auth::user()->accounts
        ]);
    }

}
