<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Informasi Data Diri Pelamar') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Lengkapi data diri Anda untuk proses rekrutmen.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update.applicant') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="nomor_ktp" :value="__('Nomor KTP')" />
            <x-text-input id="nomor_ktp" name="nomor_ktp" type="text" class="mt-1 block w-full" :value="old('nomor_ktp', $user->profile->nomor_ktp)" />
            <x-input-error class="mt-2" :messages="$errors->get('nomor_ktp')" />
        </div>

        <div>
            <x-input-label for="tempat_lahir" :value="__('Tempat Lahir')" />
            <x-text-input id="tempat_lahir" name="tempat_lahir" type="text" class="mt-1 block w-full" :value="old('tempat_lahir', $user->profile->tempat_lahir)" />
            <x-input-error class="mt-2" :messages="$errors->get('tempat_lahir')" />
        </div>

        <div>
            <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
            <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="mt-1 block w-full" :value="old('tanggal_lahir', $user->profile->tanggal_lahir)" />
            <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
        </div>

        <div>
            <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
            <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="" disabled {{ old('jenis_kelamin', $user->profile->jenis_kelamin) ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $user->profile->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $user->profile->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
        </div>

        <div>
            <x-input-label for="alamat_lengkap" :value="__('Alamat Lengkap')" />
            <textarea id="alamat_lengkap" name="alamat_lengkap" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('alamat_lengkap', $user->profile->alamat_lengkap) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('alamat_lengkap')" />
        </div>

        <div>
            <x-input-label for="nomor_telepon" :value="__('Nomor Telepon')" />
            <x-text-input id="nomor_telepon" name="nomor_telepon" type="text" class="mt-1 block w-full" :value="old('nomor_telepon', $user->profile->nomor_telepon)" />
            <x-input-error class="mt-2" :messages="$errors->get('nomor_telepon')" />
        </div>

        <div>
            <x-input-label for="pendidikan_terakhir" :value="__('Pendidikan Terakhir')" />
            <x-text-input id="pendidikan_terakhir" name="pendidikan_terakhir" type="text" class="mt-1 block w-full" :value="old('pendidikan_terakhir', $user->profile->pendidikan_terakhir)" />
            <x-input-error class="mt-2" :messages="$errors->get('pendidikan_terakhir')" />
        </div>

        <div>
            <x-input-label for="path_foto" :value="__('Foto Profil')" />
            @if ($user->profile->path_foto)
                <img src="{{ asset('storage/' . $user->profile->path_foto) }}" alt="Foto Profil" class="w-24 h-24 rounded-full object-cover my-2">
            @endif
            <input id="path_foto" name="path_foto" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"/>
            <x-input-error class="mt-2" :messages="$errors->get('path_foto')" />
        </div>

        <div>
            <x-input-label for="path_cv" :value="__('Upload CV (PDF)')" />
            @if ($user->profile->path_cv)
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    CV saat ini: <a href="{{ asset('storage/' . $user->profile->path_cv) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Lihat/Unduh CV</a>
                </p>
            @endif
            <input id="path_cv" name="path_cv" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"/>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">
                PDF (MAX. 2MB).
            </p>
            <x-input-error class="mt-2" :messages="$errors->get('path_cv')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'applicant-profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>