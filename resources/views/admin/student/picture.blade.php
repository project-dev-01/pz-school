@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.student_picture_upload') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">

<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

@endsection
@section('content')
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <!-- <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div> -->
                <h4 class="page-title"> {{ __('messages.student_picture_upload') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.student_picture_upload') }}<h4>
                    </li>
                </ul><br>
                
                @if($message = Session::get('errors'))
                <div class="alert alert-warning alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                @if($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                <form  method="post" action="{{ route('admin.student.addpicture') }}" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">{{ __('messages.student_no') }}<span class="text-danger">*</span></label>
                                <input type="text" id="name" name="roll_no" class="form-control" placeholder="{{ __('messages.student_no') }}" required>
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">{{ __('messages.select_file_for_upload') }}<span class="text-danger">*</span></label>
                                <input type="file" id="imageInput" name="upload"  class="form-control" placeholder="{{ __('messages.enter_stream_type_name') }}" requiredc>
                                <span class="text-danger error-text name_error"></span>
                                <img id="previewImage" src="{{url('images/users/default.jpg')}}" alt="Preview" style="max-width: 150px; max-height: 150px;">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                                <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.submit') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
    </div>
                <p class="text-center">(OR) <p>
                <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.student_picture_bulkupload') }}<h4>
                    </li>
                </ul><br>
                
                <div class="card-body">
                <form  method="post" action="{{ route('admin.student.addmultipicture') }}" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">{{ __('messages.select_file_for_upload') }}<span class="text-danger">*</span></label>
                                <input type="file" id="images" name="uploads[]" class="form-control"  multiple>
                                <span class="text-danger error-text name_error"></span>
                            </div>
                            <div id="image_preview"  style="width:100%;"></div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.upload') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
    </div>
   
</div>
<!-- container -->
@endsection
@section('scripts')
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<!-- button js added -->
<script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
    //streamType routes
    var streamTypeList = "{{ route('admin.stream_type.list') }}";
    var streamTypeDetails = "{{ route('admin.stream_type.details') }}";
    var streamTypeDelete = "{{ route('admin.stream_type.delete') }}";
    // lang change name start
    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_stream_type') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    // lang change name end 

    // Get PDF Footer Text

    var header_txt="{{ __('messages.stream_type') }}";
    var footer_txt="{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
</script>
<script src="{{ asset('js/custom/stream_type.js') }}"></script>
<script>
    const imageInput = document.getElementById('imageInput');
    const previewImage = document.getElementById('previewImage');
    function previewSelectedImage() {
        const file = imageInput.files[0];
        if (file) {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function(e) {
            previewImage.src = e.target.result;
        }
        }
    }
    imageInput.addEventListener('change', previewSelectedImage);
</script>
@if(!empty(Session::get('school_roleid')))
<script>
var checkpermissions = "{{ route('admin.school_role.checkpermissions') }}";
</script>
<script src="{{ asset('js/custom/permissions.js') }}"></script>

@endif

<script>
	$(document).ready(function() {
  var fileArr = [];
   $("#images").change(function(){
      // check if fileArr length is greater than 0
       if (fileArr.length > 0) fileArr = [];
     
        $('#image_preview').html("");
        var total_file = document.getElementById("images").files;
        if (!total_file.length) return;
        for (var i = 0; i < total_file.length; i++) {
          if (total_file[i].size > 1048576) {
            return false;
          } else {
            fileArr.push(total_file[i]);
			
			var fileName = total_file[i].name.split('\\').pop();
                
                // Get the file name without extension
                var student_rollno = fileName.split('.').slice(0, -1).join('.');
				console.log(student_rollno);

            $('#image_preview').append("<div class='row' id='img-div"+i+"' ><div class='img-div col-3' > Student Roll No :<br>"+student_rollno+"</div><div class='col-3' ><img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-responsive image img-thumbnail' title='"+total_file[i].name+"' style='width:150px;height:150px;'></div><div class='col-3'><button id='action-icon' value='img-div"+i+"' class='btn btn-danger' role='"+total_file[i].name+"'><i class='fa fa-trash'></i></button></div></div>");
          }
        }
   });
  
  $('body').on('click', '#action-icon', function(evt){
      var divName = this.value;
      var fileName = $(this).attr('role');
      $(`#${divName}`).remove();
    
      for (var i = 0; i < fileArr.length; i++) {
        if (fileArr[i].name === fileName) {
          fileArr.splice(i, 1);
        }
      }
    document.getElementById('images').files = FileListItem(fileArr);
      evt.preventDefault();
  });
  
   function FileListItem(file) {
            file = [].slice.call(Array.isArray(file) ? file : arguments)
            for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
            if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
            for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
            return b.files
        }
});
</script>
@endsection