<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Record Form</title>
</head>
<body>
<form action="insert.php" method="post">
    <p>
        <label for="DEPTNO">Department Number:</label>
        <input type="text" name="DEPTNO" id="DEPTNO">
    </p>
    <p>
        <label for="DNAME">Department name:</label>
        <input type="text" name="DNAME" id="DNAME">
    </p>
    <p>
        <label for="LOC">Location:</label>
        <input type="text" name="LOC" id="LOC">
    </p>
    <input type="submit" value="Submit">
</form>
</body>
</html>
<?php

$link = new PDO("mysql:host=localhost;dbname=assignment 2", 'root', 1234);
 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());

if ($pdo -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysql -> connect_error;
        exit();
}}
$DEPTNO = $pdo -> real_escape_string($_POST['DEPTNO']);
$DNAME = $pdo -> real_escape_string($_POST['DNAME']);
$LOC = $pdo -> real_escape_string($_POST['LOC']);
 

$sql = "INSERT INTO persons (DEPTNO, DNAME, LOC) VALUES ('$DEPTNO', '$DNAME', '$LOC')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
mysqli_close($link);
?>