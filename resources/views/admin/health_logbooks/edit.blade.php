<!-- Modal -->
<div class="modal fade editModal"  id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog " style="max-width: 810px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">{{ __('messages.edit_form') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
       </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-xl-12">
                    <ul class="nav nav-pills navtab-bg nav-justified" id="mainTabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab1" data-toggle="pill" href="#tabContent1" role="tab" aria-controls="tabContent1" aria-selected="true">{{ __('messages.partc_tab_1') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab2" data-toggle="pill" href="#tabContent2" role="tab" aria-controls="tabContent2" aria-selected="false">{{ __('messages.main_reasons_tab_2') }}</a>
                        </li>
                        <!-- Add more tabs as needed -->
                    </ul>
                
                
                    <!-- Your form goes here -->
                    <form id="edit-health-form" method="post" action="{{ route('admin.health_logbooks_partc.update') }}" autocomplete="off">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tabContent1" role="tabpanel" aria-labelledby="tab1">
                                    <div class="form-group">
                                        <label for="department_id">{{ __('messages.department') }}<span class="text-danger">*</span></label>
                                        <select id="editdepartment_id" name="editdepartment_id" class="form-control">
                                            <option value="">{{ __('messages.select_department') }}</option>
                                                @forelse($department as $r)
                                                <option value="{{$r['id']}}">{{$r['name']}}</option>
                                                @empty
                                                @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                        <select id="editchangeClassName" class="form-control" name="class_id">
                                            <option value="">{{ __('messages.select_grade') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="sectionID">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                        <select id="editsectionID" class="form-control" name="section_id">
                                            <option value="">{{ __('messages.select_class') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">{{ __('messages.name') }}<span class="text-danger">*</span></label>
                                        <select id="editstudent_id" class="form-control" name="student_id">
                                                            <option value="">{{ __('messages.select_student') }}</option>
                                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="time">{{ __('messages.time') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control timepicker" id="time" name="time" placeholder="{{ __('messages.enter_time') }}">
                                                        
                                    </div>
                                    <div class="form-group float-right">
                                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                                        <button type="submit" id="editMainReasonButton" class="btn btn-success waves-effect waves-light  submit-btn">{{ __('messages.update') }}</button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tabContent2" role="tabpanel" aria-labelledby="tab2">
                                    <!-- Content for the second tab goes here -->
                                    <div class="row">
                                       <!-- Left Sidebar with Tabs -->
                                        <div class="col-md-2">
                                            <div class="nav flex-column nav-pills health-logbook-tab" id="mainReasonTabsEdit" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link" id="editreasonTab1" data-toggle="pill" href="#editreason1" role="tab" aria-controls="editreason1" aria-selected="true">{{ __('messages.tab_1') }}</a>
                                            <a class="nav-link" id="editreasonTab2" data-toggle="pill" href="#editreason2" role="tab" aria-controls="editreason2" aria-selected="false">{{ __('messages.tab_2') }}</a>
                                            <a class="nav-link" id="editreasonTab3" data-toggle="pill" href="#editreason3" role="tab" aria-controls="editreason3" aria-selected="false">{{ __('messages.tab_3') }}</a>
                                            <a class="nav-link" id="editreasonTab4" data-toggle="pill" href="#editreason4" role="tab" aria-controls="editreason3" aria-selected="false">{{ __('messages.tab_4') }}</a>
                                            <!-- Add more tabs as needed -->
                                            </div>
                                        </div>
 
                                        <!-- Tab Content -->
                                        <div class="col-md-10">
                                            <div class="tab-content">
                                                <div class="tab-pane fade show" id="editreason1" role="tabpanel" aria-labelledby="editreasonTab1">
                                                    <div class="card">
                                                        <ul class="nav nav-tabs">
                                                                        <li class="nav-item">
                                                                            <h4 class="navv">{{ __('messages.required') }}
                                                                                <h4>
                                                                        </li>
                                                        </ul>
                                    <div class="card-body">
                                        <!-- Content for Reason 1 goes here -->
                                        <!-- Content for Reason 1 goes here -->
                                        <input type="hidden" name="Injury" id="edit_injury" value="Injury">
                                        <div class="row">
                                            <!-- Labels and Multi-Select Dropdowns -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                <label for="class_id">{{ __('messages.category_1') }}<span class="text-danger">*</span></label>
                                                    <select id="edit_injury_name" class="form-control select2-multiple"   data-toggle="select2"   multiple name="edit_injury_name[]">
                                                        <option value="">{{ __('messages.select_injury_name') }}</option>
                                                        @forelse($injury as $r)
                                                        <option value="{{$r['id']}}">{{$r['injury_name']}}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                    <span id="edit_injury_name_error" class="error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                <label for="class_id">{{ __('messages.category_2') }}<span class="text-danger">*</span></label>
                                                <select id="edit_place" class="form-control select2-multiple"   data-toggle="select2"   multiple name="edit_place[]">
                                                        <option value="">{{ __('messages.select_place') }}</option>
                                                        @forelse($injury as $r)
                                                        <option value="{{$r['id']}}">{{$r['place']}}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                    <span id="edit_place_error" class="error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                <label for="class_id">{{ __('messages.category_3') }}<span class="text-danger">*</span></label>
                                                <select id="edit_injury_treatment" class="form-control select2-multiple"   data-toggle="select2"   multiple name="edit_injury_treatment[]">
                                                        <option value="">{{ __('messages.select_treatment') }}</option>
                                                        @forelse($injury as $r)
                                                        <option value="{{$r['id']}}">{{$r['injury_treatment']}}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                    <span id="edit_injury_treatment_error" class="error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                <label for="class_id">{{ __('messages.category_4') }}<span class="text-danger">*</span></label>
                                                <select id="edit_part" class="form-control select2-multiple"   data-toggle="select2"   multiple name="edit_part[]">
                                                        <option value="">{{ __('messages.select_part') }}</option>
                                                        @forelse($injury as $r)
                                                        <option value="{{$r['id']}}">{{$r['part']}}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                    <span id="edit_part_error" class="error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label for="descriptions">{{ __('messages.event_notes') }}<span class="text-danger">*</span></label>
                                                        <textarea class="form-control" name="edit_injury_reason" id="edit_injury_reason" placeholder="{{ __('messages.enter_event_notes') }}"></textarea>
                                                         <span id="edit_injury_reason_error" class="error"></span>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group float-right">
                                            <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                                            <button type="submit" id="editMainReasonButton" data-tab="#editReason1" class="btn btn-success waves-effect waves-light  submit-btn">{{ __('messages.update') }}</button>
                                        </div>
                                </div>
                                <div class="tab-pane fade" id="editreason2" role="tabpanel" aria-labelledby="editreasonTab2">
                                    <div class="card">
                                        <ul class="nav nav-tabs">
                                                        <li class="nav-item">
                                                            <h4 class="navv">{{ __('messages.required') }}
                                                                <h4>
                                                        </li>
                                        </ul>
                                        <div class="card-body">
                                            <!-- Content for Reason 1 goes here -->
                                            <!-- Content for Reason 1 goes here -->
                                            <input type="hidden" name="Illness" id="edit_illness" value="Illness">
                                            <div class="row">
                                                <!-- Labels and Multi-Select Dropdowns -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                    <label for="class_id">{{ __('messages.category_1') }}<span class="text-danger">*</span></label>
                                                        <select id="edit_illness_name" class="form-control select2-multiple"   data-toggle="select2"   multiple name="edit_illness_name[]">
                                                            <option value="">{{ __('messages.select_illness_name') }}</option>
                                                            @forelse($illness as $r)
                                                        <option value="{{$r['id']}}">{{$r['illness_name']}}</option>
                                                        @empty
                                                        @endforelse
                                                        </select>
                                                        <span id="edit_illness_name_error" class="error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                    <label for="class_id">{{ __('messages.category_2') }}<span class="text-danger">*</span></label>
                                                        <select id="edit_illness_treatment" class="form-control select2-multiple"   data-toggle="select2"   multiple name="edit_illness_treatment[]">
                                                            <option value="">{{ __('messages.select_treatment') }}</option>
                                                            @forelse($illness as $r)
                                                        <option value="{{$r['id']}}">{{$r['illness_treatment']}}</option>
                                                        @empty
                                                        @endforelse
                                                        </select>
                                                        <span id="edit_illness_treatment_error" class="error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="class_id">{{ __('messages.category_3') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"  name="edit_reasonTemp" id="edit_reasonTemp" placeholder="{{ __('messages.enter_temperature') }}" maxlength="3" pattern="\d*">
                                                        <span id="edit_reasonTemp_error" class="error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label for="descriptions">{{ __('messages.event_notes') }}<span class="text-danger">*</span></label>
                                                        <textarea class="form-control" name="edit_illness_reason" id="edit_illness_reason" placeholder="{{ __('messages.enter_event_notes') }}"></textarea>
                                                       <span id="edit_illness_reason_error" class="error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <ul class="nav nav-tabs">
                                                        <li class="nav-item">
                                                            <h4 class="navv">{{ __('messages.optional') }}
                                                                <h4>
                                                        </li>
                                        </ul>
                                        <div class="card-body">
                                            <!-- Content for Reason 1 goes here -->
                                            <!-- Content for Reason 1 goes here -->
                                            <div class="row">
                                                <!-- Labels and Multi-Select Dropdowns -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                    <label for="class_id">{{ __('messages.category_1') }}</label>
                                                        <select id="edit_meal" class="form-control" name="edit_meal">
                                                            <option value="">{{ __('messages.select_meal') }}</option>
                                                            @forelse($illness as $r)
                                                        <option value="{{$r['id']}}">{{$r['meal']}}</option>
                                                        @empty
                                                        @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                    <label for="class_id">{{ __('messages.category_2') }}</label>
                                                        <select id="edit_defecation" class="form-control" name="edit_defecation">
                                                            <option value="">{{ __('messages.select_defecation') }}</option>
                                                            @forelse($illness as $r)
                                                        <option value="{{$r['id']}}">{{$r['defecation']}}</option>
                                                        @empty
                                                        @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                    <label for="class_id">{{ __('messages.category_3') }}</label>
                                                        <select id="edit_slept_time" class="form-control" name="edit_slept_time">
                                                            <option value="">{{ __('messages.select_slept_time') }}</option>
                                                            @forelse($illness as $r)
                                                        <option value="{{$r['id']}}">{{$r['slept_time']}}</option>
                                                        @empty
                                                        @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group float-right">
                                            <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                                            <button type="submit" id="editMainReasonButton" data-tab="#editReason2" class="btn btn-success waves-effect waves-light submit-btn ">{{ __('messages.update') }}</button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="editreason3" role="tabpanel" aria-labelledby="editreasonTab3">
                                    <!-- Content for Reason 2 goes here -->
                                    <div class="card">
                                        <ul class="nav nav-tabs">
                                                        <li class="nav-item">
                                                            <h4 class="navv">{{ __('messages.required') }}
                                                                <h4>
                                                        </li>
                                        </ul>
                                        <div class="card-body">
                                            <!-- Content for Reason 1 goes here -->
                                            <!-- Content for Reason 1 goes here -->
                                            <input type="hidden" name="Health consult" id="edit_health_consult" value="Health consult">
                                            <div class="row">
                                                <!-- Labels and Multi-Select Dropdowns -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                    <label for="class_id">{{ __('messages.category_1') }}<span class="text-danger">*</span></label>
                                                        <select id="edit_target" class="form-control select2-multiple"   data-toggle="select2"   multiple name="edit_target[]">
                                                            <option value="">{{ __('messages.select_target') }}</option>
                                                            @forelse($healthConsult as $r)
                                                        <option value="{{$r['id']}}">{{$r['target']}}</option>
                                                        @empty
                                                        @endforelse
                                                        </select>
                                                        <span id="edit_target_error" class="error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                    <label for="class_id">{{ __('messages.category_2') }}<span class="text-danger">*</span></label>
                                                        <select id="edit_health_treatment" class="form-control select2-multiple"   data-toggle="select2"   multiple name="edit_health_treatment[]">
                                                            <option value="">{{ __('messages.select_treatment') }}</option>
                                                            @forelse($healthConsult as $r)
                                                        <option value="{{$r['id']}}">{{$r['health_treatment']}}</option>
                                                        @empty
                                                        @endforelse
                                                        </select>
                                                        <span id="edit_health_treatment_error" class="error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label for="descriptions">{{ __('messages.event_notes') }}<span class="text-danger">*</span></label>
                                                        <textarea class="form-control" name="edit_health_consult_reason" id="edit_health_consult_reason" placeholder="{{ __('messages.enter_event_notes') }}"></textarea>
                                                        <span id="edit_health_consult_reason_error" class="error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group float-right">
                                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                                        <button type="submit" id="editMainReasonButton" data-tab="#editReason3" class="btn btn-success waves-effect waves-light submit-btn">{{ __('messages.update') }}</button>
                                    </div>
                                   
                                </div>
                                <div class="tab-pane fade" id="editreason4" role="tabpanel" aria-labelledby="editreasonTab4">
                                    <div class="card">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <h4 class="navv">{{ __('messages.required') }}
                                                    <h4>
                                            </li>
                                        </ul>
                                        <div class="card-body">
                                        <input type="hidden" name="Attend to heatlthcare room" value="Attend to heatlthcare room" id="edit_Attend_to_heatlthcare_room">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="descriptions">{{ __('messages.event_notes') }}<span class="text-danger">*</span></label>
                                                    <textarea class="form-control" name="edit_attend_to_heatlthcare_room_reason" id="edit_attend_to_heatlthcare_room_reason" placeholder="{{ __('messages.enter_event_notes') }}"></textarea>
                                                    <span id="edit_attend_to_heatlthcare_room_reason_error" class="error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group float-right">
                                            <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                                            <button type="submit" id="editMainReasonButton" data-tab="#editReason4" class="btn btn-success waves-effect waves-light submit-btn">{{ __('messages.update') }}</button>
                                    </div>
                                    
                                </div>
                                <!-- Add more tab panes as needed --> 
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
