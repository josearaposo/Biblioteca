<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLibroRequest;
use App\Http\Requests\UpdateLibroRequest;
use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
   {
       return view('libros.index', [
           'libros' => Libro::all(),
       ]);
   }


   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
       return view('libros.create');
   }



   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
       $validated = $request->validate([
           'titulo' => 'required|max:255',
           'autor' => 'required|max:255',


       ]);


       $libro = new Libro();
       $libro->titulo = $validated['titulo'];
       $libro->autor = $validated['autor'];
       $libro->save();
       session()->flash('success', 'El libro se ha creado correctamente.');
       return redirect()->route('libros.index');
   }


   /**
    * Display the specified resource.
    */
   public function show(Libro $libro)
   {
    return view('libros.show', [
        'libro' => $libro,
    ]);
   }


   /**
    * Show the form for editing the specified resource.
    */
   public function edit(Libro $libro)
   {
       return view('libros.edit', [
           'libro' => $libro,
       ]);
   }


   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, Libro $libro)
   {
    $validated = $request->validate([
        'titulo' => 'required|max:255',
        'autor' => 'required|max:255',


    ]);

    $libro->titulo = $validated['titulo'];
    $libro->autor = $validated['autor'];
    $libro->save();
    session()->flash('success', 'El libro se ha modificado correctamente.');
    return redirect()->route('libros.index');
   }


   /**
    * Remove the specified resource from storage.
    */
   public function destroy(Libro $libro)
   {
       $libro->delete();
       return redirect()->route('libros.index');
   }
}
