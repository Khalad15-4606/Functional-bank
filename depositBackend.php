<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $depositAmount = floatval($_POST['depositBalance']);

    if ($depositAmount > 0) {
        $result = $conn->query("SELECT balance FROM balances WHERE id = 1");
        $currentBalance = $result->fetch_assoc()['balance'];
        $newBalance = $currentBalance + $depositAmount;

        $conn->query("UPDATE balances SET balance = $newBalance WHERE id = 1");
        $conn->query("INSERT INTO transactions (type, amount, balance) VALUES ('deposit', $depositAmount, $newBalance)");

        header("Location: index.php?success=Deposit successful");
    } else {
        header("Location: index.php?error=Invalid deposit amount");
    }
}
?>
