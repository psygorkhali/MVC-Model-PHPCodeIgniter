<!DOCTYPE html>

<html>

<head>
    <title>login form</title>

    <!--
    <link href="<?php echo base_url(" bootstrap/css/bootstrap.min.css "); ?>" rel="stylesheet">
    <script src="<?php echo base_url(" js/jquery-3.2.1.min.css "); ?>"></script>
    <script src="<?php echo base_url(" bootstrap/js/bootstrap.min.js "); ?>"></script>
-->


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="<?php echo base_url("css/logincss.css"); ?>">
</head>

<body>
    <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <span style="background-color:Tomato;"><?= (isset($error))?$error:'' ?></span>
            <form class="form-signin" action="<?php echo base_url(); ?>index.php/logincontroller/validation" method="post">
                <input type="text" class="form-control" placeholder="Username" name="username" required autofocus> <input type="password" class="form-control" placeholder="Password" name="password" required>
                <div id="remember" class="checkbox">
                    <label> <input type="checkbox" value="remember-me"
						name="remember-me"> Remember me
					</label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
            </form>
            <!-- /form -->
            <a href="forgetPassword.jsp">Forget Password?</a>
            <!-- /card-container -->
        </div>
        <!-- /container -->
    </div>
</body>

</html>
