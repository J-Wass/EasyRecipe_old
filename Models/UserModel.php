<?php
class UserModel
{
    public $Id;
    public $UserName;
    public $Password;
    public $Salt;
    public $Email;
    
    function __construct($id, $user, $pass, $salt, $email)
    {
        $this->Id = $id;
        $this->UserName = $user;
        $this->Password = $pass;
        $this->Salt = $salt;
        $this->Email = $email;
    }
}
