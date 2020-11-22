<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'todo') or die(mysqli_error($mysqli));
$id = 0;
$update = false;
$task = ''; //leeren


if (isset($_POST['save'])){
   
    $task = $_POST['task'];

    $mysqli->query("INSERT INTO tasks (task) VALUES ('$task')") or 
    die($mysqli->error);

     $_SESSION['message'] = "Notiz wurde gespeichert";
     $_SESSION['msg_type'] ='success';

     header("location: index.php");
}


if (isset($_GET['delete'])){

    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM tasks WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = 'Notiz wurde gelöscht';
    $_SESSION['msg_type'] = "danger";


    header("location: index.php");

}


if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM tasks WHERE id=$id") or die ($mysqli->error);
    if ($result->num_rows){
        $row = $result->fetch_array();
        //$name = $row['name'];
        $id = $row['id']; //nicht benötigt
        $task = $row['task'];
    }
}


if (isset($_POST['update'])){
    $id = $_POST['id'];
    $task = $_POST['task'];

    $mysqli->query("UPDATE tasks SET task='$task' WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Notiz wurde aktualisiert!";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}