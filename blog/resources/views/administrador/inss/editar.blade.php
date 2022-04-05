@extends('administrador.layouts.index')
@section('titulo','Rhweb - Inss')
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
                  title: '{{session("success")}}'
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
          
            <section class="section__form--inss">

                <form class="row g-3" action="{{route('inss.update',$id)}}" method="POST">
                @csrf
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                    <button type="submit" id="atualizar" class="btn button__atualizar--inss" ><i class="fad fa-save"></i> Atualizar</button>
                    <a href="{{route('inss.index')}}" id="sair" class="btn button__sair--inss" ><i class="fad fa-sign-out"></i> Sair</a>
                </div>
                    <input type="hidden" id="method" name="_method" value="PUT">
                    
                    <div class="container block">
                        <div class="col-md-1">
                            <label for="ano" class="form-label">Ano
                                <span id="refre" data-bs-toggle="tooltip" data-bs-placement="top" title="Limpar todos os campos" style="background-color:#A71113; padding: 0.6px 4px; border: 1px solid #DF1619; border-radius: 20px;"><i class="fad fa-sync-alt " style="color: #fff"></i></span>
                            </label>
                            <input type="text" class="form-control fw-bold" name="isano" value="{{$inss[0]->isano}}" id="ano">
                                <span class="text-danger"></span>
                        </div>
                    </div>
                    @foreach($inss as $key=>$i)
                        @if($i->isvalorfinal)
                        <div class="col-md-4">
                            <label for="valor__final" class="form-label">Valor Final</label>
                            <input type="text" class="form-control padrao" value="{{$i->isvalorfinal}}" name="valor__final0{{$key + 1}}" id="valor__final0{{$key + 1}}">
                        </div>
        
                        <div class="col-md-4 ">
                            <label for="indice" class="form-label">Indíce %</label>
                            <input type="text" class="form-control padrao resultado" value="{{ number_format((float)$i->isindece, 2, ',', '')}}" name="indice0{{$key + 1}}" id="indice0{{$key + 1}}">
                        </div>
        
                        <div class="col-md-4 ">
                            <label for="indice" class="form-label">Fator de Redução <i class="fad fa-lock"></i></label>
                            <input type="text" class="form-control padrao" value="{{ number_format((float)$i->isreducao, 2, ',', '')}}" name="fator0{{$key + 1}}" id="fator0{{$key + 1}}" readonly>
                        </div>
                        
                        @endif
                    @endforeach
                    @foreach($inss as $key=>$i)
                    <input type="hidden" name="id0{{$key + 1}}" id="id0{{$key + 1}}" value="{{$i->id}}">
                    @endforeach
                    
                    <!-- <div class="col-md-4">
                        <label for="valor__final" class="form-label">Valor Final</label>
                        <input type="text" class="form-control" name="valor__final01" id="valor__final01">
                    </div>
    
                    <div class="col-md-4 ">
                        <label for="indice" class="form-label">Indíce %</label>
                        <input type="text" class="form-control resultado" name="indice01" id="indice01">
                    </div>
    
                    <div class="col-md-4 ">
                        <label for="indice" class="form-label">Fator de Redução <i class="fad fa-lock"></i></label>
                        <input type="text" class="form-control" name="fator01" id="fator01" readonly>
                    </div>
    
    
                    <div class="col-md-4">
                        <label for="valor__final" class="form-label">Valor Final</label>
                        <input type="text" class="form-control" name="valor__final02" id="valor__final02">
                    </div>
    
                    <div class="col-md-4 ">
                        <label for="indice" class="form-label">Indíce %</label>
                        <input type="text" class="form-control resultado" name="indice02" id="indice02">
                    </div>
    
                    <div class="col-md-4 ">
                        <label for="indice" class="form-label">Fator de Redução <i class="fad fa-lock"></i></label>
                        <input type="text" class="form-control" name="fator02" id="fator02" readonly>
                    </div>
    
    
                    <div class="col-md-4">
                        <label for="valor__final" class="form-label">Valor Final</label>
                        <input type="text" class="form-control" name="valor__final03" id="valor__final03">
                    </div>
    
                    <div class="col-md-4 ">
                        <label for="indice" class="form-label">Indíce %</label>
                        <input type="text" class="form-control resultado" name="indice03" id="indice03">
                    </div>
    
                    <div class="col-md-4 ">
                        <label for="indice" class="form-label">Fator de Redução <i class="fad fa-lock"></i></label>
                        <input type="text" class="form-control" name="fator03" id="fator03" readonly>
                    </div>
    
    
                    <div class="col-md-4">
                        <label for="valor__final" class="form-label">Valor Final</label>
                        <input type="text" class="form-control resultado" name="valor__final04" id="valor__final04">
                    </div>
    
                    <div class="col-md-4 ">
                        <label for="indice" class="form-label">Indíce %</label>
                        <input type="text" class="form-control resultado" name="indice04" id="indice04">
                    </div>
    
                    <div class="col-md-4 ">
                        <label for="indice" class="form-label">Fator de Redução <i class="fad fa-lock"></i></label>
                        <input type="text" class="form-control " name="fator04" id="fator04" readonly>
                    </div>
    
    
                    <div class="col-md-4">
                        <label for="valor__final" class="form-label">Valor Final</label>
                        <input type="text" class="form-control" name="valor__final05" id="valor__final05">
                    </div>
    
                    <div class="col-md-4 ">
                        <label for="indice" class="form-label">Indíce %</label>
                        <input type="text" class="form-control resultado" name="indice05" id="indice05">
                    </div>
    
                    <div class="col-md-4 ">
                        <label for="indice" class="form-label">Fator de Redução <i class="fad fa-lock"></i></label>
                        <input type="text" class="form-control" name="fator05" id="fator05" readonly>
                    </div> -->

                </form>

            </section>


            <section>
                <div class="offcanvas off__canvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                      <div class="offcanvas-header">
                          <h5 class="offcanvas-title" id="offcanvasExampleLabel">Notificações <i id="bell__notification--ofcanvas" class="fad fa-bell bell__notification--ofcanvas"></i></h5>
                          <i class="fas fa-2x fa-times icon__exit--side--bar" data-bs-dismiss="offcanvas"></i>
                      </div>
                      <div class="offcanvas-body off__canvas--body">

                          <div class="body__notification" id="notification">
                              <div class="d-flex flex-row justify-content-between header__notification">
                                  {{-- cabecalho da notificação o Rhweb é fixo só muda o tempo que a mensagem foi feita --}}
                                  <div class="">
                                      <p class="content__header-notification">Rhweb <i id="notification__icon-no-read" class="fas fa-circle notification__icon-no-read"></i></p>
                                  </div>
                                  {{-- inicio da contagem do tempo que a mensagem foi postada --}}
                                  <div class="">
                                      <p class="content__header-notification">1s</p>
                                  </div>
                                  {{-- fim da contagem do tempo que a mensagem foi postada --}}
                              </div>
                              {{-- fim do cabecalho --}}

                              {{-- inicio corpo da mensagem --}}
                              <div class="teste">
                                  <p class="text__body--notification">O sistema será atualizado no dia 30/03/22 as  </p>
                              </div>
                              {{-- fim do corpo da mensagem --}}

                              
                              {{-- inicio da  exclusao da notificacao --}}
                              <div class="d-flex justify-content-end footer-notification">
                                  <form action=""></form>
                                  <div class="content__footer-notification">
                                      <a href="#"><i class="fas icone__footer-notification fa-trash"></i></a>
                                  </div>
                              </div>
                              {{-- fim da exclusão da notificação --}}
                          </div>

                          
                          {{-- inicio da contagem de mensagem nao lida --}}
                          <div class="no__read--message">
                              <p class="no__read--message--content">20 notificações não lidas</p>
                          </div>
                          {{-- fim da contagem da mensagem não lida --}}

                      
                      </div>
                </div>
          </section>
        </div>
        <script>
             $(document).ready(function(){
                $('.padrao').mask('000.000.000.000.000,00', {reverse: true});
                $('.resultado').keyup(function () {
                    let indice = $(this).attr('name')
                    indice = indice.split('')
                    let valor = $(`#valor__final${indice[6]}${indice[7]}`).val().replace(/\./g,"").replace(/,/g,".")
                    let resultado = (parseFloat($(this).val().toString().replace(",", ".")) / 100) *  parseFloat(valor);
                    if (resultado > 0) { 
                        $(`#fator${indice[6]}${indice[7]}`).val(resultado.toFixed(2).replace(".", ","))
                    }
                })
             })
        </script>
        @stop