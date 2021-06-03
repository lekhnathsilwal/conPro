<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class SearchController extends Controller
{

    public function index()
    {
        return view('user::index');
    }


    public function show($id)
    {
        return view('user::show');
    }

}
