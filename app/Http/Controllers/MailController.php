<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\NotificarSubastaGanada;
use Illuminate\Support\Facades\Mail;
use App\User;

class MailController extends Controller
{
    public function sendMail ($destinatario) {

    	$mail = User::find($destinatario)->email;

    	Mail::to($mail)->send(new NotificarSubastaGanada()); 
    	return redirect()->route('home');

    }
}
