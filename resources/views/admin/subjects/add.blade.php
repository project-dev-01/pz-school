<!-- Center modal content -->
<div class="modal fade addSubjectModal" id="addSubjectModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddSubjectModalLabel">{{ __('messages.add_subject') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="addSubjectSubmit" autocomplete="off">
                    @csrf
                    <div class="form-group">
                    
                        <label for="name">{{ __('messages.subject_name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="subjectName" name="name" class="form-control" list="subjectslist" placeholder="{{ __('messages.enter_subject_name') }}">
                        <!--<select id="subjectName" name="name" class="selectpicker" data-live-search="true">
                            @forelse($subject_report as $sub)
                            <option data-tokens="{{$sub['name_jp']}}">{{$sub['name_jp']}}-{{$sub['name_en']}}</option>
                            @endforeach
                        </select>   --> 
                        <datalist id="subjectslist">
                        @forelse($subject_report as $sub)
                            <option values="{{$sub['name_jp']}}">{{$sub['name_jp']}}</option>
                            @endforeach
                        </datalist>                          
                    </div>
                    <div class="form-group">
                        <label for="short_name">{{ __('messages.short_name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="shortName" name="short_name" class="form-control" placeholder="{{ __('messages.enter_short_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="subject_code">{{ __('messages.subject_code') }}</label>
                        <input type="text" id="subjectCode" name="subject_code" class="form-control" placeholder="{{ __('messages.enter_subject_code') }}">
                    </div>
                    <div class="form-group">
                        <label for="subjectType">{{ __('messages.subject_type_1') }}</label>
                        <select class="form-control" id="subjectType" name="subject_type">
                            <option value="">{{ __('messages.select_subject_type_1') }}</option>
                            <option value="Optional">{{ __('messages.optional') }}</option>
                            <option value="Mandatory">{{ __('messages.mandatory') }}</option>
                            <option value="Task">{{ __('messages.task') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subjectType">{{ __('messages.subject_type_2') }}</label>
                        <select class="form-control" id="subjectTypeTwo" name="subject_type_2">
                            <option value="">{{ __('messages.select_subject_type_2') }}</option>
                            <option value="Theory">{{ __('messages.theory') }}</option>
                            <option value="Practical">{{ __('messages.practical') }}</option>
                        </select>
                    </div>
                    <div class="form-group d-none">
                        <label for="subjectType">{{ __('messages.pdf_report') }}</label>
                        <select class="form-control" id="pdf_report" name="pdf_report">
                            <option value="0">{{ __('messages.select') }}</option>
                            @forelse($pdf_report as $r)
                            <option value="{{$r['id']}}">{{$r['pdf_name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" class="form-control" id="pdf_report" name="pdf_report">
                    <div class="form-group">
                        <label for="times_per_week">{{ __('messages.minimum_times_per_week') }}</label>
                        <input type="number" id="times_per_week" name="times_per_week" class="form-control times_per_week">
                    </div>
                    <div class="form-group">
                        <label for="subjectColor">{{ __('messages.subject_color') }}</label>
                        <input type="text" id="subjectColor" name="subject_color_calendor" class="form-control subjectColor" value="#4a81d4">
                    </div>
                    <div class="form-group">
                        <div class="checkbox checkbox-success form-check-inline">
                            <input type="checkbox" id="excludeExams" name="exam_exclude">
                            <label for="excludeExams">{{ __('messages.exclude_from_exams') }}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="order_code">{{ __('messages.order_code') }}</label>
                        <input type="text" id="order_code" name="order_code" class="form-control" placeholder="{{ __('messages.enter_order_code') }}">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.submit') }}</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->