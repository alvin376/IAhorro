<?php

namespace App\Http\Middleware;

use Validator;
use Closure;
use Illuminate\Http\Request;

class VerifyRequestRecord
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $validateData = $this->validaty_request($request);
        if ($validateData->fails()) {
            return response()->json(['result' => false, 'status' => 'error_validate', 'description' => $validateData->errors()]);
        }

        return $next($request);
    }

    private function validaty_request($request) {

        $validateData = Validator::make($request->all(), [
            'full_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:records',
            'phone_number' => 'required|max:255',
            'income' => 'required|Integer',
            'requested_amount' => 'required|Integer',
            'time_slot_start' => [
                'required', 
                'max:5', 
                'regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/'
            ],
            'time_slot_end' => ['required', 'max:5', 'regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/']
        ]);

        $validateData->after(function ($validator) use ($request){

            $time_slot_start_minutes = self::time_to_minutes($request->time_slot_start);
            $time_slot_end_minutes = self::time_to_minutes($request->time_slot_end);

            if ( $time_slot_start_minutes > $time_slot_end_minutes ) {

                $validator->errors()->add('time_slot_start', 'time_slot_start is greater than time_slot_end');
            }elseif ( $time_slot_end_minutes - $time_slot_start_minutes < 60 ) {

                $validator->errors()->add('Time slot', 'This time slot is lower than 1 hour');
            }elseif ( $time_slot_end_minutes - $time_slot_start_minutes >= 480 ) {

                $validator->errors()->add('Time slot', 'This time slot is greater than 8 hour');
            }
        });

        return $validateData;
    }

    private function time_to_minutes($time) {

        $time_array = explode(':',$time);
        $minutes = ($time_array[0]*60)+$time_array[1];

        return $minutes;
    }
}
