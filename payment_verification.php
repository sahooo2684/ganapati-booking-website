<?php
require('vendor/autoload.php');
use Razorpay\Api\Api;

$api = new Api($apiKey, $apiSecret);

// Retrieve POST data from Razorpay
$payment_id = $_POST['razorpay_payment_id'];
$order_id = $_POST['razorpay_order_id'];
$signature = $_POST['razorpay_signature'];

// Verify payment signature
$attributes = [
    'razorpay_order_id' => $order_id,
    'razorpay_payment_id' => $payment_id,
    'razorpay_signature' => $signature
];

try {
    $api->utility->verifyPaymentSignature($attributes);
    // Update order status in the database
    $conn->prepare("UPDATE orders SET order_status = 'Paid' WHERE order_number = :order_number")
        ->execute([':order_number' => $order_id]);
    echo "Payment successful";
} catch (Exception $e) {
    echo "Payment verification failed: " . $e->getMessage();
}
?>
