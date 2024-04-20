<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $comment = $_POST["comment"];

    if (!empty($name) && !empty($comment)) {
        echo "$name: $comment";
    } 
    else 
    {
        echo "Please fill in all fields.";
    }
}
?>
