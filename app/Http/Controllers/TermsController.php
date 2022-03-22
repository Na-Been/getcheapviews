<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $terms = Term::all();
        return view('admin.terms.index',compact('terms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.terms.create');
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
            'condition_title' => 'required',
            'condition_description' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $input = $request->only('condition_title', 'condition_description');
            Term::create($input);
            DB::commit();
            return redirect()->route('condition.index')->with('success', 'Terms & Conditions Added Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('condition.create')->with('failed', 'Something Went Wrong While Adding Terms & Conditions');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $term = Term::whereId($id)->first();
        return view('admin.terms.edit',compact('term'));

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
        $this->validate($request, [
            'condition_title' => 'required',
            'condition_description' => 'required'
        ]);
        try {
            $term = Term::findOrFail($id);
            DB::beginTransaction();
            $input = $request->only('condition_title', 'condition_description');
            $term->update($input);
            DB::commit();
            return redirect()->route('condition.index')->with('success', 'Terms & Conditions Updated Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('condition.create')->with('failed', 'Something Went Wrong While Updated Terms & Conditions');
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
        $id = request()->term_id;
        try {
            DB::beginTransaction();
            $question = Term::findOrFail($id);
            $question->delete();
            DB::commit();
            return redirect()->route('condition.index')->with('success', 'Terms & Conditions Delete Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('condition.index')->with('failed', 'Cannot Delete Terms & Conditions');
        }
    }
}
