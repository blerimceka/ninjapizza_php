<?php

include("config/db_connect.php");
include("templates/header.php");

$title = $email = $ingredients = "";
$errors = array('email'=>'', 'title'=>'', 'ingredients'=>'');

if(isset($_POST['submit'])){

    //check email
    if(empty($_POST['email'])){
        $errors['email'] = 'An email is required <br />';
    }else {
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Email must be a valid email address!';
        }
    }

    //check title 
    if(empty($_POST['title'])){
        $errors['title'] = 'A title is required <br />';
    }else {
        $title = $_POST['title'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
            $errors['title'] = 'Title must be letters and spaces only!';
        }
    }

    //check ingredients
    if(empty($_POST['ingredients'])){
        $errors['ingredients'] = 'At least one ingredients is required <br />';
    }else {
        $ingredients = $_POST['ingredients'];
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
            $errors['ingredients'] = 'Ingredients must be comma seperated list';
        }
    }

    if(array_filter($errors)){
        //echo 'errors in th form
    }else{

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        //create sql
        $sql = "INSERT INTO pizza(title, email, ingredients) VALUES('$title', '$email', '$ingredients')";

        //save to db and check
        if(mysqli_query($conn, $sql)){
            //succes
            header('Location: index.php');
        }else{
            echo 'Query error:' . mysqli_error($conn);
        }
        
    }

}


?>

<selection class="container gray-text">

    <h4 class="center">ADD A PIZZA</h4>
    <form action="add.php" method="POST" class="white">
        <label>Your Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <div class="red-text"><?php echo $errors['email']; ?></div>
        <label>Pizza title</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
        <div class="red-text"><?php echo $errors['title']; ?></div>
        <label>Ingredients (comma seperated)</label>
        <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients); ?>">
        <div class="red-text"><?php echo $errors['ingredients']; ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>

</selection>