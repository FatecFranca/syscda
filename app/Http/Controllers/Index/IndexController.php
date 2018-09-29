<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Reference;

class IndexController extends Controller
{
    public function index()
    {
        $this->middleware('auth');

        if (Auth::check()) {

            return view('index.index');

        } else {
            $returns = [
                'css' => 'login'
            ];
            return view('auth.login', $returns);
        }
    }
}
