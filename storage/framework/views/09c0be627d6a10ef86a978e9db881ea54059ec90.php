<?php $__env->startSection('content'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                ادارة المشرفين
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('dashboard')); ?>"><i class="fa fa-dashboard"></i>
                        لوحة التحكم
                    </a></li>
                <li class="active"><a href="<?php echo e(route('users.index')); ?>">
                        المشرفين
                    </a></li>
                <li class="active">
                    اضافة مشرف جديد
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
                                اضافة مشرف جديد
                            </h3>
                        </div><!-- /.box-header -->
                    <?php echo $__env->make('dashboard.layouts.includes.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <!-- form start -->
                        <form role="form" method="post" action="<?php echo e(route('users.store')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">الاسم</label>
                                    <input type="text" class="form-control" name="name" placeholder="ادخل الاسم" value="<?php echo e(old('name')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">البريد الالكترونى</label>
                                    <input type="email" class="form-control" name="email" placeholder="ادخل البريد الالكترونى" value="<?php echo e(old('email')); ?>">
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

                                <div class="form-group">
                                    <label for="permissions">الصلاحيات</label>
                                </div>
                            </div><!-- /.box-body -->

                                    

                            <?php
                                $models=[
                                'Users'=>'المشرفين',
                                'Authors'=>'الكتاب',
                                'Departments'=>'الاقسام',
                                'Tags'=>'الكلمات المفتاحية',
                                'NewsPaper'=>'الجرائد',
                                'Articles'=>'المقالات'
                                ];
                                $operations=[
                                'Users'=>['c','r','d','u'],
                                'Authors'=>['c','r','d','u'],
                                'Departments'=>['c','r','d','u'],
                                'Tags'=>['c','r','d','u'],
                                'NewsPaper'=>['c','r','d','u'],
                                'Articles'=>['c','r','d','u'],
                                ];
                                $map=[
                                'c'=>'create',
                                'r'=>'read',
                                'u'=>'update',
                                'd'=>'delete',
                                ];
                               $trans=[
                                'c'=>'اضافة',
                                'r'=>'قراءة',
                                'u'=>'تعديل',
                                'd'=>'حذف',
                                ];

                            ?>
                                <div class="col-md-12">
                                    <div class="nav-tabs-custom" >
                                        <ul class="nav nav-tabs">
                                        <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class=" <?php if($loop->first): ?> active <?php endif; ?> ">
                                                    <a href="#<?php echo e($key); ?>" data-toggle="tab" ><?php echo e($value); ?></a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                        <span class="clearfix"></span>
                                        <div class="tab-content">
                                            <?php $__currentLoopData = $operations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $operation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="tab-pane  <?php if($loop->first): ?> active <?php endif; ?> " id="<?php echo e($key); ?>">
                                                    <div style="margin-right: 0px;padding-right: 0px">
                                                        <div class="row">
                                                            <div class="col-md-12">

                                                                <?php $__currentLoopData = $operation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crud_key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <div class="form-group pull-right" style="margin-left: 10px">
                                                                        <div class="checkbox-inline">
                                                                            <input type="checkbox" id="<?php echo e(strtolower($map[$crud_key].'_'.$key)); ?>$crud_operation.$key}}" value="<?php echo e(strtolower($map[$crud_key].'_'.$key)); ?>" name="permissions[]"
                                                                                <?php echo e((in_array(strtolower($map[$crud_key].'_'.$key),(array)old('permissions')))?'checked':''); ?>>
                                                                            <label for="<?php echo e(strtolower($map[$crud_key].'_'.$key)); ?>">
                                                                                <?php echo e(ucfirst($trans[$crud_key]).' '.$models[$key]); ?>

                                                                            </label>
                                                                    </div>
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div><!-- /.tab-pane -->
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </div><!-- /.tab-content -->
                                    </div>
                            </div><!-- /.col -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> حفظ</button>
                            </div>
                        </form>
                    </div><!-- /.box -->
                </div><!--/.col (Form) -->
            </div>   <!-- /.row -->
        </section><!-- /.content -->


<?php $__env->stopSection(); ?>





<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/el-sheref/Private/cv-works/gareda/resources/views/dashboard/users/create.blade.php ENDPATH**/ ?>