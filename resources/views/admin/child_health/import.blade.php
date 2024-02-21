@extends('layouts.admin-layout')
@section('title','Import')
@section('component_css')
<!-- toaster alert -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
@endsection
@section('content')
<style>
  //variables
  $file-uploader__primaryColor: rgb(114, 191, 167);
  $file-uploader__primaryColor--hover: lighten($file-uploader__primaryColor, 15%);
  $file-uploader__black: #242424;
  $file-uploader__error: rgb(214, 93, 56);

  //style
  .file-uploader {
    background-color: lighten($file-uploader__primaryColor, 30%);
    border-radius: 3px;
    color: $file-uploader__black;
  }

  .file-uploader__message-area {
    font-size: 12px;
    text-align: center;
    color: darken($file-uploader__primaryColor, 25%);
  }

  .file-list {
    background-color: lighten($file-uploader__primaryColor, 45%);
    font-size: 12px;
  }

  .file-list__name {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .file-list li {
    height: 50px;
    line-height: 50px;
    margin-left: 0.5em;
    border: none;
    overflow: hidden;
  }

  .removal-button {
    width: 8%;
    border: none;
    background-color: #db4242;
    color: black;
    margin-top: 5px;

    &::before {
      content: "X";
    }

    &:focus {
      outline: 0;
    }
  }

  .file-chooser {
    padding: 1em;
    transition: background-color 1s, height 1s;

    & p {
      font-size: 18px;
      padding-top: 1em;
    }
  }

  //layout
  .file-uploader {
    max-width: 400px;
    height: auto;
    margin: 2em auto;

    & * {
      display: block;
    }

    & input[type="submit"] {
      margin-top: 2em;
      float: right;
    }
  }

  .file-list {
    margin: 0 auto;
    max-width: 50%;
  }

  .file-list__name {
    max-width: 70%;
    float: left;
  }

  .file-list li {
    @extend %clearfix;
  }

  .removal-button {
    display: inline-block;
    float: right;
  }

  .file-chooser {
    width: 90%;
    margin: 0.5em auto;
  }

  .file-chooser__input {
    margin: 0 auto;
  }

  .file-uploader__submit-button {
    width: 100%;
    border: none;
    font-size: 1.5em;
    padding: 1em;
    background-color: $file-uploader__primaryColor;
    color: white;

    &:hover {
      background-color: $file-uploader__primaryColor--hover;
    }
  }

  //layout
  .file-uploader {
    @extend %clearfix;
  }

  //utility

  %clearfix {
    &:after {
      content: "";
      display: table;
      clear: both;
    }
  }

  .hidden {
    display: none;

    & input {
      display: none;
    }
  }

  .error {
    background-color: $file-uploader__error;
    color: white;
  }

  //reset
  *,
  *::before,
  *::after {
    box-sizing: border-box;
  }

  ul,
  li {
    margin: 0;
    padding: 0;
  }
</style>
<!-- Page Content -->
<div class="content container-fluid">
  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box">
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
          </ol>
        </div>
        <h4 class="page-title">{{ __('messages.import_bulk_upload') }}</h4>
      </div>
    </div>
  </div>
  <!-- end page title -->
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-0">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <h4 class="nav-link">{{ __('messages.import_bulk_upload') }}
              <h4>
          </li>
        </ul><br>
        <!-- <div class="card-body">
                    <div class="col-12">
                        <div class="col-sm-12 col-md-12">
                            <div class="dt-buttons" style="float:right;"> 
                                <a href="{{ config('constants.image_url').'/common-asset/uploads/Sample Employee.csv'}}" target="_blank"><button class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="employee-table" type="button"><span>{{ __('messages.download_sample_csv') }}</span></button></a>
                            </div>
                        </div>
                    </div>
                </div> -->

        @if(count($errors) > 0)
        <div class="alert alert-danger">
          {{ __('messages.upload_validation_error') }}<br><br>
          <ul>
            @foreach($errors as $error)
            <li>{{ $error[0] }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
        </div>
        @endif
        <!--<form method="post" enctype="multipart/form-data" action="{{ route('admin.employee.import.add') }}">
                        {{ csrf_field() }}
                        <div class="form-group" style="text-align: center;">
                           <div class="card-body file-chooser" style="margin-left: 17px;">
                               <label style="margin-right:10px;">{{ __('messages.select_file_for_upload') }}</label>
                               <input class="file-chooser__input" type="file" multiple>
                            </div>  
                            <input type="submit" name="upload" class="btn btn-success" value="{{ __('messages.upload') }}">   
                        </div>
                    </form>-->
        <form method="post" class="file-uploader"  autocomplete="off" action="{{ route('admin.child_health.import.add') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="file-uploader__message-area">
            <p>{{ __('messages.select_a_file') }}</p>
          </div>

          <div class="form-group" style="text-align: center;">
            <div class="file-chooser">
              <input class="fileUploader" type="file" name="file[]" multiple>
            </div>
            <div class="row justify-content-center">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="date">{{ __('messages.month') }}/{{ __('messages.year') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" required="true" class="form-control" name="date" id="date" placeholder="{{ __('messages.mm_yyyy') }}">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- <div class="col-md-3">
                                <div class="form-group">
                                    <label for="date">{{ __('messages.month') }}/{{ __('messages.year') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="date" id="employeeReportDate" placeholder="{{ __('messages.mm_yyyy') }}">
                                    </div>
                                </div>
                            </div> -->
              <!-- <div class="col-md-3">
                <div class="form-group">
                  <label for="date">{{ __('messages.month') }}/{{ __('messages.year') }}<span class="text-danger">*</span></label>
                  <input type="text" required="true" class="form-control" name="date" id="date" placeholder="{{ __('messages.mm_yyyy') }}">
                </div>
              </div> -->
            </div>
            <input class="btn btn-success" type="submit" value="{{ __('messages.upload') }}">
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<!-- /Content End -->
<!-- content start  -->

</div>
<!-- /Page Content -->
@endsection
@section('scripts')
<script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ asset('libs/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('libs/morris.js06/morris.min.js') }}"></script>
<script src="{{ asset('libs/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script>
  toastr.options.preventDuplicates = true;
</script>
<script>
  
  (function($) {
    $.fn.uploader = function(options) {
      var settings = $.extend({
          MessageAreaText: "No files selected.",
          MessageAreaTextWithFiles: "File List:",
          DefaultErrorMessage: "Unable to open this file.",
          BadTypeErrorMessage: "We cannot accept this file type at this time.",
          acceptedFileTypes: [
            "pdf",
            "jpg",
            "gif",
            "jpeg",
            "bmp",
            "tif",
            "tiff",
            "png",
            "xps",
            "doc",
            "docx",
            "fax",
            "wmp",
            "ico",
            "txt",
            "cs",
            "rtf",
            "xls",
            "xlsx"
          ]
        },
        options
      );

      var uploadId = 1;
      //update the messaging
      $(".file-uploader__message-area p").text(
        options.MessageAreaText || settings.MessageAreaText
      );

      //create and add the file list and the hidden input list
      var fileList = $('<ul class="file-list"></ul>');
      var hiddenInputs = $('<div class="hidden-inputs hidden"></div>');
      $(".file-uploader__message-area").after(fileList);
      $(".file-list").after(hiddenInputs);

      //when choosing a file, add the name to the list and copy the file input into the hidden inputs
      $(".file-chooser__input").on("change", function() {
        var files = document.querySelector(".file-chooser__input").files;

        for (var i = 0; i < files.length; i++) {
          console.log(files[i]);

          var file = files[i];
          var fileName = file.name.match(/([^\\\/]+)$/)[0];

          //clear any error condition
          $(".file-chooser").removeClass("error");
          $(".error-message").remove();

          //validate the file
          var check = checkFile(fileName);
          if (check === "valid") {
            // move the 'real' one to hidden list
            $(".hidden-inputs").append($(".file-chooser__input"));

            //insert a clone after the hiddens (copy the event handlers too)
            $(".file-chooser").append(
              $(".file-chooser__input").clone({
                withDataAndEvents: true
              })
            );

            //add the name and a remove button to the file-list
            $(".file-list").append(
              '<li style="display: none;"><span class="file-list__name">' +
              fileName +
              '</span><button class="removal-button" data-uploadid="' +
              uploadId +
              '"></button></li>'
            );
            $(".file-list").find("li:last").show(800);

            //removal button handler
            $(".removal-button").on("click", function(e) {
              e.preventDefault();

              //remove the corresponding hidden input
              $(
                '.hidden-inputs input[data-uploadid="' +
                $(this).data("uploadid") +
                '"]'
              ).remove();

              //remove the name from file-list that corresponds to the button clicked
              $(this)
                .parent()
                .hide("puff")
                .delay(10)
                .queue(function() {
                  $(this).remove();
                });

              //if the list is now empty, change the text back
              if ($(".file-list li").length === 0) {
                $(".file-uploader__message-area").text(
                  options.MessageAreaText || settings.MessageAreaText
                );
              }
            });

            //so the event handler works on the new "real" one
            $(".hidden-inputs .file-chooser__input")
              .removeClass("file-chooser__input")
              .attr("data-uploadId", uploadId);

            //update the message area
            $(".file-uploader__message-area").text(
              options.MessageAreaTextWithFiles ||
              settings.MessageAreaTextWithFiles
            );

            uploadId++;
          } else {
            //indicate that the file is not ok
            $(".file-chooser").addClass("error");
            var errorText =
              options.DefaultErrorMessage || settings.DefaultErrorMessage;

            if (check === "badFileName") {
              errorText =
                options.BadTypeErrorMessage || settings.BadTypeErrorMessage;
            }

            $(".file-chooser__input").after(
              '<p class="error-message">' + errorText + "</p>"
            );
          }
        }
      });

      var checkFile = function(fileName) {
        var accepted = "invalid",
          acceptedFileTypes =
          this.acceptedFileTypes || settings.acceptedFileTypes,
          regex;

        for (var i = 0; i < acceptedFileTypes.length; i++) {
          regex = new RegExp("\\." + acceptedFileTypes[i] + "$", "i");

          if (regex.test(fileName)) {
            accepted = "valid";
            break;
          } else {
            accepted = "badFileName";
          }
        }

        return accepted;
      };
    };
  })($);

  //init
  $(document).ready(function() {
    console.log("hi");
    $(".fileUploader").uploader({
      MessageAreaText: ""
    });
  });
  $(function(){

    $('#date').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        // autoclose: true,
        yearRange: "-100:+50", // last hundred years
        onClose: function (dateText, inst) {
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
    $("#date").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });
  });
</script>
@endsection