@extends('layouts.forum-layout')
@section('content')
<main id="tt-pageContent">
    <div class="container">
        <div class="tt-single-topic-list">
            @if(!empty($forum_single_post))
            @foreach($forum_single_post as $value)
            <label hidden id="hdpkcount_details_id" name="hdpkcount_details_id">{{ $value['pkcount_details_id'] }}</label>
            <label hidden id="hdpk_post_id" name="hdpk_post_id">{{ $value['id'] }}</label>
            <div class="tt-item">
                <div class="tt-single-topic">
                    <div class="tt-item-header">
                        <div class="tt-item-info info-top">
                            <div class="tt-avatar-icon">
                                <i class="tt-icon">
                                    <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle" height="40" />

                                </i>
                            </div>
                            <div class="tt-avatar-title">
                                <a href="#">{{ $value['user_name'] }}</a>
                            </div>
                            <a href="#" class="tt-info-time">
                                <i class="tt-icon"><svg>
                                        <use xlink:href="#icon-time"></use>
                                    </svg></i>{{ $value['date'] }}
                            </a>
                        </div>
                        <h3 class="tt-item-title">
                            <a href="#">{{ $value['topic_title'] }}</a>
                        </h3>
                        <div class="tt-item-tag">
                            <ul class="tt-list-badge">
                                <li><a href="#"><span class="tt-color03 tt-badge">{{ $value['category_names'] }}</span></a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="tt-item-description">
                        <h6 class="tt-title">{{ $value['topic_header'] }}</h6> <br>                        
                            $value['body_content']                         
                    </div>
                    <div class="tt-item-info info-bottom">
                        <a href="#" class="tt-icon-btn" id="likes-iconhit">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-like"></use>
                                </svg></i>
                            <span class="tt-text inclike">
                                @if($value['likes']=== null)
                                0
                                @else
                                {{$value['likes']}}
                                @endif
                            </span>
                        </a>
                        <a href="#" class="tt-icon-btn" id="dislikes-iconhit">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-dislike"></use>
                                </svg></i>
                            <span class="tt-text incdislike">
                                @if($value['dislikes']=== null)
                                0
                                @else
                                {{$value['dislikes']}}
                                @endif
                            </span>
                        </a>
                        <a href="#" class="tt-icon-btn" id="heart-iconhit">
                            <i class="tt-icon">
                                <svg>
                                    <use xlink:href="#icon-favorite"></use>
                                </svg></i>
                            <span class="tt-text incheart">
                                @if($value['favorite']=== null)
                                0
                                @else
                                {{$value['favorite']}}
                                @endif
                            </span>
                        </a>
                        <a href="#" class="tt-icon-btn">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-view"></use>
                                </svg></i>
                            <span class="tt-text incviews">
                                @if($value['views']=== null)
                                0
                                @else
                                {{$value['views']}}
                                @endif
                            </span>

                        </a>
                        <div class="col-separator"></div>
                        <!--   <a href="#" class="tt-icon-btn tt-hover-02 tt-small-indent">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-share"></use>
                                </svg></i>
                        </a>
                        <a href="#" class="tt-icon-btn tt-hover-02 tt-small-indent">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-flag"></use>
                                </svg></i>
                        </a>
                        <a href="#" class="tt-icon-btn tt-hover-02 tt-small-indent">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-reply"></use>
                                </svg></i>
                        </a> -->
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            <!--Replies data binded in page load database-->
            @if (count($forum_singlepost_replies) >0)
            @forelse($forum_singlepost_replies as $value)
            <label hidden id="hdpk_replies_id" name="hdpk_replies_id">{{ $value['pk_replies_id'] }}</label>
            <label hidden id="hdpk_replies_count_id" name="hdpk_replies_count_id">{{ $value['pk_replies_count_id'] }}</label>
            <div class="tt-item">
                <div class="tt-single-topic">
                    <div class="tt-item-header pt-noborder">
                        <div class="tt-item-info info-top">
                            <div class="tt-avatar-icon">
                                <i class="tt-icon">
                                    <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle" height="40" />
                                </i>
                            </div>
                            <div class="tt-avatar-title">
                                <a href="#"> {{$value['user_name']}}</a>
                            </div>
                            <a href="#" class="tt-info-time">
                                <i class="tt-icon"><svg>
                                        <use xlink:href="#icon-time"></use>
                                    </svg></i>{{$value['date']}}
                            </a>
                        </div>
                    </div>
                    <div class="tt-item-description">
                        {{$value['replies_com']}}
                    </div>
                    <div class="tt-item-info info-bottom">
                        <a href="javescript:void(0)" class="tt-icon-btn rep-likes-iconhit" data-id="{{$value['pk_replies_id']}}">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-like"></use>
                                </svg></i>
                            <span class="tt-text repinclikes{{$value['pk_replies_id']}}">
                                @if($value['likes']=== null)
                                0
                                @else
                                {{$value['likes']}}
                                @endif
                            </span>
                        </a>
                        <a href="javescript:void(0)" class="tt-icon-btn rep-dislikes-iconhit" data-id="{{$value['pk_replies_id']}}">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-dislike"></use>
                                </svg></i>
                            <span class="tt-text repincdislikes{{$value['pk_replies_id']}}">
                                @if($value['dislikes']=== null)
                                0
                                @else
                                {{$value['dislikes']}}
                                @endif
                            </span>
                        </a>
                        <a href="#" class="tt-icon-btn rep-favorite-iconhit" data-id="{{$value['pk_replies_id']}}">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-favorite"></use>
                                </svg></i>
                            <span class="tt-text repincfav{{$value['pk_replies_id']}}">
                                @if($value['favorits']=== null)
                                0
                                @else
                                {{$value['favorits']}}
                                @endif
                            </span>
                        </a>
                        <div class="col-separator"></div>
                    </div>
                </div>
            </div>
            @empty
            @endforelse
            @else
            <div></div>
            @endif
            <!--Instant Replies data only binded-->
            <form id="repliesjsvs" class="tt-item">
                <div id="repliesapply">
                </div>
            </form>

        </div>
        <div class="tt-wrapper-inner">
            <h4 class="tt-title-separator"><span>You’ve reached the end of replies</span></h4>
        </div>

        <div class="tt-wrapper-inner">
            <div class="pt-editor form-default">
                <h6 class="pt-title">Post Your Reply</h6>
                <div class="pt-row">
                    <div class="col-left">
                        
                    </div>
                    <div class="col-right tt-hidden-mobile">
              
                    </div>
                </div>
                <div class="form-group">
                    <textarea name="repliesinput" class="form-control" rows="5" id="repliesinput" placeholder="Lets get started"></textarea>           
                </div>
                <div class="pt-row">
                    <div class="col-auto">

                    </div>
                    <div class="col-auto">
                        <a href="#" class="btn btn-secondary btn-width-lg" id="postreplie">Reply</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tt-topic-list tt-offset-top-30">
            <div class="tt-list-search">
                <div class="tt-title">Suggested Topics</div>
                <!-- tt-search 
                <div class="tt-search">
                    <form class="search-wrapper">
                        <div class="search-form">
                            <input type="text" class="tt-search__input" id="listfilter" placeholder="Search for topics">
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
                </div>-->
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
            @php
            $randomcolor = 1;
            @endphp
            @foreach($forum_list as $value)
            @php           
            if($randomcolor==9)
            {
                $randomcolor = 1;
            }
            @endphp
            <div class="tt-item"  id="usnames">
                <div class="tt-col-avatar flvalues">
                    <!-- <svg class="tt-icon">
                        <use xlink:href="#icon-ava-n"></use>
                    </svg>-->
                    <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle" height="40" />
                    {{ $value['user_name'] }}
                </div>
                <div class="tt-col-description flvalues">
                    <h6 class="tt-title">
                        <a href="{{route('teacher.forum.page-single-topic-val',[$value['id'],$value['user_id']])}}">
                            {{ $value['topic_title'] }}
                        </a>
                    </h6>                
                </div>
                <div class="tt-col-category flvalues">
                    <span class="tt-color0{{$randomcolor}} tt-badge">{{$value['category_names'] }}</span>
                </div>
                <div class="tt-col-value hide-mobile flvalues">
                    @if($value['likes']=== null)
                    0
                    @else
                    {{$value['likes']}}
                    @endif
                </div>
                <div class="tt-col-value hide-mobile flvalues">
                    @if($value['replies']=== null)
                    0
                    @else
                    {{$value['replies']}}
                    @endif
                </div>
                <div class="tt-col-value hide-mobile flvalues">
                    @if($value['views']=== null)
                    0
                    @else
                    {{$value['views']}}
                    @endif
                </div>
                <div class="tt-col-value hide-mobile flvalues">
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
<script src="{{ asset('js/custom/forum-post-countsothers.js') }}"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#repliesinput'))
        .catch(error => {
            console.error(error);
        });
</script>
<script> 
    CKEDITOR.replace('message');
</script>
@endsection