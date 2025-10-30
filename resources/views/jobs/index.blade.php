<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Lowongan Pekerjaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-6">Temukan Karir Impianmu</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($vacancies as $vacancy)
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow p-6 flex flex-col">
                                <h4 class="font-bold text-lg">{{ $vacancy->title }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $vacancy->location }}</p>
                                <div class="mt-2">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $vacancy->type }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-4 flex-grow">
                                    {{ Str::limit(strip_tags($vacancy->description), 100) }}
                                </p>
                                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-600">
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Deadline: {{ \Carbon\Carbon::parse($vacancy->deadline)->format('d F Y') }}</p>
                                    <a href="{{ route('jobs.show', $vacancy) }}" class="mt-3 inline-block w-full text-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="md:col-span-2 lg:col-span-3 text-center py-12">
                                <p>Saat ini belum ada lowongan yang tersedia.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $vacancies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>