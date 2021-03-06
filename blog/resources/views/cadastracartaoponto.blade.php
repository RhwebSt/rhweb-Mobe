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
                  title: 'Cadastrado.'
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
        <form class="row g-3 mt-1 mb-5" id="form" method="POST" action="{{route('boletimcartaoponto.store')}}">
            
            <h1 class="container text-center mt-3 fs-4 mb-5">Boletim com Cartão Ponto</h1>
        @csrf
        <input type="hidden" id="method" name="_method" value="">
        <input type="hidden" name="domingo" id="domingo" value="{{$domingo}}">
        <input type="hidden" name="sabado" id="sabado" value="{{$sabado}}">
        <input type="hidden" name="diasuteis" id="diasuteis" value="{{$diasuteis}}">
        <input type="hidden" name="data" value="{{$data}}">
        <input type="hidden" name="tomador" value="{{$tomador}}">
        <input type="hidden" name="feriado" value="{{$feriado}}">
        <div class="row">
                  <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
       
                        <button type="submit" id="incluir" class="btn botao">Incluir</button>
                        <button type="submit" id="atualizar" disabled class="btn botao">Editar</button>
                        <button class="btn botao dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fad fa-file-invoice"></i> Relatório
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{route('cadastrocartaoponto.relatoriocartaoponto',[$id,$domingo,$sabado,$diasuteis,$data,$boletim,$tomador])}}">Boletim Cartão ponto</a></li>
                      </ul>
                        
                        
                        <button type="button" class="btn botao  " disabled id="excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          Excluir
                      </button>
                    <a class="btn botao" href="{{route('cadastrocartaoponto.index')}}" role="button">Sair</a>
                  </div>
              </div>
            <input type="hidden" name="lancamento" id="lancamento" value="{{$id}}"> 
            <input type="hidden" name="trabalhador" value="{{old('matricula')}}" id="trabalhador">
            <input type="hidden" name="boletim" value="{{$boletim}}">
           
            
            
            <div class="col-md-10 mt-5 input">
                <label for="nome__completo" class="form-label">Nome Trabalhador</label>
                <input class="pesquisa form-control text-dark fw-bold @error('nome__completo') is-invalid @enderror" list="datalistOptions" value="{{old('nome__completo')}}" name="nome__completo" id="nome__completo">
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
                <input type="text" class="form-control text-dark fw-bold @error('matricula') is-invalid @enderror" name="matricula" value="{{old('matricula')}}" value="" id="matricula">
                @error('matricula')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- <div class="col-md-2 input">
                <label for="data" class="form-label">Data</label>
                <input type="date" class="form-control " name="data" value="" id="data">
            </div> -->
            
            <h1 class="text-center fs-5 fw-bold">Diurno <i class="fad fa-sun fa-lg"></i></h1>
            
            <div class="col-md-3 input">
                <label for="entrada1" class="form-label">Entrada</label>
                <input type="time" class="form-control diaurno fw-bold   @error('entrada1') is-invalid @enderror" name="entrada1" value="{{old('entrada1')}}" id="entrada1">
                <small style="font-size: 13px;">De (05:00 ás 12:00)</small>
                @error('entrada1')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 input">
                <label for="saida1" class="form-label">Saída</label>
                <input type="time" class="form-control horas diaurno fw-bold @error('saida') is-invalid @enderror" name="saida" value="{{old('saida')}}" id="saida">
                <small style="font-size: 13px;">De (05:00 ás 15:00)</small>
                @error('saida')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 input">
                <label for="entrada2" class="form-label">Entrada</label>
                <input type="time" class="form-control horas fw-bold diaurno @error('entrada2') is-invalid @enderror" name="entrada2" value="{{old('entrada2')}}" id="entrada2">
                <small style="font-size: 13px;">De (12:00 ás 22:00)</small>
                @error('entrada2')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 input">
                <label for="saida2" class="form-label">Saída</label>
                <input type="time" class="form-control fw-bold horas diaurno @error('saida2') is-invalid @enderror" name="saida2" value="{{old('saida2')}}" id="saida2">
                <small style="font-size: 13px;">De (12:00 ás 22:00)</small>
                @error('saida2')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <h1 class="text-center fs-5 fw-bold">Noturno <i class="fad fa-moon fa-md"></i></h1>
            
            <div class="col-md-3 input">
                <label for="entrada3" class="form-label">Entrada(adc.noturno)</label>
                <input type="time" class="form-control fw-bold  adc__noturno @error('entrada3') is-invalid @enderror" name="entrada3" value="{{old('entrada3')}}" id="entrada3">
                <small style="font-size: 13px;">De (22:00 ás 03:00)</small>
                @error('entrada3')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 input">
                <label for="saida3" class="form-label">Saída(adc.noturno)</label>
                <input type="time" class="form-control fw-bold  adc__noturno horas  @error('saida3') is-invalid @enderror" name="saida3" value="{{old('saida3')}}" id="saida3">
                <small style="font-size: 13px;">De (03:00 ás 05:00)</small>
                @error('saida3')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="col-md-3 input">
                <label for="entrada4" class="form-label">Entrada(adc.noturno)</label>
                <input type="time" class="form-control horas fw-bold adc__noturno @error('entrada4') is-invalid @enderror" name="entrada4" value="{{old('entrada4')}}" id="entrada4">
                <small style="font-size: 13px;">De (00:00 ás 05:00)</small>
                @error('entrada4')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 input">
                <label for="saida5" class="form-label">Saída(adc.noturno)</label>
                <input type="time" class="form-control fw-bold horas adc__noturno @error('saida4') is-invalid @enderror" name="saida4" value="{{old('saida4')}}" id="saida4">
                <small style="font-size: 13px;">De (00:00 ás 05:00)</small>
                @error('saida4')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <h1 class="text-center fs-5 fw-bold">Totais <i class="fad fa-calculator fa-md"></i></h1>

            <div class="col-md-3 input">
                <label for="horas_normais" class="form-label">Horas Normais</label>
                <input type="text" class="form-control fw-bold" name="horas_normais" value="" id="horas_normais">
            </div>

            <div class="col-md-2 input">
                <label for="hora__extra" class="form-label">HRS 50%</label>
                <input type="text" class="form-control fw-bold" name="hora__extra" value="" id="hora__extra">
            </div>

            <div class="col-md-2 input">
                <label for="horas__cem" class="form-label">HRS 100%</label>
                <input type="text" class="form-control fw-bold" name="horas__cem" value="" id="horas__cem">
            </div>

            <div class="col-md-2 input">
                <label for="adc__noturno" class="form-label">ADC.NOT</label>
                <input type="text" class="form-control fw-bold" name="adc__noturno" value="" id="adc__noturno">
            </div>
            <div class="col-md-3 input">
                <label for="total" class="form-label">Total</label>
                <input type="text" class="form-control fw-bold @error('total') is-invalid @enderror" name="total" value="" id="total">
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
              
             <div class="table-responsive-xl">
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
                    <td class="col text-center border-bottom text-nowrap text-uppercase" style="width:420px">{{$listas->tsnome}}</td>
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
            
            <div class="table-responsive-xl">
                  <table class="table border-bottom text-white mt-3 mb-5 table-responsive" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                <thead>
                    <th class="col text-center border-start border-top text-nowrap" style="width:80px;">Matricula</th>
                    <th class="col text-center border-top text-nowrap text-uppercase" style="width:330px">Nome</th>
                    <th class="col text-center border-top text-nowrap" style="width:90px;">Entrada</th>
                    <th class="col text-center border-top text-nowrap" style="width:90px;">Saída</th>
                    <th class="col text-center border-top text-nowrap" style="width:90px;">Entrada</th>
                    <th class="col text-center border-top text-nowrap" style="width:90px;">Saída</th>
                    <th class="col text-center border-top text-nowrap" style="width:90px;">HRS 50%</th>
                    <th class="col text-center border-top text-nowrap" style="width:90px;">HRS 100%</th>
                    <th class="col text-center border-top text-nowrap" style="width:90px;">AD.NOT</th>
                    <th class="col text-center border-end border-top text-nowrap" style="width:140px;">Total Geral</th>
                </thead>
                <tbody style="background-color: #081049; color: white;">
                @if(count($lista) > 0)
                    @foreach($lista as $listas)
                    @if($listas->bsentradanoite && $listas->bsentradanoite ||
                    $listas->bsentradamadrugada && $listas->bssaidamadrugada)
                    <tr>
                    <td   class="col text-center border-bottom border-start text-nowrap" style="width:80px;">{{$listas->tsmatricula}}</td>
                    <td class="col text-center border-bottom text-nowrap text-uppercase" style="width:330px;">{{$listas->tsnome}}</td>
                    <td class="col text-center border-bottom text-nowrap" style="width:90px;">{{$listas->bsentradanoite}}</td>
                    <td class="col text-center border-bottom text-nowrap" style="width:90px;">{{$listas->bssaidanoite}}</td>
                    <td class="col text-center border-bottom text-nowrap" style="width:90px;">{{$listas->bsentradamadrugada}}</td>
                    <td class="col text-center border-bottom text-nowrap" style="width:90px;">{{$listas->bssaidamadrugada}}</td>
                    <td class="col text-center border-bottom text-nowrap" style="width:90px;">{{$listas->bshoraex}}</td>
                    <td class="col text-center border-bottom text-nowrap" style="width:90px;">{{$listas->bshoraexcem}}</td>
                    <td class="col text-center border-bottom text-nowrap" style="width:90px;">{{$listas->bsadinortuno}}</td>
                    <td class="col text-center border-end border-bottom text-nowrap" style="width:140px;">{{$listas->bstotal}}</td>
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
 var semana = ["Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado"];
