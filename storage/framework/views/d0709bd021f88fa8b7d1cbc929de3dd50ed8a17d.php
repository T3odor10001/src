<?php echo $__env->make('common.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $from = filter_input(INPUT_GET, 'from', FILTER_SANITIZE_URL);
    $to = filter_input(INPUT_GET, 'to', FILTER_SANITIZE_URL);
?>

<div class="flex-between">
    <div class="main_info">
        <a href=<?php echo e(route('home')); ?> class="return_home"><i class="bi bi-chevron-left"></i> Späť na prehľad</a>
        <h1><?php echo e($account_title); ?></h1>
        <label for="sap-id-detail-sap"><b>SAP ID:</b></label>
        <p id="sap-id-detail-sap"><?php echo e($account->sap_id); ?></p>    </div>
    <div class="switch-box">
        <p>Výpis účtu</p>
        <label class="switch">
            <input data-account-id="<?php echo e($account->id); ?>" class="toggle-button" checked="true" type="checkbox">
            <span class="slider round"></span>
        </label>
        <p>SAP</p>
    </div>
</div>

<div class="filter-box">
    <div>
        <label>Od:</label><input type="date" id="filter-reports-from" value="<?php echo $from ?>"></input>
        <label>Do:</label><input type="date" id="filter-reports-to" value="<?php echo $to ?>"></input>
        <button data-account-id="<?php echo e($account->id); ?>" type="button" id="reports-filter">Filtrovať</button>
    </div>

    <div>

        <button data-account-id="<?php echo e($account->id); ?>" id="add-sap-report" type="button" title="Nový výkaz">Nový výkaz</button>

    </div>

</div>
<table>
    <tr>
        <th>Poradie</th>
        <th>Dátum exportu / nahratia</th>
        <th>Typ súboru</th>
        <th></th>
    </tr>

    <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(\Illuminate\Support\Str::endsWith($report->path, '.txt')): ?>
            <tr class="sap-row">
                <td><?php echo e($key + 1); ?>.</td>
                <td><?php echo e($report->exported_or_uploaded_on->format('d.m.Y')); ?></td>
                <td><?php echo e(pathinfo($report->path, PATHINFO_EXTENSION)); ?></td>
                <td class="sap-icons">
                    <a href="<?php echo e(route('sap-report-raw', [ $report->id ])); ?>"><i class="bi bi-download" title="Stiahnuť výkaz"></i></a>
                    <button type="button" data-report-id="<?php echo e($report->id); ?>" class="report-delete"><i  class="bi bi-trash3" title="Zmazať výkaz"></i></button>
                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</table>

<div class="filter-box1">
    <div></div>
<div>
    <button data-account-id="<?php echo e($account->id); ?>" id="add-excel-report" type="button" title="Nový Excel">Nový Excel</button>

</div>
</div>
<table>
    <tr>
        <th>Poradie</th>
        <th>Dátum exportu / nahratia</th>
        <th>Typ súboru</th>
        <th></th>
    </tr>

    <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(\Illuminate\Support\Str::endsWith($report->path, ['.xls', '.xlsx'])): ?>
            <tr class="sap-row">
                <td><?php echo e($key + 1); ?>.</td>
                <td><?php echo e($report->exported_or_uploaded_on->format('d.m.Y')); ?></td>
                <td><?php echo e(pathinfo($report->path, PATHINFO_EXTENSION)); ?></td>
                <td class="sap-icons">
                    <a href="<?php echo e(route('sap-report-raw', [ $report->id ])); ?>"><i class="bi bi-download" title="Stiahnuť výkaz"></i></a>
                    <button type="button" data-report-id="<?php echo e($report->id); ?>" class="report-delete"><i  class="bi bi-trash3" title="Zmazať výkaz"></i></button>
                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</table>


<div class="pagination"> <?php echo e($reports->links("pagination::semantic-ui")); ?> </div>



<?php echo $__env->make('common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\teodo\personalaccount\src\resources\views/finances/sap_reports.blade.php ENDPATH**/ ?>