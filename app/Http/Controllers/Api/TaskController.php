<?php

namespace App\Http\Controllers\Api;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
class TaskController extends Controller
{
		public function index()
		{
			 return TaskResource::collection(Task::all());
		}
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
				'title' => 'required',
				'done' => 'required',
				'description' => 'nullable|string'
			]);
			
			$task = Task::create([
				'title'=>$request->title,
				'description' => $request->description,
				'done' => $request->done,
				'user_id' => auth()->user()->id
			]);
	

			return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
      return new TaskResource($task);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
			$this->validate($request, [
				"title" =>'required',
				"description" =>"nullable",
				"done"=>"required"
			]);
        //Check is user is the owner of the recipe
        if($task->user_id != auth()->user()->id){
					abort(404);
					return;
				}
				//Update and return
				$task->update($request->only('title','description', 'done'));

				return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
			//Check is user is the owner of the recipe
			if($task->user_id != auth()->user()->id){
				abort(404);
				return;
			}
			$task->delete();
			
			return response()->json(null, 204);
    }
}
