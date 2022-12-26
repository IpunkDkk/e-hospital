<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Dashboard </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
          integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
          crossorigin="anonymous" />
    <link rel = "icon" href ="<?php echo e(asset('assets/images/e-rumah-sakit.png')); ?>" type = "image/x-icon">

    <link rel="stylesheet" href="<?php echo e(asset('')); ?>vendor/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>vendor/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>vendor/perfect-scrollbar/css/perfect-scrollbar.css">

    <!-- CSS for this page only -->
    <?php echo $__env->yieldPushContent('css'); ?>
    <!-- End CSS  -->

    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/css/style.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/css/bootstrap-override.min.css">
    <link rel="stylesheet" id="theme-color" href="<?php echo e(asset('')); ?>assets/css/dark.min.css">
</head>

<body>
<div id="app">
    <div class="shadow-header"></div>
    <?php echo $__env->make('panels.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('panels.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('panels.setting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <footer>
        Copyright © 2022 &nbsp Making With &hearts; by Agung . All rights Reserved</span>
    </footer>
    <div class="overlay action-toggle">
    </div>
</div>
<script src="<?php echo e(asset('')); ?>vendor/bootstrap/dist/js/bootstrap.bundle.js"></script>
<script src="<?php echo e(asset('')); ?>vendor/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>

<!-- js for this page only -->
<?php echo $__env->yieldPushContent('js'); ?>
<!-- ======= -->
<script src="<?php echo e(asset('')); ?>assets/js/main.js"></script>
<script>
    Main.init()
</script>
</body>

</html>
<?php /**PATH C:\project\php\e-hospital\resources\views/panels/master.blade.php ENDPATH**/ ?>