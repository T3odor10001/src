<!DOCTYPE html>
<html lang="sk">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" type="image/x-icon" href=<?php echo e(asset('images/credit-card-fill.svg')); ?>>
        <link href=<?php echo e(asset('css/main.css')); ?> rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <?php echo $__env->make('common.app_root_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <script src=<?php echo e(asset('js/main.js')); ?> rel="stylesheet"></script>
        <title>BudgetMaster</title>
    </head>
    <body>
        <nav>
            <div>
                <a href=<?php echo e(route('home')); ?>><i class="bi bi-credit-card-fill"></i> BudgetMaster</a>
            </div>
            <div class="dropdown">
                <button class="dropbtn"><?php echo e(Auth::User()->email); ?><i class="bi bi-caret-down-fill"></i></button>
                <div class="dropdown-content">
                    <a class="change-pass">Zmeniť heslo</a>
                    <a class="create-user">Vytvoriť používateľa</a>
                    <form method="POST" action=<?php echo e(route('logout')); ?>>
                        <?php echo csrf_field(); ?>
                        <button type="submit" id="logout-button">Odhlásiť sa</button>
                    </form>
                </div>
            </div>
        </nav>
        <div class="content">

            <?php echo $__env->make('auth.modals.create_user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <?php if(isset($open_change_password)): ?>
            <?php echo $__env->make('user_account_management.modals.change_password', ['open' => $open_change_password], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
            <?php echo $__env->make('user_account_management.modals.change_password', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php echo $__env->make('finances.modals.operation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('finances.modals.create_operation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('finances.modals.edit_operation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('finances.modals.check_operation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('finances.modals.delete_operation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('finances.modals.repayment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->make('finances.modals.add_report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->make('finances.modals.create_account', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('finances.modals.edit_account', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('finances.modals.delete_account', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('finances.modals.delete_report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->make('finances.modals.loader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\teodo\personalaccount\src\resources\views/common/navigation.blade.php ENDPATH**/ ?>