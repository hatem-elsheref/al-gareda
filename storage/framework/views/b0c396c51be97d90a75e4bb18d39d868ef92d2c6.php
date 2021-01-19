<?php $__env->startSection('content'); ?>


    <?php $__env->startPush('scripts'); ?>


        <script src="https://cdn.tiny.cloud/1/4b2rd40qpdelgfmi3oofgocpnxs28fndbr734f0c12ctqmk0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#editor1',
                convert_urls: false,
                height:600,
                statusbar: false,

                plugins: 'image video code print preview fullpage  searchreplace autolink directionality  visualblocks visualchars fullscreen image link    table charmap hr pagebreak nonbreaking  toc insertdatetime advlist lists textcolor wordcount   imagetools    contextmenu colorpicker textpattern media ',
                toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat |undo redo | image code| link fontsizeselect  | ',
                image_title: true,
                automatic_uploads: true,
                images_upload_url: '<?php echo e(url("/articles/upload")); ?>',
                file_picker_types: 'image',
                file_browser_callback: function(field_name, url, type, win) {
                    win.document.getElementById(field_name).value = 'my browser value';
                },

                file_picker_callback: function(cb, value, meta) {

                    var input = document.createElement('file');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');

                    input.onchange = function() {
                        var file = this.files[0];

                        var reader = new FileReader();
                        reader.readAsDataURL(file);
                        reader.onload = function () {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), { title: file.name });
                        };
                    };
                    input.click();
                }
            });

            </script>
        <script src="<?php echo e(asset('dashboard/assets/js/select2.js')); ?>"></script>
        <script>
            $(".js-example-tokenizer").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            });

                   </script>

        <script>
            $('#newsPapers').on('change',function(){
                $.ajax({
                    url: '<?php echo e(route('articles.departments')); ?>',
                    method: 'get',
                    data: {
                        'id':$(this).val()
                    },
                    success : function(data){
                        let d="<option selected>اختر قسم</option>";

                        for (var i=0;i<data.length;i++){
                            let obj=data[i];
                            d+=addOption(obj.id,obj.name);
                        }
                        if (d.length<10){
                            d="<option>لا توجد اقسام ف هذه الجريده</option>"
                        }
                        $('#departments').prop('disabled',false);
                        $('#departments').html(d);
                    }  ,
                    error:function (data) {
                        alert('invalid newspaper');
                    }
                });

            });
            function addOption(id,value){
                let option="<option value='"+id+"'>"+value+"</option>"
                return option;
            }
        </script>
        <?php $__env->stopPush(); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Contentlo Header (Page header) -->
            <section class="content-header">
            <h1>
            ادارة المقالات
        <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('dashboard')); ?>"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
        <li><a href="<?php echo e(route('articles.index')); ?>">المقالات</a></li>
        <li class="active">اضافة مقاله جديده</li>
        </ol>
        </section>
        <!--Main Content-->
        <section class="content">
            <div class="row">

            <div class="col-md-9">
            <?php echo $__env->make('dashboard.layouts.includes.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="box box-info">
            <div class="box-header">
            <h3 class="box-title">اضافة مقاله جديده
        <small></small>
        </h3>
        <!-- tools box -->
        <div class="pull-right box-tools">
            <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
        title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
        <!-- /. tools -->
        </div>
        <!-- /.box-header -->

        <div class="box-body pad">
            <form action="<?php echo e(route('articles.store')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
            <label for="title">العنوان الرئيسي</label>
        <input class="form-control" name="title" placeholder="ادخل العنوان الرئيسي"  id="title"  value="<?php echo e(old('title')); ?>">
            </div>
                <div class="form-group">
                    <label for="subtitle">العنوان الفرعى</label>
                    <input class="form-control" name="subtitle" placeholder="ادخل العنوان الفرعى"  id="subtitle"  value="<?php echo e(old('subtitle')); ?>">
                </div>
                <div class="form-group">
                    <label for="description">الوصف </label>
                    <textarea class="form-control" name="description"   id="description" ><?php echo e(old('description')); ?> </textarea>
                </div>
                <div class="form-group">





                    <!-- Input to browse your machine and select image to upload -->
                    <label for="content">المقال</label>
                    
                    <textarea name="content" id="editor1" rows="10" cols="80">
                        <?php echo old('content'); ?>

                    </textarea>
                </div>
            <div class="form-group">
            <label for="tags">اختر الكاتب</label>
        <select class="form-control" name="author_id"  style="height: 40px;" >
            <option selected disabled >اختر الكاتب</option>
        <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($author->id); ?>" <?php if(old('author_id')==$author->id): ?> selected <?php endif; ?>>
        <?php echo e($author->name); ?>

        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        </div>
            <div class="form-group">
            <label for="tags">اختر الجريده</label>
        <select class="form-control" name="newspaper_id"  style="height: 40px;" id="newsPapers">
            <option selected disabled >اختر الجريده</option>
        <?php $__currentLoopData = $newspapers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($news->id); ?>" <?php if(old('newspaper_id')==$news->id): ?> selected <?php endif; ?>>
        <?php echo e($news->name); ?>

        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        </div>
        <div class="form-group">
            <label for="tags">اختر القسم</label>
        <select class="form-control" name="department_id"  style="height: 40px;" disabled="" id="departments">
        </select>
        </div>
        <!-- /.form group -->
        <div class="form-group">
            <label for="tags">Tags</label>
            <select class="form-control js-example-tokenizer" id="tags" multiple name="tags[]">

            <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($tag->id); ?>" <?php if(in_array($tag->id,(array)old('tags'))): ?> selected <?php endif; ?>>
        <?php echo e($tag->name); ?>

        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        </div>
           <div class="form-group">
            <label for="status">تقييم المقاله</label>
        <select class="form-control" name="status"  style="height: 40px;" id="status">
       
<option selected value="حيادى" <?php if(old('status')=='حيادى'): ?> selected <?php endif; ?>>حيادى</option>
<option value="جيد" <?php if(old('status')=='جيد'): ?> selected <?php endif; ?>>جيد</option>
<option value="سيئ" <?php if(old('status')=='سيئ'): ?> selected <?php endif; ?>>سيئ</option>

        </option>
        </select>
        </div>

            <div class="box-footer">
            <div class="pull-right">
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> حفظ</button>

            </div>
        </div>
        </form>
        </div>
        </div>
        <!-- /. box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3">
            <a href="<?php echo e(route('articles.index')); ?>" class="btn btn-primary btn-block margin-bottom">عرض كل المقالات</a>
        <div class="box box-solid">
            <div class="box-header with-border">
            <h3 class="box-title">الجرائد</h3>

            <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            </div>
            </div>
            <div class="box-body no-padding" style="">
            <ul class="nav nav-pills nav-stacked">
            <?php $__currentLoopData = $newspapers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newspaper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li style="cursor: none">
            
            <a href="<?php echo e(url('articles/show?newspaper_id='.$newspaper->id.'&filter=بحث')); ?>" style="cursor: default"><i class="fa fa-bars"></i>
            <?php echo e($newspaper->name); ?>

            <span class="label label-primary pull-left"><?php echo e($newspaper->departments->count()); ?></span>
            </a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            </div>
            <!-- /.box-body -->
            </div>
            <!-- /. box -->
            <div class="box box-solid">
            <div class="box-header with-border">
            <h3 class="box-title">الكلمات المفتاحية</h3>

        <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding" style="">
            <ul class="nav nav-pills nav-stacked">
            <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
            <a  style="cursor: default;"><i class="fa fa-tags"></i> <?php echo e($tag->name); ?>

                <span class="label label-warning pull-left">
            <?php echo e($tag->articles->count()); ?>

            </span>
            </a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            </div>
            <!-- /.box-body -->
            </div>
            <!-- /.box -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
            </section>
            <!-- /.content -->
            </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/el-sheref/Private/cv-works/gareda/resources/views/dashboard/articles/create.blade.php ENDPATH**/ ?>