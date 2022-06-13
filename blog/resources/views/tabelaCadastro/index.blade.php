@extends('layouts.index')
@section('titulo','Boletim com Tabela Preço - Rhweb')
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
        <!--<script>-->
        <!--    Swal.fire({-->
        <!--      icon: 'error',-->
        <!--      allowOutsideClick: false,-->
        <!--      allowEscapeKey: false,-->
        <!--      allowEnterKey: true,-->
        <!--      html: '<h1 class="fw-bold mb-3 fs-3">Permissão Negada!</h1>'+-->
        <!--      '<p class=" mb-4 fs-6">Contate seu Administrador para receber acesso.</p>'+-->
        <!--      '<div><a class="btn btn-secondary mb-3" href="{{route("home.index")}}">Voltar</a></div>',-->
        <!--      showConfirmButton: false,-->
        <!--    });-->
        <!--</script>-->
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
        
        
        <form class="row g-3" id="form" method="POST" action="{{route('boletim.tabela.store')}}">
            @csrf
            <input type="hidden" id="method" name="_method" value="">
            
            <section class="section__botoes--boletim-tabela">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('tabela.cartao.ponto.novo')}}"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-4 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
    
                    <button type="submit" id="incluir" @if($lista->count() >= $quantidade) disabled @endif class="btn botao"><i class="fad fa-save"></i> Incluir</button>
                    
                    <button type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#modalBoletimTabela">
                          <i class="fad fa-list-ul"></i> Lista
                    </button>
                    
              </div>
                
            </section>

            <h1 class="title__boletim-tabela">Lançamento com Tabela de Preço <i class="fad fa-sack-dollar"></i></h1>
              
            <input type="hidden" name="lancamento" value="{{$id}}">
            <input type="hidden" name="numtrabalhador" value="{{$quantidade}}">
            <input type="hidden" name="valor" id="valor">
            <input type="hidden" name="lftomador" id="lftomador">
            <input type="hidden" name="boletim" value="{{$boletim}}">
            <input type="hidden" name="tomador" id="tomador" value="{{$tomador}}">
            <input type="hidden" name="data" value="{{base64_decode($data)}}">
            <input type="hidden" name="descricao" id="descricao">
            
            
            <div class="col-md-10">
                <label for="nome__completo" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Trabalhador</label>
                <input class="pesquisa form-control @error('nome__completo') is-invalid @enderror" list="nomecompleto" name="nome__completo" id="nome__completo" value="{{old('nome__completo')}}" placeholder="dê um duplo clique para pesquisar">
                @error('nome__completo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="text-danger" id="nomemensagem"></span>
                <datalist id="nomecompleto"></datalist>
            </div>
            
            <input type="hidden" name="trabalhador" id="trabalhador">
            
            <div class="col-md-2">
                <label for="matricula" class="form-label">Matrícula <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo automático"></i></label>
                <input type="text" class="form-control @error('matricula') is-invalid @enderror" name="matricula" value="{{old('matricula')}}" id="matricula" Readonly>
                @error('matricula')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            

            <div class="col-md-7">
                <label for="rubrica" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Descrição</label>
                <input type="text" class="form-control @error('rubrica') is-invalid @enderror" list="rublicas" name="rubrica" value="{{old('rubrica')}}" id="rubrica" placeholder="dê um duplo clique para escolher um item da tabela de preço">
                <datalist id="rublicas">   
                </datalist>
                @error('rubrica')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
               
            </div>
            
            <div class="col-md-2">
                <label for="codigo" class="form-label">Código <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo automático"></i></label>
                <input type="text" class="form-control rubrica @error('codigo') is-invalid @enderror" name="codigo" list="codigos" value="{{old('codigos')}}" id="codigo" readonly>
                @error('codigo')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
                <datalist id="codigos">   
                </datalist>
                <span class="text-danger" id="codigomensagem"></span>
            </div>

            <div class="col-md-3">
                <label for="quantidade" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Quantidade</label>
                <span id="conteinarquant">
                <input type="text" class="form-control @error('quantidade') is-invalid @enderror" name="quantidade" value="{{old('quantidade')}}" id="quantidade">
                </span>
                
                @error('quantidade')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            
        </form>
    </div>
    @include('tabelaCadastro.lista')
</main>

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
                // $('#quantidade').attr('type','text')
                $('#conteinarquant').html(`<input type="text" class="form-control @error('quantidade') is-invalid @enderror" name="quantidade" value="{{old('quantidade')}}" id="quantidade">`)
                $('#quantidade').mask('000.000.000.000.000.00', {reverse: true});
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
                        // $('#quantidade').attr('type','time')
                        $('#conteinarquant').html(`<input type="time" class="form-control @error('quantidade') is-invalid @enderror" name="quantidade" value="{{old('quantidade')}}" id="">`)
                    }
                }else if(dados.length > 3 && !data.length){
                    $('#valor').val(' ')
                    $('#lftomador').val(' ')
                    $('#conteinarquant').html(`<input type="text" class="form-control @error('quantidade') is-invalid @enderror" name="quantidade" value="{{old('quantidade')}}" id="quantidade">`)
                    $('#quantidade').mask('000.000.000.000.000.00', {reverse: true});
                    // $('#quantidade').attr('type','text')
                }
            }
        });
    });
    // $( "#pesquisa" ).on('keyup focus',function() { 
    //     let  dados = '0'
    //     if ($(this).val()) {
    //       dados = $(this).val()
    //       if (dados.indexOf('  ') !== -1) {
    //         dados = monta_dados(dados);
    //       }
    //     }
      
    // });
    $.ajax({
            url: "{{url('trabalhador/pesquisa')}}/"+0,
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
                $('#listapesquisa').html(nome)
              }            
            }
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