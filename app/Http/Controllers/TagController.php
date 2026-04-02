<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function suggestion(Request $request){
        $data = $request->get('q');

        return Tag::where('name','like',"%{$data}%")->limit(10)->get()->map(fn($q)=>['value'=>$q->name]);
    }
}
