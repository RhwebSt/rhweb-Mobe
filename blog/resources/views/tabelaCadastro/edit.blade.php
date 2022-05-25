@extends('layouts.index')
@section('titulo','Rhweb - Editar lançamento Tabela de Preço')
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
        
        <form class="row g-3" id="form" method="POST" action="{{route('boletim.tabela.update',$lancamentorublicas->id)}}">
            
            @csrf
            <input type="hidden" id="method" name="_method" value="put">
            
            <section class="section__botoes--boletim-tabela">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('boletim.tabela.create',[base64_encode($quantidade),base64_encode($boletim),base64_encode($tomador),base64_encode($id),base64_encode($data)])}}"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-4 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                    <button type="submit" id="atualizar"  class="btn botao"><i class="fad fa-sync-alt"></i> Atualizar</button>
                    
                    <button type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#modalBoletimTabela">
                          <i class="fad fa-list-ul"></i> Lista
                    </button>
                </div>
                
            </section>

          
            <h1 class="title__boletim-tabela">Editar Lançamento com Tabela de Preço <i class="fad fa-sack-dollar"></i></h1>
              
            <input type="hidden" name="lancamento" value="{{$id}}">
            <input type="hidden" name="numtrabalhador" value="{{$quantidade}}">
            <input type="hidden" name="valor" id="valor" value="{{$lancamentorublicas->lfvalor}}">
            <input type="hidden" name="lftomador" id="lftomador" value="{{$lancamentorublicas->lftomador}}">
            <input type="hidden" name="boletim" value="{{$boletim}}">
            <input type="hidden" name="tomador" id="tomador" value="{{$tomador}}">
            <input type="hidden" name="data" value="{{$data}}">
            <input type="hidden" name="descricao" id="descricao">
            
            
            <div class="col-md-10">
                <label for="nome__completo" class="form-label">Trabalhador <i class="fas fa-lock" <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo inalterável"></i></label>
                <input value="{{$lancamentorublicas->tsnome}}" class="pesquisa form-control  @error('nome__completo') is-invalid @enderror" list="nomecompleto" name="nome__completo" id="nome__completo" Readonly>
                @error('nome__completo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="text-danger" id="nomemensagem"></span>
                <datalist id="nomecompleto"></datalist>
            </div>
            
            <input type="hidden" name="trabalhador" id="trabalhador" value="{{$lancamentorublicas->trabalhador_id}}">
            
            <div class="col-md-2">
                <label for="matricula" class="form-label">Matrícula <i class="fas fa-lock" <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo inalterável"></i></label>
                <input type="text" value="{{$lancamentorublicas->tsmatricula}}" class="form-control @error('matricula') is-invalid @enderror" name="matricula" value="" id="matricula" Readonly>
                @error('matricula')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="col-md-7 ">
                <label for="rubrica" class="form-label">Descrição <i class="fas fa-lock" <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo inalterável"></i></label>
                <input type="text" value="{{$lancamentorublicas->lshistorico}}" class="form-control @error('rubrica') is-invalid @enderror" list="rublicas" name="rubrica" value="" id="rubrica" Readonly>
                <datalist id="rublicas"></datalist>
                @error('rubrica')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
               
            </div>

            <div class="col-md-2">
                <label for="codigo" class="form-label">Código <i class="fas fa-lock" <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo inalterável"></i></label>
                <input type="text" value="{{$lancamentorublicas->licodigo}}" class="form-control rubrica @error('codigo') is-invalid @enderror" name="codigo" list="codigos" value="" id="codigo" Readonly>
                @error('codigo')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
                <datalist id="codigos"></datalist>
                <span class="text-danger" id="codigomensagem"></span>
            </div>

            

            <div class="col-md-3">
                <label for="quantidade" class="form-label">Quantidade</label>
                <input type="text" value="{{$lancamentorublicas->lsquantidade}}" class="form-control @error('quantidade') is-invalid @enderror" name="quantidade" value="" id="quantidade">
                @error('quantidade')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            
        </form>
    </div>
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
        @include('tabelaCadastro.lista')

        

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
    // $( "#rubrica" ).on('keyup focus',function() {
    //     var dados = '0';
    //     if ($(this).val()) {
    //       dados = $(this).val()
    //       if (dados.indexOf('  ') !== -1) {
    //         dados = monta_dados(dados);
    //         if (dados.indexOf('%') !== -1) {
    //             dados = dados.replace('%','')
    //         }
    //       }
    //     }
    //     $.ajax({
    //         url: "{{url('tabelapreco')}}/pesquisa/"+dados+"/"+$('#tomador').val(),
    //         type: 'get',
    //         contentType: 'application/json',
    //         success: function(data) {
    //             $('#codigo').val(' ')
    //             // $('#codigomensagem').text(' ')
    //             $('#valor').val(' ')
    //             $('#lftomador').val(' ')
    //             let nome = ''
    //             if (data.length >= 1) {
    //                 data.forEach(element => {
    //                     nome += `<option value="${element.tsrubrica}  ${element.tsdescricao}">`
    //                 });
    //                 $('#rublicas').html(nome)
    //             }
    //             if(data.length === 1 && dados.length > 3){
    //                 $('#valor').val(data[0].tsvalor)
    //                 $('#lftomador').val(data[0].tstomvalor)
    //                 $('#rubrica').val(data[0].tsdescricao)
    //                 $('#codigo').val(data[0].tsrubrica)
    //                 $('#descricao').val(data[0].tsdescricao)
    //             }else if(dados.length > 3 && !data.length){
    //                 $('#valor').val(' ')
    //                 $('#lftomador').val(' ')
    //                 // $('#codigo').addClass('is-invalid')
    //                 // $('#codigomensagem').text('Esta rublica não esta cadastra.')
    //             }
    //         }
    //     });
    // });
    $( "#pesquisa" ).on('keyup focus',function() { 
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