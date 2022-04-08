<?php

namespace App\Http\Controllers\maneger;

use App\Http\Resources\UserResource;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 's';
        // abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // return 's';
        // $users = User::role('Super Admin')->get();
       return $users = User::with('roles','permissions')->where('id',1)->get();

        // return $users->getDirectPermissions();
        // $users =User::all();

        // return $this->sentsussesfully(UserResource::collection($users));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function count()
    {
       return User::count();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->deleted(new UserResource($user));
    }
}
