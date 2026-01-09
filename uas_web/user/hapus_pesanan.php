<?php
session_start();
include '../config/database.php';

$id = $_GET['id'];

$conn->prepare("DELETE FROM order_items WHERE order_id=?")->execute([$id]);

$conn->prepare("DELETE FROM orders WHERE id=?")->execute([$id]);

header("Location: pesanan.php");
