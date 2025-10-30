<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lamaran Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-6">Daftar Lamaran Pekerjaan Anda</h3>

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

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Posisi</th>
                                    <th scope="col" class="px-6 py-3">Perusahaan</th> {{-- Asumsi ada nama perusahaan di JobVacancy --}}
                                    <th scope="col" class="px-6 py-3">Lokasi</th>
                                    <th scope="col" class="px-6 py-3">Status Lamaran</th>
                                    <th scope="col" class="px-6 py-3">Tanggal Lamaran</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($applications as $application)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $application->jobVacancy->title }}
                                    </th>
                                    <td class="px-6 py-4">Nama Perusahaan (belum ada di model JobVacancy)</td> {{-- Placeholder --}}
                                    <td class="px-6 py-4">{{ $application->jobVacancy->location }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if($application->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($application->status == 'reviewed') bg-blue-100 text-blue-800
                                            @elseif($application->status == 'hired') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($application->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ $application->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('jobs.show', $application->jobVacancy) }}" class="font-medium text-indigo-600 dark:text-indigo-500 hover:underline">Lihat Lowongan</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center">Anda belum melamar pekerjaan apapun.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $applications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>