<?php
include_once 'script.php';
isLoggedIn();
$sequenceArray = explode (",", mysqli_fetch_assoc(mysqli_query($DataBase,"SELECT variant FROM variants WHERE variant_id='".$_SESSION['variant']."'"))['variant']);
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
            <button type="submit" name="logout"> Logout </button>
        </form>
    </div>
		<div id="texts" ondrop="dropBack(event);" ondragover="allowDrop(event)">
            <a class="text" href="#first-text">
                <div id="text1">
                    <p <?php echo "id=" . $sequenceArray[0]?> draggable="true" ondragstart="drag(event); selectText(this);">
                        <?php echo getTextS($sequenceArray[0]);?>
                    </p>
                </div>
            </a>
            <div class="text-target" id="first-text" >
                <div>
                    <?php echo getTextS($sequenceArray[0]);?>
                </div>
                <a class="text-close" href="#"></a>
            </div>

            <a class="text" href="#second-text">
                <div id="text2">
                    <?php
                    //possible solution for login
                    //echo "<p id=\"$sequenceArray[1]\" draggable=\"false\" ondragstart=\"drag(event); selectText(this);\">";
                    //echo getTextS($sequenceArray[1]);
                    //echo "</p>"
                    ?>
                    <p <?php echo "id=" . $sequenceArray[1]?> draggable="true" ondragstart="drag(event); selectText(this);">
                        <?php echo getTextS($sequenceArray[1]);
                        ?>
                    </p>
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
                    //possible solution for login
                    //echo "<p id=\"$sequenceArray[2]\" draggable=\"false\" ondragstart=\"drag(event); selectText(this);\">";
                    //echo getTextS($sequenceArray[2]);
                    //echo "</p>"
                    ?>
                    <p <?php echo "id=" . $sequenceArray[2]?> draggable="true" ondragstart="drag(event); selectText(this);">
                        <?php echo getTextS($sequenceArray[2]);?>
                    </p>
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
                    //possible solution for login
                    //echo "<p id=\"$sequenceArray[3]\" draggable=\"false\" ondragstart=\"drag(event); selectText(this);\">";
                    //echo getTextS($sequenceArray[3]);
                    //echo "</p>"
                    ?>
                    <p <?php echo "id=" . $sequenceArray[3]?> draggable="true" ondragstart="drag(event); selectText(this);">
                        <?php echo getTextS($sequenceArray[3]);?>
                    </p>
                </div>
            </a>
            <div class="text-target" id="fourth-text" >
                <div>
                    <?php echo getTextS($sequenceArray[3]);?>
                </div>
                <a class="text-close" href="#"></a>
            </div>

            <a class="text" href="#fifth-text">
                <div id="text5">
                    <?php
                    //possible solution for login
                    //echo "<p id=\"$sequenceArray[4]\" draggable=\"false\" ondragstart=\"drag(event); selectText(this);\">";
                    //echo getTextS($sequenceArray[4]);
                    //echo "</p>"
                    ?>
                    <p <?php echo "id=" . $sequenceArray[4]?> draggable="true" ondragstart="drag(event); selectText(this);">
                        <?php echo getTextS($sequenceArray[4]);?>
                    </p>
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
                    //possible solution for login
                    //echo "<p id=\"$sequenceArray[5]\" draggable=\"false\" ondragstart=\"drag(event); selectText(this);\">";
                    //echo getTextS($sequenceArray[5]);
                    //echo "</p>"
                    ?>
                    <p <?php echo "id=" . $sequenceArray[5]?> draggable="true" ondragstart="drag(event); selectText(this);">
                        <?php echo getTextS($sequenceArray[5]);?>
                    </p>
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
                    //possible solution for login
                    //echo "<p id=\"$sequenceArray[6]\" draggable=\"false\" ondragstart=\"drag(event); selectText(this);\">";
                    //echo getTextS($sequenceArray[6]);
                    //echo "</p>"
                    ?>
                    <p <?php echo "id=" . $sequenceArray[6]?> draggable="true" ondragstart="drag(event); selectText(this);">
                        <?php echo getTextS($sequenceArray[6]);?>
                    </p>
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
                    //possible solution for login
                    //echo "<p id=\"$sequenceArray[7]\" draggable=\"false\" ondragstart=\"drag(event); selectText(this);\">";
                    //echo getTextS($sequenceArray[7]);
                    //echo "</p>"
                    ?>
                    <p <?php echo "id=" . $sequenceArray[7]?> draggable="true" ondragstart="drag(event); selectText(this);">
                        <?php echo getTextS($sequenceArray[7]);?>
                    </p>
                </div>
            </a>
            <div class="text-target" id="eighth-text" >
                <div>
                    <?php echo getTextS($sequenceArray[7]);?>
                </div>
                <a class="text-close" href="#"></a>
            </div>
		</div>

        <div id="boxes">
            <div id="group1" ondrop="selectBox(this); drop(event);" ondragover="allowDrop(event)"></div>
            <div id="group2" ondrop="selectBox(this); drop(event);" ondragover="allowDrop(event)"></div>
            <div id="group3" ondrop="selectBox(this); drop(event);" ondragover="allowDrop(event)"></div>
            <div id="group4" ondrop="selectBox(this); drop(event);" ondragover="allowDrop(event)"></div>
            <div id="group5" ondrop="selectBox(this); drop(event);" ondragover="allowDrop(event)"></div>
        </div>
        <form method="post">
            <button type="submit" name="endExperiment"> Submit </button>
        </form>
	</body>
</html>