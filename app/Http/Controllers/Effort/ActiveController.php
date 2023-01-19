<?php

namespace App\Http\Controllers\Effort;

use App\Http\Controllers\Controller;
use App\Models\Effort;
use App\Models\Student;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActiveController extends Controller
{
    public function index() {
        $student_count = Student::count();

        $active_data = [];

        for ($i=1; $i <= $student_count; $i++) { 
            $active_data[] = [
                'id' => $i,
                'name' => Student::where('id', $i)->first()->name,
                'diff' => $this->getAirTimeByStudentId($i)
            ];
        }

        return view('effort.active', ['active_data' => $active_data]);
    }

    public function getAirTimeByStudentId($student_id)
    {
        //最後のstroke_end からの経過時間を返す
        // $stroke_end_time = Effort::where('student_id', $student_id)
        //             ->orderBy('updated_at', 'desc')
        //             ->first()
        //             ->updated_at;
        //軽量版 ※Modelから持ってくると, おそらく strokesサイズが大きすぎてメモリエラーが発生する
        $stroke_end_time = DB::table('efforts')
        ->select(DB::raw('updated_at'))
        ->where('student_id', $student_id)
        ->orderBy('updated_at', 'desc')
        ->get()[0]->updated_at;

        // return $stroke_end_time;
        $time_old = new DateTime($stroke_end_time, new DateTimeZone('Asia/Tokyo'));
        
        return strtotime(Date('Y-m-d H:i:s')) - $time_old->format('U') - 32400; //UNIX時間の引き算で経過時間を返す
        //32400秒は UTCとJSTの差なので、いずれ環境を合わせてあげてください
    }
}
