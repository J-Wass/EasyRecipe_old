<html>
    <link rel=stylesheet href="../site.css" type="text/css"/>
    <body>
        <div class="container">
            <br />
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h1 class="panel-title">Creating a new recipe</h1>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="Create.php">
                                <h4>Name and Creator</h4>
                                <div class="col-sm-6">
                                    <input class="form-control" placeholder="Name of Recipe" name = "RecipeName"/>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" placeholder="Author of Recipe" name = "RecipeAuthor"/>
                                </div>
                                <br /><br />
                                <h4>Ingredients</h4>
                                <div class="col-sm-8">
                                    <input class="form-control" placeholder="ex) Water, Tuna, Tomatoes, etc..." id = "Ingredient1"/>
                                </div>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="ex) 2 cups, 12 oz, etc..." id = "Amt1"/>
                                </div>
                                <div class="clearfix"></div><br />
                                <div class="col-sm-6">
                                    <button type="button" id="bAddIngredient" class="btn btn-success">+ Add next ingredient</button>
                                </div>
                                <div class="col-sm-6">
                                    <button style="float:right" type="button" id="bRemoveIngredient" class="btn btn-danger">- Remove last ingredient</button>
                                </div> 
                                <br /><br />
                                <h4>Directions</h4>
                                <ol>
                                    <li>
                                        <textarea class="form-control" placeholder="Directions" id = "Directions1"></textarea><br />
                                    </li>
                                </ol>
                                <textarea class="form-control" placeholder="Extra Notes" name = "Notes"></textarea><br />
                                <div class="clearfix"></div>
                                <button class="btn btn-primary" type="button" id="bSubmit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer>
        <script>
            var IngredientCount = 1;

            $("#bAddIngredient").click(function(){
                $("#Amt" + IngredientCount++).parent("div").after(
                    '<div class="col-sm-8"><input class="form-control" placeholder="ex) Water, Tuna, Tomatoes, etc..." id = "Ingredient' + IngredientCount +'"/></div><div class="col-sm-4"><input class="form-control" placeholder="ex) 2c, 12oz, 1c diced, etc..." id = "Amt' + IngredientCount + '"/></div>');
            });

            $("#bRemoveIngredient").click(function(){
                $("#Amt" + IngredientCount).parent("div").remove();
                $("#Ingredient" + IngredientCount--).parent("div").remove();
            });

            $("#bSubmit").click(function(){
                //set up ingredients to properly serialize in the DB
                var ingredients = "";
                $("input[id^='Ingredient']").each(function(){
                    var i = $(this).attr('id').substring(10);
                    ingredients += $(this).val() + ',' + $('#Amt' + i).val()+'|';
                });
                console.log(ingredients);
                //prepare directions
                
                //submit the forms
            });
        </script>
    </footer>
</html>