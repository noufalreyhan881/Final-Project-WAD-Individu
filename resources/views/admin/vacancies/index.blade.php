<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Lowongan Pekerjaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-end mb-4">
                        <a href="{{ route('admin.vacancies.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Tambah Lowongan Baru
                        </a>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Posisi</th>
                                    <th scope="col" class="px-6 py-3">Lokasi</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Deadline</th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Aksi</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($vacancies as $vacancy)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $vacancy->title }}
                                    </th>
                                    <td class="px-6 py-4">{{ $vacancy->location }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $vacancy->status == 'Open' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $vacancy->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($vacancy->deadline)->format('d M Y') }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('admin.vacancies.edit', $vacancy->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        <form action="{{ route('admin.vacancies.destroy', $vacancy->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline ml-4">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">Belum ada data lowongan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $vacancies->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>