$('.horas').keyup(function() {
    index()
});
function index() {
    let diurno = manhao() + tarde()
    let noturno = noite() + madrugada()
    if ("{{$feriado}}" === 'Sim') {
        $('#horas_normais').val(horas(diurno))
        horaextra()
        adnoturno(noturno)
        $('#horas__cem').val(horas(diurno))
        $('#horas_normais').val('00:00')
        console.log('1');
    }else if (verificardata(0) === 'feriador nacional' ) {
        horaextra()
        adnoturno(noturno)
        $('#horas__cem').val(horas(diurno))
        $('#horas_normais').val('00:00')
        console.log('2');
    }else if (verificardata(0) === 'dia normal') {
        $('#horas_normais').val(horas(diurno))
        $('#horas__cem').val('00:00')
        adnoturno(noturno)
        horaextra()
        if (noite() || madrugada()) {
            if (verificardata(1) === 'feriador nacional') {
                $('#horas__cem').val(horas(diurno))
                $('#horas_normais').val('00:00')
                horaextra()
                adnoturno(noturno)
            }
        }
        console.log('3');
    }else if (verificardata(0) === 'sabado' &&  $('#sabado').val() !== '0') {
        if (noite() || madrugada()) {
            domingo(diurno)
            adnoturno(noturno)
        }else{
            $('#horas_normais').val(horas(diurno))
            $('#horas__cem').val('00:00')
            sabado();
        }
        console.log('5');
    }else if (verificardata(0) === 'domingo' && $('#domingo').val() ||  
    $('#domingo').val() === '0' || $('#sabado').val() === '0' || $('#diasuteis').val() === '0') {
        // $('#horas__cem').val(horas(diurno))
        domingo(diurno)
        adnoturno(noturno)
        console.log('4');
    }
    totalgeral()
}
function verificardata(valor) {
    var data = '{{$data}}'
    var dias = '';
    data = data.split('-')
    dias = new Date(`${data[0]}-${data[1]}-${ parseInt(data[2]) + valor} 08:24:30`);
    dias = dias.getDay();
    let resultador = ''
    semana.forEach((element,index) => {
        if (dias == index) {
            if (element === 'Domingo') {
                resultador =  'domingo'
            }else if (element === 'Sábado') {
                resultador =  'sabado'
            }
            let novadata = `${data[0]}-${data[1]}-${ parseInt(data[2]) + valor}`
            if (feriador_nacionais(novadata)) {
                resultador = 'feriador nacional'
            }else if (element !== 'Domingo' && element !== 'Sábado') {
                resultador =  'dia normal'
            }
        }
    })
    return resultador
}
function noite() {
    let noite1 = 0;
    let noite2  = 0;
    let resultado = 0;
    if ($("input[name='entrada3']").val() && $("input[name='saida3']").val()) {
        noite1 = segundos($("input[name='entrada3']").val())
        noite2 = segundos($("input[name='saida3']").val())
    } 
    if (noite1 >= 79200 && noite1 < 86400 && noite2 >= 79200 &&  noite2 < 86400) {
        resultado = (86400 - noite1) - (86400 - noite2);
    }else if (noite1 >= 79200 && noite2 >= 0 && noite2 <= 18000) {
        resultado = (86400 - noite1) + noite2
    }else if (noite1 >= 0 &&  noite2 <= 18000) {
        resultado = noite2 - noite1
    }
    return resultado;
}
function madrugada() {
    let madrugada1 = 0;
    let madrugada2  = 0;
    let resultado = 0;
    if ($("input[name='entrada4']").val() && $("input[name='saida4']").val()) {
        madrugada1 = segundos($("input[name='entrada4']").val())
        madrugada2 = segundos($("input[name='saida4']").val())
    } 
    if (madrugada1 >= 79200 && madrugada1 < 86400 && madrugada2 >= 79200 &&  madrugada2 < 86400) {
        resultado = (86400 - madrugada1) - (86400 - madrugada2);
    }else{
        resultado = madrugada2 - madrugada1;
    }
    return resultado;
}
function manhao() {
    let manhao1 = 0;
    let manhao2  = 0;
    let resultado = 0;
    if ($("input[name='entrada1']").val() && $("input[name='saida']").val()) {
        manhao1 = segundos($("input[name='entrada1']").val())
        manhao2 = segundos($("input[name='saida']").val())
    }
    if (manhao1 >= 18000 && manhao2 <= 64800) {
        resultado = manhao2 - manhao1
    }
    return resultado
}
function tarde() {
    let tarde1 = 0;
    let tarde2  = 0;
    let resultado = 0;
    if ($("input[name='entrada2']").val() && $("input[name='saida2']").val()) {
        tarde1 = segundos($("input[name='entrada2']").val())
        tarde2 = segundos($("input[name='saida2']").val())
    } 
    if (tarde1 >= 43200 && tarde2 <= 79200) {
        resultado = tarde2 - tarde1
    }
    return resultado
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
    let horas_cem = segundos($('#horas__cem').val());
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
    if (horas_cem) {
        total += horas_cem
    }
    $('#total').val(horas(total))
}

