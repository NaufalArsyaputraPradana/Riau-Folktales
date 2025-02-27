<?php

namespace App\Http\Controllers;

use App\Models\Quis;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class QuisController extends Controller
{
    public function index()
    {
       
        $quis = Quis::orderBy('created_at', 'desc')->get();

        return view('pageadmin.managequis.index', compact('quis'));
    }

    public function create()
    {
       
        return view('pageadmin.managequis.create');
    }

    public function store(Request $request)
    {
       
        $validated = $request->validate([
            'soal' => 'required|array',
            'soal.*.gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'soal.*.pertanyaan' => 'required|string|max:255',
            'soal.*.pilihan.a' => 'required|string|max:255',
            'soal.*.pilihan.b' => 'required|string|max:255',
            'soal.*.pilihan.c' => 'required|string|max:255',
            'soal.*.pilihan.d' => 'required|string|max:255',
            'soal.*.jawaban' => 'required|in:a,b,c,d',
        ]);

        $soalProcessed = [];

        foreach ($validated['soal'] as $soal) {
            $gambarPath = null;

            // Periksa apakah gambar diunggah
            if (isset($soal['gambar']) && $soal['gambar'] instanceof \Illuminate\Http\UploadedFile) {
                $gambarPath = $soal['gambar']->move(public_path('uploads/soal-gambar'), $soal['gambar']->getClientOriginalName());
                $gambarPath = 'uploads/soal-gambar/' . $soal['gambar']->getClientOriginalName();
            }

            // Tambahkan soal yang diproses ke array
            $soalProcessed[] = [
                'pertanyaan' => $soal['pertanyaan'],
                'gambar' => $gambarPath,
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
        $quis = Quis::create([
            'soal' => $soalProcessed, // Simpan soal yang telah diproses
        ]);

        Alert::toast('Quis berhasil dibuat', 'success');
        return redirect()->route('quis.index');
    }




    public function edit($id)
    {
       
        $quis = Quis::find($id);
        return view('pageadmin.managequis.edit', compact('quis'));
    }

    public function update(Request $request, $id)
    {
       
        $quis = Quis::findOrFail($id);
    
        // Validation rules
        $validated = $request->validate([
            'soal' => 'required|array',
            'soal.*.gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            // Check if the 'soal' data exists for the given key in the existing 'ujian' record
            $gambarPath = null;
            if (isset($ujian->soal[$key]) && isset($ujian->soal[$key]['gambar'])) {
                // If the old image exists, use it as the default
                $gambarPath = $ujian->soal[$key]['gambar'];
            }
    
            // If the new image is uploaded, store it
            if (isset($soal['gambar']) && $soal['gambar'] instanceof \Illuminate\Http\UploadedFile) {
                // Delete the old image if it exists
                if ($gambarPath && file_exists(public_path($gambarPath))) {
                    unlink(public_path($gambarPath));
                }
    
                // Store the new image using move
                $gambarPath = 'uploads/soal-gambar/' . time() . '-' . $soal['gambar']->getClientOriginalName();
                $soal['gambar']->move(public_path('uploads/soal-gambar'), $gambarPath);
            }
    
            // Add the processed soal to the array
            $soalProcessed[] = [
                'pertanyaan' => $soal['pertanyaan'],
                'gambar' => $gambarPath,
                'pilihan' => $soal['pilihan'],
                'jawaban' => $soal['jawaban'],
            ];
        }
    
        // Update the ujian record with the new data
        $quis->update([
            'soal' => $soalProcessed,
        ]);

        // Success message and redirect
        Alert::toast('Quis berhasil diperbarui', 'success');
        return redirect()->route('quis.index');
    }
    
    



    public function destroy($id)
    {
        $quis = Quis::find($id);
        $quis->delete();
        Alert::success('Success', 'Quis berhasil dihapus');
        return redirect()->route('quis.index');
    }


    public function viewSoal($id)
    {
        
        $quis = Quis::find($id);  
        $soal = $quis->soal;     
        
        return view('pageadmin.managequis.view_soal', compact('soal'));
    }
    
}
