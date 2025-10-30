<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $vacancy->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Sukses!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Gagal!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="flex flex-col md:flex-row justify-between md:items-center border-b border-gray-200 dark:border-gray-700 pb-4 mb-6">
                        <div>
                            <h1 class="text-3xl font-bold">{{ $vacancy->title }}</h1>
                            <p class="mt-1 text-gray-500 dark:text-gray-400">{{ $vacancy->location }}</p>
                        </div>
                        @auth
                        <div class="mt-4 md:mt-0">
                            <form action="{{ route('jobs.apply', $vacancy) }}" method="POST">
                                @csrf
                                <x-primary-button>
                                    {{ __('Lamar Sekarang') }}
                                </x-primary-button>
                            </form>
                        </div>
                        @endauth
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="md:col-span-2 space-y-6">
                            <div>
                                <h3 class="text-lg font-semibold border-b border-gray-200 dark:border-gray-700 pb-2 mb-3">Deskripsi Pekerjaan</h3>
                                <div class="prose dark:prose-invert max-w-none">
                                    {!! nl2br(e($vacancy->description)) !!}
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold border-b border-gray-200 dark:border-gray-700 pb-2 mb-3">Kualifikasi</h3>
                                <div class="prose dark:prose-invert max-w-none">
                                    {!! nl2br(e($vacancy->requirements)) !!}
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-1">
                            <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                                <h3 class="font-semibold mb-3">Detail Lowongan</h3>
                                <p class="text-sm"><strong>Tipe:</strong> {{ $vacancy->type }}</p>
                                <p class="text-sm mt-2"><strong>Deadline:</strong> <span class="font-medium text-red-500">{{ \Carbon\Carbon::parse($vacancy->deadline)->format('d F Y') }}</span></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>