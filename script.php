<?php
session_start();

$DataBase = dataBaseConnection();

$userEmail = "";
$userSex = "";
$userNativeSpeaker = "";
$errorListVar = array();
$classifiedTextsArray = array();
$UNclassifiedTextsArray = array();
$sequenceArray = array();
$classifiedTextsArrayASSOCIATIVE = array();
$DataBase = dataBaseConnection();

if (isset($_POST['logout'])) {
    logout();
}

if (isset($_POST['text_id'])) {
    updateDatabaseOnDrop();
}

if (isset($_POST['BeginExperiment'])) {
    beginExperiment();
}

if (isset($_POST['login'])) {
    $userEmail = mysqli_real_escape_string($DataBase, $_POST['email']);
    if (empty($userEmail)) {
        array_push($errorListVar, "Email is required");
    }
    else {
        resumeExperiment();
    }
}

if (isset($_POST['endExperiment'])) {
    endExperiment();
}

if (isset($_POST['registration'])) {
    registration();
}

if (isset($_POST['startNewExperiment'])) {
    beginExperiment();
}

function generateArrays(){
    global $DataBase, $sequenceArray, $classifiedTextsArrayASSOCIATIVE, $classifiedTextsArray, $UNclassifiedTextsArray;
    $sequenceArray = explode (",", mysqli_fetch_assoc(mysqli_query($DataBase,"SELECT variant FROM variants WHERE variant_id='".$_SESSION['variant']."'"))['variant']);
    $classifiedTextsArrayASSOCIATIVE = mysqli_fetch_assoc(mysqli_query($DataBase,"SELECT * FROM result WHERE subject_id='".$_SESSION['user']."' AND finished = 0"));//getting the result from all the groups
    $classifiedTextsArray = explode(",", $classifiedTextsArrayASSOCIATIVE['group1'] . $classifiedTextsArrayASSOCIATIVE['group2'] . $classifiedTextsArrayASSOCIATIVE['group3'] . $classifiedTextsArrayASSOCIATIVE['group4'] . $classifiedTextsArrayASSOCIATIVE['group5']);//transforming the result from the upper query to array
    $UNclassifiedTextsArray = array_diff($sequenceArray, $classifiedTextsArray);
}

function dataBaseConnection()
{
    $db = mysqli_connect('localhost', 'root', '', 'experimentdatabase');
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $db;
}

function checkForExistence($db, $query)
{
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        return true;
    }
    return false;
}

function getTextS($id)
{
    global $DataBase;
    $res = mysqli_query($DataBase, "SELECT text FROM texts WHERE id_text='$id'");
    return mysqli_fetch_assoc($res)['text'];
}

function isLoggedIn()
{
    if (!isset($_SESSION['user'])) {
        header('location: login.php');
    }
}

function logout()
{
    unset($_SESSION['user']);
    unset($_SESSION['variant']);
    session_destroy();
    header('location: login.php');
    exit();
}

function updateDatabaseOnDrop()
{
    global $DataBase;
    $text_id = $_POST['text_id'];
    $box_id = $_POST['box_id'];
    //$box_id = "group3 from group1";
    //$box_id = "remove group3";
    //$box_id = "group1";
    //$text_id = "1";
    $u = $_SESSION['user'];
    $query = "";

    if (strpos($box_id, 'from')) {
        $to = substr($box_id, 0, 6);
        $from = substr($box_id, 12, 6);
        $cells = mysqli_fetch_assoc(mysqli_query($DataBase, "SELECT * FROM result WHERE subject_id='$u' AND finished = 0"));
        $remove = str_replace("$text_id,", "", $cells[$from]);
        $query = "UPDATE result SET $from = '$remove' WHERE subject_id = '$u'";
        if ($cells[$to] != null) {
            $textTmp = $cells[$to] . $text_id . ",";
        } else {
            $textTmp = $text_id . ",";
        }
        mysqli_query($DataBase, "UPDATE result SET $to = '$textTmp' WHERE subject_id = '$u' AND finished = 0");

    } elseif (strpos($box_id, 'remove') !== false) {
        $tmpGroupToBeRemoved = substr($box_id, 7, 6);
        $str = mysqli_fetch_assoc(mysqli_query($DataBase, "SELECT * FROM result WHERE subject_id='$u' AND finished = 0"))[$tmpGroupToBeRemoved];
        $str = str_replace("$text_id,", "", $str);
        $query = "UPDATE result SET $tmpGroupToBeRemoved = '$str' WHERE subject_id = '$u' AND finished = 0";
    } else {
        $currentlyAvailableInCellquery = mysqli_fetch_assoc(mysqli_query($DataBase, "SELECT * FROM result WHERE subject_id='$u' AND finished = 0"));
        if ($currentlyAvailableInCellquery[$box_id] != null) {
            $textTmp = $currentlyAvailableInCellquery[$box_id] . $text_id . ",";
        } else {
            $textTmp = $text_id . ",";
        }
        $query = "UPDATE result SET $box_id = '$textTmp' WHERE subject_id = '$u'";
    }
    mysqli_query($DataBase, $query);
    mysqli_query($DataBase, "UPDATE result SET date_last_modified = CURRENT_TIMESTAMP WHERE subject_id = '$u'");
    mysqli_query($DataBase, "UPDATE userchosenvariants SET date_last_modified = CURRENT_TIMESTAMP WHERE subject_id = '$u'");
}

