<?php
include 'header.php';

if (!isset($_SESSION)) { 
	session_start();
    }
     
    if (isset($_GET['act']) && isset($_GET['ref'])) {
        $act = $_GET['act'];
        $ref = $_GET['ref'];
             
        if ($act == "add") {
            if(isset($_GET['rute_id'])){
                $_SESSION['rute_id'] = $_GET['rute_id'];
            }
            // if (isset($_GET['rute_id'])) {
            //     $rute_id = $_GET['rute_id'];
            //     if (isset($_SESSION['items'][$rute_id])) {
            //         $_SESSION['items'][$rute_id] += 1; //ini ya gan jangan lupe
            //     } else {
            //         $_SESSION['items'][$rute_id] = $_SESSION['jml_penumpang']; 
            //     }
            // }
        } elseif ($act == "plus") {
            if (isset($_GET['rute_id'])) {
                $rute_id = $_GET['rute_id'];
                if (isset($_SESSION['items'][$rute_id])) {
                    $_SESSION['items'][$rute_id] += 1;
                }
            }
        } elseif ($act == "min") {
            if (isset($_GET['rute_id'])) {
                $rute_id = $_GET['rute_id'];
                if (isset($_SESSION['items'][$rute_id])) {
                    $_SESSION['items'][$rute_id] -= 1;
                }
            }
        } elseif ($act == "del") {
            if (isset($_GET['rute_id'])) {
                $rute_id = $_GET['rute_id'];
                if (isset($_SESSION['items'][$rute_id])) {
                    unset($_SESSION['items'][$rute_id]);
                }
            }
        } elseif ($act == "clear") {
            if (isset($_SESSION['items'])) {
                foreach ($_SESSION['items'] as $key => $val) {
                    unset($_SESSION['items'][$key]);
                }
                unset($_SESSION['items']);
            }
        } 

        echo "<script> window.location.href='".$ref."';</script>";
    }
?> 