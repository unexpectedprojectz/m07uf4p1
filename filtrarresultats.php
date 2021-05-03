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

    $stmtmostrar = $conn->selectAll();

    if(isset($_POST['opcio'])) {

        if($_POST['opcio'] == "Tots") {
            $stmtmostrar = $conn->selectAll();
        }

        else {
            if($_POST['opcio'] == "Maquina"){
                $stmtmostrar = $conn->selectByModalitat("Maquina");
            }
            else {
                $stmtmostrar = $conn->selectByModalitat("Huma");
            }
        }

        $output = "";

        while($row = $stmtmostrar->fetch(PDO::FETCH_ASSOC)) {
            $output .= 
            '<tr>
                <td>' . $row['modalitat'] . '</td>
                <td>' . $row['nivell'] . '</td>
                <td>' . $row['data_partida'] . '</td>
                <td>' . $row['intents'] . '</td>
                <td>
                    <a href="./modificarestadistiques.php?idModificar=' . $row['id'] . '" class="btn btn-secondary">
                        <i class="fas fa-marker"></i>
                    </a>
                    <a href="./resultats.php?idEliminar=' . $row['id'] . '" class="btn btn-danger">
                        <i class="far fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
            ';
        }
        
        echo $output;

    }

        
    

?>