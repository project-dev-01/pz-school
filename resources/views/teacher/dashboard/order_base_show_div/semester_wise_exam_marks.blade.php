<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <h4 class="navv">{{ __('messages.semester_wise_exam_marks') }}
                        <h4>
                </li>
            </ul><br>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="st_btwyears">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                            <select id="st_btwyears" class="form-control studentSemester" name="year">
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
                            <label for="st_class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                            <select id="st_class_id" class="form-control" name="class_id">
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
                            <label for="st_section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                            <select id="st_section_id" class="form-control " name="section_id">
                                <option value="">{{ __('messages.select_class') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="st_student_id">{{ __('messages.student') }}<span class="text-danger">*</span></label>
                            <select id="st_student_id" class="form-control studentSemester" name="student_id">
                                <option value="">{{ __('messages.select_student') }}</option>
                            </select>
                        </div>
                    </div>
                </div><br>
                <div class="table-responsive">
                    <table class="table table-bordered w-100 nowrap">

                        <thead id="st_semester_wise_head">
                        </thead>
                        <tbody id="st_semester_wise_body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end card-->
</div>