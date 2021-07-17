<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class SchoolSettingsController extends Controller
{
    public function index () 
    {
        DB::table('school_settings')->insert([
            'name'  =>  'name',
            'value' =>  '八王子市立横川小学校'
        ]);

        $settings = DB::table('school_settings')->get();
        return view('sample', ['name' => 'Hinako', 'settings' => $settings]);
    }
}
