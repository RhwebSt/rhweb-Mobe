function validaInputQuantidade(idCampo,QuantidadeCarcteres){
    var telefone = document.querySelector(idCampo);

    telefone.addEventListener('input', function(){
        var telefone = document.querySelector(idCampo);
        var result = telefone.value;
        if(result > " " && result.length >= QuantidadeCarcteres){
          telefone.classList.add('is-valid');  
        }else{
            telefone.classList.remove('is-valid');
        }
         
    });
}

var ano = validaInputQuantidade("#ano",4);
var deducaoDepedente = validaInputQuantidade("#ded__dependente",1);
var valorFinal01 = validaInputQuantidade("#valor__final01",1);
var indice01 = validaInputQuantidade("#indice01",1);
var fator__reducao01 = validaInputQuantidade("#fator__reducao01",1);
var valorFinal02 = validaInputQuantidade("#valor__final02",1);
var indice02 = validaInputQuantidade("#indice02",1);
var fator__reducao02 = validaInputQuantidade("#fator__reducao02",1);
var valorFinal03 = validaInputQuantidade("#valor__final03",1);
var indice03 = validaInputQuantidade("#indice03",1);
var fator__reducao03 = validaInputQuantidade("#fator__reducao03",1);
var valorFinal04 = validaInputQuantidade("#valor__final04",1);
var indice04 = validaInputQuantidade("#indice04",1);
var fator__reducao04 = validaInputQuantidade("#fator__reducao04",1);
var valorFinal05 = validaInputQuantidade("#valor__final05",1);
var indice05 = validaInputQuantidade("#indice05",1);
var fator__reducao05 = validaInputQuantidade("#fator__reducao05",1);

var botaolimpaCampos = document.querySelector("#refre");

botaolimpaCampos.addEventListener('click', function(){
    var ano = document.querySelector("#ano").value='';
    var deducao = document.querySelector("#ded__dependente").value='';
    var valorFinal01 = document.querySelector("#valor__final01").value='';
    var indice01 = document.querySelector("#indice01").value='';
    var fator01 = document.querySelector("#fator__reducao01").value='';
    var valorFinal02 = document.querySelector("#valor__final02").value='';
    var indice02 = document.querySelector("#indice02").value='';
    var fator02 = document.querySelector("#fator__reducao02").value='';
    var valorFinal03 = document.querySelector("#valor__final03").value='';
    var indice03 = document.querySelector("#indice03").value='';
    var fator03 = document.querySelector("#fator__reducao03").value='';
    var valorFinal04 = document.querySelector("#valor__final04").value='';
    var indice04 = document.querySelector("#indice04").value='';
    var fator04 = document.querySelector("#fator__reducao04").value='';
    var valorFinal05 = document.querySelector("#valor__final05").value='';
    var indice05 = document.querySelector("#indice05").value='';
    var fator05 = document.querySelector("#fator__reducao05").value='';
});



$(document).ready(function(){
   
    $( "#ano" ).keyup(function() {
        var dados = $( this ).val();
        $.ajax({
            url: "{{url('irrf')}}/"+dados,
            type: 'get',
            contentType: 'application/json',
            success: function(data) {
               
                if (data[0].user) {
                    $('#form').attr('action', "{{ url('irrf')}}/"+data[0].user);
                    // $('#formdelete').attr('action',"{{ url('inss')}}/"+data.user)
                    $('#incluir').attr('disabled','disabled')
                    $('#atualizar').removeAttr( "disabled" )
                    $('#deletar').removeAttr( "disabled" )
                    // $('#excluir').removeAttr( "disabled" )
                    $('#method').val('PUT')
                    
                }
                else{
                    $('#form').attr('action', "{{ route('inss.store') }}");
                    $('#incluir').removeAttr( "disabled" )
                    $('#depedente').removeAttr( "disabled" )
                    $('#atualizar').attr('disabled','disabled')
                    $('#deletar').attr('disabled','disabled')
                    $('#method').val(' ')
                    // $('#excluir').attr( "disabled" )
                }
                data.forEach((element,index) => {
                    $('#valor__inicial0'+(index+1)).val(element.irsvalorinicial)
                    $('#valor__final0'+(index+1)).val(element.irsvalorfinal)
                    $('#indice0'+(index+1)).val(element.irsindece)
                    $('#id0'+(index+1)).val(element.id)
                    $('#fator__reducao0'+(index+1)).val(element.irsreducao)
                }); 
                $('#ded__dependente').val(data[0].irdepedente)
            }
        });
    });
    // $('.resultado').keyup(function () {
    //     let indice = $(this).attr('name')
    //     indice = indice.split('')
    //     let valor = $(`#valor__final${indice[6]}${indice[7]}`).val().replace(/\./g,"").replace(/,/g,".")
       
    //     let resultado = (parseFloat($(this).val().toString().replace(",", ".")) / 100) *  parseFloat(valor);
       
    //     if (resultado > 0) { 
    //         $(`#fator__reducao${indice[6]}${indice[7]}`).val(resultado.toFixed(2).replace(".", ","))
    //     }
    // })
}); 