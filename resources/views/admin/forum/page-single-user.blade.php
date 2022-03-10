@extends('layouts.forum-layout')
@section('content')
<main id="tt-pageContent" class="tt-offset-small">
    <div class="tt-wrapper-section">
        <div class="container">
            <div class="tt-user-header">
                <div class="tt-col-avatar">
                    <div class="tt-icon">
                        <svg class="tt-icon">
                            <use xlink:href="#icon-ava-a"></use>
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
                        <a class="nav-link active" data-toggle="tab" href="#tt-tab-01" role="tab"><span>Activity</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-02" role="tab"><span>Threads</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-03" role="tab"><span>Replies</span></a>
                    </li>
                    <li class="nav-item tt-hide-md">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-06" role="tab"><span>Categories</span></a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane tt-indent-none  show active" id="tt-tab-01" role="tabpanel">
                    <div class="tt-topic-list">
                        <div class="tt-list-header">
                            <div class="tt-col-topic">Topic</div>
                            <div class="tt-col-category">Category</div>
                            <div class="tt-col-value">Activity</div>
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
                                <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle" height="40" />
                                {{ $value['user_name'] }}
                            </div>
                            <div class="tt-col-description">
                                <h4 class="tt-title">
                                    <a href="{{route('admin.forum.page-single-topic-val',[$value['id'],$value['user_id']])}}">
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
                            <div class="tt-col-category"><span class="tt-color0{{$randomcolor}}  tt-badge">{{$value['category_names'] }}</span></div>
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
                        <div class="tt-row-btn">
                            <button type="button" class="btn-icon js-topiclist-showmore">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-load_lore_icon"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane tt-indent-none" id="tt-tab-02" role="tabpanel">
                    <div class="tt-topic-list">
                        <div class="tt-list-header">
                            <div class="tt-col-topic">Topic</div>
                            <div class="tt-col-category">Category</div>
                            <div class="tt-col-value hide-mobile">Likes</div>
                            <div class="tt-col-value hide-mobile">Replies</div>
                            <div class="tt-col-value hide-mobile">Views</div>
                            <div class="tt-col-value">Activity</div>
                        </div>
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
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle" height="40" />

                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">

                                    </a></h6>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-11">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color01 tt-badge">Study Hacks</span></a></li>
                                            <li><a href="#"><span class="tt-badge">Study</span></a></li>
                                            <li><a href="#"><span class="tt-badge">University</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-1 ml-auto show-mobile">
                                        <div class="tt-value">1h</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category"><span class="tt-color01 tt-badge">Study Hacks</span></div>
                            <div class="tt-col-value hide-mobile">985</div>
                            <div class="tt-col-value tt-color-select  hide-mobile">502</div>
                            <div class="tt-col-value hide-mobile">15.1k</div>
                            <div class="tt-col-value hide-mobile">1h</div>
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
                <div class="tab-pane tt-indent-none" id="tt-tab-03" role="tabpanel">

                    <div class="tt-topic-list">
                        <div class="tt-list-header">
                            <div class="tt-col-topic">Topic</div>
                            <div class="tt-col-category">Category</div>
                            <div class="tt-col-value">Activity</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Tips For Exams - Before The Exam?
                                    </a></h6>
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
                                    Staying up until 3 am figuring out how to do question 17 of a 2011 mock exam from a school you've never heard of is not going to help you in your 9 am final exam.
                                </div>
                            </div>
                            <div class="tt-col-category"><a href="#"><span class="tt-color06 tt-badge">Study</span></a></div>
                            <div class="tt-col-value-large hide-mobile">15 Jan,21</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        How do you motivate yourself ?
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color15 tt-badge">Motivation</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">6 Jan,21</div>
                                    </div>
                                </div>
                                <div class="tt-content">
                                    Not really a motivation, but a threat to myself if I don't do any work. Here's a flowchart of what's going on inside my head.
                                </div>
                            </div>
                            <div class="tt-col-category"><a href="#"><span class="tt-color15 tt-badge">Motivation</span></a></div>
                            <div class="tt-col-value-large hide-mobile">7 Jan,21</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Study Tip - Japanese
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color05 tt-badge">Teacher</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">8 Jan,21</div>
                                    </div>
                                </div>
                                <div class="tt-content">
                                    Japanese Kanji is so hard to remember, let alone write :')In school, we got given a booklet, where it'd show the kanji, then its hiragana/romaji. They created the book so that each kanji represented an object/picture
                                </div>
                            </div>
                            <div class="tt-col-category"><a href="#"><span class="tt-color05 tt-badge">Teacher</span></a></div>
                            <div class="tt-col-value-large hide-mobile">9 Jan,21</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Are there alternatives to "normal" study times when doing a certificate course?
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color05 tt-badge">Childcare & Training</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">5 Jan,19</div>
                                    </div>
                                </div>
                                <div class="tt-content">
                                    I would love to do a Certificate III in Child Care next year, but my school doesn't offer it and I'm doing ATAR so my career counselor doesn't think it would be a good idea to do one day at TAFE instead of high school each week.
                                </div>
                            </div>
                            <div class="tt-col-category"><a href="#"><span class="tt-color05 tt-badge">Childcare & Training</span></a></div>
                            <div class="tt-col-value-large hide-mobile">5 Jan,19</div>
                        </div>
                        <div class="tt-row-btn">
                            <button type="button" class="btn-icon js-topiclist-showmore">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-load_lore_icon"></use>
                                </svg>
                            </button>
                        </div>
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
                                                <li><a href="{{route('admin.forum.page-categories-single-val',[$value['categId'],$value['user_id'],$value['category_names']])}}">
                                                        <span class="tt-color0{{$randomcolor}} tt-badge">
                                                            @php
                                                            echo App\Http\Controllers\CommonController::limitedChar_category(($value['category_names']));
                                                            @endphp
                                                    </a></li>
                                            </ul>
                                            <h4 class="tt-title"><a href="page-categories-single.html">Threads-1,245</a></h4>
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