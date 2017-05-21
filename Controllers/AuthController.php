<?php
include_once("Models/UserModel.php");
class AuthController
{

    function __construct()
    {
    }

    //DB Loading Region
    function IsVerifiedUser($UserModel)
    {
        $salt = strip_tags($UserModel->Salt);
        $pepper = strip_tags($UserModel->UserName);
        $pass = strip_tags($UserModel->Password) . $pepper;
        $options = [
             'cost' => 13,
             'salt' => $salt,
        ];
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT, $options);
        include("Resources/ConnectionString.php");
        $query = $db->prepare('SELECT `Password` FROM `users` WHERE `Id` LIKE :id');
        $query->execute(['id' => strip_tags($UserModel->Id)]);
        $DBUser = $query->fetch();
        if ($DBUser == null) {
            return false;
        }
        if ($DBUser['Password'] == $hashedPass) {
            return true;
        }
        return false;
    }

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

        try {
            $query = $db->prepare("INSERT INTO `users`(`Username`, `Password`, `Salt`, `Email`) VALUES (:user, :pass, :salt, :email)");
            $query->execute(['user' => strip_tags($UserModel->UserName),
                         'pass' => $hashedPass,
                         'salt' => $salt,
                         'email' => strip_tags($UserModel->Email)]);
            return $db->lastInsertId();
        } catch (PDOException $e) {
            if ($e->getCode() == 1062) {
                return null;
            }
        }
    }

    function LoadUserByUsername($Username, $Password)
    {
        include("Resources/ConnectionString.php");
        $query = $db->prepare('SELECT * FROM `users` WHERE `Username` LIKE :user');
        $query->execute(['user' => strip_tags($Username)]);
        $DBUser = $query->fetch();
        if ($DBUser == null) {
            return null;
        }
        $Model = new UserModel($DBUser["Id"],
                                 $Username,
                                 $Password,
                                 $DBUser["Salt"],
                                 null);
        return $Model;
    }

    function LoadUserById($id)
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
        //from signup page
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
            if ($id == null) {
                $ErrorMessage = "User already exists: " . $_POST['Username'];
                include_once("Auth/PartialSignup.php");
                return;
            }

            //display
            $this->User($id);
        } else {
            //from login page
            if (isset($_POST['Username']) && isset($_POST['Password'])) {
                $Model = $this->LoadUserByUsername($_POST['Username'], $_POST['Password']);
                if ($Model == null) {
                    //could not find username
                    $ErrorMessage = "Could not find user " . $_POST['Username'];
                    include_once("Auth/PartialLogin.php");
                    return;
                }
                if ($this->IsVerifiedUser($Model)) {
                    //create logged in session
                    $_GET["id"] = $Model->Id;
                    include_once("User.php");
                } else {
                    //password was wrong
                    $ErrorMessage = "Incorrect password for " . $_POST['Username'];
                    include_once("Auth/PartialLogin.php");
                }
            } else {
                include_once("Auth/PartialLogin.php");
            }
        }
    }

    function User($id)
    {
        if ($id == null) {
            return Signup();
        } else {
            $UserModel = $this->LoadUserById($id);
            include_once("Auth/PartialUser.php");
        }
    }

    function Signup()
    {
        include_once("Auth/PartialSignup.php");
    }
}
