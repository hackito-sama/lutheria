<nav class="bg-luth-yellow py-4 shadow-md sticky top-0 z-50">
    <div class="max-w-6xl mx-auto flex justify-between items-center px-6">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo_luthe.jpg') }}" alt="Logo Luthería"
                    class="h-12 w-12 object-cover rounded-full border-2 border-gray-700 transform -rotate-18">
            </a>
        </div>

        <!-- Menú desktop -->
        <ul class="hidden md:flex space-x-6 text-luth-blue font-semibold">
            <li><a href="{{ url('/#guitars') }}" class="hover:underline">Guitarras</a></li>
            <li><a href="{{ url('/#classes') }}" class="hover:underline">Clases</a></li>
            <li><a href="{{ url('/#services') }}" class="hover:underline">Servicios</a></li>
            <li><a href="{{ url('/#custom-shop') }}" class="hover:underline">Custom Shop</a></li>
            <li><a href="{{ url('/#headless') }}" class="hover:underline">Headless</a></li>
            <li><a href="{{ url('/#contact') }}" class="hover:underline">Contacto</a></li>

        </ul>

        <!-- Icono carrito desktop 
        <a href="{{ route('cart.index') }}" class="relative flex items-center">
            <i class="fas fa-shopping-cart text-xl"></i>

            @php
                $cartCount = session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0;
                $displayCount = $cartCount > 99 ? '99+' : $cartCount;
            @endphp

            <span id="cart-count"
                class="absolute -bottom-[-12px] -right-[20px] bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full text-center min-w-[18px] max-w-[32px] overflow-hidden transition-all duration-200 {{ $cartCount > 0 ? '' : 'hidden' }}">
                {{ $cartCount > 0 ? $displayCount : '' }}
            </span>

        </a>-->

        <!-- Hamburger mobile -->
        <button id="nav-toggle" class="md:hidden flex flex-col justify-center items-center space-y-1">
            <span class="block w-6 h-0.5 bg-luth-blue"></span>
            <span class="block w-6 h-0.5 bg-luth-blue"></span>
            <span class="block w-6 h-0.5 bg-luth-blue"></span>
        </button>
    </div>

    <!-- Menú mobile desplegable -->
    <div id="nav-menu"
        class="hidden md:hidden absolute top-full left-0 right-0 bg-luth-yellow shadow-md px-6 pb-4 z-50 md:flex">
        <ul class="flex flex-col space-y-3 text-luth-blue font-semibold">
            <li><a href="{{ url('/#guitars') }}" class="hover:underline">Guitarras</a></li>
            <li><a href="{{ url('/#classes') }}" class="hover:underline">Clases</a></li>
            <li><a href="{{ url('/#services') }}" class="hover:underline">Servicios</a></li>
            <li><a href="{{ url('/#custom-shop') }}" class="hover:underline">Custom Shop</a></li>
            <li><a href="{{ url('/#headless') }}" class="hover:underline">Headless</a></li>
            <li><a href="{{ url('/#contact') }}" class="hover:underline">Contacto</a></li>
        </ul>
    </div>
</nav>

<script>
    const navToggle = document.getElementById('nav-toggle');
    const navMenu = document.getElementById('nav-menu');

    navToggle.addEventListener('click', () => {
        navMenu.classList.toggle('hidden');
    });
</script>