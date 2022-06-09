@extends('layouts.index')
@section('titulo','Boletim Cartão Ponto -Rhweb')
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
        @error('permissaonegada')
 
        <!-- Modal de Acesso não permitido-->
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

        <form class="row g-3" id="form" method="POST" action="{{route('cadastrocartaoponto.store')}}">
            @csrf
            <input type="hidden" id="method" name="_method" value="">
            <input type="hidden" name="status" value="D" id="status">
            <input type="hidden" name="empresa" value="{{$user->empresa->id}}">
            
            <section class="section__botoes--cartao--ponto">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('home.index')}}"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">

                  <button type="submit" id="incluir" class="btn botao"><i class="fad fa-save"></i> Incluir</button>
                  
                  <a type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#modalCartaoPonto">
                    <i class="fad fa-list-ul"></i> lista
                  </a>

                </div>
                
            </section>

            <h1 class="title__cartao--ponto">Boletim Cartão Ponto <i class="fad fa-alarm-clock"></i></h1>
        
            <?php
                if (isset($numboletimtabela->vsnrocartaoponto)) {
                    $boletim = $numboletimtabela->vsnrocartaoponto + 1;
                } else {
                    $boletim = 1;
                }
            ?>
            
            
            <div class="col-md-4">
                <label for="num__boletim" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Nº do Boletim <i class="fad fa-question-circle" data-toggle="tooltip" data-placement="top" title="Numero do boletim gerado automáticamente"></i></label>
                <input type="text" value="{{$boletim}}" class="form-control @error('liboletim') is-invalid @enderror" list="listaboletim" name="liboletim" id="num__boletim" value="{{old('liboletim')}}">
                @error('liboletim')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <datalist id="listaboletim"></datalist>
            </div>

            <div class="col-md-8 input">
                <label for="tomador" class="form-label "><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Tomador</label>
                <input type="text" class="form-control @error('nome__completo') is-invalid @enderror" list="datalistOptions" name="nome__completo" value="{{old('nome__completo')}}" id="nome__completo" placeholder="dê um duplo clique para escolher o tomador">
                <datalist id="datalistOptions"></datalist>
                @error('nome__completo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('tomador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <input type="hidden" name="tomador" class="@error('tomador') is-invalid @enderror" value="{{old('tomador')}}" id="tomador">
            <input type="hidden" id="domingo" name="domingo">
            <input type="hidden" name="sabado" id="sabado">
            <input type="hidden" name="diasuteis" id="diasuteis">


            <div class="col-md-4">
                <label for="data" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Data</label>
                <input type="date" class="form-control @error('data') is-invalid @enderror" name="data" value="{{old('data')}}" id="data">
                @error('data')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="num__trabalhador" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Quantidade de Cadastros</label>
                <input type="text" class="form-control @error('num__trabalhador') is-invalid @enderror" name="num__trabalhador" value="{{old('num__trabalhador')}}" id="num__trabalhador" maxlength="15"  placeholder="quantidade de trabalhadores">
                @error('num__trabalhador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="feriado" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Feriado</label>
                <select id="feriado" name="feriado" class="form-select @error('feriado') is-invalid @enderror">
                    <option>Sim</option>
                    <option selected>Não</option>
                </select>
                @error('feriado')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <input type="hidden" name="feriadostatus" id="feriadostatus">
            </div>
            
        </form>
    </div>
    @include('cadastroCartaoPonto.lista')
</main>

<script>


    $('#num__trabalhador').mask('#.##0', {
      reverse: true
    });
  </script>

  <script>

     var semana = ["Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado"];
     $('#data').on('keyup focus click change',function () {
       verificardata($(this).val(),0)
     })
     function verificardata(Y,valor) {
        var data = Y
        var dias = '';
        data = data.split('-')
        dias = new Date(`${data[0]}-${data[1]}-${ parseInt(data[2]) + valor} 08:24:30`);
        dias = dias.getDay();
        semana.forEach((element,index) => {
            if (dias == index) {
                if (element === 'Domingo') {
                  $('#feriadostatus').val(true)
                }else if (element === 'Sábado') {
                  $('#feriadostatus').val(true)
                }
                let novadata = `${data[0]}-${data[1]}-${ parseInt(data[2]) + valor}`
                if (feriador_nacionais(novadata)) {
                  $('#feriadostatus').val(true)
                }else if (element !== 'Domingo' && element !== 'Sábado') {
                  $('#feriadostatus').val(null)
                }
            }
        })
    }
    function feriador_nacionais(dados) {
        var verifica = false;
        $.ajax({
            url: "https://brasilapi.com.br/api/feriados/v1/2021",
            type: 'get',
            contentType: 'application/json',
            async: false,
            success:(data) => {
                data.forEach(element => {
                    if (element.date === dados) {
                        verifica = true;
                    }
                });
            }  
        })
        return verifica;
    }

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
        url: "{{url('tabela/cartao/ponto/pesquisa')}}/" + dados + '/' + status,
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

    function lancamentoTab(dados, status, data) {
      $('#carregamento').removeClass('d-none')
      $.ajax({
        url: "{{url('tabela/cartao/ponto/unidade')}}/" + dados + '/' + status,
        type: 'get',
        contentType: 'application/json',
        success: function(data) {
          camposLacamentoTab(data)
          $('#carregamento').addClass('d-none')
        }
      })
    }

    function limpaCamposTab() {
      $('#form').attr('action', "{{ route('cadastrocartaoponto.store') }}");
      $('#incluir').removeAttr("disabled")
      $('#atualizar').attr('disabled', 'disabled')
      $('#deletar').attr('disabled', 'disabled')
      $('#method').val(' ')
      $('#excluir').attr("disabled", 'disabled')
      $('#matricula').val(' ')
      $('#nome__completo').val(' ')
      $('#data').val(' ')
      $('#num__trabalhador').val(' ')
      $('#num__boletim').val(localStorage.getItem('cartao'))
    }

    function camposLacamentoTab(data) {
      if (data.id) {
        buscatomador(data)
        $('#form').attr('action', "{{ url('cadastrocartaoponto')}}/" + data.id);
        $('#formdelete').attr('action', "{{ url('cadastrocartaoponto')}}/" + data.id)
        $('#incluir').attr('disabled', 'disabled')
        // $('#atualizar').removeAttr( "disabled" )
        $('#deletar').removeAttr("disabled")
        $('#excluir').removeAttr("disabled")
        $('#method').val('PUT')


      } else {
        $('#form').attr('action', "{{ route('cadastrocartaoponto.store') }}");
        $('#incluir').removeAttr("disabled")
        $('#atualizar').attr('disabled', 'disabled')
        $('#deletar').attr('disabled', 'disabled')
        $('#method').val(' ')
        $('#excluir').attr("disabled", 'disabled')
      }
      $('#num__boletim').val(data.liboletim).removeClass('is-invalid').next().text(' ')
      $('#matricula').removeClass('is-invalid').next().text(' ')
      $('#nome__completo').removeClass('is-invalid').next().text(' ')
      $('#data').val(data.lsdata).removeClass('is-invalid').next().text(' ')
      $('#num__trabalhador').val(data.lsnumero).removeClass('is-invalid').next().text(' ')
      for (let index = 0; index < $('#feriado option').length; index++) {
        if (data.lsferiado == $('#feriado option').eq(index).text()) {
          $('#feriado option').eq(index).attr('selected', 'selected')
        } else {
          $('#feriado option').eq(index).removeAttr('selected')
        }
      }
    }
    $("#nome__completo").on('keyup focus', function() {
      var dados = '0';
      if ($(this).val()) {
        dados = $(this).val();
        if (dados.indexOf('  ') !== -1) {
          dados = monta_dados(dados);
        }
      }
      $.ajax({
        url: "{{url('tomador')}}/pesquisa/" + dados,
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
          if (data.length === 1 ) {
            let tabela = tabelaPreco(data[0].id);
            if (tabela) {
              tomador(data[0])
            } else {
              Alerta(data[0].id)
            }
          }
        }
      });
    });

    function monta_dados(dados) {
      let novodados = dados.split('  ')
      return novodados[1];
    }

    function monta_dados_pesquisa(dados) {
      let novodados = dados.split('  ')
      console.log(novodados);
      return novodados[0];
    }

    function Alerta(tomador) {
      Swal.fire({
        title: '<strong>Algo deu Errado!</strong>',
        icon: 'error',
        html: '<strong>Tabela de Preço</strong> não foi <b>cadastrada</b>, ' +
          `<a href="{{url('tabelapreco')}}/ /${tomador}">Cadastrar</a> `,
        showCloseButton: true,
        allowOutsideClick: false,
        allowEnterKey: true,
      })
    }

    function tabelaPreco(tomador) { 
      var resul = false;
      $.ajax({
        url: "{{url('verifica/tabela/preco')}}/" + tomador,
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
        url: "{{url('tomador')}}/" + dados.tomador,
        type: 'get',
        contentType: 'application/json',
        success: function(data) {
          if (data) {
            tomador(data)
            $('#nome__completo').val(data.tsnome)
            $('#boletim').removeClass('disabled').attr('href', `{{url('boletimcartaoponto')}}/${btoa(dados.id)}/${btoa(data.csdomingos)}/${btoa(data.cssabados)}/${btoa(data.csdiasuteis)}/${btoa(dados.lsdata)}/${btoa(dados.liboletim)}/${btoa(dados.tomador)}/${btoa(dados.lsferiado)}`);
          }
        }
      })
    }

    function tomador(data) {
      $('#tomador').val(data.id)
      $('#matricula').val(data.tsmatricula)
      $('#domingo').val(data.csdomingos ? data.csdomingos : 0.00)
      $('#sabado').val(data.cssabados ? data.cssabados : 0.00)
      $('#diasuteis').val(data.csdiasuteis)
    }
</script>
  @stop