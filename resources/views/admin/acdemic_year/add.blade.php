<!-- Center modal content -->
<div class="modal fade academicYearModal" id="academicYearModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myacademicYearModalLabel">Add Class</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="yearSubmit" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="name">Academic Year<span class="text-danger">*</span></label>
                        @php
                        $firstYear = (int)date('Y') - 5;
                        $lastYear = $firstYear + 20;
                        @endphp
                        <select class="form-control" id="academicYear" name="name">
                            <option value="">Choose Class</option>
                            @for ($i=$firstYear;$i<=$lastYear;$i++) 
                            <option value="{{$i}}-{{$i+1}}">{{$i}}-{{$i+1}}</option>    
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->