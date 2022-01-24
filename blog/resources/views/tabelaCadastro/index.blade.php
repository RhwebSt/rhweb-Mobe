@extends('layouts.index')
@section('conteine')

<div class="container">
        @if(session('success'))
            <script>
                     
                const Toast = Swal.mixin({
                  toast: true,
                  width: 500,
                  color: '#ffffff',
                  background: '#5AA300',
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
                  icon: 'success',
                  title: '{{$message}}'
                })
            </script>
        @endif
        @error('false')
            <script>
                     
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
                  title: '{{$message}}'
                })
            </script>
        @enderror  
        <h1 class="container text-center mt-5 fs-4 mb-2">Lançamento com Tabela de Preço</h1>
        <form class="row g-3 mt-1 mb-5" id="form" method="POST" action="{{route('tabcadastro.store')}}">
        @csrf
        <input type="hidden" id="method" name="_method" value="">
        <div class="row">
              <div class="btn d-grid gap-1 mt-4 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
    
                    <button type="submit" id="incluir" @if(count($lista) >= $quantidade) disabled @endif class="btn botao">Incluir</button>
                    <button type="submit" id="atualizar" disabled class="btn botao">Editar</button>
                    <a class="btn botao" href="{{url('relatorioboletimtabela')}}/{{$boletim}}" id="relatorio" role="button"><i class="fad fa-file-invoice"></i> Relatório</a>
                    <button type="button" class="btn botao" disabled id="excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                      Excluir
                  </button>
                <a class="btn botao" href="{{route('tabcartaoponto.index')}}" role="button">Sair</a>
              </div>
          </div>
              
            <input type="hidden" name="lancamento" value="{{$id}}">
            <input type="hidden" name="numtrabalhador" value="{{$quantidade}}">
            <input type="hidden" name="valor" id="valor">
            <input type="hidden" name="lftomador" id="lftomador">
            <input type="hidden" name="boletim" value="{{$boletim}}">
            <input type="hidden" name="tomador" id="tomador" value="{{$tomador}}">
            <input type="hidden" name="data" value="{{$data}}">
            <input type="hidden" name="descricao" id="descricao">
            
            
            <div class="col-md-10 input">
                <label for="nome__completo" class="form-label">Nome do Trabalhador</label>
                <input class="pesquisa form-control fw-bold fw-bold  @error('nome__completo') is-invalid @enderror" list="nomecompleto" name="nome__completo" id="nome__completo">
                @error('nome__completo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="text-danger" id="nomemensagem"></span>
                <datalist id="nomecompleto">
                   
                </datalist>
            </div>
            
            <input type="hidden" name="trabalhador" id="trabalhador">
            
            <div class="col-md-2 input">
                <label for="matricula" class="form-label">Matrícula</label>
                <input type="text" class="form-control fw-bold @error('matricula') is-invalid @enderror" name="matricula" value="" id="matricula">
                @error('matricula')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-2 input">
                <label for="codigo" class="form-label">Código</label>
                <input type="text" class="form-control rubrica fw-bold @error('codigo') is-invalid @enderror" name="codigo" list="codigos" value="" id="codigo">
                @error('codigo')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
                <datalist id="codigos">   
                </datalist>
                <span class="text-danger" id="codigomensagem"></span>
            </div>

            <div class="col-md-8 input">
                <label for="rubrica" class="form-label">Descrição</label>
                <input type="text" class="form-control fw-bold @error('rubrica') is-invalid @enderror" list="rublicas" name="rubrica" value="" id="rubrica">
                <datalist id="rublicas">   
                </datalist>
                @error('rubrica')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
               
            </div>

            <div class="col-md-2 input">
                <label for="quantidade" class="form-label">Quantidade/Tonelada</label>
                <input type="text" class="form-control fw-bold @error('quantidade') is-invalid @enderror" name="quantidade" value="" id="quantidade">
                @error('quantidade')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            
            </form>
        <?php
            function calculovalores($horas,$valores)
            {
                if(strpos($horas,':')){
                   list($horas,$minitos) = explode(':',$horas);
                   $horasex = $horas * 3600 + $minitos * 60;
                   $horasex = $horasex/60;
                   $horasex = $valores * ($horasex/60);
                }else{
                   $horasex = $valores * $horas;
                }
                return $horasex; 
           }
        ?>
        
        <div class="table-responsive-lg">
            <table class="table border-bottom text-white mt-3 mb-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                <thead>
                    <th class="col text-center border-start border-top text-nowrap" style="width:400px">Nome do Trabalhador</th>
                    <th class="col text-center border-top text-nowrap" style="width:70px">Cod</th>
                    <th class="col text-center border-top text-nowrap" style="width:400px">Descrição</th>
                    <th class="col text-center border-top text-nowrap" style="width:100px">Quantidade</th>
                    <th class="col text-center border-top text-nowrap" style="width:170px">Valor Unitário</th>
                    <th class="col text-center border-top text-nowrap" style="width:170px">Total R$</th>
                    <th class="col text-center border-top text-nowrap" style="width:70px">Editar</th>
                    <th class="col text-center border-end border-top text-nowrap" style="width:70px">Excluir</th>
                </thead>
                <tbody style="background-color: #081049; color: white;">
                    @if(count($lista) > 0)
                    @foreach($lista as $listas)
                        <tr>
                            <td class="col text-center border-bottom border-start text-nowrap text-uppercase">{{$listas->tsnome}}</td>
                            <td class="col text-center border-bottom text-nowrap text-uppercase">{{$listas->licodigo}}</td>
                            <td class="col text-center border-bottom text-nowrap text-uppercase">{{$listas->lshistorico}}</td>
                            <td class="col text-center border-bottom text-nowrap text-uppercase">{{$listas->lsquantidade}}</td>
                            <td class="col text-center border-bottom text-nowrap text-uppercase">R$ {{number_format((float)$listas->lfvalor, 2, ',', '')}}</td>
                            <td class="col text-center border-bottom text-nowrap text-uppercase">R$ {{number_format((float)calculovalores($listas->lsquantidade , $listas->lfvalor), 2, ',', '')}}</td>
                            <td class="col text-center border-bottom text-nowrap text-uppercase">
                                <button class="btn" style="background-color:#204E83;">
                                <a href="{{route('boletim.tabela.edit',[$quantidade,$boletim,$tomador,$listas->lancamento,$listas->id,$data])}}" class="" ><i style="color:#FFFFFF;" class="fa fa-edit"></i></a>
                                </button>
                            </td>
                            <td class="col text-center border-bottom border-end text-nowrap">
                            <form action="{{route('tabcadastro.destroy',$listas->id)}}"  method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn" style="background-color:#FF331F;"><i style="color:#FFFFFF;" class="fal fa-trash"></i></button>
                            </form> 
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td class="text-center border-bottom border-end border-start text-nowrap" colspan="8" style="background-color: #081049; color: white;">
                                <div class="alert" role="alert" style="background-color: #CC2836;">
                                    Não a registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></i>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8" class="text-end">
                            {{$lista->links()}}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" id="formdelete" method="post">
                            @csrf
                            @method('delete')
                            <div class="modal-header modal__delete">
                                <h5 class="modal-title text-white fs-5" id="staticBackdropLabel">Excluir</h5>
                                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body modal-delbody">
                                <p class="mb-1">Deseja realmente excluir?</p>
                            </div>
                            <div class="modal-footer modal-delfooter">
                                <button type="button" class="btn btn__fechar" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn__deletar">Deletar</button>
                            </div>
                    </form>
                </div>
            </div>
         </div>

          <script>
            let rublicas = ['1002','1003','1004','1005']
            $( "#rubrica" ).on('keyup focus',function() {
                var dados = '0';
                if ($(this).val()) {
                  dados = $(this).val()
                  if (dados.indexOf('  ') !== -1) {
                    dados = monta_dados(dados);
                    if (dados.indexOf('%') !== -1) {
                        dados = dados.replace('%','')
                    }
                  }
                }
                $.ajax({
                    url: "{{url('tabelapreco')}}/pesquisa/"+dados+"/"+$('#tomador').val(),
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                        $('#codigo').val(' ')
                        $('#valor').val(' ')
                        $('#lftomador').val(' ')
                        $('#quantidade').attr('type','text')
                        let nome = ''
                        if (data.length >= 1) {
                            data.forEach(element => {
                                nome += `<option value="${element.tsrubrica}  ${element.tsdescricao}">`
                            });
                            $('#rublicas').html(nome)
                        }
                        if(data.length === 1 && dados.length > 3){
                            $('#valor').val(data[0].tsvalor)
                            $('#lftomador').val(data[0].tstomvalor)
                            $('#rubrica').val(data[0].tsdescricao)
                            $('#codigo').val(data[0].tsrubrica)
                            $('#descricao').val(data[0].tsdescricao)
                            if (rublicas.indexOf(data[0].tsrubrica) !== -1) {
                                $('#quantidade').attr('type','time')
                            }
                        }else if(dados.length > 3 && !data.length){
                            $('#valor').val(' ')
                            $('#lftomador').val(' ')
                            $('#quantidade').attr('type','text')
                        }
                    }
                });
            });
           
            $( "#nome__completo" ).on('keyup focus',function() { 
                let  dados = '0'
                if ($(this).val()) {
                  dados = $(this).val()
                  if (dados.indexOf('  ') !== -1) {
                    dados = monta_dados(dados);
                  }
                }
                $.ajax({
                    url: "{{url('trabalhador/pesquisa')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                      $('#nomemensagem').text(' ')
                      $('#matricula').val(' ')
                    //   $( "#nome__completo" ).removeClass('is-invalid')
                      let nome = ''
                      if (data.length >= 1) {
                        data.forEach(element => {
                          nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
                          // nome += `<option value="${element.tsmatricula}">`
                          nome += `<option value="${element.tscpf}">`
                        });
                        $('#nomecompleto').html(nome)
                      }
                      if(data.length === 1 && dados.length > 4){
                        $('#nomecompleto').html(nome)
                        $('#trabalhador').val(data[0].id)
                        $('#matricula').val(data[0].tsmatricula)
                      }else if(!data.length && dados.length > 4){
                        $('#nomemensagem').text('Este trabalhador não ta cadastrador!')
                        // $( "#nome__completo" ).addClass('is-invalid')
                      }              
                    }
                });
            });
            function monta_dados(dados) {
              let novodados = dados.split('  ')
              return novodados[1];
            }
          </script>
@stop