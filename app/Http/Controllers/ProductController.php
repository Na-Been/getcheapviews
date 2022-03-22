<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feature;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $subCategories = [];
        return view('admin.product.create', compact('categories', 'subCategories'));
    }

    public function subCategory($id)
    {
        $subCategories = SubCategory::where('category_id', $id)->get();
        return response($subCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'feature_title' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $input = $request->except('feature_title');
            $input['slug'] = str_slug($input['title']);
            $product = Product::create($input);
            $features = $request->feature_title;
            foreach ($features as $feature) {
                Feature::create([
                    'product_id' => $product->id,
                    'feature_title' => $feature
                ]);
            }
            DB::commit();
            return redirect()->route('product.index')->with('success','Product Added Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('product.create')->with('failed', 'Product Cannot Be Added Something Went Wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('admin.product.edit',compact('product','categories','subCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'feature_title' => 'required'
        ]);
        $product = Product::findOrFail($id);
        try {
            DB::beginTransaction();
            $input = $request->except('feature_title');
            $product->update($input);
            $storeFeature = Feature::where('product_id',$product->id);
            $storeFeature->delete();
            $features = $request->feature_title;
            foreach ($features as $feature) {
                Feature::create([
                    'product_id' => $product->id,
                    'feature_title' => $feature
                ]);
            }
            DB::commit();
            return redirect()->route('product.index')->with('success','Product Updated Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('product.create')->with('failed', 'Product Cannot Be Updated Something Went Wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $id = request()->product_id;
        try{
            DB::beginTransaction();
            $product = Product::findOrFail($id);
            $product->delete();
            DB::commit();
            return redirect()->route('product.index')->with('success','Product Deleted Successfully');
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('product.index')->with('failed','Product Cannot Be Deleted');
        }
    }
}
