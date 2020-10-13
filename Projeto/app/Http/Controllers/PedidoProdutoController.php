<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\PedidoProduto;
use App\Pedido;
use App\Produto;
use App\Endereco;

class PedidoProdutoController extends Controller
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
     * Get pedidos list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPedidoProdutosList($id_pedido)
    {
        if(isset($id_pedido))
        {
            $user = Auth::user();
            $pedidoProdutos = DB::select("select Pedidos.id as id_pedido,
                                                 Produtos.id as id_produto,
                                                 Produtos.nome,
                                                 Produtos.preco,
                                                 Pedido_Produtos.quantidade,
                                                 Tipo_Produtos.descricao,
                                                 Pedidos.status
                                          from Pedido_Produtos
                                          join Produtos on Pedido_Produtos.Produtos_id = Produtos.id
                                          join Tipo_Produtos on Produtos.Tipo_Produtos_id = Tipo_Produtos.id
                                          join Pedidos on Pedido_Produtos.Pedidos_id = Pedidos.id
                                          join Enderecos on Pedidos.Enderecos_id = Enderecos.id
                                          where Enderecos.Users_id = :id_user and
                                                Pedidos.id = :id_pedido", ['id_user' => $user->id, 
                                                                           'id_pedido' => $id_pedido]);
            $response['success'] = true;
            $response['return'] = $pedidoProdutos;
            $response['message'] = "Operação concluída";
            //echo json_encode($response);
            return response()->json( $response, 201 );
        }
        else
        {
            $response['success'] = false;
            $response['message'] = "ID inválido";
            //echo json_encode($response);
            return response()->json( $response, 400 );
        }
    }

    /**
     * Get pedidos list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getTodosProdutosDeTipo($id_tipo)
    {
        //error_log($id_tipo);
        if(isset($id_tipo))
        {
            $produtosDeTipo = DB::select("select * from Produtos 
                                          where Produtos.Tipo_Produtos_id = :id_tipo", ["id_tipo" => $id_tipo]);
            $response['success'] = true;
            $response['message'] = "Operação concluída";
            $response['return'] = $produtosDeTipo;
            //echo json_encode($response);
            return response()->json( $response, 201 );
        }
        else
        {
            $response['success'] = false;
            $response['message'] = "ID inválido";
            //echo json_encode($response);
            return response()->json( $response, 400 );
        }
    }

    /**
     * Get pedidos list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request, $id_pedido, $id_produto, $id_endereco, $quantidade){
        // Se o ids de produto e pedido existirem
        if(Pedido::find($id_pedido) && Produto::find($id_produto) && Endereco::find($id_endereco) && $quantidade && $quantidade > 0 ){
            // Se o id de produto pertence a esse usuário
            $user = Auth::user();
            $pedido = DB::select("select * from Pedidos
                                  join Enderecos on Pedidos.Enderecos_id = Enderecos.id
                                  where Pedidos.id = :id_pedido and
                                        Enderecos.Users_id = :id_user", ['id_pedido' => $id_pedido,
                                                                         'id_user' => $user->id]);
            if($pedido){
                $pedidoProduto = PedidoProduto::where('Pedidos_id', $id_pedido)->where('Produtos_id', $id_produto)->first();
                if($pedidoProduto){
                    $pedidoProduto->Pedidos_id = $id_pedido;
                    $pedidoProduto->Produtos_id = $id_produto;
                    $pedidoProduto->quantidade += $quantidade;
                    $pedidoProduto->update();
                } else{
                    $pedidoProduto = new PedidoProduto();
                    $pedidoProduto->Pedidos_id = $id_pedido;
                    $pedidoProduto->Produtos_id = $id_produto;
                    $pedidoProduto->quantidade = $quantidade;
                    $pedidoProduto->save();
                }
                
                $response['success'] = true;
                $response['return'] = $pedidoProduto;
                $response['message'] = "Produto adicionado no pedido.";
                //echo json_encode($response);
                return response()->json( $response, 201 );
            }
        }
        $response['success'] = false;
        $response['message'] = "Estranho";
        //echo json_encode($response);
        return response()->json( $response, 400 );
    }

    /**
     * Get pedidos list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(Request $request, $id_pedido, $id_produto){
        // Se o ids de produto e pedido existirem
        if(Pedido::find($id_pedido) && Produto::find($id_produto)){
            // Se o id de produto pertence a esse usuário
            $user = Auth::user();
            $pedido = DB::select("select * from Pedidos
                                  join Enderecos on Pedidos.Enderecos_id = Enderecos.id
                                  where Pedidos.id = :id_pedido and
                                        Enderecos.Users_id = :id_user", ['id_pedido' => $id_pedido,
                                                                         'id_user' => $user->id]);
            if($pedido){
                $pedidoProduto = PedidoProduto::where('Pedidos_id', $id_pedido)->where('Produtos_id', $id_produto)->first();
                if($pedidoProduto){
                    $pedidoProduto->delete();
                    $response['success'] = true;
                    $response['message'] = "Produto removido com sucesso.";
                    $response['return'] = null;
                    return response()->json( $response, 201 );
                }
                $response['success'] = false;
                $response['message'] = "O produto dentro do pedido não foi encontrado";
                return response()->json( $response, 400 );
            }
            $response['success'] = false;
            $response['message'] = "O pedido não pertence a esse usuário";
            return response()->json( $response, 400 );
        }
        $response['success'] = false;
        $response['message'] = "Dados informados para a função incorretos";
        return response()->json( $response, 400 );
    }
}
