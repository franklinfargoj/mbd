<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Layout\ArchitectLayoutStatusLog;
use Illuminate\Support\Facades\DB;

class ArchitectLayoutDashboardController extends Controller
{
    public function dashboard(){

        $user_id = Auth::id();
        $architect_status_count = ArchitectLayoutStatusLog::whereIn('id',function($query) use ($user_id){
            $query->select(DB::raw('max(id)'))
                ->from('architect_layout_status_logs')
                ->where('user_id',$user_id)
                ->groupby('architect_layout_id');
        })
            ->select('status_id',DB::raw('count(status_id) as count'))
            ->groupby('status_id')
            ->get();
        //dd($architect_status_count->toArray());
        $architect_status_count = $architect_status_count->toArray();
//        dd($user_id);
        $status_type = config('commanConfig.architect_layout_status');
        //dd($status_type);
        $count_array=[];
        $match = 0;
        $count_array['total'] = 0;
        foreach ($status_type as $key => $status){
            foreach($architect_status_count as $architect_count){
                if($architect_count['status_id'] == $status){
                    $count_array[$key] = $architect_count['count'];
                    $match = 1;
                    break;
                }
                $match = 0;
            }
            if($match != 1){
                $count_array[$key] = 0;
            }
            $count_array['total'] = $count_array['total'] + $count_array[$key];
        }

       return view('admin.dashboard.architect_layout.dashboard',compact('count_array'));
    }

}