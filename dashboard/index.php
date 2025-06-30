<?php

session_start();

if (!isset($_SESSION['role'])) {
   header("Location: ../");
   exit();
}

 if ($_SESSION['role'] == 'adm') {
    header("Location: ./adm/");
    exit();
 } elseif ($_SESSION['role'] == 'pf') {
    header("Location: ./pf/");
    exit();
 } else {
    header("Location: ./aluno/");
    exit();
 }
 