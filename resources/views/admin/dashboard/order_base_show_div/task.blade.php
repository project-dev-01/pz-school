<!-- task -->
<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col">
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">{{ __('messages.Task') }}
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row" id="toDoList" data-plugin="dragula" data-containers='["task-list-one", "task-list-two", "task-list-three"]'>
                            <div class="col">
                                <a class="text-dark" data-toggle="collapse" data-id="today" data-count="{{ isset($get_to_do_list_dashboard['today'])?count($get_to_do_list_dashboard['today']):0 }}" href="#todayTasks" aria-expanded="false" aria-controls="todayTasks">
                                    <h5 class="mb-0"><i class='mdi mdi-chevron-down font-18'></i>{{ __('messages.today') }}<span class="text-muted font-14">( {{ isset($get_to_do_list_dashboard['today'])?count($get_to_do_list_dashboard['today']):0 }} )</span></h5>
                                </a>
                                <!-- Right modal -->
                                <!-- <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#right-modal">Rightbar Modal</button> -->
                                @if(!empty($get_to_do_list_dashboard['today']))
                                @forelse ($get_to_do_list_dashboard['today'] as $today)
                                <div class="collapse todayTasks" id="todayTasks">
                                    <div class="card mb-0 shadow-none">
                                        <div class="card-body pb-0" id="task-list-one">
                                            <!-- task -->
                                            <div class="row justify-content-sm-between task-item">
                                                <div class="col-lg-6 mb-2">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" data-id="{{ $today['id'] }}" class="custom-control-input admintaskListDashboard" id="today{{ $today['id'] }}" {{ ($today['user_id']) ? "checked" : "" }}>
                                                        <label class="custom-control-label" for="today{{ $today['id'] }}">
                                                            {{$today['title']}}
                                                        </label>
                                                    </div> <!-- end checkbox -->
                                                </div> <!-- end col -->
                                                <div class="col-lg-6">
                                                    <div class="d-sm-flex justify-content-between">
                                                        <div>
                                                            <img src="{{ config('constants.image_url').'/common-asset/images/users/12.jpg' }}" lt="image" class="avatar-xs rounded-circle" data-toggle="tooltip" data-placement="bottom" title="" />
                                                        </div>
                                                        <div class="mt-3 mt-sm-0">
                                                            <ul class="list-inline font-13 text-sm-center">
                                                                <li class="list-inline-item" id="comments{{ $today['id'] }}">
                                                                    <i class='mdi mdi-comment-text-multiple-outline font-16 mr-1'></i>
                                                                    {{$today['total_comments']}}
                                                                </li>
                                                                <li class="list-inline-item pr-1">
                                                                    <i class='mdi mdi-calendar-month-outline font-16 mr-1'></i>
                                                                    <!-- Today 10am -->
                                                                    {{ date('j F y g a', strtotime($today['due_date']));}}
                                                                </li>
                                                                <!-- <li class="list-inline-item pr-1">
                                                                                <i class='mdi mdi-tune font-16 mr-1'></i>
                                                                                3/7
                                                                            </li> -->

                                                                <li class="list-inline-item mt-3 mt-sm-0">
                                                                    @if($today['priority'] == "Low")
                                                                    <span class="badge badge-soft-success p-1">{{ __('messages.low') }}</span>
                                                                    @endif
                                                                    @if($today['priority'] == "Medium")
                                                                    <span class="badge badge-soft-info p-1">{{ __('messages.medium') }}</span>
                                                                    @endif
                                                                    @if($today['priority'] == "High")
                                                                    <span class="badge badge-soft-danger p-1">{{ __('messages.high') }}</span>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div> <!-- end .d-flex-->
                                                </div> <!-- end col -->
                                            </div>
                                            <hr class="my-2" style="margin-bottom: 1px!important;;margin-top: 1px!important;" />
                                            <!-- end task -->
                                        </div> <!-- end card-body-->
                                    </div> <!-- end card -->
                                </div> <!-- end .collapse-->
                                @empty
                                <p></p>
                                @endforelse
                                @endif
                                <!-- upcoming tasks -->
                                <div class="mt-4">
                                    <a class="text-dark" data-toggle="collapse" data-id="upcoming" data-count="{{ isset($get_to_do_list_dashboard['upcoming'])?count($get_to_do_list_dashboard['upcoming']):0 }}" href="#upcomingTasks" aria-expanded="false" aria-controls="upcomingTasks">
                                        <h5 class="mb-0">
                                            <i class='mdi mdi-chevron-down font-18'></i>{{ __('messages.upcoming') }}<span class="text-muted font-14">( {{ isset($get_to_do_list_dashboard['upcoming'])?count($get_to_do_list_dashboard['upcoming']):0 }} )</span>
                                        </h5>
                                    </a>
                                    @if(!empty($get_to_do_list_dashboard['upcoming']))
                                    @forelse ($get_to_do_list_dashboard['upcoming'] as $upcoming)
                                    <div class="collapse upcomingTasks" id="upcomingTasks">
                                        <div class="card mb-0 shadow-none">
                                            <div class="card-body pb-0" id="task-list-two">
                                                <!-- task -->
                                                <div class="row justify-content-sm-between task-item">
                                                    <div class="col-lg-6 mb-2">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" data-id="{{ $upcoming['id'] }}" class="custom-control-input admintaskListDashboard" id="upcoming{{ $upcoming['id'] }}" {{ ($upcoming['user_id']) ? "checked" : "" }}>
                                                            <label class="custom-control-label" for="upcoming{{ $upcoming['id'] }}">
                                                                {{$upcoming['title']}}
                                                            </label>
                                                        </div> <!-- end checkbox -->
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <div class="d-sm-flex justify-content-between">
                                                            <div>
                                                                <img src="{{ config('constants.image_url').'/common-asset/images/users/12.jpg' }}" lt="image" class="avatar-xs rounded-circle" data-toggle="tooltip" data-placement="bottom" title="" />
                                                            </div>

                                                            <div class="mt-3 mt-sm-0">
                                                                <ul class="list-inline font-13 text-sm-center">
                                                                    <li class="list-inline-item" id="comments{{ $upcoming['id'] }}">
                                                                        <i class='mdi mdi-comment-text-multiple-outline font-16 mr-1'></i>
                                                                        {{$upcoming['total_comments']}}
                                                                    </li>
                                                                    <li class="list-inline-item pr-1">
                                                                        <i class='mdi mdi-calendar-month-outline font-16'></i>
                                                                        {{ date('j F y g a', strtotime($upcoming['due_date']));}}

                                                                    </li>
                                                                    <!-- <li class="list-inline-item pr-1">
                                                                                    <i class='mdi mdi-tune font-16 mr-1'></i>
                                                                                    1/12
                                                                                </li> -->

                                                                    <li class="list-inline-item mt-3 mt-sm-0">
                                                                        @if($upcoming['priority'] == "Low")
                                                                        <span class="badge badge-soft-success p-1">{{ __('messages.low') }}</span>
                                                                        @endif
                                                                        @if($upcoming['priority'] == "Medium")
                                                                        <span class="badge badge-soft-info p-1">{{ __('messages.medium') }}</span>
                                                                        @endif
                                                                        @if($upcoming['priority'] == "High")
                                                                        <span class="badge badge-soft-danger p-1">{{ __('messages.high') }}</span>
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div> <!-- end .d-flex-->
                                                    </div> <!-- end col -->
                                                </div>
                                                <hr class="my-2" style="margin-bottom: 1px!important;;margin-top: 1px!important;" />
                                                <!-- end task -->
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card -->
                                    </div> <!-- end collapse-->
                                    @empty
                                    <p></p>
                                    @endforelse
                                    @endif
                                </div>
                                <!-- end upcoming tasks -->
                                <!-- old tasks -->
                                <div class="mt-4">
                                    <a class="text-dark" data-toggle="collapse" data-id="old" data-count="{{ isset($get_to_do_list_dashboard['old'])?count($get_to_do_list_dashboard['old']):0 }}" href="#pastTasks" aria-expanded="false" aria-controls="pastTasks">
                                        <h5 class="mb-0">
                                            <i class='mdi mdi-chevron-down font-18'></i> {{ __('messages.past') }} <span class="text-muted font-14">( {{ isset($get_to_do_list_dashboard['old'])?count($get_to_do_list_dashboard['old']):0 }} )</span>
                                        </h5>
                                    </a>
                                    @if(!empty($get_to_do_list_dashboard['old']))
                                    @forelse ($get_to_do_list_dashboard['old'] as $old)
                                    <div class="collapse pastTasks" id="pastTasks">
                                        <div class="card mb-0 shadow-none">
                                            <div class="card-body pb-0" id="task-list-two">
                                                <!-- task -->
                                                <div class="row justify-content-sm-between task-item">
                                                    <div class="col-lg-5 mb-2">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" data-id="{{ $old['id'] }}" class="custom-control-input admintaskListDashboard" id="old{{ $old['id'] }}" {{ ($old['user_id']) ? "checked" : "" }}>
                                                            <label class="custom-control-label" for="old{{ $old['id'] }}">
                                                                {{$old['title']}}
                                                            </label>
                                                        </div> <!-- end checkbox -->
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-7">
                                                        <div class="d-sm-flex justify-content-between">
                                                            <div>
                                                                <img src="{{ config('constants.image_url').'/common-asset/images/users/12.jpg' }}" lt="image" class="avatar-xs rounded-circle" data-toggle="tooltip" data-placement="bottom" title="" />
                                                            </div>
                                                            <div class="mt-3 mt-sm-0">
                                                                <ul class="list-inline font-13 text-sm-center">
                                                                    <li class="list-inline-item" id="comments{{ $old['id'] }}">
                                                                        <i class='mdi mdi-comment-text-multiple-outline font-16'></i>
                                                                        {{$old['total_comments']}}
                                                                    </li>
                                                                    <li class="list-inline-item pr-1">
                                                                        <i class='mdi mdi-calendar-month-outline font-16'></i>
                                                                        <?php setlocale(LC_ALL, 'ja.UTF-8');
                                                                        ?>
                                                                        {{ date('j F y g a', strtotime($old['due_date']));}}

                                                                    </li>
                                                                    <!-- <li class="list-inline-item pr-1">
                                                                                    <i class='mdi mdi-tune font-16 mr-1'></i>
                                                                                    1/12
                                                                                </li> -->

                                                                    <li class="list-inline-item mt-3 mt-sm-0">
                                                                        @if($old['priority'] == "Low")
                                                                        <span class="badge badge-soft-success p-1">{{ __('messages.low') }}</span>
                                                                        @endif
                                                                        @if($old['priority'] == "Medium")
                                                                        <span class="badge badge-soft-info p-1">{{ __('messages.medium') }}</span>
                                                                        @endif
                                                                        @if($old['priority'] == "High")
                                                                        <span class="badge badge-soft-danger p-1">{{ __('messages.high') }}</span>
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div> <!-- end .d-flex-->
                                                    </div> <!-- end col -->
                                                </div>
                                                <!-- end task -->
                                                <hr class="my-2" style="margin-bottom: 1px!important;;margin-top: 1px!important;" />
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card -->
                                    </div> <!-- end collapse-->
                                    @empty
                                    <p></p>
                                    @endforelse
                                    @endif
                                </div>
                                <!-- end old tasks -->
                            </div> <!-- end col -->
                        </div> <!-- end row -->


                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end col -->

    <!-- task details -->
    <!-- task panel end -->
</div>