<?php
require_once "../backend/wallet.php";

// get balance
$balance = getBNBBalance();
?>

<!DOCTYPE html>
<html>
<head>
  <title>BNB Wallet</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>💳 BNB Wallet</h2>
    <p><strong>Balance:</strong> <?php echo $balance; ?> BNB</p>

    <form action="../backend/wallet.php" method="POST">
      <input type="text" name="to" placeholder="Receiver Address" required>
      <input type="text" name="amount" placeholder="Amount (BNB)" required>
      <button type="submit" name="send">Send BNB</button>
    </form>
  </div>
</body>
</html>