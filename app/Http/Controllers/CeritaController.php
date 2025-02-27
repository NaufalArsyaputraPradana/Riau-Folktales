<?php

namespace App\Http\Controllers;

use App\Models\Cerita;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CeritaController extends Controller
{
   public function index()
   {
    $ceritas = Cerita::all();
    return view('pageadmin.managecerita.index', compact('ceritas'));
   }

   public function create()
   {
    return view('pageadmin.managecerita.create');
   }

   public function store(Request $request)
   {
    $request->validate([
        'nama_cerita' => 'required',
        'deskripsi' => 'required',
        'cerita' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
    ]);

    $image = $request->file('image');
    $destinationPath = 'public/cerita';
    $imageName = $image->hashName();
    $image->move($destinationPath, $imageName);

    $cerita = Cerita::create([
        'nama_cerita' => $request->nama_cerita,
        'deskripsi' => $request->deskripsi,
        'cerita' => $request->cerita,
        'image' => $imageName,
    ]);

    Alert::success('Success', 'Cerita berhasil ditambahkan');
    return redirect()->route('cerita.index');
   }

   public function edit($id)
   {
    $cerita = Cerita::find($id);
    return view('pageadmin.managecerita.edit', compact('cerita'));
   }

   public function update(Request $request, $id)
   {
    $request->validate([
        'nama_cerita' => 'required',
        'deskripsi' => 'required',
        'cerita' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
    ]);

    $cerita = Cerita::find($id);
    if ($request->hasFile('image')) {
        $existingImage = $cerita->image;
        $image = $request->file('image');
        $destinationPath = 'public/cerita';
        $imageName = $image->hashName();
        $image->move($destinationPath, $imageName);
        $cerita->update([
            'nama_cerita' => $request->nama_cerita,
            'deskripsi' => $request->deskripsi,
            'cerita' => $request->cerita,
            'image' => $imageName,
        ]);
        if ($existingImage) {
            unlink(public_path($destinationPath . '/' . $existingImage));
        }
    } else {
        $cerita->update($request->all());
    }

    Alert::success('Success', 'Cerita berhasil diubah');
    return redirect()->route('cerita.index');
   }

   public function destroy($id)
   {
    $cerita = Cerita::find($id);
    $existingImage = $cerita->image;
    $cerita->delete();
    if ($existingImage) {
        unlink(public_path('public/cerita/' . $existingImage));
    }
    return redirect()->route('cerita.index');
   }
}
