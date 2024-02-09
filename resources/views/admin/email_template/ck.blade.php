@extends('layouts.admin-layout')
@section('title',' ' . __('messages.add_email_template') . '')
@section('component_css')
<link href="{{ asset('libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />

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
        <!-- Summernote css -->
        <link href="{{ asset('libs/summernote/summernote-bs4.min.cs') }}" rel="stylesheet" type="text/css" />

@endsection
@section('css')
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<style>
 .ck-editor__editable
 {
    min-height: 250px !important;
 }
    .dot {
        height: 25px;
        width: 25px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
    }
</style>
<link href="{{ asset('libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<style>
    .ui-datepicker {
        width: 21.4em;
    }

    @media screen and (min-device-width: 320px) and (max-device-width: 660px) {
        .ui-datepicker {
            width: 14.4em;
        }
    }

    @media screen and (min-device-width: 360px) and (max-device-width: 740px) {
        .ui-datepicker {
            width: 17.4em;
        }
    }

    @media screen and (min-device-width: 375px) and (max-device-width: 667px) {
        .ui-datepicker {
            width: 18.6em;
        }
    }

    @media screen and (min-device-width: 390px) and (max-device-width: 844px) {
        .ui-datepicker {
            width: 19.8em;
        }
    }

    @media screen and (min-device-width: 412px) and (max-device-width: 915px) {
        .ui-datepicker {
            width: 21.5em;
        }
    }

    @media screen and (min-device-width: 540px) and (max-device-width: 720px) {
        .ui-datepicker {
            width: 31.3em;
        }
    }

    @media screen and (min-device-width: 768px) and (max-device-width: 1024px) {
        .ui-datepicker {
            width: 13.2em;
        }
    }

    @media screen and (min-device-width: 820px) and (max-device-width: 1180px) {
        .ui-datepicker {
            width: 14.3em;
        }
    }
