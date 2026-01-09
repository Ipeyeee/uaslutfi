<?php
session_start();
include '../config/database.php';

$id = $_GET['id'];

$conn->prepare("UPDATE orders SET status_bayar='SUDAH BAYAR' WHERE id=?")
     ->execute([$id]);

header("Location: pesanan.php");
