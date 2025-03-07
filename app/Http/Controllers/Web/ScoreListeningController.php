<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ScoreListening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ScoreListeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $scoreListening = ScoreListening::where('user_id', $user->id)->first();
        return view('pageweb.listening.score', compact('scoreListening'));
    }

    public function scoreUpdateOrCreate(Request $request)
    {
        try {
            $user = Auth::user();
            
            // Cek skor yang sudah ada
            $existingScore = ScoreListening::where('user_id', $user->id)->first();
            
            if (!$existingScore) {
                // Jika belum ada skor, buat baru
                $score = ScoreListening::create([
                    'user_id' => $user->id,
                    'score' => $request->score
                ]);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Skor berhasil disimpan',
                    'score' => $score
                ]);
            } else {
                // Jika sudah ada skor, bandingkan dengan skor baru
                if ($request->score > $existingScore->score) {
                    // Update hanya jika skor baru lebih tinggi
                    $existingScore->update(['score' => $request->score]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Skor baru lebih tinggi! Berhasil diperbarui',
                        'score' => $existingScore
                    ]);
                }
                
                return response()->json([
                    'success' => false,
                    'message' => 'Skor tidak diperbarui karena lebih rendah dari skor sebelumnya',
                    'score' => $existingScore
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan skor: ' . $e->getMessage()
            ], 500);
        }
    }   

}
