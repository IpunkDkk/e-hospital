<header class="header-navbar fixed">
    <div class="toggle-mobile action-toggle"><i class="fas fa-bars"></i></div>
    <div class="header-wrapper">
        <div class="header-left">
            <div class="theme-switch-icon"></div>
        </div>
        <div class="header-content">
            <div class="dropdown dropdown-menu-end">
                <a href="#" class="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="label">
                        <span></span>
                        <div><?php echo e(auth()->guard('web')->user()->profile->name); ?> <br> <?php echo e(auth()->guard('web')->user()->getRoleNames()->first()); ?></div>
                    </div>
                    <img class="img-user" src="<?php echo e(asset('')); ?>assets/images/profile/<?php echo e(auth()->guard('web')->user()->profile->photo); ?>" alt="user"srcset="">
                </a>
                <ul class="dropdown-menu small">
                    <li class="menu-content ps-menu">
                        <a href="#">
                            <div class="description">
                                <i class="ti-user"></i> Profile
                            </div>
                        </a>
                        <a href="#">
                            <div class="description">
                                <i class="ti-settings"></i> Setting
                            </div>
                        </a>
                        <a href="<?php echo e(url('logout')); ?>">
                            <div class="description">
                                <i class="ti-power-off"></i> Logout
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</header>
<?php /**PATH C:\project\php\e-hospital\resources\views/panels/header.blade.php ENDPATH**/ ?>