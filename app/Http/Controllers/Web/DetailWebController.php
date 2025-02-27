<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cerita;
class DetailWebController extends Controller
{
    public function index($nama_cerita)
    {
        $cerita = Cerita::where('nama_cerita', $nama_cerita)->first();
        return view('pageweb.detail', compact('cerita'));
    }
}
