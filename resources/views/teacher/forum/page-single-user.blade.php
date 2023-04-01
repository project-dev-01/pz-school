@extends('layouts.forum-layout')
@section('content')
<main id="tt-pageContent" class="tt-offset-small">
    <div class="tt-wrapper-section">
        <div class="container">
            <div class="tt-user-header">
                <div class="tt-col-avatar">
                    <div class="tt-icon">
                        <svg class="tt-icon">
                            <use xlink:href="#icon-ava-t"></use>
                        </svg>
                    </div>
                </div>
                <div class="tt-col-title">
                    <div class="tt-title">
                        <a href="#">{{ session()->get('name') }}</a>
                    </div>
                    <ul class="tt-list-badge">
                        <li><a href="#"><span class="tt-color14"></span></a></li>
                    </ul>
                </div>
                <div class="tt-col-btn" id="js-settings-btn">
                    <div class="tt-list-btn">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="tt-tab-wrapper">
            <div class="tt-wrapper-inner">
                <ul class="nav nav-tabs pt-tabs-default" role="tablist">
                    <li class="nav-item show">
                        <a class="nav-link active" data-toggle="tab" href="#tt-tab-01" role="tab"><span>{{ __('messages.activity') }}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-02" role="tab"><span>{{ __('messages.threads') }}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-03" role="tab"><span>{{ __('messages.replies') }}</span></a>
                    </li>
                    <li class="nav-item tt-hide-md">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-06" role="tab"><span>{{ __('messages.categories') }}</span></a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane tt-indent-none  show active" id="tt-tab-01" role="tabpanel">
                    <div class="tt-topic-list">
                        <div class="tt-list-header">
                            <div class="tt-col-topic">{{ __('messages.topic') }}</div>
                            <div class="tt-col-category">{{ __('messages.category') }}</div>
                            <div class="tt-col-value">{{ __('messages.activity') }}</div>
                        </div>
                        @if(!empty($forum_post_user_crd))
                        @php
                        $randomcolor = 1;
                        @endphp
                        @foreach($forum_post_user_crd as $value)
                        @php
                        if($randomcolor==9)
                        {
                        $randomcolor = 1;
                        }
                        @endphp
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <img src="{{ asset('public/images/users/default.jpg') }}" class="mr-2 rounded-circle" height="40" />
                                {{ $value['user_name'] }}
                            </div>
                            <div class="tt-col-description">
                                <h4 class="tt-title">
                                    <a href="{{route('teacher.forum.page-single-topic-val',[$value['id'],$value['user_id']])}}">
                                        {{ $value['topic_title'] }}
                                    </a>
                                </h4>
                                <div class="tt-col-message">

                                </div>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#">
                                                    <span class="tt-color0{{$randomcolor}} tt-badge">{{$value['category_names'] }}</span>
                                                </a></li>
                                        </ul>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">
                                            @php
                                            echo App\Http\Controllers\CommonController::get_timeago(strtotime($value['created_at']));
                                            @endphp
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category"><span class="tt-color0{{$randomcolor}} tt-badge">{{$value['category_names'] }}</span></div>
                            <div class="tt-col-value hide-mobile">
                                @php
                                echo App\Http\Controllers\CommonController::get_timeago(strtotime($value['created_at']));
                                @endphp
                            </div>
                        </div>
                        @php
                        $randomcolor++;
                        @endphp
                        @endforeach
                        @endif
                        <!-- <div class="tt-row-btn">
                            <button type="button" class="btn-icon js-topiclist-showmore">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-load_lore_icon"></use>
                                </svg>
                            </button>
                        </div> -->
                    </div>
                </div>
                <div class="tab-pane tt-indent-none" id="tt-tab-02" role="tabpanel">
                    <div class="tt-topic-list">
                        <div class="tt-list-header">
                            <div class="tt-col-topic">{{ __('messages.topic') }}</div>
                            <div class="tt-col-category">{{ __('messages.category') }}</div>
                            <div class="tt-col-value">{{ __('messages.activity') }}</div>
                            <div class="tt-col-value">Status</div>
                        </div>
                        @if(!empty($forum_userthreadslist))
                        @php
                        $randomcolor = 1;
                        @endphp
                        @foreach($forum_userthreadslist as $value)
                        @php
                        if($randomcolor==9)
                        {
                        $randomcolor = 1;
                        }
                        @endphp
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <img src="{{ asset('public/images/users/default.jpg') }}" class="mr-2 rounded-circle" height="40" />
                                {{ $value['user_name'] }}
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title">
                                    <a href="{{route('teacher.forum.page-single-topic-val',[$value['id'],$value['user_id']])}}">
                                        {{ $value['topic_title'] }}
                                    </a>
                                </h6>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-11">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color0{{$randomcolor}} tt-badge"></span></a></li>
                                            <li><a href="#"><span class=""></span></a></li>
                                            <li><a href="#"><span class=""></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-1 ml-auto show-mobile">
                                        <div class="tt-value">1h</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category"><span class="tt-color0{{$randomcolor}} tt-badge">{{$value['category_names'] }}</span></div>



                            <div class="tt-col-value hide-mobile">
                                @php
                                echo App\Http\Controllers\CommonController::get_timeago(strtotime($value['created_at']));
                                @endphp
                            </div>
                            <div class="tt-col-value hide-mobile">
                                <h4 class="tt-title">
                                    @if($value['threads_status']=== 1)
                                    <span class="tt-color05 tt-badge">Pending</span>
                                    @elseif($value['threads_status']=== 2)
                                    <span class="tt-color13 tt-badge">Active</span>
                                    @elseif($value['threads_status']=== 3)
                                    <span class="tt-color08 tt-badge">Decline</span>
                                    @endif
                                </h4>
                            </div>
                        </div>
                        @php
                        $randomcolor++;
                        @endphp
                        @endforeach
                        @endif
                        <!-- <div class="tt-row-btn">
                            <button type="button" class="btn-icon js-topiclist-showmore">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-load_lore_icon"></use>
                                </svg>
                            </button>
                        </div> -->
                    </div>
                </div>
                <div class="tab-pane tt-indent-none" id="tt-tab-03" role="tabpanel">

                    <div class="tt-topic-list">
                        <div class="tt-list-header">
                            <div class="tt-col-topic">{{ __('messages.topic') }}</div>
                            <div class="tt-col-category">{{ __('messages.category') }}</div>
                            <div class="tt-col-value">{{ __('messages.activity') }}</div>
                        </div>
                        @if(!empty($forum_post_user_allreplies))
                        @php
                        $randomcolor = 1;
                        @endphp
                        @foreach($forum_post_user_allreplies as $value)
                        @php
                        if($randomcolor==9)
                        {
                        $randomcolor = 1;
                        }
                        @endphp
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-a"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title">
                                    <a href="{{route('teacher.forum.page-single-topic-val',[$value['created_post_id'],$value['user_id']])}}">
                                        {{ $value['topic_title'] }}
                                    </a>

                                </h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color06 tt-badge">Exam</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">5 Jan,21</div>
                                    </div>
                                </div>
                                <div class="tt-content">
                                    {!! $value['replies_com'] !!}
                                </div>
                            </div>
                            <div class="tt-col-category"><a href="#"><span class="tt-color0{{$randomcolor}} tt-badge">{{$value['category_names']}}</span></a></div>
                            <div class="tt-col-value-large hide-mobile">
                                @php
                                echo App\Http\Controllers\CommonController::get_timeago(strtotime($value['created_at']));
                                @endphp
                            </div>
                        </div>
                        @php
                        $randomcolor++;
                        @endphp
                        @endforeach
                        @endif
                        <!-- <div class="tt-row-btn">
                            <button type="button" class="btn-icon js-topiclist-showmore">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-load_lore_icon"></use>
                                </svg>
                            </button>
                        </div> -->
                    </div>

                </div>

                <div class="tab-pane" id="tt-tab-06" role="tabpanel">
                    <div class="tt-wrapper-inner">
                        <div class="tt-categories-list">
                            <div class="row">
                                @if(!empty($forum_categorypost_user_crd))
                                @php
                                $randomcolor = 1;
                                @endphp
                                @foreach($forum_categorypost_user_crd as $value)
                                @php
                                if($randomcolor==9)
                                {
                                $randomcolor = 1;
                                }
                                @endphp
                                <div class="col-md-6 col-lg-4">
                                    <div class="tt-item">
                                        <div class="tt-item-header">
                                            <ul class="tt-list-badge">
                                                <li><a href="{{route('teacher.forum.page-categories-single-val',[$value['categId'],$value['user_id'],$value['category_names']])}}">
                                                        <span class="tt-color0{{$randomcolor}} tt-badge">
                                                            @php
                                                            echo App\Http\Controllers\CommonController::limitedChar_category(($value['category_names']));
                                                            @endphp
                                                    </a></li>
                                            </ul>
                                            <h4 class="tt-title"><a href="{{route('parent.forum.page-single-user')}}">{{ __('messages.threads') }}</a></h4>
                                        </div>
                                        <div class="tt-item-layout">
                                            <div class="tt-innerwrapper">
                                                @php
                                                echo App\Http\Controllers\CommonController::limitedChar(($value['topic_header']));
                                                @endphp
                                            </div>
                                            <div class="tt-innerwrapper">
                                                <a href="#" class="tt-btn-icon">
                                                    <i class="tt-icon"><svg>
                                                            <use xlink:href="#icon-favorite"></use>
                                                        </svg></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                $randomcolor++;
                                @endphp
                                @endforeach
                                @endif
                                <div class="col-12">
                                    <div class="tt-row-btn">
                                        <button type="button" class="btn-icon js-topiclist-showmore">
                                            <svg class="tt-icon">
                                                <use xlink:href="#icon-load_lore_icon"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('scripts')
<script src="{{ asset('public/js/custom/threads-post-approvel.js') }}"></script>
@endsection