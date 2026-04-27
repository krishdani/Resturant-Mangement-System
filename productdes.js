function changeImage(element) {
  document.getElementById('mainImage').src = element.src;
}

function addToCart() {
  alert('Product added to cart!');
}

document.querySelectorAll(".size-btn").forEach(button => {
  button.addEventListener("click", function() {
      document.querySelectorAll(".size-btn").forEach(btn => btn.classList.remove("active"));
      this.classList.add("active");
  });
});