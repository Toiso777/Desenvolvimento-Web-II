<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Pedido;
use App\Endereco;
use DB;

class PedidoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $tipoProdutos = DB::select("select * from Tipo_Produtos");
        if(collect($tipoProdutos)->first())
        {
            $produtosDoPrimeiroTipo = DB::select("select * from Produtos
                                                  where Produtos.Tipo_Produtos_id = :id_produto", ['id_produto' => collect($tipoProdutos)->first()->id]);
        }
        else {
            $produtosDoPrimeiroTipo = null;
        }
        
        //var_dump(collect($tipoProdutos));
        //var_dump(collect($tipoProdutos)->first());
        //var_dump($produtosDoPrimeiroTipo);
        $pedidos = DB::select("select Pedidos.id from Pedidos 
                               join Enderecos on Pedidos.Enderecos_id = Enderecos.id
                               where Enderecos.Users_id = :user_id
                               order by Pedidos.id DESC", ['user_id' => $user->id]);
        
        $enderecos = DB::select("select * from Enderecos where Enderecos.Users_id = :user_id", ['user_id' => $user->id]);
        return view('Pedido.index')->with('pedidos', $pedidos)->with('tipoProdutos', $tipoProdutos)->with('produtosDoPrimeiroTipo', $produtosDoPrimeiroTipo)->with('enderecos', $enderecos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $endereco_id)
    {
        if(isset($endereco_id) && $endereco_id != 'null')
        {
            $user = Auth::user();
            $endereco = Endereco::find($endereco_id);
            if($endereco && $endereco->Users_id == $user->id){
                $pedido = new Pedido();
                $pedido->dataEHora = Carbon::now()->toDateTimeString();
                $pedido->status = "A";
                $pedido->Enderecos_id = $endereco_id;
                $pedido->save();

                $user = Auth::user();
                $pedidos = DB::select("select Pedidos.id from Pedidos 
                                    join Enderecos on Pedidos.Enderecos_id = Enderecos.id
                                    where Enderecos.Users_id = ?
                                    order by Pedidos.id DESC", [$user->id]);
                
                $response['success'] = true;
                $response['message'] = "Pedido criado com sucesso";
                $response['return'] = $pedidos;
                //echo json_encode($response);
                return response()->json( $response, 201 );
            }

            $response['success'] = false;
            $response['message'] = "Endereço não pertence ao usuário";
            //echo json_encode($response);
            return response()->json( $response, 401 );
            
        }
        else
        {
            $response['success'] = false;
            $response['message'] = "Endereço não definido";
            //echo json_encode($response);
            return response()->json( $response, 401 );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enviarPedido(Request $request, $pedido_id, $endereco_id)
    {
        if(isset($pedido_id) && $pedido_id != 'null' && isset($endereco_id) && $endereco_id != 'null')
        {
            $user = Auth::user();
            $endereco = Endereco::find($endereco_id);
            $pedido = Pedido::find($pedido_id);
            if($endereco && $endereco->Users_id == $user->id && $pedido && $pedido->Enderecos_id == $endereco->id){
                $somaPedidoProdutos = DB::select("select count(Pedido_Produtos.Pedidos_id) as soma_produtos
                                          from Pedido_Produtos
                                          join Pedidos on Pedido_Produtos.Pedidos_id = Pedidos.id
                                          join Enderecos on Pedidos.Enderecos_id = Enderecos.id
                                          where Enderecos.Users_id = :id_user and
                                                Pedidos.id = :id_pedido", ['id_user' => $user->id, 
                                                                           'id_pedido' => $pedido_id])[0];
                
                if($somaPedidoProdutos->soma_produtos > 0)
                {
                    $pedido->dataEHora = Carbon::now()->toDateTimeString();
                    $pedido->status = "E";
                    $pedido->update();

                    $user = Auth::user();
                    $pedidos = DB::select("select Pedidos.id from Pedidos 
                                        join Enderecos on Pedidos.Enderecos_id = Enderecos.id
                                        where Enderecos.Users_id = ?
                                        order by Pedidos.id DESC", [$user->id]);
                    
                    $response['success'] = true;
                    $response['return'] = $pedidos;
                    $response['message'] = "Pedido enviado com sucesso";
                    //echo json_encode($response);
                    return response()->json( $response, 201 );
                }
                $response['success'] = false;
                $response['message'] = "Não há produtos no pedido";
                //echo json_encode($response);
                return response()->json( $response, 401 );
            }
            $response['success'] = false;
            $response['message'] = "Pedido não pertence ao usuário";
            //echo json_encode($response);
            return response()->json( $response, 401 );
        }
        $response['success'] = false;
        $response['message'] = "Dados inválidos";
        //echo json_encode($response);
        return response()->json( $response, 401 );
    }
}
