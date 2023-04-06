@extends('layouts.admin-layout')
@section('title','Add Task')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">Task</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <!-- <ul id="taskList">
            <li>
                <p>fdgfd<button style="margin-left: 5px; color: red; font-weight: bold;">X</button></p>
            </li>
            <li>
                <p>fdgfd<button style="margin-left: 5px; color: red; font-weight: bold;">X</button></p>
            </li>
        </ul>

        <span id="filesList">
            <span id="filesList">
                <span id="files-names">
                    <span class="file-block">
                        <span class="file-delete">
                            <p> <span class="name">configurations for pazsuzen.txt</span>
                                <span style="margin-left: 5px; color: red; font-weight: bold;">X</span>
                            </p>
                        </span>
                    </span>
                    <span class="file-block">
                        <span class="file-delete">
                            <p><span class="name">countdown based on time.txt</span>
                                <span style="margin-left: 5px; color: red; font-weight: bold;">X</span>
                            </p>
                        </span>
                    </span>

                </span>
            </span>
        </span> -->

        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Add Task
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="addToDoList" method="post" action="" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">{{ __('messages.title') }}<span class="text-danger">*</span></label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="{{ __('messages.enter_title') }}">
                        </div>

                        <div class="form-group">
                            <label for="dueDate">{{ __('messages.due_date') }} & {{ __('messages.time') }}<span class="text-danger">*</span></label>
                            <input type="text" id="dueDate" name="due_date" class="form-control" placeholder="Enter Date & Time">
                        </div>
                        <div class="form-group">
                            <label for="assign_to">{{ __('messages.assigned_to') }}<span class="text-danger">*</span></label>
                            <select class="form-control select2-multiple" data-toggle="select2" id="assign_to" name="assign_to" multiple="multiple" data-placeholder="Choose ...">
                                @forelse ($allocate_section_list as $sec)
                                <option value="{{ $sec['id'] }}">{{ $sec['class_name']  }} ({{$sec['section_name']}})</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="priority">{{ __('messages.priority') }}<span class="text-danger">*</span></label>
                            <select id="priority" class="form-control" name="priority">
                                <option value="Low">{{ __('messages.low') }}</option>
                                <option value="Medium">{{ __('messages.medium') }}</option>
                                <option value="High">{{ __('messages.high') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="check_list">{{ __('messages.checklists') }}/{{ __('messages.sub-tasks') }}</label>
                            <input type="text" class="form-control" name="check_list[]" id="addCheckList" placeholder="Add CheckList">
                        </div>
                        <div class="form-group">
                            <button type="button" id="addBtn" class="btn btn-blue btn-sm waves-effect waves-light">Add</button>
                            <ul id="taskList"></ul>
                        </div>
                        <div class="form-group">
                            <label for="task_description">{{ __('messages.task_description') }}<span class="text-danger">*</span></label>
                            <textarea id="task_description" rows="task_description" name="task_description" class="form-control" placeholder="{{ __('messages.enter_description') }}"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="attachment">{{ __('messages.attachment') }}</label>
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
                            <a href="{{ url()->previous() }}" type="button" class="btn btn-secondary">{{ __('messages.back') }}</a>
                            <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.submit') }}</button>
                        </div>

                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- col -->
    </div> <!-- row -->
</div> <!-- container -->
@endsection
@section('scripts')
<script>
    var gettoDoListURL = "{{ route('admin.task') }}";
    var toDoListURL = "{{ route('admin.task.add') }}";
</script>
<script src="{{ asset('public/js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('public/js/custom/add-edit-to-do-list.js') }}"></script>

@endsection