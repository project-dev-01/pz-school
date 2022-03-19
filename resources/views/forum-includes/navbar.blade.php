<nav class="panel-menu" id="mobile-menu">
    <ul>

    </ul>
    <div class="mm-navbtn-names">
        <div class="mm-closebtn">
            Close
            <div class="tt-icon">
                <svg>
                    <use xlink:href="#icon-cancel"></use>
                </svg>
            </div>
        </div>
        <div class="mm-backbtn">Back</div>
    </div>
</nav>
<header id="tt-header">
    <div class="container">
        <div class="row tt-row no-gutters">
            <div class="col-auto">
                <!-- toggle mobile menu -->
                <a class="toggle-mobile-menu" href="#">
                    <svg class="tt-icon">
                        <use xlink:href="#icon-menu_icon"></use>
                    </svg>
                </a>
                <!-- /toggle mobile menu -->
                <!-- logo -->
                @if(Session::get('role_id') == '1')
                <div class="tt-logo">
                    <!-- <a href="{{ route('super_admin.forum.index') }}"><img src="{{ asset('forum/build/images/logo-sm-dark.png') }}" alt=""></a> -->
                    <a href="{{ route('super_admin.forum.rolls-chooseforum') }}"><img src="{{ asset('forum/build/images/logo-sm-dark.png') }}" alt=""></a>
                </div>
                @elseif(Session::get('role_id') == '2')
                <div class="tt-logo">
                    <a href="{{ route('admin.forum.index') }}"><img src="{{ asset('forum/build/images/logo-sm-dark.png') }}" alt=""></a>
                </div>
                @elseif(Session::get('role_id') == '3')
                <div class="tt-logo">
                    <a href="{{ route('staff.forum.index') }}"><img src="{{ asset('forum/build/images/logo-sm-dark.png') }}" alt=""></a>
                </div>
                @elseif(Session::get('role_id') == '4')
                <div class="tt-logo">
                    <a href="{{ route('teacher.forum.index') }}"><img src="{{ asset('forum/build/images/logo-sm-dark.png') }}" alt=""></a>
                </div>
                @elseif(Session::get('role_id') == '5')
                <div class="tt-logo">
                    <a href="{{ route('parent.forum.index') }}"><img src="{{ asset('forum/build/images/logo-sm-dark.png') }}" alt=""></a>
                </div>
                @elseif(Session::get('role_id') == '6')
                <div class="tt-logo">
                    <a href="{{ route('student.forum.index') }}"><img src="{{ asset('forum/build/images/logo-sm-dark.png') }}" alt=""></a>
                </div>
                @endif
                <!-- /logo -->
                <!-- desctop menu -->
                <div class="tt-desktop-menu">
                    <nav>
                        @if(Session::get('role_id') == '1')
                        <ul>
                            <li class="{{ (request()->is('super_admin/forum/page-categories')) ? 'active' : '' }}"><a href="{{ route('super_admin.forum.page-categories') }}"><span>Categories</span></a></li>
                            <li class="{{ (request()->is('super_admin/forum/page-tabs')) ? 'active' : '' }}"><a href="{{ route('super_admin.forum.page-tabs') }}"><span>Trending</span></a></li>
                            <li class="{{ (request()->is('super_admin/forum/page-create-topic')) ? 'active' : '' }}"><a href="{{ route('super_admin.forum.page-create-topic') }}"><span>New Post</span></a></li>
                            <li class="{{ (request()->is('super_admin/forum/page-single-user')) ? 'active' : '' }}"><a href="{{ route('super_admin.forum.page-single-user') }}"><span>Single User Activity</span></a></li>
                            <!-- <li class="{{ (request()->is('super_admin/forum/page-single-user')) ? 'active' : '' }}"> -->
                                <!-- <a href="{{ route('super_admin.forum.page-single-user') }}"><span>Pages</span></a>
                                <ul>
                                     <li class="{{ (request()->is('super_admin/forum/index')) ? 'active' : '' }}"><a href="{{ route('super_admin.forum.index') }}">Home</a></li>
                                    <li class="{{ (request()->is('super_admin/forum/rolls-chooseforum')) ? 'active' : '' }}"><a href="{{ route('super_admin.forum.rolls-chooseforum') }}">Home</a></li>
                                    <li class="{{ (request()->is('super_admin/forum/page-single-topic')) ? 'active' : '' }}"><a href="{{ route('super_admin.forum.page-single-topic') }}">Single Topic</a></li>
                                    <li><a href="{{ route('super_admin.forum.page-create-topic') }}">Create Topic</a></li>
                                    <li><a href="{{ route('super_admin.forum.page-single-user') }}">Single User Activity</a></li>
                                    <li><a href="{{ route('super_admin.forum.page-single-threads') }}">Single User Threads</a></li>
                                    <li><a href="{{ route('super_admin.forum.page-single-replies') }}">Single User Replies</a></li>
                                    <li><a href="{{ route('super_admin.forum.page-single-followers') }}">Single User Followers</a></li>
                                    <li><a href="{{ route('super_admin.forum.page-single-categories') }}">Single User Categories</a></li>
                                   <li><a href="{{ route('super_admin.forum.page-categories') }}">Categories</a></li>
                                    <li><a href="{{ route('super_admin.forum.page-categories-single') }}">Single Category</a></li> 
                                    <li><a href="{{ route('super_admin.forum.page-tabs') }}">About</a></li>
                                    <li><a href="{{ route('super_admin.forum.page-tabs-guidelines') }}">Guidelines</a></li>
                                </ul> -->
                            </li>
                        </ul>
                        @elseif(Session::get('role_id') == '2')
                        <ul>
                            <li class="{{ (request()->is('admin/forum/page-categories')) ? 'active' : '' }}"><a href="{{ route('admin.forum.page-categories') }}"><span>Categories</span></a></li>
                            <li class="{{ (request()->is('admin/forum/page-tabs')) ? 'active' : '' }}"><a href="{{ route('admin.forum.page-tabs') }}"><span>Trending</span></a></li>
                            <li class="{{ (request()->is('admin/forum/page-create-topic')) ? 'active' : '' }}"><a href="{{ route('admin.forum.page-create-topic') }}"><span>New post</span></a></li>
                            <li class="{{ (request()->is('admin/forum/page-single-user')) ? 'active' : '' }}"><a href="{{ route('admin.forum.page-single-user') }}"><span>Single User Activity</span></a></li>
                            
                            <!-- <li class="{{ (request()->is('admin/forum/page-single-user')) ? 'active' : '' }}">
                                <a href="{{ route('admin.forum.page-single-user') }}"><span>Pages</span></a>
                                <ul>
                                    <li class="{{ (request()->is('admin/forum/index')) ? 'active' : '' }}"><a href="{{ route('admin.forum.index') }}">Home</a></li>
                                   <li class="{{ (request()->is('admin/forum/page-single-topic')) ? 'active' : '' }}"><a href="{{ route('admin.forum.page-single-topic') }}">Single Topic</a></li>
                                    <li><a href="{{ route('admin.forum.page-create-topic') }}">Create Topic</a></li>
                                    <li><a href="{{ route('admin.forum.page-single-user') }}">Single User Activity</a></li>
                                   <li><a href="{{ route('admin.forum.page-single-threads') }}">Single User Threads</a></li>
                                    <li><a href="{{ route('admin.forum.page-single-replies') }}">Single User Replies</a></li>
                                    <li><a href="{{ route('admin.forum.page-single-followers') }}">Single User Followers</a></li>
                                    <li><a href="{{ route('admin.forum.page-single-categories') }}">Single User Categories</a></li> 
                                   <li><a href="page-single_settings.html">Single User Settings</a></li> 
                                    <li><a href="{{ route('admin.forum.page-categories') }}">Categories</a></li>
                                    <li><a href="{{ route('admin.forum.page-categories-single') }}">Single Category</a></li>
                                   <li><a href="{{ route('admin.forum.page-tabs') }}">About</a></li>
                                    <li><a href="{{ route('admin.forum.page-tabs-guidelines') }}">Guidelines</a></li> 
                                    <li><a href="_demo_modal-advancedSearch.html">Advanced Search</a></li> 
                                    <li><a href="error404.html">Error 404</a></li> 
                                     <li><a href="_demo_modal-age-confirmation.html">Age Verification</a></li> 
                                    <li><a href="_demo_modal-level-up.html">Level up Notification</a></li>
                                        <li><a href="messages-page.html">Message</a></li>
                                        <li><a href="messages-compose.html">Message Compose</a></li>
                                </ul>
                            </li> -->
                        </ul>
                        @elseif(Session::get('role_id') == '3')
                        <ul>
                            <li class="{{ (request()->is('staff/forum/page-categories')) ? 'active' : '' }}"><a href="{{ route('staff.forum.page-categories') }}"><span>Categories</span></a></li>
                            <li class="{{ (request()->is('staff/forum/page-tabs')) ? 'active' : '' }}"><a href="{{ route('staff.forum.page-tabs') }}"><span>Trending</span></a></li>
                            <li class="{{ (request()->is('staff/forum/page-create-topic')) ? 'active' : '' }}"><a href="{{ route('staff.forum.page-create-topic') }}"><span>New post</span></a></li>
                            <li class="{{ (request()->is('staff/forum/page-single-user')) ? 'active' : '' }}"><a href="{{ route('staff.forum.page-single-user') }}"><span>Single User Activity</span></a></li>
                            <!-- <li class="{{ (request()->is('staff/forum/page-single-user')) ? 'active' : '' }}">
                                <a href="{{ route('staff.forum.page-single-user') }}"><span>Pages</span></a>
                                <ul>
                                    <li class="{{ (request()->is('staff/forum/index')) ? 'active' : '' }}"><a href="{{ route('staff.forum.index') }}">Home</a></li>
                                 <li class="{{ (request()->is('staff/forum/page-single-topic')) ? 'active' : '' }}"><a href="{{ route('staff.forum.page-single-topic') }}">Single Topic</a></li>
                                    <li><a href="{{ route('staff.forum.page-create-topic') }}">Create Topic</a></li> 
                                    <li><a href="{{ route('staff.forum.page-single-user') }}">Single User Activity</a></li>
                                    <li><a href="{{ route('staff.forum.page-single-threads') }}">Single User Threads</a></li>
                                    <li><a href="{{ route('staff.forum.page-single-replies') }}">Single User Replies</a></li>
                                    <li><a href="{{ route('staff.forum.page-single-followers') }}">Single User Followers</a></li>
                                    <li><a href="{{ route('staff.forum.page-single-categories') }}">Single User Categories</a></li>
                                     <li><a href="page-single_settings.html">Single User Settings</a></li> 
                                    <li><a href="{{ route('staff.forum.page-categories') }}">Categories</a></li>
                                    <li><a href="{{ route('staff.forum.page-categories-single') }}">Single Category</a></li>
                                    <li><a href="{{ route('staff.forum.page-tabs') }}">About</a></li>
                                    <li><a href="{{ route('staff.forum.page-tabs-guidelines') }}">Guidelines</a></li>
                                     <li><a href="_demo_modal-advancedSearch.html">Advanced Search</a></li> 
                                    <li><a href="error404.html">Error 404</a></li> 
                                    <li><a href="_demo_modal-age-confirmation.html">Age Verification</a></li>
                                     <li><a href="_demo_modal-level-up.html">Level up Notification</a></li>
                                        <li><a href="messages-page.html">Message</a></li>
                                        <li><a href="messages-compose.html">Message Compose</a></li> 
                                </ul>
                            </li> -->
                        </ul>
                        @elseif(Session::get('role_id') == '4')
                        <ul>
                            <li class="{{ (request()->is('teacher/forum/page-categories')) ? 'active' : '' }}"><a href="{{ route('teacher.forum.page-categories') }}"><span>Categories</span></a></li>
                            <li class="{{ (request()->is('teacher/forum/page-tabs')) ? 'active' : '' }}"><a href="{{ route('teacher.forum.page-tabs') }}"><span>Trending</span></a></li>
                            <li class="{{ (request()->is('teacher/forum/page-create-topic')) ? 'active' : '' }}"><a href="{{ route('teacher.forum.page-create-topic') }}"><span>New post</span></a></li>
                             <li class="{{ (request()->is('teacher/forum/page-single-user')) ? 'active' : '' }}"><a href="{{ route('teacher.forum.page-single-user') }}"><span>Single User Activity</span></a></li>
                            <!--<li class="{{ (request()->is('teacher/forum/page-single-user')) ? 'active' : '' }}">
                                <a href="{{ route('teacher.forum.page-single-user') }}"><span>Pages</span></a>
                                <ul>
                                    <li class="{{ (request()->is('teacher/forum/index')) ? 'active' : '' }}"><a href="{{ route('teacher.forum.index') }}">Home</a></li>
                                    <li class="{{ (request()->is('teacher/forum/page-single-topic')) ? 'active' : '' }}"><a href="{{ route('teacher.forum.page-single-topic') }}">Single Topic</a></li>
                                    <li><a href="{{ route('teacher.forum.page-create-topic') }}">Create Topic</a></li>
                                    <li><a href="{{ route('teacher.forum.page-single-user') }}">Single User Activity</a></li>
                                    <li><a href="{{ route('teacher.forum.page-single-threads') }}">Single User Threads</a></li>
                                    <li><a href="{{ route('teacher.forum.page-single-replies') }}">Single User Replies</a></li>
                                    <li><a href="{{ route('teacher.forum.page-single-followers') }}">Single User Followers</a></li>
                                    <li><a href="{{ route('teacher.forum.page-single-categories') }}">Single User Categories</a></li>
                                    <li><a href="page-single_settings.html">Single User Settings</a></li> 
                                    <li><a href="{{ route('teacher.forum.page-categories') }}">Categories</a></li>
                                    <li><a href="{{ route('teacher.forum.page-categories-single') }}">Single Category</a></li>
                                    <li><a href="{{ route('teacher.forum.page-tabs') }}">About</a></li>
                                    <li><a href="{{ route('teacher.forum.page-tabs-guidelines') }}">Guidelines</a></li>
                                     <li><a href="_demo_modal-advancedSearch.html">Advanced Search</a></li> 
                                     <li><a href="error404.html">Error 404</a></li> 
                                     <li><a href="_demo_modal-age-confirmation.html">Age Verification</a></li> 
                                     <li><a href="_demo_modal-level-up.html">Level up Notification</a></li>
                                        <li><a href="messages-page.html">Message</a></li>
                                        <li><a href="messages-compose.html">Message Compose</a></li> 
                                </ul>
                            </li> -->
                        </ul>
                        @elseif(Session::get('role_id') == '5')
                        <ul>
                            <li class="{{ (request()->is('parent/forum/page-categories')) ? 'active' : '' }}"><a href="{{ route('parent.forum.page-categories') }}"><span>Categories</span></a></li>
                            <li class="{{ (request()->is('parent/forum/page-tabs')) ? 'active' : '' }}"><a href="{{ route('parent.forum.page-tabs') }}"><span>Trending</span></a></li>
                            <li class="{{ (request()->is('parent/forum/page-create-topic')) ? 'active' : '' }}"><a href="{{ route('parent.forum.page-create-topic') }}"><span>New post</span></a></li>
                            <li class="{{ (request()->is('parent/forum/page-single-user')) ? 'active' : '' }}"><a href="{{ route('parent.forum.page-single-user') }}"><span>Single User Activity</span></a></li>
                            <!-- <li class="{{ (request()->is('parent/forum/page-single-user')) ? 'active' : '' }}">
                                <a href="{{ route('parent.forum.page-single-user') }}"><span>Pages</span></a>
                                <ul>
                                    <li class="{{ (request()->is('parent/forum/index')) ? 'active' : '' }}"><a href="{{ route('parent.forum.index') }}">Home</a></li>
                                    <li class="{{ (request()->is('parent/forum/page-single-topic')) ? 'active' : '' }}"><a href="{{ route('parent.forum.page-single-topic') }}">Single Topic</a></li>
                                    <li><a href="{{ route('parent.forum.page-create-topic') }}">Create Topic</a></li>
                                    <li><a href="{{ route('parent.forum.page-single-user') }}">Single User Activity</a></li>
                                    <li><a href="{{ route('parent.forum.page-single-threads') }}">Single User Threads</a></li>
                                    <li><a href="{{ route('parent.forum.page-single-replies') }}">Single User Replies</a></li>
                                    <li><a href="{{ route('parent.forum.page-single-followers') }}">Single User Followers</a></li>
                                    <li><a href="{{ route('parent.forum.page-single-categories') }}">Single User Categories</a></li>
                                    <li><a href="page-single_settings.html">Single User Settings</a></li> 
                                    <li><a href="{{ route('parent.forum.page-categories') }}">Categories</a></li>
                                    <li><a href="{{ route('parent.forum.page-categories-single') }}">Single Category</a></li>
                                    <li><a href="{{ route('parent.forum.page-tabs') }}">About</a></li>
                                    <li><a href="{{ route('parent.forum.page-tabs-guidelines') }}">Guidelines</a></li>
                                    <li><a href="_demo_modal-advancedSearch.html">Advanced Search</a></li> 
                                    <li><a href="error404.html">Error 404</a></li> 
                                    <li><a href="_demo_modal-age-confirmation.html">Age Verification</a></li
                                    <li><a href="_demo_modal-level-up.html">Level up Notification</a></li>
                                        <li><a href="messages-page.html">Message</a></li>
                                        <li><a href="messages-compose.html">Message Compose</a></li>
                                </ul>
                            </li> -->
                        </ul>
                        
                        @elseif(Session::get('role_id') == '6')
                        <ul>
                            <li class="{{ (request()->is('student/forum/page-categories')) ? 'active' : '' }}"><a href="{{ route('student.forum.page-categories') }}"><span>Categories</span></a></li>
                            <li class="{{ (request()->is('student/forum/page-tabs')) ? 'active' : '' }}"><a href="{{ route('student.forum.page-tabs') }}"><span>Trending</span></a></li>
                            <li class="{{ (request()->is('student/forum/page-create-topic')) ? 'active' : '' }}"><a href="{{ route('student.forum.page-create-topic') }}"><span>New post</span></a></li>
                            <li class="{{ (request()->is('student/forum/page-single-user')) ? 'active' : '' }}"><a href="{{ route('student.forum.page-single-user') }}"><span>Single User Activity</span></a></li>
                            <!-- <li class="{{ (request()->is('student/forum/page-single-user')) ? 'active' : '' }}">
                                <a href="{{ route('student.forum.page-single-user') }}"><span>Pages</span></a>
                                <ul>
                                    <li class="{{ (request()->is('student/forum/index')) ? 'active' : '' }}"><a href="{{ route('student.forum.index') }}">Home</a></li>
                                    <li class="{{ (request()->is('student/forum/page-single-topic')) ? 'active' : '' }}"><a href="{{ route('student.forum.page-single-topic') }}">Single Topic</a></li>
                                    <li><a href="{{ route('student.forum.page-create-topic') }}">Create Topic</a></li>
                                    <li><a href="{{ route('student.forum.page-single-user') }}">Single User Activity</a></li>
                                    <li><a href="{{ route('student.forum.page-single-threads') }}">Single User Threads</a></li>
                                    <li><a href="{{ route('student.forum.page-single-replies') }}">Single User Replies</a></li>
                                    <li><a href="{{ route('student.forum.page-single-followers') }}">Single User Followers</a></li>
                                    <li><a href="{{ route('student.forum.page-single-categories') }}">Single User Categories</a></li>
                                    <li><a href="page-single_settings.html">Single User Settings</a></li> 
                                    <li><a href="{{ route('student.forum.page-categories') }}">Categories</a></li>
                                    <li><a href="{{ route('student.forum.page-categories-single') }}">Single Category</a></li>
                                    <li><a href="{{ route('student.forum.page-tabs') }}">About</a></li>
                                    <li><a href="{{ route('student.forum.page-tabs-guidelines') }}">Guidelines</a></li>
                                    <li><a href="_demo_modal-advancedSearch.html">Advanced Search</a></li> 
                                    <li><a href="error404.html">Error 404</a></li> 
                                    <li><a href="_demo_modal-age-confirmation.html">Age Verification</a></li> 
                                    <li><a href="_demo_modal-level-up.html">Level up Notification</a></li>
                                        <li><a href="messages-page.html">Message</a></li>
                                        <li><a href="messages-compose.html">Message Compose</a></li> 
                                </ul>
                            </li> -->
                        </ul>
                        @else
                        @endif
                    </nav>
                </div>
                <!-- /desctop menu -->
                <!-- tt-search -->
                <div class="tt-search">
                    <!-- toggle -->
                    <button class="tt-search-toggle" data-toggle="modal" data-target="#modalAdvancedSearch">
                        <svg class="tt-icon">
                            <use xlink:href="#icon-search"></use>
                        </svg>
                    </button>
                    <!-- /toggle -->
                    <form class="search-wrapper">
                      <!--  <div class="search-form">
                            <input type="text" class="tt-search__input" placeholder="Search">
                            <button class="tt-search__btn" type="submit">
                                <svg class="tt-icon">
                                    <use xlink:href="#icon-search"></use>
                                </svg>
                            </button>
                            <button class="tt-search__close">
                                <svg class="tt-icon">
                                    <use xlink:href="#cancel"></use>
                                </svg>
                            </button>
                        </div> -->
                        @if(Session::get('role_id') == '1')
                        <div class="search-results">
                            <div class="tt-search-scroll">
                                <ul>
                                    <li>
                                        <a href="{{ route('super_admin.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Rdr2 secret easter eggs</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('super_admin.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Top 10 easter eggs in Red Dead Rede..</h6>
                                            <div class="tt-description">
                                                You can find these easter eggs in Red Dea..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('super_admin.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Red Dead Redemtion: Arthur Morgan..</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('super_admin.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Rdr2 secret easter eggs</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('super_admin.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Top 10 easter eggs in Red Dead Rede..</h6>
                                            <div class="tt-description">
                                                You can find these easter eggs in Red Dea..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('super_admin.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Red Dead Redemtion: Arthur Morgan..</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <button type="button" class="tt-view-all" data-toggle="modal" data-target="#modalAdvancedSearch">Advanced Search</button>
                        </div>
                        @elseif(Session::get('role_id') == '2')
                        <div class="search-results">
                            <div class="tt-search-scroll">
                                <ul>
                                    <li>
                                        <a href="{{ route('admin.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Rdr2 secret easter eggs</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Top 10 easter eggs in Red Dead Rede..</h6>
                                            <div class="tt-description">
                                                You can find these easter eggs in Red Dea..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Red Dead Redemtion: Arthur Morgan..</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Rdr2 secret easter eggs</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Top 10 easter eggs in Red Dead Rede..</h6>
                                            <div class="tt-description">
                                                You can find these easter eggs in Red Dea..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Red Dead Redemtion: Arthur Morgan..</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <button type="button" class="tt-view-all" data-toggle="modal" data-target="#modalAdvancedSearch">Advanced Search</button>
                        </div>
                        @elseif(Session::get('role_id') == '3')
                        <div class="search-results">
                            <div class="tt-search-scroll">
                                <ul>
                                    <li>
                                        <a href="{{ route('staff.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Rdr2 secret easter eggs</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('staff.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Top 10 easter eggs in Red Dead Rede..</h6>
                                            <div class="tt-description">
                                                You can find these easter eggs in Red Dea..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('staff.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Red Dead Redemtion: Arthur Morgan..</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('staff.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Rdr2 secret easter eggs</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('staff.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Top 10 easter eggs in Red Dead Rede..</h6>
                                            <div class="tt-description">
                                                You can find these easter eggs in Red Dea..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('staff.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Red Dead Redemtion: Arthur Morgan..</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <button type="button" class="tt-view-all" data-toggle="modal" data-target="#modalAdvancedSearch">Advanced Search</button>
                        </div>
                        @elseif(Session::get('role_id') == '4')
                        <div class="search-results">
                            <div class="tt-search-scroll">
                                <ul>
                                    <li>
                                        <a href="{{ route('teacher.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Rdr2 secret easter eggs</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('teacher.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Top 10 easter eggs in Red Dead Rede..</h6>
                                            <div class="tt-description">
                                                You can find these easter eggs in Red Dea..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('teacher.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Red Dead Redemtion: Arthur Morgan..</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('teacher.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Rdr2 secret easter eggs</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('teacher.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Top 10 easter eggs in Red Dead Rede..</h6>
                                            <div class="tt-description">
                                                You can find these easter eggs in Red Dea..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('teacher.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Red Dead Redemtion: Arthur Morgan..</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <button type="button" class="tt-view-all" data-toggle="modal" data-target="#modalAdvancedSearch">Advanced Search</button>
                        </div>
                        @elseif(Session::get('role_id') == '5')
                        <div class="search-results">
                            <div class="tt-search-scroll">
                                <ul>
                                    <li>
                                        <a href="{{ route('parent.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Rdr2 secret easter eggs</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('parent.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Top 10 easter eggs in Red Dead Rede..</h6>
                                            <div class="tt-description">
                                                You can find these easter eggs in Red Dea..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('parent.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Red Dead Redemtion: Arthur Morgan..</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('parent.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Rdr2 secret easter eggs</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('parent.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Top 10 easter eggs in Red Dead Rede..</h6>
                                            <div class="tt-description">
                                                You can find these easter eggs in Red Dea..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('parent.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Red Dead Redemtion: Arthur Morgan..</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <button type="button" class="tt-view-all" data-toggle="modal" data-target="#modalAdvancedSearch">Advanced Search</button>
                        </div>
                        @elseif(Session::get('role_id') == '6')
                        <div class="search-results">
                            <div class="tt-search-scroll">
                                <ul>
                                    <li>
                                        <a href="{{ route('student.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Rdr2 secret easter eggs</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('student.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Top 10 easter eggs in Red Dead Rede..</h6>
                                            <div class="tt-description">
                                                You can find these easter eggs in Red Dea..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('student.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Red Dead Redemtion: Arthur Morgan..</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('student.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Rdr2 secret easter eggs</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('student.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Top 10 easter eggs in Red Dead Rede..</h6>
                                            <div class="tt-description">
                                                You can find these easter eggs in Red Dea..
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('student.forum.page-single-topic') }}">
                                            <h6 class="tt-title">Red Dead Redemtion: Arthur Morgan..</h6>
                                            <div class="tt-description">
                                                Here’s what I’ve found in Red Dead Redem..
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <button type="button" class="tt-view-all" data-toggle="modal" data-target="#modalAdvancedSearch">Advanced Search</button>
                        </div>
                        @endif
                    </form>
                </div>
                <!-- /tt-search -->
            </div>
            <div class="col-auto ml-auto">
                <div class="tt-account-btn">
                        @if(Session::get('role_id') == '1')
                        <a href="{{ route('super_admin.dashboard') }}" class="btn btn-secondary">Dashboard</a>
                        @elseif(Session::get('role_id') == '2')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Dashboard</a>
                        @elseif(Session::get('role_id') == '3')
                        <a href="{{ route('staff.dashboard') }}" class="btn btn-secondary">Dashboard</a>
                        @elseif(Session::get('role_id') == '4')
                        <a href="{{ route('teacher.dashboard') }}" class="btn btn-secondary">Dashboard</a>
                        @elseif(Session::get('role_id') == '5')
                        <a href="{{ route('parent.dashboard') }}" class="btn btn-secondary">Dashboard</a>
                        @elseif(Session::get('role_id') == '6')
                        <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">Dashboard</a>
                        @endif
                </div>
            </div>
        </div>
    </div>
</header>
