<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class Produtos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexView()
    {
        return view('produtos');
    }

    public function index()
    {
        $produtos = Produto::all();
        return json_encode($produtos);
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
        $produto = new Produto();
        $produto->name = $request->input('nome'); $produto->stock = $request->input('estoque');
        $produto->price = $request->input('preco'); $produto->categoria_id = $request->input('categoria');
        $produto->save();
        return json_encode($produto);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::find($id);
        if (isset($produto)){
            return json_encode($produto);
        } else {
            return response('Produto não encontrado', 404);
        }
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
        $produto = Produto::find($id);
        if(isset($produto)){
            $produto->name = $request->input('nome'); $produto->stock = $request->input('estoque');
            $produto->price = $request->input('preco'); $produto->categoria_id = $request->input('categoria');
            $produto->save();
            return json_encode($produto);
        } else {
            return response('Produto não encontrado', 404);
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
        $produto = Produto::find($id);
        if(isset($produto)){
            $produto->delete();
            return response('OK', 200);
        } else {
           return response('Produto não encontrado', 404);
        }
    }
}
