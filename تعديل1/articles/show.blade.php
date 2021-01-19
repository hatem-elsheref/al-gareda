
@extends('dashboard.layouts.app')

@section('content')

    @push('scripts')
        <script src="{{asset('dashboard/assets/js/jq.js')}}"></script>
        <script src="{{asset('dashboard/assets/js/dt.js')}}"></script>

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
        <script>
            $('#newsPapers').on('change',function(){
                $.ajax({
                    url: '{{route('articles.departments')}}',
                    method: 'get',
                    data: {
                        'id':$(this).val()
                    },
                    success : function(data){
                       let d="<option value='0'>اختر القسم</option>";
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
                let option="<option value='"+id+"'>"+value+"</option>" ;
                return option;
            }
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
    @endpush

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <form method="post" action="{{route('pdf')}}" id="pdf" target="_blank">
            @csrf
            <span id ='art-ids'></span>
        </form>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                فلترة المقالات
                <small>
                    <span class="badge btn-danger btn-sm">{{count($articles)}}</span>
                </small>

            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> اللوحة الرئيسيه</a></li>
                <li class="active">فلتر المقالات</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row mb-4">
                <div class="col-md-6  mr-bottom-10">
                    <form method="get" action="{{route('articles.show')}}">
                        <div class="col-md-11" style="left:-15px">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tags">اختر الجريده</label>
                                        <select class="form-control" name="newspaper_id" style="height: 40px;" id="newsPapers">
                                            <option selected="" disabled="">اختر الجريده</option>
                                            @foreach($newspapers as $newspaper)
                                                <option value="{{$newspaper->id}}">
                                                    {{$newspaper->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tags">اختر القسم</label>
                                        <select class="form-control" name="department_id" style="height: 40px;" disabled id="departments">
                                            <option selected="" disabled="">اختر القسم</option>
{{--                                            @foreach($departments as $department)--}}
{{--                                                <option value="{{$department->id}}">--}}
{{--                                                    {{$department->name}}--}}
{{--                                                </option>--}}
{{--                                            @endforeach--}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tags">اختر الكاتب</label>
                                        <select class="form-control" name="author_id" style="height: 40px;">
                                            <option selected="" disabled="">اختر الكاتب</option>
                                            @foreach($authors as $author)
                                                <option value="{{$author->id}}">
                                                    {{$author->name}}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tags" style="visibility: hidden">تنفيذ الفلتر </label>
                                        <input type="submit" class=" form-control btn btn-primary" name="filter" value="بحث">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-1" style="margin-right: -69px">
                    <div class="form-group">
                        <label for="tags" style="visibility: hidden">طباعه تنفيذ  </label>
                        <button  class="btn  btn-default" id="print-btn">
                            <span class="fa fa-print"></span> طباعه
                        </button>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header ">
                            <h3 class="box-title">جدول نتائج المقالات</h3>
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
                                    <th> كلمات مفتاحيه</th>
                                    <th> التاريخ</th>
                                    <th>التحكم </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($articles->count()==0)
                                    <tr>
                                        <td colspan="9" class="text-center">لا توجد سجلات</td>
                                    </tr>
                                @else
                                    @foreach($articles as $item)
                                        <tr>
                                            <td>
                                                <div class="checkbox icheck  pull-right">
                                                    <label>
                                                        <input type="checkbox" class="item"  name="articles_id[]" value="{{$item->id}}">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->department->newspaper->name}}</td>
                                            <td>{{$item->department->name}}</td>
                                            <td>{{$item->author->name}}</td>
                                            <td>
                                                @php
                                                    $t='';
                                                @endphp
                                                @foreach($item->tags as $tag)
                                                    @php
                                                        $t.=$tag->name.',';
                                                    @endphp
                                                @endforeach
                                                {{trim($t,',')}}
                                            </td>
                                            <td>{{$item->created_at->format('Y-m-d')}}</td>
                                            <td>
                                                @if(auth()->user()->hasPermission('delete_articles'))
                                                    <form method="post" id="remove_user_form_{{$item->id}}" action="{{route('articles.destroy',$item->id)}}">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                    </form>
                                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-danger-{{$item->id}}"
                                                    > <i class="fa fa-trash"></i> حذف</button>
                                                    {{--Start Model Of Delete Notification--}}
                                                    <div class="modal modal-danger fade" id="modal-danger-{{$item->id}}" style="display: none;">
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
                                                                    <button type="button" class="btn btn-outline"@if(app()->getLocale()=='en')style="float: right;" @endif
                                                                    onclick="document.getElementById('remove_user_form_{{$item->id}}').submit();"
                                                                    >تأكيد</button>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    {{--End Model Of Delete Notification--}}
                                                @else
                                                    <button class="btn btn-danger" disabled=""><i class="fa fa-trash"></i>  حذف</button>
                                                @endif

                                                @if(auth()->user()->hasPermission('update_articles'))
                                                    <a href="{{route('articles.edit',$item->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> تعديل</a>
                                                @else
                                                    <button class="btn btn-success" disabled=""><i class="fa fa-edit"></i> تعديل</button>
                                                @endif

                                                {{--                                                @if(auth()->user()->hasPermission('read_articles'))--}}
                                                {{--                                                    <a href="{{route('articles.show',$item->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i> عرض</a>--}}
                                                {{--                                                @else--}}
                                                {{--                                                    <button class="btn btn-warning" disabled=""><i class="fa fa-eye"></i> عرض</button>--}}
                                                {{--                                                @endif--}}
                                                <button class="btn btn-default" onclick="_print('{{$item->id}}');return false;"><i class="fa fa-print"></i> طباعه</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            {!! $articles->appends(['search'=>request()->query('search')])->render() !!}

                        </div><!-- /.box-body -->
                    </div>
                </div><!-- /.col -->

            </div>
        </section><!-- /.content -->



@endsection


