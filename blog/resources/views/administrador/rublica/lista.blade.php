@extends('administrador.layouts.index')
@section('titulo','Rhweb - Rublica')
@section('conteine')
<div class="container">

    <section class="section__btn--new--rubrica">
        <div class="">
            <a href="{{route('rublica.create')}}" class="button__new--rubrica btn">Novo <i class="fad fa-user-plus"></i></a>
        </div>
    </section>

    <section class="search">
        <form action="{{route('rublica.index')}}"  method="GET">
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


    <section>
        <div class="d-flex justify-content-end">
            <div>
                <div class="dropdown">
                    <button class="btn button__filter dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fad fa-sort"></i>
                    </button>
                    <ul class="dropdown-menu dropdown__filtro" aria-labelledby="dropdownMenuButton2">
                        <li><a class="dropdown-item dropdown__links--filter" href="{{route('ordem.rublica',['asc',isset($dados->id)?$dados->id:null])}}"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                        <li><a class="dropdown-item dropdown__links--filter" href="{{route('ordem.rublica',['desc',isset($dados->id)?$dados->id:null])}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <section class="table">

        <div class="table-responsive-xxl">

            <table class="table">

                <thead class="table__header">
                    <tr class="tr__header">
                        <th class="th__header text-nowrap" style="width:120px;">Rúbricas</th>
                        <th class="th__header text-nowrap" style="width:500px;">Descrição</th>
                        <th class="th__header text-nowrap" style="width:100px;">Incidência</th>
                        <th class="th__header text-nowrap" style="width:250px">D/C</th>
                        <th class="th__header text-nowrap" style="width:60px;">Relatório</th>
                        <th class="th__header text-nowrap" style="width:60px;">Editar</th>
                    </tr>
                </thead>

                <tbody class="table__body">
                    @if(count($lista) > 0)
                    @foreach($lista as $rublica)
                    <tr class="tr__body">
                        <td class="td__body text-nowrap col" style="width: 120px;">
                            {{$rublica->rsrublica}}
                        </td>

                        <td class="td__body text-nowrap col" style="width:500px;" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$rublica->rsdescricao}}" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis;">
                            {{$rublica->rsdescricao}}
                        </td>

                        <td class="td__body text-nowrap col" style="width:100px;">
                            {{$rublica->rsincidencia}}
                        </td>

                        <td class="td__body text-nowrap col" style="width:250px">
                            {{$rublica->rsdc}}
                        </td>

                        <td class="td__body text-nowrap col" style="width:60px;">
                            <button class="btn">
                                <a href="" class="btn__padrao--relatorio"><i style="color:white" class="fa-solid fa-file-lines"></i></a>
                            </button>
                        </td>

                        <td class="td__body text-nowrap col" style="width:60px;">
                            <button class="btn">
                                <a href="{{route('rublica.edit',$rublica->id)}}" class="btn__padrao--editar"><i style="color:white" class="fa-solid fa-pen"></i></a>
                            </button>
                        </td>

                    </tr>
                    @endforeach
                    @else
                    <tr class="tr__body text-nowrap col">
                        <td colspan="7" class="no__register--table">Não há nenhum registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></td>
                    </tr>
                    @endif
                </tbody>

                <tfoot>

                    <tr>
                        <td colspan="8" class="text-end">
                            @if ($lista->lastPage() > 1)
                            <ul class="pagination  pagination__table pagination-sm">
                                @for ($i = 1; $i <= $lista->lastPage(); $i++)
                                    <li class="page-item {{ ($lista->currentPage() == $i) ? ' active' : ''     }}">
                                        <a class="page-link modal-botao" href="{{ $lista->url($i) }}">{{ $i }}</a>
                                    </li>
                                    @endfor
                            </ul>
                            @endif
                        </td>
                    </tr>

                </tfoot>

            </table>

        </div>

    </section>

</div>
<script>
    $(document).ready(function() {
        $('#pesquisa').on('focus keyup', function() {
            let dados = 0;
            if ($(this).val()) {
                dados = $(this).val()
            }
            $.ajax({
                url: "{{url('rublica/pesquisa')}}/" + dados,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                    let nome = ''
                    if (data.length >= 1) {
                        data.forEach(element => {
                            nome += `<option value="${element.rsdescricao}">`
                            // nome += `<option value="${element.rsrublica}">`
                        });
                        $('#listapesquisa').html(nome)
                    }
                    // if(data.length === 1 && dados.length >= 4){
                    //     buscaItem(dados)
                    // }
                }
            })
        })
    })
</script>
@stop