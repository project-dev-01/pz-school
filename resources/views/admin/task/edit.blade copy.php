<!-- Center modal content -->
<div class="modal fade editToDoTask" id="editToDoTask" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditToDoTaskModallLabel">Edit To Do Task</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="editToDoList" method="post" action="" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title<span class="text-danger">*</span></label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title">
                    </div>

                    <div class="form-group">
                        <label for="dueDate">Due Date & Time<span class="text-danger">*</span></label>
                        <input type="text" id="dueDate" name="due_date" class="form-control" placeholder="Enter Date & Time">
                    </div>
                    <div class="form-group">
                        <label for="assign_to">Assigned To<span class="text-danger">*</span></label>
                        <select class="form-control select2-multiple" data-toggle="select2" id="assign_to" name="assign_to" multiple="multiple" data-placeholder="Choose ...">
                            @forelse ($allocate_section_list as $sec)
                            <option value="{{ $sec['id'] }}">{{ $sec['class_name']  }} ({{$sec['section_name']}})</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="priority">Priority<span class="text-danger">*</span></label>
                        <select id="priority" class="form-control" name="priority">
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="check_list">Checklists/Sub-tasks</label>
                        <input type="text" class="form-control" name="check_list[]" id="addCheckList" placeholder="Add CheckList">

                    </div>
                    <div class="form-group">
                        <button id="addBtn" class="btn btn-blue btn-sm waves-effect waves-light">Add</button>
                        <ul id="taskList"></ul>
                    </div>
                    <div class="form-group">
                        <label for="task_description">Task Description<span class="text-danger">*</span></label>
                        <textarea id="task_description" rows="task_description" name="task_description" class="form-control" placeholder="Enter Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="attachment">Attachment</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="file[]" class="custom-file-input up" multiple id="attachment">
                                <label class="custom-file-label" for="attachment">{{ __('messages.choose_file') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- <div id="fileNameShow"></div> -->
                        <p id="files-area">
                            <span id="filesList">
                                <span id="files-names"></span>
                            </span>
                        </p>
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