function sabado() {
    let total = $('#horas_normais').val();
    let sabado = $('#sabado').val()
    let result = '';
    if (segundos(sabado) <  segundos(total)) {
        result = (parseInt(segundos(sabado)) - parseInt(segundos(total))) * (-1);
        $('#hora__extra').val(horas(result))
        $('#horas_normais').val(horas(segundos(total) - result))
    }else{
        $('#hora__extra').val("0:00")
    }
}
function horaextra() {
    let total = $('#horas_normais').val();
    let diasuteis = $('#diasuteis').val()
    let adc__noturno = $('#adc__noturno').val()
    let sabado = $('#sabado').val();
    let domingo =  $('#domingo').val();
    let dias_uteis = $('#diasuteis').val();
    let result = '';
    console.log('extra');
    if (segundos(diasuteis) < segundos(total)) {
        result = (parseInt(segundos(diasuteis)) - parseInt(segundos(total))) * (-1);
        $('#hora__extra').val(horas(result))
        $('#horas_normais').val(horas(segundos(total) - result))
    }else{
        $('#hora__extra').val("0:00")
    }
    if (segundos(sabado) < segundos(adc__noturno)) {
        sabado =  segundos(adc__noturno) - segundos(sabado)
        $('#hora__extra').val(horas(result - sabado))
    }else if (segundos(dias_uteis) < segundos(adc__noturno)) {
        dias_uteis =  segundos(adc__noturno) - segundos(dias_uteis)
        $('#hora__extra').val(horas(result + dias_uteis))
    }else if (segundos(domingo) < segundos(adc__noturno)) {
        domingo =  segundos(adc__noturno) - segundos(domingo)
        $('#hora__extra').val(horas(result - domingo))
    }
    
}

