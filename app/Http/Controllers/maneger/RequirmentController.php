<?php

namespace App\Http\Controllers\maneger;

use App\Http\Requests\StoreRequirmentRequest;
use App\Http\Requests\UpdateRequirmentRequest;
use App\Http\Resources\RequirmentResource;
use App\Models\Requirment;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class RequirmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('requirment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $requirments =Requirment::with('Tasks')->get();
        return $this->sentsussesfully(RequirmentResource::collection($requirments));    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRequirmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequirmentRequest $request)
    {
        $requirment =Requirment::create($request->validated());
        return $this->createdsussesfully(new RequirmentResource($requirment));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Requirment  $requirment
     * @return \Illuminate\Http\Response
     */
    public function show(Requirment $requirment)
    {
        abort_if(Gate::denies('requirment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $this->sentsussesfully(new RequirmentResource($requirment->LoadMissing('Tasks.Developer')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequirmentRequest  $request
     * @param  \App\Models\Requirment  $requirment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequirmentRequest $request, Requirment $requirment)
    {
        $requirment->update($request->validated());
        return $this->updated(new RequirmentResource($requirment));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Requirment  $requirment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requirment $requirment)
    {
        abort_if(Gate::denies('requirment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $requirment->delete();
        return $this->deleted(new RequirmentResource($requirment));
    }
}
