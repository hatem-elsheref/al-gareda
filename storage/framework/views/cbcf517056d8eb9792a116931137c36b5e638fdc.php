
<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style>
        * {
            box-sizing: border-box;

        }


        /* Add a gray background color with some padding */
        body {
            font-family: DejaVu Sans,Arial;
            padding: 20px;
            background: #f1f1f1;
            direction: rtl;
            text-align: justify;
            justify-content: flex-end;
        }

        /* Header/Blog Title */
        .header {
            padding: 30px;
            font-size: 40px;
            text-align: center;
            background: white;
        }

        /* Create two unequal columns that floats next to each other */
        /* Left column */
        .leftcolumn {
            float: left;
            width: 100%;
        }

        /* Right column */
        .rightcolumn {
            float: left;
            width: 25%;
            padding-left: 20px;
        }

        /* Add a card effect for articles */
        .card {
            background-color: white;
            padding: 20px;
            margin-top: 20px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Footer */
        .footer {
            padding: 8px;
            text-align: center;
            background: #ddd;
            margin-top: 20px;
        }

        /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
        @media  screen and (max-width: 800px) {
            .leftcolumn, .rightcolumn {
                width: 100%;
                padding: 0;
            }
        }
        @page  {
            header: page-header;
            footer: page-footer;
        }
    </style>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body dir="rtl">



<section id="data">
<htmlpageheader name="page-header">
 <h3>
             تقرير مقالات بتاريخ
             <?php echo e(\Illuminate\Support\Carbon::now()->format('d - m - Y')); ?>

             بعدد
         (<?php echo e(count($articles)); ?>)

             مقاله
         </h3>
</htmlpageheader>
<htmlpagefooter name="page-footer">
       صفحة  {PAGENO} 
</htmlpagefooter>
<div class="row">
    <div class="leftcolumn">
        <?php
        $count=1;
        ?>
        <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pdf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card">
                <h2><?php echo e($pdf->title); ?></h2>
                <h4><?php echo e($pdf->subtitle); ?></h4>
                <h5><?php echo e($pdf->description); ?></h5>
                <h5><?php echo e($pdf->status); ?></h5>
                <h5><?php echo e($pdf->created_at); ?></h5>

                <p>
                <?php echo $pdf->content; ?>

            </div>
            <div class="footer">
                <h4>نهايه المقاله (<?php echo e($count); ?>)</h4>
                <?php
                           $count++;
                ?>
            </div>
                <div class="page-break"></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
</section>
<script>

    window.print();                    ;
</script>
</body>
</html>
<?php /**PATH /media/el-sheref/Private/cv-works/gareda/resources/views/pdf.blade.php ENDPATH**/ ?>