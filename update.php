<?php
    require_once 'config.php';
    $resultado = false;
    if(!empty($_POST)){
        $id = $_POST['id'];
        $newName = $_POST['name'];
        $newEmail = $_POST['email'];

        $sql = "UPDATE users SET name=:name, email=:email WHERE id=:id";
        $query = $pdo->prepare($sql);
        $resultado = $query->execute([
            'id' => $id,
            'name' => $newName,
            'email' => $newEmail
        ]);

        $nameValue = $newName;
        $emailValue = $newEmail;
    }else{
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE id=:id";
        $query = $pdo->prepare($sql);
        $query->execute([
            'id' => $id
        ]);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $nameValue = $row['name'];
        $emailValue = $row['email'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <title>Databases</title>
</head>
<body>
    <div class="container">
        <h1>Update Users</h1>
        <a href="list.php">Back</a>
        <?php
            if($resultado){
                echo '<div class="alert alert-success">Tus datos han sido actualizados!</div>';
            }
        ?>
        <form action="update.php" method="post">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?php echo $nameValue; ?>">
            <br>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?php echo $emailValue; ?>">
            <br>
            <br>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" value="Enviar">
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>