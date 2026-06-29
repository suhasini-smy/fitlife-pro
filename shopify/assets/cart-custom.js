
const FREE_SHIPPING_THRESHOLD = 10000;

function updateShippingProgress(cart) {
  if (!cart) return;

  const remaining = FREE_SHIPPING_THRESHOLD - cart.total_price;

  const percent = Math.min(
    (cart.total_price / FREE_SHIPPING_THRESHOLD) * 100,
    100
  );

  const bar = document.getElementById('shipping-progress-bar');
  const msg = document.getElementById('shipping-message');

  if (bar) bar.value = percent;

  if (msg) {
    msg.innerHTML =
      remaining > 0
        ? `Spend ₹${(remaining / 100).toFixed(2)} more for free shipping`
        : `🎉 You unlocked free shipping!`;
  }
}

async function getCart() {
  const res = await fetch('/cart.js');
  return await res.json();
}

document.addEventListener('DOMContentLoaded', () => {
  const drawer = document.querySelector('cart-drawer');

  if (!drawer) return;

  const originalOpen = drawer.open;

  drawer.open = async function (...args) {
    originalOpen.apply(this, args);

    const cart = await getCart();
    updateShippingProgress(cart);
  };
});