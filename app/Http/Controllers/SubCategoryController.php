<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $subCategories = SubCategory::orderBy('category_id')->get();
        return view('admin.subCategory.index',compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.subCategory.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'sub_category_name' => 'required',
            'sub_category_description'=>'required',
            'category_id'=>'required',
            'rate_per_thousand'=>'required',
            'min_order'=>'required',
            'max_order'=>'required'
        ]);
        try {
            DB::beginTransaction();
            $input = $request->all();
            $input['slug'] = str_slug($input['sub_category_name']);
            SubCategory::create($input);
            DB::commit();
            return redirect()->route('subcategory.index')->with('success', 'Sub Category Added Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('subcategory.index')->with('failed', 'Sub Category Cannot Be Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*$subCategory = SubCategory::whereId($id)->with('category')->first();
        return response($subCategory);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subCategory = SubCategory::whereId($id)->with('category')->first();
        $categories = Category::all();
        return view('admin.subCategory.edit',compact('subCategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $this->validate($request, [
            'sub_category_name' => 'required',
            'sub_category_description'=>'required',
            'category_id'=>'required'
        ]);
        try {
            DB::beginTransaction();
            $input = $request->all();
            $subcategory->update($input);
            DB::commit();
            return redirect()->route('subcategory.index')->with('success', 'SubCategory Updated Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('subcategory.index')->with('failed', 'SubCategory Cannot Be Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $id = request()->subCategory_id;
        try {
            DB::beginTransaction();
            $subcategory = SubCategory::findOrFail($id);
            $subcategory->delete();
            DB::commit();
            return redirect()->route('subcategory.index')->with('success', 'SubCategory Delete Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('subcategory.index')->with('failed', 'Cannot Delete SubCategory');
        }
    }
}
