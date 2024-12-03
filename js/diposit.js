// document.getElementById('btn-deposit').addEventListener('click', function() {
//     // Get the deposit amount
//     const depositField = document.getElementById('deposit-field');
//     const newDepositAmountString = depositField.value;
//     const newDepositAmount = parseFloat(newDepositAmountString);

//     if (isNaN(newDepositAmount) || newDepositAmount <= 0) {
//         alert('Please enter a valid deposit amount.');
//         return;
//     }

//     // Update deposit total
//     const depositTotalElement = document.getElementById('deposit-total');
//     const previousDepositTotalString = depositTotalElement.innerText;
//     const previousDepositTotal = parseFloat(previousDepositTotalString);
//     const depositTotal = previousDepositTotal + newDepositAmount;
//     depositTotalElement.innerText = depositTotal.toFixed(2);

//     // Update balance total
//     const balanceTotalElement = document.getElementById('balance-total');
//     const previousBalanceTotalString = balanceTotalElement.innerText;
//     const previousBalanceTotalAmount = parseFloat(previousBalanceTotalString);
//     const newBalanceTotal = previousBalanceTotalAmount + newDepositAmount;
//     balanceTotalElement.innerText = newBalanceTotal.toFixed(2);

//     // Clear the deposit field
//     depositField.value = '';
// });

document.addEventListener("DOMContentLoaded", () => {
    fetch('./getBalance.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById("balance-total").innerText = data.balance.toFixed(2);
            document.getElementById("deposit-total").innerText = data.depositTotal.toFixed(2);
            document.getElementById("withdraw-total").innerText = data.withdrawTotal.toFixed(2);
        });
});
