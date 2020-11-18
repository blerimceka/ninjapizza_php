<?php

//connect to database
$conn = mysqli_connect('localhost', 'ceka', 'ceka1234', 'ninja_pizza');

//check connection
if(!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}

?>