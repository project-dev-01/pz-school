<style>
    .menu-arrow {
        transition: transform .15s;
        position: absolute;
        right: 10px;
        display: inline-block;
        font-family: 'Material Design Icons';
        text-rendering: auto;
        line-height: 1.5rem;
        font-size: 1.1rem;
        transform: translate(0, 0);
    }
</style>
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu" style="background-color:#2F2F8F">
    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-toggle="dropdown">Geneva Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user mr-1"></i>
                        <span>{{ __('messages.my_account') }}</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings mr-1"></i>
                        <span>{{ __('messages.settings') }}</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock mr-1"></i>
                        <span>{{ __('messages.lock_screen') }}</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out mr-1"></i>
                        <span>{{ __('messages.logout') }}</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">{{ __('messages.admin_head') }}</p>

        </div>

        @php
            $role_id = session('role_id');
            $branch_id = session('branch_id');
            $mainmenudata = [
                'role_id' => $role_id,
                'br_id' => $branch_id,
                'type' => 'Mainmenu'
            ];
            $submenudata = [
                'role_id' => $role_id,
                'br_id' => $branch_id,
                'type' => 'Submenu'
            ];
            $childmenudata = [
                'role_id' => $role_id,
                'br_id' => $branch_id,
                'type' => 'Childmenu'
            ];
            $mainmenu = App\Helpers\Helper::PostMethod(config('constants.api.menuaccess_list'), $mainmenudata);
            $submenu = App\Helpers\Helper::PostMethod(config('constants.api.menuaccess_list'), $submenudata);
            $childmenu = App\Helpers\Helper::PostMethod(config('constants.api.menuaccess_list'), $childmenudata);
        @endphp
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- <ul class="list-unstyled topnav-menu mb-0">
                <li>
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('images/favicon.ico') }}" alt="user-image" height="50px" width="50px" class="rounded-circle admin_picture">
                        <span style="color:#0ABAB5"><b> {{ Session::get('school_name') }}</b> </span>
                    </a>
                </li>

            </ul><br> -->
            <ul id="side-menu">
                <li class="menu-title"> {{ __('messages.menu_details') }}</li>

                @if(Session::get('role_id'))
                @if(Session::get('role_id') == '1')
                <li>
                    <a href="#sidebarBranch" data-toggle="collapse">
                        <i class="fe-git-branch"></i>
                        <span>{{ __('messages.branch') }}</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarBranch">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('branch.index')}}" class="nav-link {{ (request()->is('super_admin/branch*')) ? 'active' : '' }}">
                                    <span>{{ __('messages.branch_list') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('branch.create')}}" class="nav-link {{ (request()->is('super_admin/branch*')) ? 'active' : '' }}">
                                    <span> {{ __('messages.create_branch') }} </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarmenu" data-toggle="collapse">
                        <i class="fe-git-branch"></i>
                        <span>{{ __('messages.menus') }}</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarmenu">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('super_admin.createmenu')}}" class="nav-link {{ (request()->is('super_admin/branch*')) ? 'active' : '' }}">
                                    <span>{{ __('messages.menu_list') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('super_admin.menuaccess')}}" class="nav-link {{ (request()->is('super_admin/branch*')) ? 'active' : '' }}">
                                    <span> {{ __('messages.menu_access') }} </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="{{ route('super_admin.branch_url_permission')}}" target=”_blank” class="nav-link {{ (request()->is('application-form')) ? 'active' : '' }}">

                        <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="12.7998" y="10.4095" width="6.4" height="4.8" rx="1" fill="#C4C7D2" />
                            <rect x="12.7998" y="16.8095" width="11.2" height="3.2" rx="1" fill="#C4C7D2" />
                            <rect x="12.7998" y="21.6095" width="8" height="3.2" rx="1" fill="#C4C7D2" />
                            <rect y="0.809509" width="11.2" height="24" rx="1" fill="#C4C7D2" />
                            <rect x="12.7998" y="0.809509" width="11.2" height="3.2" rx="1" fill="#C4C7D2" />
                            <rect x="12.7998" y="5.6095" width="11.2" height="3.2" rx="1" fill="#C4C7D2" />
                        </svg>
                        <span>{{ __('messages.branch_url_permission') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('super_admin.forum.rolls-chooseforum')}}" target=”_blank” class="nav-link {{ (request()->is('super_admin/forum*')) ? 'active' : '' }}">
                        <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.7502 9.30668C17.8006 11.08 18.5614 13.3232 18.0297 16.063L18.1258 16.1133C18.7084 16.3704 19.291 16.6246 19.8708 16.8876C19.9065 16.9085 19.9482 16.9152 19.9882 16.9065C20.0282 16.8978 20.0638 16.8743 20.0886 16.8403C20.3797 16.5337 20.7448 16.3154 21.1452 16.2084C21.5456 16.1015 21.9663 16.1101 22.3624 16.2332C22.7585 16.3563 23.1153 16.5894 23.3947 16.9076C23.6741 17.2259 23.8657 17.6173 23.9491 18.0403C24.012 18.3706 24.0073 18.7111 23.9353 19.0394C23.8634 19.3677 23.7258 19.6763 23.5316 19.9451C23.3374 20.2139 23.091 20.4367 22.8086 20.599C22.5262 20.7612 22.2141 20.8591 21.8929 20.8864C21.5717 20.9137 21.2486 20.8697 20.9448 20.7572C20.641 20.6447 20.3634 20.4664 20.1303 20.2339C19.8971 20.0014 19.7136 19.72 19.5919 19.4082C19.4702 19.0963 19.413 18.7611 19.424 18.4245C19.4232 18.3987 19.417 18.3734 19.4058 18.3504C19.3945 18.3274 19.3785 18.3073 19.3589 18.2915C18.7452 18.0137 18.1258 17.7418 17.5121 17.4699C17.382 17.6886 17.2632 17.9132 17.1247 18.1201C16.6513 18.8423 16.0411 19.4553 15.3318 19.921C14.6225 20.3867 13.8292 20.6952 13.0012 20.8274C12.7806 20.8658 12.5543 20.8776 12.3309 20.8953C12.2987 20.8918 12.2663 20.8994 12.2387 20.917C12.2111 20.9347 12.1898 20.9613 12.1782 20.9929C11.9249 21.51 11.5314 21.9376 11.0469 22.2224C10.2821 22.6883 9.43592 22.9897 8.55807 23.109C8.25546 23.1593 7.9472 23.1918 7.6361 23.2184C8.51284 22.4411 9.333 21.6224 9.64127 20.4077C8.16806 19.7444 6.99821 18.5102 6.37755 16.9645L5.67333 17.1566C5.35658 17.2423 5.03982 17.3339 4.72024 17.4108C4.67274 17.4159 4.62875 17.4393 4.59687 17.4765C4.56498 17.5136 4.54745 17.5618 4.5477 17.6117C4.5056 18.0375 4.35106 18.4426 4.10135 18.7818C3.85163 19.1211 3.51658 19.3811 3.13361 19.5328C2.73522 19.6951 2.30127 19.7373 1.88107 19.6546C1.46087 19.572 1.0713 19.3678 0.75663 19.0653C0.441959 18.7627 0.214815 18.374 0.101024 17.9433C-0.012767 17.5126 -0.00863717 17.0572 0.112934 16.6288C0.234506 16.2004 0.468643 15.8162 0.788737 15.52C1.10883 15.2238 1.50204 15.0273 1.92365 14.953C2.34527 14.8786 2.77838 14.9294 3.17376 15.0995C3.56914 15.2696 3.91092 15.5522 4.16024 15.9152C4.17675 15.9377 4.19826 15.9557 4.2229 15.9675C4.24754 15.9794 4.27457 15.9848 4.30165 15.9832C4.84749 15.8384 5.39334 15.6877 5.93918 15.531C5.95679 15.5247 5.97382 15.5168 5.99009 15.5074C5.7885 14.2001 5.97739 12.8597 6.53104 11.6687C7.0847 10.4777 7.97621 9.49398 9.08413 8.85153C8.99363 8.621 8.9003 8.39046 8.80131 8.16289C8.65424 7.7964 8.51848 7.42991 8.36576 7.06343C8.35651 7.02904 8.33566 6.99932 8.30707 6.97976C8.27847 6.9602 8.24406 6.95213 8.21021 6.95703C7.77372 6.97049 7.3427 6.8528 6.96829 6.61795C6.59388 6.38309 6.29179 6.04091 6.09789 5.63203C5.90399 5.22314 5.82641 4.7647 5.87435 4.31111C5.92229 3.85753 6.09373 3.42784 6.36835 3.07302C6.64297 2.71821 7.00921 2.45317 7.42364 2.30936C7.83807 2.16555 8.28329 2.14901 8.70646 2.26169C9.12962 2.37436 9.51295 2.61154 9.81099 2.94507C10.109 3.2786 10.3093 3.69448 10.3879 4.14336C10.464 4.52537 10.4449 4.92139 10.3324 5.29348C10.22 5.66557 10.0181 6.00126 9.74591 6.26839C9.70851 6.29789 9.68309 6.34102 9.67471 6.3892C9.66633 6.43739 9.67559 6.4871 9.70067 6.52848C9.92127 7.06934 10.1334 7.61316 10.3512 8.15402C10.3653 8.19244 10.3851 8.23086 10.4077 8.28111C11.7676 7.88531 13.2163 7.98965 14.5114 8.57666L16.5958 4.79653C16.2104 4.35192 16.0011 3.77083 16.0104 3.17099C16.0171 2.83804 16.0903 2.51023 16.2254 2.20858C16.3604 1.90692 16.5542 1.63807 16.7944 1.41925C17.0347 1.20042 17.316 1.03645 17.6204 0.937846C17.9248 0.839238 18.2455 0.808167 18.562 0.846622C18.8786 0.885077 19.184 0.992209 19.4586 1.16116C19.7332 1.33011 19.971 1.55714 20.1568 1.82772C20.3426 2.0983 20.4722 2.40645 20.5374 2.73243C20.6026 3.05841 20.602 3.39503 20.5355 3.72072C20.4204 4.27722 20.117 4.77163 19.6811 5.11315C19.2452 5.45467 18.706 5.62035 18.1626 5.57975C18.0578 5.55534 17.9482 5.57195 17.8543 5.62642C17.7605 5.68089 17.689 5.76945 17.6535 5.8753C17.0624 6.97772 16.4516 8.06831 15.8491 9.16481C15.8039 9.20324 15.7756 9.25939 15.7502 9.30668Z" fill="#C4C7D2" />
                        </svg>
                        <span>{{ __('messages.forum') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('super_admin.settings')}}" class="nav-link {{ (request()->is('super_admin/settings*')) ? 'active' : '' }}">
                        <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_183_623)">
                                <path d="M12.1446 13.2052H1.08183C0.869875 13.2189 0.658928 13.1661 0.478476 13.0541C0.298024 12.9421 0.157088 12.7765 0.0753688 12.5806C0.0162938 12.4358 -0.00790928 12.2791 0.00472456 12.1232C0.0173584 11.9674 0.0664742 11.8166 0.148099 11.6832C0.229724 11.5498 0.341567 11.4374 0.474624 11.3552C0.60768 11.273 0.758225 11.2231 0.91409 11.2097H12.1404C12.2075 11.0127 12.262 10.8199 12.3417 10.6354C12.6013 10.027 13.0085 9.49288 13.5266 9.0814C14.0446 8.66992 14.6571 8.39407 15.3087 8.27879C15.9602 8.1635 16.6303 8.21244 17.2581 8.42116C17.886 8.62989 18.4519 8.99181 18.9047 9.47419C19.3394 9.92582 19.6537 10.4793 19.8189 11.084C19.8214 11.1037 19.8279 11.1228 19.838 11.14C19.8482 11.1571 19.8617 11.172 19.8778 11.1838C19.8939 11.1956 19.9122 11.2039 19.9316 11.2084C19.951 11.2129 19.9712 11.2133 19.9908 11.2097H22.9599C23.0966 11.2009 23.2338 11.2202 23.3629 11.2664C23.4919 11.3126 23.6101 11.3848 23.7101 11.4786C23.8101 11.5723 23.8898 11.6855 23.9443 11.8112C23.9988 11.937 24.0269 12.0725 24.0269 12.2096C24.0269 12.3466 23.9988 12.4822 23.9443 12.6079C23.8898 12.7336 23.8101 12.8469 23.7101 12.9406C23.6101 13.0343 23.4919 13.1065 23.3629 13.1527C23.2338 13.199 23.0966 13.2182 22.9599 13.2094H20.0034C19.9819 13.2058 19.9599 13.2066 19.9387 13.2116C19.9174 13.2167 19.8975 13.2259 19.8799 13.2388C19.8623 13.2517 19.8475 13.268 19.8363 13.2867C19.8251 13.3054 19.8177 13.3261 19.8147 13.3477C19.6446 13.9597 19.3259 14.5203 18.8869 14.9796C18.448 15.4388 17.9023 15.7826 17.2985 15.9804C16.7887 16.1679 16.2448 16.2443 15.7031 16.2045C15.1613 16.1648 14.6344 16.0097 14.1575 15.7498C13.2958 15.3082 12.6302 14.5606 12.2913 13.6538C12.2368 13.528 12.1991 13.3771 12.1446 13.2052ZM17.9946 12.2075C17.9946 11.8128 17.8776 11.427 17.6582 11.0988C17.4389 10.7707 17.1271 10.5149 16.7624 10.3639C16.3976 10.2129 15.9963 10.1734 15.609 10.2503C15.2218 10.3273 14.8662 10.5174 14.587 10.7965C14.3078 11.0755 14.1177 11.4311 14.0407 11.8182C13.9637 12.2053 14.0032 12.6065 14.1543 12.9711C14.3054 13.3357 14.5612 13.6474 14.8895 13.8666C15.2177 14.0859 15.6037 14.2029 15.9985 14.2029C16.5261 14.2018 17.0319 13.9924 17.4058 13.6202C17.7797 13.248 17.9913 12.7433 17.9946 12.2158V12.2075Z" fill="#C4C7D2" />
                                <path d="M11.8636 3.21532H22.9473C23.212 3.20031 23.4718 3.29103 23.6696 3.46753C23.8674 3.64402 23.987 3.89184 24.002 4.15645C24.017 4.42106 23.9263 4.6808 23.7497 4.87853C23.5731 5.07625 23.3252 5.19576 23.0605 5.21077H11.8636C11.8007 5.38684 11.7504 5.56291 11.6791 5.73479C11.3185 6.64417 10.626 7.38284 9.74164 7.80152C8.97625 8.18733 8.10311 8.304 7.26322 8.13269C6.59295 8.01156 5.9657 7.71834 5.44298 7.28179C4.92026 6.84525 4.52004 6.28037 4.28157 5.64257C4.23932 5.54113 4.20701 5.43584 4.18512 5.32816C4.18512 5.22755 4.10963 5.21077 4.01737 5.21077H1.0483C0.850824 5.22166 0.654671 5.17266 0.485548 5.07017C0.316424 4.96769 0.182231 4.8165 0.100549 4.63645C0.0296053 4.48724 -0.00316568 4.32276 0.00517975 4.15777C0.0135252 3.99277 0.0627245 3.83243 0.148362 3.69113C0.234 3.54984 0.353389 3.43201 0.495824 3.34823C0.63826 3.26445 0.799285 3.21734 0.964431 3.21113C1.96251 3.21113 2.96058 3.21113 3.96286 3.21113C3.99043 3.21526 4.01854 3.21385 4.04557 3.20699C4.07259 3.20013 4.09799 3.18796 4.12024 3.17117C4.1425 3.15439 4.16118 3.13333 4.1752 3.10924C4.18922 3.08515 4.1983 3.0585 4.20189 3.03086C4.39199 2.37157 4.75385 1.7746 5.25047 1.30098C5.7471 0.827369 6.36065 0.494118 7.02838 0.335318C7.96437 0.0791761 8.96308 0.193273 9.81712 0.653918C10.3026 0.896827 10.7317 1.23867 11.077 1.65745C11.4222 2.07622 11.6759 2.56263 11.8217 3.08536C11.8328 3.12954 11.8468 3.17295 11.8636 3.21532V3.21532ZM5.99256 4.20466C5.9909 4.59932 6.10636 4.98561 6.32432 5.31467C6.54228 5.64374 6.85296 5.90081 7.21707 6.05337C7.58118 6.20593 7.98237 6.24713 8.3699 6.17176C8.75744 6.09639 9.11392 5.90784 9.39426 5.62995C9.67459 5.35205 9.8662 4.9973 9.94485 4.61054C10.0235 4.22379 9.98565 3.82242 9.8361 3.45716C9.68655 3.09191 9.43202 2.77919 9.10468 2.55855C8.77734 2.33791 8.3919 2.21925 7.9971 2.21758C7.47054 2.22087 6.96642 2.43115 6.59369 2.80297C6.22095 3.17479 6.00954 3.67829 6.00514 4.20466H5.99256Z" fill="#C4C7D2" />
                                <path d="M11.8931 21.2373C11.7212 21.5978 11.5828 21.9709 11.3773 22.3105C10.8929 23.1349 10.1135 23.7447 9.19662 24.0167C8.28691 24.3027 7.30472 24.2526 6.42883 23.8756C5.55295 23.4986 4.84161 22.8197 4.42429 21.9625C4.33161 21.7581 4.25177 21.5481 4.18525 21.3337C4.17906 21.2943 4.15748 21.2589 4.12526 21.2353C4.09303 21.2118 4.05278 21.2019 4.01331 21.2079H1.02747C0.824324 21.2115 0.624969 21.1527 0.456263 21.0395C0.287557 20.9263 0.157605 20.7642 0.083909 20.5749C0.0243472 20.4226 0.00299598 20.258 0.0217242 20.0955C0.0404525 19.933 0.0986889 19.7776 0.191347 19.6428C0.284005 19.508 0.408267 19.3979 0.553284 19.3222C0.6983 19.2464 0.859659 19.2073 1.02327 19.2083C1.57263 19.2083 2.12201 19.2083 2.67137 19.2083C3.12008 19.2083 3.5688 19.2083 4.01751 19.2083C4.03847 19.2119 4.05993 19.2112 4.08063 19.2064C4.10133 19.2015 4.12086 19.1926 4.13805 19.1801C4.15525 19.1676 4.16976 19.1518 4.18075 19.1336C4.19174 19.1154 4.19898 19.0952 4.20203 19.0741C4.37111 18.4413 4.70207 17.8634 5.16236 17.3973C5.84552 16.6988 6.76143 16.2754 7.73624 16.2074C8.71105 16.1394 9.67691 16.4316 10.4505 17.0284C11.1141 17.5333 11.5966 18.2391 11.826 19.0406C11.826 19.0825 11.8554 19.1286 11.8721 19.1873H22.9433C23.0786 19.175 23.2151 19.1903 23.3443 19.2324C23.4736 19.2744 23.5929 19.3423 23.6951 19.4319C23.7973 19.5215 23.8802 19.631 23.9387 19.7536C23.9972 19.8762 24.0302 20.0095 24.0356 20.1452C24.041 20.281 24.0188 20.4165 23.9702 20.5433C23.9216 20.6702 23.8477 20.7859 23.7529 20.8834C23.6582 20.9808 23.5446 21.058 23.4191 21.1102C23.2936 21.1624 23.1588 21.1885 23.0229 21.187H11.8595L11.8931 21.2373ZM6.02205 20.2018C6.02206 20.5961 6.13892 20.9816 6.3579 21.3096C6.57687 21.6375 6.88813 21.8933 7.25239 22.0446C7.61665 22.1958 8.01758 22.2359 8.40457 22.1595C8.79155 22.0832 9.14725 21.894 9.42675 21.6158C9.70625 21.3375 9.89702 20.9828 9.97498 20.5962C10.0529 20.2097 10.0146 19.8088 9.86482 19.444C9.71502 19.0792 9.46047 18.767 9.1333 18.5467C8.80614 18.3265 8.42104 18.208 8.0266 18.2064C7.7622 18.2025 7.49966 18.2512 7.25431 18.3498C7.00896 18.4484 6.7857 18.5948 6.59755 18.7806C6.4094 18.9663 6.26014 19.1877 6.15845 19.4317C6.05677 19.6757 6.00469 19.9375 6.00528 20.2018H6.02205Z" fill="#C4C7D2" />
                            </g>
                            <defs>
                                <clipPath id="clip0_183_623">
                                    <rect width="28" height="28" fill="white" transform="translate(0 0.209534)" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span>{{ __('messages.settings') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('super_admin.faq.index')}}" class="nav-link {{ (request()->is('super_admin/settings*')) ? 'active' : '' }}">
                        <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_183_632)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.08171 0.243231C2.76064 0.356801 1.51649 1.08837 0.766601 2.19249C0.563862 2.491 0.313088 3.0067 0.206566 3.34412C-0.0108295 4.03279 9.10194e-05 3.64385 9.10194e-05 10.7017C9.10194e-05 17.7985 -0.0103579 17.4431 0.218249 18.1251C0.783 19.8098 2.24727 20.9967 4.01002 21.1985C4.21762 21.2223 6.14711 21.2359 9.33259 21.2361L14.3295 21.2364L17.1521 22.6456C19.6315 23.8836 20.0147 24.0643 20.3047 24.1323C20.7038 24.226 21.3091 24.2358 21.6552 24.1543C22.7744 23.8906 23.6145 23.0619 23.9188 21.9216L24 21.6171V12.9507C24 4.76607 23.9964 4.26609 23.935 3.95787C23.7437 2.99724 23.3238 2.19224 22.6767 1.54552C21.9275 0.796687 20.9561 0.34469 19.8793 0.243884C19.3945 0.198485 4.6092 0.197904 4.08171 0.243231ZM13.2584 4.79739C14.1859 4.95024 15.0177 5.41057 15.4892 6.03187C15.7075 6.31954 15.934 6.767 16.0177 7.07634C16.0994 7.37804 16.1305 8.18133 16.0742 8.53503C15.9406 9.37361 15.421 10.0903 14.2783 11.0123C13.5617 11.5904 13.4241 11.8211 13.4241 12.4444V12.7875H12.1673H10.9105L10.9306 12.1983C10.967 11.13 11.0667 10.9567 12.2268 9.94396C13.0331 9.24002 13.3465 8.90536 13.5369 8.54493C13.6082 8.40985 13.6227 8.33044 13.6207 8.0839C13.6186 7.8284 13.6031 7.75632 13.5115 7.57726C13.2591 7.0841 12.6479 6.87473 11.9445 7.04048C11.6293 7.11475 11.4476 7.21548 11.2416 7.43018C11.033 7.64764 10.9004 7.90274 10.8408 8.20113C10.8169 8.32043 10.7944 8.42287 10.7908 8.42882C10.7783 8.44916 8.29035 8.28229 8.26607 8.25948C8.22791 8.22361 8.33381 7.64042 8.4391 7.30686C8.55531 6.93859 8.73591 6.57035 8.94456 6.27635C9.16446 5.9665 9.66061 5.51163 10.001 5.30781C10.8525 4.79801 12.0877 4.60445 13.2584 4.79739ZM12.644 13.7864C13.6441 14.0605 14.0314 15.4191 13.3305 16.1944C12.9998 16.5603 12.6095 16.719 12.0949 16.6969C11.8009 16.6842 11.7326 16.6673 11.49 16.5475C11.1741 16.3915 10.9429 16.1591 10.7863 15.8404C10.6931 15.6508 10.6849 15.6001 10.6849 15.217C10.6849 14.8399 10.6942 14.7801 10.7827 14.5914C11.107 13.8997 11.8636 13.5725 12.644 13.7864Z" fill="#C4C7D2" />
                            </g>
                            <defs>
                                <clipPath id="clip0_183_632">
                                    <rect width="28" height="28" fill="white" transform="translate(0 0.209534)" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span> {{ __('messages.faqs') }} </span>
                    </a>
                </li>
                @elseif(Session::get('role_id') == '7')

                <li>
                    <a href="{{ route('guest.dashboard')}}" class="nav-link {{ (request()->is('guest/dashboard*')) ? 'active' : '' }}">
                        <!--<i data-feather="airplay" class="icon-dual"></i>-->
                        <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.33333 13.3333H9.33333C9.68696 13.3333 10.0261 13.1929 10.2761 12.9428C10.5262 12.6928 10.6667 12.3536 10.6667 12V1.33333C10.6667 0.979711 10.5262 0.640573 10.2761 0.390524C10.0261 0.140476 9.68696 0 9.33333 0H1.33333C0.979711 0 0.640573 0.140476 0.390524 0.390524C0.140476 0.640573 0 0.979711 0 1.33333V12C0 12.3536 0.140476 12.6928 0.390524 12.9428C0.640573 13.1929 0.979711 13.3333 1.33333 13.3333ZM0 22.6667C0 23.0203 0.140476 23.3594 0.390524 23.6095C0.640573 23.8595 0.979711 24 1.33333 24H9.33333C9.68696 24 10.0261 23.8595 10.2761 23.6095C10.5262 23.3594 10.6667 23.0203 10.6667 22.6667V17.3333C10.6667 16.9797 10.5262 16.6406 10.2761 16.3905C10.0261 16.1405 9.68696 16 9.33333 16H1.33333C0.979711 16 0.640573 16.1405 0.390524 16.3905C0.140476 16.6406 0 16.9797 0 17.3333V22.6667ZM13.3333 22.6667C13.3333 23.0203 13.4738 23.3594 13.7239 23.6095C13.9739 23.8595 14.313 24 14.6667 24H22.6667C23.0203 24 23.3594 23.8595 23.6095 23.6095C23.8595 23.3594 24 23.0203 24 22.6667V13.3333C24 12.9797 23.8595 12.6406 23.6095 12.3905C23.3594 12.1405 23.0203 12 22.6667 12H14.6667C14.313 12 13.9739 12.1405 13.7239 12.3905C13.4738 12.6406 13.3333 12.9797 13.3333 13.3333V22.6667ZM14.6667 9.33333H22.6667C23.0203 9.33333 23.3594 9.19286 23.6095 8.94281C23.8595 8.69276 24 8.35362 24 8V1.33333C24 0.979711 23.8595 0.640573 23.6095 0.390524C23.3594 0.140476 23.0203 0 22.6667 0H14.6667C14.313 0 13.9739 0.140476 13.7239 0.390524C13.4738 0.640573 13.3333 0.979711 13.3333 1.33333V8C13.3333 8.35362 13.4738 8.69276 13.7239 8.94281C13.9739 9.19286 14.313 9.33333 14.6667 9.33333Z" fill="#C4C7D2" />
                        </svg>
                        <span> {{ __('messages.dashboards') }} </span>
                    </a>
                </li>
                <li class="{{  (request()->is('guest/application/edit*')) ? 'menuitem-active' : '' }}">
                    <a href="#sidebarGuestApplication" data-toggle="collapse">
                        <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_122_3580)">
                                <path d="M0.0202342 7.91378C0.0202342 7.25256 -0.00771459 6.59133 0.0202342 5.93395C0.0563401 5.55371 0.223237 5.19596 0.494462 4.91741C0.765688 4.63885 1.12572 4.45543 1.51749 4.39623C1.64961 4.37648 1.78306 4.36621 1.91676 4.36548H4.60383V1.75135C4.5853 1.51634 4.66449 1.28386 4.82398 1.10507C4.98347 0.926273 5.21019 0.815805 5.45427 0.797962C5.69835 0.78012 5.9398 0.856361 6.1255 1.00992C6.31119 1.16348 6.42593 1.38179 6.44446 1.6168C6.44854 1.69236 6.44854 1.76806 6.44446 1.84361V4.35395H17.5082V4.18095C17.5082 3.37749 17.5082 2.57787 17.5082 1.77826C17.5023 1.54171 17.5944 1.31264 17.764 1.14141C17.9336 0.970189 18.1668 0.870841 18.4125 0.865233C18.6582 0.859625 18.8961 0.948214 19.0739 1.11151C19.2518 1.2748 19.355 1.49943 19.3608 1.73597C19.3608 2.54712 19.3608 3.35827 19.3608 4.16941V4.36548H22.0678C22.3208 4.35688 22.573 4.39854 22.8086 4.48784C23.0442 4.57715 23.2582 4.71219 23.4372 4.88457C23.6162 5.05695 23.7565 5.26297 23.8492 5.4898C23.942 5.71664 23.9852 5.95943 23.9763 6.20306C23.9763 6.76817 23.9763 7.33328 23.9763 7.90993L0.0202342 7.91378Z" fill="#C4C7D2" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.000144945 9.70129H6V10.8095H8V9.70129H24.0001V22.9526C24.0182 23.3692 23.8838 23.7786 23.6204 24.1095C23.3569 24.4404 22.9812 24.6718 22.5588 24.7633C22.4014 24.7959 22.2407 24.8114 22.0797 24.8094H1.92461C1.49174 24.8272 1.06621 24.6974 0.722953 24.4429C0.379694 24.1883 0.140706 23.8253 0.0480552 23.4178C0.0143581 23.2714 -0.00171658 23.1218 0.000144945 22.9718V9.70129ZM8 11.8095H6V13.8095H8V11.8095Z" fill="#C4C7D2" />
                            </g>
                            <defs>
                                <clipPath id="clip0_122_3580">
                                    <rect width="24" height="24" fill="white" transform="translate(0 0.809509)" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span> {{ __('messages.application') }} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{  (request()->is('guest/application/edit*')) ? 'show' : '' }}" id="sidebarGuestApplication">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('guest.application.index')}}" class="nav-link {{ (request()->is('guest/application') || request()->is('guest/application/edit*')) ? 'active' : '' }}">
                                    <span> {{ __('messages.list') }} </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('guest.application.create')}}" class="nav-link {{ (request()->is('guest/application/create')) ? 'active' : '' }}">
                                    <span> {{ __('messages.add') }} </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                @else
                @if(Session::get('school_roleid')=='1')
                @if(!isset($mainmenu['data']) && $mainmenu['data']==null)
                <li>
                    <a href="#">{{ __('messages.alertmenus1') }} </a>
                </li>
                @else

                @foreach($mainmenu['data'] as $menu)
                @if($menu['menu_status']==1)

                @if($menu['menu_permission']=='Access' )
                @php
                if($menu['menu_dropdown']=='Yes')
                $url=$menu['menu_url'];
                else
                $url= route($menu['menu_url']);
                @endphp
                <li>
                    <a href="{{ $url }}" @if($menu['menu_dropdown']=='Yes' ) data-toggle="collapse" class="collapsed" aria-expanded="false" @else class="nav-link " @endif>
                        <!--<i class="fe-edit"></i>-->
                        {!! $menu['menu_icon'] !!}
                        <span>{{ __("messages.".$menu['menu_name']) }}</span>
                        @if($menu['menu_dropdown']=='Yes')
                        <span class="menu-arrow"></span>
                        @endif

                    </a>

                    @if($menu['menu_dropdown']=='Yes')
                    <div class="collapse" id="{{ str_replace('#','',$menu['menu_url'])}}">
                        <ul class="nav-second-level">
                            @foreach($submenu['data'] as $menu1)
                            @if($menu1['menu_status']==1)
                            @if($menu1['menu_permission']=='Access')
                            @if($menu1['menu_refid']== $menu['menu_id'])
                            @php
                            if($menu1['menu_dropdown']=='Yes')
                            $url1=$menu1['menu_url'];
                            else
                            $url1= route($menu1['menu_url']);
                            @endphp
                            <li>
                                <a href="{{ $url1 }}" @if($menu1['menu_dropdown']=='Yes' ) data-toggle="collapse" class="collapsed" aria-expanded="false" @else class="nav-link " @endif>
                                    <!--<i class="fas fa-user-graduate"></i>-->
                                    <span>{{ __("messages.".$menu1['menu_name']) }}</span>
                                    @if($menu1['menu_dropdown']=='Yes') <span class="menu-arrow"></span> @endif
                                </a>

                                @if($menu1['menu_dropdown']=='Yes')
                                <div class="collapse " id="{{ str_replace('#','',$menu1['menu_url'])}}">
                                    <ul class="nav-second-level">
                                        @foreach($childmenu['data'] as $menu2)
                                        @if($menu2['menu_status']==1)
                                        @if($menu2['menu_permission']=='Access')
                                        @if($menu2['menu_refid']== $menu1['menu_id'])
                                        @php
                                        if($menu2['menu_dropdown']=='Yes')
                                        $url2=$menu2['menu_url'];
                                        else
                                        $url2= route($menu2['menu_url']);
                                        @endphp
                                        <li>
                                            <a href="{{ $url2 }}" class="nav-link ">
                                                <span>{{ __("messages.".$menu2['menu_name']) }}</span>
                                            </a>
                                        </li>
                                        @endif
                                        @endif
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </li>
                            @endif
                            @endif
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </li>
                @endif
                @endif

                @endforeach
                @endif
                @elseif(!empty(Session::get('school_roleid')))
                @php
                $permissionmainmenudata = [
                'role_id' => $role_id,
                'br_id' => $branch_id,
                'scrole_id' => Session::get('school_roleid'),
                'type' => 'Mainmenu'
                ];
                $permissionsubmenudata = [
                'role_id' => $role_id,
                'br_id' => $branch_id,
                'scrole_id' => Session::get('school_roleid'),
                'type' => "Submenu"
                ];
                $permissionchildmenudata = [
                'role_id' => $role_id,
                'br_id' => $branch_id,
                'scrole_id' => Session::get('school_roleid'),
                'type' => "Childmenu"
                ];
                $permissionmainmenu = App\Helpers\Helper::PostMethod(config('constants.api.schoolmenuaccess_list'),$permissionmainmenudata);
             ;
                $permissionsubmenu = App\Helpers\Helper::PostMethod(config('constants.api.schoolmenuaccess_list'),$permissionsubmenudata);
                $permissionchildmenu = App\Helpers\Helper::PostMethod(config('constants.api.schoolmenuaccess_list'),$permissionchildmenudata);

                @endphp
                @if (isset($permissionmainmenu['data']) && ($permissionmainmenu['data'] == '' || $permissionmainmenu['data'] == null)) 

                <li>
                    <a href="#">*.{{ __('messages.alertmenus2') }} </a>
                </li>
                @elseif (isset($permissionmainmenu['data']))

                @foreach($permissionmainmenu['data'] as $menu)
                @if($menu['menu_status']==1)
                @if($menu['menu_read']=='Access')
                @php
                if($menu['menu_dropdown']=='Yes')
                $url=$menu['menu_url'];
                else
                $url= route($menu['menu_url']);

                @endphp

                <li>
                    <a href="{{ $url }}" @if($menu['menu_dropdown']=='Yes' ) data-toggle="collapse" class="collapsed" aria-expanded="false" @else class="nav-link " @endif>
                        <!--<i class="fe-edit"></i>-->
                        {!! $menu['menu_icon'] !!}
                        <span>{{ __("messages.".$menu['menu_name']) }}</span>
                        @if($menu['menu_dropdown']=='Yes')
                        <span class="menu-arrow"></span>
                        @endif

                    </a>

                    @if($menu['menu_dropdown']=='Yes')
                    <div class="collapse" id="{{ str_replace('#','',$menu['menu_url'])}}">
                        <ul class="nav-second-level">
                            @foreach($permissionsubmenu['data'] as $menu1)
                            @if($menu1['menu_status']==1)
                            @if($menu1['menu_read']=='Access')
                            @if($menu1['menu_refid']== $menu['menu_id'])
                            @php
                            if($menu1['menu_dropdown']=='Yes')
                            $url1=$menu1['menu_url'];
                            else
                            $url1= route($menu1['menu_url']);
                            @endphp
                            <li>
                                <a href="{{ $url1 }}" @if($menu1['menu_dropdown']=='Yes' ) data-toggle="collapse" class="collapsed" aria-expanded="false" @else class="nav-link " @endif>
                                    <!--<i class="fas fa-user-graduate"></i>-->
                                    <span>{{ __("messages.".$menu1['menu_name']) }}</span>
                                    @if($menu1['menu_dropdown']=='Yes') <span class="menu-arrow"></span> @endif
                                </a>

                                @if($menu1['menu_dropdown']=='Yes')
                                <div class="collapse " id="{{ str_replace('#','',$menu1['menu_url'])}}">
                                    <ul class="nav-second-level">
                                        @foreach($permissionchildmenu['data'] as $menu2)
                                        @if($menu2['menu_status']==1)
                                        @if($menu2['menu_read']=='Access')
                                        @if($menu2['menu_refid']== $menu1['menu_id'])
                                        @php
                                        if($menu2['menu_dropdown']=='Yes')
                                        $url2=$menu2['menu_url'];
                                        else
                                        $url2= route($menu2['menu_url']);
                                        @endphp
                                        <li>
                                            <a href="{{ $url2 }}" class="nav-link ">
                                                <span>{{ __("messages.".$menu2['menu_name']) }}</span>
                                            </a>
                                        </li>
                                        @endif
                                        @endif
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </li>
                            @endif
                            @endif
                            @endif
                            @endforeach
                            
                        </ul>
                    </div>
                    @endif
                </li>
                @endif
                @endif
                @endforeach
                @endif
                @else
                @if(!isset($mainmenu['data']) && $mainmenu['data']==null)
                <li>
                    <a href="#">{{ __('messages.alertmenus1') }} </a>
                </li>
                @else
                @foreach($mainmenu['data'] as $menu)
                @if($menu['menu_status']==1)
                @if($menu['menu_permission']=='Access' && $menu['menu_id']!='28')
                @php
                if($menu['menu_dropdown']=='Yes')
                $url=$menu['menu_url'];
                else
                $url= route($menu['menu_url']);

                @endphp
                <li>
                    <a href="{{ $url }}" @if($menu['menu_dropdown']=='Yes' ) data-toggle="collapse" class="collapsed" aria-expanded="false" @else class="nav-link " @endif>
                        <!--<i class="fe-edit"></i>-->
                        {!! $menu['menu_icon'] !!}
                        <span>{{ __("messages.".$menu['menu_name']) }}</span>
                        @if($menu['menu_dropdown']=='Yes')
                        <span class="menu-arrow"></span>
                        @endif

                    </a>

                    @if($menu['menu_dropdown']=='Yes')
                    <div class="collapse" id="{{ str_replace('#','',$menu['menu_url'])}}">
                        <ul class="nav-second-level">
                            @foreach($submenu['data'] as $menu1)
                            @if($menu1['menu_status']==1)
                            @if($menu1['menu_permission']=='Access')
                            @if($menu1['menu_refid']== $menu['menu_id'])
                            @php
                            if($menu1['menu_dropdown']=='Yes')
                            $url1=$menu1['menu_url'];
                            else
                            $url1= route($menu1['menu_url']);
                            @endphp
                            <li>
                                <a href="{{ $url1 }}" @if($menu1['menu_dropdown']=='Yes' ) data-toggle="collapse" class="collapsed" aria-expanded="false" @else class="nav-link " @endif>
                                    <!--<i class="fas fa-user-graduate"></i>-->
                                    <span>{{ __("messages.".$menu1['menu_name']) }}</span>
                                    @if($menu1['menu_dropdown']=='Yes') <span class="menu-arrow"></span> @endif
                                </a>

                                @if($menu1['menu_dropdown']=='Yes')
                                <div class="collapse " id="{{ str_replace('#','',$menu1['menu_url'])}}">
                                    <ul class="nav-second-level">
                                        @foreach($childmenu['data'] as $menu2)
                                        @if($menu2['menu_status']==1)
                                        @if($menu2['menu_permission']=='Access')
                                        @if($menu2['menu_refid']== $menu1['menu_id'])
                                        @php
                                        if($menu2['menu_dropdown']=='Yes')
                                        $url2=$menu2['menu_url'];
                                        else
                                        $url2= route($menu2['menu_url']);
                                        @endphp
                                        <li>
                                            <a href="{{ $url2 }}" class="nav-link ">
                                                <span>{{ __("messages.".$menu2['menu_name']) }}</span>
                                            </a>
                                        </li>
                                        @endif
                                        @endif
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </li>
                            @endif
                            @endif
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </li>
                @endif
                @endif
                @endforeach
                @endif
                @endif
                @endif
                @endif
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->