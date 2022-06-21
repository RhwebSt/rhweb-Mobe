@extends('layouts.index')
@section('titulo','E-social - Rhweb')
@section('conteine')
    <main role="main">
        <div class="container">

            <section class="section__botoes--esocial">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="#" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
            </section>

            <h1 class="title__esocial">E-social <i class="fad fa-upload"></i></h1>


            <section class="enviarEsocial">
                <form id="form" method="post" enctype="multipart/form-data">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="formFile" class="form-label"><i class="fad fa-file-alt"></i> Selecione seu arquivo</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>

                    <div class="col-12 col-md-2 mb-3">
                        <a href="#" class="botao">Enviar <i class="fad fa-paper-plane"></i></a>
                    </div>
                </form>
            </section>


            <section class="table">
                <div class="table-responsive-xxl">
                    <table class="table display" id="tabelaEsocial" style="width:100%">
                        <thead class="tr__header">
                            <th class="th__header text-nowrap" style="width:80px;">Evento</th>
                            <th class="th__header text-nowrap">Mátricula</th>
                            <th class="th__header text-nowrap">Nome</th>
                            <th class="th__header text-nowrap">ID Evento</th>
                            <th class="th__header text-nowrap">Data</th>
                            <th class="th__header text-nowrap">Detalhes</th>
                        </thead>
                    
                    </table>
                </div>
                
            </section> 

        </div>
    </main>
    @stop