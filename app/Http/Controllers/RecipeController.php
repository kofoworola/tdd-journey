<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function create(Request $request){
        $this->validate($request,['title' => 'required','procedure' => 'required|min:100']);
    }
}
