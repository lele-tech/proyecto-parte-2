<?php
    require_once './database.php';
    session_start();

    $username = $_SESSION["fullname"] ?? null;
    
    $destination_details = [];
   
    $data = json_decode($_COOKIE['recipe_data'], true);
        
    $booking_details = $data;
    //var_dump($booking_details);

    
    
    
       
   
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camping Website</title>
    <!-- google fonts -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@900&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">
    <!-- google fonts -->
    <link rel="stylesheet" href="./css/mainRecipes.css">
</head>
<body>
<?php 
        include "./parts/header.php";

        if(session_status() === PHP_SESSION_ACTIVE){
            if(isset($_SESSION["isLoggedIn"])){
                //echo "SESSION -> insert to DB";
                $database->insert('tb_bookings', [
                    'user_name' => $username,
                    'recipe_data' => $data,
                ]);
            }
        }else{
            //echo "NO SESSION -> redirect to forms";
            header("location: forms.php");
        }
    ?>
    <main class= "recipes-container">
        <!-- destinations -->
        <section class="recipe whidt">
            <h2 class="top10-title">Thank you! Your booking has been received.</h2>

        </section>
        <!-- destinations -->

    </main>
    <?php 
        include "./parts/footer.php";
    ?>
</body>
</html>