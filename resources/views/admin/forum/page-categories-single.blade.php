@extends('layouts.forum-layout')
@section('content')
<main id="tt-pageContent">
    <div class="container">

        <div class="tt-catSingle-title">
            <div class="tt-innerwrapper tt-row">
                <div class="tt-col-left">
                    <ul class="tt-list-badge">
                        <li><a href="#"><span class="tt-color01 tt-badge">{{ session()->get('session_category_names') }}</span></a></li>
                    </ul>
                </div>
                <div class="ml-left tt-col-right">
                    <div class="tt-col-item">
                        <h2 class="tt-value"><a href="{{route('admin.forum.page-single-user')}}">{{ __('messages.threads') }}</a></h2>
                    </div>
                    <div class="tt-col-item">
                        <a href="#" class="tt-btn-icon">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-favorite"></use>
                                </svg></i>
                        </a>
                    </div>
                    <div class="tt-col-item">
                        <div class="tt-search">
                            <button class="tt-search-toggle" data-toggle="modal" data-target="#modalAdvancedSearch">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-search"></use>
                                </svg>
                            </button>
                            <form class="search-wrapper">
                                <div class="search-form">
                                    <input type="text" class="tt-search__input" placeholder="{{ __('messages.search_in _politics') }}">
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
                    </div>
                </div>
            </div>
            <div class="tt-innerwrapper">

            </div>
            <div class="tt-innerwrapper">
                <h6 class="tt-title"></h6>
                <ul class="tt-list-badge">
                    <li><a href="#"><span class=""></span></a></li>
                    <li><a href="#"><span class=""></span></a></li>
                    <li><a href="#"><span class=""></span></a></li>
                    <li><a href="#"><span class=""></span></a></li>
                    <li><a href="#"><span class=""></span></a></li>
                </ul>
            </div>
        </div>
        <div class="tt-topic-list">
            <div class="tt-list-header">
                <div class="tt-col-topic">{{ __('messages.topic') }}</div>
                <div class="tt-col-category">{{ __('messages.category') }}</div>
                <div class="tt-col-value hide-mobile">{{ __('messages.likes') }}</div>
                <div class="tt-col-value hide-mobile">{{ __('messages.replies') }}</div>
                <div class="tt-col-value hide-mobile">{{ __('messages.views') }}</div>
                <div class="tt-col-value">{{ __('messages.activity') }}</div>
            </div>
            @if(!empty($forum_category))
            @foreach($forum_category as $value)
            <div class="tt-item tt-itemselect">
                <div class="tt-col-avatar">
                    <img src="{{ config('constants.image_url').'/public/images/users/default.jpg' }}" class="mr-2 rounded-circle" height="40" />
                    {{ $value['user_name'] }}
                </div>
                <div class="tt-col-description">
                    <h6 class="tt-title"><a href="#">
                            <a href="{{route('admin.forum.page-single-topic-val',[$value['id'],$value['user_id']])}}">
                                {{ $value['topic_title'] }}
                            </a>
                        </a></h6>
                    <div class="row align-items-center no-gutters">
                        <div class="col-11">
                            <ul class="tt-list-badge">
                                <li class="show-mobile"><a href="#"><span class="tt-color01 tt-badge"></span></a></li>
                                <li><a href="#"><span class=""></span></a></li>
                                <li><a href="#"><span class=""></span></a></li>
                            </ul>
                        </div>
                        <div class="col-1 ml-auto show-mobile">
                            <div class="tt-value"></div>
                        </div>
                    </div>
                </div>
                <div class="tt-col-category"><span class="tt-color01 tt-badge">{{$value['category_names'] }}</span></div>
                <div class="tt-col-value hide-mobile">
                    @if($value['likes']=== null)
                    0
                    @else
                    {{$value['likes']}}
                    @endif
                </div>
                <div class="tt-col-value tt-color-select hide-mobile">
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
                </div>
            </div>
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
</main>
@endsection