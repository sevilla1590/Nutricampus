<?php

namespace App\Http\Controllers;

use App\Models\Cocinero;
use Illuminate\Http\Request;

class CocineroController extends Controller
{
    public function index()
    {
        $cocineros = Cocinero::all();

        return view('cocineros.index', compact('cocineros'));
    }

    public function create()
    {
        return view('cocineros.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:25',
            'especialidad' => 'nullable|string|max:20',
        ]);

        Cocinero::create($data);

        return redirect()->route('cocineros.index')->with('success', 'Cocinero created successfully');
    }

    public function show(Cocinero $cocinero)
    {
        return view('cocineros.show', compact('cocinero'));
    }

    public function edit(Cocinero $cocinero)
    {
        return view('cocineros.edit', compact('cocinero'));
    }

    public function update(Request $request, Cocinero $cocinero)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:25',
            'especialidad' => 'nullable|string|max:20',
        ]);

        $cocinero->update($data);

        return redirect()->route('cocineros.index')->with('success', 'Cocinero updated successfully');
    }

    public function destroy(Cocinero $cocinero)
    {
        $cocinero->delete();

        return redirect()->route('cocineros.index')->with('success', 'Cocinero deleted successfully');
    }
}
