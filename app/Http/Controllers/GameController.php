<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    private $game;
    public function __construct(Game $game)
    {
        $this->game = $game;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//       $game = Game::all();
//       return $game->toJson();
        //return response()->json($this->game->all());
        return response()->json($this->game->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       try{
           $gameData = $request->all();
           $this->game->create($gameData);
           $return = ['data'=> ['msg'=>'Game criado com sucesso']];
           return response()->json($return, 201);
       }catch(\Exception $e){
            return response()->json("Houve um erro ao realizar operação de salvar");
       }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = $this->game->find($id);
        if(! $game) return response()->json("Nao encontrado");

        $data = ['data' => $game];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        try{
            $gameData = $request->all();

            $game = $this->game->find($id);

            $game->update($gameData);
            $return = ['data'=> ['msg'=> 'Produto atualizado com sucesso']];

            return response()->json($return, 201);

        }catch(\Exception $e){
            return response()->json("Houve um erro ao realizar operação de salvar");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $id)
    {
        try{
            $id->delete();
            return response()->json(['data'=> ['msg'=> 'Produto ' . $id->name . ' removido com sucesso']], 200);
        }catch(\Exception $e){
            return response()->json('Houve um erro', 500);
        }
    }
}
