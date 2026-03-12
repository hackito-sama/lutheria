document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#contactForm');

    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        const result = await response.json();

        if (result.status === 'success') {
            showToast(result.message);
            form.reset();

            // 👇 abrir WhatsApp en nueva pestaña
            if (result.urlwsp) {
                window.open(result.urlwsp, '_blank');
            }
        }
    });

    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = "fixed top-20 right-4 z-50 flex items-center space-x-3 bg-luth-blue text-white px-6 py-4 rounded-lg shadow-lg transform translate-x-32 opacity-0 transition-all duration-500";
        toast.innerHTML = `
            <i class="fas fa-check-circle w-6 h-6 flex-shrink-0 text-white" style="line-height:1; display:flex; align-items:center; justify-content:center;"></i>
            <span class="text-sm leading-none">${message}</span>
        `;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.classList.remove('translate-x-32', 'opacity-0');
            toast.classList.add('translate-x-0', 'opacity-100');
        }, 100);

        setTimeout(() => {
            toast.classList.add('translate-x-32', 'opacity-0');
            setTimeout(() => toast.remove(), 500);
        }, 5000);
    }
});
