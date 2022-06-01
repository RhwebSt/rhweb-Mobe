@extends('administrador.layouts.index')
@section('titulo','Rhweb - Lista Usuario')
@section('conteine')
<div class="container">

    <example-component></example-component>
    {{-- inicio do botão novo --}}
    <section class="section__btn--new">
        <div class="d-flex justify-content-start align-items-start div__voltar">
                <a class="btn botao__voltar" href="{{route('home.index')}}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
        </div>
        
        <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap">
            <a href="{{route('administrador.usuarios.create')}}" class="button__new btn">Novo <i class="fad fa-user-plus"></i></a>
        </div>
    </section>
    {{-- final do botao novo --}}

    {{-- incio da pesquisa --}}
    <section class="search">
        <form action="{{route('administrador.usuarios.index')}}"  method="GET">
            <div class="d-flex">
                <div class="col-10 col-md-3 me-1">
                    <input class="form-control" id="pesquisa" list="listapesquisa" name="search" type="search" placeholder="Pesquisar...">
                    <datalist id="listapesquisa">
                    </datalist>
                </div>
                <div>
                    <button type="submit"  class="button__search btn"><i class="fad fa-search"></i></button>
                </div>
            </div>
        </form>
    </section>
    {{-- fim da pesquisa --}}

    {{-- inicio do filtro --}}
    <section>
        <div class="d-flex justify-content-end align-content-end">
            <div>
                <div class="dropdown">
                    <button class="btn button__filter dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fad fa-sort"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu--filter" aria-labelledby="dropdownMenuButton2">
                        <li><a class="dropdown-item dropdown-item--filter" href="{{route('usuario.ordem','asc')}}"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                        <li><a class="dropdown-item dropdown-item--filter" href="{{route('usuario.ordem','desc')}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
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
                        <th class="th__header text-nowrap">Empresa</th>
                        <th class="th__header text-nowrap">CNPJ</th>
                        <th class="th__header text-nowrap">Usuario</th>
                        <th class="th__header text-nowrap">Email</th>
                        <th class="th__header text-nowrap">Telefone</th>
                        <th class="th__header text-nowrap" style="width:80px">Permissão</th>
                        <th class="th__header text-nowrap" style="width:80px">Backup</th>
                        <th class="th__header text-nowrap" style="width:80px">Editar</th>
                        <!-- <th class="th__header text-nowrap" style="width:80px">Excluir</th> -->
                    </tr>

                </thead>
                {{-- final da heaader da tabela --}}

                {{-- começo do body da tabela --}}
                <tbody class="table__body">
                    @if(count($lista) > 0)
                    @foreach($lista as $key=>$listas)
                    <tr class="tr__body">
                        <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$listas->esnome}}" style="max-width: 40ch; overflow: hidden; text-overflow: ellipsis;">{{$listas->empresa->esnome}}</td>
                        <td class="td__body text-nowrap col" style="width:300px">{{$listas->empresa->escnpj}}</td>
                        <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$listas->name}}" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis;">{{$listas->name}}</td>
                        <td class="td__body text-nowrap col"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{$listas->email}}" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis;">{{$listas->email}}</td>
                        <td class="td__body text-nowrap col"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{$listas->empresa->estelefone}}" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis;">{{$listas->empresa->estelefone}}</td>
                        
                        {{-- inicio do botao de permissao --}}
                        <td class="td__body text-nowrap col" style="width:80px">

                            <div class="dropdown">
                                <button class="btn button__permission dropdown-toggle" type="button" id="dropdownMenuButton{{$key}}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fad fa-user-lock"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu--filter" aria-labelledby="dropdownMenuButton{{$key}}">
                                    <?php
                                        $perm = [];
                                        foreach ($listas->permissions as $permissao) {
                                            array_push($perm,$permissao->pivot->permission_id);
                                        }
                                    ?>
                                    @foreach($listas->permissions as $permissao)
                                        @if($permissao->pivot->model_type)
                                            <li><a class="dropdown-item dropdown-item--filter botao-modal" href="{{route('permissao',[base64_encode($permissao->id),base64_encode($permissao->pivot->permission_id),'R'])}}">{{$permissao->name}}<i class="fas fa-check text-success"></i></a></li>
                                        @endif
                                    @endforeach
                                    @foreach($permissions as $p)
                                        @if(!in_array($p->id,$perm) && $p->id != 1)
                                            <li><a class="dropdown-item dropdown-item--filter botao-modal" href="{{route('permissao',[base64_encode($listas->id),base64_encode($p->id),'D'])}}">{{$p->name}}<i class="fad fa-ban text-danger"></i></a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>

                        </td>
                        {{-- fim do botao de permissao --}}
                        
                        <td class="td__body text-nowrap col" style="width:80px">
                            <input type="hidden" name="empresa" value="{{$listas->empresa_id}}" id="empresa{{$key}}">
                            <div class="dropdown">
                                <button class="btn button__upload dropdown-toggle" type="button" id="dropdownMenuButton{{$key}}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fad fa-upload"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu--filter" aria-labelledby="dropdownMenuButton{{$key}}">
                                    <li><a class="dropdown-item dropdown-item--filter botao-modal txtTrabalhador" id="" onclick="trabalhador('{{$listas->empresa_id}}')"><i class="fad fa-file-alt"></i> Backup Dados Trabalhador</a></li>
                                    <li><a class="dropdown-item dropdown-item--filter botao-modal txtTomador" id="" onclick="tomador('{{$listas->empresa_id}}')"><i class="fad fa-file-alt"></i> Backup Dados Tomador</a></li>
                                </ul>
                            </div>

                        </td>

                        {{-- inicio do botao de editar --}}
                        <td class="td__body text-nowrap" style="width:80px">

                            <a class="btn button__editar" href="{{route('administrador.usuarios.edit',$listas->id)}}"><i class="fad fa-pen"></i></a>

                        </td>
                        {{-- fim do botao de editar --}}

                        {{-- inicio do botao deletar --}}
                        <!-- <td class="td__body text-nowrap" style="width:80px">
                            <form action="">
                                <button id="button__delete" class="btn button__excluir"><i class="fad fa-trash"></i></button>
                            </form>
                        </td> -->
                        {{-- fim do botao deletar --}}
                    </tr>
                    @endforeach
                    @endif

                </tbody>
                {{-- final do body da tabela --}}

                {{-- inicio do footer da tabela --}}
                <tfoot>
                    <tr class="">
                        <td colspan="6" class="teste" style="border: none !important">
                            <nav aria-label="Page navigation example">
                               
                                @if ($lista->lastPage() > 1)
                                <ul class="pagination pagination__table pagination-sm">

                                    @for ($i = 1; $i <= $lista->lastPage(); $i++)
                                        <li class="page-item {{ ($lista->currentPage() == $i) ? ' active' : ''     }}">
                                            <a class="page-link modal-botao" href="{{ $lista->url($i) }}">{{ $i }}</a>
                                        </li>
                                        @endfor


                                </ul>
                                @endif
                            </nav>
                        </td>
                    </tr>
                </tfoot>
                {{-- fim do footer da tabela --}}
            </table>
        </div>
    </section>
    {{-- fim da tabela --}}


    
</div>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{url('pesquisa/usuario')}}",
            type: 'get',
            contentType: 'application/json',
            success: function(data) {
                let nome = ''
                if (data.length >= 1) {
                    data.forEach(element => {
                        nome += `<option value="${element.esnome}">`
                        // nome += `<option value="${element.rsrublica}">`
                    });
                    $('#listapesquisa').html(nome)
                }
               
            }
        })
    })
</script>
@stop