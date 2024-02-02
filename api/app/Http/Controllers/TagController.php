<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate(['name_tag'=>'required|string']);
        return response(['success'=>true, 'tag'=>$request->input('name_tag')]);
    }

    public function index()
    {
        $tags = Tag::all();
        return response(['success'=>true, 'tags'=>$tags]);
    }
}
