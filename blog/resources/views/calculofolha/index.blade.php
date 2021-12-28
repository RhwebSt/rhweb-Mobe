@extends('layouts.index')
@section('conteine')
<div class="container">
<form class="row g-3" action="{{route('calculo.folha.store')}}" method="POST">
            <div class="mt-5 " id="quadro1">
                <div class="container text-start  fs-4 fw-bold mt-4 mb-3">Trabalhador</div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="todostrabalhador" id="todostrabalhador">
                    <label class="form-check-label" for="todostrabalhador">Todos</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="umtrabalhador" id="umtrabalhador">
                    <label class="form-check-label" for="umtrabalhador">Apenas um</label>
                </div>

                <div>
                    <div class="col-md-8 col-12 mt-2 mb-2 p-1 ">
                        <div class="d-flex">
                        <label for="exampleDataList" class="form-label"></label>
                        <input class="form-control fw-bold text-dark " list="listatrabalhador" id="pesquisatrabalhador">
                        <input type="hidden" id="trabalhador" name="trabalhador" value="0">
                        <datalist id="listatrabalhador">
                        </datalist>
                        <i class="fas fa-search fa-md iconsear" id="icon"></i>
                        <div class="text-center d-none" id="refres" >
                            <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black;">
                                <span class="visually-hidden">Carregando...</span>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>
                <div class="container text-start  fs-4 fw-bold mt-4 mb-3">Tomador</div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="todostomador" id="todostomador" >
                    <label class="form-check-label" for="todostomador">Todos</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="umtomador" id="umtomador">
                    <label class="form-check-label" for="umtomador">Apenas um</label>
                </div>

                <div>
                    <div class="col-md-8 col-12 mt-2 mb-2 p-1 pesquisar">
                        <div class="d-flex">
                        <label for="exampleDataList" class="form-label"></label>
                        <input class="form-control fw-bold text-dark pesquisa" list="listatomador"  id="pesquisatomador">
                        <input type="hidden" name="tomador" id="tomador" value="0">
                        <datalist id="listatomador">
                        </datalist>
                        <i class="fas fa-search fa-md iconsear" id="icon"></i>
                        <div class="text-center d-none" id="refres" >
                            <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black;">
                                <span class="visually-hidden">Carregando...</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex mt-4">
                    <div class="col-md-4 ms-1 input">
                      <label for="ano" class="form-label">Data Inicial</label>
                      <input type="date" class="form-control " name="ano_inicial" value="" id="tano">
                    </div>
                    
                    <div class="col-md-4 input ms-3">
                      <label for="ano" class="form-label">Data Final</label>
                      <input type="date" class="form-control " name="ano_final" value="" id="tano">
                    </div>
                </div>
                <div class="mt-5 col-md-2">
                    <a class="btn bg-primary" id="campo1"><i class="fas fa-print"></i>Próximo</a>
                </div>
            </div>
            @csrf
                <div class="d-none" id="quadro2">
                    <p class="container text-start  fs-4 fw-bold mt-4 mb-3">Você deseja cadastrar?</p>
                    <button type="submit" class="btn bg-primary" id="campo_sim_1"><i class="fas fa-print"></i>Sim</button>
                    <a class="btn bg-primary" type="submit" id="campo_nao_2"><i class="fas fa-print"></i>Não</a>
                </div>

                <div class="d-none">
                    <p class="container text-start  fs-4 fw-bold mt-4 mb-3">Numero do Boletim 99999</p>
                    <button  class="btn bg-primary"><i class="fas fa-print"></i>Imprimir</button>
                </div>

              </div>
        </form>
        </div>
        <script>
            $(document).ready(function(){
                $('#campo1').click(function() {
                    $('#quadro1').addClass('d-none')
                    $('#quadro2').removeClass('d-none')
                })
                $('#campo_nao_2').click(function() {
                    $('#quadro2').addClass('d-none')
                    $('#quadro1').removeClass('d-none')
                })
                $('#pesquisatrabalhador').on('keyup focus',function () {
                    let dados = 0;
                    if ($(this).val()) {
                        dados = $(this).val()
                    }
                    $.ajax({
                        url: "{{url('trabalhador')}}/pesquisa/"+dados, 
                        type: 'get',
                        contentType: 'application/json', 
                        success: function(data) {
                            let nome = ''
                            if (data.length >= 1) {
                                data.forEach(element => {
                                nome += `<option value="${element.tsnome}">`
                                        // nome += `<option value="${element.tsmatricula}">`
                                        // nome += `<option value="${element.tscnpj}">`
                                });
                                $('#listatrabalhador').html(nome)
                            } 
                            if(data.length === 1 && dados.length >= 2){
                                $('#trabalhador').val(data[0].id)
                            }
                        }
                    })
                })
                $('#pesquisatomador').on('keyup focus',function () {
                    let dados = 0;
                    if ($(this).val()) {
                        dados = $(this).val()
                    }
                    $.ajax({
                        url: "{{url('tomador')}}/pesquisa/"+dados, 
                        type: 'get',
                        contentType: 'application/json', 
                        success: function(data) {
                            let nome = ''
                            if (data.length >= 1) {
                                data.forEach(element => {
                                nome += `<option value="${element.tsnome}">`
                                        // nome += `<option value="${element.tsmatricula}">`
                                        // nome += `<option value="${element.tscnpj}">`
                                });
                                $('#listatomador').html(nome)
                            } 
                            if(data.length === 1 && dados.length >= 2){
                                $('#tomador').val(data[0].tomador)
                            }
                        }
                    })
                })
            })
        </script>
        @stop