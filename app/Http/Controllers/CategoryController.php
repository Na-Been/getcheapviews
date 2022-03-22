<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $input = $request->all();
            $input['slug'] = str_slug($input['category_name']);
            Category::create($input);
            DB::commit();
            return redirect()->route('category.index')->with('success', 'Category Added Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('category.index')->with('failed', 'Category Cannot Be Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return response($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = $request->category_id;
        $category = Category::findOrFail($id);
        $this->validate($request, [
            'category_name' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $input = $request->all();
            $category->update($input);
            DB::commit();
            return redirect()->route('category.index')->with('success', 'Category Updated Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('category.index')->with('failed', 'Category Cannot Be Updated');
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
        $id = request()->category_id;
        try {
            DB::beginTransaction();
            $category = Category::findOrFail($id);
            $category->delete();
            DB::commit();
            return redirect()->route('category.index')->with('success', 'Category Delete Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('category.index')->with('failed', 'Cannot Delete Category');
        }
    }
}
