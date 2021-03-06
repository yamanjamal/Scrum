<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\BaseService;

class RegisterController extends Controller
{
    /**
     * [register description]
     * @param  RegisterRequest $request     [description]
     * @param  BaseService     $baseservice [description]
     * @return [type]                       [description]
     */
    public function register(RegisterRequest $request,BaseService $baseservice)
    {
        $input=$request->validated();
        $input['password']=Hash::make($input['password']);

        $user=User::create($input);

        // $user->assignRole($request->role);

        $token['token']=$user->createtoken('task,project')->plainTextToken;
        $response=[
            'user'=>$user,
        ];
        return $baseservice->sendResponse($response,'user regsterd successfully');
    }

    /**
     * 
     * @param  LoginRequest $request     [description]
     * @param  BaseService  $baseservice [description]
     * @return [type]                    [description]
     */
    public function login(LoginRequest $request,BaseService $baseservice){
       
        $user=User::where('email',$request->email )->first();
        if (!$user) {
            return $baseservice->sendError('thier is no such email');
        }

        if (!Hash::check($request->password ,$user->password)) {
            return $baseservice->sendError('Incorrect password');
        }

        $token['token']=$user->createtoken('office,project')->plainTextToken;

        $response=[
            'user'=>$user,
            'token'=>$token,
        ];
           // Auth::login($user);
        return $baseservice->sendResponse($response,'you logged in congrats');
    }
    /**
     * [logout description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function logout(Request $request){
       
        auth()->user()->tokens()->delete();
        return ['message'=>'logged out'];
    }
}
