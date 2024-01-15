<?php if($paginator->hasPages()): ?>
    <ul class="pagination">
        <?php if($paginator->onFirstPage()): ?>
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1"></a>
            </li>
        <?php else: ?>
            <li class="page-item"><a class="page-link" href="<?php echo e($paginator->previousPageUrl()); ?>"><?php echo trans('pagination.previous'); ?></a></li>
        <?php endif; ?>
      
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(is_string($element)): ?>
                <li class="page-item disabled"><?php echo e($element); ?></li>
            <?php endif; ?>

            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <li class="page-item active">
                            <a class="page-link"><?php echo e($page); ?></a>
                        </li>
                    <?php else: ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        <?php if($paginator->hasMorePages()): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next"><?php echo trans('pagination.next'); ?></a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <a class="page-link" href="#"></a>
            </li>
        <?php endif; ?>
    </ul>
<?php endif; ?><?php /**PATH C:\Users\teodo\personalaccount\src\resources\views/vendor/pagination/semantic-ui.blade.php ENDPATH**/ ?>