// document.getElementById('btn-withdraw').addEventListener('click', function() {
//     // Get the withdraw amount
//     const withdrawField = document.getElementById('withdraw-field');
//     const newWithdrawAmountString = withdrawField.value;
//     const newWithdrawAmount = parseFloat(newWithdrawAmountString);

//     if (isNaN(newWithdrawAmount) || newWithdrawAmount <= 0) {
//         alert('Please enter a valid withdrawal amount.');
//         return;
//     }

//     // Clear the withdraw field
//     withdrawField.value = '';

//     // Update withdraw total
//     const withdrawTotalElement = document.getElementById('withdraw-total');
//     const previousWithdrawTotalString = withdrawTotalElement.innerText;
//     const previousWithdrawTotal = parseFloat(previousWithdrawTotalString);
//     const withdrawTotal = previousWithdrawTotal + newWithdrawAmount;
//     withdrawTotalElement.innerText = withdrawTotal.toFixed(2);

//     // Update balance total
//     const balanceTotalElement = document.getElementById('balance-total');
//     const previousBalanceTotalString = balanceTotalElement.innerText;
//     const previousBalanceTotalAmount = parseFloat(previousBalanceTotalString);

//     if (newWithdrawAmount > previousBalanceTotalAmount) {
//         alert('Insufficient balance.');
//         return;
//     }

//     const newBalanceTotal = previousBalanceTotalAmount - newWithdrawAmount;
//     balanceTotalElement.innerText = newBalanceTotal.toFixed(2);
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
