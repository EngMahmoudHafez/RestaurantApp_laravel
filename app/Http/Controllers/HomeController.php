<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (auth()->user()->is_admin == 1) {
            $orders = Order::orderBy('id', 'DESC')->get();
            return view('Adminpage', compact('orders'));
        } else {
            $cats = Category::all();
            if (!$request->category) {
                $currentCat = "الصفحة الرئيسية";

                $meals = Meal::latest()->get();
                return view('Userpage', compact('cats', 'meals', 'currentCat'));
            } else {
                $currentCat = $request->category;

                $meals = Meal::where('category', $request->category)->get();
                return view('Userpage', compact('cats', 'meals', 'currentCat'));
            }
        }
    }

    public function order_store(Request $request)
    {
        Order::insert([

            'user_id' => Auth()->user()->id,
            'phone' => $request->phone,
            'date' => $request->date,
            'time' => $request->time,
            'meal_id' => $request->meal_id,
            'qty' => $request->qty,
            'address' => $request->address,
            'status' => "تتم مراجعة الطلب"

        ]);

        $notification = array(
            'message_id' => 'تم اضافة الطلب بنجاح ',
            'alert-type' => 'success'
        );
        return redirect()->route('home')->with($notification);
    }

    public function show_order()
    {
        $order = Order::where('user_id', auth()->user()->id)->get();

        return view('order.show_order', compact('order'));
    }

    public function order_status(Request $request, $id)
    {
        $order = Order::find($id);
        Order::where('id', $id)->update(['status' => $request->status]);
        return back();
    }
}
