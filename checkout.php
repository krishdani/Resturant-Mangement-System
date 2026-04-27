<?php
session_start();
require_once 'db.php';

$user_id = $_SESSION['user_id'] ?? 1;

// Fetch cart items for the summary using prepared statements
$cartItems = [];
$total = 0;
$cartStmt = $conn->prepare("
    SELECT cart.*, products.name, products.image, products.discount as price 
    FROM cart 
    JOIN products ON cart.product_id = products.id 
    WHERE cart.user_id = ?");
$cartStmt->bind_param("i", $user_id);
$cartStmt->execute();
$result = $cartStmt->get_result();

while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
    $total += $row['price'] * $row['quantity'];
}

// Redirect if cart is empty and not a POST request
if (empty($cartItems) && $_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: cart.php");
    exit();
}

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $payment_method = $_POST['payment_method'];
    
    $status = ($payment_method == 'COD') ? 'Pending' : 'Completed';

    // Securely insert order using prepared statement - Fixed column names
    $insertStmt = $conn->prepare("
        INSERT INTO orders (name, user_id, user_email, total, payment_mode, status, address, city, state, zip, phone) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $insertStmt->bind_param("sisdsssssss", $name, $user_id, $email, $total, $payment_method, $status, $address, $city, $state, $zip, $phone);
    
    if ($insertStmt->execute()) {
        // Clear cart securely
        $clearStmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $clearStmt->bind_param("i", $user_id);
        $clearStmt->execute();
        
        header("Location: success.php?order=success");
        exit();
    } else {
        $error = "Order placement failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Grit & Glow</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        :root {
            --primary: #111111;
            --primary-hover: #333333;
            --accent: #27ae60;
            --bg: #f8f9fa;
            --card-bg: #ffffff;
            --border: #e1e4e8;
            --text-main: #1a1a1a;
            --text-muted: #666666;
            --shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg);
            color: var(--text-main);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .checkout-header {
            background: white;
            padding: 20px 0;
            border-bottom: 1px solid var(--border);
            text-align: center;
            margin-bottom: 40px;
        }

        .checkout-header h1 {
            margin: 0;
            font-size: 24px;
            letter-spacing: -0.5px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px 60px;
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 40px;
        }

        @media (max-width: 900px) {
            .container {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 32px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title span {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-muted);
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"] {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.2s;
            background: #fafafa;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(0,0,0,0.05);
        }

        /* Payment Option Styling */
        .payment-options {
            display: grid;
            gap: 16px;
            margin-top: 20px;
        }

        .payment-option {
            position: relative;
            cursor: pointer;
        }

        .payment-option input {
            position: absolute;
            opacity: 0;
        }

        .payment-content {
            display: flex;
            align-items: center;
            padding: 20px;
            border: 2px solid var(--border);
            border-radius: 12px;
            transition: all 0.2s;
        }

        .payment-option input:checked + .payment-content {
            border-color: var(--primary);
            background: #fdfdfd;
        }

        .payment-option:hover .payment-content {
            border-color: #bbb;
        }

        .payment-icon {
            width: 40px;
            height: 40px;
            background: #f0f0f0;
            border-radius: 8px;
            margin-right: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .payment-details b {
            display: block;
            margin-bottom: 2px;
        }

        .payment-details span {
            font-size: 13px;
            color: var(--text-muted);
        }

        /* Summary Sidebar */
        .summary-card {
            position: sticky;
            top: 20px;
        }

        .order-items {
            margin-bottom: 24px;
        }

        .item {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f0f0f0;
        }

        .item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            background: #eee;
        }

        .item-info {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .item-price {
            font-size: 13px;
            color: var(--text-muted);
        }

        .totals {
            margin-top: 24px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .total-row.grand-total {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 2px solid var(--border);
            font-size: 20px;
            font-weight: 800;
        }

        .place-order-btn {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 18px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s, background 0.2s;
            margin-top: 24px;
        }

        .place-order-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        .place-order-btn:active {
            transform: translateY(0);
        }

        .badge {
            background: #eef2ff;
            color: #4f46e5;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            margin-left: 8px;
        }
    </style>
</head>
<body>

<header class="checkout-header">
    <h1>GRIT & GLOW</h1>
</header>

<div class="container">
    <!-- Left Column: Forms -->
    <div class="checkout-main">
        <form id="main-checkout-form" method="POST">
            <div class="card" style="margin-bottom: 30px;">
                <div class="section-title"><span>1</span> Shipping Information</div>
                
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter your full name" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" id="email" placeholder="email@example.com" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" name="phone" id="phone" placeholder="+91 00000 00000" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Street Address</label>
                    <input type="text" name="address" id="address" placeholder="House No, Street, Locality" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" id="city" placeholder="City" required>
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <input type="text" name="state" id="state" placeholder="State" required>
                    </div>
                    <div class="form-group">
                        <label>ZIP Code</label>
                        <input type="text" name="zip" id="zip" placeholder="000000" required>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="section-title"><span>2</span> Payment Method</div>
                
                <div class="payment-options">
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="Online" checked>
                        <div class="payment-content">
                            <div class="payment-icon">💳</div>
                            <div class="payment-details">
                                <b>Online Payment</b>
                                <span>Credit/Debit Card, UPI, Netbanking</span>
                            </div>
                        </div>
                    </label>

                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="COD">
                        <div class="payment-content">
                            <div class="payment-icon">💵</div>
                            <div class="payment-details">
                                <b>Cash on Delivery <span class="badge">SECURE</span></b>
                                <span>Pay when you receive your order</span>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <input type="hidden" name="place_order" value="1">
        </form>
    </div>

    <!-- Right Column: Summary -->
    <div class="checkout-sidebar">
        <div class="card summary-card">
            <h2 style="margin-top:0; font-size: 18px;">Order Summary</h2>
            
            <div class="order-items">
                <?php foreach ($cartItems as $item): ?>
                <div class="item">
                    <img src="images/<?= $item['image'] ?>" alt="<?= $item['name'] ?>">
                    <div class="item-info">
                        <div class="item-name"><?= $item['name'] ?></div>
                        <div class="item-price">Qty: <?= $item['quantity'] ?> • ₹<?= number_format($item['price'], 2) ?></div>
                    </div>
                    <div style="font-weight: 600;">₹<?= number_format($item['price'] * $item['quantity'], 2) ?></div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="totals">
                <div class="total-row">
                    <span>Subtotal</span>
                    <span>₹<?= number_format($total, 2) ?></span>
                </div>
                <div class="total-row">
                    <span>Shipping</span>
                    <span style="color: var(--accent); font-weight: 600;">FREE</span>
                </div>
                <div class="total-row grand-total">
                    <span>Total</span>
                    <span>₹<?= number_format($total, 2) ?></span>
                </div>
            </div>

            <button type="button" class="place-order-btn" id="submit-btn">
                Complete Purchase
            </button>

            <p style="text-align: center; font-size: 12px; color: var(--text-muted); margin-top: 20px;">
                Secure 256-bit SSL encrypted checkout
            </p>
        </div>
    </div>
</div>

<script>
    document.getElementById('submit-btn').onclick = function(e) {
        const form = document.getElementById('main-checkout-form');
        const paymentMethod = form.querySelector('input[name="payment_method"]:checked').value;
        
        // Basic validation
        const requiredFields = ['name', 'email', 'phone', 'address', 'city', 'state', 'zip'];
        for (let fieldId of requiredFields) {
            if (!document.getElementById(fieldId).value) {
                alert('Please fill all shipping details');
                document.getElementById(fieldId).focus();
                return;
            }
        }

        if (paymentMethod === 'COD') {
            // If COD, just submit the form
            form.submit();
        } else {
            // If Online, trigger Razorpay
            triggerRazorpay();
        }
    };

    function triggerRazorpay() {
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        
        const options = {
            "key": "rzp_test_pOv2e90sis9lma", // Test key from user's original code
            "amount": <?= $total * 100 ?>,
            "currency": "INR",
            "name": "Grit & Glow",
            "description": "Store Purchase",
            "handler": function (response) {
                // On success, we can either submit the form or redirect
                // I'll add the razorpay_id to the form and submit it
                const form = document.getElementById('main-checkout-form');
                const rzpInput = document.createElement('input');
                rzpInput.type = 'hidden';
                rzpInput.name = 'razorpay_payment_id';
                rzpInput.value = response.razorpay_payment_id;
                form.appendChild(rzpInput);
                form.submit();
            },
            "prefill": {
                "name": name,
                "email": email,
                "contact": phone
            },
            "theme": {
                "color": "#111111"
            }
        };
        const rzp = new Razorpay(options);
        rzp.open();
    }
</script>

</body>
</html>