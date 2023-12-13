<!-- Center modal content -->
<div class="modal fade editFormField" id="editFormFieldModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditFormFieldModalLabel">{{ __('messages.form_field') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-form-field-form" method="post" action="{{ route('admin.form_field.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">

                    <div class="table-responsive mt-md mb-md">
                                    <table class="table table-striped table-bordered table-condensed mb-none">
                                        <tbody>
                                            <tr>
                                                <th width="50%">{{ __('messages.name_english') }}</th>
                                                <td width="50%" class="name_english"><input type="checkbox" name="name_english" id="name_english"></td>
                                            </tr>
                                            <tr>
                                                <th width="50%">{{ __('messages.name_furigana') }}</th>
                                                <td width="50%" class="name_furigana"><input type="checkbox" name="name_furigana" id="name_furigana"></td>
                                            </tr>
                                            
                                            <tr>
                                                <th width="50%">{{ __('messages.visa') }}</th>
                                                <td width="50%" class="visa"><input type="checkbox" name="visa" id="visa"></td>
                                            </tr>
                                            <tr>
                                                <th width="50%">{{ __('messages.passport') }}</th>
                                                <td width="50%" class="passport"><input type="checkbox" name="passport" id="passport"></td>
                                            </tr>
                                            <tr>
                                                <th width="50%">{{ __('messages.nric') }}</th>
                                                <td width="50%" class="nric"><input type="checkbox" name="nric" id="nric"></td>
                                            </tr>
                                            <tr>
                                                <th width="50%">{{ __('messages.nationality') }}</th>
                                                <td width="50%" class="nationality"><input type="checkbox" name="nationality" id="nationality"></td>
                                            </tr>
                                            <tr>
                                                <th width="50%">{{ __('messages.race') }}</th>
                                                <td width="50%" class="race"><input type="checkbox" name="race" id="race"></td>
                                            </tr>
                                            <tr>
                                                <th width="50%">{{ __('messages.religion') }}</th>
                                                <td width="50%" class="religion"><input type="checkbox" name="religion" id="religion"></td>
                                            </tr>
                                            <tr>
                                                <th width="50%">{{ __('messages.blood_group') }}</th>
                                                <td width="50%" class="blood_group"><input type="checkbox" name="blood_group" id="blood_group"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                    <div class="form-group text-center">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.update') }}</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->