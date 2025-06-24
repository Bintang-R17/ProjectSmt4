<?php

function checkRole($expectedRole) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $expectedRole) {
        header("Location: index.php?page=login");
        exit();
    }
}


?>