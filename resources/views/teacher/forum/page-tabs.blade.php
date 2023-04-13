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
                            The Concept of School Management
                        </h6>
                        <p> Students attend school in order to receive intellectual and moral education. Teachers, administrators, parents, community and principal all play either a direct or indirect role in affecting such development. These key players need to realize the importance of their influence and responsibilities.</p>
                        <p>
                        The principal is the head of the school, having to play the role of manager in order to elevate the efficiency of administration, promote the professional growth of teachers, respect the educational choice of parents and bring together all the key players into a cooperative mode. All is done with the aim of fostering student development and growth in every aspect so that they gain essential knowledge and cultivate the concept of lifelong learning.
                        </p>
                        <dl class="dl-layout-01">
                            <dt>The notion and ways of interaction between schools, teachers, parents, the community and society</dt>
                            <dd>
                            In recent years, educational reforms of all sorts and new laws have been on the rage, resulting in immense changes in school education--- from a centrally controlled closed system with restrictions on teachers’ professionalism to the sharing of power in an open system where teachers have the right to develop professionally in their own way. 
                            </dd>
                            <dt>
                            Place students and teaching as top priority
                            </dt>
                            <dd>
                            Everything done in the school should revolve around the students’ welfare and needs, be it the allocation of resources or the planning of activities and teaching content. Since teaching is the most important agenda in a school, the administration should provide the necessary support, be concerned with teaching and assist the teachers in upgrading the quality of teaching.
                            </dd>                            
                        </dl>
                        <h6 class="tt-title">Principles to Build a active Parent-Teacher Relationship:</h6>
                        <ul class="tt-list-dot tt-indent-top01">
                            <li>To reinforce a proper attitude in teachers with the teacher body. Parents play
                            an important partnership with teachers in educating the next generation; hence, each school should value parental participation, and make full use of parental assistance, so that the desired educational goals may be achieved.</li>
                            <li>To initiate parental involvement in all school activities and events.</li>
                            <li>To construct an appropriate role with the parents. Whenever possible, replace negative criticism with constructive compliments.</li>
                            <li>To assist parents in understanding and finding their importance to school so that they realize the need of getting involved with school more and more.</li>
                            <li>To reach the common ground of understanding each other; to be respectful and supportive emotionally.</li>                           </ul>
                        <p class="tt-indent-top02">
                            We believe all ideas can (and should) be scrutinised, constructively.
                        </p>
                    </div>
                </div>
                <div class="tab-pane" id="tt-tab-03" role="tabpanel">
                    <div class="tt-wrapper-inner tt-layout-tab">
                        <h6 class="tt-title tt-size-lg">
                            What is SchoolEye?
                        </h6>
                        <p> SchoolEye is a school management software which can be used for several purposes. Records like student admission details, fee structure of different courses, complete details of teaching staff, etc., can be obtained in a structured manner within few minutes. It is web-based software which can be accessed from anywhere.</p>
   
                        <dl class="dl-layout-01">
                            <dt>Which kind of education institution can use SchoolEye software?</dt>
                            <dd>
                            Any education institution where there is a need of proper management, SchoolEye is the best to use there. The SchoolEye software is suitable for small, medium-sized and large schools. Moreover, the software works quite well when used even at university levels.
                            </dd>                           
                        </dl>
                        <h6 class="tt-title">Will our data remain safe and secure in SchoolEye?</h6>
                        <ul class="tt-list-dot tt-indent-top01">
                            <li>Yes, clients’ data will remain 100% secure and confidential in SchoolEye software. </li>
                            <li>The software is inbuilt with data back-up facility, which can be retrieved by our clients easily.</li>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane" id="tt-tab-04" role="tabpanel">
                    <div class="tt-wrapper-inner tt-layout-tab">
                 
                        <h6 class="tt-title tt-size-lg">
                            USE OF THE SERVICES.
                        </h6>
                        <p> The Services are intended to guide high school students in their post-secondary pursuits. The Services enable students to search for and learn about collegiate, scholarship, and career opportunities; to engage with high school counselors and college admissions representatives during the college selection and admissions process; to solicit from high school faculty and administrators the creation and delivery of application-related documents; and to promote and manage their applications to institutions of higher education. </p>
   
                        <dl class="dl-layout-01">                            
                            <dd>
                            The Services include a college guidance management system that enables high schools and affiliated organizations to monitor and assist students in their post-secondary planning; to engage and collaborate with students, parents and guardians, and college admissions representatives; to manage the creation and delivery of application-related documents to colleges; and to collect, analyze, and report on student engagement, academic achievements, and application outcomes.
                            </dd>                           
                        </dl>
                        <h6 class="tt-title">{{ __('messages.term') }}</h6>
                        <p>  This Agreement shall become effective on the date of Client’s acceptance hereof and shall continue for the period set forth in the Order Form (“Initial Term”). At the end of the Initial Term, and each subsequent anniversary thereof, this Agreement shall automatically renew for an additional one-year period </p>
                    </div>
                    
                </div>
                <div class="tab-pane" id="tt-tab-05" role="tabpanel">
                    <div class="tt-wrapper-inner tt-layout-tab">
                        <p>Personal information is recorded information or opinion, whether true or not, about a person whose identity is apparent, or can reasonably be ascertained, from the information. The information or opinion can be recorded in any form. A person's name, address, phone number and date of birth (age) are all examples of personal information.</p>
                        <p>Sensitive information is a type of personal information with stronger legal protections due to the risk of discrimination. It includes information or opinion about an identifiable person’s racial or ethnic origin, political opinions or affiliations, religious beliefs or affiliations, philosophical beliefs, sexual orientation or practices, criminal record, or membership of a trade union.
                        Personal and sensitive information is regulated in Victoria under the Privacy and Data Protection Act 2014 (Vic).</p>
                        <P>The Family Educational Rights and Privacy Act (FERPA) (20 U.S.C. § 1232g; 34 CFR Part 99) is a Federal law that protects the privacy of student education records. ... Parents or eligible students have the right to request that a school correct records which they believe to be inaccurate or misleading</P>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection