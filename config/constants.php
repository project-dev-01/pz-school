<?php
$url = "http://localhost/school-management-system/public/api";
return [

    'api' => [
        // login url
        'login' => $url.'/login',
        // country,state,cities
        'countries' => $url.'/get-countries',
        'states' => $url.'/get-states',
        'cities' => $url.'/get-cities',
        // section url
        'section_add' => $url.'/section/add',
        'section_list' => $url.'/section/list',
        'section_details' => $url.'/section/section-details',
        'section_update' => $url.'/section/update',
        'section_delete' => $url.'/section/delete',
        // branch url
        'branch_add' => $url.'/branch/add',
        'branch_list' => $url.'/branch/list',
        'branch_details' => $url.'/branch/branch-details',
        'branch_update' => $url.'/branch/update',
        'branch_delete' => $url.'/branch/delete',
         // section allocation url
        'allocate_section_add' => $url.'/allocate_section/add',
        'allocate_section_list' => $url.'/allocate_section/list',
        'allocate_section_details' => $url.'/allocate_section/section_allocation-details',
        'allocate_section_update' => $url.'/allocate_section/update',
        'allocate_section_delete' => $url.'/allocate_section/delete',

        'branch_by_class' => $url.'/branch-by-class',
        'branch_by_section' => $url.'/branch-by-section',
        // class url
        'class_add' => $url.'/classes/add',
        'class_list' => $url.'/classes/list',
        'class_details' => $url.'/classes/class-details',
        'class_update' => $url.'/classes/update',
        'class_delete' => $url.'/classes/delete',

        // department url
        'department_add' => $url.'/department/add',
        'department_list' => $url.'/department/list',
        'department_details' => $url.'/department/department-details',
        'department_update' => $url.'/department/update',
        'department_delete' => $url.'/department/delete',

        // designation url
        'designation_add' => $url.'/designation/add',
        'designation_list' => $url.'/designation/list',
        'designation_details' => $url.'/designation/designation-details',
        'designation_update' => $url.'/designation/update',
        'designation_delete' => $url.'/designation/delete',
        
    ]

];
