<?php

namespace App\Http\Controllers\Effort;

use App\Http\Controllers\Controller;
use App\Models\Effort;
use App\Models\Student;
use Illuminate\Http\Request;

class AccentController extends Controller
{
    public function index() {
        $accsents = $this->getAccentLevel();
        return view('effort.accent', ['accsents' => $accsents]);
    }

    public function getAccentLevel() {
        //studentの数を取得する
        $student_cnt = Student::count();

        //studentひとりひとりの筆記数を取得する {id,cnt}の対で
        $count_by_studentid = [];
        $cnt_sum = 0;

        for( $sid=1; $sid<=$student_cnt; $sid++ ) {
            $pages = Effort::where('student_id', $sid)->get();
            $count = 0;
            foreach($pages as $page) {
                $strokes = json_decode($page->strokes, true);
                $count = $count + count($strokes);
            }
        
            $count_by_studentid[] = ['id'=>$sid, 'count'=>$count];
            $cnt_sum = $cnt_sum + $count;
        }

        if ($cnt_sum == 0) {
            $cnt_ave = 0;
        } else {
            //全部の筆記数の平均を出す
            $cnt_ave = $cnt_sum/$student_cnt;
        }

        $ret_student = [];
        $_cnt = 1;
        foreach ( $count_by_studentid as $counts ) {
            //平均以下、以上で色分けをする
            if($counts['count'] < $cnt_ave) {
                $ret_student[] = [
                    'id'    => $_cnt, 
                    'name'  => Student::where('id', $_cnt)->first()->name,
                    'level' => 0,
                ];
            } else {
                $ret_student[] = [
                    'id'=>$_cnt, 
                    'name'  => Student::where('id', $_cnt)->first()->name,
                    'level'=>1,
                ];
            }
            $_cnt++;
        }

        return $ret_student;
        
    }
}
