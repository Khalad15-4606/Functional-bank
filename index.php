<?php
// Include database configuration
include 'db_connect.php';

// Fetch balance, deposit total, and withdraw total from the database
$result = $conn->query("SELECT balance FROM balances WHERE id = 1");
$currentBalance = $result->fetch_assoc()['balance'];

$depositTotal = $conn->query("SELECT SUM(amount) as total FROM transactions WHERE type = 'deposit'")->fetch_assoc()['total'] ?: 0;
$withdrawTotal = $conn->query("SELECT SUM(amount) as total FROM transactions WHERE type = 'withdraw'")->fetch_assoc()['total'] ?: 0;
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Functional Bank</title>
    <link href="styles.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <header class="mx-auto w-11/12 my-3">
        <div class="navbar h text-black rounded-3xl">
            <div class="navbar-start">
              <a class="btn btn-ghost text-xl">Functional Deposit</a>
            </div>

            <div class="navbar-end">
            <a class="btn bg-slate-700 text-white px-10 rounded-full ml-3"
          href="./assets/omi-final-sp6.pdf"
        download="omi-final-sp6.pdf">
         SRS
        </a>


              <a class="btn bg-slate-700 text-white px-10 rounded-full" onclick="showBalanceModal()">Balance</a>
                <dialog id="my_modal_1" class="modal">
                    <div class="modal-box">
                        <h3 class="text-lg font-bold">Current Balance</h3>
                        <p class="py-4 font-extrabold text-2xl">Your balance is: $<span id="modal-balance"></span></p>
                        <div class="modal-action">
                            <button class="btn" onclick="closeModal()">Close</button>
                        </div>
                    </div>
                </dialog>
            </div>
          </div>
    </header>
    <main>
        <!-- Banner Section -->
        <div class="hero bg-[#FFFF] mx-auto w-11/12 min-h-screen">
            <div class="hero-content flex-col lg:flex-row-reverse">
              <img src="./assets/6617.jpg" class="w-[400px] h-[400px]" />
              <div>
                <h1 class="text-5xl font-extrabold">Functional Deposit</h1>
                <p class="py-6 w-9/12">
                  Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi.
                </p>
                <button class="btn bg-slate-700 text-white px-10 rounded-full"><a href="#transaction">Get Started</a></button>
              </div>
            </div>
        </div>

        <!-- Balance and Transaction Summary Section -->
        <section class="mt-8" id="transaction">
          <h1 class="text-5xl font-extrabold text-center my-10">Main Game</h1>
          <div class="grid grid-cols-3 gap-4 w-3/4 mx-auto text-white">
              <div class="bg-gradient-to-r from-green-600 to-cyan-400 p-8 rounded-lg">
                  <h4 class="text-2xl">Deposit</h4>
                  <h2 class="text-4xl font-medium">$<span id="deposit-total"><?php echo number_format($depositTotal, 2); ?></span></h2>
              </div>
              <div class="bg-gradient-to-r from-rose-400 to-red-500 p-8 rounded-lg">
                  <h4 class="text-2xl">Withdraw</h4>
                  <h2 class="text-4xl font-medium">$<span id="withdraw-total"><?php echo number_format($withdrawTotal, 2); ?></span></h2>
              </div>
              <div class="bg-gradient-to-r from-indigo-600 to-blue-500 p-8 rounded-lg">
                  <h4 class="text-2xl">Balance</h4>
                  <h2 class="text-4xl font-medium">$<span id="balance-total"><?php echo number_format($currentBalance, 2); ?></span></h2>
              </div>
          </div>
      </section>


        <section class="mt-10 w-9/12 mx-auto">
        <div class="grid grid-cols-2 gap-4">
            <!-- Deposit Section -->
            <div class="bg-gradient-to-r from-fuchsia-600 to-purple-600 p-8 rounded-lg">
                <h3 class="text-4xl mb-4 text-white font-semibold">Your Deposit</h3>
                <form action="depositBackend.php" method="POST">
                    <label for="deposit-field" class="text-white text-lg">Deposit Amount</label>
                    <input 
                        id="deposit-field" 
                        name="depositBalance" 
                        class="px-4 py-2 w-3/4 block rounded-lg mt-2" 
                        type="number" 
                        placeholder="$ Amount you want to deposit" 
                        required 
                    />
                    <button 
                        type="submit" 
                        class="mt-4 text-xl hover:bg-sky-700 font-medium text-white bg-orange-500 px-6 py-2 rounded-lg"
                        id="btn-deposit"
                    >
                        Deposit
                    </button>
                </form>
            </div>
            <!-- Withdraw Section -->
            <div class="bg-amber-400 p-8 rounded-lg">
                <h3 class="text-4xl mb-4 text-white font-semibold">Your Withdraw</h3>
                <form action="withdrawBackend.php" method="POST">
                    <label for="withdraw-field" class="text-white text-lg">Withdraw Amount</label>
                    <input 
                        id="withdraw-field" 
                        name="withdrawBalance" 
                        class="px-4 py-2 w-3/4 block rounded-lg mt-2" 
                        type="number" 
                        placeholder="$ Amount you want to withdraw" 
                        required 
                    />
                    <button 
                        type="submit" 
                        class="mt-4 text-xl hover:bg-sky-700 font-medium text-white bg-orange-500 px-6 py-2 rounded-lg"
                        id="btn-withdraw"
                    >
                        Withdraw
                    </button>
                </form>
            </div>
        </div>
    </section>


        <!-- Footer -->
        <footer class="footer bg-neutral text-neutral-content p-10 mt-12">
          <aside>
            <svg width="50" height="50" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" class="fill-current">
              <path d="M22.672 15.226l-2.432.811.841 2.515c.33 1.019-.209 2.127-1.23 2.456-1.15.325-2.148-.321-2.463-1.226l-.84-2.518-5.013 1.677.84 2.517c.391 1.203-.434 2.542-1.831 2.542-.88 0-1.601-.564-1.86-1.314l-.842-2.516-2.431.809c-1.135.328-2.145-.317-2.463-1.229-.329-1.018.211-2.127 1.231-2.456l2.432-.809-1.621-4.823-2.432.808c-1.355.384-2.558-.59-2.558-1.839 0-.817.509-1.582 1.327-1.846l2.433-.809-.842-2.515c-.33-1.02.211-2.129 1.232-2.458 1.02-.329 2.13.209 2.461 1.229l.842 2.515 5.011-1.677-.839-2.517c-.403-1.238.484-2.553 1.843-2.553.819 0 1.585.509 1.85 1.326l.841 2.517 2.431-.81c1.02-.33 2.131.211 2.461 1.229.332 1.018-.21 2.126-1.23 2.456l-2.433.809 1.622 4.823 2.433-.809c1.242-.401 2.557.484 2.557 1.838 0 .819-.51 1.583-1.328 1.847m-8.992-6.428l-5.01 1.675 1.619 4.828 5.011-1.674-1.62-4.829z"></path>
            </svg>
            <p>ACME Industries Ltd.<br />Providing reliable tech since 1992</p>
          </aside>
          <nav>
            <h6 class="footer-title">Social</h6>
            <div class="grid grid-flow-col gap-4">
              <a> <!-- Social icons here --></a>
            </div>
          </nav>
        </footer>
    </main>

   
    <script>
        function showBalanceModal() {
           
            const balanceAmount = document.getElementById("balance-total").innerText;

            
            document.getElementById("modal-balance").innerText = balanceAmount;

           
            document.getElementById("my_modal_1").showModal();
        }

        function closeModal() {
            document.getElementById("my_modal_1").close();
        }
    </script>
    <script src="./js/diposit.js"></script>
    <script src="./js/withdraw.js"></script>
</body>
</html>
