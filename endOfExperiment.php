<?php
include_once 'script.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <title> Thanks </title>
</head>
<body>
<h2> Thank you for your participation! </h2>
<h2> Would you like to do another experiment? </h2>
<div>
    <form method="post">
        <button type="submit" name="startNewExperiment"> New experiment </button>
    </form>
</div>
<div>
    <form method="post">
        <button type="submit" name="logout"> Logout </button>
    </form>
</div>
</body>
</html>