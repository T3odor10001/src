<?php echo $__env->make('common.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $from = filter_input(INPUT_GET, 'from', FILTER_SANITIZE_URL);
    $to = filter_input(INPUT_GET, 'to', FILTER_SANITIZE_URL);      
?>

<div class="flex-between">
    <div class="main_info">
        <a href=<?php echo e(route('home')); ?> class="return_home"><i class="bi bi-chevron-left"></i> Späť na prehľad</a>
        <h1><?php echo e($account_title); ?></h1>
        <label for="sap-id-detail"><b>SAP ID:</b></label>
        <p id="sap-id-detail"><?php echo e($account->sap_id); ?></p>
    </div>
    <div class="switch-box">
        <p>Výpis účtu</p>
        <label class="switch">
            <input data-account-id="<?php echo e($account->id); ?>" class="toggle-button" type="checkbox">
            <span class="slider round"></span>
        </label>
        <p>SAP</p>
    </div>
</div>

<div class="filter-box">
    
    <div>

        <label>Od:</label><input type="date" id="filter-operations-from" value="<?php echo $from ?>"></input>
        <label>Do:</label><input type="date" id="filter-operations-to" value="<?php echo $to ?>"></input>
        <button type="button" data-account-id="<?php echo e($account->id); ?>" data-date-errors="<?php echo e($errors->first('to')); ?>" id="filter-operations">Filtrovať</button>
        <button data-account-id="<?php echo e($account->id); ?>" type="button" id="operations-export">Exportovať</button>
    </div>

    <div>
        <button data-account-id="<?php echo e($account->id); ?>" data-csrf="<?php echo e(csrf_token()); ?>" id="create_operation" type="button" title="Nová operácia">+</i></button>
    </div>
</div>

<?php if($errors->has('to')): ?>
    <div class="error-div" style="width: 70%; margin: 0px 0px 0px 50px">
        <p style="color:red"><?php echo e($errors->first('to')); ?></p>
    </div>
<?php endif; ?>

<table>
    <tr>
        <th>Poradie</th>
        <th>Názov</th>
        <th>Dátum</th>
        <th>Typ</th>
        <th class="w-100">Skontrolované</th>
        <th class="align-right">Suma</th>
        <th></th>
    </tr>

    <?php $__currentLoopData = $operations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$operation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
        <tr>
            <td><?php echo e(($operations->currentPage() - 1) * $operations->perPage() + $key + 1); ?>.</td>
            <td><?php echo e($operation->title); ?></td>
            <td><?php echo e($operation->date->format('d.m.Y')); ?></td>
            <td><?php echo e($operation->operationType->name); ?></td>
            <?php if( $operation->isLending() ): ?> 
                <td>-</td>
            <?php elseif( $operation->checked ): ?>
                <td>Áno</td>
            <?php else: ?>
                <td>Nie</td>
            <?php endif; ?>
            <?php if( $operation->isExpense()): ?>
                <td class="align-right" style="color: red;">-<?php echo e($operation->sum); ?>€</td>
            <?php else: ?>
                <td class="align-right" style="color: green;"><?php echo e($operation->sum); ?>€</td>
            <?php endif; ?>
            <td>
                <button type="button" data-operation-id="<?php echo e($operation->id); ?>" class="operation-detail"><i  class="bi bi-info-circle" title="Detail operácie"></i></button>
                <?php if( $operation->isRepayment() ): ?>
                    <button type="button" data-operation-id="<?php echo e($operation->id); ?>" class="operation-delete"><i class="bi bi-trash3" title="Zmazať operáciu"></i>
                <?php elseif( $operation->isLending() ): ?>
                    <button type="button" data-operation-id="<?php echo e($operation->id); ?>" data-csrf="<?php echo e(csrf_token()); ?>" class="operation-edit"><i class="bi bi-pencil" title="Upraviť operáciu"></i>
                    <?php if(! $operation->lending->repayment): ?>
                        <button type="button" data-operation-id="<?php echo e($operation->id); ?>" data-csrf="<?php echo e(csrf_token()); ?>" class="operation-repayment"><i class="bi bi-cash-coin" title="Splatiť pôžičku"></i>
                    <?php endif; ?>
                  <button type="button" data-operation-id="<?php echo e($operation->id); ?>" class="operation-delete"><i class="bi bi-trash3" title="Zmazať operáciu"></i>
                <?php else: ?>
                    <button type="button" data-operation-id="<?php echo e($operation->id); ?>" data-csrf="<?php echo e(csrf_token()); ?>" class="operation-edit"><i class="bi bi-pencil" title="Upraviť operáciu"></i>
                    <button type="button" data-operation-id="<?php echo e($operation->id); ?>" data-operation-checked="<?php echo e($operation->checked); ?>" class="operation-check"><i  class="bi bi-check2-all" title="Označiť/Odznačiť operáciu"></i>
                    <button type="button" data-operation-id="<?php echo e($operation->id); ?>" class="operation-delete"><i class="bi bi-trash3" title="Zmazať operáciu"></i>
                <?php endif; ?>
            </td>
        </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>

<div class="table-sum">
    <div class="pagination"> <?php echo e($operations->links("pagination::semantic-ui")); ?> </div>

    <p id="income">Príjmy: <em><?php echo e($incomes_total); ?>€</em></p>
    <p id="outcome">Výdavky: <em><?php echo e($expenses_total); ?>€</em></p>
    <?php if( ($incomes_total - $expenses_total) >= 0): ?>
        <p id="total">Rozdiel: <em style="color: green;"><?php echo e($incomes_total - $expenses_total); ?>€</em></p>
    <?php else: ?>
        <p id="total">Rozdiel: <em style="color: red;"><?php echo e($incomes_total - $expenses_total); ?>€</em></p>
    <?php endif; ?>
    <p id="account-balance">Celkový zostatok na účte: <em><?php echo e($account_balance); ?>€</em></p>
</div>


<?php echo $__env->make('common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\teodo\personalaccount\src\resources\views/finances/account.blade.php ENDPATH**/ ?>