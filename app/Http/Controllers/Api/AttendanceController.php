<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Config;
use App\Services\AttendanceService;
use App\Models\Attendance;
use Carbon\Carbon;


class AttendanceController extends Controller
{


    public function index(Request $request){
        // Only auth user attendances
        if($request->route()->getName()=='user.attendances'){
            return Attendance::
                where('employee_id', $request->user()->id)
                ->whereDate('created_at','=',Carbon::today())
                ->paginate();
        }
        // Else return all
        else {
            return Attendance::paginate();
        }
    }

    public function show(Request $request){
        // Only auth user attendances
        if($request->route()->getName()=='user.attendance'){
            // Check your already checked in for today?
            $attendance = Attendance::where('employee_id', $request->user()->id)
                            ->whereDate('created_at','=',Carbon::today())->first();
            // If first time, make checked in.
            if(!$attendance){
                $attendance = Attendance::create([
                    'employee_id'       => $request->user()->id,
                ]);
                $attendance = Attendance::find($attendance->id);
            }
            return $attendance;
        }
    }




    public function store(Request $request, AttendanceService $attendanceService){


        // Perpare varibles
        $latitudeFrom = $request->all()[0];
        $longitudeFrom = $request->all()[1];
        $position = $request->only([0,1]);


        // Check employee near from office
        $employeeDistance = $attendanceService->employeeDistanceFromOffice($latitudeFrom,$longitudeFrom);
        $minDistance = Config::get('shwe-naga.attendance.min_distance');

        // Return Error if too far from office
        if($employeeDistance > $minDistance){
            $errorMessage = [
                'status'    => 'error',
                'message'   => "Too far! {$employeeDistance} m away from office.",
            ];
            return response($errorMessage,400);
        }


        // Check your already checked in for today?
        $attendance = Attendance::where('employee_id', $request->user()->id)
        ->whereDate('created_at','=',Carbon::today())->first();


        // If first time, make checked in.
        if(!$attendance){
            $attendance = Attendance::create([
                'employee_id'       => $request->user()->id,
                'check_in_at'       => Carbon::now(),
                'check_in_position' => $position,
            ]);
            $attendance = Attendance::find($attendance->id);
            return [
                'status' => 'ok',
                'data' => $attendance,
            ];
        }


        // If second time, make check out.
        if(!is_null($attendance)){
            if($attendance->check_in_at==null){
                $attendance->check_in_at = Carbon::now();
                $attendance->check_in_position = $position;
            }else{
                $attendance->check_out_at = Carbon::now();
                $attendance->check_out_position = $position;
            }
            $attendance->save();
        }

        // Return
        return [
            'status' => 'ok',
            'data' => $attendance,
        ];
    }
}