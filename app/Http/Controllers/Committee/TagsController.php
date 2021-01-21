<?php

namespace App\Http\Controllers\Committee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Http\Requests\CommitteeCreateTag;

class TagsController extends Controller
{
    /**
     * Displays the tags list
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $tags = Tag::withCount('tasks')->get();
        return view('committee.tags', ['tags' => $tags]);
    }

    /**
     * Deletes a tag
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Tag $tag)
    {
        $tag->tasks()->detach();
        $tag->delete();

        return redirect()->route('committee.tags.list')->with('success', 'Tag supprimé avec succès.');
    }

    /**
     * Creates a new tag
     * @param CommitteeCreateTag $request Request's content
     * @return \Illuminate\Http\Response
     */
    public function create(CommitteeCreateTag $request)
    {
        $tag = Tag::create($request->validated());
        return redirect()->route('committee.tags.list')->with('success', 'Tag créé');
    }
}
