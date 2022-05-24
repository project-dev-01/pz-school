<!-- Center modal content -->
<div class="modal fade addHostel" id="addHostelModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddHostelModalLabel">Add Hostel</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="hostelForm" method="post" action="{{ route('admin.hostel.add') }}" autocomplete="off">
                    @csrf                   
                 
                    <div class="form-group">
                        <label for="name">Hostel Name<span class="text-danger">*</span></label>
                        <input type="text"  name="name" class="form-control" placeholder="Enter Hostel name">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="category">Category<span class="text-danger">*</span></label>
                        <select class="form-control" id="category" name="category">
                            <option value="">Select</option>
                            @foreach($category as $cat)
                            <option value="{{$cat['id']}}">{{$cat['name']}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text category_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="watchman">Warden Name<span class="text-danger">*</span></label>
                        <input type="text"  name="watchman" class="form-control" placeholder="Enter Warden name">
                        <span class="text-danger error-text watchman_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="address">Hostel Address<span class="text-danger">*</span></label>
                        <input type="text"  name="address" class="form-control" placeholder="Enter Hostel Address">
                        <span class="text-danger error-text address_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="remarks">Remarks</label>
                        <textarea type="text"  name="remarks" class="form-control" placeholder="Enter Remarks"> </textarea>
                        <span class="text-danger error-text remarks_error"></span>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-success waves-effect waves-light">Submit</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->