@extends('layouts.forum-layout')
@section('content')
<main id="tt-pageContent">
    <div class="container">
        <div class="tt-wrapper-inner" id="createpostForumreset">
            <h1 class="tt-title-border">
                Create New Topic
            </h1>
            <form class="form-default form-create-topic" id="createpostForum" method="post" action="{{ route('admin.forum.create-topic') }}">

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
                            <div class="col-4 col-lg-3 col-xl-2">
                                <a href="#" class="tt-button-icon">
                                    <span class="tt-icon">
                                        <svg>
                                            <use xlink:href="#icon-discussion"></use>
                                        </svg>
                                    </span>
                                    <span class="tt-text">Discussion</span>
                                </a>
                            </div>
                            <div class="col-4 col-lg-3 col-xl-2">
                                <a href="#" class="tt-button-icon">
                                    <span class="tt-icon">
                                        <svg>
                                            <use xlink:href="#Question"></use>
                                        </svg>
                                    </span>
                                    <span class="tt-text">Question</span>
                                </a>
                            </div>
                            <div class="col-4 col-lg-3 col-xl-2">
                                <a href="#" class="tt-button-icon">
                                    <span class="tt-icon">
                                        <svg>
                                            <use xlink:href="#Poll"></use>
                                        </svg>
                                    </span>
                                    <span class="tt-text">Poll</span>
                                </a>
                            </div>
                            <div class="col-4 col-lg-3 col-xl-2">
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
                            </div>
                            <div class="col-4 col-lg-3 col-xl-2">
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
                <div class="pt-editor">
                    <h6 class="pt-title">Topic Body</h6>
                    <div class="pt-row">
                        <div class="col-left">
                            <ul class="pt-edit-btn">
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">
                                            <use xlink:href="#icon-quote"></use>
                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">
                                            <use xlink:href="#icon-bold"></use>
                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">
                                            <use xlink:href="#icon-italic"></use>
                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">
                                            <use xlink:href="#icon-share_topic"></use>
                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">
                                            <use xlink:href="#icon-blockquote"></use>
                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">
                                            <use xlink:href="#icon-performatted"></use>
                                        </svg>
                                    </button></li>
                                <li class="hr"></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">
                                            <use xlink:href="#icon-upload_files"></use>
                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">
                                            <use xlink:href="#icon-bullet_list"></use>
                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">
                                            <use xlink:href="#icon-heading"></use>
                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">
                                            <use xlink:href="#icon-horizontal_line"></use>
                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">
                                            <use xlink:href="#icon-emoticon"></use>
                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">
                                            <use xlink:href="#icon-settings"></use>
                                        </svg>
                                    </button></li>
                                <li><button type="button" class="btn-icon">
                                        <svg class="tt-icon">
                                            <use xlink:href="#icon-color_picker"></use>
                                        </svg>
                                    </button></li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="tpbody" id="tpbody" class="form-control" rows="5" placeholder="Lets get started"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category" class="col-3 col-form-label">Category<span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <select id="getCountry" class="form-control" name="category">
                                        <option value="">Select category</option>
                                        @foreach($category as $c)
                                        <option value="{{$c['id']}}">{{$c['category_names']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="inputTopicTags">Tags</label>
                                <input type="text" name="inputTopicTags" class="form-control" id="inputTopicTags" placeholder="Use comma to separate tags">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto ml-md-auto">
                            <button type="submit" class="btn btn-secondary btn-width-lg">Create Post</button>
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
                            <input type="text" class="tt-search__input" placeholder="Search for topics">
                            <button class="tt-search__btn" type="submit">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-search"></use>
                                </svg>
                            </button>
                            <button class="tt-search__close">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-cancel"></use>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /tt-search -->
            </div>
            <div class="tt-list-header tt-border-bottom">
                <div class="tt-col-topic">Topic</div>
                <div class="tt-col-category">Category</div>
                <div class="tt-col-value hide-mobile">Likes</div>
                <div class="tt-col-value hide-mobile">Replies</div>
                <div class="tt-col-value hide-mobile">Views</div>
                <div class="tt-col-value">Activity</div>
            </div>
            @if(!empty($forum_list))
            @foreach($forum_list as $value)
            <div class="tt-item">
                <div class="tt-col-avatar">
                    <svg class="tt-icon">
                        <use xlink:href="#icon-ava-n"></use>
                    </svg>
                </div>
                <div class="tt-col-description">
                    <h6 class="tt-title"><a href="javascript:void()">
                            {{ $value['topic_title'] }}
                        </a></h6>
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
                <div class="tt-col-category"><span class="tt-color05 tt-badge">{{ $value['category'] }}</span></div>
                <div class="tt-col-value hide-mobile">358</div>
                <div class="tt-col-value tt-color-select hide-mobile">68</div>
                <div class="tt-col-value hide-mobile">8.3k</div>
                <div class="tt-col-value hide-mobile">1d</div>
            </div>
            @endforeach
            @endif
            <div class="tt-row-btn">
                <button type="button" class="btn-icon js-topiclist-showmore">
                    <svg class="tt-icon">
                        <use xlink:href="#icon-load_lore_icon"></use>
                    </svg>
                </button>
            </div>
        </div>  
    </div>
</main>
@endsection
@section('scripts')
<script src="{{ asset('js/custom/forum-createpost.js') }}"></script>
@endsection
