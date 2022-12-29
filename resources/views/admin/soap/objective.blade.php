
                    <div class="tab-pane" id="objective" data-tab="objective">
                        <div class="row">
                            <div class="col-xl-12 col-sm-12 col-md-12">
                                <div class="card-box">
                                    <form class="addSoapForm" method="post" action="{{ route('admin.soap.add') }}" autocomplete="off">
                                        <div class="form-group text-right m-b-0">
                                            <!--<button type="button" class="btn btn-secondary waves-effect">Close</button>-->
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                        </div>
                                        <input type="hidden" class="student_id" name="student_id">
                                        <div class="row">
                                            <div class="col-sm-2 col-xl-2 col-md-2">
                                                <div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                    @foreach($soap_category_list as $key=>$category)
                                                        @if($category['soap_type_id']=="2")
                                                            <li class="dropdown btn-group mb-2 dropright">
                                                                <button class="nav-link btn btn-blue waves-effect waves-light dropdown-toggle category" data-toggle="dropdown" data-category = "{{$category['id']}}" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                                     {{$category['name']}}
                                                                </button>
                                                                <div class="dropdown-menu dropdown-lg dropdown-menu-left">
                                                                    <div class="p-lg-1">
                                                                        <div class="row no-gutters sub_category_list">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div> <!-- end col-->

                                            <div class="col-sm-10">
                                                <div class="col-sm-12 col-xl-12 col-md-12">
                                                    <div class="row">
                                                        <div class="col-xl-5 col-md-5 col-sm-5">
                                                            <div class="">
                                                                @foreach($soap_category_list as $category)
                                                                    @if($category['soap_type_id']=="2")
                                                                        <ul class="nav nav-tabs">
                                                                            <li class="nav-item">
                                                                                <h4 class="navv">{{$category['name']}} Details<h4>
                                                                            </li>
                                                                        </ul>
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered table-nowrap table-hover table-centered m-0">
                                                                                <thead>
                                                                                    <th>No</th>
                                                                                    <th>Subject</th>
                                                                                    <th>Refered By</th>
                                                                                    <th>Date</th>
                                                                                    <th>Action</th>
                                                                                </thead>

                                                                                <tbody id="objective-category-{{ $category['id'] }}" class="objective-category-table">
                                                                                </tbody>
                                                                            </table>
                                                                        </div> <!-- end .table-responsive-->
                                                                        <br><br>
                                                                    @endif
                                                                @endforeach
                                                            </div> <!-- end card-box-->
                                                        </div> <!-- end col --><div class="col-xl-7 col-md-7 col-sm-7">
    <div class="">
        <ul class="nav nav-tabs">
            <!-- <li class="nav-item"> -->
                <div class="row">
                    <div class="col-12">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-8">
                                </div>
                                <div class="">
                                    <div class="text-lg-right mt-3 mt-lg-0">
                                        <a href="{{ route('admin.soap_subject.create')}}" type="button" class="btn btn-white waves-effect waves-light mr-1"><i class="mdi mdi-plus-circle mr-1"></i>Add</a>
                                    </div>
                                </div>
                                <!-- end col-->
                            </div> <!-- end row -->
                        </div> <!-- end card-box -->
                    </div><!-- end col-->
                </div>
            <!-- </li> -->
        </ul>

        <div class="table-responsive">
            <table class="table table-bordered table-nowrap table-hover table-centered m-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Refered By</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="objective-subject-table">
                </tbody>
            </table>
        </div> <!-- end .table-responsive-->
    </div> <!-- end card-box-->
</div> <!-- end col -->
                                                    </div>
                                                </div>
                                            </div> <!-- end col-->

                                        </div> <!-- end card-box-->
                                    </form>
                                </div> <!-- end col -->
                            </div>
                        </div><!-- end row -->
                    </div>