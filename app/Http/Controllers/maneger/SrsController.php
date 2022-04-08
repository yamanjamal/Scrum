<?php

namespace App\Http\Controllers\maneger;

use App\Http\Requests\StoreSrsRequest;
use App\Http\Requests\UpdateSrsRequest;
use App\Http\Resources\SrsResource;
use App\Models\Srs;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class SrsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $srss =Srs::all();
        return $this->sentsussesfully(SrsResource::collection($srss));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSrsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSrsRequest $request)
    {
        // +++++++++++++++++++file++++++++++++++++++++
        $file          = $request->file('link');
        $filefirstname = substr($file->getClientOriginalName(),0,-5);
        $extension     = $file->getClientOriginalExtension();
        $filename      = $filefirstname.time().'.'.$extension;

        $file->move('uploads/srss/',$filename);

        $srs = Srs::create([
            'link' =>$filename,
            'project_id'=>$request->project_id
        ]);
        // +++++++++++++++++++file++++++++++++++++++++
            
        return $this->createdsussesfully(new SrsResource($srs));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Srs  $srs
     * @return \Illuminate\Http\Response
     */
    public function show(Srs $srs)
    {
        return $this->sentsussesfully(new SrsResource($srs));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Srs  $srs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Srs $srs)
    {
        abort_if(Gate::denies('srs_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try{
            unlink(public_path('uploads/srss/'.$srs->link));
        }catch(\Exception $e){}

        $srs->delete();
        return $this->deleted(new SrsResource($srs));
    }
}
