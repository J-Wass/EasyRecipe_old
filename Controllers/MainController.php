<?php
include_once("Models/RecipeModel.php");
class MainController{

    function __construct(){
    }

    //DB Loading Region
    function LoadRecipe($id){
        include_once("ConnectionString.php");
        $query = $db->prepare('SELECT * FROM `recipes` WHERE id = :id');
        $query->execute(['id' => strip_tags($id)]);
        $DBRecipe = $query->fetch();
        $Model = new RecipeModel($DBRecipe["RecipeName"],
                                 $DBRecipe["RecipeAuthor"],
                                 $DBRecipe["Ingredients"],
                                 $DBRecipe["Directions"],
                                 $DBRecipe["Notes"]);
        return $Model;
    }
    //End DB Loading Region

    function Recipe($id){
        $Recipe = $this->LoadRecipe($id);
        include 'Views/Recipe.php';
    }
}
?>