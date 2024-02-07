<!-- Center modal content -->
<div class="modal fade addschoolRole" id="addschoolRoleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddEventTypeModalLabel">{{ __('messages.school_roles') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="schoolRoleForm" method="post" action="{{ route('admin.school_role.add') }}" autocomplete="off">
                    @csrf
                   
                    <div class="form-group">
                        <label for="portal_roleid">{{ __('messages.role') }}<span class="text-danger">*</span></label>
                        <select class="form-control " id="portal_roleid" name="portal_roleid" data-placeholder="{{ __('messages.choose_role') }}">
                            @forelse($portal_roles as $r)
                            
                            <option value="{{$r['id']}}">{{ __('messages.' . strtolower($r['portal_name'])) }}</option>
                            @empty
                            @endforelse
                        </select>
                         <!--<select class="form-control " id="portal_roleid" name="portal_roleid" data-placeholder="{{ __('messages.choose_role') }}">
                            <option value="3">{{ __('messages.' . strtolower('staff')) }}</option>
                            <option value="5">{{ __('messages.' . strtolower('parent')) }}</option>
                            <option value="6">{{ __('messages.' . strtolower('student')) }}</option> 

                        </select>-->
                    </div>
                    <div class="form-group">
                        <label for="fullname">{{ __('messages.school_role_fullname') }} <span class="text-danger">*</span></label>
                        <input type="text" id="fullname" name="fullname" class="form-control" placeholder="{{ __('messages.enter_school_role_fullname') }}">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="shortname"> {{ __('messages.school_role_shortname') }} <span class="text-danger">*</span></label>
                        <input type="text" id="shortname" name="shortname" class="form-control" placeholder="{{ __('messages.enter_school_role_shortname') }}" >
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