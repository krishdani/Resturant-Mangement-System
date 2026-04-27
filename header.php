<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="modern.css">
    <style>
        /* Small fixes for the specific header layout */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 300px;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.1);
            padding: 15px;
            z-index: 100;
            border-radius: 12px;
            gap: 20px;
            top: 100%;
        }

        .dropdown-container:hover .dropdown-content {
            display: flex;
        }

        .dropdown-content a {
            padding: 8px 12px;
            text-decoration: none;
            color: #333;
            border-radius: 6px;
            transition: background 0.2s;
        }

        .dropdown-content a:hover {
            background-color: #f1f5f9;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav {
            display: flex;
            align-items: center;
        }

        .nav > a, .dropdown-container > a {
            margin: 0 15px;
            text-decoration: none;
            position: relative;
            cursor: pointer;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .cart {
            background: #f1f5f9;
            padding: 8px 15px;
            border-radius: 20px;
            transition: all 0.2s;
        }

        .cart:hover {
            background: #e2e8f0;
        }

        .cart a {
            text-decoration: none;
            color: #333;
            font-weight: 600;
        }
    </style>
</head>
<header class="header">
    <div class="logo">
        <a href="index.php"><img src="images/logo.png" alt="Grit & Glow"></a>
    </div>
    <nav class="nav">
        <a href="index.php">Home</a>
        <div class="dropdown-container">
            <a>Products</a>
            <div class="dropdown-content">
                <div class="left-menu">
                    <a href="productfatch.php#best-seller">Best Seller</a>
                    <a href="productfatch.php#trending">Trending</a>
                    <a href="productfatch.php#popular">Popular</a>
                </div>
                <div class="right-menu">
                    <a href="Sunscreen.php">Sunscreen</a>
                    <a href="facewash.php">FaceWash</a>
                    <a href="facescrub.php">FaceScrub</a>
                    <a href="faceserum.php">FaceSerum</a>
                    <a href="facemask.php">FaceMask</a>
                </div>
            </div>
        </div>
        <a href="contact.php">Contact</a>
        <a href="faqhome.php">Help</a>
        <a href="aboutus.php">About Us</a>
    </nav>
    <div class="actions">
        <input type="text" id="searchBox" placeholder="Search products..." />
        <div class="cart">
            <a href="cart.php">🛒 Cart <span id="cart-count">0</span></a>
        </div>
    </div>
</header>

<script>
function updateCartCount() {
    fetch('cart_count.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('cart-count').textContent = data.count || 0;
        })
        .catch(() => {
            // Fallback to localStorage if server fails or for guest checkout preview
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            document.getElementById('cart-count').textContent = cart.length;
        });
}
document.addEventListener('DOMContentLoaded', updateCartCount);
</script>
</html>