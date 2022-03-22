<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SliderRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();

            if ($request->status) {
                $input['status'] = true;
            }
//            dd($request->hasFile('image'), $request->file('image')->isValid());

            if ($request->hasFile('image')) {
                $input['image'] = createOrUpdateImage($request);
            }
//            dd($input);
            Slider::create($input);
            DB::commit();
            return redirect()->route('slider.index')->with('success','Slider Added Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('slider.create')->with('failed','Slider Cannot Be Added Please Try Again');
        }

    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $slider = Slider::findOrFail($id);
        return redirect()->route('slider.create',compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit',compact('slider'));
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
        $slider = Slider::findOrFail($id);
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
                if (Storage::exists($slider->image)) {
                    Storage::delete($slider->image);
                }
            }
            $slider->update($input);
            DB::commit();
            return redirect()->route('slider.index')->with('success', 'Slider Updated Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('slider.index')->with('failed', 'Slider Cannot Be Updated');
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
            $blog = Slider::findOrFail($id);
            $blog->delete();
            Storage::delete($blog->image);
            DB::commit();
            return redirect()->route('slider.index')->with('success', 'Slider Deleted Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('slider.index')->with('failed', 'Slider Cannot Be Deleted');
        }
    }
}
