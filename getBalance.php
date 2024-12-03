<?php
include 'db_connect.php';

$result = $conn->query("SELECT balance FROM balances WHERE id = 1");
$currentBalance = $result->fetch_assoc()['balance'];

$deposits = $conn->query("SELECT SUM(amount) as total FROM transactions WHERE type = 'deposit'")->fetch_assoc()['total'];
$withdrawals = $conn->query("SELECT SUM(amount) as total FROM transactions WHERE type = 'withdraw'")->fetch_assoc()['total'];

echo json_encode([
    "balance" => $currentBalance,
    "depositTotal" => $deposits ?: 0,
    "withdrawTotal" => $withdrawals ?: 0
]);
?>
