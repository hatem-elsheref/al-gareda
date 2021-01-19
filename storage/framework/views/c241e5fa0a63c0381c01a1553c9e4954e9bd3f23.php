<?php $__env->startSection('content'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                ادارة الكتاب
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('dashboard')); ?>"><i class="fa fa-dashboard"></i>
                        لوحة التحكم
                    </a></li>
                <li class="active"><a href="<?php echo e(route('authors.index')); ?>">
                        الكتاب
                    </a></li>
                <li class="active">
                    اضافة كاتب جديد
                </li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- Form column -->
                <div class="col-md-12">

                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                اضافة كاتب جديد
                            </h3>
                        </div><!-- /.box-header -->
                    <?php echo $__env->make('dashboard.layouts.includes.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!-- form start -->
                        <form role="form" method="post" action="<?php echo e(route('authors.store')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">الاسم</label>
                                    <input type="text" class="form-control" name="name" placeholder="ادخل الاسم" value="<?php echo e(old('name')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="name">الوصف</label>
                                    <input type="text" class="form-control" name="description" placeholder="ادخل وصف الكاتب" value="<?php echo e(old('description')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="photo">الصورة الشخصيه</label>
                                    <input type="file" class="form-control" name="photo" id="photo">
                                </div>
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> حفظ</button>
                            </div>
                        </form>
                    </div><!-- /.box -->
                </div><!--/.col (Form) -->
            </div>   <!-- /.row -->
        </section><!-- /.content -->


<?php $__env->stopSection(); ?>





<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/el-sheref/Private/cv-works/gareda/resources/views/dashboard/authors/create.blade.php ENDPATH**/ ?>