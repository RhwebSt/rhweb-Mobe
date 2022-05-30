$('.modal-botao, .pag-item, .page-link').click(function() {
    localStorage.setItem("modal", "enabled");
});

function verficarModal(idModal) {
    var valueModal = localStorage.getItem("modal");
    if (valueModal === "enabled") {
      $(document).ready(function() {
        $(idModal).modal("show");
        localStorage.setItem("modal", "disabled");
      });
      
    }
}

var modalTrabalhador = verficarModal('#modalTrabalhador');
var modalTomador = verficarModal('#modalTomador');
var modalTabPreco = verficarModal('#modalTabPreco');
var modalComissionado = verficarModal('#modalComissionado');
var modalCadAcesso = verficarModal('#modalCadAcesso');
var modalDesconto = verficarModal('#modalDesconto');
var modalCartaoPonto = verficarModal('#modalCartaoPonto');
var modalListaDiurno = verficarModal('#listaDiurno');
var modalListaNoturno = verficarModal('#listaNoturno');
var modalBoletimTabela = verficarModal('#modalBoletimTabela');
var modalBoletimTabelaLancamento = verficarModal('#modalLancamentoPreco');



 

