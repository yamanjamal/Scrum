<?php

namespace App\Http\Controllers\maneger;

use App\Http\Requests\AssignTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Requirment;
use App\Models\Task;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Requirment $requirment )
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tasks =Task::with('Comments')->get();
        return $this->sentsussesfully(TaskResource::collection($tasks));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $task =Task::create($request->validated());
        return $this->createdsussesfully(new TaskResource($task));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        abort_if(Gate::denies('task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $this->sentsussesfully(new TaskResource($task->LoadMissing('Comments.User','Developer')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return $this->updated(new TaskResource($task));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        abort_if(Gate::denies('task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $task->delete();
        return $this->deleted(new TaskResource($task));
    }

    /**
     * [assign description]
     * @param  AssignProjectRequest $request [description]
     * @param  Project              $project [description]
     * @return [type]                        [description]
     */
    public function assign(AssignTaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return $this->updated(new TaskResource($task));
    }
}
