<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <h4 class="navv">
                        {{ $row_details['widget_name'] }}
                        @php
                        $details = [
                        'academic_session_id' => session()->get('academic_session_id'),
                        'staff_id' => session()->get('ref_user_id'),
                        'department_id' => $row_details['department_id'],
                        'class_id' => $row_details['class_id'],
                        'section_id' => $row_details['section_id'],
                        'pattern' => $row_details['pattern'],
                        ];
                        $absent_attendance_report = App\Helpers\Helper::PostMethod(config('constants.api.absent_attendance_report'), $details);
                        $type = "";
                        $absent_count = 'N/A';
                        if ($absent_attendance_report && $absent_attendance_report['code'] == '200') {
                        $data = $absent_attendance_report['data'];
                        $type = isset($data['type'])?$data['type']:'';
                        $absent_count = isset($data['absent_details'][0]['no_of_days_attendance'])?$data['absent_details'][0]['no_of_days_attendance']:'N/A';
                        }
                        @endphp
                    </h4>
                </li>
            </ul><br><br>

            <div class="col-xl-12">
                <div class="card">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-4">
                                <!-- Add content for the left column if needed -->
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-body">
                                        <p style="text-align:center;">{{ $type }} Absence</p>
                                        <div class="widget-rounded-circle">
                                            <div class="card-widgets">
                                                <!-- Add content for card widgets if needed -->
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="greetingCntRing" style="transform: translate(224%, 0%);">
                                                        <p style="text-align:center;">{{ $absent_count }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end col -->
        </div>
        <!-- end row-->
    </div>
</div>