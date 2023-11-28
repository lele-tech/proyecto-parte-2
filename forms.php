
<?php
    require_once './database.php';
    $message = "";
    $messageLogin = "";
    if($_POST){

        if(isset($_POST["login"])){

            $user = $database->select("tb_users","*",[
                "usr"=> $_POST["username"]
            ]);

            if(count($user) > 0){
                //validate password
                if(password_verify($_POST["password"], $user[0]["pwd"])){
                    session_start();
                    $_SESSION["isLoggedIn"] = true;
                    $_SESSION["fullname"] = $user[0]["fullname"];
                    header("location: home.php");
                }else{
                    $message = "wrong username or password";
                }
            }else{
                $message = "wrong username or password";
            }

            //validate if user already logged in
            
            //if(isset($_SESSION["isLoggedIn"])){
                //header("location: book.php?id=".$_POST["login"]);
            //}else{
                //validate login
                //echo "validate login: ".$_POST["login"];
            //}
        }

        if(isset($_POST["register"])){
            //validate if user already registered
            $validateUsername = $database->select("tb_users","*",[
                "usr"=>$_POST["username"]
            ]);

            if(count($validateUsername) > 0){
                $message = "This username is already registered";
            }else{

                $pass = password_hash($_POST["password"], PASSWORD_DEFAULT, ['cost' => 12]);

                $database->insert("tb_users",[
                    "fullname"=> $_POST["fullname"],
                    "usr"=> $_POST["username"],
                    "pwd"=> $pass,
                    "email"=> $_POST["email"]
                ]);

                //header("location: book.php?id=".$_POST["register"]);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forms</title> <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@900&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">
    <!-- google fonts -->

    <link rel="stylesheet" href="./css/mainRecipes.css">
</head>
<body>
<?php 
        include './parts/header.php';
   ?>
    
    <main>
    <div class="line"></div>
   
            
    <section class='account-container'>
        <div class='form-text'>
            <section class='login'>
                <h3 class='title-login'>Login</h3>
                
                <form method="post" action="forms.php">
                    <div class='login-text'>
                        <label for='username'>Username:</label>
                        <input id='username' type='text' name='username'>
                    </div>
                    <div class='login-text'>
                        <label for='password'>Password:</label>
                        <input stylesheet='margin-bottom:1rem' id='password' type='password' name='password'>
                    </div>
                    <div class='login-text'>
                        <input class='btn nav-list' type='submit' value="LOGIN">
                    </div>
                    <p class='form-text login-text'><?php echo $message; ?></p>
                    <input type="hidden" name="login" value="1">
                </form>
            </section>
        </div>
            
        <div class='form-text'>
        <section class='register'>
                <h3 class='title-login'>Sign In</h3>
                
                <form method="post" action="forms.php">
                    <div class='register-text'>
                        <label for='fullname'>Fullname:</label>
                        <input id='fullname' class='form-input' type='text' name='fullname'>
                    </div>
                    <div class='register-text'>
                        <label for='email'>Email Address:</label>
                        <input id='email' class='form-input' type='text' name='email'>
                    </div>
                    <div class='register-text'>
                        <label for='username'>Username:</label>
                        <input id='username' class='form-input' type='text' name='username'>
                    </div>
                    <div class='register-text'>
                        <label for='password'>Password:</label>
                        <input id='password' class='form-input' type='password' name='password'>
                    </div>
                    <div class='register-btn-text'>
                        <input class='btn nav-list' type='submit' value="REGISTER">
                    </div>
                    <p class='form-text register-text'><?php echo $message; ?></p>
                    <input type="hidden" name="register" value="1">
                </form>
            </section>
                
                
                
            </div>
            </div>
            </section> 
       
</main>
<?php 
        include './parts/footer.php';
    ?>
</body>
</html>