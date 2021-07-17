<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LiveLessonsController extends Controller
{
    public function index ($lesson_id, $session_id) 
    {
        if ($this->isLesson($lesson_id))
        {
            return view('live_lessons', ['lesson_id' => $lesson_id, 'session_id' => $session_id]);
        } else {
            return false;
        }
    }

    private function isLesson ($lid) 
    {
        return true;
    }
}
