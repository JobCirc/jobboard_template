<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class PagesController extends Controller
{
    public function login() {
        return view('login');
    }

    public function contact() {
        return view('contact');
    }

    public function pipeline($pipe) {
        $pipelines = [
            'hispanic-american' => 'Hispanic American Pipeline',
            'asian-american' => 'Asian American Pipeline',
            'african-american' => 'African American Pipeline',
            'native-american' => 'Native American Pipeline',
            'veterans' => 'War Veterans Pipeline',
            'lgbt' => 'LGBT Pipeline',
            'disabled' => 'Disabled Pipeline',
        ];
        $name = $pipelines[$pipe];
        $i = ['pipeline' => $pipe];
        $jobs = Job::orderBy('updated_at', 'desc')->simplePaginate(15);

        return view('pipeline', compact('jobs', 'pipelines', 'name', 'i'));
    }

    public function sendContact() {
        $message = Input::all();

        $sent = \Mail::send('email', ['contact' => $message], function ($m) {
            $m->from('support@jobcirc.com', 'JobCirc');

            $m->to('sebasalines@gmail.com', 'Max Cadenasso')->subject('New Contact - Diverse Americans');
        });
        $sent = true;

        return view('contact', compact('sent'));
    }
}
