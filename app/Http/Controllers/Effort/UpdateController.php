<?php

namespace App\Http\Controllers\Effort;

use App\Http\Controllers\Controller;
use App\Models\Effort;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function update(Request $request) 
    {
        $req = json_decode($request->getContent(), true);
        
        // 1度でもポストしたユーザかどうか
        if( Effort::where('student_id', $req['student_id'])->where('page_num', $req['page_num'])->exists() ) {
            $stroke_b = json_decode(Effort::where('student_id', $req['student_id'])->where('page_num', $req['page_num'])->get()[0]->strokes, true);
            $strokes = array_merge( $stroke_b , $req['strokes'] );
            
            Effort::where('student_id', $req['student_id'])
            ->where('page_num', $req['page_num'])
            ->update([
                'strokes' => json_encode($strokes, false),
                'png_binary' => $req['binary'],
                // 'updated_at' => Date('Y-m-d H:i:s'),
            ]);
            return json_encode(['message'=>'updated!'], false);
        } else {
            $log = new Effort();
            $log->student_id = $req['student_id'];
            $log->page_num = $req['page_num'];
            $log->strokes = json_encode($req['strokes'], false);
            $log->png_binary = $req['binary'];
            $log->save();
            return json_encode(['message'=>'make new entry!'], false);
        }    
    }
}
