$(document).ready(function(){
    $('#banco-input').change(function () {
       
        let dados = $(this).val()
        $.ajax({
            url: "https://brasilapi.com.br/api/banks/v1/"+dados,
            type: 'get',
            contentType: 'application/json',
            success: function(data) {
                $("#banco-input").removeClass('is-valid').val(`${data.code} - ${data.name}`)
                // $('#menssagem-banco').toogleClass('valid-feedback invalid-feedback')
                
            },
            error: function(data){
                // $("#banco").addClass('is-invalid')
                // $('#menssagem-banco').text(data.responseJSON.message).removeClass('valid-feedback').addClass('invalid-feedback')
            }
        })
    })
})