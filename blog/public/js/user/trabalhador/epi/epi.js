function remove(index) {
    $(`.campo${index}`).remove();
    }
    let index = 0;
    function conteiner(index) {
            let conteiner = '';
            conteiner += `<div class="row d-flex mb-3 campo${index}">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1 col-xxl-1 mt-2">
                    <label for="quantidade" class="form-label">Quant.</label>
                    <input type="text" class="form-control numero input" name="quantidade${index}" maxlength="100" id="quantidade${index}">
                    <div class="mt-1">
                            <span class="text-danger"></span>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 col-xxl-4 mt-2">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control input"  name="descricao${index}" maxlength="100" id="descricao${index}">
                    <div class="mt-1">
                            <span class="text-danger"></span>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1 col-xxl-1 mt-2">
                    <label for="tamanho" class="form-label">Tam.</label>
                    <input type="text" class="form-control input"  name="tamanho${index}" maxlength="100" id="tamanho${index}">
                    <div class="mt-1">
                            <span class="text-danger"></span>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1 col-xxl-1 mt-2">
                    <label for="ca" class="form-label">CA</label>
                    <input type="text" class="form-control numero input"  name="ca${index}" maxlength="100" id="ca${index}">
                    <div class="mt-1">
                            <span class="text-danger"></span>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 col-xxl-2 mt-2">
                    <label for="data__recolhimento" class="form-label">Dta.Rec</label>
                    <input type="date" class="form-control input"  name="data__recolhimento${index}" maxlength="100" id="data__recolhimento${index}">
                    <div class="mt-1">
                            <span class="text-danger"></span>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 col-xxl-2 mt-2">
                    <label for="data__devolucao" class="form-label">Dta.Dev</label>
                    <input type="date" class="form-control input"  name="data__devolucao${index}" maxlength="100" id="data__devolucao${index}">
                    <div class="mt-1">
                            <span class="text-danger"></span>
                    </div>
                </div>

                <div class="d-flex align-items-center col-md-1" id="botaoDelete">  
                    <a onclick="remove(${index})">  
                        <i class="fas fa-2x fa-times btn icon__exit--epi"></i>
                    </a>
                </div>

            </div>`
            
        return conteiner;

    }

    function alerta() {
        
        Swal.fire({
          position: 'error',
          icon: 'success',
          html: '<p class="modal__aviso">Não pode ser cadastrado mais de 20!</p>',
          background: '#45484A',
          showConfirmButton: true,
          timer: 2500,

        });

    }

    $(document).ready(function(){
        $('.numero').mask('00000000000');
        $('#adicinar').click(function () {
           
            if ($('#quantidade').val() <= 20) {
                index += 1;
                let quantidade =  parseInt($('#quantidade').val());
                $('#conteiner').append(conteiner(quantidade));
                $('.numero').mask('00000000000');
                $('#quantidade').val(quantidade + 1);
            }else{
                alerta()
                $(this).addClass('disabled')
            }
        })
    });
            