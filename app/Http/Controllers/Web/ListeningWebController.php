<?php

namespace App\Http\Controllers\Web;

use App\Models\Listening;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListeningWebController extends Controller
{
    public function index()
    {
        $soal = Listening::all()->map(function ($item) {
            // Decode JSON string agar dapat digunakan di view
            $item->soal = is_string($item->soal) ? json_decode($item->soal, true) : $item->soal;
            return $item->soal; // Mengirim soal sebagai array
        });

        return view('pageweb.listening.index', compact('soal'));
    }
}
