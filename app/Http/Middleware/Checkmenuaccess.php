<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use App\Helpers\Helper;
class Checkmenuaccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //local URL start
        $url = str_replace('/school-management-system/public/','',$_SERVER['REQUEST_URI']);
        //local URL end
        //LIVE URL start
        //$url = $_SERVER['REQUEST_URI'];
        //LIVE URL end
        $role_id = Session::get('role_id');
        $school_roleid = Session::get('school_roleid');
        $branch_id =config('constants.branch_id');
        if(!empty($school_roleid) && $school_roleid!='1')
        {
            $pagedata = [
                
                'menu_id' => $url, 
                'role_id' => $role_id,  
                'school_roleid' => $school_roleid,             
                'br_id' => $branch_id
            ];    
           // dd($pagedata);
            $permission = Helper::PostMethod(config('constants.api.getschoolroleaccess'), $pagedata);
           // dd($permission);
            if($permission === null) 
            {
                return $next($request);
            }
            elseif($permission['data']['read']=='Access')
            {
                return $next($request);
            }
            else
            {
                abort(403);
            }    

        }   
        else
        {
            return $next($request);
        }   
    }
}
