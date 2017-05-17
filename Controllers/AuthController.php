<?php
include_once("Models/UserModel.php");
class AuthController
{

    function __construct()
    {
    }

    //DB Loading Region
    function SaveUser($UserModel)
    {
        include("Resources/ConnectionString.php");

        $salt = substr(str_shuffle(MD5(random_bytes(30))), 0, random_int(22, 35));//crypt secure alphanumeric salt =D
        $pepper = strip_tags($UserModel->UserName);
        $options = [
             'cost' => 13,
             'salt' => $salt,
        ];
        $pass = strip_tags($UserModel->Password) . $pepper;//pepper the password
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT, $options);//bcrypt with salt and pepper

        $query = $db->prepare("INSERT INTO `users`(`Username`, `Password`, `Salt`, `Email`) VALUES (:user, :pass, :salt, :email)");
        $query->execute(['user' => strip_tags($UserModel->UserName),
                         'pass' => $hashedPass,
                         'salt' => $salt,
                         'email' => strip_tags($UserModel->Email)]);
        return $db->lastInsertId();
    }

    function LoadUser($id)
    {
        include("Resources/ConnectionString.php");
        $query = $db->prepare('SELECT * FROM `users` WHERE id = :id');
        $query->execute(['id' => strip_tags($id)]);
        $DBUser = $query->fetch();
        $Model = new UserModel($DBUser["Id"],
                                 $DBUser["Username"],
                                 $DBUser["Password"],
                                 $DBUser["Salt"],
                                 $DBUser["Email"]);
        return $Model;
    }
    //End DB Loading Region

    function Login()
    {
        if (isset($_POST['Username']) && isset($_POST['Password'])
           && isset($_POST['Email'])) {
            $UserModel = new UserModel(-1,
                                           $_POST['Username'],
                                           $_POST['Password'],
                                           null,
                                           $_POST['Email']
                                      );
            //save model to db
            $id = $this->SaveUser($UserModel);

            //display
            $this->User($id);
        } else {
            include_once("Auth/PartialLogin.php");
        }
    }

    function User($id)
    {
        if ($id == null) {
            return Signup();
        } else {
            $UserModel = $this->LoadUser($id);
            include_once("Auth/PartialUser.php");
        }
    }

    function Signup()
    {
        include_once("Auth/PartialSignup.php");
    }
}
