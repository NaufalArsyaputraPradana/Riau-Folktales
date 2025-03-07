<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ScoreReading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ScoreReadingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $scoreReading = ScoreReading::where('user_id', $user->id)->first();
        return view('pageweb.reading.score', compact('scoreReading'));
    }

    public function scoreUpdateOrCreate(Request $request)
    {
        $user = Auth::user();

        // Validasi input skor
        $request->validate([
            'score' => 'required|numeric|min:0',
        ]);

        // Cek skor yang sudah ada
        $existingScore = ScoreReading::where('user_id', $user->id)->first();

        if (!$existingScore) {
            // Jika belum ada skor, buat baru
            $scoreReading = ScoreReading::create([
                'user_id' => $user->id,
                'score' => $request->score
            ]);
            return redirect()->route('pageweb.reading.score')->with('success', 'Skor berhasil disimpan.');
        } else {
            // Jika sudah ada skor, bandingkan dengan skor baru
            if ($request->score > $existingScore->score) {
                // Update hanya jika skor baru lebih tinggi
                $existingScore->update(['score' => $request->score]);
                return redirect()->route('pageweb.reading.score')->with('success', 'Skor berhasil diperbarui.');
            }
            return redirect()->route('pageweb.reading.score')->with('success', 'Skor Anda tidak berubah.');        }
    }

}
