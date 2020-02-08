<?php
include_once 'script.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <title> Register </title>
</head>
<body>
<h2> Register: </h2>
<form method="post">
    <?php include('errors.php')?>
    <div>
        <label> Email </label>
        <input type="text" name="email">
    </div>
    <div>
        <label> Sex </label>
        <input type="text" name="sex">
    </div>
    <div>
        <label> Native language </label>
        <input type="text" name="nativeSpeaker">
    </div>
    <div>
        <label> Self evaluated level of English </label>
        <input type="text" name="selfEvaluatedLevelOfEnglish">
    </div>
    <div>
        <label> Certified level of English  </label>
        <input type="text" name="certifiedLevelOfEnglish">
    </div>
    <div>
        <button type="submit" name="registration"> Register </button>
    </div>
</form>
<p> Resume old experiment? <a href="login.php"> Login </a> </p>
</body>
</html>
