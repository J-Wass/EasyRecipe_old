<?php
foreach($RecipeList as $Recipe){
    echo 'Name: ' . $Recipe->Name . '<br />';
    echo 'Author: ' . $Recipe->Author . '<br />';
    echo 'Ingredients: ' . $Recipe->Ingredients . '<br />';
    echo 'Steps: ' . $Recipe->Directions . '<br />';
    echo 'Notes: ' . $Recipe->Notes . '<br /><br />';
}
?>