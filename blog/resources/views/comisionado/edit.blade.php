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
              <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('comisionado.update',$dados->id)}}">
                  
                  <h5 class="card-title text-center mt-5 fs-3 ">Comissionado</h5>
                @csrf
                @method('PATCH')
                <input type="hidden" value="{{$dados->idtomador}}" name="tomador" id="idtomador" class="@error('tomador') is-invalid @enderror">
                <input type="hidden" value="{{$dados->idtrabalhador}}" name="trabalhador" id="idtrabalhador" class="@error('trabalhador') is-invalid @enderror">
                <div class="row">
                    <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                        <button type="submit"   class="btn botao" >Atualizar</button>
                        <a class="btn botao" href="{{route('comisionado.index')}}"  role="button">Sair</a>
                    </div>
                </div>
                
                


                <div class="col-md-8">
                    <label for="exampleDataList" class="form-label">Nome Do Trabalhador</label>
                    <input class="pesquisa form-control @error('nome__trabalhador') is-invalid @enderror fw-bold text-dark" list="listatrabalhador" name="nome__trabalhador" value="{{$dados->trabalhador}}" id="nome__trabalhador">
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
                  <input type="text" class="form-control  @error('matricula__trab') is-invalid @enderror" name="matricula__trab"  value="{{$dados->tsmatricula}}" id="matricula__trab" Readonly>
                    @error('matricula__trab')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <input type="hidden" id="comissionado">
                <div class="col-md-4">
                  <label for="indice" class="form-label">Indíce %</label>
                  <input type="text" class="form-control @error('indice') is-invalid @enderror fw-bold text-dark" name="indice" value="{{$dados->csindece}}" id="indice">
                    @error('indice')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="col-md-8">
                    <label for="exampleDataList" class="form-label">Tomador</label>
                    <input class=" form-control @error('nome_tomador') is-invalid @enderror fw-bold text-dark" list="listatomador" name="nome_tomador"  value="{{$dados->tomador}}" id="nome_tomador">
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
                            <i class="fas fa-sort"></i> Filtro 
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item text-white" href="#"><i class="fas fa-history"></i> Mais Recente</a></li>
                        <li><a class="dropdown-item text-white" href="#"><i class="fas fa-sort-numeric-down-alt"></i> Mais Antigo</a></li>
                        <li><a class="dropdown-item text-white" href="#"><i class="fas fa-sort-amount-up-alt"></i> Ordem Crescente</a></li>
                        <li><a class="dropdown-item text-white" href="#"><i class="fas fa-sort-amount-up"></i> Ordem Decrescente</a></li>
                        </ul>
                    </div>
                </div>
                
                
                
                <div class="table-responsive-lg">
                            <table class="table border-bottom text-white mb-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                                <thead>
                                    <th class="col text-center border-top border-start text-nowrap" style="width:115px;">Matrícula</th>
                                    <th class="col text-center border-top text-nowrap" style="width: 300px;">Nome Trabalhador</th>
                                    <th class="col text-center border-top text-nowrap " style="width:200px">Indice %</th>
                                    <th class="col text-center border-top text-nowrap" style="width:300px">Nome Tomador</th>
                                </thead>
                                <tbody style="background-color: #081049; color: white;">
                                   
                                    <tr>               
                                        <td class="col text-center border-bottom border-start text-nowrap" style="width:115px;"></td>
                                        <td class="col text-center border-bottom text-capitalize text-nowrap" style="width: 300px;">
                                            <button type="button" class="btn text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Eliel FElipe dos Santos Rocha" style="max-width: 60ch; overflow: hidden; text-overflow: ellipsis;">
                                                <a>Eliel FElipe dos Santos Rocha</a>
                                            </button>
                                            
                                        </td>
                                        <td class="col text-center border-bottom text-capitalize text-nowrap "style="width:200px"></td>
                                        <td class="col text-center border-bottom text-nowrap" style="width:300px">
                                            <button type="button" class="btn text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Mobe Maõ de obra Terceirizada LTDA" style="max-width: 50ch; overflow: hidden; text-overflow: ellipsis;">
                                                <a>Mobe Maõ de obra Terceirizada LTDA</a>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                
                            </table>
                        </div>

            </div>
            <script>
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
                        // $('#atualizar').removeAttr( "disabled" )
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
                        //   $('#atualizar').attr('disabled','disabled')
                          $('#excluir').attr( "disabled" )
                      }
                    }
                })
            }
        });
    </script>     
@stop