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
                        <h1 class="panel-title">Signup for EasyRecipe</h1>
                    </div>
                    <div class="panel-body">
                        <?php
                                            if (isset($ErrorMessage) && $ErrorMessage != null) {
                                                echo '<div class="alert alert-danger">' . $ErrorMessage . '</div>';
                                            }
                        ?>
                            <form method="post" action="Login.php">
                                <h4>User and Password</h4>
                                <div class="col-sm-6">
                                    <input class="form-control" placeholder="Username" name="Username" />
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input class="form-control" type="password" placeholder="Password" name="Password" />
                                        <span class="input-group-addon" id="pass-peek">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </span>
                                    </div>
                                    <p class="help-block">EasyRecipe recommends using a different password for every website!</p>
                                </div>
                                <br /><br />
                                <h4>Email</h4>
                                <div class="col-sm-12">
                                    <input class="form-control" type="email" placeholder="Email" name="Email" />
                                </div>
                                <div class="clearfix"></div><br />
                                <button class="btn btn-primary" type="submit">Signup!</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<footer>
    <script>
        $('#pass-peek').hover(
            function () {
                $('input[name="Password"]').attr("type", "text");
            },
            function () {
                $('input[name="Password"').attr("type", "password");
            }
        );
    </script>
</footer>

</html>