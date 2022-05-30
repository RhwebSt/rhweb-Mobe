@extends('administrador.layouts.index')
@section('titulo','Rhweb - Lista Trabalhador')
@section('conteine')
        <div class="container">


            <section class="section__title--historico--trab">
                <div>
                    <h1 class="title__historico--trab">Histórico do Trabalhador <i class="fad fa-history"></i></h1>
                </div>
            </section>


            <section class="">

                <div class="div__image--historico--trab">
                    <div>
                        <img class="image--historico--trab" src="{{$trabalhador->tsfoto}}" alt="">
                    </div>
                </div>

            </section>

            <section class="dados__historico row">

                <div class="col-md-6">
                    <label for="nome__completo" class="form-label">Nome Completo <i class="fad fa-lock"></i></label>
                    <input type="text" class="form-control input fw-bold text-dark" value="{{$trabalhador->tsnome}}" name="nome__completo" maxlength="100" id="nome__completo" readonly>
                </div>

                <div class="col-md-6">
                    <label for="nome__social" class="form-label">Nome social <i class="fad fa-lock"></i> 
                        @if($trabalhador->tssocial)
                            Definido como padrão <input type="checkbox" checked name="radio_social" id="radio" disabled />
                        @else
                            Definido como padrão <input type="checkbox"  name="radio_social" id="radio" disabled />
                        @endif
                    </label>
                    <input type="text" class="form-control input fw-bold text-dark" value="{{$trabalhador->tsnomesocial}}" name="nome__social" maxlength="100" id="nome__social" readonly>
                </div>

                <div class="col-md-3 mt-1">
                    <label for="cpf" class="form-label">CPF <i class="fad fa-lock"></i></label>
                    <input type="text" class="form-control input fw-bold text-dark" value="{{$trabalhador->tscpf}}" name="cpf" maxlength="100" id="cpf" readonly>
                </div>

                <div class="col-md-3 mt-1">
                    <label for="pis" class="form-label">PIS <i class="fad fa-lock"></i></label>
                    <input type="text" class="form-control input fw-bold text-dark" value="{{$trabalhador->dspis}}" name="pis" maxlength="100" id="pis" readonly>
                </div>

                <div class="col-md-3 mt-1">
                    <label for="matricula" class="form-label">Matrícula <i class="fad fa-lock"></i></label>
                    <input type="text" class="form-control input fw-bold text-dark" value="{{$trabalhador->tsmatricula}}" name="matricula" maxlength="100" id="matricula" readonly>
                </div>

                <div class="col-md-3 mt-1">
                    <label for="data__nascimento" class="form-label">Data de Nascimento <i class="fad fa-lock"></i></label>
                    <input type="date" class="form-control input fw-bold text-dark" value="{{$trabalhador->nsnascimento}}" name="data__nascimento" maxlength="100" id="data__nascimento" readonly>
                </div>

                <div class="col-md-6 mt-1">
                    <label for="empresa" class="form-label">Empresa <i class="fad fa-lock"></i></label>
                    <input type="text" class="form-control input fw-bold text-dark" value="" name="empresa" id="empresa" readonly>
                </div>

            </section>

            <section class="accoordion__historico row">

                <div class="accordion div__acordion" id="accordionExample">
                
                    
                    <div class="accordion-item item__acorddion">

                      <h2 class="accordion-header accoordion__header" id="headingOne">
                        <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                             Contrato de Trabalho <i class="fad fa-file-contract ms-1"></i>
                        </button>
                      </h2>

                      <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">

                            <div class="accordion-body letter__color row">

                                <div class="col-md-4 mt-1">
                                    <label for="data__admissao" class="form-label">Data de Admissão <i class="fad fa-lock"></i></label>
                                    <input type="date" class="form-control input fw-bold text-dark" value="{{$trabalhador->csadmissao}}" name="data__admissao" id="data__admissao" readonly>
                                </div>
                            
                                <div class="col-md-4 mt-1">
                                    <label for="categoria" class="form-label">Categoria <i class="fad fa-lock"></i></label>
                                    <input type="text" list="categoria_list" class="form-control input fw-bold text-dark" value="{{$trabalhador->cscategoria}}" maxlength="100" name="categoria__contrato" id="categoria" readonly>
                                </div>
                            
                                <div class="col-md-4 mt-1">
                                    <label for="cbo" class="form-label">CBO <i class="fad fa-lock"></i></label>
                                    <input type="text" list="cbo_list" class="form-control input fw-bold text-dark" value="{{$trabalhador->cbo}}" name="cbo" id="cbo" value="" readonly>
                                </div>
                            
                            
                            
                                <div class="col-md-4 mt-1">
                                    <label for="ctps" class="form-label">CTPS <i class="fad fa-lock"></i></label>
                                    <input type="text" class="form-control input fw-bold text-dark" maxlength="20" value="{{$trabalhador->dsctps}}" name="ctps" id="ctps" readonly>
                                </div>
                            
                                <div class="col-md-4 mt-1">
                                    <label for="serie__ctps" class="form-label">Série <i class="fad fa-lock"></i></label>
                                    <input type="text" class="form-control input fw-bold text-dark" value="{{$trabalhador->dsserie}}" name="serie__ctps" id="serie__ctps" readonly>
                                </div>
                            
                                <div class="col-md-4 mt-1">
                                    <label for="uf__ctps" class="form-label">UF <i class="fad fa-lock"></i></label>
                                    <input type="text" class="form-control input fw-bold text-dark" value="{{$trabalhador->dsuf}}" name="uf__ctps" maxlength="2" id="uf__ctps" readonly>
                                </div>
                            
                                <div class="col-md-4 mt-1">
                                    <label for="situacao__contrato" class="form-label">Situação <i class="fad fa-lock"></i></label>
                                    <input type="text" class="form-control input fw-bold text-dark" value="{{$trabalhador->cssituacao}}" name="situacao__contrato" maxlength="2" id="situacao__contrato" readonly>
                                </div>
                            
                                <div class="col-md-4 mt-1">
                                    <label for="data__afastamento" class="form-label">Data de Afastamento <i class="fad fa-lock"></i></label>
                                    <input type="date" class="form-control input fw-bold text-dark" value="{{$trabalhador->csafastamento}}" name="data__afastamento" id="data__afastamento" readonly>
                                </div>


                            </div>

                        </div>

                    </div>
                    
                    <div class="accordion-item item__acorddion">

                        <h2 class="accordion-header accoordion__header" id="headingTwo">
                            <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Cartão Ponto <i class="ms-1 fad fa-clock"></i>
                            </button>
                        </h2>

                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                                <div>
                                    <ul class="lista__historico--trab">
                                        @foreach($cartaoponto as $cartaopontos)
                                            <li class="item__lista--historico--trab"><i class="fad fa-star-christmas"></i> Boletim Nº {{$cartaopontos->liboletim}} - {{$cartaopontos->tsnome}} - {{ date("d/m/Y",strtotime($cartaopontos->lsdata))}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            
                            </div>

                        </div>

                    </div>

                    <div class="accordion-item item__acorddion">

                        <h2 class="accordion-header accoordion__header" id="headingThree">

                            <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Boletim com Tabela <i class="ms-1 fad fa-tasks-alt"></i>
                            </button>

                        </h2>
                        
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                                <div>
                                    <ul class="lista__historico--trab">
                                    @foreach($lanrublica as $lanrublicas)
                                            <li class="item__lista--historico--trab"><i class="fad fa-star-christmas"></i> Boletim Nº {{$lanrublicas->liboletim}} - {{$lanrublicas->tsnome}} - {{ date("d/m/Y",strtotime($lanrublicas->lsdata))}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            
                            </div>

                        </div>
                    </div>
                    <div class="accordion-item item__acorddion">

                        <h2 class="accordion-header accoordion__header" id="headingTen">
                            <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                            Calculo da Folha<i class="ms-1 fad fa-calculator-alt"></i>
                            </button>
                        </h2>

                        <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                                <div>
                                    <ul class="lista__historico--tomador">
                                        @foreach($folhar as $folhas)
                                            <li class="item__lista--historico--trab"><i class="fad fa-star-christmas"></i> Nº da Folha {{$folhas->fscodigo}} - {{date("d/m/Y",strtotime($folhas->fsinicio))}} à {{date("d/m/Y",strtotime($folhas->fsfinal))}}</li>
                                        @endforeach
                                        
                                    </ul>
                                </div>
                            
                            </div>

                        </div>

                    </div>

                    <div class="accordion-item item__acorddion">

                        <h2 class="accordion-header accoordion__header" id="headingFour">

                            <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Fatura <i class="ms-1 fad fa-file-invoice-dollar"></i>
                            </button>

                        </h2>
                        
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                                <div>
                                    <ul class="lista__historico--trab">
                                        <li class="item__lista--historico--trab"><i class="fad fa-star-christmas"></i> Fatura Nº 2002 - tomador - 00/00/0000</li>
                                        <li class="item__lista--historico--trab"><i class="fad fa-star-christmas"></i> Fatura Nº 2002 - tomador - 00/00/0000</li>
                                        <li class="item__lista--historico--trab"><i class="fad fa-star-christmas"></i> Fatura Nº 2002 - tomador - 00/00/0000</li>
                                    </ul>
                                </div>
                            
                            </div>

                        </div>
                    </div>
                    
                </div>

            </section>

        </div>
            
        @stop