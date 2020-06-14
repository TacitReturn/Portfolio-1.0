<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;
//use http\Env\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tag $tag)
    {
        return view('tags.index')->with('tags', Tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateTagRequest $request
     * @param Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {

        $tag = new Tag();
        $tag->name = $request->input('name');
        $tag->save();

        session()->flash('success', 'Tag Created');

        return redirect(route('tags.index'));
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
        $tag = tag::find($id);

        return view('tags.create')->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->name = $request->input('name');
        $tag->save();

        session()->flash('success', 'tag Updated.');

        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag, Request $request)
    {
        $tag->delete();

        session()->flash('success', "tag: $tag->name Deleted");

        return redirect(route('tags.index'));
    }
}
