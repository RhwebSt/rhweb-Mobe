@extends('layouts.index')
@section('titulo','Boletim com tabela - Rhweb')
@section('conteine')
<main role="main">
    <div class="container">
        @if(session('success'))
            <script>
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  html: '<p class="modal__aviso">{{session("success")}}</p>',
                  background: '#45484A',
                  showConfirmButton: true,
                  timer: 2500,
        
                });
            </script>
        @endif
        @error('false')
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    html: '<p class="modal__aviso">{{ $message }}</p>',
                    background: '#45484A',
                    showConfirmButton: true,
                    timer: 5000,
        
                });
            </script>
        @enderror
        
        <!--Modal de Acesso não permitido-->
        @error('permissaonegada')
         <script>
            Swal.fire({
              icon: 'error',
              allowOutsideClick: false,
              allowEscapeKey: false,
              allowEnterKey: true,
              html: '<h1 class="fw-bold mb-3 fs-3">Permissão Negada!</h1>'+
              '<p class=" mb-4 fs-6">Contate seu Administrador para receber acesso.</p>'+
              '<div><a class="btn btn-secondary mb-3" href="{{route("home.index")}}">Voltar</a></div>',
              showConfirmButton: false,
            });
        </script> 
        @enderror
        <!--Fim do modal de Acesso não permitido-->

        <!--Modal de não permitido para o Editar, relatorio, excluir e outros botoes-->
        <!--<script>-->
        <!--    Swal.fire({-->
        <!--        icon: 'error',-->
        <!--        title: 'Você não tem Permissão',-->
        <!--        text: 'Contate seu Administrador para receber acesso.',-->
        <!--        allowOutsideClick: false,-->
        <!--        allowEscapeKey: false,-->
        <!--        allowEnterKey: true,-->
        <!--    });-->
        <!--</script>-->
        <!--fim do modal-->

        <form class="row g-3" method="POST" id="form" action="{{route('tabela.cartao.ponto.cadastro')}}">
            @csrf
            <input type="hidden" id="method" name="_method" value="">
            <input type="hidden" name="feriado">
            <section class="section__botoes--boletim-tabela">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('home.index')}}"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
       
                        <button type="submit" id="incluir" class="btn botao"><i class="fad fa-save"></i> Incluir</button>
                        
                        <a type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#modalLancamentoPreco">
                            <i class="fad fa-list"></i> Lista
                        </a>

                </div>
                
            </section>
              
            <h5 class="title__boletim-tabela">Boletim com Tabela <i class="fad fa-pencil-alt"></i></h5>

              
            <?php
              if (isset($numboletimtabela->vsnroboletins)) {
                $boletim = $numboletimtabela->vsnroboletins + 1;
              }else{
                $boletim = 1;
              }
            ?>
            
            <div class="col-md-4">
                <label for="num__boletim" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Nº do Boletim <i class="fad fa-question-circle" data-toggle="tooltip" data-placement="top" title="Número do boletim gerado automáticamente"></i></label>
                <input type="text" value="{{$boletim}}" list="listaboletim" class="form-control @error('liboletim') is-invalid @enderror" name="liboletim" id="num__boletim" >
                @error('liboletim')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <datalist id="listaboletim"></datalist>
            </div>

            <div class="col-md-8 input">
                <label for="tomador" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Tomador</label>
                <input type="text" list="datalistOptions" class=" form-control @error('nome__completo') is-invalid @enderror" name="nome__completo" value="{{old('nome__completo')}}" id="nome__completo" placeholder="dê um duplo clique para pesquisar">
                <datalist id="datalistOptions"></datalist>
                @error('nome__completo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('tomador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                
            <input type="hidden" name="tomador" value="{{old('tomador')}}" class="@error('tomador') is-invalid @enderror" id="tomador">
            <input type="hidden" name="status" value="M" id="status">
            <input type="hidden" name="empresa" value="{{$user->empresa_id}}">

            <div class="col-md-6">
                <label for="data" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Data</label>
                <input type="date" class="form-control @error('data') is-invalid @enderror" name="data" value="{{old('data')}}" id="data">
                @error('data')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="num__trabalhador" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Quantidade de cadastros</label>
                <input type="text" class="form-control @error('num__trabalhador') is-invalid @enderror" name="num__trabalhador" value="{{old('num__trabalhador')}}" id="num__trabalhador" placeholder="quantidade de trabalhadores">
                @error('num__trabalhador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </form>
    </div>
    @include('tabCartaoPonto.lista')
</main>

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
        var tomador = document.querySelector('#nome__completo');
        
        tomador.addEventListener('input', function(){
            var result = tomador.value;
            if(result === {tsmatricula}){
                
            }
        })

        $('#num__trabalhador').mask('#.##0', {reverse: true});
    </script>
    
    
    <script>
    localStorage.setItem('boletim','{{$boletim}}')
    $("#pesquisa").on('keyup focus', function() {
      var dados = '0';
      if ($(this).val()) {
        dados = $(this).val();
        if (dados.indexOf('  ') !== -1) {
          dados = monta_dados_pesquisa(dados);
        }
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
              nome += `<option value="${element.liboletim}  ${element.tsnome}">`
              // nome += `<option value="${element.tsmatricula}">`
              // nome += `<option value="${element.tscnpj}">`
            });
            $('#listapesquisa').html(nome)
          }
          if (data.length === 1 ) {
            $('#search').val(data[0].liboletim)
            // lancamentoTab(dados, status, data[0].lsdata)
          } 
          // else {
          //   // limpaCamposTab()
          // }
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
      $('#form').attr('action', "{{ route('tabela.cartao.ponto.cadastro') }}");
      $('#incluir').removeAttr( "disabled" )
      $('#atualizar').attr('disabled','disabled')
      $('#deletar').attr('disabled','disabled')
      $('#method').val(' ')
      $('#excluir').attr( "disabled",'disabled' )
      $('#matricula').val(' ')
      $('#nome__completo').val(' ')
      $('#data').val(' ')
      $('#num__trabalhador').val(' ')
      $('#boletim').addClass('disabled');
      $('#num__boletim').val(localStorage.getItem('boletim'))
    }
    function camposLacamentoTab(data) {
          console.log(data);
          if (data.id) {
              $('#form').attr('action', "{{ url('tabcartaoponto')}}/"+data.id);
              $('#formdelete').attr('action',"{{ url('tabcartaoponto')}}/"+data.id)
              $('#incluir').attr('disabled','disabled')
              $('#atualizar').removeAttr( "disabled" )
              $('#deletar').removeAttr( "disabled" )
              $('#excluir').removeAttr( "disabled" )
              $('#boletim').removeClass('disabled').attr('href',`{{url('tabcadastro')}}/${ btoa(data.lsnumero)}/${btoa(data.liboletim)}/${ btoa(data.tomador)}/${btoa(data.id)}/${btoa(data.lsdata)}`);
              $('#method').val('PUT')
              buscatomador(data.tomador)
          }else{
            $('#form').attr('action', "{{ route('tabela.cartao.ponto.cadastro') }}");
            $('#incluir').removeAttr( "disabled" )
            $('#atualizar').attr('disabled','disabled')
            $('#deletar').attr('disabled','disabled')
            $('#method').val(' ')
            $('#boletim').addClass('disabled');
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
                  // nome += `<option value="${element.tscnpj}">`
                });
                $('#datalistOptions').html(nome)
              }
              if(data.length === 1){
                tomador(data[0])
                // let tabela = tabelaPreco(data[0].tomador);
                // if (tabela) {
                
                // }else{
                //   // Alerta(data[0].tomador)
                // }
              }           
          }
      });
    });
    function monta_dados(dados) {
      let novodados = dados.split('  ')
      return novodados[0];
    }
    function monta_dados_pesquisa(dados) {
      let novodados = dados.split('  ')
      return novodados[0];
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
      $('#tomador').val(data.id)
      $('#matricula').val(data.tsmatricula)
      $('#domingo').val(data.csdomingos)
      $('#sabado').val(data.cssabados)
      $('#diasuteis').val(data.csdiasuteis)
    }
            
</script>     
@stop