<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Quis;

class QuizWebController extends Controller
{
    public function index()
    {
        $soal = Quis::all()->map(function ($item) {
            // Decode JSON string agar dapat digunakan di view
            $item->soal = is_string($item->soal) ? json_decode($item->soal, true) : $item->soal;
            return $item->soal; // Mengirim soal sebagai array
        });

        return view('pageweb.quiz.index', compact('soal'));
    }
}
