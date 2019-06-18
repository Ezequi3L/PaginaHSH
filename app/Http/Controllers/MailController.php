<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\NotificarSubastaGanada;
use App\Mail\NotificarSubastaEliminada;
use Illuminate\Support\Facades\Mail;
use App\User;

class MailController extends Controller
{
    public function sendMail ($destinatario) {

    	$mail = User::find($destinatario)->email;

    	Mail::to($mail)->send(new NotificarSubastaGanada()); 
    	return redirect()->route('home');

    }

    public function subElim ($destinatarios) {

    	$destinatarios = unserialize($destinatarios);
    	$primero = array_shift($destinatarios);
    	$mail = User::find($primero)->email;
    	$destinatarios = serialize($destinatarios);

    	Mail::to($mail)->send(new NotificarSubastaEliminada($destinatarios)); 
    	return redirect()->route('home');

    }

}
