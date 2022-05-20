<div class="modal fade" id="teste" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            
            <div class="modal-header header__modal">
                <h5 class="modal-title text-black" id="staticBackdropLabel1"><i class="fad fa-lg fa-sack-dollar"></i> Lançamentos cadastrados</h5>
                <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            
            <div class="modal-body">
                
                <section class="section__search">
                    <div class="col-md-5">
                        <form action="{{  route('boletim.tabela.create',[$quantidade,$boletim,$tomador,base64_encode($id),$data])}}" method="GET">
                            
                            <div class="d-flex">
                                
                                <input placeholder="clique ou digite para pesquisar" class="form-control" list="listapesquisa" name="search" id="search">
                                <datalist id="listapesquisa"></datalist>

                                <input type="hidden" name="codicao" value="{{isset($trabalhador)?$trabalhador:null}}">
                                
                                <button type="submit" class="btn botao__search">
                                    <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                </button>

                            </div>
                            
                        </form>
                    </div>
                </section>
                            
                <section>
                    <div class="d-flex justify-content-end">
                        <div>
                            <div class="dropdown">
                                <button class="btn button__filter dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fad fa-sort"></i>
                                </button>
                                <ul class="dropdown-menu dropdown__filtro" aria-labelledby="dropdownMenuButton2">
                                    <li><a class="dropdown-item dropdown__links--filter" id="ordemCres" href="{{route('boletim.tabela.ordem',[$quantidade,$boletim,$tomador,base64_encode($id),isset($trabalhador)?base64_encode($trabalhador):' ',$data,'asc'])}}"><i class="fad fa-sort-amount-up-alt"></i> Ordem Crescente</a></li>
                                    <li><a class="dropdown-item dropdown__links--filter" href="{{route('boletim.tabela.ordem',[$quantidade,$boletim,$tomador,base64_encode($id),isset($trabalhador)?base64_encode($trabalhador):' ',$data,'desc'])}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                </ul>
                              </div>
                        </div>

                    </div>
                </section>
                            
                <section class="table">
                    <div class="table-responsive-xxl">
                        <table class="table">
                            <thead class="tr__header">
                                <th class="th__header text-nowrap">Trabalhador</th>
                                <th class="th__header text-nowrap" style="width:70px">Cod</th>
                                <th class="th__header text-nowrap">Descrição</th>
                                <th class="th__header text-nowrap" style="width:100px">Quantidade</th>
                                <th class="th__header text-nowrap" style="width:170px">Valor Unitário</th>
                                <th class="th__header text-nowrap" style="width:170px">Total R$</th>
                                <th class="th__header text-nowrap" style="width:70px">Editar</th>
                                <th class="th__header text-nowrap" style="width:70px">Excluir</th>
                            </thead>
                            <tbody class="table__body">
                                @if(count($lista) > 0)
                                @foreach($lista as $listas)
                                    <tr class="tr__body">
                                        <td class="td__body text-nowrap col limitaCarcteres" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$listas->trabalhador->tsnome}}">{{$listas->trabalhador->tsnome}}</td>
                                        <td class="td__body text-nowrap col" style="width:70px">{{$listas->licodigo}}</td>
                                        <td class="td__body text-nowrap col  limitaCarcteres" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$listas->lshistorico}}">{{$listas->lshistorico}}</td>
                                        <td class="td__body text-nowrap col" style="width:100px">
                                            
                                            @if(str_contains($listas->lsquantidade,':'))
                                                    {{$listas->lsquantidade}}
                                            @else
                                                    {{number_format((float)$listas->lsquantidade, 2, ',', '.')}}
                                            @endif
                                        </td>
                                        <td class="td__body text-nowrap col" style="width:170px">R$ {{number_format((float)$listas->lfvalor, 2, ',', '')}}</td>
                                        <td class="td__body text-nowrap col" style="width:170px">R$ {{number_format((float)calculovalores($listas->lsquantidade , $listas->lfvalor), 2, ',', '')}}</td>
                                        <td class="td__body text-nowrap col" style="width:70px">
                                            <a href="{{route('boletim.tabela.edit',[base64_encode($quantidade),base64_encode($boletim),base64_encode($tomador),base64_encode($listas->lancamentotabela_id),base64_encode($listas->id),base64_encode($data)])}}" class="button__editar btn" ><i class="icon__color fas fa-pen"></i></a>
                                        </td>
                                        <td class="td__body text-nowrap col" style="width:70px">
                                            
                                            <!--<form action="{{route('boletim.tabela.destroy',$listas->id)}}"  method="post">-->
                                            <!--    @csrf-->
                                            <!--    @method('delete')-->
                                                <button type="submit" class="btn button__excluir modal-botao" data-bs-toggle="modal" data-bs-target="#deleteBoletimTabPrecoInside"><i class="icon__color fad fa-trash"></i></button>
                                            <!--</form> -->
                                            
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
                                <tr>
                                    <td colspan="11" class="text-end">
                                        @if ($lista->lastPage() > 1)
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination pagination__table pagination-sm">
                                               
                                                @for ($i = 1; $i <= $lista->lastPage(); $i++)
                                                    <li class="page-item {{ ($lista->currentPage() == $i) ? ' active' : ''     }}">
                                                        <a class="page-link modal-botao" href="{{ $lista->url($i) }}">{{ $i }}</a>
                                                    </li>
                                                @endfor
                                                
                                                </ul>
                                            </nav>
                                                @endif
                                                
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </section>
                            
            </div>
        </div>
    </div>
</div>
              
<section class="delete__tabela--boletim">
    <div class="modal fade" id="deleteBoletimTabPrecoInside" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered col-8">
            <div class="modal-content">
                <form action="" id="formdelete" method="post">
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
                                
                                <p class="content--deletar2">Obs: Este trabalhador não irá fazer mais parte dos cálculos</p>
                                
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