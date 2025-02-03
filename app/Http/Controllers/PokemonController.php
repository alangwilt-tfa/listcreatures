<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePokemonRequest;
use App\Http\Requests\UpdatePokemonRequest;

class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = request()->query();

        $per_page = $query['per_page'] ?? 15;
        $search = !empty($query['search']) ? $query['search'] : '';
        $qtype = !empty($query['type']) ? $query['type'] : '';

        $pokeQuery = DB::table('pokemon');

        if (!empty($search)) {
            $pokeQuery->whereLike('pokemon', '%' . $search . '%');
        }

        if (!empty($qtype)) {
            $pokeQuery->where(function(Builder $query) use ($qtype) {
                $query->where('type_1', '=', $qtype)->orWhere('type_2', '=', $qtype);
            });
        }

        $pokes = $pokeQuery->paginate($per_page);

        $types = Pokemon::all('type_1', 'type_2');
        $types1 = $types->pluck('type_1');
        $types2 = $types->pluck('type_2');

        $merged_types = $types1->merge($types2)->unique();

        return view('pokedex.all', [
            'pokemon' => $pokes,
            'types' => $merged_types,
            'params' => [
                'search' => $search,
                'type' => $qtype
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePokemonRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pokemon $pokemon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pokemon $pokemon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePokemonRequest $request, Pokemon $pokemon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pokemon $pokemon)
    {
        //
    }
}
