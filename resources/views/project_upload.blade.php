<!--
   Copyright, All Rights Reserved, BlockAPT Limited, UK Company ID: 11759911 #*,
   Year 2020
   -->

@if(Auth::check())
    @extends('layouts.form')

    @section(@$active_tab,"active")
    @section(@$active_tab_1,"active")

@section('create_this')

    <link href="{{ asset('assets/plugins/jquery-tag-it/css/jquery.tagit.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-wysihtml5/src/bootstrap3-wysihtml5.css')}}" rel="stylesheet" />

    <link href="{{ asset('/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css')}}" rel="stylesheet"/>



@endsection

@section('content')
    @include('layouts.sidebar')
@stop


@section('content1')

    <div id="content" class="content">
        <ol class="breadcrumb pull-right">

            <li class="active">{{@$_page_header}}</li>
        </ol>
        <h1 class="page-header">{{@$_page_header}} - <small>{{@$_page_header_small}}</small></h1>
        <!-- end page-header -->
        <div class="col-md-10">
            <!-- begin col-6 -->

            <div class="panel panel-inverse" data-sortable-id="form-plugins-9">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>

                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                    </div>
                    <h4 class="panel-title">{{@$_page_header}}</h4>
                </div>

                <div class="panel-body">
                    @if(!empty($_view_data))
                    <table class="table table-striped table-bordered data-table">
                        <thead>
                        @if(!empty($_view_data))
                        <tr>
                            <?php
                            $_th = current($_view_data);
                            if( !empty($_th)) {
                                foreach( $_th as $k => $title){
                                    echo '<th>'.ucfirst(str_replace('_', ' ', $k)).'</th>';
                                }
                            }
                            ?>
                        </tr>
                        @endif
                        </thead>
                        <tbody>
                        @if(!empty($_view_data))
                            @foreach($_view_data as $key => $val)
                                <tr class="even gradeC">
                                    @foreach($val as $key_inner => $val_inner)
                                        <td>{!! $val_inner !!}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @else
                            <tr class="even gradeC">
                                <td>No Data Found</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                    @else
                       <div>No Data Found</div>
                    @endif

                </div>

            </div>
        </div>
        <div class="col-md-10">
            <!-- begin col-6 -->

            <div class="panel panel-inverse" data-sortable-id="form-plugins-9">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>

                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                    </div>
                    <h4 class="panel-title">{{@$_page_header}}</h4>
                </div>

                @if ($message = Session::get('message'))
                    <div class="alert alert-success fade in">
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ $message }}
                    </div>
                @endif
                @if ($message = Session::get('danger'))
                    <div class="alert alert-danger fade in">
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ $message }}
                    </div>
                @endif
                <div class="panel-body panel-form">
                    <form class="form-horizontal form-bordered" enctype="multipart/form-data" method="post" action="{{url('multi-project-uploads')}}" >
                        {{ csrf_field() }}

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <div class="form-group">
                            <label class="control-label col-md-4">Project name *</label>
                            <div class="col-md-8">
                                <input type="text" id="" value=""  name="name" class="form-control">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4">Enter Contact </label>
                            <div class="col-md-8">
                                <input type="text" id="url"  placeholder="E.g.https://www.google.com" value="{!! @$adminProfile->url !!}"  name="url" class="form-control">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4">Enter Descriptions </label>
                            <div class="col-md-8">
                                <textarea class="form-control tiny" name="descriptions" placeholder="Enter Your Brief Descriptions" maxlength="1000" rows="5" id="descriptions">{!! @$adminProfile->descriptions !!}</textarea>


                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Technology</label>
                            <div class="col-md-8">
                                <div class="m-b-15">
                                    <ul id="email_cc"  class="inverse email-to technology">
                                    </ul>
                                    <?php /*$email = get_settings('Mail','smtp_email_cc'); */?><!--
                                    @if(!empty($email))
                                        <ul id="email_cc"  class="inverse email-to">
                                            @foreach($email as $e)
                                                <li>{!! $e !!}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <ul id="email_cc"  class="inverse email-to">
                                        </ul>
                                    @endif-->

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4">Product photos (can attach more than one): </label>
                            <div class="col-md-8">
                                <input type="file" class="form-control" name="photos[]" multiple />

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4"></label>
                            <div class="col-md-8">
                                <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>


    </div>
    <style>

    </style>
@endsection

@section('script')
    <script src="{{ asset('assets/plugins/jquery-tag-it/js/tag-it.js')}}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-wysihtml5/dist/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <script src="{{ asset('assets/js/email-compose.demo.min.js')}}"></script>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/jquery.tinymce.min.js" referrerpolicy="origin"></script>

    <script src="{{ asset('/assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('/assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('/assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{ asset('/assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('/assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js')}}"></script>
    <script src="{{ asset('/assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js')}}"></script>
    <script src="{{ asset('/assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js')}}"></script>
    <script src="{{ asset('/assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('/assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>




    <script>
        $(document).ready(function() {
            $('.data-table').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    { extend: 'copy', className: 'btn-sm' },
                    { extend: 'csv', className: 'btn-sm' },
                    { extend: 'excel', className: 'btn-sm' },
                    { extend: 'pdf', className: 'btn-sm' },
                    { extend: 'print', className: 'btn-sm' }
                ],
                "order": [[ 0, "desc" ]],
                responsive: true,
                autoFill: true,
                colReorder: true,
                keys: true,
                rowReorder: true,
                select: true
            } );
        } );
        $('textarea.tiny').tinymce({
            height: 500,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help'
        });
        function myFunction() {
            confirm("Are You Sure!");
        }
        $(document).ready(function() {
            EmailCompose.init();
        });

    </script>

@stop

@endif

