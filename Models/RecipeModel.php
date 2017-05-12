<?php
class RecipeModel{
    public $Name;
    public $Author;
    public $Ingredients;
    public $Directions;
    public $Notes;
    
    function __construct($name, $author, $ingr, $dir, $extra_notes){
        $this->Name = $name;
        $this->Author = $author;
        $this->Ingredients = $ingr;
        $this->Directions = $dir;
        $this->Notes = $extra_notes;
    }
}
?>
