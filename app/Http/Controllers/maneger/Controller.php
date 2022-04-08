<?php

namespace App\Http\Controllers\maneger;

use App\Http\Controllers\ApiController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends ApiController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
