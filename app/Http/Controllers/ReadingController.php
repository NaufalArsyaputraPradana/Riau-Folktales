<?php

namespace App\Http\Controllers;

use App\Models\Reading;
use App\Models\Cerita;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ReadingController extends Controller
{
    public function index()
    {
        $readings = Reading::all();
        return view('pageadmin.managereading.index', compact('readings'));
    }

    public function create()
    {
        return view('pageadmin.managereading.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'soal' => 'required|array|min:1',
            'soal.*' => 'required|string',
        ]);
    
        Reading::create([            'soal' => $request->soal, // Laravel akan otomatis menyimpan sebagai array jika di-cast di model
        ]);
    
        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('reading.index');
    }
    

    public function edit(Reading $reading)
    {
        return view('pageadmin.managereading.edit', compact('reading'));
    }

    public function update(Request $request, Reading $reading)
    {
        $request->validate([
            'soal' => 'required|array',
        ]);

        $reading->update([
            'soal' => $request->soal,
        ]);

        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->route('reading.index');
    }

    public function destroy(Reading $reading)
    {
        $reading->delete();
        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->route('reading.index');
    }
}
