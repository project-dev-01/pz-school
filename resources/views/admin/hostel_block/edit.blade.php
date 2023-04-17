<!-- Center modal content -->
<div class="modal fade editHostelBlock" id="editHostelBlockModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditHostelBlockModalLabel">{{ __('messages.edit_block') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-hostel-block-form" method="post" action="{{ route('admin.hostel_block.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">           
                    <div class="form-group">
                        <label for="block_name">{{ __('messages.block_name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="block_name" name="block_name" class="form-control" placeholder="{{ __('messages.enter_the_block_name') }}">
                        <span class="text-danger error-text block_name_error"></span>
                    </div>
                    <div class="form-group" id="block_warden_div">
                        <label for="block_warden">{{ __('messages.block_warden') }}<span class="text-danger">*</span></label>
                        <select class="form-control select2-multiple" data-toggle="select2" name="block_warden[]" multiple="multiple" data-placeholder="{{ __('messages.select_warden') }}">
                            <option value="">{{ __('messages.select_warden') }}</option>
                            @forelse($warden as $war)
                            <option value="{{$war['id']}}">{{$war['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                        <span class="text-danger error-text block_warden_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="total_floor">{{ __('messages.total_floor') }}<span class="text-danger">*</span></label>
                        <input type="text"  name="total_floor" class="form-control" placeholder="{{ __('messages.enter_the_total_floor') }}">
                        <span class="text-danger error-text total_floor_error"></span>
                    </div>
                    <div class="form-group" id="block_leader_div">
                        <label for="block_leader">{{ __('messages.block_leader') }}</label>
                        <select class="form-control select2-multiple" data-toggle="select2" name="block_leader[]" multiple="multiple" data-placeholder="{{ __('messages.block_leader') }}">
                            <option value="">{{ __('messages.select_leader') }}</option>
                            @forelse($leader as $lead)
                            <option value="{{$lead['id']}}">{{$lead['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                        <span class="text-danger error-text block_leader_error"></span>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.update') }}</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->