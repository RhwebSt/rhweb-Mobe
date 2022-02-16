@extends('layouts.index')
@section('titulo','Rhweb - Comissionado')
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
                      title: '{{ session("success") }}'
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
                      title: '{{ $message }}'
                    })
                </script>
            @enderror
              <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('comisionado.store')}}">
                  
                  <h5 class="card-title text-center mt-5 fs-3 ">Comissionado <i class="far fa-percent"></i></h5>
                @csrf
                <input type="hidden" id="method" name="_method" value="">
                <input type="hidden" name="tomador" id="idtomador" class="@error('tomador') is-invalid @enderror">
                <input type="hidden" name="trabalhador" id="idtrabalhador" class="@error('trabalhador') is-invalid @enderror">
                <div class="row">
                    <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                        <button type="submit" id="incluir"  class="btn botao" ><i class="fad fa-save"></i> Incluir</button>
                        <a class="btn botao" href="{{route('home.index')}}"  role="button"><i class="fad fa-sign-out-alt"></i> Sair</a>
                    </div>
                </div>
                
                <div class="container mt-5 text-start fs-5 fw-bold">Pesquisar <i class="fas fa-search"></i></div>
                
                <div>
                    <div class="col-md-5 mb-4 p-1 pesquisar">
                        <div class="d-flex">
                        <label for="exampleDataList" class="form-label"></label>
                        <input class="form-control fw-bold text-dark pesquisa" list="datalistOptions" name="pesquisa" id="pesquisa">
                        <datalist id="datalistOptions">
                          
                        </datalist>
                        <i class="fas fa-search fa-md iconsear" id="icon"></i>
                        <div class="text-center d-none p-1" id="refres" >
                            <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black; margin-top: 6px;width: 1.2rem; height: 1.2rem;">
                              <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                
                


                <div class="col-md-8">
                    <label for="exampleDataList" class="form-label">Nome Do Trabalhador
                        <span id="refre" data-bs-toggle="tooltip" data-bs-placement="top" title="Limpar todos os campos" style="background-color:#A71113; padding: 0.6px 4px; border: 1px solid #DF1619; border-radius: 20px;"><i class="fad fa-sync-alt " style="color: #fff"></i></span>
                    </label>
                    <input class="text-uppercase pesquisa form-control @error('nome__trabalhador') is-invalid @enderror fw-bold text-dark" list="listatrabalhador" name="nome__trabalhador" value="{{old('nome__trabalhador')}}" id="nome__trabalhador">
                    <datalist id="listatrabalhador">
                    </datalist>
                    @error('nome__trabalhador')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    @error('trabalhador')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4">
                  <label for="matricula__trab" class="form-label">Matricula Trabalhador <i class="fas fa-lock"></i></label>
                  <input type="text" class="form-control  @error('matricula__trab') is-invalid @enderror" name="matricula__trab"  value="{{old('matricula__trab')}}" id="matricula__trab" Readonly>
                    @error('matricula__trab')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <input type="hidden" id="comissionado">
                <div class="col-md-4">
                  <label for="indice" class="form-label">Indíce %</label>
                  <input type="text" class="form-control @error('indice') is-invalid @enderror fw-bold text-dark" name="indice" value="{{old('indice')}}" id="indice">
                    @error('indice')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="col-md-8">
                    <label for="exampleDataList" class="form-label">Tomador</label>
                    <input class="text-uppercase form-control @error('nome_tomador') is-invalid @enderror fw-bold text-dark" list="listatomador" name="nome_tomador"  value="{{old('nome_tomador')}}" id="nome_tomador">
                    <datalist id="listatomador">
                      
                    </datalist>
                    @error('nome_tomador')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    @error('tomador')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
              </form>
              
              <div class="d-flex justify-content-end">
        
        
                    <div class="dropdown  mt-2 p-1">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#111317; color: white;">
                            <i class="fad fa-sort"></i> Filtro 
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item text-white" href="#"><i class="fad fa-history"></i> Mais Recente</a></li>
                        <li><a class="dropdown-item text-white" href="#"><i class="fad fa-sort-numeric-down-alt"></i> Mais Antigo</a></li>
                        <li><a class="dropdown-item text-white" href="#"><i class="fad fa-sort-amount-up-alt"></i> Ordem Crescente</a></li>
                        <li><a class="dropdown-item text-white" href="#"><i class="fad fa-sort-amount-up"></i> Ordem Decrescente</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="table-responsive-xxl">
                            <table class="table border-bottom text-white mb-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                                <thead>
                                    <th class="col text-center border-top border-start text-nowrap" style="width:115px;">Matrícula</th>
                                    <th class="col text-center border-top text-nowrap" style="width: 300px;">Nome Trabalhador</th>
                                    <th class="col text-center border-top text-nowrap " style="width:200px">Indice %</th>
                                    <th class="col text-center border-top text-nowrap" style="width:300px">Nome Tomador</th>
                                    <th class="col text-center border-top text-nowrap" style="width:60px;">Editar</th>
                                    <th class="col text-center border-end border-top text-nowrap" style="width:60px;">Excluir</th>
                                </thead>
                                <tbody style="background-color: #081049; color: white;">
                                   @if(count($comissionados) > 0)
                                   @foreach($comissionados as $comissionado)
                                    <tr class="bodyTabela">               
                                        <td class="col text-center border-bottom border-start text-nowrap" style="width:115px;">{{$comissionado->tsmatricula}}</td>
                                        <td class="col text-center border-bottom text-capitalize text-nowrap" style="width: 300px;">
                                            <button type="button" class="text-uppercase btn text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$comissionado->trabalhador}}" style="max-width: 60ch; overflow: hidden; text-overflow: ellipsis;">
                                                <a>{{$comissionado->trabalhador}}</a>
                                            </button>
                                            
                                        </td>
                                        <td class="col text-center border-bottom text-capitalize text-nowrap "style="width:200px">{{$comissionado->csindece}}</td>
                                        <td class="col text-center border-bottom text-nowrap" style="width:300px">
                                            <button type="button" class="text-uppercase btn text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$comissionado->tomador}}" style="max-width: 50ch; overflow: hidden; text-overflow: ellipsis;">
                                                <a>{{$comissionado->tomador}}</a>
                                            </button>
                                        </td>
                                        <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                            <button class="btn">
                                                <a href="{{route('comisionado.edit',$comissionado->id)}}" class="btn__padrao--editar" ><i style="color:#FFFFFF; padding-left: 3px;" class="fad fa-edit"></i></a>
                                            </button>
                                        </td>
                                        <td class="col text-center border-bottom border-end text-nowrap" style="width:60px;">
                                           <form action="{{route('comisionado.destroy',$comissionado->id)}}"  method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn__padrao--excluir"><i style="color:#FFFFFF;" class="fad fa-trash"></i></button>
                                            </form> 
                                            </td>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                <tr>
                                    <td class="text-center border-end border-start text-nowrap" colspan="11" style="background-color: #081049; color: white;">
                                        <div class="alert" role="alert" style="background-color: #CC2836;">
                                            Não á registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></i>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                </tbody>
                                <tfoot>
                                <tr class=" border-end border-start border-bottom">
                                    <td colspan="11">
                                    {{ $comissionados->links() }}
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
                                            <p class="mb-2">Obs:( Caso exclua os dados do trabalhador seus depedentes serão excluidos.)</p>
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
            </div>
            <script>
            
            var botaolimpaCampos = document.querySelector("#refre");

            botaolimpaCampos.addEventListener('click', function(){
                var nomeTrabalhador = document.querySelector("#nome__trabalhador").value='';
                var matriculaTrabalhador = document.querySelector("#matricula__trab").value='';
                var indice = document.querySelector("#indice").value='';
                var nomeTomador = document.querySelector("#nome_tomador").value='';
            });
            
            
            
            
        $(document).ready(function(){
           
           
            $( "#nome_tomador" ).on('keyup focus',function() {
                var dados = '0';
                if ($(this).val()) {
                    dados = $(this).val();
                    if (dados.indexOf('  ') !== -1) {
                        dados = monta_dados(dados);
                    }
                }
                $.ajax({
                    url: "{{url('tomador/pesquisa')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                        let nome = ''
                        if (data.length >= 1) {
                            data.forEach(element => {
                            nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
                            // nome += `<option value="${element.tsmatricula}">`
                            nome += `<option value="${element.tscnpj}">`
                            });
                            $('#listatomador').html(nome)
                        } 
                        if(data.length === 1 && dados.length >= 2){
                            $('#idtomador').val(data[0].tomador)
                        }
                        if (data[0].tomador && $('#idtrabalhador').val() && $('#comissionado').val() || !data[0].tomador) {
                            $('#incluir').attr('disabled','disabled')
                        }else{
                            $('#incluir').removeAttr( "disabled" )
                        }
                    }
                });
            });
            $( "#nome__trabalhador" ).on('keyup focus',function() {
                var dados = '0';
                if ($(this).val()) {
                    dados = $(this).val();
                    if (dados.indexOf('  ') !== -1) {
                        dados = monta_dados(dados);
                    }
                }
                $.ajax({
                    url: "{{url('trabalhador/pesquisa')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                        let nome = ''
                        if (data.length >= 1) {
                            data.forEach(element => {
                            nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
                            // nome += `<option value="${element.tsmatricula}">`
                            nome += `<option value="${element.tscpf}">`
                            });
                            $('#listatrabalhador').html(nome)
                        } 
                        if(data.length === 1 && dados.length >= 2){
                            $('#idtrabalhador').val(data[0].id)
                            $('#matricula__trab').val(data[0].tsmatricula)
                            comissionador(data[0].id)
                        }
                        if (data[0].trabalhador && $('#idtomador').val() && $('#comissionado').val() || !data[0].trabalhador) {
                          $('#incluir').attr('disabled','disabled')
                        }else{
                          $('#incluir').removeAttr( "disabled" )
                        }
                    }
                });
            });
            function monta_dados(dados) {
              let novodados = dados.split('  ')
              return novodados[1];
            }
            function comissionador(id) {
                $.ajax({
                    url: "{{url('comisionado')}}/"+id,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                      if (data.id) {
                        $('#comissionado').val(data.id);
                        $('#atualizar').removeAttr( "disabled" )
                        $('#excluir').removeAttr( "disabled" )
                        $('#incluir').attr('disabled','disabled')
                        $('#method').val('PUT')
                        $('#matricula__trab').val(data.csmatricula)
                        $('#indice').val(data.csindece);
                        $('#nome_tomador').val(data.tsnome)
                        $('#idtomador').val(data.tomador)
                        $('#form').attr('action', "{{ url('comisionado')}}/"+data.id);
                      }else{
                          // $('#incluir').attr('disabled','disabled')
                          $('#atualizar').attr('disabled','disabled')
                          $('#excluir').attr( "disabled" )
                      }
                    }
                })
            }
        });
    </script>     
@stop