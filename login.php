<?php
include_once 'script.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <title> Login </title>
</head>
<body>
<h2> Login: </h2>
<form method="post">
    <?php include('errors.php')?>
    <div>
        <label> Email </label>
        <input type="text" name="email">
    </div>

    <div>
        <button type="submit" name="login"> Login </button>
    </div>

</form>
<p> Start new experiment? <a href="register.php"> Register </a> </p>
</body>
</html>