</style>
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">{{ __('messages.email_template') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.add_email_template') }}
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="emailTemplateForm" method="post" action="{{ route('admin.email_template.add') }}" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type_id">{{ __('messages.email_type') }}</label>
                                    <select class="form-control" id="type_id" name="type_id">
                                        <option value="">{{ __('messages.select_email_type') }}</option>
                                        @forelse($email_type as $type)
                                        <option value="{{$type['id']}}">{{$type['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject">{{ __('messages.subject') }} <span class="text-danger">*</span></label>
                                    <input type="text" id="subject" name="subject" class="form-control" placeholder="{{ __('messages.enter_subject') }}">
                                    <span class="text-danger error-text subject_error"></span>
                                </div>
                            </div>
                        </div>
                        
                                        <!-- basic summernote-->
                                        <div id="summernote-basic"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="template_body">{{ __('messages.template_body') }} <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="template_body" id="template_body" row="5" placeholder="{{ __('messages.enter_template_body') }}"  style="height:20px"></textarea>

                                    <span class="text-danger error-text template_body_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-md">
                            <strong>{{ __('messages.dynamic_tag') }} : </strong>
                            <a data-value="{name}" class="btn btn-light btn-xs btn_tag">{name}</a>
                            <a data-value="{email}" class="btn btn-light btn-xs btn_tag">{email}</a>
                            <a data-value="{mobile_no}" class="btn btn-light btn-xs btn_tag">{mobile_no}</a>
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                            <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.submit') }}</button>
                        </div>

                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- col -->
    </div> <!-- row -->
</div> <!-- container -->
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
<script src="{{ asset('libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('js/pages/form-pickers.init.js') }}"></script>
<script src="{{ asset('js/custom/ckeditor.js') }}"></script>
<script src="//cdn.ckeditor.com/4.4.7/standard-all/ckeditor.js"></script>


        <!-- Summernote js -->
<script src="{{ asset('libs/summernote/summernote-bs4.min.js') }}"></script>

<!-- Init js -->
<script src="{{ asset('js/pages/form-summernote.init.js') }}"></script>


<script>
    //email Template routes
    var emailTemplateIndex = "{{ route('admin.email_template') }}";
    var emailTemplateList = "{{ route('admin.email_template.list') }}";
    var emailTemplateDetails = "{{ route('admin.email_template.details') }}";
    var emailTemplateDelete = "{{ route('admin.email_template.delete') }}";
    // lang name start
    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_email_template') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    // lang change name end

    // Get PDF Footer Text
    var header_txt = "{{ __('messages.email_template') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
</script>
<script src="{{ asset('js/custom/email_template.js') }}"></script>

<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>

<script>
    function SimpleUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            // Configure the URL to the upload script in your back-end here!
            return new MyUploadAdapter(loader);
        };
    }

    var myEditor;

    ClassicEditor
        .create(document.querySelector('#template_body'), {
            extraPlugins: [SimpleUploadAdapterPlugin],
            language: calLang,
            insertText:"test"

            // ...
        })
        .then(editor => {
            console.log('Editor was initialized', editor);
            myEditor = editor;
        })
        .catch(err => {
            console.error(err.stack);
        });

    $('.btn_tag').on('click', function() {
        var txtToAdd = $(this).data("value");
        // $('textarea#template_body').ckeditor().editor.insertText('some text here');
        // myEditor.setData(txtToAdd);


        const textToInsert = $(this).data("value");
        const currentContent = myEditor.getData();
        const wordToFind = currentContent;
        const position = currentContent.indexOf(wordToFind) + wordToFind.length;
        const newContent = currentContent.substring(0, position) + textToInsert + currentContent.substring(position);
        console.log('pas',newContent)
        myEditor.setData(newContent);
        // myEditor.insertText(str);
        // $('#template_body').val(txtToAdd);
        // myEditor.insertText(txtToAdd);
        // myEditor.instances['template_body'].setData(txtToAdd);
        // ClassicEditor.instances['#template_body'].insertText(myValue);
    });
    
</script>
<script>
    class MyUploadAdapter {
        // ...
        constructor(loader) {
            // The file loader instance to use during the upload.
            this.loader = loader;
        }
        // Starts the upload process.
        upload() {
            return this.loader.file
                .then(file => new Promise((resolve, reject) => {
                    this._initRequest();
                    this._initListeners(resolve, reject, file);
                    this._sendRequest(file);
                }));
        }

        // Aborts the upload process.
        abort() {
            if (this.xhr) {
                this.xhr.abort();
            }
        }
        // Initializes the XMLHttpRequest object using the URL passed to the constructor.
        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();

            // Note that your request may look different. It is up to you and your editor
            // integration to choose the right communication channel. This example uses
            // a POST request with JSON as a data structure but your configuration
            // could be different.
            xhr.open('POST', "{{ route('admin.forum.image.store') }}", true);
            xhr.setRequestHeader('x-csrf-token', '{{csrf_token()}}');
            xhr.responseType = 'json';
        }

        // Initializes XMLHttpRequest listeners.
        _initListeners(resolve, reject, file) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${ file.name }.`;

            xhr.addEventListener('error', () => reject(genericErrorText));
            xhr.addEventListener('abort', () => reject());
            xhr.addEventListener('load', () => {
                const response = xhr.response;

                // This example assumes the XHR server's "response" object will come with
                // an "error" which has its own "message" that can be passed to reject()
                // in the upload promise.
                //
                // Your integration may handle upload errors in a different way so make sure
                // it is done properly. The reject() function must be called when the upload fails.
                if (!response || response.error) {
                    return reject(response && response.error ? response.error.message : genericErrorText);
                }

                // If the upload is successful, resolve the upload promise with an object containing
                // at least the "default" URL, pointing to the image on the server.
                // This URL will be used to display the image in the content. Learn more in the
                // UploadAdapter#upload documentation.
                resolve(response);
            });

            // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
            // properties which are used e.g. to display the upload progress bar in the editor
            // user interface.
            if (xhr.upload) {
                xhr.upload.addEventListener('progress', evt => {
                    if (evt.lengthComputable) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                });
            }
        }
        // Prepares the data and sends the request.
        _sendRequest(file) {
            // Prepare the form data.
            const data = new FormData();

            data.append('upload', file);

            // Important note: This is the right place to implement security mechanisms
            // like authentication and CSRF protection. For instance, you can use
            // XMLHttpRequest.setRequestHeader() to set the request headers containing
            // the CSRF token generated earlier by your application.

            // Send the request.
            this.xhr.send(data);
        }
    }
</script>
<script>
    document.querySelectorAll('oembed[url]').forEach(element => {
        // Create the <a href="..." class="embedly-card"></a> element that Embedly uses
        // to discover the media.
        const anchor = document.createElement('a');
        anchor.setAttribute('href', element.getAttribute('url'));
        anchor.className = 'embedly-card';
        element.appendChild(anchor);

    });
</script>
@endsection