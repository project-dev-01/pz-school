@extends('layouts.forum-layout')
@section('content')
<main id="tt-pageContent" class="tt-offset-small">
    <div class="container">
        <div class="tt-topic-list">
            <div class="tt-list-header">
                <div class="tt-col-topic">Topic</div>
                <div class="tt-col-category">Category</div>
                <div class="tt-col-value hide-mobile">Likes</div>
                <div class="tt-col-value hide-mobile">Replies</div>
                <div class="tt-col-value hide-mobile">Views</div>
                <div class="tt-col-value">Activity</div>
            </div>
            <div class="tt-topic-alert tt-alert-default" role="alert">
                <a href="#" target="_blank">4 new posts</a> are added recently, click here to load them.
            </div>         
            @if (count($forum_list) >0)
            @forelse($forum_list as $value)
            <div class="tt-item tt-itemselect">
                <div class="tt-col-avatar">
                <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle" height="40" />
                            {{ $value['user_name'] }}
                </div>
                <div class="tt-col-description">
                    <h6 class="tt-title">
                    <a href="{{route('admin.forum.page-single-topic-val',[$value['id'],$value['user_id']])}}"> 
                         
                            {{ $value['topic_title'] }}
                        </a></h6>
                    <div class="row align-items-center no-gutters">
   
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
                @if($value['activity']=== null) 
                    0
                    @else
                    {{$value['activity']}}
                    @endif   
                </div>
            </div>
            @empty         
            @endforelse
            @else
            <div></div>
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