<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:255',
            'rekomendasi' => 'required',
            'harga' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'image' => 'required|file|image|max:5000',

        ]);


        $id = 'AAA' . \Str::padLeft(Menu::select('id')->count() + 1, 3, '0');

        $fileExtension = $request->image->getClientOriginalExtension();
        $fileRename = "movieimg-" . time() . ".{$fileExtension}";
        $request->image->storeAs('public', $fileRename);

        $menu = Menu::create([
            'id' => $id,
            'nama' => $request->nama,
            'rekomendasi' => $request->rekomendasi,
            'harga' => $request->harga,
            'image' => $fileRename
        ]);

        $request->session()->flash('success', "Successfully adding {$menu->nama}!");
        return redirect()->route('menus.index');
    }
    public function imageUploadTesting(Request $request)
    {
        if ($request->hasFile('image')) {
            echo "Path: " . $request->image->path() . '<br>';
            echo "Extension: " . $request->image->extension() . '<br>';
            echo "Org. Extension: " . $request->image->getClientOriginalExtension() . '<br>';
            echo "MIME Type: " . $request->image->getMimeType() . '<br>';
            echo "Org. Filename: " . $request->image->getClientOriginalName() . '<br>';
            echo "Size: " . $request->image->getSize() . '<br>';
        } else {
            echo "No uploaded file!";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return view('menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:255',
            'rekomendasi' => 'required',
            'harga' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'image' => 'required|file|image|max:5000',
            ]);

            if($request->image){
                // Hapus file yg sudah ada
                \Storage::disk('public')->delete($menu->image);
                }
                $menu->update($validateData);

                $fileExtension = $request->image->getClientOriginalExtension();
                $fileRename = "movieimg-".time().".{$fileExtension}";
                $request->image->storeAs('public', $fileRename);

                $menu->image = $fileRename;
                $menu->save();

                $request->session()
                ->flash('success',"Successfully updating {$validateData['nama']}!");
                return redirect()->route('menus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        \Storage::disk('public')->delete($menu->image);
        $menu->delete();
        return redirect()->route('menus.index')->with(
        'success',"Successfully deleting {$menu['nama']}!"
        );
    }
}
