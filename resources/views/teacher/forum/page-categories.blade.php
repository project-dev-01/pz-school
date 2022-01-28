@extends('layouts.forum-layout')
@section('content')
<main id="tt-pageContent">
    <div class="tt-custom-mobile-indent container">
        <div class="tt-categories-title">
            <div class="tt-title">Categories</div>
            <div class="tt-search">
                <form class="search-wrapper">
                    <div class="search-form">
                        <input type="text" class="tt-search__input" placeholder="Search Categories">
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
        <div class="tt-categories-list">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="tt-item">
                        <div class="tt-item-header">
                            <ul class="tt-list-badge">
                                <li><a href="#"><span class="tt-color01 tt-badge">University Life</span></a></li>
                            </ul>
                            <h6 class="tt-title"><a href="{{ route('teacher.forum.page-categories-single') }}">Threads - 1,245</a></h6>
                        </div>
                        <div class="tt-item-layout">
                            <div class="innerwrapper">
                                First Year at University Experiences?
                            </div>
                            <div class="innerwrapper">
                                <h6 class="tt-title">Similar TAGS</h6>
                                <ul class="tt-list-badge">
                                    <li><a href="#"><span class="tt-badge">World University</span></a></li>
                                    <li><a href="#"><span class="tt-badge">School Life</span></a></li>                                 
                            </div>
                            <a href="#" class="tt-btn-icon">
                                <i class="tt-icon"><svg>
                                        <use xlink:href="#icon-favorite"></use>
                                    </svg></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="tt-item">
                        <div class="tt-item-header">
                            <ul class="tt-list-badge">
                                <li><a href="#"><span class="tt-color02 tt-badge">Study Advice</span></a></li>
                            </ul>
                            <h6 class="tt-title"><a href="{{ route('teacher.forum.page-categories-single') }}">Threads - 368</a></h6>
                        </div>
                        <div class="tt-item-layout">
                            <div class="tt-innerwrapper">
                            How do you actually study?
                            </div>
                            <div class="tt-innerwrapper">
                                <h6 class="tt-title">Similar TAGS</h6>
                                <ul class="tt-list-badge">
                                    <li><a href="#"><span class="tt-badge">Study Tools</span></a></li>
                                    <li><a href="#"><span class="tt-badge">Advice</span></a></li>
                                    <li><a href="#"><span class="tt-badge">Student Worries</span></a></li>
                              </ul>
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
                <div class="col-md-6 col-lg-4">
                    <div class="tt-item">
                        <div class="tt-item-header">
                            <ul class="tt-list-badge">
                                <li><a href="#"><span class="tt-color03 tt-badge">Education</span></a></li>
                            </ul>
                            <h6 class="tt-title"><a href="{{ route('teacher.forum.page-categories-single') }}">Threads - 381</a></h6>
                        </div>
                        <div class="tt-item-layout">
                            <div class="tt-innerwrapper">
                            Scholarships
                            </div>
                            <div class="tt-innerwrapper">
                                <h6 class="tt-title">Similar TAGS</h6>
                                <ul class="tt-list-badge">
                                    <li><a href="#"><span class="tt-badge">Careers</span></a></li>
                                    <li><a href="#"><span class="tt-badge">Life After School</span></a></li>
                                    <li><a href="#"><span class="tt-badge">Life Advice</span></a></li>                                </ul>
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
                <div class="col-md-6 col-lg-4">
                    <div class="tt-item">
                        <div class="tt-item-header">
                            <ul class="tt-list-badge">
                                <li><a href="#"><span class="tt-color04 tt-badge">Study Advice</span></a></li>
                            </ul>
                            <h6 class="tt-title"><a href="{{ route('teacher.forum.page-categories-single') }}">Threads - 98</a></h6>
                        </div>
                        <div class="tt-item-layout">
                            <div class="tt-innerwrapper">
                            Exam Day on weekends?
                            </div>
                            <div class="tt-innerwrapper">
                                <h6 class="tt-title">Similar TAGS</h6>
                                <ul class="tt-list-badge">
                                    <li><a href="#"><span class="tt-badge">Life Advice</span></a></li>
                                    <li><a href="#"><span class="tt-badge">Education</span></a></li>
                                    <li><a href="#"><span class="tt-badge">Area of study</span></a></li>
                               </ul>
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
                <div class="col-md-6 col-lg-4">
                    <div class="tt-item">
                        <div class="tt-item-header">
                            <ul class="tt-list-badge">
                                <li><a href="#"><span class="tt-color05 tt-badge">Study Hacks</span></a></li>
                            </ul>
                            <h6 class="tt-title"><a href="{{ route('teacher.forum.page-categories-single') }}">Threads - 28</a></h6>
                        </div>
                        <div class="tt-item-layout">
                            <div class="tt-innerwrapper">
                                Exam tips and preparations... the do's and don'ts of surviving exam period
                            </div>
                            <div class="tt-innerwrapper">
                                <h6 class="tt-title">Similar TAGS</h6>
                                <ul class="tt-list-badge">
                                  <li><a href="#"><span class="tt-badge">Study Help</span></a></li>
                                    <li><a href="#"><span class="tt-badge">Study Tips</span></a></li>
                               </ul>
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
                <div class="col-md-6 col-lg-4">
                    <div class="tt-item">
                        <div class="tt-item-header">
                            <ul class="tt-list-badge">
                                <li><a href="#"><span class="tt-color06 tt-badge">Languages</span></a></li>
                            </ul>
                            <h6 class="tt-title"><a href="{{ route('teacher.forum.page-categories-single') }}">Threads - 74</a></h6>
                        </div>
                        <div class="tt-item-layout">
                            <div class="tt-innerwrapper">
                            Best Foreign Languge to Study?
                            </div>
                            <div class="tt-innerwrapper">
                                <h6 class="tt-title">Similar TAGS</h6>
                                <ul class="tt-list-badge">
                                <li><a href="#"><span class="tt-badge">Study Tools</span></a></li>                     
                                    <li><a href="#"><span class="tt-badge">human rights</span></a></li>
                                    <li><a href="#"><span class="tt-badge">Careers</span></a></li>                               
                               
                                </ul>
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
</main>
@endsection