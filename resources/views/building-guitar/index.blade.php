@extends('Layout.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <div x-data="guitarConfigurator(
                                                        @js($product),
                                                        @js($colors),
                                                        @js($pickups),
                                                        '{{ config('services.whatsapp.phone') }}'
                                                    )" class="max-w-5xl mx-auto py-12 px-6">
        <h1 class="text-3xl font-bold text-center text-luth-blue mb-8">
            Configura tu guitarra
        </h1>

        <div class="grid md:grid-cols-2 gap-12 items-center">

            <!-- 🎸 Vista previa -->
            <div x-show="selectedColor" x-cloak class="mb-10">

                <h3 class="text-xl font-bold text-luth-blue mb-4" x-text="selectedColor?.name"></h3>
                <div x-show="selectedColor.name"
                    class="flex items-center gap-2 text-sm text-blue-700 bg-blue-50 border border-blue-200 px-3 py-2 rounded mb-4">

                    <!-- Ícono info -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0 text-blue-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                    </svg>

                    <span>
                        La vista previa corresponde únicamente al color seleccionado.
                        La configuración de pastillas no altera la imagen mostrada.
                    </span>

                </div>


                <div class="w-80 mx-auto">

                    <!-- Imagen principal -->
                    <div class="relative w-full h-[400px] bg-white rounded-lg shadow-md overflow-hidden">
                        <template x-for="(img, index) in (selectedColor?.images || [])" :key="index">
                            <img :src="img" x-show="currentImage === index"
                                class="absolute inset-0 w-full h-full object-contain transition-opacity duration-500">
                        </template>
                    </div>

                    <!-- Controles -->
                    <div class="flex justify-between mt-4">
                        <button @click="prevImage" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                            ◀
                        </button>

                        <button @click="nextImage" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                            ▶
                        </button>
                    </div>

                    <!-- Miniaturas -->
                    <div class="flex space-x-2 mt-4 justify-center">
                        <template x-for="(img, index) in (selectedColor?.images || [])" :key="index">
                            <img :src="img" class="w-16 h-16 object-cover rounded cursor-pointer border"
                                :class="{ 'border-luth-blue': currentImage === index }" @click="currentImage = index">
                        </template>
                    </div>
                </div>
            </div>

            <!-- ⚙️ Opciones -->
            <div class="flex flex-col space-y-6">

                <!-- Selector de color -->
                <div>
                    <label class="block font-semibold mb-2">Color</label>
                    <select x-model="color" class="w-full border rounded p-2">
                        <option value="" disabled>Seleccione</option>
                        <template x-for="c in colors" :key="c.value">
                            <option :value="c.value" x-text="c.name"></option>
                        </template>
                    </select>
                </div>

                <!-- Selector de pastillas -->
                <div>
                    <label class="block font-semibold mb-2">Pastillas</label>
                    <select x-model="pickups" @change="updateAdditional" class="w-full border rounded p-2">
                        <option value="" disabled>Seleccione</option>

                        @foreach($pickups as $pickup)
                            <option value="{{ $pickup->value }}" data-additional="{{ $pickup->additional }}">
                                {{ $pickup->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Precio total -->
                <div>
                    <p class="text-lg font-semibold">
                        Precio:
                        <span class="text-luth-yellow" x-text="formattedTotal"></span>
                    </p>
                </div>

                <!-- Botón WhatsApp -->
                <a :href="whatsappLink" target="_blank"
                    class="flex items-center justify-center gap-2 w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                    Solicitar cotización por WhatsApp
                </a>

            </div>
        </div>
    </div>

    <script>
        function guitarConfigurator(product, colors, pickups, phone) {
            return {
                model: product.name,
                basePrice: product.price,

                colors: colors,
                pickupsList: pickups,

                color: '',
                pickups: '',

                additional: 0,
                currentImage: 0,

                get selectedColor() {
                    return this.colors.find(c => c.value === this.color) || {
                        name: '',
                        images: []
                    };
                },


                get totalPrice() {
                    return this.basePrice + this.additional;
                },

                get formattedTotal() {
                    return new Intl.NumberFormat('es-CL', {
                        style: 'currency',
                        currency: 'CLP'
                    }).format(this.totalPrice);
                },

                get whatsappLink() {
                    const mensaje = `Hola! Me gustaría solicitar una cotización por la guitarra ${this.model}.
                                                🎸 Detalles:
                                                • Color: ${this.selectedColor?.name ?? ''}
                                                • Pastillas: ${this.pickups}
                                                • Precio total: ${this.formattedTotal}`;

                    return `https://wa.me/${phone}?text=${encodeURIComponent(mensaje)}`;
                },

                updateAdditional(event) {
                    const selected = event.target.selectedOptions[0];
                    this.additional = parseInt(selected.dataset.additional || 0);
                },

                nextImage() {
                    if (!this.selectedColor) return;
                    this.currentImage =
                        this.currentImage < this.selectedColor.images.length - 1
                            ? this.currentImage + 1
                            : 0;
                },

                prevImage() {
                    if (!this.selectedColor) return;
                    this.currentImage =
                        this.currentImage > 0
                            ? this.currentImage - 1
                            : this.selectedColor.images.length - 1;
                },

                init() {
                    this.$watch('color', () => {
                        this.currentImage = 0;
                    });
                }
            }
        }
    </script>

@endsection