@section('title', 'Add New Mahasiswa')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="max-w-7xl mx-auto p-6 lg:p-8">
                    <div class="justify-center">

                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded my-5">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="mahasiswa" method="POST" class="w-full max-w-md mx-auto">
                            @csrf

                            <div class="mb-4">
                                <label for="nama" class="block text-sm font-bold mb-2">Name</label>
                                <input type="text"
                                    class="w-full px-3 py-2 border rounded shadow appearance-none focus:outline-none focus:shadow-outline-blue focus:border-blue-300"
                                    name="nama" id="nama">
                            </div>

                            <div class="mb-4">
                                <label for="quantity" class="block text-sm font-bold mb-2">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="3"
                                    class="w-full px-3 py-2 border rounded shadow appearance-none focus:outline-none focus:shadow-outline-blue focus:border-blue-300"></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="price" class="block text-sm font-bold mb-2">Price</label>
                                <select name="kelas_id" id="class"
                                    class="w-full px-3 py-2 border rounded shadow appearance-none focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                                    <option value="">Pilih Kelas</option>

                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('kelas_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="mb-6">
                                <button
                                    class="bg-green-500 hover:bg-green-700 font-bold py-2 px-4 border rounded-lg focus:outline-none focus:shadow-outline-green active:bg-green-800"
                                    type="submit">SAVE</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
