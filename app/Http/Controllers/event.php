public function event()
    {
        $classDetails = Classes::select('id', 'name')->get();
        $sectionDetails = SectionAllocation::select('sections_allocations.id', 'sections_allocations.class_id', 'sections_allocations.section_id', 'sections.name')->join('sections', 'sections.id', '=', 'sections_allocations.section_id')->get();
        // dd($docomuntOrders);
        $type = EventType::select('id', 'name')->get();
        return view('admin.event.index', ['type' => $type, 'classDetails' => $classDetails, 'sectionDetails' => $sectionDetails]);
    }


    // get Even Type details
    public function getEventList(Request $request)
    {
        $event = \DB::table("events")
            ->select("events.*", \DB::raw("GROUP_CONCAT(classes.name) as classname"), 'event_types.name as type', 'users.name as created_by')
            ->leftjoin("classes", \DB::raw("FIND_IN_SET(classes.id,events.selected_list)"), ">", \DB::raw("'0'"))
            ->leftjoin('event_types', 'event_types.id', '=', 'events.type')
            ->leftjoin('users', 'users.id', '=', 'events.created_by')
            ->groupBy("events.id")
            ->get();
        // $event = Event::select('events.id','events.title','events.audience','event_types.name as type','events.start_date','events.end_date','events.status','users.name as created_by')
        //     ->join('users','users.id','=','events.created_by')
        //     ->join('event_types','event_types.id','=','events.type')
        //     ->get();

        // $ch = Event::all(); data-plugin="switchery" data-color="#9261c6"
        //    dd($teacherAllocation);
        return DataTables::of($event)

            ->addIndexColumn()
            ->addColumn('classname', function ($row) {
                $audience = $row->audience;
                if ($audience == 1) {
                    return "Everyone";
                } else {
                    return "Class " . $row->classname;
                }
            })
            ->addColumn('status', function ($row) {

                $status = $row->status;
                if ($status == 1) {
                    $result = "checked";
                } else {
                    $result = "";
                }
                return '<input type="checkbox" ' . $result . ' data-id="' . $row->id . '"  id="publishEventBtn">';
            })
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row->id . '" id="viewEventBtn">View</a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row->id . '" id="deleteEventBtn">Delete</a>
                        </div>';
            })

            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    //add New Event Type
    public function addEvent(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'type' => 'required',
            'audience' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'class' => '',
            'section' => '',
            'description' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $event = new Event();
            $event->title = $request->title;
            $event->type = $request->type;
            $event->audience = $request->audience;

            if ($request->audience == 2) {
                $event->selected_list = json_encode($request->class);
            } elseif ($request->audience == 3) {
                $event->selected_list = json_encode($request->section);
            } else {
                $event->selected_list = NULL;
            }

            $event->start_date = $request->start_date;
            $event->end_date = $request->end_date;
            $event->remarks = $request->description;

            $user = Auth::id();
            $event->created_by = $user;
            $query = $event->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'New Event has been successfully saved']);
            }
        }
    }

    // get Event details
    public function getEvent(Request $request)
    {
        // dd($request);
        $event_id = $request->event_id;
        $eventDetails = \DB::table("events")
            ->select("events.*", \DB::raw("GROUP_CONCAT(classes.name) as classname"), 'event_types.name as type', 'users.name as created_by')
            ->leftjoin("classes", \DB::raw("FIND_IN_SET(classes.id,events.selected_list)"), ">", \DB::raw("'0'"))
            ->leftjoin('event_types', 'event_types.id', '=', 'events.type')
            ->leftjoin('users', 'users.id', '=', 'events.created_by')
            ->groupBy("events.id")
            ->where('events.id', $event_id)->first();
        // $eventDetails = Event::select('events.id','events.title','events.audience','event_types.name as type','events.start_date','events.end_date','events.status','users.name as created_by','events.remarks')
        //     ->join('users','users.id','=','events.created_by')
        //     ->join('event_types','event_types.id','=','events.type')
        //     ->find($event_id);
        return response()->json(['details' => $eventDetails]);
    }

    // delete Event 
    public function deleteEvent(Request $request)
    {
        $event_id = $request->event_id;
        Event::where('id', $event_id)->delete();
        return response()->json(['code' => 1, 'msg' => 'Event have been deleted from database']);
    }
    // Publish Event 
    public function publishEvent(Request $request)
    {

        $event = Event::find($request->event_id);
        $event->status = $request->value;
        $query = $event->save();

        return response()->json(['code' => 1, 'msg' => 'Event Updated Successfully']);
    }