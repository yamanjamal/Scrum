<?php

namespace App\Http\Controllers\maneger;

use App\Http\Requests\AssignProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class ProjectController extends Controller
{
    public $paginate=10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // abort_if(Gate::denies('project_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $projects =Project::with('TeamLeader')->paginate($this->paginate);
        return $this->sentsussesfully(ProjectResource::collection($projects)->response()->getData(true));    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $project =Project::create($request->validated());
        return $this->createdsussesfully(new ProjectResource($project));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        abort_if(Gate::denies('project_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $this->sentsussesfully(new ProjectResource($project->LoadMissing('TeamLeader','Requirments','SRSs')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->validated());
        return $this->updated(new ProjectResource($project));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // abort_if(Gate::denies('project_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $project->delete();
        return $this->deleted(new ProjectResource($project));
    }

    /**
     * [assign description]
     * @param  AssignProjectRequest $request [description]
     * @param  Project              $project [description]
     * @return [type]                        [description]
     */
    public function assign(AssignProjectRequest $request, Project $project)
    {
        $project->update($request->validated());
        return $this->updated(new ProjectResource($project));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $title
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        abort_if(Gate::denies('project_search'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $projects= Project::
        where('title','like',"%{$request->keyword}%")
        // ->get();
        ->paginate($this->paginate);
        
        if (count($projects)>0) {
            // return $this->sentsussesfully(ProjectResource::collection($projects));
            return $this->sentsussesfully(ProjectResource::collection($projects)->response()->getData(true));
        }
        return $this->sentunsussesfully();
    }
}
