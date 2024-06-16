<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Libro: {{$libro->titulo}}
                </h1>
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Autor: {{$libro->autor}}
                </h1>
                <table class="mt-8 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Código del ejemplar
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ¿Está prestado?
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha del préstamo
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($libro->ejemplares as $ejemplar)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $ejemplar->codigo }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    @if ($ejemplar->prestamosVigentes()->count() > 0)
                                        Sí
                                    @else
                                        No
                                    @endif
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    @if ($ejemplar->prestamos->isNotEmpty())
                                        {{ $ejemplar->prestamos->first()->fecha_hora }}
                                    @endif
                                </td>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                 </p>
            </div>


        </div>
    </section>
</x-app-layout>
