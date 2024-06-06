<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card">
                    <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <!-- Button placed on the left side -->
                        <h4 class="navv">{{ __('messages.student_new_joining_list') }}
                            <h4>
                                <button class="btn btn-link " type="button" id="collapseButton7"  aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                    </li>
                    </ul>
            <div class="card-body collapse show">
                <div class="table-responsive">
                    <table class="table dt-responsive nowrap w-100" id="student-new-joining-list">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('messages.name') }}</th>
                                <!-- <th>{{ __('messages.email') }}</th> -->
                                <th>{{ __('messages.studentnewjoining_grade_name') }}</th>
                                <th>{{ __('messages.studentnewjoining_class_Name') }}</th>
                                <th>{{ __('messages.gender') }}</th>
                                <th>{{ __('messages.admission_date') }}</th>
                                <!-- <th>{{ __('messages.department_name') }}</th> -->
                                <th>{{__('messages.status_after_approval')}}</th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>