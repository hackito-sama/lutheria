document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.add-to-cart').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            const name = btn.dataset.name;
            const price = parseFloat(btn.dataset.price);
            const image = btn.dataset.image;

            // Verificar si existe input de cantidad
            const qtyInput = document.querySelector(`#product-qty-${id}`);
            let quantity = 1; // default

            if (qtyInput) {
                quantity = parseInt(qtyInput.value) || 1;
                const stock = parseInt(qtyInput.max) || 999;

                // Limitar cantidad entre 1 y stock
                if (quantity < 1) quantity = 1;
                if (quantity > stock) quantity = stock;
                qtyInput.value = quantity; // reflejar cantidad ajustada
            }

            // Agregar al carrito vía fetch
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    id,
                    name,
                    price,
                    image,
                    quantity
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast(`Agregaste ${quantity} ${name} al carrito`, 'success');

                    // actualizar badge del carrito
                    const cartCountEl = document.querySelector('#cart-count');
                    if (cartCountEl) {
                        const cartCount = data.cartCount || 0;
                        if (cartCount > 0) {
                            cartCountEl.textContent = cartCount > 99 ? '99+' : cartCount;
                            cartCountEl.classList.remove('hidden');
                        } else {
                            cartCountEl.textContent = '';
                            cartCountEl.classList.add('hidden');
                        }
                    }
                } else {
                    showToast('No se pudo agregar el producto', 'error');
                }
            })
            .catch(err => {
                console.error(err);
                showToast('Error al agregar al carrito', 'error');
            });
        });
    });
});
