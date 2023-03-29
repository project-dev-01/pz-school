@extends('layouts.forum-layout')
@section('content')
<link href="{{ asset('public/css/custom/common.css') }}" rel="stylesheet" type="text/css" />
<!-- <link href="{{ asset('public/css/custom/Responsive.css') }}" rel="stylesheet" type="text/css" /> -->
<link href="{{ asset('public/css/custom/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/css/custom/opensans-font.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    .nav-tabs {
        background-color: white;
    }

    .form-default .form-control {
        background: none;
        color: #1b2023;
        font-size: 16px;
        line-height: 25px;
        border: none;
        border-radius: 2px;
        border: 1px solid #929fa7;
        background-color: #F4F7FC;
    }

    .tt-button-icon {
        background-color: none;
        border-radius: 2px;
        border: 2px solid #e2e7ea;
        display: block;
        padding-top: 28px;
        padding-bottom: 19px;
        -webkit-transition: border 0.2s linear;
        transition: border 0.2s linear;
    }

    .tt-button-icon {
        background-color: none;
    }
    .tt-button-icon:hover, .tt-button-icon.active {
    border-color: #E9D528;
}
.ck-placeholder
{
    height:200px;
}
.select2-container .select2-search--inline .select2-search__field {
    box-sizing: border-box;
    border: none;
    font-size: 100%;
    margin-top: 12px;
    margin-left: 10px;
    padding: 0;
    max-width: 100%;
    resize: none;
    height: 21px;
    vertical-align: bottom;
    font-family: sans-serif;
    overflow: hidden;
    word-break: keep-all;
}
.select2-container--default .select2-selection--multiple {
    background-color: #F4F7FC;
}
.pt-editor .pt-title {
    color: #182730;
    font-weight: 600;
    font-size: 16px;
    /* line-height: 26px; */
    margin: 0px;
    padding: 0 0 0 0;
    letter-spacing: 0.01em;
}
.tt-topic-list .tt-list-header.tt-border-bottom
{
border-bottom: 1px solid #E9D528;
}
    .btn-blue {
    color: #fff;
    background-color: #4a81d4;
    border-color: #4a81d4;
    }
   .btn-danger {
    color: #fff;
    background-color: #f1556c;
    border-color: #f1556c;
    }

.btn i {
    font-size: 14px;
    color: white;
    font-family: Open Sans;
}

