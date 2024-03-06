<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <h4 class="navv"> {{ __('messages.student_bottom_10_ranking') }}</h4>
                </li>
            </ul><br>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sb10_btwyears">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                            <select id="sb10_btwyears" class="form-control studentBottom" name="year">
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
                            <label for="sb10_class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                            <select id="sb10_class_id" class="form-control" name="class_id">
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
                            <label for="sb10_section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                            <select id="sb10_section_id" class="form-control " name="section_id">
                                <option value="">{{ __('messages.select_class') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sb10_semester_id">{{ __('messages.semester') }}</label>
                            <select id="sb10_semester_id" class="form-control studentBottom" name="semester_id">
                                <option value="0">{{ __('messages.select_semester') }}</option>
                                @forelse($semester as $sem)
                                <option value="{{$sem['id']}}" {{ $current_semester == $sem['id'] ? 'selected' : ''}}>{{$sem['name']}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sb10_session_id">{{ __('messages.session') }}</label>
                            <select id="sb10_session_id" class="form-control studentBottom" name="session_id">
                                <option value="0">{{ __('messages.select_session') }}</option>
                                @forelse($session as $ses)
                                <option value="{{$ses['id']}}" {{$current_session == $ses['id'] ? 'selected' : ''}}>{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sb10_examnames">{{ __('messages.test_name') }}<span class="text-danger">*</span></label>
                            <select id="sb10_examnames" class="form-control studentBottom" name="examnames">
                                <option value="">{{ __('messages.select_exams') }}</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered w-100 nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('messages.student_name') }}</th>
                                <th>{{ __('messages.total_marks') }}</th>
                                <th>{{ __('messages.marks') }}</th>
                                <th>{{ __('messages.rank') }}</th>
                            </tr>
                        </thead>
                        <tbody id="bottom_student_table">
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