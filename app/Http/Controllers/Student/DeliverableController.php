<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Deliverable;
use Illuminate\Http\Request;
use App\Http\Requests\StudentCreateDeliverable;
use App\Http\Requests\StudentAddUserToDeliverable;
use App\Http\Requests\StudentRemoveUserFromDeliverable;
use Auth;

class DeliverableController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentCreateDeliverable $request)
    {
        $deliverable = new Deliverable;
        $deliverable->task_id = $request->task;
        $deliverable->url = $request->link;
        $deliverable->comments = $request->comments;
        $deliverable->save();
        $deliverable->users()->attach(Auth::user(), ['level'=>'CREATOR']);
        return redirect()->back()->with('success', 'Livrable créée avec succès. Vous pouvez ajouter d\'autres membres à ce livrable si vous le desirez');
    }

    /**
     * Attaches a new user to the deliverable
     *
     * @param  \Illuminate\Http\Requests\StudentAddUserToDeliverable  $request
     * @return \Illuminate\Http\Response
     */
    public function addUserToDeliverable(StudentAddUserToDeliverable $request)
    {
        if ($request->deliverable->users->contains($request->user)) {
            return redirect()->back()->with('success', 'L\'utilisateur à déja été associé à ce livrable');
        } else {
            $request->deliverable->users()->attach($request->user, ['level' => 'MEMBER']);
            return redirect()->back()->with('success', 'Utilisateur ajouté au livrable');
        }
    }

    /**
     * Detache an user from the deliverable
     *
     * @param  \Illuminate\Http\Requests\StudentRemoveUserFromDeliverable  $request
     * @return \Illuminate\Http\Response
     */
    public function removeUserFromDeliverable(StudentRemoveUserFromDeliverable $request)
    {
        $request->deliverable->users()->detach($request->user);
        return redirect()->back()->with('success', 'Utilisateur supprimé du livrable');
    }

    /**
     * Deletes an instance
     */
    public function destroy(Deliverable $deliverable)
    {
        $this->authorize('delete', $deliverable);
    }
}
