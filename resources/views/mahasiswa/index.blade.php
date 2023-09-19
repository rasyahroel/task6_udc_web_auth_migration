@section('title', 'Mahasiswa')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mahasiswa List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                {{--  Content Mahasiswa  --}}

                <div class="max-w-7xl mx-auto p-6 lg:p-8">
                    <div class="justify-center">
                        <div class="my-5 flex justify-between">

                            @if (Auth::user()->role == 'Teacher')
                                <a href="mahasiswa-add"
                                    class="border border-black font-bold py-2 px-4 rounded-lg hover:bg-gray-100">Add
                                    Data</a>
                                <a href="mahasiswa-deleted"
                                    class="border border-black font-bold py-2 px-4 rounded-lg hover:bg-gray-100">Show
                                    Deleted Data
                                </a>
                            @elseif (Auth::user()->role == 'Admin')
                                <a href="mahasiswa-deleted"
                                    class="border border-black font-bold py-2 px-4 rounded-lg hover:bg-gray-100">Show
                                    Deleted Data
                                </a>
                            @else
                            @endif

                        </div>

                        @if (Session::has('status'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-5 rounded relative mt-8"
                                role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif

                        <table class="table-auto border-collapse border w-full py-5 mt-8">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">No.</th>
                                    <th class="px-4 py-2">Nama</th>
                                    <th class="px-4 py-2">Alamat</th>
                                    <th class="px-4 py-2">Kelas</th>

                                    @if (Auth::user()->role != 'Teacher')
                                    @else
                                        <th class="px-4 py-2">Action</th>
                                    @endif

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($mahasiswaList as $data)
                                    <tr>
                                        <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                        <td class="border px-4 py-2">{{ $data->nama }}</td>
                                        <td class="border px-4 py-2">{{ $data->alamat }}</td>
                                        <td class="border px-4 py-2">{{ $data->kelas->nama_kelas }}</td>

                                        @if (Auth::user()->role != 'Teacher')
                                        @else
                                            <td class="text-center">
                                                <div x-data="{ isOpen: false }" @click.away="isOpen = false"
                                                    class="relative inline-block text-left">
                                                    <div>
                                                        <button @click="isOpen = !isOpen"
                                                            class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring focus:ring-gray-300"
                                                            id="menu-button" aria-expanded="true" aria-haspopup="true">
                                                            Options
                                                            <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                                                fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd"
                                                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div x-show="isOpen"
                                                        class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                                        role="menu" aria-orientation="vertical"
                                                        aria-labelledby="menu-button" tabindex="-1">
                                                        <div class="py-1" role="none">
                                                            <a href="mahasiswa-edit/{{ $data->id }}"
                                                                class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 hover:text-gray-900"
                                                                role="menuitem" tabindex="-1" id="menu-item-0">Edit</a>
                                                            <a href="mahasiswa-delete/{{ $data->id }}"
                                                                class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 hover:text-gray-900"
                                                                role="menuitem" tabindex="-1" id="menu-item-1"
                                                                data-modal="deleteModal">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <div class="my-5 py-5">
                            {{ $mahasiswaList->withQueryString()->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
