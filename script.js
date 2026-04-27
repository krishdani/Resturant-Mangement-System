// Cart Counter
let cartCount = 0;
const cartCountEl = document.getElementById('cart-count');
const addToCartBtns = document.querySelectorAll('.add-to-cart');

addToCartBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    cartCount++;
    cartCountEl.textContent = cartCount;
    alert('Item added to cart!');
  });
});

// Search Bar
// SEARCH FUNCTION
const searchBox = document.getElementById('searchBox');
const productCards = document.querySelectorAll('.product-card');

searchBox.addEventListener('keyup', function(e) {
  const searchText = e.target.value.toLowerCase();

  productCards.forEach(card => {
    const title = card.getAttribute('data-title').toLowerCase();

    if (title.includes(searchText)) {
      card.style.display = 'block';
    } else {
      card.style.display = 'none';
    }
  });
});


const productGrid = document.getElementById('product');
const leftBtn = document.querySelector('.left-btn');
const rightBtn = document.querySelector('.right-btn');

rightBtn.addEventListener('click', () => {
  productGrid.scrollBy({ left: 300, behavior: 'smooth' });
});

leftBtn.addEventListener('click', () => {
  productGrid.scrollBy({ left: -300, behavior: 'smooth' });
});

