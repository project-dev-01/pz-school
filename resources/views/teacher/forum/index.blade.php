@extends('layouts.forum-layout')
@section('content')
<main id="tt-pageContent" class="tt-offset-small">
    <div class="container">
        <div class="tt-topic-list">
            <div class="tt-list-header">
          <!--  <div class="ftt-col-topic">User</div> -->
                <div class="tt-col-topic">{{ __('messages.topic') }}</div>
                <div class="tt-col-category">{{ __('messages.category') }}</div>
                <div class="tt-col-value hide-mobile">{{ __('messages.likes') }}</div>
                <div class="tt-col-value hide-mobile">{{ __('messages.replies') }}</div>
                <div class="tt-col-value hide-mobile">{{ __('messages.views') }}</div>
                <div class="tt-col-value">{{ __('messages.activity') }}</div>
            </div>
            <div class="tt-topic-alert tt-alert-default" role="alert">
                <!-- <a href="#" target="_blank">4 new posts</a> are added recently, click here to load them.-->
            </div>
            @if (count($forum_list) >0)
            @php
            $randomcolor = 1;
            @endphp
            @forelse($forum_list as $value)
            @php
            if($randomcolor==9)
            {
            $randomcolor = 1;
            }
            @endphp
            <div class="tt-item tt-itemselect">
                <div class="tt-col-avatar">
                    <img src="{{ config('constants.image_url').'/public/common-asset/images/users/default.jpg' }}" class="mr-2 rounded-circle" height="40" />
                    {{ $value['user_name'] }}
                </div>
                <div class="tt-col-description">
                    <h6 class="tt-title">
                        <a href="{{route('teacher.forum.page-single-topic-val',[$value['id'],$value['user_id']])}}">
                            {{ $value['topic_title'] }}
                        </a>
                    </h6>
                    <div class="row align-items-center no-gutters">

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
            @php
            $randomcolor++;
            @endphp
            @empty 
            @endforelse
            @else
            <div> {{ __('messages.no_records_found') }}</div>
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