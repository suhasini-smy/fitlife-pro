document.addEventListener('DOMContentLoaded', () => {

  // Add to Cart via AJAX
  document.querySelectorAll('form[action="/cart/add"]').forEach(form => {

    form.addEventListener('submit', async e => {
      e.preventDefault();

      const formData = new FormData(form);

      await fetch('/cart/add.js', {
        method: 'POST',
        body: formData
      });

      openCartDrawer();
      loadCart();
    });

  });

  document.querySelector('.close-cart')?.addEventListener('click', () => {
    document.getElementById('CartDrawer').classList.remove('active');
  });

});


function openCartDrawer() {
  document.getElementById('CartDrawer').classList.add('active');
}


async function loadCart() {

  const cart = await fetch('/cart.js').then(r => r.json());

  let html = '';

  cart.items.forEach(item => {

    html += `
      <div class="cart-item">
        <p>${item.product_title}</p>
        <p>${Shopify.formatMoney(item.final_price)}</p>
      </div>
    `;
  });

  document.getElementById('CartDrawerItems').innerHTML = html;

  updateShippingProgress(cart);
  showUpsell(cart);
}


function updateShippingProgress(cart) {

  const freeShippingThreshold = 10000; // ₹100

  const total = cart.total_price;

  const remaining = freeShippingThreshold - total;

  const percent = Math.min(
    (total / freeShippingThreshold) * 100,
    100
  );

  document.getElementById('shipping-progress-bar').value = percent;

  document.getElementById('shipping-message').innerHTML =
    remaining > 0
      ? `Spend ₹${(remaining / 100).toFixed(2)} more for Free Shipping`
      : `🎉 Congratulations! You unlocked Free Shipping`;
}


function showUpsell(cart) {

  if (!cart.items.length) return;

  const firstItem = cart.items[0];

  document.getElementById('cart-upsell').innerHTML = `
      <h3>You may also like</h3>
      <p>Complete your look with premium FitWear accessories.</p>
  `;
}