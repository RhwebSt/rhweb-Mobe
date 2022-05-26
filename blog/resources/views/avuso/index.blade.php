@extends('layouts.index')
@section('titulo','Rhweb - Recibo Avulso')
@section('conteine')

<main role="main">
    <div class="container">
        @if(session('success'))
            <script>
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  html: '<p class="modal__aviso">{{session("success")}}</p>',
                  background: '#45484A',
                  showConfirmButton: true,
                  timer: 2500,
        
                });
            </script>
            @endif
            @error('false')
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    html: '<p class="modal__aviso">{{ $message }}</p>',
                    background: '#45484A',
                    showConfirmButton: true,
                    timer: 5000,
        
                });
            </script>
        @enderror
        
        <!--Modal de Acesso não permitido-->
        <!--<script>-->
        <!--    Swal.fire({-->
        <!--      icon: 'error',-->
        <!--      allowOutsideClick: false,-->
        <!--      allowEscapeKey: false,-->
        <!--      allowEnterKey: true,-->
        <!--      html: '<h1 class="fw-bold mb-3 fs-3">Permissão Negada!</h1>'+-->
        <!--      '<p class=" mb-4 fs-6">Contate seu Administrador para receber acesso.</p>'+-->
        <!--      '<div><a class="btn btn-secondary mb-3" href="{{route("home.index")}}">Voltar</a></div>',-->
        <!--      showConfirmButton: false,-->
        <!--    });-->
        <!--</script>-->
        <!--Fim do modal de Acesso não permitido-->

        <!--Modal de não permitido para o Editar, relatorio, excluir e outros botoes-->
        <!--<script>-->
        <!--    Swal.fire({-->
        <!--        icon: 'error',-->
        <!--        title: 'Você não tem Permissão',-->
        <!--        text: 'Contate seu Administrador para receber acesso.',-->
        <!--        allowOutsideClick: false,-->
        <!--        allowEscapeKey: false,-->
        <!--        allowEnterKey: true,-->
        <!--    });-->
        <!--</script>-->
        <!--fim do modal-->
        
        <section class="section__botoes--recibo-avulso">
            
            <div class="d-flex justify-content-start align-items-start div__voltar">
                <a class="botao__voltar" href="{{route('home.index')}}"><i class="fad fa-arrow-left"></i> Voltar </a>
            </div>
            
            <div class="d-flex justify-content-center align-items-center mx-auto mt-4" role="button" aria-label="Basic example">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item pill__item ms-1 mt-1" role="presentation">
                        <button class="nav-link botao__pill" id="info-avulso-tab" data-bs-toggle="pill" data-bs-target="#info-avulso" type="button" role="tab" aria-controls="info-avulso" aria-selected="true"><i class="fad fa-file-invoice-dollar"></i> Recibo Avulso</button>
                    </li>
                    <li class="nav-item pill__item ms-1 mt-1" role="presentation">
                        <button class="nav-link botao__pill" id="lista-avulso-tab" data-bs-toggle="pill" data-bs-target="#lista-avulso" type="button" role="tab" aria-controls="lista-avulso" aria-selected="false"><i class="fad fa-th-list"></i> Lista Recibos Avulsos</button>
                    </li>
                    <li class="nav-item pill__item ms-1 mt-1" role="presentation">
                        <button class="nav-link botao__pill" id="rol-avulso-tab" data-bs-toggle="pill" data-bs-target="#rol-avulso" type="button" role="tab" aria-controls="rol-avulso" aria-selected="false"><i class="fad fa-th-list"></i> Rol dos Recibos Avulsos</button>
                    </li>
                </ul>
            </div>
        
        </section>

        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show" id="info-avulso" role="tabpanel" aria-labelledby="info-avulso-tab">
                
                <h1 class="title__recibo-avulso">Gerar Recibo Avulso <i class="fad fa-calculator"></i></h1>
                
                <section class="section__recibo--avulso--pill">
                    <form class="row g-3" action="{{route('avuso.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="empresa" value="{{$user->empresa_id}}">
        
                        <div class="col-12 col-md-6">
                            <label for="nome__completo" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Nome Completo</label>
                            <input type="text" class="form-control @error('nome') is-invalid @enderror" value="{{old('nome')}}" name="nome" maxlength="40" id="nome">
                            @error('nome')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <div class="col-12 col-md-6">
                            <label for="cpf" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> CPF/CNPJ</label>
                            <input type="text" class="form-control @error('cpf') is-invalid @enderror" value="{{old('cpf')}}" name="cpf" maxlength="15" id="cpf">
                            @error('cpf')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <?php
                        if (isset($valorrublica_avuso->vsreciboavulso)) {
                            $avuso = $valorrublica_avuso->vsreciboavulso + 1;
                        } else {
                            $avuso = 1;
                        }
                        ?>
                        
                        <input type="hidden" name="codigo" value="{{$avuso}}">
                        
                        <div class="col-12 col-sm-6">
                            <label for="ano" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Data Inicial</label>
                            <input type="date" class="form-control @error('ano_inicial') is-invalid @enderror" name="ano_inicial" value="{{old('ano_inicial')}}" id="ano_inicial">
                            <div class="mt-1">
                                @error('ano_inicial')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="col-12 col-sm-6">
                            <label for="ano" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Data Final</label>
                            <input type="date" class="form-control @error('ano_final') is-invalid @enderror" name="ano_final" value="{{old('ano_final')}}" id="anoFinal">
                            <div class="mt-1">
                                @error('ano_final')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <section class="section__items-avulso">
                                <div class="row mb-3" id="conteiner">
                                    
                                    <div class="col-12 col-md-5 mt-2">
                                        <label for="descricao" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Descrição</label>
                                        <input type="text" class="form-control @error('descricao0') is-invalid @enderror" name="descricao0" maxlength="100" id="descricao">
                                        <div class="mt-1">
                                            @error('descricao0')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-12 col-md-3 mt-2">
                                        <label for="valor" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i>Valor</label>
                                        <input type="text" class="form-control @error('valor0') is-invalid @enderror" name="valor0" maxlength="100" id="valor">
                                        <div class="mt-1">
                                            @error('valor0')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-12 col-md-3 mt-2">
                                        <label for="cd" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Crédito/Desconto</label>
                                        <select id="cd" name="cd0" class="form-select">
                                            <option selected>Crédito</option>
                                            <option>Desconto</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-1 align-self-center mt-4">
                                        <i class="fad fa-lg fa-lock-alt"></i>
                                    </div>
        
                                </div>
                        </section>
                        
                        <div class="d-grid d-md-flex justify-content-md-end mb-5">
                            <div class="mt-4 mb-5">
                                <a type="text" class="btn botao" id="adicinar">Adicionar <i class="fas fa-plus"></i></a>
                                <button type="submit" class="btn botao" id="campo1">Gerar recibo <i class="fad fa-save"></i></button>
                            </div>
                        </div>

                        <input type="hidden" name="quantidade" value="1" id="quantidade">

                    </form>
                
                </section>

            </div>
    
    
            <div class="tab-pane fade" id="lista-avulso" role="tabpanel" aria-labelledby="lista-avulso-tab">
                
                <h1 class="title__recibo-avulso">Lista Recibos Avulsos <i class="fad fa-industry"></i></h1>
                
                <section class="section__lista--avulso">
    
                    <form class="row g-3" action="{{route('filtra.pesquisa.avuso')}}" method="POST">
                        @csrf
                        <section class="section__search">
                            <div class="col-md-5">
                                
                                    
                                    <div class="d-flex">
                                        
                                        <input placeholder="clique ou digite para pesquisar" class="form-control" list="listatrabalhador" name="pesquisa" id="pesquisatrabalhador">
                                        <datalist id="listatrabalhador"></datalist>
        
                                        <input type="hidden" name="codicao" value="{{isset($trabalhador->id)?$trabalhador->id:''}}">
                                        
                                        <button class="btn botao__search">
                                            <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                        </button>
        
                                    </div>
                                    
                                
                            </div>
                        </section>
        
                        <section class="row section__filtro-avulso">
                            <div class="col-12 col-md-3">
                                <label for="ano" class="form-label">Competência</label>
                                <input type="month" class="form-control " name="competencia" value="" id="tano1Final">
                            </div>

                            <div class="col-md-2 align-self-center pt-4">
                                <button type="submit" class="btn botao">Filtrar <i class="fad fa-filter"></i></button>
                            </div>
                        </section>
        
        
                    </form>
        
        
                    
                    
                    <section>
                        <div class="d-flex justify-content-end">
                            <div>
                                <div class="dropdown">
                                    <button class="btn button__filter dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fad fa-sort"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown__filtro" aria-labelledby="dropdownMenuButton2">
                                      <li><a class="dropdown-item dropdown__links--filter" href="{{route('filtra.ordem.avuso','asc')}}"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                                      <li><a class="dropdown-item dropdown__links--filter" href="{{route('filtra.ordem.avuso','desc')}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                    </ul>
                                  </div>
                            </div>
        
                        </div>
                    </section>
        
        
                    <section class="table">
                        <div class="table-responsive-xxl">
                            <table class="table">
                                
                                <thead class="tr__header">
                                    <th class="th__header text-nowrap">Nome</th>
                                    <th class="th__header text-nowrap" style="width:150px;">CPF/CNPJ </th>
                                    <th class="th__header text-nowrap">Data inicial</th>
                                    <th class="th__header text-nowrap">Data Final</th>
                                    <th class="th__header text-nowrap" style="width:110px;">Nº Avulso</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Imprimir</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Excluir</th>
                                </thead>
                                
                                <tbody class="table__body">
                                    @if(count($lista)>0)
                                    @foreach($lista as $listas)
                                    <tr class="tr__body">
                                        
                                        <td class="td__body text-nowrap col limitaCarcteres" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$listas->asnome}}">
                                                <a>{{$listas->asnome}}</a>
                                        </td>
                                        
                                        <td class="td__body text-nowrap col limitaCarcteres" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$listas->ascpf}}">
                                                <a>{{$listas->ascpf}}</a>
                                        </td>
                                        
                                        <td class="td__body text-nowrap col">
                                            <?php
                                            $inicio = explode('-', $listas->asinicial);
                                            ?>
                                            {{$inicio[2]}}/{{$inicio[1]}}/{{$inicio[0]}}
                                        </td>
                                        
                                        <td class="td__body text-nowrap col">
                                            <?php
                                            $final = explode('-', $listas->asfinal);
                                            ?>
                                            {{$final[2]}}/{{$final[1]}}/{{$final[0]}}
                                        </td>
                                        
                                        <td class="td__body text-nowrap col" style="width:110px;">{{$listas->aicodigo}}</td>
                                        
                                        <td class="td__body text-nowrap col" style="width:60px;">
                                            <a href="{{route('recibo.avulso',[base64_encode($listas->id),base64_encode($listas->asinicial),base64_encode($listas->asfinal)])}}" class="btn btn__imprimir"><i class="icon__color fad fa-print"></i></a>
            
                                        </td>
                                        
                                        <td class="td__body text-nowrap col" style="width:60px;">
            
                                            <button type="submit" class="btn button__excluir modal-botao" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$listas->id}}">
                                                <i class="icon__color fad fa-trash"></i>
                                            </button>
                                            
                                            <section class="delete__tabela--tomador">
                                                <div class="modal fade" id="staticBackdrop{{$listas->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered col-8">
                                                        <div class="modal-content">
                                                            <form action="{{route('avuso.destroy',$listas->id)}}" id="formdelete" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <div class="modal-header header__modal">
                                                                    <h5 class="modal-title" id="rolDescontoTrabLabel"><i class="fad fa-trash"></i> Deletar</h5>
                                                                    <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
                                                                </div>
                                                                
                                                                <div class="modal-body body__modal ">
                                                                        <div class="d-flex align-items-center justify-content-center flex-column">
                                                                            <img class="gif__warning--delete" src="{{url('imagem/warning.gif')}}">
                                                                        
                                                                            <p class="content--deletar">Deseja realmente excluir?</p>

                                                                        </div>
                                                                </div>
                                                                
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn botao__fechar--modal" data-bs-dismiss="modal"><i class="fad fa-times-circle"></i> Não</button>
                                                                    <button type="submit" class="btn botao__deletar--modal"><i class="fad fa-trash"></i> Deletar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>

                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="tr__body">
                                        <td colspan="11" class="no__register--table">Não há nenhum registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></td>
                                    </tr>
                                    @endif
                                </tbody>
                                
                                <tfoot>
                                    <tr class="">
                                        <td colspan="11">
                                        </td>
                                    </tr>
                                </tfoot>
            
                            </table>
                        </div>
        
                    </section>
                </section>
    
            </div>
    
    
    
            <div class="tab-pane fade" id="rol-avulso" role="tabpanel" aria-labelledby="rol-avulso-tab">
                
                <h1 class="title__recibo-avulso">Rol dos Recibos Avulsos <i class="fad fa-industry"></i></h1>
                
                <section class="section__rol--avulso">
    
                    <form class="row g-3" action="{{route('recibo.avulso.trabalhador')}}" method="POST">
                        @csrf
                        
                        <section class="section__search">
                            <div class="col-md-5">
                               
                                    
                                    <div class="d-flex">
                                        
                                        <input placeholder="clique ou digite para pesquisar" class="form-control @error('search') is-invalid @enderror" list="listatrabalhador01" name="search" id="pesquisatrabalhador01">
                                        <datalist id="listatrabalhador01"></datalist>
        
                                        <input type="hidden" name="trabalhador01" class="@error('trabalhador01') is-invalid @enderror" id="trabalhador01">
                                      
                                        <button  class="btn botao__search">
                                            <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                        </button>
        
                                    </div>
                                    @error('search')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    
                                
                            </div>
                        </section>
                        
                        
        

                            <div class="col-12 col-sm-6">
                                <label for="ano" class="form-label">Data Inicial</label>
                                <input type="date" class="form-control @error('ano_inicial1') is-invalid @enderror" name="ano_inicial1" value="" id="tano1">
                                <div class="mt-1">
                                    @error('ano_inicial1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
        
                            <div class="col-12 col-sm-6">
                                <label for="ano" class="form-label">Data Final</label>
                                <input type="date" class="form-control @error('ano_final1') is-invalid @enderror" name="ano_final1" value="" id="tano1">
                                <div class="mt-1">
                                    @error('ano_final1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        <div class="d-flex justify-content-end align-items-end mt-3">
                            <button type="submit" class="btn botao__enviar" id="">Imprimir <i class="fad fa-print"></i></button>
                        </div>
        
                    </form>
                </section>
            </div>

    </div>



</main>




<script>

function remove(index) {
    console.log(index);
        $(`.campo${index}`).remove();
}

    let index = 0;

    function conteiner(index) {
        let conteiner = '';
        conteiner += `
            <section>
                <div class="row campo${index}">
        
                    <div class="col-12 col-md-5 mt-2">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control" value="" name="descricao${index}" maxlength="100" id="descricao${index}">
                    </div>

                    <div class="col-12 col-md-3 mt-2">
                        <label for="valor" class="form-label">Valor</label>
                        <input type="text" class="form-control numero " value="" name="valor${index}" maxlength="100" id="valor${index}">
                    </div>

                    <div class="col-12 col-md-3 mt-2">
                        <label for="cd${index}" class="form-label">Crédito/Desconto</label>
                        <select id="cd${index}" name="cd${index}" class="form-select" >
                        <option selected>Crédito</option>
                        <option>Desconto</option>
                        </select>
                    </div>
                    
                    
                    <div class="col-md-1 align-self-center" style="margin-top:32px;">
                        <a onclick="remove(${index})">  
                            <i class="fas fa-2x fa-times icon__exit--recibo--avulso"></i>
                        </a>
                    </div>
                    
                </div>
            </section>`
        return conteiner;

    }
    
    $('.numero').mask('000.000.000.000.000,00', {reverse: true});
    $('#adicinar').click(function() {
        if ($('#quantidade').val() <= 20) {
            // index += 1;
            let quantidade = parseInt($('#quantidade').val());
    
            $('#conteiner').append(conteiner(quantidade));
            quantidade += 1;
            $('#quantidade').val(quantidade)
            $('.numero').mask('000.000.000.000.000,00', {reverse: true});
        } else {
            alerta()
            $(this).addClass('disabled')
        }
    })
    $("#pesquisatrabalhador01,#pesquisatrabalhador").on('keyup focus', function() {
        let dados = '0'
        if ($(this).val()) {
            dados = $(this).val()
            if (dados.indexOf('  ') !== -1) {
                dados = monta_dados(dados);
            }
        }
        $('#icon').addClass('d-none').next().removeClass('d-none')
        $.ajax({
            url: "{{url('avuso')}}/pesquisa/" + dados,
            type: 'get',
            contentType: 'application/json',
            success: function(data) {
                $('#trabfoto').removeAttr('src')
                $('#refres').addClass('d-none').prev().removeClass('d-none')
                let nome = ''
                if (data.length >= 1) {
                    data.forEach(element => {
                        nome += `<option value="${element.ascpf}  ${element.asnome}">`
                        // nome += `<option value="${element.tsmatricula}">`
                        //   nome += `<option value="${element.ascpf}">`
                    });
                    $('#listatrabalhador01,#listatrabalhador').html(nome)
                }
                if (data.length > 0) {
                    $('#trabalhador01').val(data[0].id)
                }
            }
        });
    });
    // $("#pesquisatrabalhador").on('keyup focus', function() {
    //     let dados = '0'
    //     if ($(this).val()) {
    //         dados = $(this).val()
    //         if (dados.indexOf('  ') !== -1) {
    //             dados = monta_dados(dados);
    //         }
    //     }
    //     $('#icon').addClass('d-none').next().removeClass('d-none')
    //     $.ajax({
    //         url: "{{url('trabalhador')}}/pesquisa/" + dados,
    //         type: 'get',
    //         contentType: 'application/json',
    //         success: function(data) {
    //             $('#trabfoto').removeAttr('src')
    //             $('#refres').addClass('d-none').prev().removeClass('d-none')
    //             let nome = ''
    //             if (data.length >= 1) {
    //                 data.forEach(element => {
    //                     nome += `<option value="${element.tsnome}">`
    //                     // nome += `<option value="${element.tsmatricula}">`
    //                     nome += `<option value="${element.tscpf}">`
    //                 });
    //                 $('#listatrabalhador').html(nome)
    //             }
    //             if (data.length >= 1) {
    //                 $('#trabalhador').val(data[0].id)
    //             }
    //         }
    //     });
    // });
    function voltaPill(){
        var Back = document.getElementById('info-avulso-tab');
        Back.addEventListener("click", function() {
            localStorage.setItem('Backrb', 'backpill1');
    
        })
    
        var Back1 = document.getElementById('rol-avulso-tab');
        Back1.addEventListener("click", function() {
            localStorage.setItem('Backrb', 'backpill3');
    
        })
    
        var Back2 = document.getElementById('lista-avulso-tab');
        Back2.addEventListener("click", function() {
            localStorage.setItem('Backrb', 'backpill2');
    
        })
    
        backActive = document.getElementById("lista-avulso");
        backActive1 = document.getElementById("info-avulso");
        backActive2 = document.getElementById("rol-avulso");
    
        voltar = localStorage.getItem("Backrb");
    
    
        if (voltar === null) {
            localStorage.setItem('Backrb', 'backpill1');
            Back.classList.add("active");
            backActive1.classList.add("show", "active");
            backActive.classList.remove("show", "active");
            backActive2.classList.remove("show", "active");
            document.getElementById("info-avulso-tab").click();
        }
    
        if (voltar === "backpill1") {
            Back.classList.add("active");
            backActive1.classList.add("show", "active");
            backActive.classList.remove("show", "active");
            backActive2.classList.remove("show", "active");
            document.getElementById("info-avulso-tab").click();
    
    
        } else if (voltar === "backpill2") {
            Back2.classList.add("active");
            backActive.classList.add("show", "active");
            backActive1.classList.remove("show", "active");
            backActive2.classList.remove("show", "active");
            document.getElementById("lista-avulso-tab").click();
    
        } else if (voltar === "backpill3") {
            Back1.classList.add("active");
            backActive2.classList.add("show", "active");
            backActive.classList.remove("show", "active");
            backActive1.classList.remove("show", "active");
            document.getElementById("rol-avulso-tab").click();
    
        }
    
    
        var botao = document.getElementById("backTop");
        var botaoAdicionar = document.getElementById("adicinar");
        var quantidade = document.getElementById("quantidade");
        var acaoTopo = document.getElementById("acaoTopo");
        var backTopTitle = document.getElementById("backTopTitle");
    }

    voltaPill();

    function validaInputQuantidade(idCampo, QuantidadeCarcteres) {
        var telefone = document.querySelector(idCampo);

        telefone.addEventListener('input', function() {
            var telefone = document.querySelector(idCampo);
            var result = telefone.value;
            if (result > " " && result.length >= QuantidadeCarcteres) {
                telefone.classList.add('is-valid');
            } else {
                telefone.classList.remove('is-valid');
            }

        });
    }

    var nome = validaInputQuantidade("#nome", 1);
    var cpf = validaInputQuantidade("#cpf", 14);
    var tano = validaInputQuantidade("#tano", 8);
    var tanoFinal = validaInputQuantidade("#tanoFinal", 8);



    $('#pesquisatomador').on('keyup focus', function() {
        var dados = '0';
        if ($(this).val()) {
            dados = $(this).val();
            if (dados.indexOf('  ') !== -1) {
                dados = monta_dados(dados);
            }
        }
        $('#icon').addClass('d-none').next().removeClass('d-none')
        $.ajax({
            url: "{{url('tomador')}}/pesquisa/" + dados,
            type: 'get',
            contentType: 'application/json',
            success: function(data) {
                let nome = ''
                $('#refres').addClass('d-none').prev().removeClass('d-none')
                if (data.length >= 1) {
                    data.forEach(element => {
                        nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
                        // nome += `<option value="${element.tsmatricula}">`
                        // nome += `<option value="${element.tscnpj}">`
                    });
                    $('#listatomador').html(nome)
                }
                if (data.length === 1 && dados.length >= 2) {
                    $('#tomador').val(data[0].tomador)
                }
            }
        });
    })
    
    

    function alerta() {
        const Toast = Swal.mixin({
            toast: true,
            width: 500,
            color: '#ffffff',
            background: '#C53230',
            position: 'top-end',
            showCloseButton: true,
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: 'Não pode ser cadastrado mais de 20!'
        })
    }

    function monta_dados(dados) {
        let novodados = dados.split('  ')
        return novodados[1];
    }
    

    botaoAdicionar.addEventListener('click', function() {
        var contador = quantidade.value + 1;
        if (contador >= 71) {
            acaoTopo.classList.remove("d-none");
        }

    })

    botao.addEventListener('click', function() {
        var contador = quantidade.value + 1;
        if (contador >= 71) {
            window.scrollTo(0, 1);

        }
    })

    backTopTitle.addEventListener('click', function() {
        var contador = quantidade.value + 1;
        if (contador >= 71) {
            window.scrollTo(0, 1);

        }
    })
</script>
@stop