<div class="col-xl-7 col-md-7 col-sm-7">
    <div class="">
        <ul class="nav nav-tabs">
            <li class="nav-item">
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
            </li>
        </ul>

        <div class="table-responsive">
            <table class="table table-bordered table-nowrap table-hover table-centered m-0">
                <thead>
                    <tr>
                        <th>{{ __('messages.no') }}</th>
                        <th>{{ __('messages.date') }}</th>
                        <th>{{ __('messages.refered_by') }}</th>
                        <th>{{ __('messages.title') }}</th>
                        <th>{{ __('messages.action') }}</th>
                    </tr>
                </thead>

                <tbody>
                    
                    @foreach($soap_subject_list as $list)
                    
                        @php $count=1; @endphp
                        @if($list['soap_type_id']=="1")
                                <tr>
                                    <td>{{$count}}</td>
                                    <td>{{\Carbon\Carbon::parse($list['created_at'])->format('d/m/Y')}}</td>
                                    <td>Doctor</td>
                                    <td><button type="button" class="btn btn-blue waves-effect" data-toggle="modal" data-target="#sstt">
                                            {{$list['title']}}</button>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.soap_subject.edit', $list['id'])}}" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon deleteSoapSubjectBtn"  data-id="{{$list['id']}}" ><i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                            @php $count++; @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div> <!-- end .table-responsive-->
    </div> <!-- end card-box-->
</div> <!-- end col -->