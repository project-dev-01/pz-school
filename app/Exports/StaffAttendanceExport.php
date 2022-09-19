<?php

namespace App\Exports;

use DateTime;
use DateInterval;
use DatePeriod;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
Use DB;
// base controller add
use App\Http\Controllers\Api\BaseController as BaseController;

class StaffAttendanceExport  extends BaseController implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    protected $branch;
    protected $staff;
    protected $session;
    protected $date;
    protected $department;

    function __construct($branch,$staff,$session,$date,$department) {
        $this->branch = $branch;
        $this->staff = $staff;
        $this->session = $session;
        $this->date = $date;
        $this->department = $department;
    }
    public function collection()
    {
        $branch = $this->branch;
        $staff = $this->staff;
        $session = $this->session;
        $date = $this->date;
        $department = $this->department;
        $month_year = explode("-", $date);
        $m = $month_year[0];
        $y = $month_year[1];

        
        
        $start = $y.'-'.$m.'-01';
        $end = date('Y-m-t', strtotime($start));
        //
        $startDate = new DateTime($start);
        $endDate = new DateTime($end);
          
        $date='';
        $tot=[];
        while ($startDate <= $endDate) {
            
            $dat = $startDate->format('Y-m-d');
            array_push($tot,$dat);
            $date.= $dat.',';
            $startDate->modify('+1 day');
        }
        // dd($date);
        $trimdate = rtrim($date,",");
        $attend = \DB::raw($trimdate);
        $Connection = $this->createNewConnection($branch);

        if($session=="All") {
            $sess = $Connection->table('session')->get();
            foreach($sess as $ses)
            {
                $excel = $Connection->table('staff_attendances as sa')
                ->select('st.id',
                    \DB::raw("CONCAT(st.first_name, ' ', st.last_name) as name"),
                    $attend,
                    DB::raw('COUNT(CASE WHEN sa.status = "present" then 1 ELSE NULL END) as "presentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "absent" then 1 ELSE NULL END) as "absentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "late" then 1 ELSE NULL END) as "lateCount"'
                ))
                
                ->join('staffs as st', 'sa.staff_id', '=', 'st.id')
                ->when($staff != "All", function ($q)  use ($staff) {
                    $q->where('sa.staff_id', $staff);
                })
                
                ->when($staff == "All", function ($q)  use ($department) {
                    $q->where('st.department_id', $department);
                })
                ->join('staffs', 'staffs.id', '=','sa.staff_id' )
                ->whereMonth('sa.date', $m)
                ->whereYear('sa.date', $y)
                ->where('sa.session_id', $ses->id)
                ->groupBy('sa.staff_id')
                ->get();

                // dd($excel);
                foreach($excel as $exc) {
                    $staff_id = $exc->id; 

                    foreach($tot as $t) {
                        $in_date = $Connection->table('staff_attendances as sa')
                                    ->where('sa.staff_id', $staff_id)
                                    ->where('sa.date',$t)
                                    ->where('sa.session_id', $ses->id)
                                    ->first();
                                    if($in_date) {
                                        $exc->$t = $in_date->status;
                                    }else{
                                        $exc->$t = 0;
                                    }
                        // dd($exc);
                        
                    }
                    // dd($implode);
                }
            }
            
        } else {
            $excel = $Connection->table('staff_attendances as sa')
                    ->select('st.id',
                        \DB::raw("CONCAT(st.first_name, ' ', st.last_name) as name"),
                        $attend,
                        DB::raw('COUNT(CASE WHEN sa.status = "present" then 1 ELSE NULL END) as "presentCount"'),
                        DB::raw('COUNT(CASE WHEN sa.status = "absent" then 1 ELSE NULL END) as "absentCount"'),
                        DB::raw('COUNT(CASE WHEN sa.status = "late" then 1 ELSE NULL END) as "lateCount"'
                    ))
                    
                    ->join('staffs as st', 'sa.staff_id', '=', 'st.id')
                    ->when($staff != "All", function ($q)  use ($staff) {
                        $q->where('sa.staff_id', $staff);
                    })
                    
                    ->when($staff == "All", function ($q)  use ($department) {
                        $q->where('st.department_id', $department);
                    })
                    ->join('staffs', 'staffs.id', '=','sa.staff_id' )
                    ->whereMonth('sa.date', $m)
                    ->whereYear('sa.date', $y)
                    ->where('sa.session_id', $session)
                    ->groupBy('sa.staff_id')
                    ->get();

            // dd($excel);
            foreach($excel as $exc) {
                $staff_id = $exc->id; 

                foreach($tot as $t) {
                    $in_date = $Connection->table('staff_attendances as sa')
                                ->where('sa.staff_id', $staff_id)
                                ->where('sa.date',$t)
                                ->where('sa.session_id', $session)
                                ->first();
                                if($in_date) {
                                    $exc->$t = $in_date->status;
                                }else{
                                    $exc->$t = 0;
                                }
                    // dd($exc);
                    
                }
                // dd($implode);
            }
        }
        
                
            // dd($excel);            
        return $excel;
    }

    
    public function headings(): array
    {
        $date = $this->date;
        $month_year = explode("-", $date);
        $m = $month_year[0];
        $y = $month_year[1];

        $final = ['Employee Id','Employee Name'];

        
        
        $start = $y.'-'.$m.'-01';
        $end = date('Y-m-t', strtotime($start));
        //
        $startDate = new DateTime($start);
        $endDate = new DateTime($end);

        while ($startDate <= $endDate) {
            
            $dat = $startDate->format('Y-m-d');
            array_push($final,$dat);
            $startDate->modify('+1 day');
        }

        
        array_push($final,'Total Present'); 
        array_push($final,'Total Absent'); 
        array_push($final,'Total Late'); 

        return $final;
    }
}
