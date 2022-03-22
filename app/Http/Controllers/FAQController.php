<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $questions = FAQ::all();
        return view('admin.faq.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq.create');
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
            'question' => 'required',
            'answer' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $input = $request->only('question', 'answer');
            FAQ::create($input);
            DB::commit();
            return redirect()->route('question.index')->with('success', 'FAQ Added Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('question.create')->with('failed', 'Something Went Wrong While Adding FAQ');
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
        $question = FAQ::whereId($id)->first();
        return view('admin.faq.edit',compact('question'));
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
            'question' => 'required',
            'answer' => 'required'
        ]);
        try {
            $question = FAQ::findOrFail($id);
            DB::beginTransaction();
            $input = $request->only('question', 'answer');
            $question->update($input);
            DB::commit();
            return redirect()->route('question.index')->with('success', 'FAQ Updated Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('question.create')->with('failed', 'Something Went Wrong While Updating FAQ');
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
        $id = request()->question_id;
        try {
            DB::beginTransaction();
            $question = FAQ::findOrFail($id);
            $question->delete();
            DB::commit();
            return redirect()->route('question.index')->with('success', 'FAQ Delete Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('question.index')->with('failed', 'Cannot Delete FAQ');
        }
    }
}
