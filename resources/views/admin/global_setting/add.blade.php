<!-- Center modal content -->
<div class="modal fade addGlobalSetting" id="addGlobalSettingModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddGlobalSettingModalLabel">Add Global Setting</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="globalSettingForm" method="post" action="{{ route('admin.global_setting.add') }}" autocomplete="off">
                    @csrf                   
                 
                    <div class="form-group">
                        <label for="year_id">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                        <select id="year_id" class="form-control" name="year_id">
                            <option value="">Choose Academic Year</option>
                            @forelse($academic_year_list as $r)
                            <option value="{{$r['id']}}">{{$r['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                        <span class="text-danger error-text year_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="footer_text">Footer Text<span class="text-danger">*</span></label>
                        <textarea  id="footer_text" class="form-control"  placeholder="Enter Footer Text" name="footer_text" >
                        </textarea>
                        <span class="text-danger error-text footer_text_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="timezone">TimeZone<span class="text-danger">*</span></label>
                        <select id="timezone" class="form-control" name="timezone">
                            <option value="">Choose TimeZone</option>
                            @forelse($timezone as $tz)
                            <option >{{$tz}}</option>
                            @empty
                            @endforelse
                        </select>
                        <span class="text-danger error-text timezone_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="facebook_url">Facebook Url<span class="text-danger">*</span></label>
                        <input type="text" id="facebook_url" name="facebook_url" class="form-control" placeholder="Enter Facebook Url">
                        <span class="text-danger error-text facebook_url_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="twitter_url">Twitter Url<span class="text-danger">*</span></label>
                        <input type="text" id="twitter_url" name="twitter_url" class="form-control" placeholder="Enter Twitter Url">
                        <span class="text-danger error-text twitter_url_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="linkedin_url">LinkedIn Url<span class="text-danger">*</span></label>
                        <input type="text" id="linkedin_url" name="linkedin_url" class="form-control" placeholder="Enter LinkedIn Url">
                        <span class="text-danger error-text linkedin_url_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="youtube_url">Youtube Url<span class="text-danger">*</span></label>
                        <input type="text" id="youtube_url" name="youtube_url" class="form-control" placeholder="Enter Youtube Url">
                        <span class="text-danger error-text youtube_url_error"></span>
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