document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener('click', (e) => {
        if (e.target.closest('.remove-from-cart')) {
            const btn = e.target.closest('.remove-from-cart');
            const id = btn.dataset.id;

            fetch(`/cart/remove/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.message, 'success');
                        btn.closest('tr').remove();

                        const cartCount = document.querySelector('#cart-count');
                        if (cartCount) cartCount.textContent = data.cartCount || 0;

                        const tableBody = document.querySelector('#cart-table tbody');
                        if (tableBody && tableBody.children.length === 0) {
                            const container = document.querySelector('#cart-container');
                            if (container) {
                                container.innerHTML = `
                                <h2 class="text-3xl font-bold mb-8">Carro de Compras</h2>
                                <p class="text-gray-600">Tu carro está vacío. <a href="/" class="text-blue-600 hover:underline">Ver
                                productos</a></p>
                            `;
                            }
                        }

                        showToast(data.message, 'success');

                        const cartCountEl = document.querySelector('#cart-count');
                        if (cartCountEl) {
                            if (data.cartCount > 0) {
                                cartCountEl.textContent = data.cartCount;
                                cartCountEl.classList.remove('hidden');
                            } else {
                                cartCountEl.textContent = '';
                                cartCountEl.classList.add('hidden'); // 🔹 esto oculta el badge
                            }
                        }

                        // 🔹 extra: si no hay productos, muestra mensaje de carrito vacío
                        if (data.cartCount === 0) {
                            const table = document.querySelector('#cart-table');
                            if (table) {
                                table.innerHTML = `<p class="text-center text-gray-500 mt-6">Tu carrito está vacío.</p>`;
                            }
                        }
                    } else {
                        showToast(data.message, 'error');
                    }
                })
                .catch(() => showToast('Ocurrió un error', 'error'));
        }
    });

    document.querySelectorAll('[id^="qty-"]').forEach(q => {
        const id = q.id.replace('qty-', '');
        const quantity = parseInt(q.textContent);
        const incBtn = document.querySelector(`.increase-qty[data-id="${id}"]`);
        const stockVal = incBtn ? parseInt(incBtn.dataset.stock) : 999;
        const decBtn = document.querySelector(`.decrease-qty[data-id="${id}"]`);

        if (decBtn) decBtn.disabled = quantity <= 1;
        if (incBtn) incBtn.disabled = quantity >= stockVal;
    });
});

document.addEventListener('click', (e) => {
    const dec = e.target.closest('.decrease-qty');
    const inc = e.target.closest('.increase-qty');

    if (dec) {
        const id = dec.dataset.id;
        const qtyEl = document.querySelector(`#qty-${id}`);
        let current = parseInt(qtyEl.textContent) || 1;

        if (current > 1) {
            updateQuantity(id, current - 1);
        } else {
            showToast('La cantidad mínima es 1', 'error');
        }
    }

    if (inc) {
        const id = inc.dataset.id;
        const stock = parseInt(inc.dataset.stock || '999');
        const qtyEl = document.querySelector(`#qty-${id}`);
        let current = parseInt(qtyEl.textContent) || 1;

        if (current < stock) {
            updateQuantity(id, current + 1, stock);
        } else {
            showToast('No puedes superar el stock disponible', 'error');
        }
    }
});

// función actualizar cantidad
function updateQuantity(id, quantity, stock = null) {
    fetch(`/cart/update/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: JSON.stringify({ quantity: quantity })
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // actualizar cantidad en la vista
                const qtyEl = document.querySelector(`#qty-${id}`);
                qtyEl.textContent = data.quantity;

                // actualizar subtotal del producto
                const row = qtyEl.closest('tr');
                if (row) {
                    row.querySelector('td:nth-child(4)').textContent =
                        `$${data.itemTotal.toLocaleString('es-CL')}`;
                }

                // actualizar total del carrito
                const cartTotalEl = document.querySelector('#cart-total');
                if (cartTotalEl) {
                    cartTotalEl.textContent = `$${data.cartTotal.toLocaleString('es-CL')}`;
                }

                // actualizar contador global
                const cartCountEl = document.querySelector('#cart-count');
                if (cartCountEl) {
                    if (data.cartCount > 0) {
                        cartCountEl.textContent = data.cartCount;
                        cartCountEl.classList.remove('hidden');
                    } else {
                        cartCountEl.textContent = '';
                        cartCountEl.classList.add('hidden');
                    }
                }

                // ───── DESHABILITAR BOTONES SEGÚN LÍMITES ─────
                const decBtn = document.querySelector(`.decrease-qty[data-id="${id}"]`);
                const incBtn = document.querySelector(`.increase-qty[data-id="${id}"]`);
                const stockVal = stock ?? parseInt(incBtn.dataset.stock);

                if (decBtn) decBtn.disabled = data.quantity <= 1;
                if (incBtn) incBtn.disabled = data.quantity >= stockVal;
            }
        });
}

