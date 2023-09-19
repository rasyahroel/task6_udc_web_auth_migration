@section('title', "Delete Mahasiswa $mahasiswa->nama")
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Delete Mahasiswa $mahasiswa->nama") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto p-6 lg:p-8">
                    <div class="justify-center">
                        <h2>Are you sure to delete data : {{ $mahasiswa->nama }} ({{ $mahasiswa->kelas->nama_kelas }})
                        </h2>

                        <form action="/mahasiswa-destroy/{{ $mahasiswa->id }}" method="POST"
                            style="display: inline-block">

                            @csrf
                            @method('DELETE')
                            <div class="mt-5">
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg mr-2 focus:outline-none">Delete</button>
                                <a href="{{ route('mahasiswas') }}" class="inline-block bg-gray-300 text-gray-700 hover:bg-gray-400 px-4 py-2 rounded-lg">Cancel</a>
                            </div>
                            
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
