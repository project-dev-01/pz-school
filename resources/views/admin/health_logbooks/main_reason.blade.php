<!-- Main Reason Modal -->
<div class="modal fade" id="mainReasonModal" tabindex="-1" role="dialog" aria-labelledby="mainReasonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mainReasonModalLabel">{{ __('messages.main_reason') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Left Sidebar with Tabs -->
                    <div class="col-md-3">
                        <div class="nav flex-column nav-pills" id="mainReasonTabs" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="reasonTab1" data-toggle="pill" href="#reason1" role="tab" aria-controls="reason1" aria-selected="true">{{ __('messages.tab_1') }}</a>
                            <a class="nav-link" id="reasonTab2" data-toggle="pill" href="#reason2" role="tab" aria-controls="reason2" aria-selected="false">{{ __('messages.tab_2') }}</a>
                            <a class="nav-link" id="reasonTab2" data-toggle="pill" href="#reason3" role="tab" aria-controls="reason3" aria-selected="false">{{ __('messages.tab_3') }}</a>
                            <a class="nav-link" id="reasonTab4" data-toggle="pill" href="#reason4" role="tab" aria-controls="reason3" aria-selected="false">{{ __('messages.tab_4') }}</a>
                            <!-- Add more tabs as needed -->
                        </div>
                    </div>

                    <!-- Tab Content -->
                    <div class="col-md-9">
                        <form action="" method="">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="reason1" role="tabpanel" aria-labelledby="reasonTab1">
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
                                            <input type="hidden" name="injury" value="Injury" id="injury">
                                            <div class="row">
                                                <!-- Labels and Multi-Select Dropdowns -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="class_id">{{ __('messages.category_1') }}<span class="text-danger">*</span></label>
                                                        <select id="injury_name" class="form-control select2-multiple"   data-toggle="select2" name="injury_name[]" multiple >
                                                            <option value="">{{ __('messages.injury_name') }}</option>
                                                            @forelse($injury as $r)
                                                            <option value="{{$r['id']}}">{{$r['injury_name']}}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                        <span id="injury_name_error" class="error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="class_id">{{ __('messages.category_2') }}<span class="text-danger">*</span></label>
                                                        <select id="place" class="form-control select2-multiple"   data-toggle="select2" name="place[]" multiple>
                                                            <option value="">{{ __('messages.select_place') }}</option>
                                                            @forelse($injury as $r)
                                                            <option value="{{$r['id']}}">{{$r['place']}}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                        <span id="place_error" class="error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="class_id">{{ __('messages.category_3') }}<span class="text-danger">*</span></label>
                                                        <select id="injury_treatment" class="form-control select2-multiple"   data-toggle="select2" name="injury_treatment[]" multiple>
                                                            <option value="">{{ __('messages.select_treatment') }}</option>
                                                            @forelse($injury as $r)
                                                            <option value="{{$r['id']}}">{{$r['injury_treatment']}}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                        <span id="injury_treatment_error" class="error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="class_id">{{ __('messages.category_4') }}<span class="text-danger">*</span></label>
                                                        <select id="part" class="form-control select2-multiple"   data-toggle="select2" name="part[]" multiple>
                                                            <option value="">{{ __('messages.select_part') }}</option>
                                                            @forelse($injury as $r)
                                                            <option value="{{$r['id']}}">{{$r['part']}}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                        <span id="part_error" class="error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="reason2" role="tabpanel" aria-labelledby="reasonTab2">
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
                                            <input type="hidden" name="illness"  value="Illness" id="illness">
                                            <div class="row">
                                                <!-- Labels and Multi-Select Dropdowns -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="class_id">{{ __('messages.category_1') }}<span class="text-danger">*</span></label>
                                                        <select id="illness_name" class="form-control select2-multiple"   data-toggle="select2" name="illness_name[]" multiple>
                                                            <option value="">{{ __('messages.select_illness_name') }}</option>
                                                            @forelse($illness as $r)
                                                            <option value="{{$r['id']}}">{{$r['illness_name']}}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                        <span id="illness_name_error" class="error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="class_id">{{ __('messages.category_2') }}<span class="text-danger">*</span></label>
                                                        <select id="illness_treatment" class="form-control select2-multiple"   data-toggle="select2" name="illness_treatment[]" multiple>
                                                            <option value="">{{ __('messages.select_treatment') }}</option>
                                                            @forelse($illness as $r)
                                                            <option value="{{$r['id']}}">{{$r['illness_treatment']}}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                        <span id="illness_treatment_error" class="error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="class_id">{{ __('messages.category_3') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="reasonTemp" id="reasonTemp" placeholder="{{ __('messages.enter_temperature') }}">
                                                        <span id="reasonTemp_error" class="error"></span>
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
                                                        <select id="meal" class="form-control" name="meal">
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
                                                        <select id="defecation" class="form-control" name="defecation">
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
                                                        <select id="slept_time" class="form-control" name="slept_time">
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
                                </div>
                                <div class="tab-pane fade" id="reason3" role="tabpanel" aria-labelledby="reasonTab3">
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
                                            <input type="hidden" name="health_consult" value="Health consult" id="health_consult">
                                            <div class="row">
                                                <!-- Labels and Multi-Select Dropdowns -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="class_id">{{ __('messages.category_1') }}<span class="text-danger">*</span></label>
                                                        <select id="target" class="form-control select2-multiple"   data-toggle="select2" name="target[]" multiple>
                                                            <option value="">{{ __('messages.select_target') }}</option>
                                                            @forelse($healthConsult as $r)
                                                            <option value="{{$r['id']}}">{{$r['target']}}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                        <span id="target_error" class="error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="class_id">{{ __('messages.category_2') }}<span class="text-danger">*</span></label>
                                                        <select id="health_treatment" class="form-control select2-multiple"   data-toggle="select2"   multiple name="health_treatment[]">
                                                            <option value="">{{ __('messages.select_treatment') }}</option>
                                                            @forelse($healthConsult as $r)
                                                            <option value="{{$r['id']}}">{{$r['health_treatment']}}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                        <span id="health_treatment_error" class="error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="reason4" role="tabpanel" aria-labelledby="reasonTab4">
                                    <input type="hidden" name="Attend_to_heatlthcare_room" value="Attend to heatlthcare room" id="Attend_to_heatlthcare_room">
                                </div>
                                <!-- Add more tab panes as needed -->
                            </div>
                    </div>
                    </form>
                </div>
                <div class="form-group float-right">
                    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                    <button type="submit" id="saveMainReasonButton" class="btn btn-success waves-effect waves-light">{{ __('messages.update') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>