<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {
        //生徒の登録、削除を行うページ（そのままノートに行けば、ユーザIDを引き継げる）
        return view('student');
    }

    public function create(Request $request) {
        $student = new Student();
        $student->name = $request['name'];
        $student->save();

        $student_id = Student::latest()->first()->id;
        $note_url = "/draw?sid=" . $student_id;
        return redirect("https://takaya.hattori-lab.cs.teu.ac.jp".$note_url);
        return Student::latest()->first()->id;
    }
}
