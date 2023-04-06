<!-- Center modal content -->
<div class="modal fade addEvent" id="addEvent" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddEventModallLabel">Add Event</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="eventForm" method="post" action="{{ route('event.add') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="branch_id">Branch<span class="text-danger">*</span></label>
                        <select id="branch_id"  class="form-control"name="branch_id">
                            <option value="">Choose Branch</option>
                            @foreach($branches as $b)
                            <option value="{{$b['id']}}">{{$b['name']}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text branch_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="title">{{ __('messages.title') }}<span class="text-danger">*</span></label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="{{ __('messages.enter_title') }}">
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="type">{{ __('messages.type') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="type" name="type">
                            <option value="">Select</option>
                        </select>
                        <span class="text-danger error-text type_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="audience">{{ __('messages.audience') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="audience" name="audience">
                            <option value="">Select</option>
                            <option value="1">EveryBody</option>
                            <option value="2">Selected Class</option>
                            <option value="3">Selected Section</option>
                        </select>
                        <span class="text-danger error-text audience_error"></span>
                    </div>
                    <div class="form-group" id="class">
                        <label for="class">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                        <select class="form-control select2-multiple" data-toggle="select2" id="class_name" multiple="multiple" data-placeholder="Choose ..." name="class[]">
                            <option value="">Select</option>
                        </select>
                        <span class="text-danger error-text class_error"></span>
                    </div>
                    <div class="form-group" id="section">
                        <label for="section">{{ __('messages.section') }}<span class="text-danger">*</span></label>
                        <select class="form-control select2-multiple" data-toggle="select2" id="section_name" multiple="multiple" data-placeholder="Choose ..." name="section[]">
                            <option value="">Select</option> 
                            
                        </select>
                        <span class="text-danger error-text section_error"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="start_date">{{ __('messages.start_date') }}<span class="text-danger">*</span></label>
                        <input class="form-control homeWorkAdd" id="start_date" type="date" name="start_date">
                        <span class="text-danger error-text start_date_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="end_date">{{ __('messages.end_date') }}<span class="text-danger">*</span></label>
                        <input class="form-control homeWorkAdd" id="end_date" type="date" name="end_date">
                        <span class="text-danger error-text end_date_error"></span>
                    </div> 
                    <div class="form-group">
                        <label for="description">{{ __('messages.description') }}</label>
                        <textarea class="form-control" name="description"></textarea>
                        <span class="text-danger error-text description_error"></span>
                    </div> 
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" id="eventSubmit" class="btn btn-success waves-effect waves-light">{{ __('messages.submit') }}</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


