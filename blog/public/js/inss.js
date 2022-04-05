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
var valorFinal01 = validaInputQuantidade("#valor__final01",1);
var indice01 = validaInputQuantidade("#indice01",1);
var valorFinal02 = validaInputQuantidade("#valor__final02",1);
var indice01 = validaInputQuantidade("#indice02",1);
var valorFinal03 = validaInputQuantidade("#valor__final03",1);
var indice03 = validaInputQuantidade("#indice03",1);
var valorFinal04 = validaInputQuantidade("#valor__final04",1);
var indice04 = validaInputQuantidade("#indice04",1);
var valorFinal05 = validaInputQuantidade("#valor__final05",1);
var indice05 = validaInputQuantidade("#indice05",1);


var botaolimpaCampos = document.querySelector("#refre");

botaolimpaCampos.addEventListener('click', function(){
    var ano = document.querySelector("#ano").value='';
    var valorFinal01 = document.querySelector("#valor__final01").value='';
    var indice01 = document.querySelector("#indice01").value='';
    var fator01 = document.querySelector("#fator01").value='';
    var valorFinal02 = document.querySelector("#valor__final02").value='';
    var indice02 = document.querySelector("#indice02").value='';
    var fator02 = document.querySelector("#fator02").value='';
    var valorFinal03 = document.querySelector("#valor__final03").value='';
    var indice03 = document.querySelector("#indice03").value='';
    var fator03 = document.querySelector("#fator03").value='';
    var valorFinal04 = document.querySelector("#valor__final04").value='';
    var indice04 = document.querySelector("#indice04").value='';
    var fator04 = document.querySelector("#fator04").value='';
    var valorFinal05 = document.querySelector("#valor__final05").value='';
    var indice05 = document.querySelector("#indice05").value='';
    var fator05 = document.querySelector("#fator05").value='';
});




$(document).ready(function(){
   
    $( "#ano" ).change(function() {
        var dados = $( this ).val();
        $.ajax({
            url: "{{url('inss')}}/"+dados,
            type: 'get',
            contentType: 'application/json',
            success: function(data) {
               
                if (data[0].user) {
                    $('#form').attr('action', "{{ url('inss')}}/"+data[0].user);
                    $('#formdelete').attr('action',"{{ url('inss')}}/"+data[0].isano)
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
                    $('#valor__inicial0'+(index+1)).val(element.isvalorinicial)
                    $('#valor__final0'+(index+1)).val(element.isvalorfinal)
                    $('#indice0'+(index+1)).val(element.isindece)
                    $('#fator0'+(index+1)).val(element.isreducao)
                    $('#id0'+(index+1)).val(element.id)
                });
            }
        });
    });
    $('.resultado').keyup(function () {
        let indice = $(this).attr('name')
        indice = indice.split('')
        let valor = $(`#valor__final${indice[6]}${indice[7]}`).val().replace(/\./g,"").replace(/,/g,".")
        let resultado = (parseFloat($(this).val().toString().replace(",", ".")) / 100) *  parseFloat(valor);
        if (resultado > 0) { 
            $(`#fator${indice[6]}${indice[7]}`).val(resultado.toFixed(2).replace(".", ","))
        }
    })
});