function resumeExperiment()
{
    global $DataBase, $errorListVar;
    //check if its resumed
    $user = mysqli_real_escape_string($DataBase, $_POST['email']);
    if(checkForExistence($DataBase, "SELECT email FROM subject WHERE email='$user'") == false){
        array_push($errorListVar, "You don't have a registration");
    }
    else {
        //generateArrays();
        $_SESSION['user'] = $user;
        $variant = mysqli_fetch_assoc(mysqli_query($DataBase, "SELECT * FROM result WHERE subject_id ='$user' AND finished = 0"))['user_variant_id'];
        $_SESSION['variant'] = $variant;

        if (mysqli_query($DataBase, "SELECT finished FROM result WHERE subject_id ='$user'") == 0) {
            header('location: endOfExperiment.php');
        } else {
            header('location: resumeExperiment.php');
        }
    }
}

function isTextClassified($textId){
    global $sequenceArray, $classifiedTextsArray;
    if (in_array($sequenceArray[$textId], $classifiedTextsArray)) {
        $isDragable = "style = \"opacity:0.5\" draggable=\"false\"";
    } else {
        $isDragable = "draggable=\"true\"";
    }
    return $isDragable;
}

function placeClassifiedTextInBox($box)
{
    global $classifiedTextsArrayASSOCIATIVE;
    $arrOfClassifiedTextsInGroup = explode(",", $box);
    foreach ($arrOfClassifiedTextsInGroup as $id) {
        $text = substr(getTextS($id), 0, 15);
        if ($text) {
            echo "<p>" . $text . "..." . "</p>";
        }
    }
}

function registration()
{
    global $DataBase, $userEmail, $userSex, $userNativeSpeaker, $errorListVar, $sequenceArray;

    //Get the values from the fields
    $userEmail = mysqli_real_escape_string($DataBase, $_POST['email']);
    $userSex = mysqli_real_escape_string($DataBase, $_POST['sex']);
    $userNativeSpeaker = mysqli_real_escape_string($DataBase, $_POST['nativeSpeaker']);
    $selfLevel = mysqli_real_escape_string($DataBase, $_POST['selfEvaluatedLevelOfEnglish']);
    $certifiedLevel = mysqli_real_escape_string($DataBase, $_POST['certifiedLevelOfEnglish']);
    if (empty($userEmail)) {
        array_push($errorListVar, "Email is required");
    }
    if (empty($userSex)) {
        array_push($errorListVar, "Sex is required");
    }
    if (empty($userNativeSpeaker)) {
        array_push($errorListVar, "Native language is required");
    }
    if (empty($selfLevel)) {
        array_push($errorListVar, "Self evaluated level of English is required");
    }
    if (empty($certifiedLevel)) {
        array_push($errorListVar, "Certified level of English is required");
    }
    $sql_q_emailExistence = "SELECT email FROM subject WHERE email='$userEmail'";
    if (checkForExistence($DataBase, $sql_q_emailExistence)) {
        array_push($errorListVar, "Email is already taken!");
    }
    if (count($errorListVar) == 0) {
        $DBRegQuery = "INSERT INTO subject (email, sex, native_speaker_of, level_of_english-self_evaluation, level_of_english-certified_evaluation) VALUES('$userEmail', '$userSex', '$userNativeSpeaker', '$selfLevel', '$certifiedLevel')";
        mysqli_query($DataBase, $DBRegQuery);
        $_SESSION['user'] = $userEmail;
        beginExperiment();
    }
}

function beginExperiment(){

    global $DataBase;
    $variant = mysqli_fetch_assoc(mysqli_query($DataBase, "SELECT next_variant FROM nextvarianttable"))['next_variant'];
    mysqli_query($DataBase, "INSERT INTO userchosenvariants (subject_id, variant_id) VALUES('" . $_SESSION['user'] . "', '$variant')");
    $_SESSION['variant'] = $variant;
    $resultTableQuery = "INSERT INTO result (user_variant_id, subject_id, start_date, date_last_modified) VALUES('$variant', '" . $_SESSION['user'] . "', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
    mysqli_query($DataBase, $resultTableQuery);
    //Rolling over 1
    if ($variant == 101) {
        mysqli_query($DataBase, "UPDATE nextvarianttable SET next_variant = 1");
    } else {
        mysqli_query($DataBase, "UPDATE nextvarianttable SET next_variant = next_variant + 1");
    }
    header('location: experiment.php');
}

function endExperiment() {
    global $DataBase, $UNclassifiedTextsArray;
    generateArrays();
    if (sizeof($UNclassifiedTextsArray) == 0) {
        mysqli_query($DataBase, "UPDATE result SET end_date = CURRENT_TIMESTAMP, finished = 1 WHERE subject_id='" . $_SESSION['user'] . "'");
        mysqli_query($DataBase, "UPDATE userchosenvariants SET date_finished = VALUES(CURRENT_TIMESTAMP)");
        header('location: endOfExperiment.php');
    } else {
        echo "<script type='text/javascript'>alert('Please, classify all the texts!');</script>";
    }
}

