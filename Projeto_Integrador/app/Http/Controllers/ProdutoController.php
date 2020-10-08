<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\TipoProduto;
use DB;

class ProdutoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = json_decode(json_encode(DB::select("select produtos.id, produtos.nome, tipo_produtos.descricao
                                                        from produtos
                                                        join tipo_produtos on produtos.Tipo_Produtos_id = tipo_produtos.id"
                                                      )), true);
        return view('Produto.index')->with('produtos', $produtos);
        //return view('usuario');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoProdutos = TipoProduto::all();
        return view('Produto.create')->with('tipoProdutos', $tipoProdutos);;
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
        $produto->nome = $request->nome;
        $produto->preco = $request->preco;
        $produto->tipo_produtos_id = $request->tipo;
        $produto->save();
        return redirect()->route('produto.index');
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
        if(isset($produto))
        {
            $tiposDeProduto = TipoProduto::all();
            return view("Produto.show")->with('tiposDeProduto', $tiposDeProduto)->with('produto', $produto);
        }
        return redirect()->route('produto.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Produto::find($id);
        if(isset($produto))
        {
            $tipoProdutos = TipoProduto::all();
            return view('Produto.edit')->with('tipoProdutos', $tipoProdutos)->with('produto', $produto);
        }
        return redirect()->route('produto.index');
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
        if(isset($produto))
        {
            $produto->nome = $request->nome;
            $produto->preco = $request->preco;
            $produto->Tipo_Produtos_id = $request->tipo;
            $produto->update();
        }
        return redirect()->route('produto.index');
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
        if(isset($produto))
        {
            $produto->delete();
        }
        return redirect()->route('produto.index');
    }
}
