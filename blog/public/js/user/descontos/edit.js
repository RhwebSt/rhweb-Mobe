function botaoModal (){
                     
    Swal.fire({
        title: 'Periodo',
        html:
        '<input type="date" name="inicio" id="swal-input1" class="swal2-input">' +
        '<input type="date" name="final" id="swal-input2" class="swal2-input">',
        inputLabel: 'teste',
        confirmButtonText: 'Buscar',
        showDenyButton: true,
        denyButtonText: 'Sair',
        showConfirmButton: true,
        focusConfirm: false,
        preConfirm: () => {
            if (!document.getElementById('swal-input1').value || !document.getElementById('swal-input1').value) {
                Swal.showValidationMessage('Preencha todos os campos')   
            }else{
                let inicio =  document.getElementById('swal-input1').value
                let final = document.getElementById('swal-input2').value
                let tomador = document.getElementById('tomador').value
                location.href=`{{url('boletim/tomador')}}/${tomador}/${inicio}/${final}`;
            } 
            
        }
    });
} 
 
 $('.modal-botao').click(function() {
            localStorage.setItem("modal", "enabled");
        })

        function verficarModal() {
            var valueModal = localStorage.getItem('modal');
            if (valueModal === "enabled") {
            $(document).ready(function() {
                $("#teste").modal("show");
            });
            localStorage.setItem("modal", "disabled");
            }
        }
        verficarModal()
 $( "#nome__trab,#pesquisa" ).on('keyup focus',function() {  
        let  dados = '0'
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
              $('#nomemensagem').text(' ')
              $('#matricula').val(' ')
              let nome = ''
              if (data.length >= 1) {
                data.forEach(element => {
                  nome += `<option value="${element.tsnome}">`
                  // nome += `<option value="${element.tsmatricula}">`
                  nome += `<option value="${element.tscpf}">`
                });
                $('#listatrabalhador').html(nome);
                $('#listapesquisa').html(nome);
              }
              if(data.length === 1 && dados.length > 4){
                $('#nome__trab').html(nome)
                $('#trabalhador').val(data[0].id)
                $('#idtrabalhador').val(data[0].id)
                $('#matricula').val(data[0].tsmatricula)
              }else if(!data.length && dados.length > 4){
                $('#nomemensagem').text('Este trabalhador n??o ta cadastrador!')
              }              
            }
        });
    });
    function monta_dados(dados) {
      let novodados = dados.split('  ')
      return novodados[1];
    }