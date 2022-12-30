<div class="tab-pane" id="log" data-tab="log">
    <div class="row"> 
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Log List
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form class="addSoapForm" method="post" action="{{ route('admin.soap.add') }}" autocomplete="off">
                        <input type="hidden" class="student_id" name="student_id">
                        <div class="row">
                            <div class="col-sm-12 col-xl-12 col-md-12">
                                <div class="">
                                    <div class="table-responsive">
                                        <!-- <table class="table w-100 nowrap " id="log-table"> -->
                                        <table class="table table-bordered table-nowrap table-hover table-centered m-0" id="log-table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Title</th>
                                                    <th>Soap Type</th>
                                                    <th>Action By</th>
                                                    <th>Action Type</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>

                                            <tbody id="log-body">
                                            </tbody>
                                        </table>
                                    </div> <!-- end .table-responsive-->
                                </div> <!-- end card-box-->
                            </div>
                        </div> <!-- end card-box-->
                    </form>
                </div> <!-- end col -->
            </div>
        </div>
    </div><!-- end row -->
</div>