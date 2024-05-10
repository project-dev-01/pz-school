<!-- Full width modal content -->
<div id="editForm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">{{ __('messages.leave_application') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card" style="overflow-y: auto; max-height: 500px; overflow-x: hidden;">
                            <form id="stdGeneralDetailsupdate" method="post" action="{{ route('parent.studentleave.update') }}">
                                @csrf
                                <!-- <input type="text" name="class_id" id="listModeClassID">
                                <input type="text" name="section_id" id="listModeSectionID" />
                                <input type="text" name="student_id" id="listModestudentID" />
                                <input type="text" name="reasons" id="listModereason" />
                                <input type="text" name="reasonstxt" id="listModereasontext" /> -->
                                <!--1st row-->
                                <input type="hidden" name="id" id="id"> 
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="changeStdName">{{ __('messages.lab_student_name') }}<span class="text-danger">*</span></label>
                                            <select id="editchangeStdName" class="form-control" name="changeStdName">
                                                <option value="">{{ __('messages.select_student') }}</option>
                                                @forelse ($get_std_names_dashboard as $std)
                                                <option value="{{ $std['id'] }}" data-classid="{{ $std['class_id'] }}" data-sectionid="{{ $std['section_id'] }}" {{ Session::get('student_id') == $std['id'] ? 'selected' : ''}}>{{ $std['name'] }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="frm_ldate">{{ __('messages.lab_leave_start') }}<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-calendar-alt"></span>
                                                    </div>
                                                </div>
                                                <input type="text" autocomplete="off" name="frm_ldate" class="form-control" id="editfrm_ldate" placeholder="{{ __('messages.dd_mm_yyyy') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="to_ldate">{{ __('messages.lab_leave_end') }}<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-calendar-alt"></span>
                                                    </div>
                                                </div>
                                                <input type="text" autocomplete="off" name="to_ldate" class="form-control" id="editto_ldate" placeholder="{{ __('messages.dd_mm_yyyy') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--2st row-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="edittotal_leave">{{ __('messages.lab_number_of_days_leave') }}<span class="text-danger">*</span></label>
                                            <input type="number" id="edittotal_leave" name="total_leave" class="form-control" placeholder="{{ __('messages.enter_days_leave') }}" readonly>
                                            <span class="text-danger error-text name_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="editchangeLevType">{{ __('messages.lab_leave_type') }}<span class="text-danger">*</span></label>
                                            <select id="editchangeLevType" class="form-control" name="changeLevType">
                                                <option value="">{{ __('messages.select_leave_type') }}</option>
                                                @forelse ($get_student_leave_types as $ress)
                                                <option value="{{ $ress['id'] }}">{{ $ress['name'] }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="editchangelevReasons">{{ __('messages.reason(s)') }}<span class="text-danger">*</span></label>
                                            <select id="editchangelevReasons" class="form-control" name="changelevReasons">
                                                <option value="">{{ __('messages.select_reason') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--3st row-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="leave_file">{{ __('messages.attachment_file') }}</label>
                                            <div class="input-group">
                                                <div class="">
                                                    <input type="file" id="leave_file" class="custom-file-input" name="file">
                                                    <label class="custom-file-label" for="leave_file">{{ __('messages.choose_the_file') }}</label>
                                                    <span id="file_name"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtarea_prev_remarks">{{ __('messages.remarks') }}</label>
                                            <textarea maxlength="255" id="edittxtarea_prev_remarks" class="form-control alloptions" placeholder="{{ __('messages.enter_the_remarks') }}" name="txtarea_prev_remarks" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10"></textarea>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <button type="button" class="btn form-control" style="background-color: gray;color:white;white-space: nowrap;display: inline-block;overflow: hidden;text-overflow: ellipsis;" data-toggle="modal" id="studentAllReasons">{{ __('messages.click_here_for') }}</button>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                        {{ __('messages.update') }}
                                    </button>
                                    <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                            Cancel
                                        </button>-->
                                </div>
                            </form>
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- end modal-body -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
