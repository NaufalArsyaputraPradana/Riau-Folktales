<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cerita;
class IndexWebController extends Controller
{
    public function index()
    {
        return view('pageweb.index');
    }
    
}
