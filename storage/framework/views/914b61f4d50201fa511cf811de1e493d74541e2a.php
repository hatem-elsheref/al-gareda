<?php $__env->startSection('content'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                حسابي
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('dashboard')); ?>"><i class="fa fa-dashboard"></i>
                        لوحة التحكم
                    </a></li>
                <li class="active"><a href="<?php echo e(route('users.index')); ?>">
                        المشرفين
                    </a></li>
                <li class="active">
                    تعديل بياناتى الشخصيه
                </li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- Form column -->
                <div class="col-md-12">

                    <!-- general form elements -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                بياناتى
                            </h3>
                        </div><!-- /.box-header -->
                    <?php echo $__env->make('dashboard.layouts.includes.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!-- form start -->
                        <form role="form" method="post" action="<?php echo e(route('update.profile')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('put'); ?>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">الاسم</label>
                                    <input type="text" class="form-control" name="name" placeholder="ادخل الاسم" value="<?php echo e($user->name); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">البريد الالكترونى</label>
                                    <input type="email" class="form-control" name="email" placeholder="ادخل البريد الالكترونى" value="<?php echo e($user->email); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="photo">الصورة الشخصيه</label>
                                    <input type="file" class="form-control" name="photo" id="photo">
                                </div>
                                <div class="form-group">
                                    <label for="password">كلمة المرور</label>
                                    <input type="password" class="form-control" name="password" placeholder="ادخل كلمة المرور">
                                </div>
                                <div class="form-group">
                                    <label for="confirmationpassword">تأكيد كلمة المرور</label>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="تأكيد كلمة المرور">
                                </div>

                            </div><!-- /.box-body -->

                            

                            <div class="box-footer">
                                <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> حفظ</button>
                            </div>
                        </form>
                    </div><!-- /.box -->
                </div><!--/.col (Form) -->
            </div>   <!-- /.row -->
        </section><!-- /.content -->


<?php $__env->stopSection(); ?>





<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/el-sheref/Private/cv-works/gareda/resources/views/dashboard/users/profile.blade.php ENDPATH**/ ?>