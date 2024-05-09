<style>
    #oldfile {
    display: block;
}
    </style>
<!-- Center modal content -->
<div class="modal fade editBuletin" id="editBuletinModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditBuletinModalLabel">{{ __('messages.edit_buletin') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="buletinEditForm" method="post" action="{{ route('admin.buletin_board.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id" id='id'>
                    <div class="form-group">
                        <label for="name">{{ __('messages.title') }}<span class="text-danger">*</span></label>
                        <input type="text" id="titles" name="titles" class="form-control" placeholder="{{ __('messages.enter_title') }}">
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('messages.description') }}<span class="text-danger">*</span></label>
                        <textarea class="form-control" name="descriptions" id="descriptions"></textarea>
                        <span class="text-danger error-text discription_error"></span>
                    </div>
                  
                    <div class="form-group">
                        <label for="name">{{ __('messages.file') }}</label>
                        <input type="file" id="files" name="files[]" class="form-control" placeholder="{{ __('messages.enter_file') }}" accept=".pdf" multiple>
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                         <div id="file-lists"></div>
                    </div>
                    <div class="form-group">
                    <label for="name">{{ __('messages.old_file') }}</label>
                    <span id="oldfile" class="oldfile"></span>
                    </div>
                 
                    <div class="form-group">
                        <label for="inputTopic">{{ __('messages.target_user') }}<span class="text-danger">*</span></label>
                        <select name="target_users[]" id="target_users" class="form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="{{ __('messages.choose') }}">>
                            <option value=""></option>
                                @forelse($usernames as $c)
                                <option value="{{$c['id']}}">{{ __('messages.' . strtolower($c['name'])) }}</option>
                                @empty
                                @endforelse

                        </select>
                        <span class="text-danger error-text target_user_error"></span>
                    </div>
                    <fieldset style="margin: 0 0 20px 0; border: 1px solid #ccc;" id="edit_class">
                        <legend id="selectionLegends" style="margin-left: 1em;width: 144px;font-weight: 600;font-size: 13px;"></legend>
                        <div>
                            <div class="form-group p-1">
                                <label for="changeClassNames"> {{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                <select id="changeClassNames" class="form-control add_class_names select2-multiple" data-toggle="select2" multiple="multiple" name="class_ids">
                                    <option value="">{{ __('messages.select_grade') }}</option>
                                    @forelse ($classDetails as $cla)
                                        <option value="{{ $cla['id'] }}">{{ $cla['name'] }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group p-1">
                                <label for="filtersectionIDs"> {{ __('messages.class') }}<span class="text-danger">*</span></label>
                                <select id="filtersectionIDs" class="form-control" name="section_ids">
                                    <option value="">{{ __('messages.select_class') }}</option>
                                </select>
                            </div>
                        </div>
                        <div id="students" data-value="students" >
                            <div class="form-group p-1">
                                <label for="student_ids">{{ __('messages.student') }}</label>
                                <select id="student_ids" class="form-control" name="student_ids">
                                    <option value="">{{ __('messages.select_student') }}</option>
                                </select>
                            </div>
                        </div>
                        <div id="parents" data-value="parents">
                            <div class="form-group p-1">
                                <label for="parent_ids">{{ __('messages.parent') }}</label>
                                <select id="parent_ids" class="form-control" name="parent_ids">
                                    <option value="">{{ __('messages.select_parent') }}</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <div id='departments'>
                        <fieldset style="margin: 0 0 20px 0; border: 1px solid #ccc;">
                            <legend style="margin-left: 1em;width: 100px;font-weight: 600;font-size: 13px;">Teacher Section</legend>
                                <div class="form-group p-1">
                                    <label for="department_ids">{{ __('messages.department') }}</label>
                                    <select class="form-control select2-multiple" data-toggle="select2" id="empDepartments" name="department_ids" multiple="multiple" data-placeholder="{{ __('messages.choose_department') }}">
                                        <option value="">{{ __('messages.choose_department') }}</option>
                                        @forelse($emp_department as $r)
                                            <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                       </fieldset>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox form-check">
                            <input type="checkbox" class="custom-control-input" name="add_to_dashs" id="add_to_dashs">
                            <label class="custom-control-label" for="add_to_dash">{{ __('messages.add_to_dash') }}</label>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <div class="custom-control custom-checkbox form-check">
                            <input type="checkbox" class="custom-control-input" name="publishs" id="publishs">
                            <label class="custom-control-label" for="publish">{{ __('messages.publish') }}</label>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label for="text">{{ __('messages.publish_date') }}<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="far fa-calendar-alt"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control datepicker" id="publish_dates" name="publish_dates" aria-describedby="inputGroupPrepend">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text">{{ __('messages.publish_end_date') }}<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="far fa-calendar-alt"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control datepicker" id="publish_end_dates" name="publish_end_dates" aria-describedby="inputGroupPrepend">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.update') }}</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->