</style>
<main id="tt-pageContent">
    <div class="container card" style="background:white;">
        <div class="tt-wrapper-inner" id="createpostForumreset">
            <h1 class="tt-title-border" style="border-bottom: 1px solid #E9D528;">
               <label style="margin-top: 10px;">Create New Topic</label>
            </h1>
            <form class="form-default form-create-topic" id="createpostForum" method="post" action="{{ route('staff.forum.create-topic') }}" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label for="inputTopicTitle">Topic Title</label>
                    <div class="tt-value-wrapper">
                        <input type="text" name="inputTopicTitle" class="form-control" id="inputTopicTitle" placeholder="Subject of your topic">
                        <span class="tt-value-input"></span>
                    </div>
                    <div class="tt-note">Describe your topic well, while keeping the subject as short as possible.</div>
                </div>
                <div class="form-group" id="selectedtpy">
                    <input type="hidden" id="topictype" name="topictype">
                    <label>Topic Type</label>
                    <div class="tt-js-active-btn tt-wrapper-btnicon">
                        <div class="row tt-w410-col-02">
                            <div class="col-4 col-lg-3 col-xl-3">
                                <a href="#" class="tt-button-icon">
                                    <span class="tt-icon">
                                        <svg>
                                            <use xlink:href="#icon-discussion"></use>
                                        </svg>
                                    </span>
                                    <span class="tt-text">Discussion</span>
                                </a>
                            </div>
                            <div class="col-4 col-lg-3 col-xl-3">
                                <a href="#" class="tt-button-icon">
                                    <span class="tt-icon">
                                        <svg>
                                            <use xlink:href="#Question"></use>
                                        </svg>
                                    </span>
                                    <span class="tt-text">Question</span>
                                </a>
                            </div>
                            <div class="col-4 col-lg-3 col-xl-3">
                                <a href="#" class="tt-button-icon">
                                    <span class="tt-icon">
                                        <svg>
                                            <use xlink:href="#Poll"></use>
                                        </svg>
                                    </span>
                                    <span class="tt-text">Technology</span>
                                </a>
                            </div>
                            <!--  <div class="col-4 col-lg-3 col-xl-2">
                                <a href="#" class="tt-button-icon">
                                    <span class="tt-icon">
                                        <svg>
                                            <use xlink:href="#icon-gallery"></use>
                                        </svg>
                                    </span>
                                    <span class="tt-text">Gallery</span>
                                </a>
                            </div>
                            <div class="col-4 col-lg-3 col-xl-2">
                                <a href="#" class="tt-button-icon">
                                    <span class="tt-icon">
                                        <svg>
                                            <use xlink:href="#Video"></use>
                                        </svg>
                                    </span>
                                    <span class="tt-text">Video</span>
                                </a>
                            </div>-->
                            <div class="col-4 col-lg-3 col-xl-3">
                                <a href="#" class="tt-button-icon">
                                    <span class="tt-icon">
                                        <svg>
                                            <use xlink:href="#Others"></use>
                                        </svg>
                                    </span>
                                    <span class="tt-text">Other</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputTopicHeader">Topic Header</label>
                    <div class="tt-value-wrapper">
                        <input type="text" name="inputTopicHeader" class="form-control" id="inputTopicTitle" placeholder="Header of your topic">
                        <span class="tt-value-input"></span>
                    </div>
                    <div class="tt-note">Describe your topic header..</div>
                </div>
                <div class="pt-editor">
                    <h6 class="pt-title">Topic Body</h6>
                    <div class="">
                        <div class="">
                            <ul class="pt-edit-btn">
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">

                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">

                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">

                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">

                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">

                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">

                                        </svg>
                                    </button></li>
                                <li class="hr"></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">

                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">

                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">

                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">

                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">

                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">

                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">

                                        </svg>
                                    </button></li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="tpbody" id="tpbody" class="form-control" rows="5" placeholder="Lets get started" style="height:20px"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category" class="col-3 col-form-label">{{ __('messages.category') }}<span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <select id="getCountry" class="form-control" name="category">
                                        <option value="">Select category</option>
                                        @if(!empty($category))
                                        @foreach($category as $c)
                                        <option value="{{$c['id']}}">{{$c['category_names']}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8" style="width: 800px;margin:0 auto;">
                            <div class="form-group">
                                <label for="inputTopic" class="col-3 col-form-label">User</label>
                                <select name="tags[]" id="selectedusers" class="form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">>
                                    <option value=""></option>
                                    @foreach($usernames as $c)
                                    <option value="{{$c['id']}}">{{$c['name']}}</option>
                                    @endforeach

                                </select>
                                <!-- <input type="text" id="inputTopicTags" placeholder="" autocomplete="off" class="form-control input-lg" />
                                <input type="text" name="inputTopicTags" autocomplete="off" class="form-control" id="inputTopicTags" placeholder="Use comma to separate tags"> -->


                                <!-- <div id="userlist"></div> -->
                                <!-- For defining autocomplete -->
                                <!-- <select class="form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                                    <option value="">Choose Department</option>
                                    @if(!empty($usernames))
                                    @foreach($usernames as $value)
                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                    @endforeach
                                    @endif
                                </select>                                -->

                            </div>

                        </div>
                        <br>
                    </div>
                    <div class="row">
                        <div class="col-auto ml-md-auto">
                            <button type="submit" id="search" class="btn btn-secondary btn-width-lg">Create Post</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="tt-topic-list tt-offset-top-30">
            <div class="tt-list-search">
                <div class="tt-title">Suggested Topics</div>
                <!-- tt-search -->
                <div class="tt-search">
                    <form class="search-wrapper">
                        <div class="search-form">
                            <!-- <input type="text" class="tt-search__input" placeholder="Search for topics">
                            <button class="tt-search__btn" type="submit">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-search"></use>
                                </svg>
                            </button>
                            <button class="tt-search__close">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-cancel"></use>
                                </svg>
                            </button> -->
                        </div>
                    </form>
                </div>
                <!-- /tt-search -->
            </div>
<div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table class="table w-100 nowrap">
            <div class="tt-list-header tt-border-bottom">
                <div class="tt-col-topic">Topic</div>
                <div class="tt-col-category">{{ __('messages.category') }}</div>
                <div class="tt-col-value hide-mobile">Likes</div>
                <div class="tt-col-value hide-mobile">Replies</div>
                <div class="tt-col-value hide-mobile">Views</div>
                <div class="tt-col-value">Activity</div>
                <div class="tt-col-value">Action</div>
            </div>

            @if(!empty($forum_list))
            @php
            $randomcolor = 1;
            @endphp
            @foreach($forum_list as $value)
            @if($value['user_id']==$user_id)
                @php
                if($randomcolor==9)
                {
                $randomcolor = 1;
                }
                @endphp
                <div class="tt-item">
                    <div class="tt-col-avatar">
                        <!-- <svg class="tt-icon">
                            <use xlink:href="#icon-ava-n"></use>
                        </svg>-->
                        <img src="{{ asset('public/images/users/default.jpg') }}" class="mr-2 rounded-circle" height="40" />
                        {{ $value['user_name'] }}
                    </div>
                    <div class="tt-col-description">
                        <h6 class="tt-title">
                            <a href="{{route('staff.forum.page-single-topic-val',[$value['id'],$value['user_id']])}}">
                                {{ $value['topic_title'] }}
                            </a>
                        </h6>
                        <div class="row align-items-center no-gutters hide-desktope">
                            <div class="col-auto">
                                <ul class="tt-list-badge">
                                    <li class="show-mobile"><a href="#"><span class="tt-color05 tt-badge"></span></a></li>
                                </ul>
                            </div>
                            <div class="col-auto ml-auto show-mobile">
                                <div class="tt-value">1d</div>
                            </div>
                        </div>
                    </div>
                    <div class="tt-col-category"><span class="tt-color0{{$randomcolor}} tt-badge">{{$value['category_names'] }}</span></div>
                    <div class="tt-col-value hide-mobile">
                        @if($value['likes']=== null)
                        0
                        @else
                        {{$value['likes']}}
                        @endif
                    </div>
                    <div class="tt-col-value hide-mobile">
                        @if($value['replies']=== null)
                        0
                        @else
                        {{$value['replies']}}
                        @endif
                    </div>
                    <div class="tt-col-value hide-mobile">
                        @if($value['views']=== null)
                        0
                        @else
                        {{$value['views']}}
                        @endif
                    </div>
                    <div class="tt-col-value hide-mobile">
                        @php
                        echo App\Http\Controllers\CommonController::get_timeago(strtotime($value['created_at']));
                        @endphp
                        @if($value['activity']=== null)
                        0
                        @else
                        {{$value['activity']}}
                        @endif
                    </div>

                    <div class="tt-col-value" style="padding-right: 0px;padding-left: 0px;">
                        <div class="button-list">
                            <a href="{{route('staff.forum.page-edit-topic', $value['id'])}}" class="btn btn-blue waves-effect waves-light"><span class=""><i class="mdi mdi-square-edit-outline"></i></span></a>

                            <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="{{$value['id']}}" id="deletePostBtn"><span class=""><i class="mdi mdi-delete"></i></span></a>
                        </div>                                
                        
                    </div>
                </div>
                @php
                $randomcolor++;
                @endphp
            @endif
            @endforeach
            @endif
        </div>
    </div>
</table>
</div>
</div>
</div>
</main>
@endsection
@section('scripts')
<script>
    var indexPost = "{{ route('staff.forum.page-create-topic') }}";
    var deletePost = "{{ config('constants.api.forum_delete') }}";
</script>
<script src="{{ asset('public/js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('public/js/custom/forum-createpost.js') }}"></script>
<script>
    function SimpleUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            // Configure the URL to the upload script in your back-end here!
            return new MyUploadAdapter(loader);
        };
    }

    var myEditor;

    ClassicEditor
        .create(document.querySelector('#tpbody'), {
            extraPlugins: [SimpleUploadAdapterPlugin],

            // ...
        })
        .then(editor => {
            console.log('Editor was initialized', editor);
            myEditor = editor;
        })
        .catch(err => {
            console.error(err.stack);
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
            xhr.open('POST', "{{ route('staff.forum.image.store') }}", true);
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