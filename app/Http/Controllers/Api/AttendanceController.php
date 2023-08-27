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
        $arr = [];
        if($request->route()->getName()=='user.attendances'){
            $attendances = Attendance::where('employee_id', $request->user()->id)
                ->whereDate('created_at','=',today())
                ->whereNotNull('created_at')
                ->paginate();
        }
        // Else return all
        else {
            $attendances = Attendance::paginate();
        }

        if($attendances){
            foreach($attendances as $attendance){
                $list = [];
                $list['created_at'] = date('d F, Y',strtotime($attendance->created_at));

                if($attendance->check_in_at != null){
                    $list['check_in_at'] = date('h:i a', strtotime($attendance->check_in_at));                    
                }else{
                    $list['check_in_at'] = null;
                }
                if($attendance->check_out_at != null){
                    $list['check_out_at'] = date('h:i a', strtotime($attendance->check_out_at));
                }else{
                    $list['check_out_at'] = null;
                }

                $arr[] = $list;
            }
        }

        $response = [];
        $response['data'] = $arr;

        return $response;
    }

    public function show(Request $request){
        // Only auth user attendances
        if($request->route()->getName()=='user.attendance'){
            // Check your already checked in for today?
            $attendance = Attendance::where('employee_id', $request->user()->id)
                            ->whereDate('created_at','=',today())->first();
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
        $note = $request->all()[2];
        $position = $request->only([0,1]);

        $now = now();
        // Check employee near from office
        $employeeDistance = $attendanceService->employeeDistanceFromOffice($latitudeFrom,$longitudeFrom);
        $minDistance = Config::get('shwe-naga.attendance.min_distance');

        // Return Error if too far from office
        if($employeeDistance > $minDistance){
            $errorMessage = [
                'status'    => 'error',
                // 'message'   => "Too far! {$employeeDistance} m away from office.",
                'message' => 'လက်ရှိသင့် တည်နေရာသည် သတ်မှတ်နေရာ နှင့် ဝေးကွာနေသောကြောင့် ဝင်ရောက်၍မရပါ',
            ];
            return response($errorMessage,400);
        }

        // Check your already checked in for today?
        $attendance = Attendance::where('employee_id', $request->user()->id)
        ->whereDate('created_at','=',today())->first();


        // If first time, make checked in.
        if(!$attendance){
            $attendance = Attendance::create([
                'employee_id'       => $request->user()->id,
                'check_in_at'       => $now,
                'check_in_position' => $position,
                'note' => $note
            ]);
            $attendance = Attendance::find($attendance->id);
            $attendance['check_in_at'] = date('h:i a', strtotime($attendance->check_in_at));
            $attendance['check_out_at'] = date('h:i a', strtotime($attendance->check_out_at));

            return [
                'status' => 'ok',
                'data' => $attendance,
            ];
        }

        // If second time, make check out.
        if(!is_null($attendance)){
            if($attendance->check_in_at==null){
                $attendance->check_in_at = $now;
                $attendance->check_in_position = $position;
                if($attendance->notes){
                    $attendance->notes = $attendance->notes .'/'.$note;
                }else{
                    $attendance->notes = $note;
                }
            }else{
                $attendance->check_out_at = $now;
                $attendance->check_out_position = $position;
                if($attendance->notes){
                    $attendance->notes = $attendance->notes .' / '.$note;
                }else{
                    $attendance->notes = $note;
                }
            }
            $attendance->save();
        }
        // Return
        if($attendance->check_in_at != null){
            $attendance['check_in_at'] = date('h:i a', strtotime($attendance->check_in_at));
        }
        if($attendance->check_out_at != null){
            $attendance['check_out_at'] = date('h:i a', strtotime($attendance->check_out_at));
        }
        return [
            'status' => 'ok',
            'data' => $attendance,
        ];
    }
}