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
            <div class="tt-item tt-itemselect">
                <div class="tt-col-avatar">
                    <svg class="tt-icon">
                        <use xlink:href="#icon-ava-k"></use>
                    </svg>
                </div>
                <div class="tt-col-description">
                    <h6 class="tt-title"><a href="{{ route('student.forum.page-single-topic') }}">
                            <svg class="tt-icon">
                                <use xlink:href="#icon-pinned"></use>
                            </svg>
                            Life After School
                        </a></h6>
                    <div class="row align-items-center no-gutters">
                        <div class="col-11">
                            <ul class="tt-list-badge">
                                <li class="show-mobile"><a href="#"><span class="tt-color01 tt-badge">Advice</span></a></li>
                                <li><a href="#"><span class="tt-badge">Career Advice</span></a></li>
                                <li><a href="#"><span class="tt-badge">Help</span></a></li>
                            </ul>
                        </div>
                        <div class="col-1 ml-auto show-mobile">
                            <div class="tt-value">1h</div>
                        </div>
                    </div>
                </div>
                <div class="tt-col-category"><span class="tt-color01 tt-badge">Advice</span></div>
                <div class="tt-col-value hide-mobile">985</div>
                <div class="tt-col-value tt-color-select hide-mobile">502</div>
                <div class="tt-col-value hide-mobile">15.1k</div>
                <div class="tt-col-value hide-mobile">1h</div>
            </div>
            <div class="tt-item tt-itemselect">
                <div class="tt-col-avatar">
                    <svg class="tt-icon">
                        <use xlink:href="#icon-ava-l"></use>
                    </svg>
                </div>
                <div class="tt-col-description">
                    <h6 class="tt-title"><a href="{{ route('student.forum.page-single-topic') }}">
                            <svg class="tt-icon">
                                <use xlink:href="#icon-locked"></use>
                            </svg>
                            How to overcome test failure?
                           
                        </a></h6>
                    <div class="row align-items-center no-gutters  hide-desktope">
                        <div class="col-11">
                            <ul class="tt-list-badge">
                                <li class="show-mobile"><a href="#"><span class="tt-color02 tt-badge">Examinations</span></a></li>
                            </ul>
                        </div>
                        <div class="col-1 ml-auto show-mobile">
                            <div class="tt-value">2h</div>
                        </div>
                    </div>
                </div>
                <div class="tt-col-category"><span class="tt-color02 tt-badge">Examinations</span></div>
                <div class="tt-col-value hide-mobile">584</div>
                <div class="tt-col-value tt-color-select  hide-mobile">35</div>
                <div class="tt-col-value hide-mobile">1.3k</div>
                <div class="tt-col-value hide-mobile">2h</div>
            </div>
            <div class="tt-item tt-itemselect">
                <div class="tt-col-avatar">
                    <svg class="tt-icon">
                        <use xlink:href="#icon-ava-d"></use>
                    </svg>
                </div>
                <div class="tt-col-description">
                    <h6 class="tt-title"><a href="{{ route('student.forum.page-single-topic') }}">
                            Best Foreign Languge to Study?
                        </a></h6>
                    <div class="row align-items-center no-gutters">
                        <div class="col-11">
                            <ul class="tt-list-badge">
                                <li class="show-mobile"><a href="#"><span class="tt-color03 tt-badge">Languages</span></a></li>
                                <li><a href="#"><span class="tt-badge">Study Advice</span></a></li>
                                <li><a href="#"><span class="tt-badge">Study Tips</span></a></li>
                            </ul>
                        </div>
                        <div class="col-1 ml-auto show-mobile">
                            <div class="tt-value">2h</div>
                        </div>
                    </div>
                </div>
                <div class="tt-col-category"><span class="tt-color03 tt-badge">Languages</span></div>
                <div class="tt-col-value  hide-mobile">401</div>
                <div class="tt-col-value tt-color-select  hide-mobile">975</div>
                <div class="tt-col-value  hide-mobile">12.6k</div>
                <div class="tt-col-value hide-mobile">2h</div>
            </div>
            <div class="tt-item">
                <div class="tt-col-avatar">
                    <svg class="tt-icon">
                        <use xlink:href="#icon-ava-c"></use>
                    </svg>
                </div>
                <div class="tt-col-description">
                    <h6 class="tt-title"><a href="{{ route('student.forum.page-single-topic') }}">
                    First Year at University Experiences?
                        </a></h6>
                    <div class="row align-items-center no-gutters">
                        <div class="col-11">
                            <ul class="tt-list-badge">
                                <li class="show-mobile"><a href="#"><span class="tt-color04 tt-badge">University Life</span></a></li>
                                <li><a href="#"><span class="tt-badge">Life</span></a></li>
                                <li><a href="#"><span class="tt-badge">Study</span></a></li>
                            </ul>
                        </div>
                        <div class="col-1 ml-auto show-mobile">
                            <div class="tt-value">1d</div>
                        </div>
                    </div>
                </div>
                <div class="tt-col-category"><span class="tt-color04 tt-badge">University Life</span></div>
                <div class="tt-col-value  hide-mobile">308</div>
                <div class="tt-col-value tt-color-select  hide-mobile">660</div>
                <div class="tt-col-value  hide-mobile">8.3k</div>
                <div class="tt-col-value hide-mobile">1d</div>
            </div>
            <div class="tt-item">
                <div class="tt-col-avatar">
                    <svg class="tt-icon">
                        <use xlink:href="#icon-ava-n"></use>
                    </svg>
                </div>
                <div class="tt-col-description">
                    <h6 class="tt-title"><a href="{{ route('student.forum.page-single-topic') }}">
                        Scholarships
                        </a></h6>
                    <div class="row align-items-center no-gutters  hide-desktope">
                        <div class="col-11">
                            <ul class="tt-list-badge">
                                <li class="show-mobile"><a href="#"><span class="tt-color05 tt-badge">Funds</span></a></li>
                            </ul>
                        </div>
                        <div class="col-1 ml-auto show-mobile">
                            <div class="tt-value">1d</div>
                        </div>
                    </div>
                </div>
                <div class="tt-col-category"><span class="tt-color05 tt-badge">Funds</span></div>
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
                    <h6 class="tt-title"><a href="{{ route('student.forum.page-single-topic') }}">
                            <svg class="tt-icon">
                                <use xlink:href="#icon-locked"></use>
                            </svg>
                            How do you actually study?
                        </a></h6>
                    <div class="row align-items-center no-gutters  hide-desktope">
                        <div class="col-11">
                            <ul class="tt-list-badge">
                                <li class="show-mobile"><a href="#"><span class="tt-color06 tt-badge">Study Advice</span></a></li>
                            </ul>
                        </div>
                        <div class="col-1 ml-auto show-mobile">
                            <div class="tt-value">2d</div>
                        </div>
                    </div>
                </div>
                <div class="tt-col-category"><span class="tt-color06 tt-badge">Study Advice</span></div>
                <div class="tt-col-value hide-mobile">671</div>
                <div class="tt-col-value tt-color-select  hide-mobile">29</div>
                <div class="tt-col-value hide-mobile">1.3k</div>
                <div class="tt-col-value hide-mobile">2d</div>
            </div>        
            <div class="tt-item">
                <div class="tt-col-avatar">
                    <svg class="tt-icon">
                        <use xlink:href="#icon-ava-t"></use>
                    </svg>
                </div>
                <div class="tt-col-description">
                    <h6 class="tt-title"><a href="{{ route('student.forum.page-single-topic') }}">
                    I want to start studying online either or open colleges and I don’t know which one is better
                        </a></h6>
                    <div class="row align-items-center no-gutters">
                        <div class="col-11">
                            <ul class="tt-list-badge">
                                <li class="show-mobile"><a href="#"><span class="tt-color07 tt-badge">Higher Studies</span></a></li>
                                <li><a href="#"><span class="tt-badge">Study Advice</span></a></li>
                                <li><a href="#"><span class="tt-badge">High school</span></a></li>
                            </ul>
                        </div>
                        <div class="col-1 ml-auto show-mobile">
                            <div class="tt-value">2d</div>
                        </div>
                    </div>
                </div>
                <div class="tt-col-category"><span class="tt-color07 tt-badge">Higher Studies</span></div>
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
                    <h6 class="tt-title"><a href="{{ route('student.forum.page-single-topic') }}">
                            <svg class="tt-icon">
                                <use xlink:href="#icon-verified"></use>
                            </svg>
                            Exam Day on weekends?
                        </a></h6>
                    <div class="row align-items-center no-gutters hide-desktope">
                        <div class="col-11">
                            <ul class="tt-list-badge ">
                                <li class="show-mobile"><a href="#"><span class="tt-color08 tt-badge">Student Worries</span></a></li>
                            </ul>
                        </div>
                        <div class="col-1 ml-auto show-mobile">
                            <div class="tt-value">3d</div>
                        </div>
                    </div>
                </div>
                <div class="tt-col-category"><span class="tt-color08 tt-badge">Student Worries</span></div>
                <div class="tt-col-value  hide-mobile">698</div>
                <div class="tt-col-value tt-color-select  hide-mobile">78</div>
                <div class="tt-col-value  hide-mobile">2.1k</div>
                <div class="tt-col-value hide-mobile">3d</div>
            </div>
            <div class="tt-item">
                <div class="tt-col-avatar">
                    <svg class="tt-icon">
                        <use xlink:href="#icon-ava-v"></use>
                    </svg>
                </div>
                <div class="tt-col-description">
                    <h6 class="tt-title"><a href="{{ route('student.forum.page-single-topic') }}">
                        Exam tips and preparations... the do's and don'ts of surviving exam period
                        </a></h6>
                    <div class="row align-items-center no-gutters  hide-desktope">
                        <div class="col-11">
                            <ul class="tt-list-badge">
                                <li class="show-mobile"><a href="#"><span class="tt-color09 tt-badge">Study Hacks</span></a></li>
                            </ul>
                        </div>
                        <div class="col-1 ml-auto show-mobile">
                            <div class="tt-value">3d</div>
                        </div>
                    </div>
                </div>
                <div class="tt-col-category"><span class="tt-color09 tt-badge">Study Hacks</span></div>
                <div class="tt-col-value  hide-mobile">12</div>
                <div class="tt-col-value tt-color-select  hide-mobile">3</div>
                <div class="tt-col-value  hide-mobile">268</div>
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