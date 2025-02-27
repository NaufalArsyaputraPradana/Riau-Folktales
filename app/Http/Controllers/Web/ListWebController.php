<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cerita;
class ListWebController extends Controller
{
    public function index()
    {
        $ceritas = Cerita::all();
        return view('pageweb.list', compact('ceritas'));
    }
}
