<?php

namespace App\Http\Controllers;

use App\Models\laptop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaptopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Merk Laptop';
        $laptops = laptop::all();
        $i = 1;
        return view('laptop.index',[
            'title' => $title,
            'laptops' => $laptops,
            'i' => $i,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create';
        return view('laptop.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        laptop::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'image'=>$request->file('image')->store('laptop-image')
        ]);
        return redirect()->route('laptop.index') ->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit CRUD";
        $laptop = laptop::findOrFail($id);
        return view('laptop.edit',[
            'laptop' => $laptop,
            'title' => $title
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(empty($request->file('image'))){
            $laptop = laptop::findOrFail($id);
            $laptop -> update([
                'name' => $request->name,
                'price' => $request->price
            ]);
            return redirect()->route('laptop.index') ->with('success', 'Data berhasil diedit');
        }
        else{
            $laptop = laptop::findOrFail($id);
            Storage::delete($laptop->image);
            $laptop -> update([
                'name' => $request->name,
                'price' => $request->price,
                'image'=>$request->file('image')->store('laptop-image')
            ]);
            return redirect()->route('laptop.index') ->with('success', 'Data berhasil diedit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $laptop = laptop::findOrFail($id);
        Storage::delete([$laptop->image]);
        $laptop->delete();
        return redirect()->route('laptop.index');
    }
}
