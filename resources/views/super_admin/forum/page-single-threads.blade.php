@extends('layouts.forum-layout')
@section('content')
<main id="tt-pageContent" class="tt-offset-small">
    <div class="tt-wrapper-section">
        <div class="container">
            <div class="tt-user-header">
                <div class="tt-col-avatar">
                    <div class="tt-icon">
                        <svg class="tt-icon">
                            <use xlink:href="#icon-ava-d"></use>
                        </svg>
                    </div>
                </div>
                <div class="tt-col-title">
                    <div class="tt-title">
                        <a href="#">Dylan89</a>
                    </div>
                    <ul class="tt-list-badge">
                        <li><a href="#"><span class="tt-color14 tt-badge">LVL : 26</span></a></li>
                    </ul>
                </div>
                <div class="tt-col-btn" id="js-settings-btn">
                    <div class="tt-list-btn">
                        <a href="#" class="tt-btn-icon">
                            <svg class="tt-icon">
                                <use xlink:href="#icon-settings_fill"></use>
                            </svg>
                        </a>
                        <a href="#" class="btn btn-primary">Message</a>
                        <a href="#" class="btn btn-secondary">Follow</a>
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
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-01" role="tab"><span>Activity</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tt-tab-02" role="tab"><span>Threads</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-03" role="tab"><span>Replies</span></a>
                    </li>
                    <li class="nav-item tt-hide-xs">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-04" role="tab"><span>5 Followers</span></a>
                    </li>
                    <li class="nav-item tt-hide-md">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-05" role="tab"><span>10 Following</span></a>
                    </li>
                    <li class="nav-item tt-hide-md">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-06" role="tab"><span>Categories</span></a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane tt-indent-none" id="tt-tab-01" role="tabpanel">
                    <div class="tt-topic-list">
                        <div class="tt-list-header">
                            <div class="tt-col-topic">Topic</div>
                            <div class="tt-col-value-large hide-mobile">{{ __('messages.category') }}</div>
                            <div class="tt-col-value-large hide-mobile">Status</div>
                            <div class="tt-col-value-large hide-mobile">Activity</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-n"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                How do you actually study?
                                    </a></h6>
                                <div class="tt-col-message">
                                    <a href="#">Dylan replied:</a> I try to find effective techniques that help me to remember more info.                                </div>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color05 tt-badge">Study Help</span></a></li>
                                        </ul>
                                        <a href="#" class="tt-btn-icon show-mobile">
                                            <i class="tt-icon"><svg>
                                                    <use xlink:href="#icon-reply"></use>
                                                </svg></i>
                                        </a>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">10 Jan,22</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category tt-col-value-large hide-mobile"><span class="tt-color05 tt-badge">Study Help</span></div>
                            <div class="tt-col-value-large hide-mobile">
                                <a href="#" class="tt-btn-icon">
                                    <i class="tt-icon"><svg>
                                            <use xlink:href="#icon-reply"></use>
                                        </svg></i>
                                </a>
                            </div>
                            <div class="tt-col-value-large hide-mobile">1 Jan,22</div>
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
                                <div class="tt-col-message">
                                    <a href="#">Dylan replied:</a>You can go online and there are so many schools that offer scholarships.Were I live there’s this big school called modern it’s for all subjects mabye there’s schools like that in your area
                                </div>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color04 tt-badge">{{ __('messages.student') }}</span></a></li>
                                        </ul>
                                        <a href="#" class="tt-btn-icon show-mobile">
                                            <i class="tt-icon"><svg>
                                                    <use xlink:href="#icon-reply"></use>
                                                </svg></i>
                                        </a>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">4 Jan,19</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category tt-col-value-large hide-mobile"><span class="tt-color04 tt-badge">{{ __('messages.student') }}</span></div>
                            <div class="tt-col-value-large hide-mobile">
                                <a href="#" class="tt-btn-icon">
                                    <i class="tt-icon"><svg>
                                            <use xlink:href="#icon-reply"></use>
                                        </svg></i>
                                </a>
                            </div>
                            <div class="tt-col-value-large hide-mobile">4 Jan,19</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                     First Year at University Experiences?
                                    </a></h6>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color03 tt-badge">University Life</span></a></li>
                                            <li><a href="#"><span class="tt-badge">University Advice</span></a></li>
                                            <li><a href="#"><span class="tt-badge">University</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">4 Jan,19</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category tt-col-value-large"><span class="tt-color03 tt-badge">University Life</span></div>
                            <div class="tt-col-value-large hide-mobile"></div>
                            <div class="tt-col-value-large hide-mobile">4 Jan,19</div>
                        </div>                      
                        <!-- <div class="tt-row-btn">
                            <button type="button" class="btn-icon js-topiclist-showmore">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-load_lore_icon"></use>
                                </svg>
                            </button>
                        </div> -->
                    </div>
                </div>
                <div class="tab-pane tt-indent-none show active" id="tt-tab-02" role="tabpanel">
                    <div class="tt-topic-list">
                        <div class="tt-list-header">
                            <div class="tt-col-topic">Topic</div>
                            <div class="tt-col-category">{{ __('messages.category') }}</div>
                            <div class="tt-col-value hide-mobile">Likes</div>
                            <div class="tt-col-value hide-mobile">Replies</div>
                            <div class="tt-col-value hide-mobile">Views</div>
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
                                        <svg class="tt-icon">
                                            <use xlink:href="#icon-pinned"></use>
                                        </svg>
                                        Exam tips and preparations... the do's and don'ts of surviving exam period
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
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
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
                                            <li class="show-mobile"><a href="#"><span class="tt-color02 tt-badge">Languages</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-1 ml-auto show-mobile">
                                        <div class="tt-value">1d</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category"><span class="tt-color02 tt-badge">Languages</span></div>
                            <div class="tt-col-value hide-mobile">584</div>
                            <div class="tt-col-value tt-color-select  hide-mobile">35</div>
                            <div class="tt-col-value hide-mobile">1.3k</div>
                            <div class="tt-col-value hide-mobile">2h</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                       Scholarships
                                    </a></h6>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-11">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color03 tt-badge">{{ __('messages.student') }}</span></a></li>
                                            <li><a href="#"><span class="tt-badge">University</span></a></li>
                                            <li><a href="#"><span class="tt-badge">Study Advice</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-1 ml-auto show-mobile">
                                        <div class="tt-value">2h</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category"><span class="tt-color03 tt-badge">{{ __('messages.student') }}</span></div>
                            <div class="tt-col-value hide-mobile">401</div>
                            <div class="tt-col-value tt-color-select  hide-mobile">975</div>
                            <div class="tt-col-value hide-mobile">12.6k</div>
                            <div class="tt-col-value hide-mobile">2h</div>
                        </div>                                
                                            
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
                            <div class="tt-col-topic">Topic</div>
                            <div class="tt-col-category">{{ __('messages.category') }}</div>
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
                                            <li class="show-mobile"><a href="#"><span class="tt-color05 tt-badge">{{ __('messages.teacher') }}</span></a></li>
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
                            <div class="tt-col-category"><a href="#"><span class="tt-color05 tt-badge">{{ __('messages.teacher') }}</span></a></div>
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
                        <!-- <div class="tt-row-btn">
                            <button type="button" class="btn-icon js-topiclist-showmore">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-load_lore_icon"></use>
                                </svg>
                            </button>
                        </div> -->
                    </div>
                </div>
                <div class="tab-pane tt-indent-none" id="tt-tab-04" role="tabpanel">
                    <div class="tt-followers-list">
                        <div class="tt-list-header">
                            <div class="tt-col-name">User</div>
                            <div class="tt-col-value-large hide-mobile">Follow date</div>
                            <div class="tt-col-value-large hide-mobile">Last Activity</div>
                            <div class="tt-col-value-large hide-mobile">Threads</div>
                            <div class="tt-col-value-large hide-mobile">Replies</div>
                            <div class="tt-col-value">Level</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-t"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">Taylor</a></h6>
                                    <ul>
                                        <li><a href="mailto:@tails23">@tails23</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">10/01/2022</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">10 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">0</div>
                            <div class="tt-col-value-large hide-mobile">6</div>
                            <div class="tt-col-value"><span class="tt-color16 tt-badge">LVL : 02</span></div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-k"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">Kevin</a></h6>
                                    <ul>
                                        <li><a href="mailto:@kevin27">@kevin27</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">08/01/2022</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">4 days ago</div>
                            <div class="tt-col-value-large hide-mobile">0</div>
                            <div class="tt-col-value-large hide-mobile">2</div>
                            <div class="tt-col-value"><span class="tt-color17 tt-badge">LVL : 26</span></div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-g"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">Green</a></h6>
                                    <ul>
                                        <li><a href="mailto:@green63">@green63</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">09/01/2022</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">1 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">9</div>
                            <div class="tt-col-value-large hide-mobile">32</div>
                            <div class="tt-col-value"><span class="tt-color16 tt-badge">LVL : 06</span></div>
                        </div>                   
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-p"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">Peterson</a></h6>
                                    <ul>
                                        <li><a href="mailto:@dylan89">@dylan89</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">09/01/2022</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">3 days ago</div>
                            <div class="tt-col-value-large hide-mobile">8</div>
                            <div class="tt-col-value-large hide-mobile">21</div>
                            <div class="tt-col-value"><span class="tt-color18 tt-badge">LVL : 13</span></div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-a"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">azyrus</a></h6>
                                    <ul>
                                        <li><a href="mailto:@azyrus21">@azyrus21</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">08/01/2022</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">2 days ago</div>
                            <div class="tt-col-value-large hide-mobile">19</div>
                            <div class="tt-col-value-large hide-mobile">32</div>
                            <div class="tt-col-value"><span class="tt-color18 tt-badge">LVL : 18</span></div>
                        </div>                      
                    </div>
                </div>
                <div class="tab-pane tt-indent-none" id="tt-tab-05" role="tabpanel">
                    <div class="tt-followers-list">
                        <div class="tt-list-header">
                            <div class="tt-col-name">User</div>
                            <div class="tt-col-value-large hide-mobile">Follow date</div>
                            <div class="tt-col-value-large hide-mobile">Last Activity</div>
                            <div class="tt-col-value-large hide-mobile">Threads</div>
                            <div class="tt-col-value-large hide-mobile">Replies</div>
                            <div class="tt-col-value">Level</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-m"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">Mitchell</a></h6>
                                    <ul>
                                        <li><a href="mailto:@mitchell73">@mitchell73</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">05/01/2022</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">1 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">1</div>
                            <div class="tt-col-value-large hide-mobile">3</div>
                            <div class="tt-col-value"><span class="tt-color19 tt-badge">LVL : 33</span></div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-v"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">Vans</a></h6>
                                    <ul>
                                        <li><a href="mailto:@vans49">@vans49</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">04/01/2022</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">23 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">4</div>
                            <div class="tt-col-value-large hide-mobile">9</div>
                            <div class="tt-col-value"><span class="tt-color20 tt-badge">LVL : 99</span></div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-b"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">Baker</a></h6>
                                    <ul>
                                        <li><a href="mailto:@baker65">@baker65</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">03/01/2022</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">4 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">28</div>
                            <div class="tt-col-value-large hide-mobile">86</div>
                            <div class="tt-col-value"><span class="tt-color07 tt-badge">LVL : 43</span></div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-f"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">Foster</a></h6>
                                    <ul>
                                        <li><a href="mailto:@foster87">@foster87</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">03/01/2022</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">7 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">2</div>
                            <div class="tt-col-value-large hide-mobile">16</div>
                            <div class="tt-col-value"><span class="tt-color21 tt-badge">LVL : 62</span></div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-t"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">Taylor</a></h6>
                                    <ul>
                                        <li><a href="mailto:@tails23">@tails23</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">10/01/2022</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">10 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">0</div>
                            <div class="tt-col-value-large hide-mobile">6</div>
                            <div class="tt-col-value"><span class="tt-color16 tt-badge">LVL : 02</span></div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-k"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">Kevin</a></h6>
                                    <ul>
                                        <li><a href="mailto:@kevin27">@kevin27</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">08/01/2022</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">4 days ago</div>
                            <div class="tt-col-value-large hide-mobile">0</div>
                            <div class="tt-col-value-large hide-mobile">2</div>
                            <div class="tt-col-value"><span class="tt-color17 tt-badge">LVL : 26</span></div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-g"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">Green</a></h6>
                                    <ul>
                                        <li><a href="mailto:@green63">@green63</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">09/01/2022</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">1 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">9</div>
                            <div class="tt-col-value-large hide-mobile">32</div>
                            <div class="tt-col-value"><span class="tt-color16 tt-badge">LVL : 06</span></div>
                        </div>
                        
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-l"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">Larry</a></h6>
                                    <ul>
                                        <li><a href="mailto:@larry74">@larry74</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">06/01/2022</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">6 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">2</div>
                            <div class="tt-col-value-large hide-mobile">5</div>
                            <div class="tt-col-value"><span class="tt-color19 tt-badge">LVL : 39</span></div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-j"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">Jordan</a></h6>
                                    <ul>
                                        <li><a href="mailto:@jordan36">@jordan36</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">05/01/2022</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">6 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">6</div>
                            <div class="tt-col-value-large hide-mobile">23</div>
                            <div class="tt-col-value"><span class="tt-color07 tt-badge">LVL : 46</span></div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-c"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">Clive</a></h6>
                                    <ul>
                                        <li><a href="mailto:@clive45">@clive45</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">05/01/2022</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">8 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">2</div>
                            <div class="tt-col-value-large hide-mobile">8</div>
                            <div class="tt-col-value"><span class="tt-color18 tt-badge">LVL : 16</span></div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane" id="tt-tab-06" role="tabpanel">
                    <div class="tt-wrapper-inner">
                        <div class="tt-categories-list">
                            <div class="row">
                            <div class="col-md-6 col-lg-4">
                    <div class="tt-item">
                        <div class="tt-item-header">
                            <ul class="tt-list-badge">
                                <li><a href="#"><span class="tt-color04 tt-badge">Study Advice</span></a></li>
                            </ul>
                            <h6 class="tt-title"><a href="{{ route('super_admin.forum.page-categories-single') }}">Threads - 98</a></h6>
                        </div>
                        <div class="tt-item-layout">
                            <div class="tt-innerwrapper">
                            Exam Day on weekends?
                            </div>
                            <div class="tt-innerwrapper">
                                <h6 class="tt-title">Similar TAGS</h6>
                                <ul class="tt-list-badge">
                                    <li><a href="#"><span class="tt-badge">Life Advice</span></a></li>
                                    <li><a href="#"><span class="tt-badge">{{ __('messages.education') }}</span></a></li>
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
                            <h6 class="tt-title"><a href="{{ route('super_admin.forum.page-categories-single') }}">Threads - 28</a></h6>
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
                            <h6 class="tt-title"><a href="{{ route('super_admin.forum.page-categories-single') }}">Threads - 74</a></h6>
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
                </div>
            </div>
        </div>
    </div>
</main>
@endsection