<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProgramaController extends Controller
{
    private $rules;

    public function __construct()
    {
        $this->middleware('auth')->except('show');

        $this->rules = [
            'nombre' => ['required', 'string', 'min:5', 'max:255'],
            'titular' => ['required', 'string', 'min:5', 'max:255'],
            'dependencia' => 'required|string|min:5|max:255',
            'calendario' => 'required|string|min:4|max:6',
        ];
    }

    /**
     * Muestra el listado de programas del usuario logeado
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programas = Auth::user()->programas;

        return view('programa.programa-index', compact('programas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('programa.programa-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->rules + ['folio' => ['required', 'integer', 'unique:App\Models\Programa,folio']]);
        $request->merge(['user_id' => Auth::id()]);
        Programa::create($request->all());

        return redirect()->route('programa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function show(Programa $programa)
    {
        return view('programa.programa-show', compact('programa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function edit(Programa $programa)
    {
        return view('programa.programa-form', compact('programa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programa $programa)
    {
        $request->validate($this->rules + ['folio' => [
            'required',
            'integer',
            Rule::unique('programas')->ignore($programa->id),
        ]]);

        Programa::where('id', $programa->id)->update($request->except('_token', '_method'));

        return redirect()->route('programa.show', $programa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programa $programa)
    {
        $programa->delete();
        return redirect()->route('programa.index');
    }
}
