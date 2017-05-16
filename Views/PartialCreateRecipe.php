<html>
    <link rel=stylesheet href="../Resources/site.css" type="text/css"/>
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
                                <div class="col-md-offset-2 col-md-2">
                                    <button type="button" id="bRemoveIngredient" class="btn btn-danger">- Remove last ingredient</button>
                                </div> 
                                <br /><br />
                                <h4>Directions</h4>
                                <ol>
                                    <li style="list-style: none;">
                                        <div class="input-group">
                                            <div class="input-group-addon">Step 1</div>
                                            <textarea class="form-control" placeholder="Steps..." id = "Direction1"></textarea><br />
                                        </div>
                                    </li>
                                </ol>
                                <div class="clearfix"></div>
                                <div class="col-sm-6">
                                    <button type="button" id="bAddDirection" class="btn btn-success">+ Add another step</button>
                                </div>
                                <div class="col-md-offset-2 col-md-2">
                                    <button type="button" id="bRemoveDirection" class="btn btn-danger">- Remove last step</button>
                                </div> 
                                <br /><br /><hr />
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
            var DirectionCount = 1;
            $("#bAddDirection").click(function(){
                $("#Direction" + DirectionCount++).parent("div").parent("li").after(
                    '<li style="list-style: none;"><div class="input-group"><div class="input-group-addon">Step '+ DirectionCount +'</div><textarea class="form-control" placeholder="Steps..." id = "Direction'+ DirectionCount +'"></textarea><br /></div></li>'
                )
            });

            $("#bRemoveDirection").click(function(){
                $("#Direction" + DirectionCount--).parent("div").parent("li").remove();
            });

            var IngredientCount = 1;
            $("#bAddIngredient").click(function(){
                $("#Amt" + IngredientCount++).parent("div").after(
                    '<br /><div class="col-sm-8"><input class="form-control" placeholder="ex) Water, Tuna, Tomatoes, etc..." id = "Ingredient' + IngredientCount +'"/></div><div class="col-sm-4"><input class="form-control" placeholder="ex) 2c, 12oz, 1c diced, etc..." id = "Amt' + IngredientCount + '"/></div>');
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
                $('<input>').attr('type','hidden').attr('name','ingredients').val(ingredients).appendTo('form');
                

                var directions = "";
                $("textarea[id^='Direction']").each(function(){
                    directions += $(this).val() + "|";
                });
                $('<input>').attr('type','hidden').attr('name','directions').val(directions).appendTo('form');

                console.log(directions);
                console.log(ingredients);
                //submit the form
            });
        </script>
    </footer>
</html>