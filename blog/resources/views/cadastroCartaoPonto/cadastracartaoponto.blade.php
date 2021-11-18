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
    // var semana = ["Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado"];
    // var Xmas95 = new Date('November 18, 2021 08:24:30');
    // var weekday = Xmas95.getDay();
    // semana.forEach((element,index) => {
    //     if (weekday == index) {
    //         console.log(element)
    //     }
    // });


// console.log(weekday); // 1
    $('#total').focus(function(){
        let horario1 = $('#entrada1').val();
        let horario2 =$('#saida').val();
        let horario3 = $('#entrada2').val();
        let horario4 = $('#saida2').val();
        if (horario1 && horario2 && horario3 && horario4) {
           
            let partes1 = horario1.split(':');
            let segundos1 = partes1[0] * 3600 + partes1[1] * 60;
            let partes2 = horario2.split(':');
            let segundos2 = partes2[0] * 3600 + partes2[1] * 60;
            let partes3 = horario3.split(':');
            let segundos3 = partes3[0] * 3600 + partes3[1] * 60;
            let partes4 = horario4.split(':');
            let segundos4 = partes4[0] * 3600 + partes4[1] * 60;
            let totalHoras = (segundos2 - segundos1) + (segundos4 - segundos3);
            let total = totalHoras;
            let horas = Math.floor(total / 3600);
            let minutos = Math.floor((total - (horas * 3600)) / 60);
            let segundos = Math.floor(total % 60);
            $(this).val(`${horas}:${minutos < 10 ? '0':''}${minutos}`)
            diasuteis(total)
           
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

                            // if (data.id) {
                            //     $('#form').attr('action', "{{ url('tomador')}}/"+data.tomador);
                            //     $('#formdelete').attr('action',"{{ url('tomador')}}/"+data.tomador)
                            //     $('#incluir').attr('disabled','disabled')
                            //     $('#atualizar').removeAttr( "disabled" )
                            //     $('#deletar').removeAttr( "disabled" )
                            //     $('#excluir').removeAttr( "disabled" )
                            //     $('#tabelapreco').removeClass('disabled').attr('href',"{{ url('tabelapreco')}}/"+data.tomador+"/mostrar")
                            //     $('#method').val('PUT')
                            
                            // }else{
                            //     $('#form').attr('action', "{{ route('tomador.store') }}");
                            //     $('#incluir').removeAttr( "disabled" )
                            //     $('#atualizar').attr('disabled','disabled')
                            //     $('#deletar').attr('disabled','disabled')
                            //     $('#method').val(' ')
                            //     $('#excluir').attr( "disabled",'disabled' )
                            //     $('#tabelapreco').addClass('disabled').removeAttr('href')
                            // }
                            // $('#cnpj').val(data.tscnpj)
                            // $('#matricula').val(data.tsmatricula)
                            // $('#nome__fantasia').val(data.tsfantasia)
                            // $('#simples').val(data.tssimples)
                            // $('#telefone').val(data.tstelefone)
                            // $('#cep').val(data.escep)
                            // $('#logradouro').val(data.eslogradouro)
                            // $('#numero').val(data.esnum)
                            // $('#tipo').val(data.estipo)
                            // $('#bairro').val(data.esbairro)
                            // $('#localidade').val(data.esmunicipio)
                            // $('#uf').val(data.esuf)
                            // $('#complemento').val(data.escomplemento)
                            // $('#taxa_adm').val(data.tftaxaadm.toFixed(2).toString().replace(".", ","))
                            // // $('#caixa_benef').val(data.tfbenef.toFixed(2).toString().replace(".", ","))
                            // // $('#ferias').val(data.tfferias.toFixed(2).toString().replace(".", ","))
                            // // $('#13_salario').val(data.tf13.toFixed(2).toString().replace(".", ","))
                            // $('#taxa__fed').val(data.tftaxafed.toFixed(2).toString().replace(".", ","))
                            // // $('#ferias_trab').val(data.tsferias.toFixed(2).toString().replace(".", ","))
                            // // $('#13__saltrab').val(data.tsdecimo13.toFixed(2).toString().replace(".", ","))
                            // // $('#rsr').val(data.tsrsr.toFixed(2).toString().replace(".", ","))
                            // $('#das').val(data.tfdas.toFixed(2).toString().replace(".", ","))
                            // $('#cod__fpas').val(data.psfpas)
                            // $('#cod__grps').val(data.psgrps)
                            // $('#cod__recol').val(data.psresol)
                            // $('#cnae').val(data.pscnae)
                            // $('#fap__aliquota').val(data.psfapaliquota.toFixed(2).toString().replace(".", ","))
                            // $('#rat__ajustado').val(data.psratajustados.toFixed(2).toString().replace(".", ","))
                            // $('#fpas__terceiros').val(data.psfpasterceiros)
                            // $('#aliq__terceiros').val(data.psaliquotaterceiros.toString().replace(".", ","))
                            // $('#esocial').val(data.pssocial)
                            // $('#alimentacao').val(data.isalimentacao.toFixed(2).toString().replace(".", ","))
                            // $('#transporte').val(data.istransporte.toFixed(2).toString().replace(".", ","))
                            // $('#epi').val(data.isepi.toFixed(2).toString().replace(".", ","))
                            // $('#seguro__trabalhador').val(data.isseguroportrabalhador.toString().replace(".", ","))
                            // // $('#indice__folha').val(data.isindecesobrefolha)
                            // // $('#valor__transporte').val(data.isvaletransporte.toFixed(2).toString().replace(".", ","))
                            // // $('#valor__alimentacao').val(data.isvalealimentacao.toFixed(2).toString().replace(".", ","))
                            // $('#dias_uteis').val(data.csdiasuteis)
                            // $('#sabados').val(data.cssabados)
                            // $('#domingos').val(data.csdomingos)
                            // $('#inss__empresa').val(data.rsinssempresa.toFixed(2).toString().replace(".", ","))
                            // $('#fgts__empresa').val(data.rsfgts.toFixed(2).toString().replace(".", ","))
                            // // $('#valor_fatura').val(data.rsvalorfatura.toFixed(2).toString().replace(".", ","))
                            // $('#nome__conta').val(data.bstitular)
                            // $('#banco').val(data.bsbanco)
                            // $('#agencia').val(data.bsagencia)
                            // $('#operacao').val(data.bsoperacao)
                            // $('#conta').val(data.bsconta)
                            // $('#pix').val(data.bspix)
                            // $('#folhartransporte').val(data.instransporte.toFixed(2).toString().replace(".", ","))
                            // $('#folharalim').val(data.insalimentacao.toFixed(2).toString().replace(".", ","))
                            // $('#deflator').val(data.tfdefaltor.toFixed(2).toString().replace(".", ","))
                            // $('#endereco').val(data.eiid)
                            // $('#bancario').val(data.biid)
                            // for (let index = 0; index <  $('#tipo option').length; index++) {  
                            //     if (data.tstipo == $('#tipo option').eq(index).text()) {
                                    
                            //         $('#tipo option').eq(index).attr('selected','selected')
                            //     }else  {
                            //         $('#tipo option').eq(index).removeAttr('selected')
                            //     }
                            // }
                            
                            // for (let index = 0; index <  $('#folhartipotrans option').length; index++) {  
                            //     if (data.instipotrans == $('#folhartipotrans option').eq(index).text()) {
                                    
                            //         $('#folhartipotrans option').eq(index).attr('selected','selected')
                            //     }else  {
                            //         $('#folhartipotrans option').eq(index).removeAttr('selected')
                            //     }
                            // }
                            // for (let index = 0; index <  $('#folhartipoalim option').length; index++) {  
                            //     if (data.instipoali == $('#folhartipoalim option').eq(index).text()) {
                                    
                            //         $('#folhartipoalim option').eq(index).attr('selected','selected')
                            //     }else  {
                            //         $('#folhartipoalim option').eq(index).removeAttr('selected')
                            //     }
                            // }
                            // for (let index = 0; index <  $('#retencaofgts option').length; index++) {  
                            //     if (data.rstipofgts == $('#retencaofgts option').eq(index).text()) {
                                    
                            //         $('#retencaofgts option').eq(index).attr('selected','selected')
                            //     }else  {
                            //         $('#retencaofgts option').eq(index).removeAttr('selected')
                            //     }
                            // }
                            // for (let index = 0; index <  $('#retencaoinss option').length; index++) {  
                            //     if (data.rstipoinssempresa == $('#retencaoinss option').eq(index).text()) {
                                    
                            //         $('#retencaoinss option').eq(index).attr('selected','selected')
                            //     }else  {
                            //         $('#retencaoinss option').eq(index).removeAttr('selected')
                            //     }
                            // }
                            // for (let index = 0; index <  $('#valorfatura option').length; index++) {  
                            //     if (data.rsvalorfatura == $('#valorfatura option').eq(index).text()) {
                                    
                            //         $('#valorfatura option').eq(index).attr('selected','selected')
                            //     }else  {
                            //         $('#valorfatura option').eq(index).removeAttr('selected')
                            //     }
                            // }
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
          </script>
@stop