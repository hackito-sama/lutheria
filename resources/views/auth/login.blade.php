<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Luthería</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css') <!-- Tailwind -->
</head>

<body class="bg-white min-h-screen flex items-center justify-center md:bg-gray-100">

    <div class="flex flex-col md:flex-row w-full max-w-4xl">

        <!-- Panel lateral amarillo solo desktop -->
        <div class="hidden md:flex md:w-1/2 bg-luth-yellow items-center justify-center p-10 rounded-l-2xl">
            <div class="text-center text-luth-blue">
                <h2 class="text-4xl font-bold mb-4">🎸 Luthería</h2>
                <p class="text-lg">Bienvenido a la intranet. Ingresa tus credenciales para continuar.</p>
            </div>
        </div>

        <!-- Formulario -->
        <div
            class="w-full md:w-1/2 bg-white md:rounded-r-2xl md:shadow-xl flex flex-col justify-center px-8 md:px-12 py-16 md:py-20">
            <!-- Logo para mobile -->
            <div class="flex justify-center md:hidden mb-6">
                <a href="{{ url('/') }}" class="text-luth-blue text-3xl font-bold flex items-center space-x-2">
                    <span>🎸</span>
                    <span>Luthería</span>
                </a>
            </div>

            <h2 class="text-2xl font-semibold text-luth-blue text-center md:text-left mb-6">Inicia sesión</h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-luth-blue font-medium mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-luth-yellow focus:border-luth-yellow">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-luth-blue font-medium mb-1">Contraseña</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-luth-yellow focus:border-luth-yellow">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-luth-blue text-white py-3 rounded-lg shadow-md md:hover:shadow-lg md:hover:-translate-y-0.5 transition-all duration-200 font-semibold">
                    Entrar
                </button>

                @if($errors->any())
                    <p class="text-red-500 text-sm mt-2 text-center">{{ $errors->first() }}</p>
                @endif
            </form>

            <p class="text-sm text-center text-gray-500 mt-6 md:text-left">
                &copy; {{ date('Y') }} Luthería
            </p>
        </div>
    </div>
</body>

</html>