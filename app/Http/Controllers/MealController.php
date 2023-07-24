<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class MealController extends Controller
{
    public function index()
    {
        $meals = Meal::paginate(3);

        return view('meal.index', compact('meals'));
    }
    public function create()
    {
        $cats = Category::latest()->get();
        return view('meal.create_meal', compact('cats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:40',
            'description' => 'required|min:3|max:500',
            'price' => 'required|numeric',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        Image::make($image)->resize(300, 300)->save('upload/Meals/' . $name_gen);

        $save_url = 'upload/Meals/' . $name_gen;

        Meal::insert([
            'category' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $save_url,
        ]);

        $notification = array(
            'message_id' => 'تم اضافة الوجبة بنجاح ',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $meal = Meal::find($id);
        $cats = Category::all();
        return view('meal.edit_meal', compact('meal', 'cats'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:40',
            'description' => 'required|min:3|max:500',
            'price' => 'required|numeric',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);
        $oldImage = $request->old_image;

        if ($request->file('image')) {
            unlink($oldImage);

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            Image::make($image)->resize(300, 300)->save('upload/Meals/' . $name_gen);

            $save_url = 'upload/Meals/' . $name_gen;

            $id = $request->id;
            Meal::findOrFail($id)->update([
                'category' => $request->category,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $save_url,
            ]);


            return redirect()->route('meal.index')->with('message', 'تم تعديل الوجبة بنجاح ');
        } else {

            $id = $request->id;
            Meal::findOrFail($id)->update([
                'category' => $request->category,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,

            ]);
            return redirect()->route('meal.index')->with('message', 'تم تعديل الوجبة بنجاح ');
        }
    }

    public function delete($id)
    {

        $meal = Meal::find($id);

        unlink($meal->image);

        $meal->delete();

        return redirect()->route('meal.index')->with('message', 'تم الحذف بنجاح ');
    }

    public function show_details($id)
    {

        $meal = Meal::findOrFail($id);
        return view('meal.meal_details', compact('meal'));
    }
}
