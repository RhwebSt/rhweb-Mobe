<div class="modal fade" id="listaNoturno" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header header__modal">
                <h5 class="modal-title" id="staticBackdropLabel1"><i class="fad fa-lg fa-moon"></i> Lista Noturno</h5>
                <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            
            <div class="modal-body">
                
                <section class="section__search">

                    <div class="col-md-5">
                        <form action="" method="GET">
                            <div class="d-flex">
                                <input placeholder="clique ou digite para pesquisar" class="form-control" list="listapesquisa" name="search" id="pesquisa">
                                <datalist id="listapesquisa"></datalist>
                                
                                <input type="hidden" name="codicao" value="">
                                
                                <button type="submit" class="btn botao__search modal-botao">
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
                                  <li><a class="dropdown-item dropdown__links--filter modal-botao" href=""><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                                  <li><a class="dropdown-item dropdown__links--filter modal-botao" href=""><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                </ul>
                              </div>
                        </div>
        
                    </div>
                </section>
                
                <section class="table">
                    <div class="table-responsive-xxl">
                        <table class="table">
                            <thead class="tr__header">
                                <th class="th__header text-nowrap" style="width:60px;">Mat</th>
                                <th class="th__header text-nowrap">Nome</th>
                                <th class="th__header text-nowrap" style="width:60px;">Entr</th>
                                <th class="th__header text-nowrap" style="width:60px;">Saída</th>
                                <th class="th__header text-nowrap" style="width:60px;">Entr</th>
                                <th class="th__header text-nowrap" style="width:60px;">Saída</th>
                                <th class="th__header text-nowrap" style="width:60px;">Hrs 50%</th>
                                <th class="th__header text-nowrap" style="width:60px;">Hrc 100%</th>
                                <th class="th__header text-nowrap" style="width:60px;">Adc.Not</th>
                                <th class="th__header text-nowrap" style="width:90px;">Total</th>
                                <th class="th__header text-nowrap" style="width:60px;">Editar</th>
                                <th class="th__header text-nowrap" style="width:60px;">Excluir</th>
                            </thead>
                            
                            <tbody class="table__body">
                            @if(count($lista) > 0)
                                @foreach($lista as $key => $listas)
                                @if($listas->bsentradanoite && $listas->bsentradanoite ||
                                $listas->bsentradamadrugada && $listas->bssaidamadrugada)
                                
                                <tr class="tr__body">
                                    <td class="td__body text-nowrap col" style="width:60px;">{{$listas->trabalhador->tsmatricula}}</td>
                                    <td class="td__body text-nowrap col limitaCarcteres" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$listas->trabalhador->tsnome}}">{{$listas->trabalhador->tsnome}}</td>
                                    <td class="td__body text-nowrap col" style="width:60px;">{{$listas->bsentradanoite}}</td>
                                    <td class="td__body text-nowrap col" style="width:60px;">{{$listas->bssaidanoite}}</td>
                                    <td class="td__body text-nowrap col" style="width:60px;">{{$listas->bsentradamadrugada}}</td>
                                    <td class="td__body text-nowrap col" style="width:60px;">{{$listas->bssaidamadrugada}}</td>
                                    <td class="td__body text-nowrap col" style="width:60px;">{{$listas->bshoraex}}</td>
                                    <td class="td__body text-nowrap col" style="width:60px;">{{$listas->bshoraexcem}}</td>
                                    <td class="td__body text-nowrap col" style="width:60px;">{{$listas->bsadinortuno}}</td>
                                    <td class="td__body text-nowrap col" style="width:90px;">{{$listas->bstotal}}</td>
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        <a class="button__editar btn" href="{{route('boletim.cartaoponto.edit',[base64_encode($listas->id),base64_encode($id),base64_encode($domingo)?$domingo:' ',$sabado?base64_encode($sabado):' ',$diasuteis?base64_encode($diasuteis):' ',base64_encode($data),base64_encode($boletim),base64_encode($tomador),base64_encode($feriado)])}}"><i class="icon__color fas fa-pen"></i></a>
                                    </td>
                                    
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                            <button class="btn button__excluir" data-bs-toggle="modal" data-bs-target="#deleteListaNoturno{{$key}}"><i class="icon__color fad fa-trash"></i></button>
                                            <section class="delete__tabela--cartaoPonto">
                                                <div class="modal fade" id="deleteListaNoturno{{$key}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered col-8">
                                                        <div class="modal-content">
                                                            <form action="{{route('boletimcartaoponto.destroy',$listas->id)}}" id="" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <div class="modal-header header__modal">
                                                                    <h5 class="modal-title" id="rolDescontoTrabLabel"><i class="fad fa-trash"></i> Deletar</h5>
                                                                    <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
                                                                </div>
                                                                
                                                                <div class="modal-body body__modal ">
                                                                        <div class="d-flex align-items-center justify-content-center flex-column">
                                                                            <img class="gif__warning--delete" src="{{url('imagem/complain.png')}}">
                                                                        
                                                                            <p class="content--deletar">Deseja realmente excluir?</p>
                                                                            
                                                                            <p class="content--deletar2">Obs: Este trabalhador não irá fazer mais parte dos cálculos.</p>
                                                                            
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
                               @endif
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
                                    {{ $lista->links() }}
                                    </td>
                                </tr>
                            </tfoot>
                            
                        </table>
                    </div>
                </section>
                
                
            </div>

            <div class="modal-footer">
            </div>

        </div>
    </div>
</div>

<script type="text/javascript" src="{{url('/js/user/boletimCartaoPonto/cartaoPonto/lista.js')}}"></script>    

