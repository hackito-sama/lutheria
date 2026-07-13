@extends('Layout.app')

@section('content')

    <!--<section class="w-screen relative overflow-hidden h-80 md:h-96">

                                                                    @foreach($sliders as $index => $slider)
                                                                        <div
                                                                            class="slide absolute inset-0 transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}">
                                                                            <img src="{{ asset($slider->url) }}" class="w-full h-full object-cover">
                                                                        </div>
                                                                    @endforeach

                                                                    <button id="prev"
                                                                        class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white px-4 py-2 rounded z-10">❮</button>
                                                                    <button id="next"
                                                                        class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white px-4 py-2 rounded z-10">❯</button>
                                                                </section>-->

    <!-- Sección: Quiénes somos -->
    <section class="py-16 shadow-sm rounded-lg bg-gray-100">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center gap-8">
            <!-- Descripción -->
            <div class="md:w-1/2">
                <h2 class="text-3xl font-bold mb-4 text-luth-blue">Quiénes somos</h2>
                <h3 class="text-gray-900 mb-4">Nuestra pasión por la excelencia nos ha impulsado desde el principio y
                    continúa propulsándonos hacia
                    adelante.</h3>
                <p class="text-gray-700 mb-4">


                    <strong>Luthé</strong> es una empresa chilena fundada con el objetivo de ofrecer productos de alta
                    calidad,
                    cuidadosamente desarrollados y adecuados para todos. Entendemos que cada instrumento es importante y nos
                    esforzamos para hacer que la experiencia de compra sea tan gratificante como sea posible.

                    Nos especializamos en la construcción artesanal de guitarras y bajos, incluyendo innovadores diseños
                    headless, todos fabricados con maderas chilenas de la más alta calidad.
                </p>
            </div>
            <!-- Video -->
            <div class="md:w-1/2">
                <div class="aspect-w-16 aspect-h-9">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/0F5XPG5qNys?si=4YwJ2EWcYXrSy9uO"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- SLIDER DE PRODUCTOS -->
    <section class="w-screen relative py-10 shadow-sm rounded-lg" id="guitars">
        <h2 class="text-luth-blue text-center text-2xl font-bold mb-6">Nuestros Productos</h2>

        <div class="relative w-full max-w-6xl mx-auto min-h-[450px] overflow-hidden">

            <!-- Contenedor de slides -->
            <div id="slider" class="relative w-full h-full">
                <!-- Los slides se generarán dinámicamente con JS -->
            </div>

            <!-- Flechas -->
            <button id="prevProduct"
                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white px-3 py-2 rounded shadow z-10">
                ❮
            </button>
            <button id="nextProduct"
                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white px-3 py-2 rounded shadow z-10">
                ❯
            </button>
        </div>
    </section>

    <!-- Sección: Clases de luthería -->
    <section class="py-16 shadow-sm rounded-lg bg-gray-100" id="classes">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center gap-8">
            <!-- Imagen -->
            <div class="md:w-1/2">
                <img src="{{ asset('images/lutheria_clase.jpg') }}" alt="Clase de luthería" class="rounded-lg shadow-lg">
            </div>
            <!-- Descripción -->
            <div class="md:w-1/2">
                <h2 class="text-3xl font-bold mb-4 text-luth-blue">Clases de Luthería</h2>
                <p class="text-gray-700 mb-4">
                    Ofrecemos clases para aprender a construir y reparar guitarras desde cero.
                    Nuestros cursos están diseñados tanto para principiantes como para músicos con experiencia que quieran
                    profundizar en el arte de la luthería.
                </p>
            </div>
        </div>
    </section>

    <section id="services" class="py-16 shadow-sm rounded-lg">
        <!-- Título de sección -->
        <div class="max-w-6xl mx-auto text-center mb-12 px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-luth-blue mb-4">Servicios de Calibración y Reparación</h2>
            <p class="text-gray-600 text-lg md:text-xl">Todo lo que tu guitarra necesita para sonar y sentirse perfecta.</p>
        </div>

        <!-- Cards de servicios -->
        <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 px-4">

            <!-- Card 1: Entrastado -->
            <div
                class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center hover:shadow-lg transition-shadow duration-300">
                <div class="text-6xl mb-4">🛠️</div>
                <h3 class="text-xl font-semibold mb-2 text-luth-blue">Entrastado</h3>
                <p class="text-gray-600">Ajustamos y alineamos los trastes para que tu guitarra tenga un tacto suave y sin
                    zumbidos. En acero inoxidable o níquel</p>
            </div>

            <!-- Card 2: Calibración -->
            <div
                class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center hover:shadow-lg transition-shadow duration-300">
                <div class="text-6xl mb-4">🔧</div>
                <h3 class="text-xl font-semibold mb-2 text-luth-blue">Calibración</h3>
                <p class="text-gray-600">Ajuste completo para óptimo rendimiento de tu instrumento
                </p>
            </div>

            <!-- Card 3: Reparación -->
            <div
                class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center hover:shadow-lg transition-shadow duration-300">
                <div class="text-6xl mb-4">🔨</div>
                <h3 class="text-xl font-semibold mb-2 text-luth-blue">Reparación</h3>
                <p class="text-gray-600">Arreglamos cualquier daño en tu guitarra, estructurales y restauraciones completas.
                </p>
            </div>

            <!-- Card 4: Electrónica -->
            <div
                class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center hover:shadow-lg transition-shadow duration-300">
                <div class="text-6xl mb-4">⚡</div>
                <h3 class="text-xl font-semibold mb-2 text-luth-blue">Electrónica</h3>
                <p class="text-gray-600">Instalación y reparación de sistemas electrónicos</p>
            </div>

        </div>
    </section>

    <section class="py-16 bg-gray-100 shadow-sm" id="custom-shop">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-luth-blue">Custom Shop</h2>

            <div class="grid md:grid-cols-2 gap-12">
                <!-- Lado Izquierdo -->
                <div class="text-left">
                    <h3 class="text-2xl font-semibold mb-4 text-luth-blue">Diseña Tu Instrumento Único</h3>
                    <p class="text-gray-700 mb-8">
                        En nuestro Custom Shop, cada instrumento es una obra de arte única.
                        Trabajamos contigo para crear el instrumento de tus sueños.
                    </p>

                    <ul class="space-y-4 text-gray-700">
                        <li class="flex items-center gap-2 border-b pb-2">
                            <span class="text-blue-600 text-xl">🎨</span>
                            Selección personalizada de maderas
                        </li>
                        <li class="flex items-center gap-2 border-b pb-2">
                            <span class="text-blue-600 text-xl">⚙️</span>
                            Hardware y electrónica a elección
                        </li>
                        <li class="flex items-center gap-2 border-b pb-2">
                            <span class="text-blue-600 text-xl">🖌️</span>
                            Acabados y colores personalizados
                        </li>
                        <li class="flex items-center gap-2 border-b pb-2">
                            <span class="text-blue-600 text-xl">📐</span>
                            Especificaciones técnicas a medida
                        </li>
                    </ul>
                </div>

                <!-- Lado Derecho -->
                <div class="bg-gray-900 text-white rounded-lg p-8 text-center shadow-2xl">
                    <h3 class="text-xl font-bold mb-8">Proceso Custom Shop</h3>

                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center">
                            <span class="text-blue-500 text-2xl font-bold">1</span>
                            <p class="mt-2">Consulta Inicial</p>
                        </div>
                        <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center">
                            <span class="text-blue-500 text-2xl font-bold">2</span>
                            <p class="mt-2">Diseño</p>
                        </div>
                        <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center">
                            <span class="text-blue-500 text-2xl font-bold">3</span>
                            <p class="mt-2">Construcción</p>
                        </div>
                        <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center">
                            <span class="text-blue-500 text-2xl font-bold">4</span>
                            <p class="mt-2">Entrega</p>
                        </div>
                    </div>

                    <button onclick="document.getElementById('contact').scrollIntoView({ behavior: 'smooth' });"
                        class="bg-white text-black px-6 py-3 rounded hover:bg-gray-200 transition">
                        Iniciar Proyecto
                    </button>
                </div>
            </div>
        </div>
    </section>


    <section class="py-16 shadow-sm" id="headless">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4 text-luth-blue">Guitarras y Bajos Headless</h2>
            <p class="text-gray-700 mb-12">Innovación y diseño moderno. Instrumentos headless hechos en Chile con la más
                alta calidad y precisión artesanal.</p>

            <div class="swiper mySwiper overflow-visible">
                <div class="swiper-wrapper">
                    @foreach($products_standard as $product)
                        <div class="swiper-slide p-4">
                            <div class="bg-white rounded-lg shadow-2xl overflow-hidden text-left relative z-10">
                                <img src="{{ $product->images[0] ?? 'default.jpg' }}" alt="{{ $product->name }}"
                                    class="w-full min-h-[16rem] object-cover">
                                <div class="p-6">
                                    @if($product->is_new ?? true)
                                        <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full uppercase">
                                            Nuevo
                                        </span>
                                    @endif
                                    <h3 class="text-xl font-semibold mt-2 text-left text-luth-blue">{{ $product->name }}</h3>
                                    <p>{!! nl2br(e($product->description)) !!}</p>
                                    <p class="text-blue-600 font-bold mt-4">${{ number_format($product->price, 0, ',', '.') }}
                                        CLP</p>
                                    <div class="mt-4 flex gap-2">
                                        <button onclick="window.location='{{ url('/building/' . $product->id) }}'"
                                            class="bg-luth-blue text-white px-4 py-2 rounded hover:bg-gray-800 transition">
                                            Mas Detalles
                                        </button>
                                        <!--<button class="border text-luth-blue px-4 py-2 rounded hover:bg-gray-100 transition">
                                            Ver Detalles
                                        </button>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Controles -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

            <div
                class="mt-16 bg-luth-blue text-white rounded-lg p-8 flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0 text-left">
                    <h3 class="text-xl font-bold mb-2">¿Por qué elegir Headless?</h3>
                    <ul class="space-y-1 text-gray-300 text-left">
                        <li>✔ Mayor portabilidad sin sacrificar calidad de sonido</li>
                        <li>✔ Diseño ergonómico que reduce fatiga</li>
                        <li>✔ Sistema de afinación innovador y preciso</li>
                        <li>✔ Hecho a mano en Chile con maderas nacionales selectas</li>
                    </ul>
                </div>
                <button onclick="document.getElementById('contact').scrollIntoView({ behavior: 'smooth' });"
                    class="bg-white text-black px-6 py-3 rounded hover:bg-gray-200 transition">Consultar
                    Disponibilidad</button>
            </div>
        </div>
    </section>

    <!-- CONTACTO -->
    <section class="py-16 px-4 shadow-sm rounded-lg bg-gray-100" id="contact">
        <div class="max-w-3xl mx-auto mt-16 bg-white p-8 rounded-lg shadow-2xl">
            <h2 class="text-2xl font-bold mb-6 text-center text-luth-blue">Contáctanos</h2>
            <form id="contactForm" action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 text-luth-blue">Nombre</label>
                    <input type="text" name="name" id="name" required
                        class="mt-1 block w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 text-luth-blue">Email</label>
                    <input type="email" name="email" id="email" required
                        class="mt-1 block w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <!-- Fono -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 text-luth-blue">Fono</label>
                    <input type="text" name="phone" id="phone" required
                        class="mt-1 block w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <!-- Tipo de solicitud (Select) -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 text-luth-blue">Tipo de
                        solicitud</label>
                    <select name="type" id="type" required
                        class="mt-1 block w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-poppins">
                        <option value="" disabled selected>Selecciona un tipo</option>
                        <option value="clase">Clases</option>
                        <option value="arreglo">Calibracion/Reparación</option>
                        <option value="custom_shop">Cotizacion Custom Shop</option>
                        <option value="headless">Consulta Standart o deluxe</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
                <!-- Descripción -->
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 text-luth-blue">Descripción</label>
                    <textarea name="message" id="message" rows="4" required
                        class="mt-1 block w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                </div>
                <!-- Botón de envío -->
                <div class="text-center">
                    <button type="submit"
                        class="bg-luth-blue text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition-colors">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
    </section>

    @php
        $productsForJs = $products->map(function ($product) {
            $images = json_decode($product->images, true);
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $images[0] ?? 'https://via.placeholder.com/300x300?text=Sin+Imagen',
                'stock' => $product->stock
            ];
        });
    @endphp

    <script>
        window.productsData = @json($productsForJs);
        const WHATSAPP_PHONE = "{{ config('services.whatsapp.phone') }}";
    </script>

@endsection


@section('scripts')
    @vite('resources/js/product-slider.js')
    <!--vite('resources/js/slider.js')-->
    <!--vite('resources/js/cart/cart.js')-->
    @vite('resources/js/standard-product.js')
@endsection