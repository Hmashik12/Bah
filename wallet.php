<?php
// Environment Variables (Render/Railway/Github Secrets এ সেট করবে)
$PRIVATE_KEY = getenv("PRIVATE_KEY");
$PUBLIC_ADDRESS = getenv("PUBLIC_ADDRESS");
$BSC_RPC = getenv("BSC_RPC");

function getBNBBalance() {
    global $PUBLIC_ADDRESS, $BSC_RPC;

    $data = [
        "jsonrpc"=>"2.0",
        "method"=>"eth_getBalance",
        "params"=>[$PUBLIC_ADDRESS, "latest"],
        "id"=>1
    ];

    $ch = curl_init($BSC_RPC);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    if (!isset($result['result'])) {
        return "Error";
    }

    $wei = hexdec($result['result']);
    $bnb = $wei / 1e18;
    return $bnb;
}

if (isset($_POST['send'])) {
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    // ⚠️ এখানে আসল transaction send করার জন্য Web3 signer দরকার
    // PHP তে direct implement risky + জটিল
    // এখন শুধু demo message দেখাচ্ছে
    echo "🚧 Transaction to $to for $amount BNB (Signing not implemented in demo)";
}