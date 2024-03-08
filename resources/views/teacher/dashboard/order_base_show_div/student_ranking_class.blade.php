<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <h4 class="navv"> {{ __('messages.student_ranking_class') }} & {{ __('messages.subject') }}</h4>
                </li>
            </ul><br>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sr_btwyears">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                            <select id="sr_btwyears" class="form-control studentRank" name="year">
                                <option value="">{{ __('messages.select_academic_year') }}</option>
                                @forelse($academic_year_list as $r)
                                <option value="{{$r['id']}}">{{$r['name']}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sr_class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                            <select id="sr_class_id" class="form-control" name="class_id">
                                <option value="">{{ __('messages.select_grade') }}</option>
                                @forelse ($classes as $class)
                                <option value="{{ $class['class_id'] }}">{{ $class['class_name'] }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sr_section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                            <select id="sr_section_id" class="form-control " name="section_id">
                                <option value="">{{ __('messages.select_class') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sr_student_id">{{ __('messages.student') }}<span class="text-danger">*</span></label>
                            <select id="sr_student_id" class="form-control studentRank" name="student_id">
                                <option value="">{{ __('messages.select_student') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sr_examnames">{{ __('messages.test_name') }}<span class="text-danger">*</span></label>
                            <select id="sr_examnames" class="form-control studentRank" name="examnames">
                                <option value="">{{ __('messages.select_exams') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sr_semester_id">{{ __('messages.semester') }}</label>
                            <select id="sr_semester_id" class="form-control studentRank" name="semester_id">
                                <option value="0">{{ __('messages.select_semester') }}</option>
                                @forelse($semester as $sem)
                                <option value="{{$sem['id']}}">{{$sem['name']}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sr_session_id">{{ __('messages.session') }}</label>
                            <select id="sr_session_id" class="form-control studentRank" name="session_id">
                                <option value="0">{{ __('messages.select_session') }}</option>
                                @forelse($session as $ses)
                                <option value="{{$ses['id']}}">{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 form-inline">
                        <div class="form-group">
                            <label for=""><b> {{ __('messages.class_rank') }} : <span id="class_rank"></span> <br>{{ __('messages.total_marks') }}: <span id="class_total"></span></b></label>
                        </div>
                    </div>
                </div><br>
                <div class="table-responsive">
                    <table class="table table-bordered w-100 nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('messages.subject') }}</th>
                                <th>{{ __('messages.marks') }}</th>
                                <th>{{ __('messages.subject_position') }}</th>
                            </tr>
                        </thead>
                        <tbody id="student_rank_body">
                            <tr>
                                <td class="text-center" colspan="5">{{ __('messages.no_data_available') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end card-->
</div>