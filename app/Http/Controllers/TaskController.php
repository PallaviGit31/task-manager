<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    use AuthorizesRequests;
    
    public function index(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            $tasks = DB::table('tasks')->select('*' )->join('countries', 'users.country_id', '=', 'countries.id')->join('states', 'users.state_id', '=', 'states.id')->join('cities', 'users.city_id', '=', 'cities.id')->get();
        $data = compact('users');
            return view('tasks.index', compact('tasks'));
        }else{
            dd();
        }
       
    }

    public function store(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $request->validate(['title' => 'required|string']);
        $project->tasks()->create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return back();
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $this->authorize('update', $project);
        //echo $task->status; die();
        $task->update([
            'status' => !$task->status,
        ]);

        return back();
    }

    public function destroy(Project $project, Task $task)
    {
        $this->authorize('update', $project);

        $task->delete();
        return back();
    }


}