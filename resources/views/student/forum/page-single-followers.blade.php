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
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#tt-tab-01" role="tab"><span>Activity</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-02" role="tab"><span>Threads</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-03" role="tab"><span>Replies</span></a>
                    </li>
                    <li class="nav-item tt-hide-xs show">
                        <a class="nav-link active" data-toggle="tab" href="#tt-tab-04" role="tab"><span>526 Followers</span></a>
                    </li>
                    <li class="nav-item tt-hide-md">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-05" role="tab"><span>489 Following</span></a>
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
                            <div class="tt-col-value-large hide-mobile">Category</div>
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
                                        Does Envato act against the authors of Envato markets?
                                    </a></h6>
                                <div class="tt-col-message">
                                    <a href="#">Dylan replied:</a> It’s time to channel your inner Magnum P.I., Ron Swanson or Hercule Poroit! It’s the time that all guys (or gals) love and all our partners hate It’s Movember!
                                </div>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color05 tt-badge">music</span></a></li>
                                        </ul>
                                        <a href="#" class="tt-btn-icon show-mobile">
                                            <i class="tt-icon"><svg>
                                                    <use xlink:href="#icon-reply"></use>
                                                </svg></i>
                                        </a>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">5 Jan,19</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category tt-col-value-large hide-mobile"><span class="tt-color05 tt-badge">music</span></div>
                            <div class="tt-col-value-large hide-mobile">
                                <a href="#" class="tt-btn-icon">
                                    <i class="tt-icon"><svg>
                                            <use xlink:href="#icon-reply"></use>
                                        </svg></i>
                                </a>
                            </div>
                            <div class="tt-col-value-large hide-mobile">5 Jan,19</div>
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
                                        We Want to Hear From You! What Would You Like?
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color06 tt-badge">movies</span></a></li>
                                        </ul>
                                        <a href="#" class="tt-btn-icon show-mobile">
                                            <i class="tt-icon"><svg>
                                                    <use xlink:href="#icon-like"></use>
                                                </svg></i>
                                        </a>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">5 Jan,19</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category tt-col-value-large hide-mobile"><span class="tt-color06 tt-badge">movies</span></div>
                            <div class="tt-col-value-large hide-mobile">
                                <a href="#" class="tt-btn-icon">
                                    <i class="tt-icon"><svg>
                                            <use xlink:href="#icon-like"></use>
                                        </svg></i>
                                </a>
                            </div>
                            <div class="tt-col-value-large hide-mobile">5 Jan,19</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-j"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Seeking partner backend developer
                                    </a></h6>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color13 tt-badge">nature</span></a></li>
                                            <li><a href="#"><span class="tt-badge">themeforest</span></a></li>
                                            <li><a href="#"><span class="tt-badge">elements</span></a></li>
                                        </ul>
                                        <a href="#" class="tt-btn-icon show-mobile">
                                            <i class="tt-icon"><svg>
                                                    <use xlink:href="#icon-share"></use>
                                                </svg></i>
                                        </a>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">4 Jan,19</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category tt-col-value-large hide-mobile"><span class="tt-color13 tt-badge">nature</span></div>
                            <div class="tt-col-category tt-col-value-large hide-mobile">
                                <a href="#" class="tt-btn-icon">
                                    <i class="tt-icon"><svg>
                                            <use xlink:href="#icon-share"></use>
                                        </svg></i>
                                </a>
                            </div>
                            <div class="tt-col-value-large hide-mobile">4 Jan,19</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-t"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Cannot customize my intro
                                    </a></h6>
                                <div class="tt-col-message">
                                    <a href="#">Dylan replied:</a> I am noticed it will take little more time to review new authors submissions. All the Best
                                </div>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color04 tt-badge">pets</span></a></li>
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
                            <div class="tt-col-category tt-col-value-large hide-mobile"><span class="tt-color04 tt-badge">pets</span></div>
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
                                        Web Hosting Packages for ThemeForest WordPress
                                    </a></h6>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color03 tt-badge">exchange</span></a></li>
                                            <li><a href="#"><span class="tt-badge">themeforest</span></a></li>
                                            <li><a href="#"><span class="tt-badge">elements</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">4 Jan,19</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category tt-col-value-large"><span class="tt-color03 tt-badge">exchange</span></div>
                            <div class="tt-col-value-large hide-mobile"></div>
                            <div class="tt-col-value-large hide-mobile">4 Jan,19</div>
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
                                        Microsoft Word and Power Point
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color08 tt-badge">youtube</span></a></li>
                                        </ul>
                                        <a href="#" class="tt-btn-icon show-mobile">
                                            <i class="tt-icon"><svg>
                                                    <use xlink:href="#icon-favorite"></use>
                                                </svg></i>
                                        </a>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">3 Jan,19</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category tt-col-value-large"><span class="tt-color08 tt-badge">youtube</span></div>
                            <div class="tt-col-value-large hide-mobile">
                                <a href="#" class="tt-btn-icon">
                                    <i class="tt-icon"><svg>
                                            <use xlink:href="#icon-favorite"></use>
                                        </svg></i>
                                </a>
                            </div>
                            <div class="tt-col-value-large hide-mobile">3 Jan,19</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-v"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        First website template got rejected.
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><span class="tt-color09 tt-badge">social</span></li>
                                        </ul>
                                        <a href="#" class="tt-btn-icon show-mobile">
                                            <i class="tt-icon"><svg>
                                                    <use xlink:href="#icon-like"></use>
                                                </svg></i>
                                        </a>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">3 Jan,19</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category tt-col-value-large"><span class="tt-color09 tt-badge">social</span></div>
                            <div class="tt-col-value-large hide-mobile">
                                <a href="#" class="tt-btn-icon">
                                    <i class="tt-icon"><svg>
                                            <use xlink:href="#icon-like"></use>
                                        </svg></i>
                                </a>
                            </div>
                            <div class="tt-col-value-large hide-mobile">3 Jan,19</div>
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
                                            <use xlink:href="#icon-pinned"></use>
                                        </svg>
                                        Proform or looking for contacting billing department
                                    </a></h6>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color10 tt-badge">science</span></a></li>
                                            <li><a href="#"><span class="tt-badge">contests</span></a></li>
                                            <li><a href="#"><span class="tt-badge">authors</span></a></li>
                                        </ul>
                                        <a href="#" class="tt-btn-icon show-mobile">
                                            <i class="tt-icon"><svg>
                                                    <use xlink:href="#icon-like"></use>
                                                </svg></i>
                                        </a>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">2 Jan,19</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category tt-col-value-large"><span class="tt-color10 tt-badge">science</span></div>
                            <div class="tt-col-value-large hide-mobile">
                                <a href="#" class="tt-btn-icon">
                                    <i class="tt-icon"><svg>
                                            <use xlink:href="#icon-like"></use>
                                        </svg></i>
                                </a>
                            </div>
                            <div class="tt-col-value-large hide-mobile">2 Jan,19</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-n"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Does Envato act against the authors of Envato markets?
                                    </a></h6>
                                <div class="tt-col-message">
                                    <a href="#">Dylan replied:</a> It’s time to channel your inner Magnum P.I., Ron Swanson or Hercule Poroit! It’s the time that all guys (or gals) love and all our partners hate It’s Movember!
                                </div>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color05 tt-badge">music</span></a></li>
                                        </ul>
                                        <a href="#" class="tt-btn-icon show-mobile">
                                            <i class="tt-icon"><svg>
                                                    <use xlink:href="#icon-reply"></use>
                                                </svg></i>
                                        </a>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">5 Jan,19</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category tt-col-value-large"><span class="tt-color05 tt-badge">music</span></div>
                            <div class="tt-col-value-large hide-mobile">
                                <a href="#" class="tt-btn-icon">
                                    <i class="tt-icon"><svg>
                                            <use xlink:href="#icon-reply"></use>
                                        </svg></i>
                                </a>
                            </div>
                            <div class="tt-col-value-large hide-mobile">5 Jan,19</div>
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
                                        We Want to Hear From You! What Would You Like?
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color06 tt-badge">movies</span></a></li>
                                        </ul>
                                        <a href="#" class="tt-btn-icon show-mobile">
                                            <i class="tt-icon"><svg>
                                                    <use xlink:href="#icon-reply"></use>
                                                </svg></i>
                                        </a>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">5 Jan,19</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category tt-col-value-large"><span class="tt-color06 tt-badge">movies</span></div>
                            <div class="tt-col-value-large hide-mobile">
                                <a href="#" class="tt-btn-icon">
                                    <i class="tt-icon"><svg>
                                            <use xlink:href="#icon-reply"></use>
                                        </svg></i>
                                </a>
                            </div>
                            <div class="tt-col-value-large hide-mobile">5 Jan,19</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-j"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Seeking partner backend developer
                                    </a></h6>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color13 tt-badge">nature</span></a></li>
                                            <li><a href="#"><span class="tt-badge">themeforest</span></a></li>
                                            <li><a href="#"><span class="tt-badge">elements</span></a></li>
                                        </ul>
                                        <a href="#" class="tt-btn-icon show-mobile">
                                            <i class="tt-icon"><svg>
                                                    <use xlink:href="#icon-share"></use>
                                                </svg></i>
                                        </a>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">4 Jan,19</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category tt-col-value-large"><span class="tt-color13 tt-badge">nature</span></div>
                            <div class="tt-col-value-large hide-mobile">
                                <a href="#" class="tt-btn-icon">
                                    <i class="tt-icon"><svg>
                                            <use xlink:href="#icon-share"></use>
                                        </svg></i>
                                </a>
                            </div>
                            <div class="tt-col-value-large hide-mobile">4 Jan,19</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-t"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Cannot customize my intro
                                    </a></h6>
                                <div class="tt-col-message">
                                    <a href="#">Dylan replied:</a> I am noticed it will take little more time to review new authors submissions. All the Best
                                </div>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color04 tt-badge">pets</span></a></li>
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
                            <div class="tt-col-category tt-col-value-large"><span class="tt-color04 tt-badge">pets</span></div>
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
                                        Web Hosting Packages for ThemeForest WordPress
                                    </a></h6>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color03 tt-badge">exchange</span></a></li>
                                            <li><a href="#"><span class="tt-badge">themeforest</span></a></li>
                                            <li><a href="#"><span class="tt-badge">elements</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">4 Jan,19</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category tt-col-value-large"><span class="tt-color03 tt-badge">exchange</span></div>
                            <div class="tt-col-value-large hide-mobile"></div>
                            <div class="tt-col-value-large hide-mobile">4 Jan,19</div>
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
                                        Halloween Costume Contest 2018
                                    </a></h6>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-11">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color01 tt-badge">politics</span></a></li>
                                            <li><a href="#"><span class="tt-badge">contests</span></a></li>
                                            <li><a href="#"><span class="tt-badge">authors</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-1 ml-auto show-mobile">
                                        <div class="tt-value">1h</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category"><span class="tt-color01 tt-badge">politics</span></div>
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
                                        We’re removing Envato Credits from Market
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-11">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color02 tt-badge">video</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-1 ml-auto show-mobile">
                                        <div class="tt-value">1d</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category"><span class="tt-color02 tt-badge">video</span></div>
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
                                        Web Hosting Packages for ThemeForest WordPress
                                    </a></h6>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-11">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color03 tt-badge">exchange</span></a></li>
                                            <li><a href="#"><span class="tt-badge">themeforest</span></a></li>
                                            <li><a href="#"><span class="tt-badge">elements</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-1 ml-auto show-mobile">
                                        <div class="tt-value">2h</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category"><span class="tt-color03 tt-badge">exchange</span></div>
                            <div class="tt-col-value hide-mobile">401</div>
                            <div class="tt-col-value tt-color-select  hide-mobile">975</div>
                            <div class="tt-col-value hide-mobile">12.6k</div>
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
                                        Review Queue Changes for VideoHive & PhotoDune
                                    </a></h6>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-11">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color04 tt-badge">pets</span></a></li>
                                            <li><a href="#"><span class="tt-badge">videohive</span></a></li>
                                            <li><a href="#"><span class="tt-badge">photodune</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-1 ml-auto show-mobile">
                                        <div class="tt-value">1d</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category"><span class="tt-color04 tt-badge">pets</span></div>
                            <div class="tt-col-value hide-mobile">308</div>
                            <div class="tt-col-value tt-color-select  hide-mobile">660</div>
                            <div class="tt-col-value hide-mobile">8.3k</div>
                            <div class="tt-col-value hide-mobile">1d</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Does Envato act against the authors of Envato markets?
                                    </a></h6>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-11">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color05 tt-badge">music</span></a></li>
                                            <li><a href="#"><span class="tt-badge">videohive</span></a></li>
                                            <li><a href="#"><span class="tt-badge">photodune</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-1 ml-auto show-mobile">
                                        <div class="tt-value">1d</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category"><span class="tt-color05 tt-badge">music</span></div>
                            <div class="tt-col-value hide-mobile">358</div>
                            <div class="tt-col-value tt-color-select  hide-mobile">68</div>
                            <div class="tt-col-value hide-mobile">8.3k</div>
                            <div class="tt-col-value hide-mobile">1d</div>
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
                                        We Want to Hear From You! What Would You Like?
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-11">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color06 tt-badge">movies</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-1 ml-auto show-mobile">
                                        <div class="tt-value">2d</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category"><span class="tt-color06 tt-badge">movies</span></div>
                            <div class="tt-col-value hide-mobile">671</div>
                            <div class="tt-col-value tt-color-select  hide-mobile">29</div>
                            <div class="tt-col-value hide-mobile">1.3k</div>
                            <div class="tt-col-value hide-mobile">2d</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Seeking partner backend developer
                                    </a></h6>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-11">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color15 tt-badge">nature</span></a></li>
                                            <li><a href="#"><span class="tt-badge">themeforest</span></a></li>
                                            <li><a href="#"><span class="tt-badge">elements</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-1 ml-auto show-mobile">
                                        <div class="tt-value">2d</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category"><span class="tt-color15 tt-badge">nature</span></div>
                            <div class="tt-col-value hide-mobile">278</div>
                            <div class="tt-col-value tt-color-select  hide-mobile">27</div>
                            <div class="tt-col-value hide-mobile">1.4k</div>
                            <div class="tt-col-value hide-mobile">2d</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Seeking partner backend developer
                                    </a></h6>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-11">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color07 tt-badge">video games</span></a></li>
                                            <li><a href="#"><span class="tt-badge">videohive</span></a></li>
                                            <li><a href="#"><span class="tt-badge">photodune</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-1 ml-auto show-mobile">
                                        <div class="tt-value">2d</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category"><span class="tt-color07 tt-badge">video games</span></div>
                            <div class="tt-col-value hide-mobile">364</div>
                            <div class="tt-col-value tt-color-select  hide-mobile">36</div>
                            <div class="tt-col-value hide-mobile">982</div>
                            <div class="tt-col-value hide-mobile">2d</div>
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
                                            <use xlink:href="#icon-verified"></use>
                                        </svg>
                                        Microsoft Word and Power Point
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-11">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color08 tt-badge">youtube</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-1 ml-auto show-mobile">
                                        <div class="tt-value">3d</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category"><span class="tt-color08 tt-badge">youtube</span></div>
                            <div class="tt-col-value hide-mobile">698</div>
                            <div class="tt-col-value tt-color-select  hide-mobile">78</div>
                            <div class="tt-col-value hide-mobile">2.1k</div>
                            <div class="tt-col-value hide-mobile">3d</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        First website template got rejected.
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-11">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color09 tt-badge">social</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-1 ml-auto show-mobile">
                                        <div class="tt-value">3d</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category"><span class="tt-color09 tt-badge">social</span></div>
                            <div class="tt-col-value hide-mobile">12</div>
                            <div class="tt-col-value tt-color-select hide-mobile">3</div>
                            <div class="tt-col-value hide-mobile">268</div>
                            <div class="tt-col-value hide-mobile">3d</div>
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
                                        Proform or looking for contacting billing department
                                    </a></h6>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-11">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color10 tt-badge">science</span></a></li>
                                            <li><a href="#"><span class="tt-badge">contests</span></a></li>
                                            <li><a href="#"><span class="tt-badge">authors</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-1 ml-auto show-mobile">
                                        <div class="tt-value">2d</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category"><span class="tt-color10 tt-badge">science</span></div>
                            <div class="tt-col-value hide-mobile">364</div>
                            <div class="tt-col-value tt-color-select  hide-mobile">36</div>
                            <div class="tt-col-value hide-mobile">982</div>
                            <div class="tt-col-value hide-mobile">2d</div>
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
                                        Refund for wrongly purchase HTML template
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-11">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color11 tt-badge">entertainment</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-1 ml-auto show-mobile">
                                        <div class="tt-value">3d</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category"><span class="tt-color11 tt-badge">entertainment</span></div>
                            <div class="tt-col-value hide-mobile">657</div>
                            <div class="tt-col-value tt-color-select  hide-mobile">177</div>
                            <div class="tt-col-value hide-mobile">2.6k</div>
                            <div class="tt-col-value hide-mobile">3d</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Why all my affiliate balance is pending?
                                    </a></h6>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-11">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color03 tt-badge">exchange</span></a></li>
                                            <li><a href="#"><span class="tt-badge">themeforest</span></a></li>
                                            <li><a href="#"><span class="tt-badge">elements</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-1 ml-auto show-mobile">
                                        <div class="tt-value">4d</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category"><span class="tt-color03 tt-badge">exchange</span></div>
                            <div class="tt-col-value hide-mobile">37</div>
                            <div class="tt-col-value tt-color-select  hide-mobile">31</div>
                            <div class="tt-col-value hide-mobile">257</div>
                            <div class="tt-col-value hide-mobile">4d</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Google snippets wordpress plugin
                                    </a></h6>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-11">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color04 tt-badge">pets</span></a></li>
                                            <li><a href="#"><span class="tt-badge">videohive</span></a></li>
                                            <li><a href="#"><span class="tt-badge">photodune</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-1 ml-auto show-mobile">
                                        <div class="tt-value">4d</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category"><span class="tt-color04 tt-badge">pets</span></div>
                            <div class="tt-col-value hide-mobile">987</div>
                            <div class="tt-col-value tt-color-select  hide-mobile">271</div>
                            <div class="tt-col-value hide-mobile">3.8k</div>
                            <div class="tt-col-value hide-mobile">4d</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        How to use Team Listing?
                                    </a></h6>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-11">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color09 tt-badge">social</span></a></li>
                                            <li><a href="#"><span class="tt-badge">videohive</span></a></li>
                                            <li><a href="#"><span class="tt-badge">photodune</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-1 ml-auto show-mobile">
                                        <div class="tt-value">5d</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tt-col-category"><span class="tt-color09 tt-badge">social</span></div>
                            <div class="tt-col-value hide-mobile">324</div>
                            <div class="tt-col-value tt-color-select  hide-mobile">163</div>
                            <div class="tt-col-value hide-mobile">2.3k</div>
                            <div class="tt-col-value hide-mobile">5d</div>
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
                                        Does Envato act against the authors of Envato markets?
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color06 tt-badge">movies</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">5 Jan,19</div>
                                    </div>
                                </div>
                                <div class="tt-content">
                                    I really liked new badge - T-shirt. Will there be new contests with new badges for AudioJungle?
                                </div>
                            </div>
                            <div class="tt-col-category"><a href="#"><span class="tt-color06 tt-badge">movies</span></a></div>
                            <div class="tt-col-value-large hide-mobile">5 Jan,19</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        We Want to Hear From You! What Would You Like?
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color15 tt-badge">nature</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">5 Jan,19</div>
                                    </div>
                                </div>
                                <div class="tt-content">
                                    Can it be in not vector format but in very big resolution (far far beyond enough for print on shirts) ?
                                </div>
                            </div>
                            <div class="tt-col-category"><a href="#"><span class="tt-color15 tt-badge">nature</span></a></div>
                            <div class="tt-col-value-large hide-mobile">5 Jan,19</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Seeking partner backend developer
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color05 tt-badge">music</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">5 Jan,19</div>
                                    </div>
                                </div>
                                <div class="tt-content">
                                    One more question -> what is the maximum space (in cm or inches) the design can be?
                                </div>
                            </div>
                            <div class="tt-col-category"><a href="#"><span class="tt-color05 tt-badge">music</span></a></div>
                            <div class="tt-col-value-large hide-mobile">5 Jan,19</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Cannot customize my intro
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color05 tt-badge">music</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">5 Jan,19</div>
                                    </div>
                                </div>
                                <div class="tt-content">
                                    Wow great to see another good contest, I hope we will submit one of our entry this time and try to win it
                                </div>
                            </div>
                            <div class="tt-col-category"><a href="#"><span class="tt-color05 tt-badge">music</span></a></div>
                            <div class="tt-col-value-large hide-mobile">5 Jan,19</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Web Hosting Packages for ThemeForest WordPress
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color03 tt-badge">exchange</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">5 Jan,19</div>
                                    </div>
                                </div>
                                <div class="tt-content">
                                    Keep an eye on author dashboard or forums and thr are chances for such contest in each and every category on Envato market
                                </div>
                            </div>
                            <div class="tt-col-category"><a href="#"><span class="tt-color03 tt-badge">exchange</span></a></div>
                            <div class="tt-col-value-large hide-mobile">5 Jan,19</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Microsoft Word and Power Point
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color08 tt-badge">youtube</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">5 Jan,19</div>
                                    </div>
                                </div>
                                <div class="tt-content">
                                    99% of authors are keeping eyes on the upper right corner hehehehe
                                </div>
                            </div>
                            <div class="tt-col-category"><a href="#"><span class="tt-color08 tt-badge">youtube</span></a></div>
                            <div class="tt-col-value-large hide-mobile">5 Jan,19</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Does Envato act against the authors of Envato markets?
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color06 tt-badge">movies</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">5 Jan,19</div>
                                    </div>
                                </div>
                                <div class="tt-content">
                                    I really liked new badge - T-shirt. Will there be new contests with new badges for AudioJungle?
                                </div>
                            </div>
                            <div class="tt-col-category"><a href="#"><span class="tt-color06 tt-badge">movies</span></a></div>
                            <div class="tt-col-value-large hide-mobile">5 Jan,19</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        We Want to Hear From You! What Would You Like?
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color15 tt-badge">nature</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">5 Jan,19</div>
                                    </div>
                                </div>
                                <div class="tt-content">
                                    Can it be in not vector format but in very big resolution (far far beyond enough for print on shirts) ?
                                </div>
                            </div>
                            <div class="tt-col-category"><a href="#"><span class="tt-color15 tt-badge">nature</span></a></div>
                            <div class="tt-col-value-large hide-mobile">5 Jan,19</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Seeking partner backend developer
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color15 tt-badge">music</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">5 Jan,19</div>
                                    </div>
                                </div>
                                <div class="tt-content">
                                    One more question -> what is the maximum space (in cm or inches) the design can be?
                                </div>
                            </div>
                            <div class="tt-col-category"><a href="#"><span class="tt-color15 tt-badge">music</span></a></div>
                            <div class="tt-col-value-large hide-mobile">5 Jan,19</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Cannot customize my intro
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color15 tt-badge">music</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">5 Jan,19</div>
                                    </div>
                                </div>
                                <div class="tt-content">
                                    Wow great to see another good contest, I hope we will submit one of our entry this time and try to win it
                                </div>
                            </div>
                            <div class="tt-col-category"><a href="#"><span class="tt-color15 tt-badge">music</span></a></div>
                            <div class="tt-col-value-large hide-mobile">5 Jan,19</div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-avatar">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-ava-d"></use>
                                </svg>
                            </div>
                            <div class="tt-col-description">
                                <h6 class="tt-title"><a href="#">
                                        Web Hosting Packages for ThemeForest WordPress
                                    </a></h6>
                                <div class="row align-items-center no-gutters hide-desktope">
                                    <div class="col-9">
                                        <ul class="tt-list-badge">
                                            <li class="show-mobile"><a href="#"><span class="tt-color03 tt-badge">exchange</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-3 ml-auto show-mobile">
                                        <div class="tt-value">5 Jan,19</div>
                                    </div>
                                </div>
                                <div class="tt-content">
                                    Keep an eye on author dashboard or forums and thr are chances for such contest in each and every category on Envato market
                                </div>
                            </div>
                            <div class="tt-col-category"><a href="#"><span class="tt-color03 tt-badge">exchange</span></a></div>
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
                <div class="tab-pane tt-indent-none show active" id="tt-tab-04" role="tabpanel">
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
                            <div class="tt-col-value-large hide-mobile">10/01/2019</div>
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
                            <div class="tt-col-value-large hide-mobile">08/01/2019</div>
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
                            <div class="tt-col-value-large hide-mobile">09/01/2019</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">1 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">9</div>
                            <div class="tt-col-value-large hide-mobile">32</div>
                            <div class="tt-col-value"><span class="tt-color16 tt-badge">LVL : 06</span></div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-d"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">Dylan</a></h6>
                                    <ul>
                                        <li><a href="mailto:@dylan89">@dylan89</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">09/01/2019</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">18 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">2</div>
                            <div class="tt-col-value-large hide-mobile">3</div>
                            <div class="tt-col-value"><span class="tt-color17 tt-badge">LVL : 27</span></div>
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
                            <div class="tt-col-value-large hide-mobile">09/01/2019</div>
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
                            <div class="tt-col-value-large hide-mobile">08/01/2019</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">2 days ago</div>
                            <div class="tt-col-value-large hide-mobile">19</div>
                            <div class="tt-col-value-large hide-mobile">32</div>
                            <div class="tt-col-value"><span class="tt-color18 tt-badge">LVL : 18</span></div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-s"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">Smith</a></h6>
                                    <ul>
                                        <li><a href="mailto:@smith45">@smith45</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">08/01/2019</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">1 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">6</div>
                            <div class="tt-col-value-large hide-mobile">13</div>
                            <div class="tt-col-value"><span class="tt-color07 tt-badge">LVL : 42</span></div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-u"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">Usain</a></h6>
                                    <ul>
                                        <li><a href="mailto:@bolt24">@bolt24</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">07/01/2019</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">9 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">20</div>
                            <div class="tt-col-value-large hide-mobile">43</div>
                            <div class="tt-col-value"><span class="tt-color17 tt-badge">LVL : 21</span></div>
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
                            <div class="tt-col-value-large hide-mobile">06/01/2019</div>
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
                            <div class="tt-col-value-large hide-mobile">05/01/2019</div>
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
                            <div class="tt-col-value-large hide-mobile">05/01/2019</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">8 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">2</div>
                            <div class="tt-col-value-large hide-mobile">8</div>
                            <div class="tt-col-value"><span class="tt-color18 tt-badge">LVL : 16</span></div>
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
                            <div class="tt-col-value-large hide-mobile">05/01/2019</div>
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
                            <div class="tt-col-value-large hide-mobile">04/01/2019</div>
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
                            <div class="tt-col-value-large hide-mobile">03/01/2019</div>
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
                            <div class="tt-col-value-large hide-mobile">03/01/2019</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">7 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">2</div>
                            <div class="tt-col-value-large hide-mobile">16</div>
                            <div class="tt-col-value"><span class="tt-color21 tt-badge">LVL : 62</span></div>
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
                            <div class="tt-col-value-large hide-mobile">05/01/2019</div>
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
                            <div class="tt-col-value-large hide-mobile">04/01/2019</div>
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
                            <div class="tt-col-value-large hide-mobile">03/01/2019</div>
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
                            <div class="tt-col-value-large hide-mobile">03/01/2019</div>
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
                            <div class="tt-col-value-large hide-mobile">10/01/2019</div>
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
                            <div class="tt-col-value-large hide-mobile">08/01/2019</div>
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
                            <div class="tt-col-value-large hide-mobile">09/01/2019</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">1 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">9</div>
                            <div class="tt-col-value-large hide-mobile">32</div>
                            <div class="tt-col-value"><span class="tt-color16 tt-badge">LVL : 06</span></div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-d"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">Dylan</a></h6>
                                    <ul>
                                        <li><a href="mailto:@dylan89">@dylan89</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">09/01/2019</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">18 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">2</div>
                            <div class="tt-col-value-large hide-mobile">3</div>
                            <div class="tt-col-value"><span class="tt-color17 tt-badge">LVL : 27</span></div>
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
                            <div class="tt-col-value-large hide-mobile">09/01/2019</div>
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
                            <div class="tt-col-value-large hide-mobile">08/01/2019</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">2 days ago</div>
                            <div class="tt-col-value-large hide-mobile">19</div>
                            <div class="tt-col-value-large hide-mobile">32</div>
                            <div class="tt-col-value"><span class="tt-color18 tt-badge">LVL : 18</span></div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-s"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">Smith</a></h6>
                                    <ul>
                                        <li><a href="mailto:@smith45">@smith45</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">08/01/2019</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">1 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">6</div>
                            <div class="tt-col-value-large hide-mobile">13</div>
                            <div class="tt-col-value"><span class="tt-color07 tt-badge">LVL : 42</span></div>
                        </div>
                        <div class="tt-item">
                            <div class="tt-col-merged">
                                <div class="tt-col-avatar">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-ava-u"></use>
                                    </svg>
                                </div>
                                <div class="tt-col-description">
                                    <h6 class="tt-title"><a href="#">Usain</a></h6>
                                    <ul>
                                        <li><a href="mailto:@bolt24">@bolt24</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tt-col-value-large hide-mobile">07/01/2019</div>
                            <div class="tt-col-value-large hide-mobile tt-color-select">9 hours ago</div>
                            <div class="tt-col-value-large hide-mobile">20</div>
                            <div class="tt-col-value-large hide-mobile">43</div>
                            <div class="tt-col-value"><span class="tt-color17 tt-badge">LVL : 21</span></div>
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
                            <div class="tt-col-value-large hide-mobile">06/01/2019</div>
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
                            <div class="tt-col-value-large hide-mobile">05/01/2019</div>
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
                            <div class="tt-col-value-large hide-mobile">05/01/2019</div>
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
                                                <li><a href="#"><span class="tt-color01 tt-badge">politics</span></a></li>
                                            </ul>
                                            <h6 class="tt-title"><a href="#">Threads - 1,245</a></h6>
                                        </div>
                                        <div class="tt-item-layout">
                                            <div class="innerwrapper">
                                                Lets discuss about whats happening around the world politics.
                                            </div>
                                            <div class="innerwrapper">
                                                <h6 class="tt-title">Similar TAGS</h6>
                                                <ul class="tt-list-badge">
                                                    <li><a href="#"><span class="tt-badge">world politics</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">human rights</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">trump</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">climate change</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">foreign policy</span></a></li>
                                                </ul>
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
                                                <li><a href="#"><span class="tt-color02 tt-badge">video</span></a></li>
                                            </ul>
                                            <h6 class="tt-title"><a href="#">Threads - 368</a></h6>
                                        </div>
                                        <div class="tt-item-layout">
                                            <div class="tt-innerwrapper">
                                                Lets discuss about whats happening around the world politics.
                                            </div>
                                            <div class="tt-innerwrapper">
                                                <h6 class="tt-title">Similar TAGS</h6>
                                                <ul class="tt-list-badge">
                                                    <li><a href="#"><span class="tt-badge">movies</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">new movies</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">marvel movies</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">climate change</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">netflix</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">prime</span></a></li>
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
                                                <li><a href="#"><span class="tt-color03 tt-badge">exchange</span></a></li>
                                            </ul>
                                            <h6 class="tt-title"><a href="#">Threads - 381</a></h6>
                                        </div>
                                        <div class="tt-item-layout">
                                            <div class="tt-innerwrapper">
                                                Lets discuss about whats happening around the world politics.
                                            </div>
                                            <div class="tt-innerwrapper">
                                                <h6 class="tt-title">Similar TAGS</h6>
                                                <ul class="tt-list-badge">
                                                    <li><a href="#"><span class="tt-badge">world politics</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">human rights</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">trump</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">climate change</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">foreign policy</span></a></li>
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
                                                <li><a href="#"><span class="tt-color04 tt-badge">pets</span></a></li>
                                            </ul>
                                            <h6 class="tt-title"><a href="#">Threads - 98</a></h6>
                                        </div>
                                        <div class="tt-item-layout">
                                            <div class="tt-innerwrapper">
                                                Lets discuss about whats happening around the world politics.
                                            </div>
                                            <div class="tt-innerwrapper">
                                                <h6 class="tt-title">Similar TAGS</h6>
                                                <ul class="tt-list-badge">
                                                    <li><a href="#"><span class="tt-badge">world politics</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">human rights</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">trump</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">climate change</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">foreign policy</span></a></li>
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
                                                <li><a href="#"><span class="tt-color05 tt-badge">music</span></a></li>
                                            </ul>
                                            <h6 class="tt-title"><a href="#">Threads - 28</a></h6>
                                        </div>
                                        <div class="tt-item-layout">
                                            <div class="tt-innerwrapper">
                                                Lets discuss about whats happening around the world politics.
                                            </div>
                                            <div class="tt-innerwrapper">
                                                <h6 class="tt-title">Similar TAGS</h6>
                                                <ul class="tt-list-badge">
                                                    <li><a href="#"><span class="tt-badge">world politics</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">human rights</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">trump</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">climate change</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">foreign policy</span></a></li>
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
                                                <li><a href="#"><span class="tt-color06 tt-badge">movies</span></a></li>
                                            </ul>
                                            <h6 class="tt-title"><a href="#">Threads - 74</a></h6>
                                        </div>
                                        <div class="tt-item-layout">
                                            <div class="tt-innerwrapper">
                                                Lets discuss about whats happening around the world politics.
                                            </div>
                                            <div class="tt-innerwrapper">
                                                <h6 class="tt-title">Similar TAGS</h6>
                                                <ul class="tt-list-badge">
                                                    <li><a href="#"><span class="tt-badge">world politics</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">human rights</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">trump</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">climate change</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">foreign policy</span></a></li>
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
                                                <li><a href="#"><span class="tt-color15 tt-badge">nature</span></a></li>
                                            </ul>
                                            <h6 class="tt-title"><a href="#">Threads - 1,245</a></h6>
                                        </div>
                                        <div class="tt-item-layout">
                                            <div class="tt-innerwrapper">
                                                Lets discuss about whats happening around the world politics.
                                            </div>
                                            <div class="tt-innerwrapper">
                                                <h6 class="tt-title">Similar TAGS</h6>
                                                <ul class="tt-list-badge">
                                                    <li><a href="#"><span class="tt-badge">world politics</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">human rights</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">trump</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">climate change</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">foreign policy</span></a></li>
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
                                                <li><a href="#"><span class="tt-color07 tt-badge">video games</span></a></li>
                                            </ul>
                                            <h6 class="tt-title"><a href="#">Threads - 1,245</a></h6>
                                        </div>
                                        <div class="tt-item-layout">
                                            <div class="tt-innerwrapper">
                                                Lets discuss about whats happening around the world politics.
                                            </div>
                                            <div class="tt-innerwrapper">
                                                <h6 class="tt-title">Similar TAGS</h6>
                                                <ul class="tt-list-badge">
                                                    <li><a href="#"><span class="tt-badge">world politics</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">human rights</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">trump</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">climate change</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">foreign policy</span></a></li>
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
                                                <li><a href="#"><span class="tt-color08 tt-badge">youtube</span></a></li>
                                            </ul>
                                            <h6 class="tt-title"><a href="#">Threads - 1,245</a></h6>
                                        </div>
                                        <div class="tt-item-layout">
                                            <div class="tt-innerwrapper">
                                                Lets discuss about whats happening around the world politics.
                                            </div>
                                            <div class="tt-innerwrapper">
                                                <h6 class="tt-title">Similar TAGS</h6>
                                                <ul class="tt-list-badge">
                                                    <li><a href="#"><span class="tt-badge">world politics</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">human rights</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">trump</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">climate change</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">foreign policy</span></a></li>
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
                                                <li><a href="#"><span class="tt-color09 tt-badge">social</span></a></li>
                                            </ul>
                                            <h6 class="tt-title"><a href="#">Threads - 1,245</a></h6>
                                        </div>
                                        <div class="tt-item-layout">
                                            <div class="tt-innerwrapper">
                                                Lets discuss about whats happening around the world politics.
                                            </div>
                                            <div class="tt-innerwrapper">
                                                <h6 class="tt-title">Similar TAGS</h6>
                                                <ul class="tt-list-badge">
                                                    <li><a href="#"><span class="tt-badge">world politics</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">human rights</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">trump</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">climate change</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">foreign policy</span></a></li>
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
                                                <li><a href="#"><span class="tt-color10 tt-badge">science</span></a></li>
                                            </ul>
                                            <h6 class="tt-title"><a href="#">Threads - 1,245</a></h6>
                                        </div>
                                        <div class="tt-item-layout">
                                            <div class="tt-innerwrapper">
                                                Lets discuss about whats happening around the world politics.
                                            </div>
                                            <div class="tt-innerwrapper">
                                                <h6 class="tt-title">Similar TAGS</h6>
                                                <ul class="tt-list-badge">
                                                    <li><a href="#"><span class="tt-badge">world politics</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">human rights</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">trump</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">climate change</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">foreign policy</span></a></li>
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
                                                <li><a href="#"><span class="tt-color11 tt-badge">entertainment</span></a></li>
                                            </ul>
                                            <h6 class="tt-title"><a href="#">Threads - 1,245</a></h6>
                                        </div>
                                        <div class="tt-item-layout">
                                            <div class="tt-innerwrapper">
                                                Lets discuss about whats happening around the world politics.
                                            </div>
                                            <div class="tt-innerwrapper">
                                                <h6 class="tt-title">Similar TAGS</h6>
                                                <ul class="tt-list-badge">
                                                    <li><a href="#"><span class="tt-badge">world politics</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">human rights</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">trump</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">climate change</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">foreign policy</span></a></li>
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
                                                <li><a href="#"><span class="tt-color04 tt-badge">pets</span></a></li>
                                            </ul>
                                            <h6 class="tt-title"><a href="#">Threads - 1,245</a></h6>
                                        </div>
                                        <div class="tt-item-layout">
                                            <div class="tt-innerwrapper">
                                                Lets discuss about whats happening around the world politics.
                                            </div>
                                            <div class="tt-innerwrapper">
                                                <h6 class="tt-title">Similar TAGS</h6>
                                                <ul class="tt-list-badge">
                                                    <li><a href="#"><span class="tt-badge">world politics</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">human rights</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">trump</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">climate change</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">foreign policy</span></a></li>
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
                                                <li><a href="#"><span class="tt-color05 tt-badge">music</span></a></li>
                                            </ul>
                                            <h6 class="tt-title"><a href="#">Threads - 1,245</a></h6>
                                        </div>
                                        <div class="tt-item-layout">
                                            <div class="tt-innerwrapper">
                                                Lets discuss about whats happening around the world politics.
                                            </div>
                                            <div class="tt-innerwrapper">
                                                <h6 class="tt-title">Similar TAGS</h6>
                                                <ul class="tt-list-badge">
                                                    <li><a href="#"><span class="tt-badge">world politics</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">human rights</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">trump</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">climate change</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">foreign policy</span></a></li>
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
                                                <li><a href="#"><span class="tt-color06 tt-badge">movies</span></a></li>
                                            </ul>
                                            <h6 class="tt-title"><a href="#">Threads - 1,245</a></h6>
                                        </div>
                                        <div class="tt-item-layout">
                                            <div class="tt-innerwrapper">
                                                Lets discuss about whats happening around the world politics.
                                            </div>
                                            <div class="tt-innerwrapper">
                                                <h6 class="tt-title">Similar TAGS</h6>
                                                <ul class="tt-list-badge">
                                                    <li><a href="#"><span class="tt-badge">world politics</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">human rights</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">trump</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">climate change</span></a></li>
                                                    <li><a href="#"><span class="tt-badge">foreign policy</span></a></li>
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