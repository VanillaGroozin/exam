<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Recipe;
use App\Ingredient;
use App\RecipeIngredient;


class RecipiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::orderBy('name', 'asc')->paginate(5);
        return view("recipies.index")-> with('recipes', $recipes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("recipies.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'recipeName' => 'required',
            'timeToCook' => 'required',
            'category' => 'required',
            'serves' => 'required',
            'ingridients' => 'required'
        ]);

        $recipe = new Recipe;
        $recipe->name = $request->input('recipeName');       
        $ingredientsArray = explode("\r\n", $request->ingridients);

        $id = $this->prepareRecipe($recipe, $request, $ingredientsArray);
        return $id;
    }

    private function prepareRecipe(Recipe $recipe,  $data, array $ingredientsArray) {
        $recipe->name = $data["recipeName"];
        $recipe->user_id = Auth::id();
        $recipe->timeToMake = $data["timeToCook"];
        $recipe->serves = $data["serves"];

        $categoryId = DB::table('categories')->where('name', $data["category"])->value('id');
        $recipe->category_id = $categoryId;
        $recipe->raiting = 0;  
        $recipe->save();

        $recipeId = Recipe::orderBy('id', 'DESC')->first()['id'];

        $this->checkIngredients($ingredientsArray, $recipeId);    
    }

    

    private function checkIngredients(array $ingridients, int $recipeId) {
        foreach($ingridients as $ingredient) {
            
            $ingredientId = DB::table('ingredients')->where('name', $ingredient)->value('id');
            
            if (!isset($ingredientId)){
                $newIngredient = new Ingredient();            
                $newIngredient->name = $ingredient;
                $newIngredient->save();
                $ingredientId = Ingredient::orderBy('id', 'DESC')->first()['id'];   
                $this->createRecipeIngredientPair($recipeId, $ingredientId); 
                return;    
            }
            $this->createRecipeIngredientPair($recipeId, $ingredientId); 
        }
    }

    private function createRecipeIngredientPair(int $recipeId, int $ingredientId) {
        $newRecipeIngredient = new RecipeIngredient();
        $newRecipeIngredient->recipe_id = $recipeId;
        $newRecipeIngredient->ingredient_id = $ingredientId;
        $newRecipeIngredient->save();
    }
 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = Recipe::find($id);
        return view("recipies.show")-> with('recipes', $recipe);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = Recipe::find($id);
        return view("recipies.edit")-> with('recipes', $recipe);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'recipeName' => 'required',
            'timeToCook' => 'required',
            'category' => 'required',
            'serves' => 'required',
        ]);

        $recipe = Recipe::find($id);     
        $recipe->name = $request["recipeName"];
        $recipe->timeToMake = $data["timeToCook"];
        $recipe->serves = $data["serves"];
        $recipe->save();

        return view("recipies.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('recipes')->where('id', $id)->delete();
        DB::table('recipe_ingredients')->where('ingredient_id', $id)->delete();
        return redirect('Recipe/my');
    }

    public function my()
    {
        
        $recipes = Recipe::orderBy('name', 'asc')->where('user_id', Auth::id())->paginate(5);
        
        return view("recipies.myRecipies")-> with('recipes', $recipes);
    }
}
