
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo e(route('dashboard')); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>H</b>M</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>  <?php echo e(env('APP_NAME')); ?> </b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">


                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo e(asset('storage/users/'.auth()->user()->photo)); ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo e(ucwords(auth()->user()->name)); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo e(asset('storage/users/'.auth()->user()->photo)); ?>" class="img-circle" alt="User Image">
                            <p>
                               <?php echo e(auth()->user()->name); ?>

                                <span class="fa fa-user"></span>
                                <?php echo e(auth()->user()->roles[0]->description); ?>

                                <small>تم انشاء الحساب بتاريخ <?php echo e(auth()->user()->created_at->format('d - m - Y')); ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="<?php echo e(route('profile')); ?>" class="btn btn-default btn-flat">حسابي</a>
                            </div>
                            <div class="pull-left pull-right-en ">
                                <a href="<?php echo e(route('logout')); ?>" class="btn btn-default btn-flat"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                >تسجيل الخروج</a>
                            </div>

                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li style="display: none">
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<?php /**PATH /media/el-sheref/Private/cv-works/gareda/resources/views/dashboard/layouts/includes/navbar.blade.php ENDPATH**/ ?>