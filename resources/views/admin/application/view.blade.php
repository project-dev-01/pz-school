<style>
    .table td {
        border-top: none;
    }

    @media screen and (min-device-width: 280px) and (max-device-width: 653px) {
        .eventpopup {
            margin: 0px -30px 0px -27px;
        }
    }
</style>

<!-- Center modal content -->
<div class="modal fade viewApplication" id="viewApplicationModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title" id="myviewApplicationModalLabel" style="color: #6FC6CC"> <i class="fas fa-info-circle"></i>{{ __('messages.application_details') }} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-header row d-flex justify-content-between mx-1 mx-sm-3 mb-0 pb-0 border-0">
                <div class="tabs active" id="student_details">
                    <h6 class="font-weight-bold">{{ __('messages.student') }}</h6>
                </div>
                <div class="tabs" id="school_details">
                    <h6 class="text-muted">{{ __('messages.school') }}</h6>
                </div>
                <div class="tabs" id="mother_details">
                    <h6 class="text-muted">{{ __('messages.mother') }}</h6>
                </div>
                <div class="tabs" id="father_details">
                    <h6 class="text-muted">{{ __('messages.father') }}</h6>
                </div>
                <div class="tabs" id="guardian_details">
                    <h6 class="text-muted">{{ __('messages.guardian') }}</h6>
                </div>
            </div>
            <div class="line"></div>
            <div class="modal-body p-0">
                <fieldset class="show" id="student_details_tab">
                    <div class="row">
                        <div class="col">
                            <div class="card-box">
                                <div class="table-responsive"  style="background-color: #8adfee14;">
                                    <table class="table w-100 nowrap">
                                        <tr>
                                            <td>{{ __('messages.name') }}</td>
                                            <td class="name"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.gender') }}</td>
                                            <td class="gender"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.academic_year') }}</td>
                                            <td class="academic_year"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.grade') }}</td>
                                            <td class="academic_grade"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.date_of_birth') }}</td>
                                            <td class="date_of_birth"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.mobile_no') }}</td>
                                            <td class="mobile_no"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.email') }}</td>
                                            <td class="email"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.address_1') }}</td>
                                            <td class="address_1"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.address_2') }}</td>
                                            <td class="address_2"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.country') }}</td>
                                            <td class="country"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.state') }}</td>
                                            <td class="state"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.city') }}</td>
                                            <td class="city"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.postal_code') }}</td>
                                            <td class="postal_code"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div>
                </fieldset>
                <fieldset id="school_details_tab">
                    <div class="row">
                        <div class="col">
                            <div class="card-box">
                                <div class="table-responsive"  style="background-color: #8adfee14;">
                                    <table class="table w-100 nowrap">
                                        <tr>
                                            <td>{{ __('messages.academic_year') }}</td>
                                            <td class="school_year"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.grade') }}</td>
                                            <td class="grade"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.name') }}</td>
                                            <td class="school_last_attended"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.address_1') }}</td>
                                            <td class="school_address_1"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.address_2') }}</td>
                                            <td class="school_address_2"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.country') }}</td>
                                            <td class="school_country"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.state') }}</td>
                                            <td class="school_state"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.city') }}</td>
                                            <td class="school_city"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.postal_code') }}</td>
                                            <td class="school_postal_code"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div>
                </fieldset>
                <fieldset id="mother_details_tab">
                    <div class="row">
                        <div class="col">
                            <div class="card-box">
                                <div class="table-responsive"  style="background-color: #8adfee14;">
                                    <table class="table w-100 nowrap">
                                        <tr>
                                            <td>{{ __('messages.name') }}</td>
                                            <td class="mother_name"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.email') }}</td>
                                            <td class="mother_email"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.phone_number') }}</td>
                                            <td class="mother_phone_number"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.occupation') }}</td>
                                            <td class="mother_occupation"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div>
                </fieldset>
                <fieldset id="father_details_tab">
                    <div class="row">
                        <div class="col">
                            <div class="card-box">
                                <div class="table-responsive"  style="background-color: #8adfee14;">
                                    <table class="table w-100 nowrap">
                                        <tr>
                                            <td>{{ __('messages.name') }}</td>
                                            <td class="father_name"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.email') }}</td>
                                            <td class="father_email"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.phone_number') }}</td>
                                            <td class="father_phone_number"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.occupation') }}</td>
                                            <td class="father_occupation"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div>
                </fieldset>
                <fieldset id="guardian_details_tab">
                    <div class="row">
                        <div class="col">
                            <div class="card-box">
                                <div class="table-responsive"  style="background-color: #8adfee14;">
                                    <table class="table w-100 nowrap">
                                        <tr>
                                            <td>{{ __('messages.name') }}</td>
                                            <td class="guardian_name"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.relation') }}</td>
                                            <td class="guardian_relation"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.email') }}</td>
                                            <td class="guardian_email"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.phone_number') }}</td>
                                            <td class="guardian_phone_number"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.occupation') }}</td>
                                            <td class="guardian_occupation"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div>
                </fieldset>
            </div>
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->