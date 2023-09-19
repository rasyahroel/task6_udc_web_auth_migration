<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('kelas')->paginate(10);
        return view('mahasiswa.index', ['mahasiswaList' => $mahasiswa]);
    }

    public function create()
    {
        $kelas = Kelas::select('id', 'nama_kelas')->get();
        return view('mahasiswa.add', ['kelas' => $kelas]);
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::create($request->all());

        if ($mahasiswa) {
            Session::flash('status', 'success');
            Session::flash('message', 'Add new mahasiswa success');
        }

        return redirect('/mahasiswas');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::with('kelas')->findOrFail($id);
        $kelas = Kelas::where('id', '!=', $mahasiswa->kelas_id)->get(['id', 'nama_kelas']);
        return view('mahasiswa.edit', ['mahasiswa' => $mahasiswa, 'kelas' => $kelas]);
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());

        if ($mahasiswa) {
            Session::flash('status', 'success');
            Session::flash('message', 'Edit data mahasiswa success');
        }

        return redirect('/mahasiswas');
    }

    public function delete($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.delete', ['mahasiswa' => $mahasiswa]);
    }

    public function destroy($id)
    {
        $deleteMahasiswa = Mahasiswa::findOrFail($id);
        $deleteMahasiswa->delete();

        if ($deleteMahasiswa) {
            Session::flash('status', 'success');
            Session::flash('message', 'Delete data mahasiswa success');
        }

        return redirect('/mahasiswas');
    }

    public function deletedMahasiswa()
    {
        $deletedMahasiswa = Mahasiswa::onlyTrashed()->get();
        return view('mahasiswa.deleted-list', ['mahasiswa' => $deletedMahasiswa]);
    }

    public function restore($id)
    {
        $deletedMahasiswa = Mahasiswa::withTrashed()->where('id', $id)->restore();

        if ($deletedMahasiswa) {
            Session::flash('status', 'success');
            Session::flash('message', 'Restore data mahasiswa success');
        }

        return redirect('/mahasiswas');
    }
    
    public function deletePermanent($id)
    {
        $mahasiswa = Mahasiswa::withTrashed()->findOrFail($id);
        $mahasiswa->forceDelete();

        if ($mahasiswa) {
            Session::flash('status', 'success');
            Session::flash('message', 'Delete permanent data mahasiswa success');
        }
    
        return redirect()->back();
    }
}
