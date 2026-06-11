<?php if($paginator->hasPages()): ?>
<nav style="display:flex;justify-content:center;gap:6px;margin-top:24px;flex-wrap:wrap;">
    
    <?php if($paginator->onFirstPage()): ?>
        <span style="padding:7px 14px;background:var(--dark-lighter);border:1px solid var(--glass-border);color:rgba(245,234,213,.3);font-size:13px;">‹</span>
    <?php else: ?>
        <a href="<?php echo e($paginator->previousPageUrl()); ?>" style="padding:7px 14px;background:var(--dark-lighter);border:1px solid var(--glass-border);color:var(--cream);font-size:13px;text-decoration:none;">‹</a>
    <?php endif; ?>

    
    <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(is_string($element)): ?>
            <span style="padding:7px 14px;background:var(--dark-lighter);border:1px solid var(--glass-border);color:var(--cream-semi);font-size:13px;"><?php echo e($element); ?></span>
        <?php endif; ?>
        <?php if(is_array($element)): ?>
            <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($page == $paginator->currentPage()): ?>
                    <span style="padding:7px 14px;background:var(--dark-lighter);border:1px solid #c9a84c;color:#c9a84c;font-size:13px;"><?php echo e($page); ?></span>
                <?php else: ?>
                    <a href="<?php echo e($url); ?>" style="padding:7px 14px;background:var(--dark-lighter);border:1px solid var(--glass-border);color:var(--cream);font-size:13px;text-decoration:none;"><?php echo e($page); ?></a>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <?php if($paginator->hasMorePages()): ?>
        <a href="<?php echo e($paginator->nextPageUrl()); ?>" style="padding:7px 14px;background:var(--dark-lighter);border:1px solid var(--glass-border);color:var(--cream);font-size:13px;text-decoration:none;">›</a>
    <?php else: ?>
        <span style="padding:7px 14px;background:var(--dark-lighter);border:1px solid var(--glass-border);color:rgba(245,234,213,.3);font-size:13px;">›</span>
    <?php endif; ?>
</nav>
<?php endif; ?>
<?php /**PATH C:\laragon\www\RasaNusantara\resources\views/vendor/pagination/bootstrap-5.blade.php ENDPATH**/ ?>