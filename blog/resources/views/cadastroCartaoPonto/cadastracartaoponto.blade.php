@extends('layouts.index')
@section('conteine')
<div class="container">
        <h1 class="container text-center mt-3 fs-4 mb-5">Boletim com Cartão Ponto</h1>
        <form class="row g-3 mt-1 mb-5" id="form" method="POST" action="{{route('boletimcartaoponto.store')}}">
        @csrf
        <input type="hidden" id="method" name="_method" value="">
        <input type="hidden" name="domingo" id="domingo" value="{{$domingo}}">
        <input type="hidden" name="sabado" id="sabado" value="{{$sabado}}">
        <input type="hidden" name="diasuteis" id="diasuteis" value="{{$diasuteis}}">
        <input type="hidden" name="data" value="{{$data}}">
        <div class="row">
                  <div class="btn mt-3 form-control" role="button" aria-label="Basic example">
       
                        <button type="submit" id="incluir" class="btn btn-primary">Incluir</button>
                        <button type="submit" id="atualizar" disabled class="btn btn-primary">Editar</button>
                        <button type="button" class="btn btn-primary  " disabled id="excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          Excluir
                      </button>
                    <a class="btn btn btn-primary" href="{{route('cadastrocartaoponto.index')}}" role="button">Sair</a>
                  </div>
              </div>
            <input type="hidden" name="lancamento" value="{{$id}}"> 
            <input type="hidden" name="trabalhador" id="trabalhador">          
            <div class="col-md-10 input mt-5">
                <label for="nome__completo" class="form-label">Nome do Trabalhador</label>
                <input type="text" class="form-control " name="nome__completo" value="" id="nome__completo">
            </div>
            <div class="col-md-2 input mt-5">
                <label for="matricula" class="form-label">Matrícula</label>
                <input type="text" class="form-control " name="matricula" value="" id="matricula">
            </div>
            <!-- <div class="col-md-2 input">
                <label for="data" class="form-label">Data</label>
                <input type="date" class="form-control " name="data" value="" id="data">
            </div> -->
            <div class="col-md-2 input">
                <label for="entrada1" class="form-label">Entrada</label>
                <input type="time" class="form-control " name="entrada1" value="" id="entrada1">
            </div>

            <div class="col-md-2 input">
                <label for="saida1" class="form-label">Saída</label>
                <input type="time" class="form-control " name="saida" value="" id="saida">
            </div>

            <div class="col-md-2 input">
                <label for="entrada2" class="form-label">Entrada</label>
                <input type="time" class="form-control " name="entrada2" value="" id="entrada2">
            </div>

            <div class="col-md-2 input">
                <label for="saida2" class="form-label">Saída</label>
                <input type="time" class="form-control " name="saida2" value="" id="saida2">
            </div>

            <div class="col-md-1 input">
                <label for="total" class="form-label">Total</label>
                <input type="text" class="form-control " name="total" value="" id="total">
            </div>

            <div class="col-md-1 input">
                <label for="hora__extra" class="form-label">HRS 50%</label>
                <input type="text" class="form-control " name="hora__extra" value="" id="hora__extra">
            </div>

            <div class="col-md-1 input">
                <label for="horas__cem" class="form-label">HRS 100%</label>
                <input type="text" class="form-control " name="horas__cem" value="" id="horas__cem">
            </div>

            <div class="col-md-1 input">
                <label for="adc__noturno" class="form-label">ADC.NOT</label>
                <input type="text" class="form-control " name="adc__noturno" value="" id="adc__noturno">
            </div>
            

        </form>

        <table class="table table-sm border-bottom  text-white table-responsive mt-5" style="background-color: #353535;">
            <thead>
                <th class="col text-white">Matricula</th>
                <th colspan="2" class="col text-white">Nome</th>
                <th class="col text-white">Entrada</th>
                <th class="col text-white">Saída</th>
                <th class="col text-white">Entrada</th>
                <th class="col text-white">Saída</th>
                <th class="col text-white">Total</th>
                <th class="col text-white">HRS 50%</th>
                <th class="col text-white">HRS 100%</th>
                <th class="col text-white">AD.NOT</th>
            </thead>
            <tbody>
            @if(count($lista) > 0)
                @foreach($lista as $listas)
                <tr>
                <td class="bg-light text-black">{{$listas->tsmatricula}}</td>
                <td class="bg-light text-black">{{$listas->tsnome}}</td>
                <td class="bg-light text-black">{{$listas->tsmatricula}}</td>
                <td class="bg-light text-black">{{$listas->bsentradamanhao}}</td>
                <td class="bg-light text-black">{{$listas->bssaidamanhao}}</td>
                <td class="bg-light text-black">{{$listas->bsentradatarde}}</td>
                <td class="bg-light text-black">{{$listas->bssaidatarde}}</td>
                <td class="bg-light text-black">{{$listas->bstotal}}</td>
                <td class="bg-light text-black">{{$listas->bshoraex}}</td>
                <td class="bg-light text-black">{{$listas->bshoraexcem}}</td>
                <td class="bg-light text-black">{{$listas->bsadinortuno}}</td>
               
                </tr>
               
                @endforeach
                @else
                    <tr>
                        <td colspan="11" class="bg-light text-black">
                        <div class="alert alert-danger" role="alert">
                            Não a registro cadastrador!
                        </div>
                        </td>
                    </tr>
                @endif
            </tbody>
            
            <tfoot>
                <tr>
                    <td colspan="11">
                    {{ $lista->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header " style="background-image: linear-gradient(-120deg, rgb(32, 36, 236),rgb(16, 78, 248));">
                  <h5 class="modal-title text-white" id="staticBackdropLabel">Excluir</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="background-color: #fffdfd;">
                  <p class="text-black text-start fs-5">Deseja realmente excluir?</p>
                </div>
                <div class="modal-footer" style="background-color: #fffdfd;">
                  <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color:#1e53ff;">Fechar</button>
                  <form action="">
                  <a class="btn ms-2 text-white" href="#" role="button" style="background-color:#bb0202;">Deletar</a> 
                </form> 
                </div>
              </div>
            </div>
          </div>
</div>
<script>
            $( "#nome__completo" ).keyup(function() {
                var dados = $( "#nome__completo" ).val();
                if (dados) {
                    $.ajax({
                        url: "{{url('boletimcartaoponto')}}/"+dados,
                        type: 'get',
                        contentType: 'application/json',
                        success: function(data) {
                          if (data.id) {
                            $('#form').attr('action', "{{ url('boletimcartaoponto')}}/"+data.id);
                            // $('#formdelete').attr('action',"{{ url('boletimcartaoponto')}}/"+data.tomador)
                            $('#incluir').attr('disabled','disabled')
                            $('#atualizar').removeAttr( "disabled" )
                            // $('#deletar').removeAttr( "disabled" )
                            // $('#excluir').removeAttr( "disabled" )
                            $('#method').val('PUT')
                            $('#trabalhador').val(data.trabalhador)
                            $('#matricula').val(data.tsmatricula)
                            $('#entrada1').val(data.bsentradamanhao)
                            $('#saida').val(data.bssaidamanhao)
                            $('#entrada2').val(data.bsentradatarde)
                            $('#saida2').val(data.bssaidatarde)
                            $('#total').val(data.bstotal)
                            $('#hora__extra').val(data.bshoraex)
                            $('#horas__cem').val(data.bshoraexcem)
                            $('#adc__noturno').val(data.bsadinortuno)
                          }else{
                              trabalhador(dados)
                          }
                        }
                    });
                }
            });
            function trabalhador(dados) {
                $.ajax({
                    url: "{{url('trabalhador')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                        if (data.id) {
                        $('#trabalhador').val(data.trabalhador)
                        $('#matricula').val(data.tsmatricula)
                        }
                    }
                });
            }
    
            var semana = ["Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado"];
            var data = new Date('{{$data}} 08:24:30');
            var dias = data.getDay();
   
            $('#total').focus(function(){
                let horario1 = $('#entrada1').val();
                let horario2 =$('#saida').val();
                let horario3 = $('#entrada2').val();
                let horario4 = $('#saida2').val();
                let partes1 = horario1.split(':');
                let segundos1 = partes1[0] * 3600 + partes1[1] * 60;
                let partes2 = horario2.split(':');
                let segundos2 = partes2[0] * 3600 + partes2[1] * 60;
                let partes3 = horario3.split(':');
                let segundos3 = partes3[0] * 3600 + partes3[1] * 60;
                let partes4 = horario4.split(':');
                let segundos4 = partes4[0] * 3600 + partes4[1] * 60;
                // adnotuno(segundos1,segundos2,segundos3,segundos4,total)
                if (horario1 && horario2 && horario3 && horario4) {
                    let totalHoras = (segundos2 - segundos1) + (segundos4 - segundos3);
                    let total = totalHoras;
                    let horas = Math.floor(total / 3600);
                    let minutos = Math.floor((total - (horas * 3600)) / 60);
                    let segundos = Math.floor(total % 60);
                    $(this).val(`${horas}:${minutos < 10 ? '0':''}${minutos}`) 
                    feriados(total)
                    
                    semana.forEach((element,index) => {
                        if (dias == index) {
                            if (element === 'Sábado') {
                                sabado(total)
                            }else{
                                diasuteis(total)
                            }
                        }
                    })
                }
            })
            function diasuteis(resutado) {
                let diasuteis = $('#diasuteis').val()
                diasuteis = diasuteis.split(':');
                diasuteis =  parseInt(diasuteis[0]) * 3600 +  parseInt(diasuteis[1]) * 60;
                let total = '';
                if (diasuteis <  resutado) {
                    total = (parseInt(diasuteis) - parseInt(resutado)) * (-1);
                    let horas = Math.floor(total / 3600);
                    let minutos = Math.floor((total - (horas * 3600)) / 60);
                    let segundos = Math.floor(total % 60);
                    $('#hora__extra').val(`${horas}:${minutos < 10 ? '0':''}${minutos}`)
                }else{
                    $('#hora__extra').val("0:00")
                }
                
            }
        
           function sabado(resutado) {
                let sabado = $('#sabado').val()
                sabado = sabado.split(':');
                sabado =  parseInt(sabado[0]) * 3600 +  parseInt(sabado[1]) * 60;
                let total = '';
                if (sabado <  resutado) {
                    total = (parseInt(sabado) - parseInt(resutado)) * (-1);
                    let horas = Math.floor(total / 3600);
                    let minutos = Math.floor((total - (horas * 3600)) / 60);
                    let segundos = Math.floor(total % 60);
                    $('#hora__extra').val(`${horas}:${minutos < 10 ? '0':''}${minutos}`)
                }else{
                    $('#hora__extra').val("0:00")
                }
           }
           function feriados(total) {
            $.ajax({
                url: "https://brasilapi.com.br/api/feriados/v1/2021",
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                    data.forEach(element => {
                        if (element.date === '{{$data}}') {
                            domingo(total)
                        }else{
                            $('#horas__cem').val("0:00")
                        }
                    });
                    semana.forEach((element,index) => {
                        if (dias == index) {
                            if (element === 'Domingo') {
                                domingo(total)
                            }else{
                                $('#horas__cem').val("0:00")
                            }
                        }
                    })
                }
            })
        }
        function domingo(resutado) {
            let domingo = $('#domingo').val()
            domingo = domingo.split(':');
            domingo =  parseInt(domingo[0]) * 3600 +  parseInt(domingo[1]) * 60;
            let total = '';
            if (domingo <  resutado) {
                total = (parseInt(domingo) - parseInt(resutado)) * (-1);
                let horas = Math.floor(total / 3600);
                let minutos = Math.floor((total - (horas * 3600)) / 60);
                let segundos = Math.floor(total % 60);
                $('#horas__cem').val(`${horas}:${minutos < 10 ? '0':''}${minutos}`)
                $('#hora__extra').val("0:00")
            }else{
                $('#horas__cem').val("0:00")
            }
        }
        function adnotuno(segundos1,segundos2,segundos3,segundos4,total) {
            let noturnos1 = '5:00'
            let noturnos2 = '23:00'
            let noturnos3 = '00:00'
            if (segundos1 > noturno1(noturnos1)  || segundos1 <  noturno2(noturnos2)) {
                segundos1 -= 86400
                let totalHoras = (((segundos1 - segundos2) + (segundos3 - segundos4)) * (-1));
                totalgeral(segundos1,segundos2,segundos3,segundos4,totalHoras)
            }else if (segundos2 > noturno1(noturnos1) || segundos2 <  noturno2(noturnos2)) {
                segundos2 -= 86400
                let totalHoras = (((segundos1 - segundos2) + (segundos3 - segundos4)) * (-1));
                totalgeral(segundos1,segundos2,segundos3,segundos4,totalHoras)
            }else if (segundos3 > noturno1(noturnos1) || segundos3 <  noturno2(noturnos2)) {
                segundos3 -= 86400
                let totalHoras = (segundos2 - segundos1) + (segundos4 - segundos3);
                totalgeral(segundos1,segundos2,segundos3,segundos4,totalHoras)
            }else if (segundos4 > noturno1(noturnos1) || segundos4 <  noturno2(noturnos2)) {
                segundos4 -= 86400
                let totalHoras = (segundos2 - segundos1) + (segundos4 - segundos3);
                totalgeral(segundos1,segundos2,segundos3,segundos4,totalHoras)
            }

            
        }
        function noturno1(resultado) {
            let noturno1 = resultado.split(':');
            let segundos = noturno1[0] * 3600 + noturno1[1] * 60;
            return segundos;
        }
        function noturno2(resultado) {
            let noturno2 = resultado.split(':');
            let segundos = noturno2[0] * 3600 + noturno2[1] * 60;
            return segundos;
        }
        function noturno3(resultado) {
            let noturno3 = resultado.split(':');
            let segundos = ''
            if (noturno3[0] == '00') {
                segundos = noturno3[1] * 60;
            }else{
                segundos = noturno3[0] * 3600 + noturno3[1] * 60;
            }
            return segundos;
        }
        function totalgeral(segundos1,segundos2,segundos3,segundos4,total) {
            let horas = Math.floor(total / 3600);
            let minutos = Math.floor((total - (horas * 3600)) / 60);
            let segundos = Math.floor(total % 60);
            $('#total').val(`${horas}:${minutos < 10 ? '0':''}${minutos}`) 
            adnotunototal(segundos1,segundos2,segundos3,segundos4,total)
        }
        function adnotunototal(segundos1,segundos2,segundos3,segundos4,total) {
            let totalHoras = []
            let soma = 0
             if (segundos1 > 82800 || segundos1 < 18000) {
                 console.log('1')
                 totalHoras.push(segundos1);
            }
             if(segundos2 > 82800 || segundos2 < 18000){
                console.log('2')
                totalHoras.push(segundos2);
            }
             if(segundos3 > 82800 || segundos3 < 18000){
                console.log('3')
                totalHoras.push(segundos3);
            }
            if(segundos4 > 82800 || segundos4 < 18000){
                console.log('4')
                totalHoras.push(segundos4);
            }
            totalHoras.forEach(element => {
                soma += element
            });
            let horas = Math.floor(soma / 3600);
            let minutos = Math.floor((soma - (horas * 3600)) / 60);
            let segundos = Math.floor(soma % 60);
            $('#adc__noturno').val(`${horas}:${minutos < 10 ? '0':''}${minutos}`) 
        }
          </script>
@stop