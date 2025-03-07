<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Reading;

class ReadingWebController extends Controller
{
    public function index()
    {
        return view('pageweb.reading.index');
    }

    public function getSoal()
    {
        $reading = Reading::first(); // Ambil satu data pertama
        return response()->json($reading->soal); // Kembalikan dalam format JSON
    }

}
