<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed | Grit & Glow</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="modern.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            background: var(--bg-alt);
        }
        .success-card {
            background: white;
            padding: 4rem;
            border-radius: 24px;
            box-shadow: var(--shadow);
            text-align: center;
            max-width: 500px;
            animation: fadeIn 0.6s ease-out;
        }
        .icon-check {
            width: 80px;
            height: 80px;
            background: #dcfce7;
            color: #16a34a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin: 0 auto 2rem;
        }
        .order-ref {
            background: var(--bg-alt);
            padding: 1rem;
            border-radius: 12px;
            font-family: monospace;
            font-weight: 700;
            font-size: 1.2rem;
            letter-spacing: 1px;
            margin: 1.5rem 0;
        }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="icon-check">✓</div>
        <h1 style="font-size: 2rem; margin-bottom: 1rem;">Order Placed!</h1>
        <p style="color: var(--text-secondary); margin-bottom: 2rem;">
            Thank you for shopping with us. Your order has been confirmed and is being processed.
        </p>
        
        <div class="order-ref">
            #GG-<?php echo strtoupper(bin2hex(random_bytes(4))); ?>
        </div>

        <a href="productfatch.php" class="buy-now" style="display: inline-block; text-decoration: none;">Continue Shopping</a>
    </div>
</body>
</html>