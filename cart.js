document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        let formData = new FormData(this.closest('form'));

        fetch('add_to_cart.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert('Item added to cart!');
        })
        .catch(error => console.error('Error:', error));
    });
});
