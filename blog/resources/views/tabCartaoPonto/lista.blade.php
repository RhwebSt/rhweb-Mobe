<div class="modal fade" id="modalLancamentoPreco" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header header__modal">
                <h5 class="modal-title fw-bold" id="staticBackdropLabel1"><i class="fad fa-lg fa-pencil-alt"></i> Boletins cadastrados</h5>
                <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            
            <div class="modal-body">
                
                <section class="section__search">

                    <div class="col-md-5">
                        <form action="{{route('tabcartaoponto.index')}}" method="GET">
                            <div class="d-flex">
                                <input placeholder="clique ou digite para pesquisar" class="form-control" list="listapesquisa"  id="pesquisa">
                                <datalist id="listapesquisa"></datalist>
                                <input type="hidden" name="search" id="search">
                                <input type="hidden" name="codicao" value="{{isset($dados->id)?$dados->id:null}}">
                                
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
                                  <li><a class="dropdown-item dropdown__links--filter modal-botao" href="{{route('edit.ordem.tabela.cartao.ponto',[isset($dados->id)?$dados->id:' ','asc'])}}"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                                  <li><a class="dropdown-item dropdown__links--filter modal-botao" href="{{route('edit.ordem.tabela.cartao.ponto',[isset($dados->id)?$dados->id:' ','desc'])}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                </ul>
                              </div>
                        </div>
                    </div>
                </section>
                        
                         
                <section class="table">
                    <div class="table-responsive-xxl">
                       
                        <table class="table">
                            <thead class="tr__header">
                                <th class="th__header text-nowrap" style="width:115px;">Boletim</th>
                                <th class="th__header text-nowrap">Tomador</th>
                                <th class="th__header text-nowrap" style="width:200px">Data</th>
                                <th class="th__header text-nowrap" style="width:200px">Quantidade</th>
                                <th class="th__header text-nowrap" style="width:60px;">Relatório</th>
                                <th class="th__header text-nowrap" style="width:60px;">Vizualizar</th>
                                <th class="th__header text-nowrap" style="width:60px;">Editar</th>
                                <th class="th__header text-nowrap" style="width:60px;">Excluir</th>
                            </thead>
                                    
                            <tbody class="table__body">
                               @if( count($lancamentotabelas) > 0)
                               @foreach($lancamentotabelas as $key => $lancamentotabela)
                                <tr class="tr__body">               
                                    <td class="td__body text-nowrap col" style="width:115px;">{{$lancamentotabela->liboletim}}</td>
                                    
                                    <td class="td__body text-nowrap col limitaCarcteres" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$lancamentotabela->tsnome}}">
                                        <a>{{$lancamentotabela->tsnome}}</a>
                                    </td>
                                    <td class="td__body text-nowrap col"style="width:200px">
                                      <?php
                                        $data = explode('-',$lancamentotabela->lsdata)
                                      ?>
                                      {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                                    </td>
                                    <td class="td__body text-nowrap col" style="width:200px">{{$lancamentotabela->lsnumero}}</td>
                                    
                                    <td class="td__body text-nowrap col" style="width:60px">
                                        <a class="btn btn__relatorio modal-botao" href="{{route('relatorio.boletim.tabela',base64_encode($lancamentotabela->id))}}"><i class="icon__color fas fa-file-alt"></i></a>
                                    </td>
                                    
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        
                                        <a class="btn btn__vizualizar" href="{{route('boletim.tabela.create',[base64_encode($lancamentotabela->lsnumero),base64_encode($lancamentotabela->liboletim),base64_encode($lancamentotabela->tomador->id),base64_encode($lancamentotabela->id),base64_encode($lancamentotabela->lsdata)])}}"><i class="icon__color fad fa-eye"></i></a>
                                    </td>
                                    
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        <a class="button__editar btn" href="{{route('tabcartaoponto.edit',base64_encode($lancamentotabela->id))}}"><i class="icon__color fas fa-pen"></i></a>
                                    </td>
                                    
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                       
                                       
                                            <button  class="btn button__excluir" data-bs-toggle="modal" data-bs-target="#deleteBoletimTabPreco{{$key}}"><i class="icon__color fad fa-trash"></i></button>
                                
                                        <section class="delete__tabela--boletim">
                                            <div class="modal fade" id="deleteBoletimTabPreco{{$key}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered col-8">
                                                    <div class="modal-content">
                                                        <form action="{{route('tabcartaoponto.destroy',$lancamentotabela->id)}}" id="" method="post">
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
                                                                        
                                                                        <p class="content--deletar2">Obs: Excluir esse boletim pode afetar em alguns cálculos.</p>
                                                                        
                                                                    </div>
                                                            </div>
                                                            
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn botao__fechar--modal" data-bs-dismiss="modal"><i class="fad fa-times-circle"></i> Não</button>
                                                                <button type="submit" class="btn botao__deletar--modal modal-botao"><i class="fad fa-trash"></i> Deletar</button>
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
                                    <td colspan="12" class="no__register--table">Não há nenhum registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></td>
                                </tr>
                                @endif
                            </tbody>
                            
                            <tfoot>
                                <tr class="">
                                    <td colspan="11">
                                        {{$lancamentotabelas->links()}}

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

          


<script>

    function filtro(){
    var campoFiltro = document.querySelector("#campoFiltro");
    
    campoFiltro.addEventListener('input', function(){
      var descricoes = document.querySelectorAll(".filtro");
        
        if (this.value.length > 0) {
            for(i = 0; i < descricoes.length; i++){
                var descricao = descricoes[i];
                var tdnome = descricao.querySelector(".texto");
                var nome = tdnome.textContent
                var expressao = new RegExp(this.value, "i");
                if (!expressao.test(nome)) {
                    descricao.classList.add("invisivel");
                } else {
                    descricao.classList.remove("invisivel");
                }
                console.log(nome);
            }
        }else{
            for(i = 0; i < descricoes.length; i++){
                var descricao = descricoes[i];
                descricao.classList.remove("invisivel");
            }
        }
        
    });
    }
    
    filtro();
</script>
            