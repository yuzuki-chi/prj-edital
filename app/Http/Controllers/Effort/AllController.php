<?php

namespace App\Http\Controllers\Effort;

use App\Http\Controllers\Controller;
use App\Models\Effort;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllController extends Controller
{
    public function index() {
        // $effots = Effort::all();
        $student_count = Student::count();

        $effort_bin = [];
        for ($i=1; $i <= $student_count; $i++) { 
            $effort_bin[] = [
                'id' => $i,
                'name' => Student::where('id', $i)->first()->name,
                'png_binary' => $this->getPngBinary($i),
            ];
        }
        return view('effort.all', ['effort_bin' => $effort_bin]);
    }

    public function getPngBinary( $student_id ) {
        // return Effort::where('student_id', $student_id)
        // ->orderBy('updated_at', 'desc')
        // ->first()
        // ->png_binary;

        //軽量版 ※Modelから持ってくると, おそらく strokesサイズが大きすぎてメモリエラーが発生する

        //白紙っぽいバイナリ
        $sample_bin = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABVkAAALfCAYAAAB7KsIBAAAAAXNSR0IArs4c6QAAIABJREFUeF7t2KERAAAIxDDYf2l2oDb4NzlUdxwBAgQIECBAgAABAgQIECBAgAABAgQIvAX2vTQkQIAAAQIECBAgQIAAAQIECBAgQIAAgRFZPQEBAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECAyV9jWAAAgAElEQVRAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAoLgEmYAAAruSURBVAQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBICCyBjxTAgQIECBAgAABAgQIECBAgAABAgQIiKx+gAABAgQIECBAgAABAgQIECBAgAABAkFAZA14pgQIECBAgAABAgQIECBAgAABAgQIEBBZ/QABAgQIECBAgAABAgQIECBAgAABAgSCgMga8EwJECBAgAABAgQIECBAgAABAgQIECAgsvoBAgQIECBAgAABAgQIECBAgAABAgQIBAGRNeCZEiBAgAABAgQIECBAgAABAgQIECBAQGT1AwQIECBAgAABAgQIECBAgAABAgQIEAgCImvAMyVAgAABAgQIECBAgAABAgQIECBAgIDI6gcIECBAgAABAgQIECBAgAABAgQIECAQBETWgGdKgAABAgQIECBAgAABAgQIECBAgAABkdUPECBAgAABAgQIECBAgAABAgQIECBAIAiIrAHPlAABAgQIECBAgAABAgQIECBAgAABAiKrHyBAgAABAgQIECBAgAABAgQIECBAgEAQEFkDnikBAgQIECBAgAABAgQIECBAgAABAgREVj9AgAABAgQIECBAgAABAgQIECBAgACBIHBGLALgh+qAPAAAAABJRU5ErkJggg==";
        
        $isUserExist = DB::table('efforts')
        ->select(DB::raw('png_binary'))
        ->where('student_id', $student_id)
        ->exists();

        if ($isUserExist) {
            $bin = DB::table('efforts')
            ->select(DB::raw('png_binary'))
            ->where('student_id', $student_id)
            ->orderBy('updated_at', 'desc')
            ->get()[0]->png_binary;
        } else {
            $bin = null;
        }

        return empty($bin) ? $sample_bin : $bin;
    }
}