function domingo(horas_normais) {
    // let horas_normais = segundos($('#horas_normais').val())
    if (horas_normais > 0) {
        $('#horas_normais').val(' ')
        $('#horas__cem').val(horas( horas_normais))
    }
}
   
            $( "#nome__completo" ).on('keyup focus',function() {
                var dados = '0';
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
                        //nome += `<option value="${element.tsmatricula}">`
                          nome += `<option value="${element.tscpf}">`
                        });
                        $('#datalistOptions').html(nome)
                        
                      }
                      if(data.length === 1 && dados.length > 4){
                        $('#trabalhador').val(data[0].id)
                        $('#matricula').val(data[0].tsmatricula)
                        boletim(dados)
                      }else{
                        campos()
                      }              
                    }
                });
            });
            function monta_dados(dados) {
              let novodados = dados.split('  ')
              return novodados[1];
            }
            function campos() {
                $('#form').attr('action', "{{route('boletimcartaoponto.store')}}");
                $('#atualizar').attr('disabled','disabled')
                $('#method').val(' ')
                $('#incluir').removeAttr( "disabled" )
                $('#trabalhador').val(' ')
                $('#matricula').val(' ')
                $('#entrada1').val(' ')
                $('#saida').val(' ')
                $('#entrada2').val(' ')
                $('#saida2').val(' ')
                $('#entrada3').val(' ')
                $('#saida3').val(' ')
                $('#entrada4').val(' ')
                $('#saida4').val(' ')
                $('#horas_normais').val(' ')
                $('#total').val(' ')
                $('#hora__extra').val(' ')
                $('#horas__cem').val(' ')
                $('#adc__noturno').val(' ')
            }
            function boletim(dados) {
                $('#carregamento').removeClass('d-none')
                $.ajax({
                    url: `{{url('boletim/cartao/ponto')}}/${dados}/${$('#lancamento').val()}/{{$data}}`,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                        $('#carregamento').addClass('d-none')
                        if (data.id) {
                            $('#form').attr('action', "{{ url('boletimcartaoponto')}}/"+data.id);
                            $('#formdelete').attr('action',"{{ url('boletimcartaoponto')}}/"+data.id)
                            $('#incluir').attr('disabled','disabled')
                            $('#atualizar').removeAttr( "disabled" )
                            // $('#deletar').removeAttr( "disabled" )
                            $('#excluir').removeAttr( "disabled" )
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
                            index()
                        }
                    }
                });
            }
    </script>
@stop