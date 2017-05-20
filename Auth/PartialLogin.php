<html>

<head>
    <link rel=stylesheet href="../Resources/site.css" type="text/css" />
</head>

<body>
    <div class="container">
        <br />
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title">Login to EasyRecipe</h1>
                    </div>
                    <div class="panel-body">
                        <?php
                        if(isset($ErrorMessage) && $ErrorMessage != null){
                            echo '<div class="alert alert-danger">' . $ErrorMessage . '</div>';
                        }
                        ?>
                            <form method="post" action="Login.php">
                                <div class="col-sm-6">
                                    <h4>Username</h4>
                                    <?php
                                    if(isset($_POST['Username'])){
                                        echo '<input class="form-control" placeholder="Username" name="Username" value="' . $_POST['Username'] .'" />';
                                    }
                                    else{
                                        echo '<input class="form-control" placeholder="Username" name="Username" />';
                                    }
                                    ?>
                                        <h4>Password</h4>
                                        <input class="form-control" type="password" placeholder="Password" name="Password" />
                                </div>
                                <div class="col-sm-6">
                                    <div class="well">
                                        <h2>
                                            Need to create an account?<br/>
                                            <a href="../Signup.php">Signup now!</a>
                                        </h2>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <button class="btn btn-primary" type="submit">Login</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<footer>
    <script>

    </script>
</footer>

</html>