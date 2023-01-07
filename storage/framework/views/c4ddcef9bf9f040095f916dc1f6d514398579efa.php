<nav class="main-sidebar ps-menu">
    <div class="sidebar-toggle action-toggle">
        <a href="#">
            <i class="fas fa-bars"></i>
        </a>
    </div>
    <div class="sidebar-opener action-toggle">
        <a href="#">
            <i class="ti-angle-right"></i>
        </a>
    </div>
    <div class="sidebar-header">
        <div class="text">E-Sakit</div>
        <div class="close-sidebar action-toggle">
            <i class="ti-close"></i>
        </div>
    </div>
    <div class="sidebar-content">
        <ul>
            <li class="<?php echo e(request()->segment(1) == 'dashboard' ? 'active' : ''); ?>">
                <a href="<?php echo e(route('dashboard')); ?>" class="link">
                    <i class="ti-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <?php $__currentLoopData = getMainMenu(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read '. $menu->url)): ?>
                <li class="<?php echo e(request()->segment(1) == $menu->url ? 'active' : ''); ?>">
                    <a href="#" class="main-menu has-dropdown">
                        <i class="<?php echo e($menu->icon); ?>"></i>
                        <span><?php echo e($menu->name); ?></span>
                    </a>
                    <ul class="sub-menu <?php echo e(request()->segment(1) == $menu->url ? 'expands' : ''); ?>">
                        <?php $__currentLoopData = $menu->subMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read '. $submenu->url)): ?>
                                <li class="<?php echo e(request()->segment(1) == explode('/', $submenu->url)[0] && request()->segment(2) == explode('/',$submenu->url)[1] ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url($submenu->url)); ?>" class="link"><span><?php echo e($submenu->name); ?></span></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</nav>
<?php /**PATH C:\project\php\e-hospital\resources\views/panels/navbar.blade.php ENDPATH**/ ?>