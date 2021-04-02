<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Category;
use File;

class ArticleController extends Controller
{
    public function create(){
        $categories = Category::all();
        return view('article.create', compact('categories'));
    }

    public function store(Request $request){
        $article = new Article;
        $article->title = $request->title;
        $article->slug = str_slug($request->title);
        $article->content = $request->content;
        $article->category_id = $request->category_id;
        if($request->hasfile('banner')){
            $file = $request->file('banner');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/banner/', $filename);
            $article->banner = $filename;
        }
        $article->save();
        return redirect('/home');
    }
}
