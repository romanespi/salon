<?php

use App\Models\Event;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::apiResource('/event',Event::class);

Route::get('/event', function () {
    $events = Event::where('status',1)->where('etapa',1)->get();
    return $events;
});

/*Route::post('/payment/{$num},{$id}',function($num,$id){
    $events = Event::where('id',$id)->first();
    if($events->status == 1)
    {
        $abono = new Payment();
        $abono->cantidad = $num;
        $abono->event_id = $id;
        $abono->save();
        return "{'Mensaje':'Abono guardado'}";
    }else{
        return "{'Mensaje':'evento no esta confirmado'}";
    } 
});*/


