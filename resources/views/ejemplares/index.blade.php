<x-app-layout>
    <div class="relative overflow-x-auto w-3/4 mx-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Codigo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Libro
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Autor
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Accion
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ejemplares as $ejemplar)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a class="text-blue-500 blue" href="{{ route('ejemplares.show', $ejemplar) }}">
                                {{ $ejemplar->codigo }}
                            </a>
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a class="text-blue-500 blue" href="{{ route('ejemplares.show', $ejemplar) }}">
                                {{ $ejemplar->libro->titulo }}
                            </a>
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a class="text-blue-500 blue" href="{{ route('ejemplares.show', $ejemplar) }}">
                                {{ $ejemplar->libro->autor }}
                            </a>
                        </th>
                        <td class="px-6 py-4">
                            @php
                                $prestamo = $ejemplar->prestamosVigentes()->first();
                            @endphp
                            @if ($prestamo != null)
                                <a href="{{ route('prestamos.devolver', ['prestamo' => $prestamo]) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    <x-primary-button>
                                        Devolver
                                    </x-primary-button>
                                </a>
                            @else
                                <a href="{{ route('prestamos.create', ['ejemplar' => $ejemplar]) }}"
                                    class="font-medium text-green-600 dark:text-green-500 hover:underline">
                                    <x-primary-button>
                                        Prestar
                                    </x-primary-button>
                                </a>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
