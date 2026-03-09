{{-- resources/views/profile/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="/account"
               class="flex items-center text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Pengaturan Profil
            </h2>
        </div>
    </x-slot>

<div class="min-h-screen bg-gray-50 dark:bg-gray-950 pb-12">
    <div class="max-w-lg mx-auto px-4">

        {{-- ── Avatar ── --}}
        <div class="flex flex-col items-center pt-8 pb-6">
            <a href="{{ route('profile.edit-avatar') }}" class="group relative">
                <div class="w-24 h-24 rounded-full overflow-hidden bg-gray-200 dark:bg-gray-800
                            ring-1 ring-gray-200 dark:ring-gray-700
                            group-hover:ring-2 group-hover:ring-bluefilterpedia transition-all">
                    @if(auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                             class="w-full h-full object-cover" alt="Avatar">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    @endif
                </div>
                {{-- Camera overlay on hover --}}
                <div class="absolute inset-0 rounded-full bg-black/0 group-hover:bg-black/20 transition-colors flex items-center justify-center">
                    <svg class="w-6 h-6 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </a>
            <a href="{{ route('profile.edit-avatar') }}"
               class="mt-2.5 text-xs text-gray-400 dark:text-gray-500 hover:text-bluefilterpedia dark:hover:text-bluefilterpedia transition-colors">
                Ubah foto profil
            </a>
        </div>

        {{-- ── Informasi Pribadi ── --}}
        <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden mb-3">

            <p class="px-4 pt-4 pb-2 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wide">
                Informasi Pribadi
            </p>

            @foreach([
                ['route' => 'profile.edit-name',     'label' => 'Nama',     'value' => auth()->user()->name],
                ['route' => 'profile.edit-username',  'label' => 'Username', 'value' => auth()->user()->username ?? 'Belum diatur'],
                ['route' => 'profile.edit-bio',       'label' => 'Bio',      'value' => auth()->user()->bio      ?? 'Tambahkan bio'],
            ] as $row)
            <a href="{{ route($row['route']) }}"
               class="flex items-center justify-between px-4 py-3
                      border-t border-gray-100 dark:border-gray-800
                      hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors group">
                <span class="w-28 flex-shrink-0 text-sm text-gray-400 dark:text-gray-500">
                    {{ $row['label'] }}
                </span>
                <span class="flex-1 text-sm text-gray-800 dark:text-gray-200 truncate">
                    {{ $row['value'] }}
                </span>
                <svg class="w-3.5 h-3.5 text-gray-300 dark:text-gray-600 ml-2 flex-shrink-0
                            group-hover:text-gray-400 dark:group-hover:text-gray-500 transition-colors"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
            @endforeach

        </div>

        {{-- ── Kontak ── --}}
        <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden mb-6">

            <p class="px-4 pt-4 pb-2 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wide">
                Kontak
            </p>

            @foreach([
                ['route' => 'profile.edit-email', 'label' => 'Email', 'value' => auth()->user()->email],
                ['route' => 'profile.edit-phone', 'label' => 'Telepon', 'value' => auth()->user()->phone ?? 'Tambahkan nomor'],
            ] as $row)
            <a href="{{ route($row['route']) }}"
               class="flex items-center justify-between px-4 py-3
                      border-t border-gray-100 dark:border-gray-800
                      hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors group">
                <span class="w-28 flex-shrink-0 text-sm text-gray-400 dark:text-gray-500">
                    {{ $row['label'] }}
                </span>
                <span class="flex-1 text-sm text-gray-800 dark:text-gray-200 truncate">
                    {{ $row['value'] }}
                </span>
                <svg class="w-3.5 h-3.5 text-gray-300 dark:text-gray-600 ml-2 flex-shrink-0
                            group-hover:text-gray-400 dark:group-hover:text-gray-500 transition-colors"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
            @endforeach

        </div>

        {{-- ── Logout ── --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full py-3 rounded-xl text-sm font-medium text-red-500 dark:text-red-400
                           bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800
                           hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                Keluar
            </button>
        </form>

    </div>
</div>

</x-app-layout>