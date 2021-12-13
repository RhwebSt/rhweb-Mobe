@extends('layouts.index')
@section('conteine')
<div class="container">
        <h1 class="container text-center mt-3 fs-4 mb-5">Boletim com Cartão Ponto</h1>
          @error('true')
            <div class="alert alert-success"  role="alert">
                {{$message}}
            </div>
        @enderror
        @error('false')
            <div class="alert alert-danger"  role="alert">
                {{$message}}
            </div>
        @enderror
        <form class="row g-3 mt-1 mb-5" id="form" method="POST" action="{{route('boletimcartaoponto.store')}}">
        @csrf
        <input type="hidden" id="method" name="_method" value="">
        <input type="hidden" name="domingo" id="domingo" value="{{$domingo}}">
        <input type="hidden" name="sabado" id="sabado" value="{{$sabado}}">
        <input type="hidden" name="diasuteis" id="diasuteis" value="{{$diasuteis}}">
        <input type="hidden" name="data" value="{{$data}}">
        <input type="hidden" name="tomador" value="{{$tomador}}">
        <div class="row">
                  <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
       
                        <button type="submit" id="incluir" class="btn botao">Incluir</button>
                        <button type="submit" id="atualizar" disabled class="btn botao">Editar</button>
                        <button class="btn botao dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Relatório
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{route('cadastrocartaoponto.relatoriocartaoponto',[$boletim,$tomador])}}">Boletim Cartão ponto</a></li>
                      </ul>
                        
                        
                        <button type="button" class="btn botao  " disabled id="excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          Excluir
                      </button>
                    <a class="btn botao" href="{{route('cadastrocartaoponto.index')}}" role="button">Sair</a>
                  </div>
              </div>
            <input type="hidden" name="lancamento" id="lancamento" value="{{$id}}"> 
            <input type="hidden" name="trabalhador" id="trabalhador">
            <input type="hidden" name="boletim" value="{{$boletim}}">
           
            
            
            <div class="col-md-10 mt-5 input">
                <label for="nome__completo" class="form-label">Nome Trabalhador</label>
                <input class="pesquisa form-control text-dark fw-bold @error('nome__completo') is-invalid @enderror" list="datalistOptions" name="nome__completo" id="nome__completo">
                <datalist id="datalistOptions">
                   
                </datalist>
                 @error('nome__completo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('trabalhador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            
            <div class="col-md-2 input mt-5">
                <label for="matricula" class="form-label">Matrícula</label>
                <input type="text" class="form-control text-dark fw-bold @error('matricula') is-invalid @enderror" name="matricula" value="" id="matricula">
                @error('matricula')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- <div class="col-md-2 input">
                <label for="data" class="form-label">Data</label>
                <input type="date" class="form-control " name="data" value="" id="data">
            </div> -->
            
            <h1 class="text-center fs-5 fw-bold">Diurno</h1>
            
            <div class="col-md-3 input">
                <label for="entrada1" class="form-label">Entrada</label>
                <input type="time" class="form-control diaurno horas  @error('entrada1') is-invalid @enderror" name="entrada1" value="" id="entrada1">
                <small style="font-size: 13px;">De (05:00 ás 12:00)</small>
                @error('entrada1')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 input">
                <label for="saida1" class="form-label">Saída</label>
                <input type="time" class="form-control horas diaurno @error('saida') is-invalid @enderror" name="saida" value="" id="saida">
                <small style="font-size: 13px;">De (05:00 ás 15:00)</small>
                @error('saida')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 input">
                <label for="entrada2" class="form-label">Entrada</label>
                <input type="time" class="form-control horas diaurno @error('entrada2') is-invalid @enderror" name="entrada2" value="" id="entrada2">
                <small style="font-size: 13px;">De (12:00 ás 22:00)</small>
                @error('entrada2')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 input">
                <label for="saida2" class="form-label">Saída</label>
                <input type="time" class="form-control horas diaurno @error('saida2') is-invalid @enderror" name="saida2" value="" id="saida2">
                <small style="font-size: 13px;">De (12:00 ás 22:00)</small>
                @error('saida2')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <h1 class="text-center fs-5 fw-bold">Noturno</h1>
            
            <div class="col-md-3 input">
                <label for="entrada3" class="form-label">Entrada (adc.noturno)</label>
                <input type="time" class="form-control horas adc__noturno @error('entrada3') is-invalid @enderror" name="entrada3" value="" id="entrada3">
                <small style="font-size: 13px;">De (22:00 ás 03:00)</small>
                @error('entrada3')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 input">
                <label for="saida3" class="form-label">Saída (adc.noturno)</label>
                <input type="time" class="form-control horas adc__noturno  @error('saida3') is-invalid @enderror" name="saida3" value="" id="saida3">
                <small style="font-size: 13px;">De (03:00 ás 05:00)</small>
                @error('saida3')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="col-md-3 input">
                <label for="entrada4" class="form-label">Entrada (adc.noturno)</label>
                <input type="time" class="form-control horas adc__noturno @error('entrada4') is-invalid @enderror" name="entrada4" value="" id="entrada4">
                <small style="font-size: 13px;">De (00:00 ás 05:00)</small>
                @error('entrada4')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 input">
                <label for="saida5" class="form-label">Saída (adc.noturno)</label>
                <input type="time" class="form-control horas adc__noturno @error('saida4') is-invalid @enderror" name="saida4" value="" id="saida4">
                <small style="font-size: 13px;">De (00:00 ás 05:00)</small>
                @error('saida4')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 input">
                <label for="horas_normais" class="form-label">Horas Normais </label>
                <input type="text" class="form-control" name="horas_normais" value="" id="horas_normais">
            </div>

            <div class="col-md-2 input">
                <label for="hora__extra" class="form-label">HRS 50%</label>
                <input type="text" class="form-control " name="hora__extra" value="" id="hora__extra">
            </div>

            <div class="col-md-2 input">
                <label for="horas__cem" class="form-label">HRS 100%</label>
                <input type="text" class="form-control " name="horas__cem" value="" id="horas__cem">
            </div>

            <div class="col-md-2 input">
                <label for="adc__noturno" class="form-label">ADC.NOT</label>
                <input type="text" class="form-control " name="adc__noturno" value="" id="adc__noturno">
            </div>
            <div class="col-md-3 input">
                <label for="total" class="form-label">Total</label>
                <input type="text" class="form-control @error('total') is-invalid @enderror" name="total" value="" id="total">
                @error('total')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </form>
        
        
        <ul class="nav nav-pills " id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation" style="background-color: #9098A2; border-radius:3px;">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" style="color: white;"><i class="fad fa-sun fa-lg"></i> Diurno</button>
          </li>
          <li class="nav-item ms-1" role="presentation" style="background-color: #9098A2; border-radius:3px;">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" style="color: white;"><i class="fad fa-moon fa-lg"></i> Noturno</button>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              
             <div class="table-responsive-lg">
                  <table class="table border-bottom text-white mt-3 mb-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                <thead>
                    <th class="col text-center border-start border-top text-nowrap" style="width:80px;">Matricula</th>
                    <th class="col text-center border-top text-nowrap capitalize" style="width:420px">Nome</th>
                    <th class="col text-center border-top text-nowrap" style="width:90px;">Entrada</th>
                    <th class="col text-center border-top text-nowrap" style="width:90px;">Saída</th>
                    <th class="col text-center border-top text-nowrap" style="width:90px;">Entrada</th>
                    <th class="col text-center border-top text-nowrap" style="width:90px;">Saída</th>
                    <th class="col text-center border-top text-nowrap" style="width:90px;">HRS 50%</th>
                    <th class="col text-center border-top text-nowrap" style="width:90px;">HRS 100%</th>
                    <th class="col text-center border-top text-nowrap" style="width:140px;">Horas Normais</th>
                    <th class="col text-center border-end border-top text-nowrap" style="width:140px;">Total Geral</th>
                </thead>
                <tbody style="background-color: #081049; color: white;">
                @if(count($lista) > 0)
                    @foreach($lista as $listas)
                    @if($listas->bsentradamanhao && $listas->bssaidamanhao || 
                    $listas->bsentradatarde && $listas->bssaidatarde)
                    <tr>
                    <td class="col text-center border-bottom border-start text-nowrap" style="width:80px;">{{$listas->tsmatricula}}</td>
                    <td class="col text-center border-bottom text-nowrap capitalize" style="width:420px">{{$listas->tsnome}}</td>
                    <td class="col text-center border-bottom text-nowrap" style="width:90px;">{{$listas->bsentradamanhao}}</td>
                    <td class="col text-center border-bottom text-nowrap" style="width:90px;">{{$listas->bssaidamanhao}}</td>
                    <td class="col text-center border-bottom text-nowrap" style="width:90px;">{{$listas->bsentradatarde}}</td>
                    <td class="col text-center border-bottom text-nowrap" style="width:90px;">{{$listas->bssaidatarde}}</td>
                    <td class="col text-center border-bottom text-nowrap" style="width:90px;">{{$listas->bshoraex}}</td>
                    <td class="col text-center border-bottom text-nowrap" style="width:90px;">{{$listas->bshoraexcem}}</td>
                    <td class="col text-center border-bottom text-nowrap" style="width:140px;">{{$listas->horas_normais}}</td>
                    <td class="col text-center border-bottom border-end text-nowrap" style="width:140px;">{{$listas->bstotal}}</td>
                   
                    </tr>
                   @endif
                    @endforeach
                    @else
                        <tr>
                            <td class="text-center border-end border-start text-nowrap" colspan="11" style="background-color: #081049; color: white;">
                                <div class="alert" role="alert" style="background-color: #CC2836;">
                                    Não a registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></i>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
                
                <tfoot>
                    <tr class=" border-end border-start border-bottom">
                        <td colspan="11">
                        {{ $lista->links() }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
              
              
              
              
          </div>
          
  
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

              <table class="table border-bottom text-white mt-3 mb-5 table-responsive" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
            <thead>
                <th class="col text-center border-start border-top" style="width:80px;">Matricula</th>
                <th class="col text-center border-top" style="width:330px">Nome</th>
                <th class="col text-center border-top" style="width:90px;">Entrada</th>
                <th class="col text-center border-top" style="width:90px;">Saída</th>
                <th class="col text-center border-top" style="width:90px;">Entrada</th>
                <th class="col text-center border-top" style="width:90px;">Saída</th>
                <th class="col text-center border-top" style="width:90px;">HRS 50%</th>
                <th class="col text-center border-top" style="width:90px;">HRS 100%</th>
                <th class="col text-center border-top" style="width:90px;">AD.NOT</th>
                <th class="col text-center border-end border-top" style="width:140px;">Total Geral</th>
            </thead>
            <tbody style="background-color: #081049; color: white;">
            @if(count($lista) > 0)
                @foreach($lista as $listas)
                @if($listas->bsentradanoite && $listas->bsentradanoite ||
                $listas->bsentradamadrugada && $listas->bssaidamadrugada)
                <tr>
                <td class="col text-center border-bottom border-start" style="width:80px;">{{$listas->tsmatricula}}</td>
                <td class="col text-center border-bottom" style="width:330px">{{$listas->tsnome}}</td>
                <td class="col text-center border-bottom" style="width:90px;">{{$listas->bsentradanoite}}</td>
                <td class="col text-center border-bottom" style="width:90px;">{{$listas->bssaidanoite}}</td>
                <td class="col text-center border-bottom" style="width:90px;">{{$listas->bsentradamadrugada}}</td>
                <td class="col text-center border-bottom" style="width:90px;">{{$listas->bssaidamadrugada}}</td>
                <td class="col text-center border-bottom" style="width:90px;">{{$listas->bshoraex}}</td>
                <td class="col text-center border-bottom" style="width:90px;">{{$listas->bshoraexcem}}</td>
                <td class="col text-center border-bottom" style="width:90px;">{{$listas->bsadinortuno}}</td>
                <td class="col text-center border-end border-bottom" style="width:140px;">{{$listas->bstotal}}</td>
                </tr>
               @endif
                @endforeach
                @else
                    <tr>
                        <td class="text-center border-end border-start text-nowrap" colspan="11" style="background-color: #081049; color: white;">
                            <div class="alert" role="alert" style="background-color: #CC2836;">
                                Não a registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></i>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
            
            <tfoot>
                <tr class=" border-end border-start border-bottom">
                    <td colspan="11">
                    {{ $lista->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
              
              
          </div>
        </div>
        
        
        
        
        
        
        
        
        
       
          
        
        

        

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
var semana = ["Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado"];
var data = new Date('{{$data}} 08:24:30');
var dias = data.getDay();
 var diurno = []
$('.horas').keyup(function() {
    // var diurno = ['entrada1','saida','entrada2','saida2','entrada3','saida3','entrada4','saida4'];
   
    // index(diurno);
    var input = $(this).attr('name');
    let segundo = '';
    if (diurno.indexOf(input) == -1 && $(this).val().length > 3) {
        diurno.push(input);
        if (diurno.length >= 1) {
            index(diurno);
        }
    }else if(diurno.indexOf(input) != -1 && $(this).val().length > 3){
        if (diurno.length >= 1) {
            index(diurno);
        }
    }else if (diurno.indexOf(input) != -1 && $(this).val().length == 0) {
        
        diurno.splice(diurno.indexOf(input), 1);
        index(diurno);
    }
   
});

function index(diurno) {
    var manhao = 0;
    var tarde = 0;
    var totaldiurno = 0
    var noite = 0;
    var madrugada = 0
    var totalnoturno = 0
    let segundo = 0;
    let result = 0;
    diurno.forEach(element => {
        if ($(`input[name='${element}']`).val()) {
            segundo = segundos($(`input[name='${element}']`).val());
        }
        if (element === 'entrada1' || element === 'saida') {
            if (manhao < 1) {
                manhao = segundo;
            }else{
                manhao = segundo - manhao 
            }
            console.log(segundo);
        }else if(element === 'entrada2' || element === 'saida2'){
            if (tarde < 1) {
                tarde = segundo;
            }else{
                if (segundo > tarde) {
                    tarde = segundo - tarde 
                }else{
                    tarde =  tarde - segundo
                }
            }
            
        }else if(element === 'entrada3' || element === 'saida3'){
            if (noite < 1) {
                noite = segundo
            }else{
                console.log(noite,segundo,'ok');
                if (noite >= 79200 && noite < 86400 && segundo >= 79200 &&  segundo < 86400) {
                    noite = (86400 - noite) - (86400 - segundo);
                    console.log(noite,segundo);
                }else if (noite >= 79200 && segundo >= 0 && segundo <= 18000) {
                    noite = (86400 - noite) + segundo
                    console.log(noite,segundo);
                }else if (noite >= 0 &&  segundo <= 18000) {
                    noite = segundo - noite
                    console.log(noite,segundo);
                }
                
            }
           
        }else if(element === 'entrada4' || element === 'saida4'){
            if (madrugada < 1) {
                madrugada = segundo
            }else{
                if (madrugada >= 79200 && madrugada < 86400 && segundo >= 79200 &&  segundo < 86400) {
                    madrugada = (86400 - madrugada) - (86400 - segundo);
                    console.log(madrugada,segundo);
                }else{
                    if (segundo > madrugada ) {
                        madrugada = segundo - madrugada;
                    }else{
                        madrugada = madrugada - segundo;
                    }
                    console.log(madrugada,segundo);
                   
                }
            }
           
        }
    });
    if (diurno.indexOf('entrada1') != -1 && 
    diurno.indexOf('saida') != -1 && 
    diurno.length === 2 || diurno.indexOf('entrada1') != -1 && 
    diurno.indexOf('saida') != -1 && 
    diurno.length === 4) {
        totaldiurno = manhao + tarde 
        $('#horas_normais').val(horas(totaldiurno))
        horaextra()
    }else if (diurno.indexOf('entrada2') != -1 && 
    diurno.indexOf('saida2') != -1 && 
    diurno.length === 2 || diurno.indexOf('entrada2') != -1 && 
    diurno.indexOf('saida2') != -1 && 
    diurno.length === 4) {
        totaldiurno = manhao + tarde
        $('#horas_normais').val(horas(totaldiurno))
        horaextra()
    }else if (diurno.indexOf('entrada1') != -1 && 
    diurno.indexOf('saida2') != -1 && 
    diurno.length === 2 ) {
        totaldiurno = tarde - manhao
        $('#horas_normais').val(horas(totaldiurno))
        horaextra()
    }else{
        $('#horas_normais').val('00:00')
        horaextra()
    }
    if (diurno.indexOf('entrada3') != -1 &&  diurno.indexOf('saida4') != -1 && diurno.length === 2) {
        totalnoturno = (86400 - noite) +  madrugada
        adnoturno(totalnoturno)
    }else if(diurno.indexOf('entrada3') != -1 &&  diurno.indexOf('saida3') != -1 && diurno.length === 2){
        totalnoturno =  noite +  madrugada
        adnoturno(totalnoturno)
    }else if(diurno.indexOf('entrada4') != -1 &&  diurno.indexOf('saida4') != -1 && diurno.length === 2){
        totalnoturno =  noite +  madrugada
        adnoturno(totalnoturno)
    }else if (diurno.indexOf('entrada3') != -1 &&  diurno.indexOf('saida3') != -1 && diurno.indexOf('entrada4') != -1 && diurno.indexOf('saida4') != -1 && diurno.length === 4){
        totalnoturno =  noite +  madrugada
        adnoturno(totalnoturno)
    }else if (diurno.indexOf('entrada3') != -1 && 
    diurno.indexOf('saida3') != -1 && diurno.length === 4 || diurno.indexOf('entrada4') != -1 && 
    diurno.indexOf('saida4') != -1 && diurno.length === 4) {
        totalnoturno =  noite +  madrugada
        adnoturno(totalnoturno)
    }else{
        $('#adc__noturno').val('00:00')
    }
    
    totalgeral()
    
    // totalnoturno = noite +  madrugada
    // if ( totaldiurno && totalnoturno) {
    //     result = totaldiurno + totalnoturno
    //     adnoturno(totalnoturno,result)
    // }
    
    // adnoturno(totalnoturno,result)
    // totalgeral(result,'')
}
function segundos(segundos) {
    let tempos = segundos.split(':');
    let calc = parseInt(tempos[0])*3600+parseInt(tempos[1])*60
    return calc;
}
function horas(valor) {
    let horas = Math.floor(valor / 3600);
    let minutos = Math.floor((valor - (horas * 3600)) / 60);
    let segundos = Math.floor(valor % 60);
    return `${horas}:${minutos < 10 ? '0':''}${minutos}`
}
function adnoturno(noturno) {
    let acresimo = (noturno/3150)
    $('#adc__noturno').val(horasnotunas(acresimo.toString()))
}
function horasnotunas(acresimo) {
    let novoacresimo = acresimo.split('.')
    let novoacresimo1 = 0
    if (novoacresimo.length > 1) {
        novoacresimo1 = `0.${novoacresimo[1]}`
    }
    novoacresimo1 = novoacresimo1 * 0.6
    novoacresimo1 = novoacresimo1.toFixed(2)
    novoacresimo1 = (novoacresimo1 * 1) + parseInt(novoacresimo[0])
    novoacresimo1 =  novoacresimo1.toString()
    let novoacresimo2 = novoacresimo1.split('.')
    if (novoacresimo2.length > 1) {
        novoacresimo2 = `${novoacresimo2[0]}:${novoacresimo2[1]}`
    }else{
        novoacresimo2 = `${novoacresimo2[0]}:00`
    }
     return `${novoacresimo2[0]}` != "NaN" ? novoacresimo2:'00:00'
}
function totalgeral() {
    let horas_normais = segundos($('#horas_normais').val());
    let horas_extra =  segundos($('#hora__extra').val());
    let noturno = segundos($('#adc__noturno').val());
    let total = 0
    if (horas_normais > 0) {
        total += horas_normais
    }
    if (horas_extra > 0) {
        total += horas_extra
    }
    if (noturno > 0) {
        total += noturno
    }
    $('#total').val(horas(total))
    // let novototal = horas(total)
    // if (acresimo) {
    //     novototal = novototal.split(':')
    //     $('#total').val(`${novototal[0]}:${acresimo}`)
    // }else{
    //     $('#total').val(`${novototal}`)
    // }
}
function horaextra() {
    semana.forEach((element,index) => {
        if (dias == index) {
            if (element === 'Sábado') {
                sabado()
            }else{
                diasuteis()
            }
        }
    })
}
function sabado() {
    let total = $('#horas_normais').val();
    let sabado = $('#sabado').val()
    let result = '';
    if (segundos(sabado) <  segundos(total)) {
        result = (parseInt(segundos(sabado)) - parseInt(segundos(total))) * (-1);
        $('#hora__extra').val(conversaohoras(result))
    }else{
        $('#hora__extra').val("0:00")
    }
}
function diasuteis() {
    let total = $('#horas_normais').val();
    let diasuteis = $('#diasuteis').val()
    let result = '';
    if (segundos(diasuteis) < segundos(total)) {
        result = (parseInt(segundos(diasuteis)) - parseInt(segundos(total))) * (-1);
        $('#hora__extra').val(horas(result))
    }else{
        $('#hora__extra').val("0:00")
        
    }
    
}
function feriados() {
    let total = $('#total').val();
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
    let total = '';
    if (segundos(domingo) <  segundos(resutado)) {
        total = (parseInt(segundos(domingo)) - parseInt(segundos(resutado))) * (-1);
        $('#horas__cem').val(horas(total))
        $('#hora__extra').val("0:00")
    }else{
        $('#horas__cem').val("0:00")
    }
}
    // $.ajax({
    //     url: "{{route('listatabelapreco.lista',$tomador)}}",
    //     type: 'get',
    //     contentType: 'application/json',
    //     success: function(data) {
    //         console.log(data)
    //         // $('#rubrica').removeClass('is-invalid')
    //         // $('#rublicamensagem').text(' ')
    //         // let nome = ''
    //         // let codigo = ''
    //         // if (data.length > 1) {
    //         //     data.forEach(element => {
    //         //     nome += `<option value="${element.tsdescricao}">`
    //         //     });
    //         //     data.forEach(element => {
    //         //     codigo += `<option value="${element.tsdescricao}">`
    //         //     });
    //         //     if( tagname == 'codigo'){
    //         //         $('#rubrica').val(' ')
    //         //     }else if(tagname == 'rubrica'){
    //         //         $('#codigo').val(' ')
    //         //     }
    //         //     $('#rublicas').html(nome)
    //         //     $('#codigos').html(codigo)
    //         // }else if(data.length === 1){
    //         //     if( tagname == 'codigo'){
    //         //         $('#rubrica').val(data[0].tsdescricao)
    //         //     }else if( tagname == 'rubrica'){
    //         //         $('#codigo').val(data[0].tsrubrica)
    //         //     }
    //         //     $('#valor').val(data[0].tsvalor)
    //         //     $('#lftomador').val(data[0].tstomvalor)
    //         // }else{
    //         //     $('#rubrica').addClass('is-invalid')
    //         //     $('#rublicamensagem').text('Esta rublica não esta cadastra.')
    //         // }
    //     }
    // });
            $( "#nome__completo" ).keyup(function() {
                var dados = $( "#nome__completo" ).val();
                $.ajax({
                    url: "{{url('trabalhador/pesquisa')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                      let nome = ''
                      if (data.length >= 1) {
                        data.forEach(element => {
                          nome += `<option value="${element.tsnome}">`
                          nome += `<option value="${element.tsmatricula}">`
                          nome += `<option value="${element.tscpf}">`
                        });
                        $('#datalistOptions').html(nome)
                        
                      }
                      if(data.length === 1 && dados.length > 4){
                        // data.forEach(element => {
                        //   nome += `<option value="${element.tsnome}">`
                        //   nome += `<option value="${element.tsmatricula}">`
                        //   nome += `<option value="${element.tscpf}">`
                        // });
                        // $('#datalistOptions').html(nome)
                        $('#trabalhador').val(data[0].id)
                        $('#matricula').val(data[0].tsmatricula)
                        boletim(dados)
                      }              
                    }
                });
            });
            function boletim(dados) {
                $.ajax({
                    url: `{{url('boletimcartaoponto')}}/${dados}/${$('#lancamento').val()}`,
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
                        $('#entrada3').val(data.bsentradanoite)
                        $('#saida3').val(data.bssaidanoite)
                        $('#entrada4').val(data.bsentradamadrugada)
                        $('#saida4').val(data.bssaidamadrugada)
                        $('#horas_normais').val(data.horas_normais)
                        $('#total').val(data.bstotal)
                        $('#hora__extra').val(data.bshoraex)
                        $('#horas__cem').val(data.bshoraexcem)
                        $('#adc__noturno').val(data.bsadinortuno)
                        }
                    }
                });
            }
           
    
        //     var semana = ["Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado"];
        //     var data = new Date('{{$data}} 08:24:30');
        //     var dias = data.getDay();
           
        //     $('.adc__noturno').change(function () {
        //         let segundos1 = 0
        //         let segundos2 = 0
        //         let segundos3 = 0
        //         let segundos4 = 0
        //         let primeiro = 0
        //         let segundo = 0
        //         let total = 0
        //         let horario1 = $('#entrada3').val();
        //         let horario2 =$('#saida3').val();
        //         let horario3 = $('#entrada4').val();
        //         let horario4 = $('#saida4').val();
        //         let horasnormais =  $('#horas_normais').val()
        //         if ( horasnormais) {
        //             horasnormais = segundos(horasnormais);
        //         }
        //         if (horario1) {
        //            segundos1 = segundos(horario1);
        //         }
        //         if (horario2) {
        //             segundos2 =  segundos(horario2);
        //         }
        //         if (horario3) {
        //             segundos3 = segundos(horario3);
        //         }
        //         if (horario4) {
        //             segundos4 = segundos(horario4);
        //         }
               
        //         if (segundos1 >= 79200 && segundos2 < 10800) {
        //             primeiro = (86400 - segundos1) + segundos2;
        //             segundo = segundos4 - segundos3;
        //             total = (primeiro + segundo)
        //             let acresimo = (total/3150)
        //             total += horasnormais
        //             acresimo = horasnotunas(acresimo.toString(),total)
        //              $('#adc__noturno').val(acresimo)
        //             console.log('1')
        //              diasuteis($('#total').val())
        //              feriados($('#total').val())
        //         }else if (segundos1 >= 79200 && segundos2 >= 79200 && segundos4 <= 18000) {
        //             primeiro = segundos2 - segundos1;
        //             segundo = segundos4 - segundos3;
        //             total = primeiro + segundo
        //             console.log(total)
        //             let acresimo = (total/3150)
        //             total += horasnormais
        //             acresimo = horasnotunas(acresimo.toString(),total)
        //              $('#adc__noturno').val(acresimo)
        //              console.log('2')
        //             diasuteis($('#total').val())
        //             feriados($('#total').val())
        //         }else if (segundos3 > 0 && segundos4 <= 18000) {
        //             primeiro = segundos2 - segundos1;
        //             segundo = segundos4 - segundos3;
        //             total = primeiro + segundo
        //             let acresimo = (total/3150)
        //             total += horasnormais
        //             acresimo = horasnotunas(acresimo.toString(),total)
        //              $('#adc__noturno').val(acresimo)
        //              console.log('3')
        //              diasuteis($('#total').val())
        //              feriados($('#total').val())
               
        //         }
        //         else{
        //              $('#adc__noturno').val('0:00')
        //         }
        //     })
        //     $('.diaurno').change(function(){
        //         let horario1 = $('#entrada1').val();
        //         let horario2 =$('#saida').val();
        //         let horario3 = $('#entrada2').val();
        //         let horario4 = $('#saida2').val();
        //         let adnotuno = 0
        //         let segundos1 = 0
        //         let segundos2 = 0
        //         let segundos3 = 0
        //         let segundos4 = 0
        //         let horaextra = 0
        //         let totalHoras = 0
        //         if ($('#adc__noturno').val()) {
        //             adnotuno = $('#adc__noturno').val()
        //             adnotuno = segundos(adnotuno);
        //         }
        //         if (horario1) {
        //            segundos1 = segundos(horario1);
        //         }
        //         if (horario2) {
        //             segundos2 =  segundos(horario2);
        //         }
        //         if (horario3) {
        //             segundos3 = segundos(horario3);
        //         }
        //         if (horario4) {
        //             segundos4 = segundos(horario4);
        //         }
        //         if (segundos1 >= 18000 && segundos2 <= 54000) {
        //             totalHoras = (segundos2 - segundos1) + (segundos4 - segundos3);
        //             $('#horas_normais').val(conversaohoras(totalHoras))
        //             totalHoras += adnotuno 
        //             $('#total').val(conversaohoras(totalHoras))
        //             feriados($('#total').val())
        //             semana.forEach((element,index) => {
        //                 if (dias == index) {
        //                     if (element === 'Sábado') {
        //                         sabado($('#total').val())
        //                     }else{
        //                         diasuteis($('#total').val())
        //                     }
        //                 }
        //             })
                   
        //         }else if(segundos4 <= 79200 && segundos3 > 43200){
        //             totalHoras = (segundos2 - segundos1) + (segundos4 - segundos3);
        //             feriados($('#total').val())
        //             $('#horas_normais').val(conversaohoras(totalHoras))
        //             totalHoras += adnotuno 
        //             $('#total').val(conversaohoras(totalHoras))
        //             semana.forEach((element,index) => {
        //                 if (dias == index) {
        //                     if (element === 'Sábado') {
        //                         sabado($('#total').val())
        //                     }else{
        //                         diasuteis($('#total').val())
        //                     }
        //                 }
        //             })
        //         }
                
        //     })
        //     function conversaohoras(valor) {
        //         let horas = Math.floor(valor / 3600);
        //         let minutos = Math.floor((valor - (horas * 3600)) / 60);
        //         let segundos = Math.floor(valor % 60);
        //         return `${horas}:${minutos < 10 ? '0':''}${minutos}`
        //     }
        //     function segundos(valor) {
        //         let partes1 = valor.split(':');
        //         let segundos = partes1[0] * 3600 + partes1[1] * 60;
        //         return segundos;
        //     }
        //     function horasnotunas(acresimo,total) {
        //         let novoacresimo = acresimo.split('.')
        //         let novoacresimo1 = `0.${novoacresimo[1]}`
        //         novoacresimo1 = novoacresimo1 * 0.6
        //         novoacresimo1 = novoacresimo1.toFixed(2)
        //         novoacresimo1 = (novoacresimo1 * 1) + parseInt(novoacresimo[0])
        //         novoacresimo1 =  novoacresimo1.toString()
        //         let novoacresimo2 = novoacresimo1.split('.')
        //         let novototal = conversaohoras(total)
        //         novototal = novototal.split(':')
        //         $('#total').val(`${novototal[0]}:${novoacresimo2[1]}`)
        //         return `${novoacresimo2[0]}:${novoacresimo2[1]}`
        //     }
        //     function diasuteis(resutado) {
        //         let diasuteis = $('#diasuteis').val()
        //         let total = '';
        //         if (segundos(diasuteis) < segundos(resutado)) {
        //             total = (parseInt(segundos(diasuteis)) - parseInt(segundos(resutado))) * (-1);
        //             $('#hora__extra').val(conversaohoras(total))
        //         }else{
        //             $('#hora__extra').val("0:00")
                    
        //         }
                
        //     }
        
        //    function sabado(resutado) {
        //         let sabado = $('#sabado').val()
        //         let total = '';
        //         if (segundos(sabado) <  segundos(resutado)) {
        //             total = (parseInt(segundos(sabado)) - parseInt(segundos(resutado))) * (-1);
        //             $('#hora__extra').val(conversaohoras(total))
        //         }else{
        //             $('#hora__extra').val("0:00")
        //             console.log('2')
        //         }
        //    }
        //    function feriados(total) {
        //     $.ajax({
        //         url: "https://brasilapi.com.br/api/feriados/v1/2021",
        //         type: 'get',
        //         contentType: 'application/json',
        //         success: function(data) {
        //             data.forEach(element => {
        //                 if (element.date === '{{$data}}') {
        //                     domingo(total)
        //                 }else{
        //                     $('#horas__cem').val("0:00")
        //                 }
        //             });
        //             semana.forEach((element,index) => {
        //                 if (dias == index) {
        //                     if (element === 'Domingo') {
        //                         domingo(total)
        //                     }else{
        //                         $('#horas__cem').val("0:00")
        //                     }
        //                 }
        //             })
        //         }
        //     })
        // }
        // function domingo(resutado) {
        //     let domingo = $('#domingo').val()
        //     let total = '';
        //     if (segundos(domingo) <  segundos(resutado)) {
        //         total = (parseInt(segundos(domingo)) - parseInt(segundos(resutado))) * (-1);
        //         $('#horas__cem').val(conversaohoras(total))
        //         $('#hora__extra').val("0:00")
        //     }else{
        //         $('#horas__cem').val("0:00")
        //     }
        // }
          </script>
@stop