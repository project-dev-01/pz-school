<!-- Center modal content -->
<div class="modal fade addEventModal" id="addEventModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title name">
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="type">
                            <option value="">Select</option>
                            @foreach($type as $typ)
                            <option value="{{$typ->id}}">{{$typ->name}}</option>
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
                        <select class="form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." name="class[]">
                            @foreach($classDetails as $class)
                                <option value="{{$class->id}}">{{$class->name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text class_error"></span>
                    </div>
                    <div class="form-group" id="section">
                        <label for="section">Section</label>
                        <select class="form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." name="section[]">
                            @foreach($classDetails as $class)
                                <optgroup label="Class {{$class->name}}">
                                    @foreach($sectionDetails as $section)
                                    @if($section->class_id == $class->id)
                                    <option value="{{$section->id}}">{{$section->name}}</option>
                                    @endif
                                    @endforeach
                                </optgroup> 
                            @endforeach
                        </select>
                        <span class="text-danger error-text section_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input class="form-control" id="start_date" type="date" name="start_date">
                        <span class="text-danger error-text start_date_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input class="form-control" id="end_date" type="date" name="end_date">
                        <span class="text-danger error-text end_date_error"></span>
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

