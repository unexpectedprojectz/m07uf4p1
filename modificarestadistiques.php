<?php

include 'partida.php';
include 'DatabasePDO.php';
include 'DatabaseOOP.php';
include 'DatabaseProc.php';

session_start();

// PDO
$conn = new DatabasePDO("localhost", "admin", "admin", "m07uf3");

// OOP
// $conn = new DatabaseOOP("localhost", "admin", "admin", "m07uf3");

// PROC
// $conn = new DatabaseProc("localhost", "admin", "admin", "m07uf3");

$conn->connect();

$id = "";

if(isset($_GET['idModificar'])) {
    $stmtmodificar = $conn->findById($_GET['idModificar']);

    // PDO
    $row = $stmtmodificar->fetch(PDO::FETCH_ASSOC);

    // OOP
    // $row = $stmtmodificar->fetch_assoc();
    // $stmtmodificar->close();
    
    // PROC
    // $row = mysqli_fetch_assoc($stmtmodificar);

    $id = $row['id'];
}

if(isset($_POST['btModificar'])) {
    $stmtmodificar = $conn->update($id, $_POST['modalitat'], $_POST['nivell'], $_POST['data'], $_POST['intents']);
    header("Location: resultats.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guess my number</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>

    <header class="container-fluid p-3 bg-secondary">
        <a href="index.php" class="btn shadow-none"><h3 class="text-white">Guess my number</h3></a>
    </header>
    <br><br>

    <div class="container">
        <h2 class="text-center">Editar estadística</h2><br><br>
        <div class="row">
            <div class="col">
                <div class="card m-auto" style="width: 50%;">
                    <div class="card-body">
                        <form method="POST">
                            Modalitat: <select class="form-control" name="modalitat">
                                <option <?php if($row['modalitat'] == 'Maquina') { echo 'selected'; } ?>>Maquina</option>
                                <option <?php if($row['modalitat'] == 'Huma') { echo 'selected'; } ?>>Huma</option>
                            </select>
                            Nivell: <input class="form-control" type="text" value="<?php echo $row['nivell']; ?>" name="nivell">
                            Data: <input class="form-control" type="text" value="<?php echo $row['data_partida']; ?>" name="data">
                            Intents: <input class="form-control" type="text" value="<?php echo $row['intents']; ?>" name="intents"><br>
                            <button class="btn btn-success d-flex m-auto" name="btModificar">Acceptar canvis</button>
                        </form>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</body>
</html>