function setupDestroyModal(event){
    event = event || window.event;
    var targ = event.target || event.srcElement || event;
    if (targ.nodeType == 3) targ = targ.parentNode; // defeat Safari bug
    const formDelete = document.querySelector('#id-form-delete');
    formDelete.setAttribute("action", targ.value);
}

function buildSuccessMessageBox(message){
    return `<div class="alert alert-success alert-dismissible fade show fixed-top" role="alert">
                    ${message}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>`
}

function buildErrorMessageBox(message){
    return `<div class="alert alert-danger alert-dismissible fade show fixed-top" role="alert">
                    ${message}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>`
}

$(function () {
    // Habilita os dismiss dos alert
    //$('.alert').alert();

    // Configura o SPINNER de quantidade de itens
    $( "#id-spinner-quantity" ).spinner({
                                            min:1,
                                            max:100,
                                            create: function (event, ui) {
                                                                            $(this).closest(".ui-spinner").addClass('w-100');
                                                                         }
                                        });
    
    // Cria novos pedidos
    $('#id-form-novo-pedido').on('submit', function(event) {
        event.preventDefault();
        const endereco_id = $('#id-selecao-endereco').val();
        $.ajax({
            type: "POST",
            url: `/pedido/${endereco_id}`,
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response){
                $('#id-pedidos-list').html("");
                response.return.forEach(element => {
                    $('#id-pedidos-list').append(`<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab" value=${element.id}>Pedido ${element.id}</a>`);
                });
                $('#id-pedidos-list a:first-child').click();
                $('.messageBox').html(buildSuccessMessageBox(response.message));
            },
            error: function(error){
                $('.messageBox').html(buildErrorMessageBox(error.responseJSON.message));
            }
        });
    });

    // Atualiza lista de pedido e produtos
    $('#id-pedidos-list').on('click', function(event) {
        event.preventDefault();
        var id = event.target.getAttribute('value');
        $.ajax({
            type: "GET",
            url: `/pedidoproduto/getPedidoProdutosList/${id}`,
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response){
                $('#id-pedido-produtos-list').html("");
                let preco = 0;
                response.return.forEach(element => {
                    preco += Number(element.preco)*Number(element.quantidade);
                    $('#id-pedido-produtos-list').append(`<li href="#" class="list-group-item">
                                                               ${element.descricao} - ${element.nome} - ${element.quantidade}x
                                                               <button class="btn btn-danger class-remove-button" onclick="setupDestroyModal(this)" data-toggle="modal" data-target="#id-destroy-modal" value="/pedidoproduto/${element.id_pedido}/${element.id_produto}">
                                                                   <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                       <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                                                       <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                                                   </svg>
                                                                </button>
                                                           </li>`);
                });
                $('#id-span-preco').html(preco.toLocaleString('pt-BR', {minimumFractionDigits: 2}));
                if(response.return.length == 0)
                    $('#id-text-estado').val("Estado: Sem produtos");
                else
                {
                    if(response.return[0].status == 'A')
                        $('#id-text-estado').val("Estado: Aberto");
                    else
                        $('#id-text-estado').val("Estado: Enviado");
                }
            },
            error: function(error){
                $('.messageBox').html(buildErrorMessageBox(error.responseJSON.message));
            }
        });
    });

    // Faz o dropdown de produtos atualizar com base no tipo de produto que está em outro dropdown
    $('#id-selecao-tipo-produto').on('change', function (event){
        const tipoProdutoId = event.target.value;
        $.ajax({
            type: "GET",
            url: `/pedidoproduto/getTodosProdutosDeTipo/${tipoProdutoId}`,
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response){
                $('#id-selecao-produto').html("");
                response.return.forEach(element => {
                    $('#id-selecao-produto').append(`<option value="${element.id}">${element.nome}</option>`);
                });
            },
            error: function(error){
                $('.messageBox').html(buildErrorMessageBox(error.responseJSON.message));
            }
        });
    });

    // Adicionar produtos no pedido
    $('#id-botao-adicionar-produto').on('click', function (event){
        event.preventDefault();
        let id_pedido;
        if($('#id-pedidos-list a.active')[0]){
            id_pedido = $('#id-pedidos-list a.active')[0].getAttribute("value");
        }
        const id_endereco = $('#id-selecao-endereco').val();
        const id_produto = $('#id-selecao-produto').val();
        const quantidade = $('#id-spinner-quantity').val();
        if(id_pedido && id_endereco && id_produto && quantidade)
        {
            $.ajax({
                type: "POST",
                url: `/pedidoproduto/${id_pedido}/${id_produto}/${id_endereco}/${quantidade}`,
                data: $('#id-form-add-pedido-produto').serialize(),
                dataType: 'json',
                success: function(response){
                    $('#id-pedidos-list a.active').click();
                },
                error: function(error){
                    $('.messageBox').html(buildErrorMessageBox(error.responseJSON.message));
                }
            });
        }  
    });

    // Botão remover
    $('#id-botao-form-delete').on('click', function (event){
        event.preventDefault();
        $.ajax({
            type: "delete",
            url: $('#id-form-delete').attr('action'),
            data: $('#id-form-delete').serialize(),
            dataType: 'json',
            success: function(response){
                $('#id-pedidos-list a.active').click();
                $('#id-destroy-modal').modal('hide');
                $('.messageBox').html(buildSuccessMessageBox(response.message));
            },
            error: function(error){
                $('.messageBox').html(buildErrorMessageBox(error.responseJSON.message));
            }
        });     
    });

    // Botão enviar pedido
    $('#id-botao-enviar-pedido').on('click', function (event){
        event.preventDefault();
        const id_pedido = $('#id-pedidos-list a.active')[0].getAttribute("value");
        const id_endereco = $('#id-selecao-endereco').val();
        $.ajax({
            type: "post",
            url: `/pedido/${id_pedido}/${id_endereco}`,
            data: $('#id-form-enviar-pedido').serialize(),
            dataType: 'json',
            success: function(response){
                $('#id-pedidos-list a.active').click();
                $('.messageBox').html(buildSuccessMessageBox(response.message));
            },
            error: function(error){
                $('.messageBox').html(buildErrorMessageBox(error.responseJSON.message));
            }
        });     
    });

    // Faz o dropdown de endereços atualizar o pedido
    /*$('#id-selecao-tipo-produto').on('change', function (event){
        const tipoProdutoId = event.target.value;
        $.ajax({
            type: "GET",
            url: `/pedidoproduto/getTodosProdutosDeTipo/${tipoProdutoId}`,
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response){
                $('#id-selecao-produto').html("");
                response.return.forEach(element => {
                    $('#id-selecao-produto').append(`<option value="${element.id}">${element.nome}</option>`);
                });
                //$('.messageBox').html(buildSuccessMessageBox(response));
            },
            error: function(error){
                $('.messageBox').html(buildErrorMessageBox(error.responseJSON));
            }
        });
    });*/
});