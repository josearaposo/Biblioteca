<x-app-layout>
    <div class="w-1/2 mx-auto">
        <form method="POST" action="{{ route('prestamos.store', ['ejemplar' => $ejemplar]) }}">
            @csrf
            <!-- Vuelo -->
            <h1
                class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                Libro: {{ $ejemplar->codigo }}
            </h1>

            <!-- Cliente -->
            <div>
                <x-input-label for="cliente_id" :value="'Selecciona cliente_id'" />
                <select id="cliente_id" class="block mt-1 w-full" name="cliente_id" required>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nombre}}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('cliente_id')" class="mt-2" />

            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('ejemplares.index') }}">
                    <x-secondary-button class="ms-4">
                        Volver
                        </x-primary-button>
                </a>
                <x-primary-button class="ms-4">
                    Reservar
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
