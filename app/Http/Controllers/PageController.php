<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Category;

class PageController extends Controller
{
    public function index()
    {
        $questions  = Question::with('category','user')->latest()->paginate(10);
        $categories = Category::orderBy('name')->get();

        return view('Pages.home', compact('questions','categories'));
    }
}
