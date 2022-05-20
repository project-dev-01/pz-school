<!-- Center modal content -->
<div class="modal fade addEvent" id="addEventModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddEventModallLabel">Add Event</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="eventForm" method="post" action="{{ route('admin.event.add') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title name">
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="type">
                            <option value="">Select</option>
                            @foreach($type as $typ)
                            <option value="{{$typ['id']}}">{{$typ['name']}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text type_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="audience">Audience</label>
                        <select class="form-control" id="audience" name="audience">
                            <option value="">Select</option>
                            <option value="1">EveryBody</option>
                            <option value="2">Selected Class</option>
                            <!-- <option value="3">Selected Section</option> -->
                        </select>
                        <span class="text-danger error-text audience_error"></span>
                    </div>
                    <div class="form-group" id="class">
                        <label for="class">Class</label>
                        <select class="form-control select2-multiple" data-toggle="select2"  name="class[]" multiple="multiple" data-placeholder="Choose ...">
                            @foreach($class as $cla)
                                <option value="{{$cla['id']}}">{{$cla['name']}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text class_error"></span>
                    </div>
                    <div class="form-group" id="section">
                        <label for="section">Section</label>
                        <select class="form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." name="section[]">
                        </select>
                        <span class="text-danger error-text section_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="far fa-calendar-alt"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="start_date" id="start_date">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="end_date">End Date<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="far fa-calendar-alt"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="end_date" id="end_date">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description"></textarea>
                        <span class="text-danger error-text description_error"></span>
                    </div> 
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" id="eventSubmit" class="btn btn-success waves-effect waves-light">Submit</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

