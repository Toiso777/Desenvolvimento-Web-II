<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Endereco;


class EnderecoController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $enderecos = json_decode(\json_encode(DB::select("select enderecos.*, users.name from enderecos 
                                                        inner join users on users.id = enderecos.users_id;")), 
                                                        true);
        return view('endereco.index')->with([
            "enderecos" => $enderecos,
            ]);
    }

    public function create()
    {
        $users = User::all();
        return view('endereco.create')->with("users", $users);
    }

    public function store(Request $request)
    {
        $endereco = new Endereco();
        $endereco->users_id = $request->user_id;
        $endereco->bairro = $request->bairro;
        $endereco->logradouro = $request->logradouro;
        $endereco->numero = $request->numero;
        $endereco->complemento = $request->complemento;
        $endereco->save();
        return \redirect()->route('endereco.index');
    }

    public function show($id)
    {
        $users = User::all();
        $endereco = Endereco::find($id);
        if(isset($endereco)){
            return \view('endereco.show')->with([
                'endereco' => $endereco,
                'users' => $users
                ]);
        }
        return \redirect()->route('endereco.index');
    }

    public function edit($id)
    {
        $users = User::all();
        $endereco = Endereco::find($id);
        if(isset($endereco)){
            return \view('endereco.edit')->with([
                'endereco' => $endereco,
                'users' => $users
                ]);
        }
        return \redirect()->route('endereco.index');
    }

    public function update(Request $request, $id)
    {
        $endereco = Endereco::find($id);

        if(isset($endereco)){
            $endereco->users_id = $request->user_id;
            $endereco->bairro = $request->bairro;
            $endereco->logradouro = $request->logradouro;
            $endereco->numero = $request->numero;
            $endereco->complemento = $request->complemento;
            $endereco->update();
        }else{
            return \redirect()->route('endereco.index');
        }
    }

    public function destroy($id)
    {
        $endereco = Endereco::find($id);
        if(isset($endereco)){
            $endereco->delete();
        }
        return \redirect()->route('endereco.index');
    }
}
