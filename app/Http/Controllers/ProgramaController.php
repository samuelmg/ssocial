<?php

namespace App\Http\Controllers;

use App\Models\Prestador;
use App\Models\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class ProgramaController extends Controller
{
    private $rules;

    public function __construct()
    {
        $this->middleware('auth')->except('show');
        //$this->authorizeResource(Programa::class, 'programa');

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
        //$programas = Auth::user()->programas()->with('user:id,name')->get();
        $programas = Programa::with('user:id,name')->get();
        return view('programa.programa-index', compact('programas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create');
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
        Gate::authorize('admin-programas');

        $request->validate($this->rules + ['folio' => ['required', 'integer', 'unique:App\Models\Programa,folio']]);

        // Crear el programa haciendo merge para agregar user_id al $request
        // $request->merge(['user_id' => Auth::id()]); // Agrega user_id a $request, como si lo hubieramos mandado en el formulario
        // Programa::create($request->all()); //Crea Programa en la DB

        // Crea el programa utilizando save()
        $programa = new Programa($request->all()); // Crea una instancia en memoria de Programa
        $user = Auth::user();                      // Obtiene la instancia del User. Equivalente a: $user = User::find(Auth::id());
        $user->programas()->save($programa);       // Crea el registro en la DB del Programa.

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
        $prestadores = Prestador::get();
        return view('programa.programa-show', compact('programa', 'prestadores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function edit(Programa $programa)
    {
        $this->authorize('update', $programa);
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
        if ($request->user()->cannot('update', $programa)) {
            abort(403);
        }
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

    /**
     * Agregar un prestador a un programa
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function agregaPrestador(Request $request, Programa $programa)
    {
        $programa->prestadores()->sync($request->prestador_id);

        return redirect()->route('programa.show', $programa);
    }
}
