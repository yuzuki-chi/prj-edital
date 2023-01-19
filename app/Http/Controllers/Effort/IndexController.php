<?php

namespace App\Http\Controllers\Effort;

use App\Http\Controllers\Controller;
use App\Models\Effort;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function getByStudentIdAndPageNum($student_id, $page_num)
    {

        return Effort::where('student_id', $student_id)
                        ->where('page_num', $page_num)
                        ->get();
    }
}
