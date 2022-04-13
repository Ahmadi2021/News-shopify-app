<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\News;

class frontNewsController extends Controller
{
    public function index(){
        $news = News::all();
        return response()->json(['data'=>$news]);
    }
    public function showNews(){
        $news = News::all();
        return response()->json(['data'=>$news]);
    }
}
