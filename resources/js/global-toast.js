function showToast(message, type = 'success') {
    const colors = {
        success: 'bg-luth-blue',
        error: 'bg-red-600',
        info: 'bg-luth-blue',
        warning: 'bg-yellow-500 text-black'
    };

    const toast = document.createElement('div');
    toast.className = `fixed top-20 right-4 z-50 flex items-center space-x-3 ${colors[type]} text-white px-6 py-4 rounded-lg shadow-lg transform translate-x-32 opacity-0 transition-all duration-500`;

    let iconClass = 'fas fa-check-circle';
    if (type === 'error') iconClass = 'fas fa-times-circle';
    if (type === 'info') iconClass = 'fas fa-info-circle';
    if (type === 'warning') iconClass = 'fas fa-exclamation-triangle';

    // Creamos el icono como span flex para asegurar alineación
    const icon = document.createElement('span');
    icon.className = `w-6 h-6 flex-shrink-0 flex items-center justify-center`;
    icon.innerHTML = `<i class="${iconClass}"></i>`;

    // Creamos el texto
    const text = document.createElement('span');
    text.className = 'text-sm leading-none';
    text.textContent = message;

    // Añadimos al toast
    toast.appendChild(icon);
    toast.appendChild(text);

    document.body.appendChild(toast);



    setTimeout(() => {
        toast.classList.remove('translate-x-32', 'opacity-0');
        toast.classList.add('translate-x-0', 'opacity-100');
    }, 100);

    setTimeout(() => {
        toast.classList.add('translate-x-32', 'opacity-0');
        setTimeout(() => toast.remove(), 500);
    }, 4000);
}

// Exponer globalmente
window.showToast = showToast;