@extends('layouts.forum-layout')
@section('content')
<main id="tt-pageContent">
    <div class="container">
        <div class="tt-single-topic-list">

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
                                <li><a href="#"><span class="tt-color03 tt-badge">Career Advice</span></a></li>
                                <li><a href="#"><span class="tt-badge">Help</span></a></li>
                                <li><a href="#"><span class="tt-badge">Job</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="tt-item-description">
                        <h6 class="tt-title">{{ $value['topic_header'] }}</h6> <br>
                        <p>
                            {{ $value['body_content'] }}
                        </p>
                    </div>
                    <div class="tt-item-info info-bottom">
                        <a href="#" class="tt-icon-btn" id="likes-iconhit" >
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
                        <a href="#" class="tt-icon-btn" id="dislikes-iconhit" >
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
                        <a href="#" class="tt-icon-btn" id="heart-iconhit" >
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
            <div class="tt-item">
                <div class="tt-single-topic">
                    <div class="tt-item-header pt-noborder">
                        <div class="tt-item-info info-top">
                            <div class="tt-avatar-icon">
                                <i class="tt-icon"><svg>
                                        <use xlink:href="#icon-ava-t"></use>
                                    </svg></i>
                            </div>
                            <div class="tt-avatar-title">
                                <a href="#">tesla02</a>
                            </div>
                            <a href="#" class="tt-info-time">
                                <i class="tt-icon"><svg>
                                        <use xlink:href="#icon-time"></use>
                                    </svg></i>18 Jan,2022
                            </a>
                        </div>
                    </div>
                    <div class="tt-item-description">
                        Finally!<br>
                        I'm planning on going to uni and studying Astronomy.
                    </div>
                    <div class="tt-item-info info-bottom">
                        <a href="#" class="tt-icon-btn">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-like"></use>
                                </svg></i>
                            <span class="tt-text">671</span>
                        </a>
                        <a href="#" class="tt-icon-btn">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-dislike"></use>
                                </svg></i>
                            <span class="tt-text">39</span>
                        </a>
                        <a href="#" class="tt-icon-btn">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-favorite"></use>
                                </svg></i>
                            <span class="tt-text">12</span>
                        </a>
                        <div class="col-separator"></div>
                        <a href="#" class="tt-icon-btn tt-hover-02 tt-small-indent">
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
                        </a>
                    </div>
                </div>
            </div>
            <div class="tt-item">
                <div class="tt-single-topic">
                    <div class="tt-item-header pt-noborder">
                        <div class="tt-item-info info-top">
                            <div class="tt-avatar-icon">
                                <i class="tt-icon"><svg>
                                        <use xlink:href="#icon-ava-k"></use>
                                    </svg></i>
                            </div>
                            <div class="tt-avatar-title">
                                <a href="#">kolis27</a>
                            </div>
                            <a href="#" class="tt-info-time">
                                <i class="tt-icon"><svg>
                                        <use xlink:href="#icon-time"></use>
                                    </svg></i>17 Jan,2022
                            </a>
                        </div>
                    </div>
                    <div class="tt-item-description">
                        <p>
                            I'm going to uni and studying archaeology and studies of religion (like the historical, analytical view of religion, not bible studies)
                        </p>
                        <p>
                            <img class="tt-offset-11" src="images/single-topic-img01.jpg" alt="">
                        </p>
                    </div>
                    <div class="tt-item-info info-bottom">
                        <a href="#" class="tt-icon-btn">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-like"></use>
                                </svg></i>
                            <span class="tt-text">671</span>
                        </a>
                        <a href="#" class="tt-icon-btn">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-dislike"></use>
                                </svg></i>
                            <span class="tt-text">39</span>
                        </a>
                        <a href="#" class="tt-icon-btn">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-favorite"></use>
                                </svg></i>
                            <span class="tt-text">12</span>
                        </a>
                        <div class="col-separator"></div>
                        <a href="#" class="tt-icon-btn tt-hover-02 tt-small-indent">
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
                        </a>
                    </div>
                </div>
            </div>
            <div class="tt-item">
                <div class="tt-single-topic">
                    <div class="tt-item-header pt-noborder">
                        <div class="tt-item-info info-top">
                            <div class="tt-avatar-icon">
                                <i class="tt-icon"><svg>
                                        <use xlink:href="#icon-ava-k"></use>
                                    </svg></i>
                            </div>
                            <div class="tt-avatar-title">
                                <a href="#">kolis27</a>
                            </div>
                            <a href="#" class="tt-info-time">
                                <i class="tt-icon"><svg>
                                        <use xlink:href="#icon-time"></use>
                                    </svg></i>16 Jan,2022
                            </a>
                        </div>
                    </div>
                    <div class="tt-item-description">
                        <p>
                            Go join the Royal Australian Air Force, spend a couple of years learning to fly and hopefully fly a fighter jet, (preferred) but if I do fly the other aircrafts, that is fine too. That is if I can even get to such a level!
                        </p>
                    </div>
                    <div class="tt-item-info info-bottom">
                        <a href="#" class="tt-icon-btn">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-like"></use>
                                </svg></i>
                            <span class="tt-text">671</span>
                        </a>
                        <a href="#" class="tt-icon-btn">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-dislike"></use>
                                </svg></i>
                            <span class="tt-text">39</span>
                        </a>
                        <a href="#" class="tt-icon-btn">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-favorite"></use>
                                </svg></i>
                            <span class="tt-text">12</span>
                        </a>
                        <div class="col-separator"></div>
                        <a href="#" class="tt-icon-btn tt-hover-02 tt-small-indent">
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
                        </a>
                    </div>
                </div>
            </div>
            <div class="tt-item">
                <div class="tt-single-topic">
                    <div class="tt-item-header pt-noborder">
                        <div class="tt-item-info info-top">
                            <div class="tt-avatar-icon">
                                <i class="tt-icon"><svg>
                                        <use xlink:href="#icon-ava-v"></use>
                                    </svg></i>
                            </div>
                            <div class="tt-avatar-title">
                                <a href="#">vickey03</a>
                            </div>
                            <a href="#" class="tt-info-time">
                                <i class="tt-icon"><svg>
                                        <use xlink:href="#icon-time"></use>
                                    </svg></i>11 Jan,2022
                            </a>
                        </div>
                    </div>
                    <div class="tt-item-description">

                        I've been ping-ponging around the idea of studying, and I always come back top education. Find something you're passionate about
                        <div class="topic-inner-list">
                            <div class="topic-inner">
                                <div class="topic-inner-title">
                                    <div class="topic-inner-avatar">
                                        <i class="tt-icon"><svg>
                                                <use xlink:href="#icon-ava-s"></use>
                                            </svg></i>
                                    </div>
                                    <div class="topic-inner-title"><a href="#">summit92</a></div>
                                </div>
                                <div class="topic-inner-description">
                                    It is very important to decide early because time passes away very fast. So take your decision when you are studying school.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tt-item-info info-bottom">
                        <a href="#" class="tt-icon-btn">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-like"></use>
                                </svg></i>
                            <span class="tt-text">671</span>
                        </a>
                        <a href="#" class="tt-icon-btn">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-dislike"></use>
                                </svg></i>
                            <span class="tt-text">39</span>
                        </a>
                        <a href="#" class="tt-icon-btn">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-favorite"></use>
                                </svg></i>
                            <span class="tt-text">12</span>
                        </a>
                        <div class="col-separator"></div>
                        <a href="#" class="tt-icon-btn tt-hover-02 tt-small-indent">
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
                        </a>
                    </div>
                </div>
            </div>
            <div class="tt-item tt-wrapper-success">
                <div class="tt-single-topic">
                    <div class="tt-item-header pt-noborder">
                        <div class="tt-item-info info-top">
                            <div class="tt-avatar-icon">
                                <i class="tt-icon"><svg>
                                        <use xlink:href="#icon-ava-t"></use>
                                    </svg></i>
                            </div>
                            <div class="tt-avatar-title">
                                <a href="#">tesla02</a>
                                <span class="tt-color13 tt-badge">best answer</span>
                            </div>
                            <a href="#" class="tt-info-time">
                                <i class="tt-icon"><svg>
                                        <use xlink:href="#icon-time"></use>
                                    </svg></i>6 Jan,2022
                            </a>
                        </div>
                    </div>
                    <div class="tt-item-description">
                        Go join the Royal Australian Air Force, spend a couple of years learning to fly and hopefully fly a fighter jet, (preferred) but if I do fly the other aircrafts, that is fine too. That is if I can even get to such a level!
                    </div>
                    <div class="tt-item-info info-bottom">
                        <a href="#" class="tt-icon-btn">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-like"></use>
                                </svg></i>
                            <span class="tt-text">671</span>
                        </a>
                        <a href="#" class="tt-icon-btn">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-dislike"></use>
                                </svg></i>
                            <span class="tt-text">39</span>
                        </a>
                        <a href="#" class="tt-icon-btn">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-favorite"></use>
                                </svg></i>
                            <span class="tt-text">12</span>
                        </a>
                        <div class="col-separator"></div>
                        <a href="#" class="tt-icon-btn tt-hover-02 tt-small-indent">
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
                        </a>
                    </div>
                </div>
            </div>
            <div class="tt-item tt-wrapper-danger">
                <div class="tt-single-topic">
                    <div class="tt-item-header pt-noborder">
                        <div class="tt-item-info info-top">
                            <div class="tt-avatar-icon">
                                <i class="tt-icon"><svg>
                                        <use xlink:href="#icon-ava-u"></use>
                                    </svg></i>
                            </div>
                            <div class="tt-avatar-title">
                                <a href="#">usain31</a>
                            </div>
                            <a href="#" class="tt-info-time">
                                <i class="tt-icon"><svg>
                                        <use xlink:href="#icon-time"></use>
                                    </svg></i>9 Jan,2022
                            </a>
                        </div>
                    </div>
                    <div class="tt-item-description">
                        I'm going to travel around to places outside of my comfort zone for 6 months to get a better understanding of who I am as a person
                    </div>
                    <div class="row">
                        <div class="col-auto">
                            <div class="tt-item-info info-bottom">
                                <a href="#" class="tt-icon-btn">
                                    <i class="tt-icon"><svg>
                                            <use xlink:href="#icon-dislike"></use>
                                        </svg></i>
                                    <span class="tt-text">39</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-auto ml-auto">
                            <a href="#" class="btn btn-primary tt-offset-27">Show Reply</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tt-item">
                <div class="tt-single-topic">
                    <div class="tt-item-header pt-noborder">
                        <div class="tt-item-info info-top">
                            <div class="tt-avatar-icon">
                                <i class="tt-icon"><svg>
                                        <use xlink:href="#icon-ava-f"></use>
                                    </svg></i>
                            </div>
                            <div class="tt-avatar-title">
                                <a href="#">kolis27</a>
                            </div>
                            <a href="#" class="tt-info-time">
                                <i class="tt-icon"><svg>
                                        <use xlink:href="#icon-time"></use>
                                    </svg></i>10 Jan,2022
                            </a>
                        </div>
                    </div>
                    <div class="tt-item-description">
                        <p>
                            I'm thinking of taking a Gap Year at the ADF and then studying Cyber Security and Criminology.
                        </p>
                        <div class="row tt-offset-37">
                            <div class="col-lg-10">
                                <div class="tt-gallery-layout">
                                    <div class="tt-item">
                                        <a href="images/single-topic-img03.jpg" class="tt-gallery-obj"><img src="images/single-topic-img03.jpg" alt=""></a>
                                    </div>
                                    <div class="tt-item">
                                        <a href="images/single-topic-img04.jpg" class="tt-gallery-obj"><img src="images/single-topic-img04.jpg" alt=""></a>
                                    </div>
                                    <div class="tt-item">
                                        <a href="images/single-topic-img05.jpg" class="tt-gallery-obj"><img src="images/single-topic-img05.jpg" alt=""></a>
                                    </div>
                                    <div class="tt-item">
                                        <a href="images/single-topic-img06.jpg" class="tt-gallery-obj"><img src="images/single-topic-img06.jpg" alt=""></a>
                                    </div>
                                    <div class="tt-item">
                                        <a href="images/single-topic-img07.jpg" class="tt-gallery-obj"><img src="images/single-topic-img07.jpg" alt=""></a>
                                    </div>
                                    <div class="tt-item">
                                        <a href="images/single-topic-img08.jpg" class="tt-gallery-obj"><img src="images/single-topic-img08.jpg" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tt-item-info info-bottom">
                        <a href="#" class="tt-icon-btn">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-like"></use>
                                </svg></i>
                            <span class="tt-text">671</span>
                        </a>
                        <a href="#" class="tt-icon-btn">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-dislike"></use>
                                </svg></i>
                            <span class="tt-text">39</span>
                        </a>
                        <a href="#" class="tt-icon-btn">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-favorite"></use>
                                </svg></i>
                            <span class="tt-text">12</span>
                        </a>
                        <div class="col-separator"></div>
                        <a href="#" class="tt-icon-btn tt-hover-02 tt-small-indent">
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
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tt-wrapper-inner">
            <h4 class="tt-title-separator"><span>You’ve reached the end of replies</span></h4>
        </div>

        <div class="tt-wrapper-inner">
            <div class="pt-editor form-default">
                <h6 class="pt-title">Post Your Reply</h6>
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
                    <div class="col-right tt-hidden-mobile">
                        <a href="#" class="btn btn-primary">Preview</a>
                    </div>
                </div>
                <div class="form-group">
                    <textarea name="message" class="form-control" rows="5" placeholder="Lets get started"></textarea>
                </div>
                <div class="pt-row">
                    <div class="col-auto">
                        <div class="checkbox-group">
                            <input type="checkbox" id="checkBox21" name="checkbox" checked="">
                            <label for="checkBox21">
                                <span class="check"></span>
                                <span class="box"></span>
                                <span class="tt-text">Subscribe to this topic.</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-auto">
                        <a href="#" class="btn btn-secondary btn-width-lg">Reply</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tt-topic-list tt-ofset-30">
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
            <div class="tt-item">
                <div class="tt-col-avatar">
                    <svg class="tt-icon">
                        <use xlink:href="#icon-ava-n"></use>
                    </svg>
                </div>
                <div class="tt-col-description">
                    <h6 class="tt-title"><a href="#">
                            I want to start studying online either or open colleges and I don’t know which one is better
                        </a></h6>
                    <div class="row align-items-center no-gutters hide-desktope">
                        <div class="col-11">
                            <ul class="tt-list-badge">
                                <li class="show-mobile"><a href="#"><span class="tt-color05 tt-badge">Higher Studies</span></a></li>
                            </ul>
                        </div>
                        <div class="col-1 ml-auto show-mobile">
                            <div class="tt-value">1d</div>
                        </div>
                    </div>
                </div>
                <div class="tt-col-category"><span class="tt-color05 tt-badge">Higher Studies</span></div>
                <div class="tt-col-value hide-mobile">358</div>
                <div class="tt-col-value tt-color-select hide-mobile">68</div>
                <div class="tt-col-value hide-mobile">8.3k</div>
                <div class="tt-col-value hide-mobile">1d</div>
            </div>
            <div class="tt-item">
                <div class="tt-col-avatar">
                    <svg class="tt-icon">
                        <use xlink:href="#icon-ava-h"></use>
                    </svg>
                </div>
                <div class="tt-col-description">
                    <h6 class="tt-title"><a href="#">
                            <svg class="tt-icon">
                                <use xlink:href="#icon-locked"></use>
                            </svg>
                            Best Foreign Languge to Study?
                        </a></h6>
                    <div class="row align-items-center no-gutters hide-desktope">
                        <div class="col-11">
                            <ul class="tt-list-badge">
                                <li class="show-mobile"><a href="#"><span class="tt-color06 tt-badge">Languages</span></a></li>
                            </ul>
                        </div>
                        <div class="col-1 ml-auto show-mobile">
                            <div class="tt-value">2d</div>
                        </div>
                    </div>
                </div>
                <div class="tt-col-category"><span class="tt-color06 tt-badge">Languages</span></div>
                <div class="tt-col-value hide-mobile">674</div>
                <div class="tt-col-value tt-color-select  hide-mobile">29</div>
                <div class="tt-col-value hide-mobile">1.3k</div>
                <div class="tt-col-value hide-mobile">2d</div>
            </div>
            <div class="tt-item">
                <div class="tt-col-avatar">
                    <svg class="tt-icon">
                        <use xlink:href="#icon-ava-j"></use>
                    </svg>
                </div>
                <div class="tt-col-description">
                    <h6 class="tt-title"><a href="#">
                            First Year at University Experiences?
                        </a></h6>
                    <div class="row align-items-center no-gutters">
                        <div class="col-11">
                            <ul class="tt-list-badge">
                                <li class="show-mobile"><a href="#"><span class="tt-color03 tt-badge">University Life</span></a></li>
                                <li><a href="#"><span class="tt-badge">Life</span></a></li>
                                <li><a href="#"><span class="tt-badge">Events</span></a></li>
                            </ul>
                        </div>
                        <div class="col-1 ml-auto show-mobile">
                            <div class="tt-value">2d</div>
                        </div>
                    </div>
                </div>
                <div class="tt-col-category"><span class="tt-color13 tt-badge">University Life</span></div>
                <div class="tt-col-value hide-mobile">278</div>
                <div class="tt-col-value tt-color-select  hide-mobile">27</div>
                <div class="tt-col-value hide-mobile">1.4k</div>
                <div class="tt-col-value hide-mobile">2d</div>
            </div>
            <div class="tt-item">
                <div class="tt-col-avatar">
                    <svg class="tt-icon">
                        <use xlink:href="#icon-ava-t"></use>
                    </svg>
                </div>
                <div class="tt-col-description">
                    <h6 class="tt-title"><a href="#">
                            Scholarships
                        </a></h6>
                    <div class="row align-items-center no-gutters">
                        <div class="col-11">
                            <ul class="tt-list-badge">
                                <li class="show-mobile"><a href="#"><span class="tt-color07 tt-badge">Funds</span></a></li>
                                <li><a href="#"><span class="tt-badge">Study Help</span></a></li>
                                <li><a href="#"><span class="tt-badge">Recommendations</span></a></li>
                            </ul>
                        </div>
                        <div class="col-1 ml-auto show-mobile">
                            <div class="tt-value">2d</div>
                        </div>
                    </div>
                </div>
                <div class="tt-col-category"><span class="tt-color07 tt-badge">Funds</span></div>
                <div class="tt-col-value hide-mobile">364</div>
                <div class="tt-col-value tt-color-select  hide-mobile">36</div>
                <div class="tt-col-value  hide-mobile">982</div>
                <div class="tt-col-value hide-mobile">2d</div>
            </div>
            <div class="tt-item">
                <div class="tt-col-avatar">
                    <svg class="tt-icon">
                        <use xlink:href="#icon-ava-k"></use>
                    </svg>
                </div>
                <div class="tt-col-description">
                    <h6 class="tt-title"><a href="#">
                            <svg class="tt-icon">
                                <use xlink:href="#icon-verified"></use>
                            </svg>
                            How do you actually study?
                        </a></h6>
                    <div class="row align-items-center no-gutters hide-desktope">
                        <div class="col-11">
                            <ul class="tt-list-badge">
                                <li class="show-mobile"><a href="#"><span class="tt-color08 tt-badge">Study Advice</span></a></li>
                            </ul>
                        </div>
                        <div class="col-1 ml-auto show-mobile">
                            <div class="tt-value">3d</div>
                        </div>
                    </div>
                </div>
                <div class="tt-col-category"><span class="tt-color08 tt-badge">Study Advice</span></div>
                <div class="tt-col-value  hide-mobile">698</div>
                <div class="tt-col-value tt-color-select  hide-mobile">78</div>
                <div class="tt-col-value  hide-mobile">2.1k</div>
                <div class="tt-col-value hide-mobile">3d</div>
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
</main>
@endsection
@section('scripts')
<script src="{{ asset('js/custom/forum-post-countsothers.js') }}"></script>
@endsection