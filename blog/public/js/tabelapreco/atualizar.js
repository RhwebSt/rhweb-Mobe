
$(document).ready(function () {
    
    var hoje = new Date();
    var ontem = new Date().setHours(-1);
    ontem = new Date(ontem)
    console.log(ontem);
    var dataontemformatada = ontem.toLocaleDateString('pt-BR'); // '30/09/2018'
    dataontemformatada = dataontemformatada.split('/')
    var datahojeformatada = hoje.toLocaleDateString('pt-BR');
    datahojeformatada = datahojeformatada.split('/')
    if (parseInt(dataontemformatada[2]) < parseInt(datahojeformatada[2])) {
        let pocentagem = 50
        let status = false
        let time = 0;
        let mensagem = 'Aguarde'
        $.ajax({
            url: "tabela/preco/atualizar",
            dataType: 'json',
            type: "get",
            async: false,
            error: function () {
                console.log("Error");
                 time = 3000;
            },
            success: function (data) {
                if (data.status) {
                    status = data.status
                    pocentagem = 100;
                }
                time = 3000;
            }
        });
        Swal.fire({
            html:
                `<h1 class="text-center fw-bold fs-3 mb-3">Atualizando...</h1>
            <h4 class="text-center fs-6 mb-3">${mensagem}</h4>
            <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="${pocentagem}" aria-valuemin="0" aria-valuemax="100" style="width: ${pocentagem}%">${pocentagem}%</div>
            </div>`,
            showConfirmButton: false,
            allowEnterKey: false,
            allowOutsideClick: false,
            timer: time,
        });
    }
});