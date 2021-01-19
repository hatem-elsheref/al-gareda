<?php $__env->startSection('content'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                الاقسام
                <small>
                    <span class="badge btn-danger btn-sm"><?php echo e(count($departments)); ?></span>
                </small>

            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('dashboard')); ?>"><i class="fa fa-dashboard"></i> اللوحة الرئيسيه</a></li>
                <li class="active">الاقسام</li>

            </ol>
        </section>



        <!-- Main content -->
        <section class="content">
            <div class="row mb-4">
                <div class="col-md-7  mr-bottom-10">
                    <form method="get" action="<?php echo e(route('departments.index')); ?>">
                        <div class="col-md-7" style="<?php if(app()->getLocale()=='ar'): ?> right:-15px <?php else: ?> left:-15px <?php endif; ?>">
                            <input type="text" name="search" class="form-control"placeholder="بحث" value="<?php echo e(request()->query('search')); ?>" >
                        </div>
                        <div class="col-md-5">
                            <button type="submit" class="brn btn-sm btn-primary"><span class="fa fa-search"></span>بحث </button>
                            <?php if(auth()->user()->hasPermission('create_departments')): ?>
                                <a href="<?php echo e(route('departments.create')); ?>" class="brn btn-sm btn-danger"><span class="fa fa-plus"></span> اضافة قسم جديد </a>
                            <?php else: ?>
                                <a href="#" disabled="" class="brn btn-sm btn-danger"><span class="fa fa-plus"></span> اضافه قسم جديد </a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">جدول الاقسام</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">

                                <tr>
                                    <th style="width: 10px">التسلسل</th>
                                    <th>الاسم</th>
                                    <th>الجريده</th>
                                    <th>التحكم </th>
                                </tr>
                                <?php if($departments->count()==0): ?>
                                    <tr>
                                        <td colspan="7" class="text-center">لا توجد سجلات</td>
                                    </tr>
                                <?php else: ?>

                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($user->id); ?>.</td>
                                            <td><?php echo e($user->name); ?></td>
                                            <td><?php echo e($user->newspaper->name); ?></td>
                                            <td>
                                                <?php if(auth()->user()->hasPermission('delete_departments')): ?>
                                                    <form method="post" id="remove_user_form_<?php echo e($user->id); ?>" action="<?php echo e(route('departments.destroy',$user->id)); ?>">
                                                        <?php echo e(csrf_field()); ?>

                                                        <?php echo e(method_field('DELETE')); ?>

                                                    </form>
                                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-danger-<?php echo e($user->id); ?>"
                                                    > <i class="fa fa-trash"></i> حذف</button>
                                                    
                                                    <div class="modal modal-danger fade" id="modal-danger-<?php echo e($user->id); ?>" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span></button>
                                                                    <h4 class="modal-title">حذف جريده</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>هل تريد تأكيد الحذف</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">الغاء</button>
                                                                    <button type="button" class="btn btn-outline"<?php if(app()->getLocale()=='en'): ?>style="float: right;" <?php endif; ?>
                                                                    onclick="document.getElementById('remove_user_form_<?php echo e($user->id); ?>').submit();"
                                                                    >تأكيد</button>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    

                                                <?php else: ?>
                                                    <button class="btn btn-danger" disabled=""><i class="fa fa-trash"></i>  حذف</button>
                                                <?php endif; ?>

                                                <?php if(auth()->user()->hasPermission('update_departments')): ?>
                                                    <a href="<?php echo e(route('departments.edit',$user->id)); ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> تعديل</a>
                                                <?php else: ?>
                                                    <button class="btn btn-success" disabled=""><i class="fa fa-edit"></i> تعديل</button>
                                                <?php endif; ?>
                                            </td>

                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </table>
                            <?php echo $departments->appends(['search'=>request()->query('search')])->render(); ?>


                        </div><!-- /.box-body -->

                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->


<?php $__env->stopSection(); ?>



<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/el-sheref/Private/cv-works/gareda/resources/views/dashboard/departments/index.blade.php ENDPATH**/ ?>