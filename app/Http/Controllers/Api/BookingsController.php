<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\WorkTime;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    public function index()
    {
        # code...
    }
    public function store(Request $request)
    {
        $request->validate([
            'day' => 'date_format:Y-m-d'
        ]);
        $day = $request->day;
        $service_id = $request->service_id;
        $dayName = Carbon::parse($request->day)->dayName;
        $service = Service::findOrFail($service_id);
        $work_time = WorkTime::where([
            'user_id'=>$service->user_id,
            'days'=>$dayName
        ])->first();
         $start = Carbon::createFromTimeString($work_time->from);
         $end = Carbon::createFromTimeString($work_time->to);
         $reservation_time = Carbon::createFromTimeString($request->reservation_time);
        if (!$reservation_time->between($start,$end))
        {
            return response()->json([
                'status' => false,
                'message' => 'reservation time not in work time'
            ]);
        }

        $start_rev = Carbon::createFromFormat("H:i:s",$request->reservation_time);
        $end_rev = Carbon::createFromFormat("H:i:s",$request->reservation_time)->addMinutes($service->time);

        $reservation = Booking::where('service_id',$service_id)->whereDate('created_at',$request->day)
        ->whereNotIn('status',[3,4])
        ->whereBetween('from',[$start_rev ,  $end_rev])
        ->WhereBetween('to',[$start_rev ,  $end_rev])
        ->first();

        return $reservation;
        if ($reservation) {
            return response()->json([
                'status' => false,
                'message' => 'This time is reserved'
            ]);
        }else {
           $reservation = Booking::Create([
               'service_id' => $service_id,
               'from' => $start_rev,
               'to' => $end_rev,
               'shop_id' => $service->user_id,
               'service_time' => $service->time,
               'status' => 0
            ]);
            return response()->json([
                'status' => true,
                'message' => 'success booking ',
                'reservation' => $reservation
            ]);
        };



    }
    public function update($id,Request $request)
    {
        # code...
    }
    public function destory($id)
    {
        # code...
    }
}
