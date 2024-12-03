<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $withdrawAmount = floatval($_POST['withdrawBalance']);

    if ($withdrawAmount > 0) {
        $result = $conn->query("SELECT balance FROM balances WHERE id = 1");
        $currentBalance = $result->fetch_assoc()['balance'];

        if ($withdrawAmount <= $currentBalance) {
            $newBalance = $currentBalance - $withdrawAmount;

            $conn->query("UPDATE balances SET balance = $newBalance WHERE id = 1");
            $conn->query("INSERT INTO transactions (type, amount, balance) VALUES ('withdraw', $withdrawAmount, $newBalance)");

            header("Location: index.php?success=Withdraw successful");
        } else {
            header("Location: index.php?error=Insufficient balance");
        }
    } else {
        header("Location: index.php?error=Invalid withdraw amount");
    }
}
?>
