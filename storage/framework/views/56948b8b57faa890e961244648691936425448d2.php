<?php $__env->startSection('content'); ?>

    <?php $__env->startPush('scripts'); ?>
                <script src="<?php echo e(asset('dashboard/assets/js/jq.js')); ?>"></script>
        <script src="<?php echo e(asset('dashboard/assets/js/dt.js')); ?>"></script>

        <script>
            $(document).ready(function() {
                $('#example1').DataTable({
                    "columnDefs": [
                        { "orderable": false, "targets": 0 }
                    ],
                    'paging':false,

                });
            } );
        </script>
        <script type="text/javascript">

                $("#all").click(function () {
                    $(".item").prop('checked', $(this).prop('checked'));
                });
                $('#print-btn').click(function () {
                    var checkArray = new Array();
                    var d='';
                    $('.item').each(function () {
                        if(this.checked ){
                            checkArray.push(this.value);
                          d+=_input(this.value);
                        }
                        // this.checked ? checkArray.push(this.value) :'';
                    });
                         if (checkArray.length>0){
                             $('#art-ids').append(d);
                             $('#pdf').submit();
                         }   else{
                             alert('choice at least one article');
                         }


                    // alert(checkArray);
                });
                function _input(val){
                    return "<input type='checkbox' hidden name='articles[]' checked value='"+val+"'>";
                }

                function  _print(id) {
                    let input="<input type='checkbox' hidden name='articles[]' checked value='"+id+"'>";
                    $('#art-ids').append(input);
                    $('#pdf').submit();
                }
            </script>
        <?php $__env->stopPush(); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <form method="post" action="<?php echo e(route('pdf')); ?>" id="pdf">
            <?php echo csrf_field(); ?>
            <span id ='art-ids'></span>
        </form>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                ادارة المقالات
                <small>
                    <span class="badge btn-danger btn-sm"><?php echo e(count($articles)); ?></span>
                </small>

            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('dashboard')); ?>"><i class="fa fa-dashboard"></i> اللوحة الرئيسيه</a></li>
                <li class="active">المقالات</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row mb-4">
                <div class="col-md-6  mr-bottom-10">
                    <form method="get" action="<?php echo e(route('articles.index')); ?>">
                        <div class="col-md-7" style="<?php if(app()->getLocale()=='ar'): ?> right:-15px <?php else: ?> left:-15px <?php endif; ?>">
                            <input type="text" name="search" class="form-control"placeholder="بحث" value="<?php echo e(request()->query('search')); ?>" >
                        </div>
                        <div class="col-md-5">
                            <button type="submit" class="btn btn-sm btn-primary"><span class="fa fa-search"></span>بحث </button>
                            <?php if(auth()->user()->hasPermission('create_articles')): ?>
                                <a href="<?php echo e(route('articles.create')); ?>" class="btn btn-sm btn-danger"><span class="fa fa-plus"></span> اضافة مقاله جديد </a>
                            <?php else: ?>
                                <a href="#" disabled="" class="brn btn-sm btn-danger"><span class="fa fa-plus"></span> اضافه مقاله جديد </a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
                <div class="col-md-6" style="margin-right: -69px">
                    <button  class="btn btn-sm btn-default" id="print-btn">
                        <span class="fa fa-print"></span> طباعه
                    </button>
                </div>
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header ">
                            <h3 class="box-title">جدول المقالات</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 10px">
                                        <div class="checkbox icheck  pull-right">
                                            <label>
                                                <input type="checkbox"  name="items" id="all">
                                            </label>
                                        </div>
                                    </th>
                                    <th style="width: 10px">التسلسل</th>
                                    <th>العنوان الرئيسي</th>
                                    <th> الجريده</th>
                                    <th> القسم</th>
                                    <th> الكاتب</th>
                                    <th>التقييم</th>
                                    <th> كلمات مفتاحيه</th>
                                    <th> التاريخ</th>
                                    <th>التحكم </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($articles->count()==0): ?>
                                    <tr>
                                        <td colspan="9" class="text-center">لا توجد سجلات</td>
                                    </tr>
                                <?php else: ?>
                                    <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <div class="checkbox icheck  pull-right">
                                                    <label>
                                                        <input type="checkbox" class="item"  name="articles_id[]" value="<?php echo e($item->id); ?>">
                                                    </label>
                                                </div>
                                            </td>
                                            <td><?php echo e($item->id); ?></td>
                                            <td><?php echo e($item->title); ?></td>
                                            <td><?php echo e($item->department->newspaper->name); ?></td>
                                            <td><?php echo e($item->department->name); ?></td>
                                            <td><?php echo e($item->author->name); ?></td>
                                            <td><?php echo e($item->status); ?></td>
                                            <td>
                                                <?php
                                                    $t='';
                                                ?>
                                                <?php $__currentLoopData = $item->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $t.=$tag->name.',';
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e(trim($t,',')); ?>

                                            </td>
                                            <td><?php echo e($item->created_at->format('Y-m-d')); ?></td>
                                            <td>
                                                <?php if(auth()->user()->hasPermission('delete_articles')): ?>
                                                    <form method="post" id="remove_user_form_<?php echo e($item->id); ?>" action="<?php echo e(route('articles.destroy',$item->id)); ?>">
                                                        <?php echo e(csrf_field()); ?>

                                                        <?php echo e(method_field('DELETE')); ?>

                                                    </form>
                                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-danger-<?php echo e($item->id); ?>"
                                                    > <i class="fa fa-trash"></i> حذف</button>
                                                    
                                                    <div class="modal modal-danger fade" id="modal-danger-<?php echo e($item->id); ?>" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span></button>
                                                                    <h4 class="modal-title">حذف مقال</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>هل تريد تأكيد الحذف</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">الغاء</button>
                                                                    <button type="button" class="btn btn-outline"<?php if(app()->getLocale()=='en'): ?>style="float: right;" <?php endif; ?>
                                                                    onclick="document.getElementById('remove_user_form_<?php echo e($item->id); ?>').submit();"
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

                                                <?php if(auth()->user()->hasPermission('update_articles')): ?>
                                                    <a href="<?php echo e(route('articles.edit',$item->id)); ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> تعديل</a>
                                                <?php else: ?>
                                                    <button class="btn btn-success" disabled=""><i class="fa fa-edit"></i> تعديل</button>
                                                <?php endif; ?>






                                                    <button class="btn btn-default" onclick="_print('<?php echo e($item->id); ?>');return false;"><i class="fa fa-print"></i> طباعه</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                            <?php echo $articles->appends(['search'=>request()->query('search')])->render(); ?>


                        </div><!-- /.box-body -->
                    </div>
                </div><!-- /.col -->

            </div>
        </section><!-- /.content -->



<?php $__env->stopSection(); ?>



<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/el-sheref/Private/cv-works/gareda/resources/views/dashboard/articles/index.blade.php ENDPATH**/ ?>