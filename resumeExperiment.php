<?php
include_once 'script.php';
isLoggedIn();
generateArrays();
?>
<!DOCTYPE html>
<html>
<head>
    <title> Experiment </title>
    <link rel="stylesheet" type="text/css" href="experimentStyle.css">
    <script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="experimentJS.js"></script>
</head>
<body>

<div>
    <form method="post">
        <button type="submit" name="logout"> Logout</button>
    </form>
</div>
<!--
<div id="texts"  ondrop="dropBack(event);" ondragover="allowDrop(event)">-->
<div id="texts">
    <a class="text" href="#first-text">
        <div id="text1">
            <?php
            echo "<p id=\"$sequenceArray[0]\" " . isTextClassified(0) . " ondragstart=\"drag(event); selectText(this);\">";
            echo getTextS($sequenceArray[0]);
            echo "</p>";
            ?>
        </div>
    </a>
    <div class="text-target" id="first-text">
        <div>
            <?php echo getTextS($sequenceArray[0]);?>
        </div>
        <a class="text-close" href="#"></a>
    </div>

    <a class="text" href="#second-text">
        <div id="text2">
            <?php
            echo "<p id=\"$sequenceArray[1]\" " . isTextClassified(1) . " ondragstart=\"drag(event); selectText(this);\">";
            echo getTextS($sequenceArray[1]);
            echo "</p>";
            ?>
        </div>
    </a>
    <div class="text-target" id="second-text">
        <div>
            <?php echo getTextS($sequenceArray[1]);?>
        </div>
        <a class="text-close" href="#"></a>
    </div>

    <a class="text" href="#third-text">
        <div id="text3">
            <?php
            echo "<p id=\"$sequenceArray[2]\" " . isTextClassified(2) . " ondragstart=\"drag(event); selectText(this);\">";
            echo getTextS($sequenceArray[2]);
            echo "</p>";
            ?>
        </div>
    </a>
    <div class="text-target" id="third-text">
        <div>
            <?php echo getTextS($sequenceArray[2]);?>
        </div>
        <a class="text-close" href="#"></a>
    </div>

    <a class="text" href="#fourth-text">
        <div id="text4">
            <?php
            echo "<p id=\"$sequenceArray[3]\" " . isTextClassified(3) . " ondragstart=\"drag(event); selectText(this);\">";
            echo getTextS($sequenceArray[3]);
            echo "</p>";
            ?>
        </div>
    </a>
    <div class="text-target" id="fourth-text">
        <div>
            <?php echo getTextS($sequenceArray[3]);?>
        </div>
        <a class="text-close" href="#"></a>
    </div>

    <a class="text" href="#fifth-text">
        <div id="text5">
            <?php
            echo "<p id=\"$sequenceArray[4]\" " . isTextClassified(4) . " ondragstart=\"drag(event); selectText(this);\">";
            echo getTextS($sequenceArray[4]);
            echo "</p>";
            ?>
        </div>
    </a>
    <div class="text-target" id="fifth-text">
        <div>
            <?php echo getTextS($sequenceArray[4]);?>
        </div>
        <a class="text-close" href="#"></a>
    </div>

    <a class="text" href="#sixth-text">
        <div id="text6">
            <?php
            echo "<p id=\"$sequenceArray[5]\" " . isTextClassified(5) . " ondragstart=\"drag(event); selectText(this);\">";
            echo getTextS($sequenceArray[5]);
            echo "</p>";
            ?>
        </div>
    </a>
    <div class="text-target" id="sixth-text">
        <div>
            <?php echo getTextS($sequenceArray[5]);?>
        </div>
        <a class="text-close" href="#"></a>
    </div>

    <a class="text" href="#seventh-text">
        <div id="text7">
            <?php
            echo "<p id=\"$sequenceArray[6]\" " . isTextClassified(6) . " ondragstart=\"drag(event); selectText(this);\">";
            echo getTextS($sequenceArray[6]);
            echo "</p>";
            ?>
        </div>
    </a>
    <div class="text-target" id="seventh-text">
        <div>
            <?php echo getTextS($sequenceArray[6]);?>
        </div>
        <a class="text-close" href="#"></a>
    </div>

    <a class="text" href="#eighth-text">
        <div id="text8">
            <?php
            echo "<p id=\"$sequenceArray[7]\" " . isTextClassified(7) . " ondragstart=\"drag(event); selectText(this);\">";
            echo getTextS($sequenceArray[7]);
            echo "</p>";
            ?>
        </div>
    </a>
    <div class="text-target" id="eighth-text">
        <div>
            <?php echo getTextS($sequenceArray[7]);?>
        </div>
        <a class="text-close" href="#"></a>
    </div>
</div>

<div id="boxes">
    <div id="group1" ondrop="selectBox(this); drop(event);" ondragover="allowDrop(event)">
        <?php
            placeClassifiedTextInBox($classifiedTextsArrayASSOCIATIVE['group1']);
        ?>
    </div>
    <div id="group2" ondrop="selectBox(this); drop(event);" ondragover="allowDrop(event)">
        <?php
            placeClassifiedTextInBox($classifiedTextsArrayASSOCIATIVE['group2']);
        ?>
    </div>
    <div id="group3" ondrop="selectBox(this); drop(event);" ondragover="allowDrop(event)">
        <?php
            placeClassifiedTextInBox($classifiedTextsArrayASSOCIATIVE['group3']);
        ?>
    </div>
    <div id="group4" ondrop="selectBox(this); drop(event);" ondragover="allowDrop(event)">
        <?php
            placeClassifiedTextInBox($classifiedTextsArrayASSOCIATIVE['group4']);
        ?>
    </div>
    <div id="group5" ondrop="selectBox(this); drop(event);" ondragover="allowDrop(event)">
        <?php
            placeClassifiedTextInBox($classifiedTextsArrayASSOCIATIVE['group5']);
        ?>
    </div>
</div>
<form method="post">
    <button type="submit" name="endExperiment"> Submit </button>
</form>
</body>
</html>
