<?php

namespace App\Http\Controllers;

use App\Events\IotEvent;
use Illuminate\Http\Request;

class HandleIot extends Controller
{
    public function receive(Request $request){
        $kode = $request->kode;
        $channel = "test-channel";
        broadcast(new IotEvent($kode, $channel));
    }
}
