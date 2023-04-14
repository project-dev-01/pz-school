@extends('layouts.forum-layout')
@section('content')
<main id="tt-pageContent" class="tt-offset-small">
    <div class="container">
        <div class="tt-tab-wrapper">
            <div class="tt-wrapper-inner">
                <ul class="nav nav-tabs pt-tabs-default" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link show active" data-toggle="tab" href="#tt-tab-01" role="tab"><span>{{ __('messages.about') }}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-02" role="tab"><span>{{ __('messages.guidelines') }}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-03" role="tab"><span>{{ __('messages.faq') }}</span></a>
                    </li>
                    <li class="nav-item tt-hide-xs">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-04" role="tab"><span>{{ __('messages.terms of service') }}</span></a>
                    </li>
                    <li class="nav-item tt-hide-md">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-05" role="tab"><span>{{ __('messages.privacy') }}</span></a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane show fade active" id="tt-tab-01" role="tabpanel">
                
                    <div class="tt-layout-tab">
                        <div class="tt-wrapper-inner">
                            <h2 class="tt-title">
                            {{ __('messages.about_forum') }}
                            </h2>
                            <p> {{ __('messages.is_a_community') }}</p>
                            <h3 class="tt-title">
                            {{ __('messages.as_the_basis') }}
                            </h3>
                            <p>{{ __('messages.forum_paves_the') }}</p> 
                            <!-- <h3 class="tt-title">
                                Admins
                            </h3>
                            <div class="tt-list-avatar">
                                <div class="row">
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <a href="#" class="tt-avatar">
                                            <div class="tt-col-icon">
                                                <svg class="tt-icon">
                                                    <use xlink:href="#icon-ava-n"></use>
                                                </svg>
                                            </div>
                                            <div class="tt-col-description">
                                                <h6 class="tt-title">Nitish</h6>
                                                <div class="tt-value">@nitish92</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <a href="#" class="tt-avatar">
                                            <div class="tt-col-icon">
                                                <svg class="tt-icon">
                                                    <use xlink:href="#icon-ava-t"></use>
                                                </svg>
                                            </div>
                                            <div class="tt-col-description">
                                                <h6 class="tt-title">Taylor</h6>
                                                <div class="tt-value">@tails23</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <a href="#" class="tt-avatar">
                                            <div class="tt-col-icon">
                                                <svg class="tt-icon">
                                                    <use xlink:href="#icon-ava-k"></use>
                                                </svg>
                                            </div>
                                            <div class="tt-col-description">
                                                <h6 class="tt-title">Kevin</h6>
                                                <div class="tt-value">@kevin27</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <a href="#" class="tt-avatar">
                                            <div class="tt-col-icon">
                                                <svg class="tt-icon">
                                                    <use xlink:href="#icon-ava-g"></use>
                                                </svg>
                                            </div>
                                            <div class="tt-col-description">
                                                <h6 class="tt-title">Green</h6>
                                                <div class="tt-value">@green63</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <a href="#" class="tt-avatar">
                                            <div class="tt-col-icon">
                                                <svg class="tt-icon">
                                                    <use xlink:href="#icon-ava-d"></use>
                                                </svg>
                                            </div>
                                            <div class="tt-col-description">
                                                <h6 class="tt-title">Dylan</h6>
                                                <div class="tt-value">@dylan89</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <a href="#" class="tt-avatar">
                                            <div class="tt-col-icon">
                                                <svg class="tt-icon">
                                                    <use xlink:href="#icon-ava-p"></use>
                                                </svg>
                                            </div>
                                            <div class="tt-col-description">
                                                <h6 class="tt-title">Peterson</h6>
                                                <div class="tt-value">@dylan89</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <h4 class="tt-title">
                                Moderators
                            </h4>
                            <div class="tt-list-avatar">
                                <div class="row">
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <a href="#" class="tt-avatar">
                                            <div class="tt-col-icon">
                                                <svg class="tt-icon">
                                                    <use xlink:href="#icon-ava-a"></use>
                                                </svg>
                                            </div>
                                            <div class="tt-col-description">
                                                <h6 class="tt-title">azyrus</h6>
                                                <div class="tt-value">@azyrus21</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <a href="#" class="tt-avatar">
                                            <div class="tt-col-icon">
                                                <svg class="tt-icon">
                                                    <use xlink:href="#icon-ava-s"></use>
                                                </svg>
                                            </div>
                                            <div class="tt-col-description">
                                                <h6 class="tt-title">Smith</h6>
                                                <div class="tt-value">@smith45</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <a href="#" class="tt-avatar">
                                            <div class="tt-col-icon">
                                                <svg class="tt-icon">
                                                    <use xlink:href="#icon-ava-u"></use>
                                                </svg>
                                            </div>
                                            <div class="tt-col-description">
                                                <h6 class="tt-title">Usain</h6>
                                                <div class="tt-value">@bolt24</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <a href="#" class="tt-avatar">
                                            <div class="tt-col-icon">
                                                <svg class="tt-icon">
                                                    <use xlink:href="#icon-ava-l"></use>
                                                </svg>
                                            </div>
                                            <div class="tt-col-description">
                                                <h6 class="tt-title">Larry</h6>
                                                <div class="tt-value">@larry74</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <a href="#" class="tt-avatar">
                                            <div class="tt-col-icon">
                                                <svg class="tt-icon">
                                                    <use xlink:href="#icon-ava-j"></use>
                                                </svg>
                                            </div>
                                            <div class="tt-col-description">
                                                <h6 class="tt-title">Jordan</h6>
                                                <div class="tt-value">@jordan36</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <a href="#" class="tt-avatar">
                                            <div class="tt-col-icon">
                                                <svg class="tt-icon">
                                                    <use xlink:href="#icon-ava-c"></use>
                                                </svg>
                                            </div>
                                            <div class="tt-col-description">
                                                <h6 class="tt-title">Clive</h6>
                                                <div class="tt-value">@clive45</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <a href="#" class="tt-avatar">
                                            <div class="tt-col-icon">
                                                <svg class="tt-icon">
                                                    <use xlink:href="#icon-ava-m"></use>
                                                </svg>
                                            </div>
                                            <div class="tt-col-description">
                                                <h6 class="tt-title">Mitchell</h6>
                                                <div class="tt-value">@mitchell73</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <a href="#" class="tt-avatar">
                                            <div class="tt-col-icon">
                                                <svg class="tt-icon">
                                                    <use xlink:href="#icon-ava-v"></use>
                                                </svg>
                                            </div>
                                            <div class="tt-col-description">
                                                <h6 class="tt-title">Vans</h6>
                                                <div class="tt-value">@vans49</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <a href="#" class="tt-avatar">
                                            <div class="tt-col-icon">
                                                <svg class="tt-icon">
                                                    <use xlink:href="#icon-ava-p"></use>
                                                </svg>
                                            </div>
                                            <div class="tt-col-description">
                                                <h6 class="tt-title">Baker</h6>
                                                <div class="tt-value">@baker65</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <a href="#" class="tt-avatar">
                                            <div class="tt-col-icon">
                                                <svg class="tt-icon">
                                                    <use xlink:href="#icon-ava-f"></use>
                                                </svg>
                                            </div>
                                            <div class="tt-col-description">
                                                <h6 class="tt-title">Foster</h6>
                                                <div class="tt-value">@foster87</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <a href="#" class="tt-avatar">
                                            <div class="tt-col-icon">
                                                <svg class="tt-icon">
                                                    <use xlink:href="#icon-ava-o"></use>
                                                </svg>
                                            </div>
                                            <div class="tt-col-description">
                                                <h6 class="tt-title">Olly</h6>
                                                <div class="tt-value">@olly39</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        
                            <!-- <table class="table-01">
                                <caption>Site Statistics</caption>
                                <thead>
                                    <tr>
                                        <th>Topic</th>
                                        <th>All Time</th>
                                        <th>Last 7</th>
                                        <th>Last 30</th>
                                    </tr>
                                </thead>
                                <tbody class="table-zebra">
                                    <tr>
                                        <td>Topics</td>
                                        <td>51.8k</td>
                                        <td>263</td>
                                        <td>1.2k</td>
                                    </tr>
                                    <tr>
                                        <td>Posts</td>
                                        <td>624k</td>
                                        <td>3.9k</td>
                                        <td>15.4k</td>
                                    </tr>
                                    <tr>
                                        <td>Users</td>
                                        <td>123k</td>
                                        <td>698</td>
                                        <td>3.3k</td>
                                    </tr>
                                    <tr>
                                        <td>Active Users</td>
                                        <td>--</td>
                                        <td>2.8k</td>
                                        <td>7.2k</td>
                                    </tr>
                                    <tr>
                                        <td>Likes</td>
                                        <td>224k</td>
                                        <td>2.5k</td>
                                        <td>9.2k</td>
                                    </tr>
                                </tbody>
                            </table> -->
                           
                        
                        <div class="tt-wrapper-inner tt-indent-top">
                            <h4 class="tt-title">
                            {{ __('messages.contact_us') }}
                            </h4>
                            {{ __('messages.please_feel') }}
                        </div>
                    </div>
               
                </div>
                <div class="tab-pane" id="tt-tab-02" role="tabpanel">
                    <div class="tt-wrapper-inner tt-layout-tab">
                        <h6 class="tt-title tt-size-lg">
                        {{ __('messages.the_concept_of_school_management') }}
                        </h6>
                        <p>{{ __('messages.students_attend_school') }}</p>
                        <p>
                        {{ __('messages.the_principal_is_the_head') }}
                        </p>
                        <dl class="dl-layout-01">
                            <dt>{{ __('messages.the_notion_and_ways') }}</dt>
                            <dd>
                            {{ __('messages.in_recent_years_educational') }} 
                            </dd>
                            <dt>
                            {{ __('messages.place_students_and_teaching') }}
                            </dt>
                            <dd>
                            {{ __('messages.everything_done_in_the_school') }}
                            </dd>                            
                        </dl>
                        <h6 class="tt-title">{{ __('messages.principles_to_build') }}</h6>
                        <ul class="tt-list-dot tt-indent-top01">
                            <li>{{ __('messages.to_reinforce_a_proper') }}</li>
                            <li>{{ __('messages.to_initiate_parental') }}</li>
                            <li>{{ __('messages.to_construct_an_appropriate') }}</li>
                            <li>{{ __('messages.to_assist_parents_in_understanding') }}</li>
                            <li>{{ __('messages.to_reach_the_common') }}</li>                           </ul>
                        <p class="tt-indent-top02">
                        {{ __('messages.we_believe_all_ideas') }}
                        </p>
                    </div>
                </div>
                <div class="tab-pane" id="tt-tab-03" role="tabpanel">
                    <div class="tt-wrapper-inner tt-layout-tab">
                        <h6 class="tt-title tt-size-lg">
                        {{ __('messages.what_is_schooleye') }}
                        </h6>
                        <p>{{ __('messages.schooleye_is_a_school_management') }}</p>
   
                        <dl class="dl-layout-01">
                            <dt>{{ __('messages.which_kind_of_education_institution') }}</dt>
                            <dd>
                            {{ __('messages.any_education_institution') }}
                            </dd>                           
                        </dl>
                        <h6 class="tt-title">{{ __('messages.will_our_data_remain') }}</h6>
                        <ul class="tt-list-dot tt-indent-top01">
                            <li>{{ __('messages.clients’_data_will_remain_100%') }} </li>
                            <li>{{ __('messages.the_software_is_inbuilt') }}</li>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane" id="tt-tab-04" role="tabpanel">
                    <div class="tt-wrapper-inner tt-layout-tab">
                 
                        <h6 class="tt-title tt-size-lg">
                        {{ __('messages.use_of_the_services') }}
                        </h6>
                        <p> {{ __('messages.the_services_are_intended') }} </p>
   
                        <dl class="dl-layout-01">                            
                            <dd>
                            {{ __('messages.the_services_include') }}
                            </dd>                           
                        </dl>
                        <h6 class="tt-title">{{ __('messages.term') }}</h6>
                        <p>  {{ __('messages.this_agreement_shall_become_effective') }} </p>
                    </div>
                    
                </div>
                <div class="tab-pane" id="tt-tab-05" role="tabpanel">
                    <div class="tt-wrapper-inner tt-layout-tab">
                        <p>{{ __('messages.personal_information_is_recorded') }}</p>
                        <p>{{ __('messages.sensitive_information') }}</p>
                        <P>{{ __('messages.the_family_educational') }}</P>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection