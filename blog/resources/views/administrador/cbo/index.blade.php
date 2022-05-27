@extends('administrador.layouts.index')
@section('titulo','Rhweb - CBO')
@section('conteine')
<main role="main">
    <div class="container"> 
    

        {{-- Inicio botoes principais --}}
        <section class="section__botao--voltar--cbo">
            
            <div class="d-flex justify-content-start align-items-start div__voltar">
                <a class="btn botao__voltar" href="{{route('home.index')}}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
            </div>
            
            <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                <a href="{{route('administrador.cbo.create')}}" class="button__new--cbo btn">Novo <i class="fad fa-user-plus"></i></a>
            </div>
        </section>
        {{-- fim dos botoes principais --}}


        <section class="section__title--cbo">
            <div>
                <h1 class="title__cbo">CBO Automático <i class="fad fa-magic"></i></h1>
            </div>
        </section>

        

        {{-- incio da pesquisa --}}
            <section class="search">
                <form action="{{route('administrador.cbo.index')}}" method="GET">
                    <div class="d-flex">
                        <div class="col-10 col-md-3 me-1">
                            <input class="form-control" id="inputPesquisar" list="listapesquisa" name="search" type="search" placeholder="Pesquisar...">
                            <datalist id="listapesquisa">
                            </datalist>
                        </div>
                        <div>
                            <button type="submit" id="pesquisar" class="button__search btn"><i class="fad fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </section>
        {{-- fim da pesquisa --}}

        {{-- inicio do filtro --}}
            <section>
                <div class="d-flex justify-content-end">
                    <div>
                        <div class="dropdown">
                            <button class="btn button__filter dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fad fa-sort"></i>
                            </button>
                            <ul class="dropdown-menu dropdown__filtro" aria-labelledby="dropdownMenuButton2">
                              <li><a class="dropdown-item dropdown__links--filter" href="{{route('administrador.cbo.ordem','asc')}}"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                              <li><a class="dropdown-item dropdown__links--filter" href="{{route('administrador.cbo.ordem','desc')}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                            </ul>
                          </div>
                    </div>

                </div>
            </section>
        {{-- fim do filtro --}}

        
        {{-- incicio da tabela --}}
        <section class="table">
            <div class="table-responsive-xxl">
                <table class="table">
                    {{-- inicio da header da tabela --}}
                    <thead class="table__header">

                        <tr class="tr__header">
                            <th class="th__header text-nowrap" style="width:100px">Código</th>
                            <th class="th__header text-nowrap" style="max-width: 20ch">Descrição</th>
                            <th class="th__header text-nowrap" style="width:80px">Editar</th>
                            <th class="th__header text-nowrap" style="width:80px">Excluir</th>
                        </tr>

                    </thead>
                    {{-- final da heaader da tabela --}}

                    {{-- começo do body da tabela --}}
                    <tbody class="table__body">
                        @if(count($lista) > 0)
                        @foreach($lista as $listas)
                            <tr class="tr__body">
                                
                                <td class="td__body text-nowrap col"  style="width:100px">{{$listas->cscodigo}}</td>

                                <td class="td__body text-nowrap col limitaCarcteres" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$listas->csdescricao}}" >{{$listas->csdescricao}}</td>
                                
                                {{-- inicio do botao de editar --}}
                                <td class="td__body text-nowrap"  style="width:80px">
                                    <a href="{{route('administrador.cbo.edit',$listas->id)}}" class="btn button__editar"><i class="fad fa-pen"></i></a>
                                </td>
                                {{-- fim do botao de editar --}}
                                
                                <td class="td__body text-nowrap"  style="width:80px">
                                    <a href="" class="btn button__excluir"><i class="fad fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        {{--Inicio quando tiver nenhum cadastro --}}
                            <tr class="tr__body">
                                <td colspan="7" class="no__register--table">Não há nenhum registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></td>
                            </tr>
                        {{--fim quando tiver nenhum cadastro --}}
                    @endif
                    </tbody>
                    {{-- final do body da tabela --}}



                    {{-- inicio do footer da tabela --}}
                    <tfoot>
                        <tr class="">
                            <td colspan="6" class="teste" style="border: none !important">
                                {{$lista->links()}}
                                
                            </td>
                        </tr>
                    </tfoot>
                    {{-- fim do footer da tabela --}}
                </table>
            </div>
        </section>
        {{-- fim da tabela --}}

    </div>
</main>
<script>
    $.ajax({
        url: "{{route('administrador.cbo.pesquisa')}}",
        type: 'get',
        contentType: 'application/json',
        success: function(data) {
            let nome = ''
            data.forEach(element => {
                nome += `<option value="${element.cscodigo}">`
                nome += `<option value="${element.csdescricao}">`
            });
            $('#listapesquisa').html(nome)
        }
    })
</script>
@stop