@section('title', 'Data mahasiswa yang telah di hapus')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data mahasiswa yang telah di hapus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto p-6 lg:p-8">
                    <div class="justify-center">

                        <a href="/mahasiswas"
                            class="border border-black font-bold py-2 px-4 rounded-lg hover:bg-gray-100">Back</a>

                        @if (Session::has('status'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-5 rounded relative mt-8"
                                role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif

                        <div class="mt-5">
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
                                    @forelse ($mahasiswa as $data)
                                        <tr>
                                            <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                            <td class="border px-4 py-2">{{ $data->nama }}</td>
                                            <td class="border px-4 py-2">{{ $data->alamat }}</td>
                                            <td class="border px-4 py-2">{{ $data->kelas->nama_kelas }}</td>
                                            @if (Auth::user()->role != 'Teacher')
                                            @else
                                                <td class="border px-4 py-2 text-center">
                                                    <a href="/mahasiswa/{{ $data->id }}/restore">Restore</a> ||
                                                    <a href="/mahasiswa/{{ $data->id }}/delete-permanent">Delete
                                                        Permanent</a>
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="border px-4 py-2 text-center">Data tidak ada</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
