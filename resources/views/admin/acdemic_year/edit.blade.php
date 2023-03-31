<!-- Center modal content -->
<div class="modal fade editacademicYearModal" id="editacademicYearModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditacademicYearModalLabel">Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="academicYearUpdateForm" autocomplete="off">
                    @csrf
                    <input type="hidden" id="acdemicYearID" name="id">
                    <div class="form-group">
                        <label for="name">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                        @php
                        $firstYear = (int)date('Y') - 5;
                        $lastYear = $firstYear + 20;
                        @endphp
                        <select class="form-control" id="editacademicYear" name="name">
                            <option value="">Choose Class</option>
                            @for ($i=$firstYear;$i<=$lastYear;$i++) <option value="{{$i}}-{{$i+1}}">{{$i}}-{{$i+1}}</option>
                                @endfor
                        </select>
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