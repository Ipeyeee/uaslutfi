<?php
include '../config/database.php';

$id     = $_POST['id'];
$status = $_POST['status'];

$conn->prepare("UPDATE orders SET status=? WHERE id=?")
     ->execute([$status, $id]);

header("Location: pesanan.php");
