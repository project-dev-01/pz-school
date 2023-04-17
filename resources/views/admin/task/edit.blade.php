@extends('layouts.admin-layout')
@section('title','Edit Task')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">{{ __('messages.task') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.edit_task') }}
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="updateToDoList" method="post" action="" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" value={{$to_do_row['id']}}>
                        <div class="form-group">
                            <label for="title">{{ __('messages.title') }}<span class="text-danger">*</span></label>
                            <input type="text" id="title" name="title" value={{$to_do_row['title']}} class="form-control" placeholder="{{ __('messages.enter_title') }}">
                        </div>

                        <div class="form-group">
                            <label for="dueDate">{{ __('messages.due_date') }} & {{ __('messages.time') }}<span class="text-danger">*</span></label>
                            <input type="text" id="dueDate" name="due_date" value={{$to_do_row['due_date']}} class="form-control" placeholder="{{ __('messages.enter_date _time') }}">
                        </div>
                        <div class="form-group">
                            <label for="assign_to">{{ __('messages.assigned_to') }}<span class="text-danger">*</span></label>
                            <select class="form-control select2-multiple" data-toggle="select2" id="assign_to" name="assign_to" multiple="multiple" data-placeholder="{{ __('messages.choose') }}">
                                

                                @forelse($allocate_section_list as $sec)
                                    @php
                                    $selected = "";
                                    @endphp
                                    @foreach(explode(',', $to_do_row['assign_to']) as $info)
                                        @if($sec['id'] == $info)
                                            @php
                                            $selected = "Selected";
                                            @endphp
                                        @endif
                                    @endforeach
                                    <option value="{{ $sec['id']}}" {{ $selected }}>{{ $sec['class_name']  }} ({{$sec['section_name']}})</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="priority">{{ __('messages.priority') }}<span class="text-danger">*</span></label>
                            <select id="priority" class="form-control" name="priority">
                                <option value="Low" {{ $to_do_row['priority']=="Low" ? "Selected":""}}>{{ __('messages.low') }}</option>
                                <option value="Medium" {{ $to_do_row['priority']=="Medium" ? "Selected":""}}>{{ __('messages.medium') }}</option>
                                <option value="High" {{ $to_do_row['priority']=="High" ? "Selected":""}}>{{ __('messages.high') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="check_list">{{ __('messages.checklists') }}/{{ __('messages.sub-tasks') }}</label>
                            <input type="text" class="form-control"  name="check_list[]" id="addCheckList" placeholder="{{ __('messages.add_checkList') }}">
                            <input type="hidden" name="old_check_list" id="old_check_list" value="{{$to_do_row['check_list']}}">

                        </div>
                        <div class="form-group">
                            <button type="button" id="addBtn" class="btn btn-blue btn-sm waves-effect waves-light">{{ __('messages.add') }}</button>
                            <ul id="taskList"></ul>
                        </div>
                        <div class="form-group">
                            <label for="task_description">{{ __('messages.task_description') }}<span class="text-danger">*</span></label>
                            <textarea id="task_description" rows="task_description" name="task_description" class="form-control" placeholder="{{ __('messages.enter_description') }}">{{$to_do_row['task_description']}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="attachment">{{ __('messages.attachment') }}</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="file[]" class="custom-file-input up" multiple id="attachment">
                                    <input type="hidden" name="old_file" id="old_file" value="{{$to_do_row['file']}}">
                                    <label class="custom-file-label" for="attachment">{{ __('messages.choose_file') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- <div id="fileNameShow"></div> -->
                            <p id="files-area">
                                <span id="filesList">
                                    <span id="files-names">
                                    @if($to_do_row['file'])
                                        @foreach(explode(',', $to_do_row['file']) as $file)
                                            <span class="file-block">
                                                <span class="file-delete">
                                                    <span class="name old_file_updated">{{$file}}</span>
                                                    <span style="margin-left: 1px; color: red; font-weight: bold; margin-right: 5px;">X</span>
                                                </span>
                                            </span>
                                        @endforeach
                                    @endif
                                    </span>
                                </span>
                            </p>
                        </div>
                        <div class="form-group">
                            <a href="{{ url()->previous() }}" type="button" class="btn btn-secondary"></a>{{ __('messages.back') }}
                            <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.update') }}</button>
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
    var toDoListURL = "{{ route('admin.task.update') }}";
</script>
<script src="{{ asset('public/js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('public/js/custom/add-edit-to-do-list.js') }}"></script>

@endsection