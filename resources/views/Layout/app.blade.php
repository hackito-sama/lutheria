<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luthería</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/js/app.js'])
    @vite('resources/js/toast.js')
    @vite('resources/js/global-toast.js')

</head>

<body class="font-sans flex flex-col min-h-screen">
    <!-- Navbar -->
    @include('Layout.nav')

    <!-- Contenido principal -->
    <main>
        @yield('content')
    </main>

    @if(session('success'))
        <div id="toast"
            class="fixed top-4 right-4 flex items-center space-x-3 bg-luth-blue text-white px-6 py-4 rounded-lg shadow-lg transform translate-x-32 opacity-0 transition-all duration-500">
            <!-- Icono Font Awesome -->
            <i class="fas fa-check-circle w-6 h-6 text-white"></i>
            <span>Formulario enviado correctamente. Será respondido apenas sea posible.</span>
        </div>

        <script>
            const toast = document.getElementById('toast');

            // Mostrar toast con animación
            setTimeout(() => {
                toast.classList.remove('translate-x-32', 'opacity-0');
                toast.classList.add('translate-x-0', 'opacity-100');
            }, 100); // pequeño delay para transición

            // Ocultar toast después de 5 segundos
            setTimeout(() => {
                toast.classList.add('translate-x-32', 'opacity-0');
            }, 5000);
        </script>
    @endif


    @yield('scripts')

    <!-- Footer -->
    @include('Layout.footer')
</body>


</html>