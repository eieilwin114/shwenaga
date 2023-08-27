<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Exports\AttendanceExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    public function index(){
        $from_date_filter = session()->get(AT_FROMDATE_FILTER);
        $to_date_filter = session()->get(AT_TODATE_FILTER);
        $division_filter = session()->get(AT_DIVISION_FILTER);
        $shop_filter = session()->get(AT_SHOP_FILTER);
        $name_filter = session()->get(AT_NAME_FILTER);

        $divisions = get_all_divisions();
        $shops = get_all_shops();
        $sale_persons = get_all_sale_persons($shop_filter);
        
        $attendances = Attendance::select('attendances.*', 'users.name as user_name','shops.name as shop_name', 'divisions.division')
        ->join('users','users.id','=','attendances.employee_id')
        ->leftjoin('shops', 'shops.id' , '=', 'users.shop_id')        
        ->leftjoin('divisions', 'divisions.id', '=', 'shops.division_id')
        ->whereNotNull('check_in_at');
        
        if($from_date_filter){
            $attendances = $attendances->where(\DB::raw('DATE(created_at)'),'>=',$from_date_filter);
        }
        
        if($to_date_filter){
            $attendances = $attendances->where(\DB::raw('DATE(created_at)'),'<=',$to_date_filter);
        }

        if($division_filter){
            $attendances = $attendances->where('division_id',$division_filter);
        }

        if($shop_filter){
            $attendances = $attendances->where('shop_id',$shop_filter);
        }

        if($name_filter){
            $attendances = $attendances->where('users.id',$name_filter);
        }
        
        $attendances = $attendances->get();
        
        return view('attendance.index',compact('attendances','divisions','shops','sale_persons'));
    }

    function search(Request $request){
        session()->start();
        session()->put(AT_FROMDATE_FILTER, trim($request->from_date));
        session()->put(AT_TODATE_FILTER, trim($request->to_date));
        session()->put(AT_DIVISION_FILTER, trim($request->division_id));
        session()->put(AT_SHOP_FILTER, trim($request->shop_id));
        session()->put(AT_NAME_FILTER, trim($request->name));
        return redirect()->route('attendance.index');
    }

    function reset(){
        session()->forget([
            AT_FROMDATE_FILTER,
            AT_TODATE_FILTER,
            AT_DIVISION_FILTER,
            AT_SHOP_FILTER,
            AT_NAME_FILTER
        ]);
        return redirect()->route('attendance.index');
    }

    public function export(){
        $from_date_filter = session()->get(AT_FROMDATE_FILTER);
        $to_date_filter = session()->get(AT_TODATE_FILTER);
        $division_filter = session()->get(AT_DIVISION_FILTER);
        $shop_filter = session()->get(AT_SHOP_FILTER);
        $name_filter = session()->get(AT_NAME_FILTER);

        $attendances = Attendance::select('attendances.*', 'users.name as user_name','shops.name as shop_name', 'divisions.division')
        ->join('users','users.id','=','attendances.employee_id')
        ->leftjoin('shops', 'shops.id' , '=', 'users.shop_id')        
        ->leftjoin('divisions', 'divisions.id', '=', 'shops.division_id')
        ->whereNotNull('check_in_at');

        if($from_date_filter){
            $attendances = $attendances->where(\DB::raw('DATE(check_in_at)'),'>=',$from_date_filter);
        }

        if($to_date_filter){
            $attendances = $attendances->where(\DB::raw('DATE(check_in_at)'),'<=',$to_date_filter);
        }

        if($division_filter){
            $attendances = $attendances->where('division_id',$division_filter);
        }

        if($shop_filter){
            $attendances = $attendances->where('shop_id',$shop_filter);
        }

        if($name_filter){
            $attendances = $attendances->where('users.id',$name_filter);
        }
        
        $attendances = $attendances->get();
        // return $attendances;
        return Excel::download(new AttendanceExport($attendances), 'attendances.xlsx');
    }
}
