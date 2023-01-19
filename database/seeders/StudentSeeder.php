<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student1 = new Student;
        $student1->name = '高谷 悠太郎';
        $student1->save();

        // $student2 = new Student;
        // $student2->name = 'サンプル二郎';
        // $student2->save();

        // $student3 = new Student;
        // $student3->name = 'サンプル花子';
        // $student3->save();
    }
}
