<div class="modal fade" id="modalTomador" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header header__modal">
                <h5 class="modal-title" id="staticBackdropLabel1"><i class="fad fa-lg fa-industry"></i> Tomadores cadastrados</h5>
                <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            
            <div class="modal-body body__modal">
                
                <section class="section__search">
                    <div class="col-md-5">
                        <form action="{{route('tomador.novo')}}" method="GET">
                            
                            <div class="d-flex">
                                
                                <input placeholder="duplo clique para pesquisar" class="form-control" list="listapesquisa" name="search" id="pesquisa">
                                <datalist id="listapesquisa"></datalist>

                                <input type="hidden" name="codicao" value="{{isset($tomador->id)?$tomador->id:''}}">
                                
                                <button type="submit" class="btn botao__search modal-botao">
                                    <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                    <i class="icon__search fad fa-spinner-third fa-spin fa-lg d-none" id="refres"></i>
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
                                  <li><a class="dropdown-item dropdown__links--filter modal-botao" href="{{route('ordem.tomador',['asc',isset($tomador->id)?$tomador->id:''])}}"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                                  <li><a class="dropdown-item dropdown__links--filter modal-botao" href="{{route('ordem.tomador',['desc',isset($tomador->id)?$tomador->id:''])}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                </ul>
                              </div>
                        </div>

                    </div>
                </section>

                
                
            
                <section class="table">
                    <div class="table-responsive-xxl">
                        <table class="table">
                            <thead class="tr__header">
                                <th class="th__header text-nowrap" style="width:80px;">Matrícula</th>
                                <th class="th__header text-nowrap">Tomador</th>
                                <th class="th__header text-nowrap" style="width:120px">CNPJ</th>
                                <th class="th__header text-nowrap" style="width:80px">Tab Preço</th>
                                <th class="th__header text-nowrap" style="width:60px">Relatórios</th>
                                <th class="th__header text-nowrap" style="width:60px">S-1020</th>
                                <th class="th__header text-nowrap" style="width:60px;">Editar</th>
                                <th class="th__header text-nowrap" style="width:60px;">Excluir</th>
                            </thead>
                            
                            <tbody class="table__body">
                                @if(count($tomadors) > 0)
                                @foreach($tomadors as $key => $tomador)
                                <tr class="tr__body">
                                    <td class="td__body text-nowrap col" style="width:80px;">{{$tomador->tsmatricula}}</td>
                                    <td class="td__body text-nowrap col limitaCarcteres" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$tomador->tsnome}}">
                                        {{$tomador->tsnome}}
                                    </td>
                                    <td class="td__body text-nowrap col" style="width:120px">
                                        {{$tomador->tscnpj}}
                                    </td>
        
                                    <td class="td__body text-nowrap col" style="width:80px">
                                        <a class="btn btn__tabela--preco" href="{{route('tabelapreco.index',[' ',base64_encode($tomador->id)])}}" class=""><i class="icon__color fas fa-dollar-sign"></i></a>
                                    </td>
        
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        <div class="dropdown">
                                            <button class="btn btn__relatorio dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="icon__color fas fa-file-alt"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="#" onclick="botaoModal ('{{$tomador->id}}')"><i class="fas fa-file"></i> Rol dos Boletins</a></li>
                                                <li><a class="dropdown-item" href="{{route('tabela.preco.relatorio',base64_encode($tomador->id))}}"><i class="fas fa-dollar-sign"></i> Rol da Tabela de preço</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        <a class="btn__evento btn modal-botao" href="{{route('esocial.tomador',base64_encode($tomador->id))}}" class=""><i class="icon__color fas fa-file-invoice"></i></a>
                                    </td>
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        
                                        <a class="button__editar btn" href="{{route('tomador.editar',base64_encode($tomador->id))}}"><i class="icon__color fas fa-pen"></i></a>
                                        
                                    </td>
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                       
                                            <button class="btn button__excluir" data-bs-toggle="modal" data-bs-target="#deleteTomador{{$key}}"><i class="icon__color fad fa-trash"></i></button>
                                        <section class="delete__tabela--tomador">
                                            <div class="modal fade" id="deleteTomador{{$key}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered col-8">
                                                    <div class="modal-content">
                                                        <form action="{{route('tomador.deletar',$tomador->id)}}" id="formdelete" method="post">
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
                                                                        
                                                                        <p class="content--deletar2">Obs: Será excluído tudo o que está vinculado á este tomador.</p>
                                                                        
                                                                    </div>
                                                            </div>
                                                            
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn botao__fechar--modal" data-bs-dismiss="modal"><i class="fad fa-times-circle"></i> Não</button>
                                                                <button type="submit" class="btn botao__deletar--modal  modal-botao"><i class="fad fa-trash"></i> Deletar</button>
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
                                        {{$tomadors->links()}}
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

