@extends('layouts.index')
@section('titulo','Rhweb - Editar Boletim com Tabela')
@section('conteine')
<div class="card-body">
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
               
                                
              <h5 class="card-title text-center mt-5 mb-5 fs-3 ">Boletim com Tabela <i class="fad fa-ballot"></i></h5>

              

        <div class="container">
            <form class="row g-3 mt-1 mb-3" method="POST" id="form" action="{{route('tabcartaoponto.update',$dados->id)}}">
                <input type="hidden" name="lancamento" value="{{$dados->id}}">
                @csrf
                @method('PATCH')
              
                <div class="row">
                      <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                            <button type="submit" id="incluir" class="btn botao"><i class="fad fa-sync-alt"></i> Atualizar</button>
                            <button type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#teste">
                              <i class="fad fa-list"></i> Lista
                            </button>
                            <a  id="boletim" href="{{route('tabcadastro.create',[base64_encode($dados->lsnumero),base64_encode($dados->liboletim),base64_encode($dados->tomador),base64_encode($dados->id),base64_encode($dados->lsdata)])}}" class="btn botao d-none">Boletim <i class="fad fa-door-open"></i></a>
                            <a class="btn botao" href="{{route('tabcartaoponto.index')}}" role="button"><i class="fad fa-sign-out-alt"></i> Sair</a>
                      </div>
                </div>

              
                <?php
                  if (isset($numboletimtabela->vsnroboletins)) {
                    $boletim = $numboletimtabela->vsnroboletins + 1;
                  }else{
                    $boletim = 1;
                  }
                ?>
                <div class="col-md-4">
                    <label for="num__boletim" class="form-label">Nº do Boletim <i class="fas fa-lock"></i></label>
                    <input type="text" value="{{$dados->liboletim}}" list="listaboletim" class="form-control fw-bold @error('liboletim') is-invalid @enderror" name="liboletim" id="num__boletim" Readonly>
                    @error('liboletim')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <datalist id="listaboletim">
                  </datalist>
                </div>

              
                <div class="col-md-8 input">
                  <label for="tomador" class="form-label">Tomador <i class="fas fa-lock"></i></label>
                  <input type="text" list="datalistOptions" class=" fw-bold form-control @error('nome__completo') is-invalid @enderror" name="nome__completo" value="{{$dados->tsnome}}" id="nome__completo" Readonly>
                  <datalist id="datalistOptions">
                  </datalist>
                  @error('nome__completo')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                  @error('tomador')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                </div>
                
                  <input type="hidden" name="tomador"  class="@error('tomador') is-invalid @enderror" id="tomador" value="{{$dados->tomador}}">
                  <input type="hidden" name="status" value="M" id="status">
                  <input type="hidden" name="empresa" value="{{$user->empresa}}">
                <div class="col-md-2 d-none">
                    <label for="matricula" class="form-label ">Matrícula <i class="fas fa-lock"></i></label>
                    <input type="text" class="form-control fw-bold @error('matricula') is-invalid @enderror " name="matricula" value="" id="matricula" Readonly>
                    @error('matricula')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                

                <div class="col-md-6">
                  <label for="data" class="form-label">Data</label>
                  <input type="date" class="form-control fw-bold @error('data') is-invalid @enderror" name="data" value="{{$dados->lsdata}}" id="data">
                    @error('data')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                  <label for="num__trabalhador" class="form-label">Quantidade de cadastros</label>
                  <input type="number" class="form-control fw-bold @error('num__trabalhador') is-invalid @enderror" name="num__trabalhador" value="{{$dados->lsnumero}}" id="num__trabalhador">
                  @error('num__trabalhador')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="col-md-3 d-none">
                    <label for="feriado" class="form-label">Feriado</label>
                    <select id="feriado" name="feriado" class="form-select fw-bold text-dark" >
                      <option>Sim</option>
                      <option selected>Não</option>
                    </select>
                </div>
                    
                    
            </form>
            @include('tabCartaoPonto.lista')


        </div>
            <script>
            $('.modal-botao').click(function() {
                localStorage.setItem("modal", "enabled");
            })
            function verficarModal(){
              var valueModal = localStorage.getItem('modal');
              if(valueModal === "enabled"){
                  $(document).ready(function(){
                      $("#teste").modal("show");
                  });
                  localStorage.setItem("modal","disabled");
              }
            }
            verficarModal()
            localStorage.setItem('boletim','{{$boletim}}')
            $( "#pesquisa" ).on('keyup focus',function() {
                var dados = '0';
                if ($(this).val()) {
                  dados = $(this).val();
                }
                var status = $('#status').val();
                $.ajax({
                  url: "{{url('tabela/cartao/ponto/pesquisa')}}/"+dados+'/'+status,
                  type: 'get',
                  contentType: 'application/json',
                  success: function(data) {
                    let nome = ''
                    if (data.length >= 1) {
                      data.forEach(element => {
                        nome += `<option value="${element.tsnome}">`
                        // nome += `<option value="${element.tsmatricula}">`
                        nome += `<option value="${element.tscnpj}">`
                      });
                      $('#listapesquisa').html(nome)
                    }
                    if(data.length === 1 && dados.length >= 1){
                      // lancamentoTab(dados,status,data[0].lsdata)
                    }else{
                      limpaCamposTab()
                    }
                  }
                });
            });
            function lancamentoTab(dados,status,data) {
              $('#carregamento').removeClass('d-none')
              $.ajax({
                url: "{{url('tabela/cartao/ponto/unidade')}}/"+dados+'/'+status,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                  camposLacamentoTab(data)
                  $('#carregamento').addClass('d-none')
                }
              })
            }
            function limpaCamposTab() {
              $('#form').attr('action', "{{ route('tabcartaoponto.store') }}");
              $('#incluir').removeAttr( "disabled" )
              $('#atualizar').attr('disabled','disabled')
              $('#deletar').attr('disabled','disabled')
              $('#method').val(' ')
              $('#excluir').attr( "disabled",'disabled' )
              $('#matricula').val(' ')
              $('#nome__completo').val(' ')
              $('#data').val(' ')
              $('#num__trabalhador').val(' ')
              $('#num__boletim').val(localStorage.getItem('boletim'))
            }
            function camposLacamentoTab(data) {
                  if (data.id) {
                      $('#form').attr('action', "{{ url('tabcartaoponto')}}/"+data.id);
                      $('#formdelete').attr('action',"{{ url('tabcartaoponto')}}/"+data.id)
                      $('#incluir').attr('disabled','disabled')
                      $('#atualizar').removeAttr( "disabled" )
                      $('#deletar').removeAttr( "disabled" )
                      $('#excluir').removeAttr( "disabled" )
                      $('#method').val('PUT')
                      buscatomador(data.tomador)
                  }else{
                    $('#form').attr('action', "{{ route('tabcartaoponto.store') }}");
                    $('#incluir').removeAttr( "disabled" )
                    $('#atualizar').attr('disabled','disabled')
                    $('#deletar').attr('disabled','disabled')
                    $('#method').val(' ')
                    $('#excluir').attr( "disabled",'disabled' )
                  }
                  $('#num__boletim').val(data.liboletim).removeClass('is-invalid').next().text(' ')
                  $('#matricula').removeClass('is-invalid').next().text(' ')
                  $('#nome__completo').removeClass('is-invalid').next().text(' ')
                  $('#data').val(data.lsdata).removeClass('is-invalid').next().text(' ')
                  $('#num__trabalhador').val(data.lsnumero).removeClass('is-invalid').next().text(' ')
            }
            $( "#nome__completo" ).on('keyup focus',function() {
              var dados = '0';
              if ($(this).val()) {
                dados = $(this).val();
                if (dados.indexOf('  ') !== -1) {
                  dados = monta_dados(dados);
                }
              }
              $.ajax({
                  url: "{{url('tomador')}}/pesquisa/"+dados,
                  type: 'get',
                  contentType: 'application/json',
                  success: function(data) {
                    tomador(' ')
                    let nome = ''
                      if (data.length >= 1) {
                        data.forEach(element => {
                          nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
                          // nome += `<option value="${element.tsmatricula}">`
                          nome += `<option value="${element.tscnpj}">`
                        });
                        $('#datalistOptions').html(nome)
                      }
                      if(data.length === 1 && dados.length >= 4){
                        let tabela = tabelaPreco(data[0].tomador);
                        if (tabela) {
                          tomador(data[0])
                        }else{
                          Alerta(data[0].tomador)
                        }
                      }           
                  }
              });
            });
            function monta_dados(dados) {
              let novodados = dados.split('  ')
              return novodados[1];
            }
            function Alerta(tomador) {
                Swal.fire({
                title: '<strong>Algo deu Errado!</strong>',
                icon: 'error',
                html:
                  '<strong>Tabela de Preço</strong> não foi <b>cadastrada</b>, ' +
                  `<a href="{{url('tabelapreco')}}/ /${tomador}">Cadastrar</a> `,
                showCloseButton: true,
                allowOutsideClick: false,
                allowEnterKey: true,
              })
            }
            function tabelaPreco(tomador) {
              var resul = false;
              $.ajax({
                  url: "{{url('verifica/tabela/preco')}}/"+tomador,
                  type: 'get',
                  contentType: 'application/json',
                  async: false,
                  success: function(data) {
                    resul = data
                  }
              })
              return resul;
            }
            function buscatomador(dados) {
              $.ajax({
                  url: "{{url('tomador')}}/"+dados,
                  type: 'get',
                  contentType: 'application/json',
                  success: function(data) {
                    if (data) {
                      tomador(data)
                      $('#carregamento').addClass('d-none')
                      $('#nome__completo').val(data.tsnome)
                    }
                  }
              })
            }
            function tomador(data) {
              $('#tomador').val(data.tomador)
              $('#matricula').val(data.tsmatricula)
              $('#domingo').val(data.csdomingos)
              $('#sabado').val(data.cssabados)
              $('#diasuteis').val(data.csdiasuteis)
            }
      </script>     
@stop