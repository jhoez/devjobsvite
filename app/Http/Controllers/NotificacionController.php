<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificacionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //$notificaciones = DB::table('notifications')->get();
        $notificaciones = auth()->user()->unreadNotifications;
        
        // limpiar notificaciones
        auth()->user()->unreadNotifications->markAsRead();
        
        return view('notificaciones.index',[
            'notificaciones' => $notificaciones
        ]);
    }
}
