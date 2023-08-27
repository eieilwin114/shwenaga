<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MonthlyPerformance;  
use App\Models\Shop;
use App\Models\User;
use Auth;

class MonthlyPerformanceController extends Controller
{
    function index(){
        $shops = [];
        $employees = [];
        if(backpack_user()->hasRole('admin')){
            $shops_data = Shop::all();
        }else{
            $shops_data = Shop::all()->where('id',backpack_user()->shop_id);
        }
        
        if($shops_data){
            foreach($shops_data as $shop){
                $shops[$shop->id] = $shop->name;
            }
        }
        $employee_data = User::all()->where('shop_id',backpack_user()->shop_id);
        if($employee_data){
            foreach($employee_data as $employee){
                $employees[$employee->id] = $employee->name;
            }
        }
        $divisions = get_all_divisions();
        $from_month = session()->get(PER_FROMMONTH_FILTER);
        $to_month = session()->get(PER_TOMONTH_FILTER);
        $employee = session()->get(PER_EMPLOYEE_FILTER);
        $shop = session()->get(PER_SHOP_FILTER);
        $division = session()->get(PER_DIVISION_FILTER);

        $f_year = date('Y', strtotime($from_month));
        $f_month = date('m', strtotime($from_month));
        $t_year = date('Y', strtotime($to_month));
        $t_month = date('m', strtotime($to_month));

        $monthlyperformances = MonthlyPerformance::select('monthly_performances.*','users.name','shops.name as shop','divisions.division')
        ->join('users','users.id','=','monthly_performances.employee_id')
        ->leftjoin('shops','shops.id','monthly_performances.shop_id')
        ->join('divisions','divisions.id','shops.division_id');
        if($from_month){
            $monthlyperformances = $monthlyperformances->whereMonth('month', '>=', $f_month);
            $monthlyperformances = $monthlyperformances->whereYear('month', $f_year);
        }
        if($to_month){
            $monthlyperformances = $monthlyperformances->whereMonth('month','<=', $t_month);
            $monthlyperformances = $monthlyperformances->whereYear('month', $t_year);
        }
        if($employee){
            $monthlyperformances = $monthlyperformances->where('employee_id', $employee);
        }
        if($shop){
            $monthlyperformances = $monthlyperformances->where('monthly_performances.shop_id', $shop);
        }
        if($division){
            $monthlyperformances = $monthlyperformances->where('shops.division_id', $division);
        }
        $monthlyperformances = $monthlyperformances->get();
        return view('monthlyperformance.index',compact('monthlyperformances','shops','employees','divisions'));
    }

    function create(){
        $shops = [];
        $employees = [];
        if(backpack_user()->hasRole('admin')){
            $shops_data = Shop::all();
        }else{
            $shops_data = Shop::all()->where('id',backpack_user()->shop_id);
        }
        if($shops_data){
            foreach($shops_data as $shop){
                $shops[$shop->id] = $shop->name;
            }
        }
        if(backpack_user()->hasRole('admin')){
            $employee_data = User::all();
        }else{
            $employee_data = User::all()->where('shop_id',backpack_user()->shop_id);
        }
        if($employee_data){
            foreach($employee_data as $employee){
                $employees[$employee->id] = $employee->name;
            }
        }
        return view('monthlyperformance.create',compact(['shops','employees']));
    }

    function store(Request $request){
        $request->validate([
            'shop_id' => 'required',
            'employee_id' => 'required',
            'month' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $employeeId = $request->employee_id;
                    $shopId = $request->shop_id;
                    $year = date('Y', strtotime($request->month));
                    $month = date('m', strtotime($request->month));

                    $performance = MonthlyPerformance::where('employee_id', $employeeId)
                        ->where('shop_id', $shopId)
                        ->whereMonth('month', $month)
                        ->whereYear('month', $year)
                        ->exists();

                    if ($performance) {
                        $fail('Month has already been taken for this employee.');
                    }
                },
            ],
        ]);
        
        $input = $request->all();
        $input['month'] = date('Y-m-d',strtotime($request->month));
        $input['created_by'] = 1;
        MonthlyPerformance::create($input);
        return redirect()->route('monthlyperformance.index');
    }

    function edit($id){
        
        $shops = [];
        $employees = [];
        $shops_data = Shop::all();
        if($shops_data){
            foreach($shops_data as $shop){
                $shops[$shop->id] = $shop->name;
            }
        }
        $employee_data = User::all();
        if($employee_data){
            foreach($employee_data as $employee){
                $employees[$employee->id] = $employee->name;
            }
        }
        $monthlyperformance = MonthlyPerformance::find($id);
        return view('monthlyperformance.edit',compact(['shops','employees','monthlyperformance']));
    }

    function update(Request $request,$id){
        $request->validate([
            'shop_id' => 'required',
            'employee_id' => 'required',
            'month' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $employeeId = $request->employee_id;
                    $shopId = $request->shop_id;
                    $year = date('Y', strtotime($request->month));
                    $month = date('m', strtotime($request->month));

                    $performance = MonthlyPerformance::where('employee_id', $employeeId)
                        ->where('shop_id', $shopId)
                        ->whereMonth('month', $month)
                        ->whereYear('month', $year)
                        ->exists();

                    if ($performance) {
                        $fail('Month has already been taken for this employee.');
                    }
                },
            ],
        ]);

        $input = $request->all(); 
        $input['month'] = date('Y-m-d',strtotime($request->month)); 
        $input['updated_by'] = 1;
        $monthlyperformance = MonthlyPerformance::find($id);
        if($monthlyperformance){
            $monthlyperformance->update($input);
        }
        return redirect()->route('monthlyperformance.index');

    }

    function search(Request $request){
        session()->start();
        session()->put(PER_FROMMONTH_FILTER, trim($request->from_month));
        session()->put(PER_TOMONTH_FILTER, trim($request->to_month));
        session()->put(PER_EMPLOYEE_FILTER, trim($request->employee_id));
        session()->put(PER_SHOP_FILTER, trim($request->shop_id));
        session()->put(PER_DIVISION_FILTER, trim($request->division_id));
        return redirect()->route('monthlyperformance.index');
    }

    function reset(){
        session()->forget([
            PER_FROMMONTH_FILTER,
            PER_TOMONTH_FILTER,
            PER_EMPLOYEE_FILTER,
            PER_SHOP_FILTER,
            PER_DIVISION_FILTER,
        ]);
        return redirect()->route('monthlyperformance.index');
    }
}
