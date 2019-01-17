<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    /**
     * @param Request $request
     * @return string
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request){
        //Validate
        $this->validate($request,['title' => 'required','procedure' => 'required|min:8']);

        //Create recipe and attach to user
        $user = Auth::user();
        $recipe = Recipe::create($request->only(['title','procedure']));
        $user->recipes()->save($recipe);

        //Return json of recipe
        return $recipe->toJson();
    }

    /**
     * Get all recipes
     * @return mixed
     */
    public function all(){
        return Auth::user()->recipes;
    }

    public function update(Request $request, Recipe $recipe){
        //Check is user is the owner of the recipe
        if($recipe->publisher_id != Auth::id()){
            abort(404);
            return;
        }
        //Update and return
        $recipe->update($request->only('title','procedure'));
        return $recipe->toJson();
    }

    public function show(Recipe $recipe){
        if($recipe->publisher_id != Auth::id()){
            abort(404);
            return;
        }
        return $recipe->toJson();
    }

    public function delete(Recipe $recipe){
        if($recipe->publisher_id != Auth::id()){
            abort(404);
            return;
        }
        $recipe->delete();
    }
}
