<?php

namespace App\Http\Controllers;

use App\Models\BuyNow;
use App\Models\Category;
use App\Models\Contact;
use App\Models\FAQ;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::take(3)->get();
        return view('home.welcome', compact('products'));
    }

    public function viewSlug($category, $subcategory)
    {
        $subcategory = SubCategory::where('slug', $subcategory)->with('category', 'product')->first();
        $relatedProducts = Category::where('category_name',$category)->get();
        return view('home.details', compact('subcategory','relatedProducts'));
    }

    public function question()
    {
        $questions = FAQ::all();
        return view('home.question', compact('questions'));
    }

    public function buyNow($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('home.buyNow', compact('product'));
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'number' => 'required|min:10|max:10',
            'subject' => 'required',
            'message' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $input = $request->all();
            Contact::create($input);
            DB::commit();
            return back()->with('success', 'Thanks For Your Message');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('failed', 'Cannot Send FeedBack');
        }

    }

    public function purchase(Request $request)
    {
        $this->validate($request, [
            'link' => 'required',
            'current_data' => 'required',
            'contact_email' => 'required',
        ]);
        try {
            if (Auth::user()) {
                DB::beginTransaction();
                $input = $request->all();
                $product = Product::where('slug', $request->slug)->first();
                $input['product_name'] = $product->title;
                BuyNow::create($input);
                DB::commit();
                return back()->with('success', 'Thanks For Your Order');
            } else {
                return redirect()->route('login');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('failed', 'Cannot Make Order. Something Went Wrong');
        }
    }

}
