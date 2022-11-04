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

class StaffAttendanceExport  extends BaseController implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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

        $excel = $Connection->table('staff_attendances as sa')
                            ->select('st.id',
                                    'sa.session_id',
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
                            ->when($session == "All", function ($q) {
                                $q->groupBy('sa.session_id');
                            })
                            ->when($session != "All", function ($q)  use ($session) {
                                $q->where('sa.session_id', $session);
                            })
                            ->groupBy('sa.staff_id')
                            ->orderBy('sa.staff_id')
                            ->orderBy('sa.session_id')
                            ->get();

        if(!empty($excel)) {

            foreach($excel as $key=>$li) {
                $staff_id = $li->id;
                $session_id = $li->session_id;
                $session_name = $Connection->table('session')->select('name')->where('id',$li->session_id)->first();

                $li->session_id = $session_name->name;
                foreach($tot as $t) {
                    $in_date = $Connection->table('staff_attendances as sa')
                                ->where('sa.staff_id', $staff_id)
                                ->where('sa.date',$t)
                                ->where('sa.session_id', $session_id)
                                ->first();
                                if($in_date) {
                                    if ($in_date->status == "present") {
                                        $li->$t = "P";
                                    } else if ($in_date->status == "absent") {
                                        $li->$t = "X";
                                    } else if ($in_date->status == "late") {
                                        $li->$t = "L";
                                    } else {
                                        $li->$t = 0;
                                    } 
                                }else{
                                    $li->$t = 0;
                                }
                    
                    
                }
                $excel[$key] = $li;
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

        $final = ['Employee Id','Session','Employee Name'];

        
        
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

    public function registerEvents(): array
    {
        
        
        $result = [
            AfterSheet::class => function(AfterSheet $event) {
                // dd($event);
                $date = $this->date;
                $month_date = explode("-", $date);
                $month = $month_date[0];
                $year = $month_date[1];

                
                $tot = date('t', strtotime($year.'-'.$month.'-01'));
                // dd($tot);
                $num = $event->sheet->getHighestRow();
                $cellRange = 'A1:AK1'; // All headers
                $cellRange2 = 'A1:A'.($num+1);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12)->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange2)->getFont()->setSize(12)->setBold(true);
                // $alphabets = ['C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG'];
                // foreach($alphabets as $a){
                // $event->sheet->setCellValue($a.($num+1),'=COUNTIF('.$a.'2:'.$a.$num.',"P")');
                // $cellRange3 = 'A'.($num+1).':AH'.($num+1);
                // $event->sheet->getDelegate()->getStyle($cellRange3)->getFont()->setSize(12)->setBold(true);
                // }
                //  $event->sheet->setCellValue('B'.($num+1),'Total');
                // $event->sheet->setCellValue('AH'.($num+1),'=SUM(AH2:AH'.$num.')');
            },
            
        
        ];
        return $result;
    }
}
