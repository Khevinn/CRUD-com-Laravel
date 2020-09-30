<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heroes = Hero::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(3);
        return view('heroes.index', compact('heroes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('heroes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $hero = new Hero($request->all());

        $hero->user_id = Auth::id();

        $hero->save();

        return redirect('heroes')->with('success', 'Hero has been added with success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hero  $hero
     * @return \Illuminate\Http\Response
     */
    public function show(Hero $hero)
    {
        return view('heroes.show', compact('hero'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hero  $hero
     * @return \Illuminate\Http\Response
     */
    public function edit(Hero $hero)
    {
        if($hero->user_id === Auth::id()){
            return view('heroes.edit', compact('hero'));
        }else{
            return redirect()->route('heroes.index')
            ->with('error', "You don't have permission to edit this, because are not the author!")
            ->withInput();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hero  $hero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hero $hero)
    {
        if($hero->user_id === Auth::id()){
          $hero->update($request->all());
          return redirect()->route('heroes.index')->with('success', 'Hero has been updated!');
        }else{
            return redirect()->route('heroes.index')
            ->with('error', "You don't have permission to edit this, because are not the author!")
            ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hero  $hero
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hero $hero)
    {
        if($hero->user_id === Auth::id()){
            $hero->delete();
        return redirect()->route('heroes.index')->with ('success', 'Hero has been deleted!');

        }else{
            return redirect()->route('heroes.index')
            ->with('error', "You don't have permission to delete this, because are not the author!")
            ->withInput();
        }
    }
}
