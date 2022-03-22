<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
        return view("admin.blog.index", compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BlogRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            if ($request->status) {
                $input['status'] = true;
            }
            if ($request->hasFile('image')) {
                $input['image'] = createOrUpdateImage($request);
            }
            Blog::create($input);
            DB::commit();
            return redirect()->route('blog.index')->with('success', 'Blog Created Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('blog.index')->with('failed', 'Blog Cannot Be Created');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BlogRequest $request, $id)
    {
        $blog = Blog::findOrFail($id);
        try {
            DB::beginTransaction();
            $input = $request->all();
            if ($request->status) {
                $input['status'] = true;
            }
            if ($request->hasFile('image')) {
                $input['image'] = createOrUpdateImage($request);
            }
            if ($request->file('image')) {
                if (Storage::exists($blog->image)) {
                    Storage::delete($blog->image);
                }
            }
            $blog->update($input);
            DB::commit();
            return redirect()->route('blog.index')->with('success', 'Blog Updated Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('blog.index')->with('failed', 'Blog Cannot Be Updated');
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
        try {
            DB::beginTransaction();
            $blog = Blog::findOrFail($id);
            $blog->delete();
            Storage::delete($blog->image);
            DB::commit();
            return redirect()->route('blog.index')->with('failed', 'Blog Deleted Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('blog.index')->with('failed', 'Blog Cannot Be Deleted');
        }
    }
}
