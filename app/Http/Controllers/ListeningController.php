<?php

namespace App\Http\Controllers;

use App\Models\Listening;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class ListeningController extends Controller
{
    public function index()
    {

        $listening = Listening::orderBy('created_at', 'desc')->get();

        return view('pageadmin.managelistening.index', compact('listening'));
    }

    public function create()
    {

        return view('pageadmin.managelistening.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'soal' => 'required|array',
            'soal.*.suara' => 'required|string|max:255',
            'soal.*.pertanyaan' => 'required|string|max:255',
            'soal.*.pilihan.a' => 'required|string|max:255',
            'soal.*.pilihan.b' => 'required|string|max:255',
            'soal.*.pilihan.c' => 'required|string|max:255',
            'soal.*.pilihan.d' => 'required|string|max:255',
            'soal.*.jawaban' => 'required|in:a,b,c,d',
        ]);

        $soalProcessed = [];

        foreach ($validated['soal'] as $soal) {

            // Tambahkan soal yang diproses ke array
            $soalProcessed[] = [
                'suara' => $soal['suara'],
                'pertanyaan' => $soal['pertanyaan'],
                'pilihan' => [
                    'a' => $soal['pilihan']['a'],
                    'b' => $soal['pilihan']['b'],
                    'c' => $soal['pilihan']['c'],
                    'd' => $soal['pilihan']['d'],
                ],
                'jawaban' => $soal['jawaban'],
            ];
        }

        // Simpan ujian
        $listening = Listening::create([
            'soal' => $soalProcessed, // Simpan soal yang telah diproses
        ]);

        Alert::toast('Listening berhasil dibuat', 'success');
        return redirect()->route('listening.index');
    }

    public function edit($id)
    {

        $listening = Listening::find($id);
        return view('pageadmin.managelistening.edit', compact('listening'));
    }

    public function update(Request $request, $id)
    {

        $listening = Listening::findOrFail($id);

        // Validation rules
        $validated = $request->validate([
            'soal' => 'required|array',
            'soal.*.suara' => 'required|string|max:255',
            'soal.*.pertanyaan' => 'required|string|max:255',
            'soal.*.pilihan.a' => 'required|string|max:255',
            'soal.*.pilihan.b' => 'required|string|max:255',
            'soal.*.pilihan.c' => 'required|string|max:255',
            'soal.*.pilihan.d' => 'required|string|max:255',
            'soal.*.jawaban' => 'required|in:a,b,c,d',
        ]);

        // Process soal
        $soalProcessed = [];
        foreach ($validated['soal'] as $key => $soal) {


            // Add the processed soal to the array
            $soalProcessed[] = [
                'suara' => $soal['suara'],
                'pertanyaan' => $soal['pertanyaan'],
                'pilihan' => $soal['pilihan'],
                'jawaban' => $soal['jawaban'],
            ];
        }

        // Update the ujian record with the new data
        $listening->update([
            'soal' => $soalProcessed,
        ]);

        // Success message and redirect
        Alert::toast('Listening berhasil diperbarui', 'success');
        return redirect()->route('listening.index');
    }


    public function destroy($id)
    {
        $listening = Listening::find($id);
        $listening->delete();
        Alert::success('Success', 'Listening berhasil dihapus');
        return redirect()->route('listening.index');
    }


    public function viewSoal($id)
    {

        $listening = Listening::find($id);
        $soal = $listening->soal;

        return view('pageadmin.managelistening.view_soal', compact('soal'));
    }

}
