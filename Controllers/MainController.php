<?php
include_once("Models/RecipeModel.php");
class MainController{

    function __construct(){
    }

    //DB Loading Region
    function SaveRecipe($RecipeModel){
        //prepared statements prevent sql injection, strip tags prevents html injection
        include_once("ConnectionString.php");
        $query = $db->prepare("INSERT INTO `recipes`(`RecipeName`, `RecipeAuthor`, `Directions`, `Ingredients`, `Notes`) VALUES (:name, :author, :directions, :ingredients, :notes)");
        $query->execute(['name' => strip_tags($RecipeModel->Name),
                         'author' => strip_tags($RecipeModel->Author),
                         'directions' => strip_tags($RecipeModel->Directions),
                         'ingredients' => strip_tags($RecipeModel->Ingredients),
                         'notes' => strip_tags($RecipeModel->Notes)]);
        return $db->lastInsertId();
    }

    function LoadAllRecipes(){
        include_once("ConnectionString.php");
        $query = $db->prepare('SELECT * FROM `recipes`');
        $query->execute();
        $DBRecipeList = $query->fetchAll();
        $RecipeModelList = array();
        $i = 0;
        foreach($DBRecipeList as $recipe){
            $RecipeModelList[$i++] = new RecipeModel($recipe["Id"],
                                                   $recipe["RecipeName"],
                                                   $recipe["RecipeAuthor"],
                                                   $recipe["Ingredients"],
                                                   $recipe["Directions"],
                                                   $recipe["Notes"]);
        }
        return $RecipeModelList;
    }

    function LoadRecipe($id){
        include("ConnectionString.php");
        $query = $db->prepare('SELECT * FROM `recipes` WHERE id = :id');
        $query->execute(['id' => strip_tags($id)]);
        $DBRecipe = $query->fetch();
        $Model = new RecipeModel($DBRecipe["Id"],
                                 $DBRecipe["RecipeName"],
                                 $DBRecipe["RecipeAuthor"],
                                 $DBRecipe["Ingredients"],
                                 $DBRecipe["Directions"],
                                 $DBRecipe["Notes"]);
        return $Model;
    }
    //End DB Loading Region

    function CreateRecipe(){
        if(isset($_POST['RecipeName'])){
            //save model and present the finished recipe
            $RecipeModel = new RecipeModel(-1,
                                           $_POST['RecipeName'],
                                           $_POST['RecipeAuthor'],
                                           $_POST['Ingredients'],
                                           $_POST['Directions'],
                                           $_POST['Notes']);
            $id = $this->SaveRecipe($RecipeModel);
            $this->Recipe($id);
        }
        else{
            //bring user to create recipe page
            include 'Views/PartialCreateRecipe.php';
        }
    }

    function Recipe($id){
        $Recipe = $this->LoadRecipe($id);
        include 'Views/PartialRecipe.php';
    }

    function ListRecipes(){
        $RecipeList = $this->LoadAllRecipes();
        include 'Views/PartialShowAllRecipes.php';
    }
}
?>