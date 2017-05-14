<?php
class RecipeModel{
    public $Id;
    public $Name;
    public $Author;
    public $Ingredients;
    public $Directions;
    public $Notes;
    
    function __construct($id, $name, $author, $ingr, $dir, $extra_notes){
        $this->Id = $id;
        $this->Name = $name;
        $this->Author = $author;
        $this->Ingredients = $ingr;
        $this->Directions = $dir;
        $this->Notes = $extra_notes;
    }
}
?>
