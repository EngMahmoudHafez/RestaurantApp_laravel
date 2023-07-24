<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index(Request $request)
    {

        $cats = Category::all();
        if (!$request->category) {
            $currentCat = "الصفحة الرئيسية";

            $meals = Meal::latest()->get();
            return view('visitorpage', compact('cats', 'meals', 'currentCat'));
        } else {
            $currentCat = $request->category;

            $meals = Meal::where('category', $request->category)->get();
            return view('visitorpage', compact('cats', 'meals', 'currentCat'));
        }
    }
}
