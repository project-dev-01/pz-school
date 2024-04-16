<!-- Center modal content -->
<div class="modal fade addBuletin" id="addBuletinModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddBuletinModalLabel">{{ __('messages.buletin') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="buletinForm" method="post" action="{{ route('admin.buletin_board.addBuletinBoard') }}" enctype="multipart/form-data" autocomplete="off" >
                    @csrf

                    <div class="form-group">
                        <label for="name">{{ __('messages.title') }}<span class="text-danger">*</span></label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="{{ __('messages.enter_title') }}">
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('messages.description') }}<span class="text-danger">*</span></label>
                        <textarea class="form-control" name="discription" id="discription"></textarea>
                        <span class="text-danger error-text discription_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('messages.file') }} {{ __('messages.pdf_file_only')}}</label>
                        <input type="file" id="file" name="file" class="form-control" placeholder="{{ __('messages.enter_file') }}" accept=".pdf">
                        <span class="text-danger error-text file_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="inputTopic">{{ __('messages.target_user') }}<span class="text-danger">*</span></label>
                        <select name="target_user[]" id="target_user" class="form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="{{ __('messages.choose') }}">>
                            <option value=""></option>
                                @forelse($usernames as $c)
                                <option value="{{$c['id']}}">{{ __('messages.' . strtolower($c['name'])) }}</option>
                                @empty
                                @endforelse

                        </select>
                        <span class="text-danger error-text target_user_error"></span>
                    </div>
                    <div id="class">
                        <div class="form-group">
                            <label for="changeClassName"> {{ __('messages.grade') }}</label>
                            <select id="changeClassName" class="form-control add_class_name" name="class_id">
                                <option value="">{{ __('messages.select_grade') }}</option>
                                @forelse ($classDetails as $cla)
                                    <option value="{{ $cla['id'] }}">{{ $cla['name'] }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="filtersectionID"> {{ __('messages.class') }}</label>
                            <select id="filtersectionID" class="form-control" name="section_id">
                                <option value="">{{ __('messages.select_class') }}</option>
                            </select>
                        </div>
                    </div>
                    <div id="student" data-value="student" >
                        <div class="form-group">
                            <label for="student_id">{{ __('messages.student') }}</label>
                            <select id="student_id" class="form-control" name="student_id">
                                <option value="">{{ __('messages.select_student') }}</option>
                            </select>
                        </div>
                    </div>
                    <div id="parentss" data-value="parent">
                        <div class="form-group">
                            <label for="parent_id">{{ __('messages.parent') }}</label>
                            <select id="parent_id" class="form-control" name="parent_id">
                                <option value="">{{ __('messages.select_parent') }}</option>
                            </select>
                        </div>
                    </div>
                    <div id='department'>
                        <div class="form-group">
                            <label for="department_id">{{ __('messages.department') }}</label>
                            <select class="form-control select2-multiple" data-toggle="select2" id="empDepartment" name="department_id" multiple="multiple" data-placeholder="{{ __('messages.choose_department') }}">
                                <option value="">{{ __('messages.choose_department') }}</option>
                                 @forelse($emp_department as $r)
                                    <option value="{{$r['id']}}">{{$r['name']}}</option>
                                 @empty
                                 @endforelse
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox form-check">
                            <input type="checkbox" class="custom-control-input" name="add_to_dash" id="add_to_dash" checked>
                            <label class="custom-control-label" for="add_to_dash">{{ __('messages.add_to_dash') }}</label>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <div class="custom-control custom-checkbox form-check">
                            <input type="checkbox" class="custom-control-input" name="publish" id="publish" checked>
                            <label class="custom-control-label" for="publish">{{ __('messages.publish') }}</label>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label for="date">{{ __('messages.publish_date') }}<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="far fa-calendar-alt"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control datepicker" id="date" name="date" aria-describedby="inputGroupPrepend">
                        </div>
                        <span class="text-danger error-text date_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="date">{{ __('messages.publish_end_date') }}</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="far fa-calendar-alt"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control datepicker" id="end_date" name="end_date" aria-describedby="inputGroupPrepend">
                        </div>
                        <span class="text-danger error-text end_date_error"></span>
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