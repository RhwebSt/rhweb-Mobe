<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-social - Rhweb</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/rhweb.css">
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/esocial/esocial.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.css"/>
</head>
<body>
    <main role="main">
        <div class="container">

            <section class="section__botoes--esocial">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="#" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
            </section>

            <h1 class="title__esocial">E-social <i class="fad fa-upload"></i></h1>


            <section class="enviarEsocial">
                <div class="col-12 col-md-6 mb-3">
                    <label for="formFile" class="form-label"><i class="fad fa-file-alt"></i> Selecione seu arquivo</label>
                    <input class="form-control" type="file" id="formFile">
                </div>

                <div class="col-12 col-md-2 mb-3">
                    <a href="#" class="botao">Enviar <i class="fad fa-paper-plane"></i></a>
                </div>
            </section>


            <section class="table">
                <div class="table-responsive-xxl">
                    <table class="table display" id="tabelaEsocial">
                        <thead class="tr__header">
                            <th class="th__header text-nowrap" style="width:80px;">Evento</th>
                            <th class="th__header text-nowrap">Mátricula</th>
                            <th class="th__header text-nowrap">Nome</th>
                            <th class="th__header text-nowrap">ID Evento</th>
                            <th class="th__header text-nowrap">Status</th>
                            <th class="th__header text-nowrap">Descrição</th>
                            <th class="th__header text-nowrap" style="width:60px">Vizualizar</th>
                        </thead>
                        <tbody class="table__body">

                            <tr class="tr__body">
                                <td class="td__body text-nowrap col" style="width:80px">1200</td>
                                <td class="td__body text-nowrap col limitaCarcteres" data-bs-toggle="tooltip" data-bs-placement="bottom" title="">1111</td>
                                <td class="td__body text-nowrap col limitaCarcteres" data-bs-toggle="tooltip" data-bs-placement="bottom" title="">Eliel Felipe dos Santos Rocha</td>

                                <td class="td__body text-nowrap col limitaCarcteres" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""></td>

                                <td class="td__body text-nowrap col limitaCarcteres" data-bs-toggle="tooltip" data-bs-placement="bottom" title="">Em processamento</td>
                                
                                <td class="td__body text-nowrap col  limitaCarcteres" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""></td>  
                                
                                <td class="td__body text-nowrap col" style="width:60px;">
                                    <a class="btn btn__vizualizar" href="#"><i class="icon__color fad fa-eye"></i></a>
                                </td> 

                            </tr>

                        </tbody>
                    </table>
                </div>
            </section> 

        </div>
    </main>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script>
        $(document).ready( function () {
            $('#tabelaEsocial').DataTable({
                "language": {
                    "infoEmpty": "mostrando",
                    "search":         "Pesquisar",
                    "info":           "Mostrando _START_ de _END_ registros",
                    "infoFiltered":   "",
                    "zeroRecords":    "Não há nenhum registro cadastrado <i class='fad fa-exclamation-triangle fa-lg' style='color: red !important;'>",
                    "lengthMenu":     "Mostrar _MENU_ registros",
                    "emptyTable":     "Não há dados disponíveis na tabela",
                    "loadingRecords": "Carregando...",
                    "paginate": {
                        "first":      "Primeira",
                        "last":       "Última",
                        "next":       "Próxima",
                        "previous":   "Anterior"
                    },
                }
                
            });
        } );
    </script>
</body>
</html>