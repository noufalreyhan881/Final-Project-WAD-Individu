<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profil Pelamar: ') }} {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Kolom Kiri: Foto dan Info Dasar -->
                        <div class="md:col-span-1">
                            <div class="flex flex-col items-center">
                                @if ($user->profile->path_foto)
                                    <img class="h-32 w-32 rounded-full object-cover mb-4" src="{{ asset('storage/' . $user->profile->path_foto) }}" alt="Foto Profil">
                                @else
                                    <div class="h-32 w-32 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center mb-4">
                                        <svg class="h-16 w-16 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                @endif
                                <h3 class="text-2xl font-bold">{{ $user->name }}</h3>
                                <p class="text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">{{ $user->profile->nomor_telepon ?? '-' }}</p>

                                @if ($user->profile->path_cv)
                                    <a href="{{ asset('storage/' . $user->profile->path_cv) }}" target="_blank" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                        Lihat / Unduh CV
                                    </a>
                                @else
                                    <p class="mt-4 text-sm text-red-500">CV belum diunggah.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Kolom Kanan: Detail Data Diri -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-semibold border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">Detail Data Diri</h3>
                            <div class="space-y-4">
                                <div class="grid grid-cols-3 gap-4">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nomor KTP</dt>
                                    <dd class="text-sm col-span-2">{{ $user->profile->nomor_ktp ?? '-' }}</dd>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tempat, Tanggal Lahir</dt>
                                    <dd class="text-sm col-span-2">
                                        {{ $user->profile->tempat_lahir ?? '-' }},
                                        {{ $user->profile->tanggal_lahir ? \Carbon\Carbon::parse($user->profile->tanggal_lahir)->isoFormat('D MMMM Y') : '-' }}
                                    </dd>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Jenis Kelamin</dt>
                                    <dd class="text-sm col-span-2">{{ $user->profile->jenis_kelamin ?? '-' }}</dd>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Pendidikan Terakhir</dt>
                                    <dd class="text-sm col-span-2">{{ $user->profile->pendidikan_terakhir ?? '-' }}</dd>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Alamat Lengkap</dt>
                                    <dd class="text-sm col-span-2">{{ $user->profile->alamat_lengkap ?? '-' }}</dd>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                        <a href="{{ url()->previous() }}" class="text-sm text-indigo-600 dark:text-indigo-500 hover:underline">
                            &larr; Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>