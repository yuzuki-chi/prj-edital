<?php

namespace Database\Seeders;

use App\Models\Effort;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EffortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for ($i=0; $i < 500; $i++) { 
        //     $effort = new Effort;
        //     $effort->student_id = 1;
        //     $effort->page_num = 1;
        //     $strokes = [];
        //     for ($s=0; $s < 50; $s++) { 
        //         $strokes[] = [
        //             "x" => 384,
        //             "y" => 340,
        //             "time" => "2022-11-25 17:14:23",
        //             "penSize" => 1,
        //             "penColor" => "#000000",
        //             "penShape" => "round",
        //         ];
        //     }
        //     $effort->strokes = json_encode($strokes);
        //     $effort->save();
        // }
        // print('500 record created.');

        $effort = new Effort;
        $effort->student_id = 1;
        $effort->page_num = 1;
        $effort->png_binary='';
        $strokes = [];
        for ($s=0; $s < 50; $s++) { 
            $strokes[] = [
                "x" => 1,
                "y" => 1,
                "time" => "2022-11-25 17:14:23",
                "penSize" => 1,
                "penColor" => "#000000",
                "penShape" => "round",
            ];
        }
        $effort->strokes = json_encode($strokes);
        $effort->save();

        // $effort = new Effort;
        // $effort->student_id = 2;
        // $effort->page_num = 1;
        // $effort->png_binary='';
        // $strokes = [];
        // for ($s=0; $s < 50; $s++) { 
        //     $strokes[] = [
        //         "x" => 1,
        //         "y" => 1,
        //         "time" => "2022-11-25 17:14:23",
        //         "penSize" => 1,
        //         "penColor" => "#000000",
        //         "penShape" => "round",
        //     ];
        // }
        // $effort->strokes = json_encode($strokes);
        // $effort->save();

        // $effort = new Effort;
        // $effort->student_id = 3;
        // $effort->page_num = 1;
        // $effort->png_binary='';
        // $strokes = [];
        // for ($s=0; $s < 50; $s++) { 
        //     $strokes[] = [
        //         "x" => 1,
        //         "y" => 1,
        //         "time" => "2022-11-25 17:14:23",
        //         "penSize" => 1,
        //         "penColor" => "#000000",
        //         "penShape" => "round",
        //     ];
        // }
        // $effort->strokes = json_encode($strokes);
        // $effort->save();
    }
}
