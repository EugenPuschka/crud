<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="jquery-3.5.1.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>CRUD</title>
</head>
<body>

    <?php require_once 'process.php'; ?>

    

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <php?
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
        </div>
    <?php endif ?>
    <div class="container">
    <?php
  
        $mysqli = new mysqli('localhost', 'root', '', 'todo') or die(mysqli_error($mysqli));

        $result = $mysqli->query("SELECT * FROM tasks") or die($mysqli->error);
       //$result->fetch_assoc(); mit while Schleife
       // pre_r($result);

        // function pre_r( $array){
        //     echo '<pre>';
        //     print_r($array);
        //     echo '</pre>';
        // }
        
     ?>

        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>To-DO</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
         <?php   
            while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['task']; ?></td>
                <td>
                    <a href="index.php?edit=<?php echo $row['id'] ?>"
                        class="btn btn-info">Edit</a>
                    <a href="process.php?delete=<?php echo $row['id'] ?>"
                        class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
           </table>
        </div>
        </div>
        




    


    <div class="row justify-content-center">
    <form action="process.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>"
    <div class="form-group">
    <label>Notiz</label>
    <input type="text" name="task" class="form-control" 
    value="<?php echo $task; ?>" placeholder="Gib deine Notiz ein"> <!-- //placeholder aus value -->
    </div>
    <div class="form-group">
    <?php 
    if ($update == true):
    ?>
            <button type="submit" class="btn btn-info" name="update">Update</button>
    <?php else: ?>
            <button type="submit" class="btn btn-primary" name="save">Save</button>
    <?php endif; ?>
    </div>
    </form>
    </div>
    
</body>
</html>



https://www.youtube.com/watch?v=3xRMUDC74Cw 24:16