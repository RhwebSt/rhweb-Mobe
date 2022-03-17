$(document).ready(function(){
    var data =  
       `cpfcnpjtransmissor=34350915000149
        cpfcnpjempregador=34350915000149
        idgrupoeventos=1
        versaomanual=2.5.00
        ambiente=2
        INCLUIRS1020
        tpAmb_4=1
        procEmi_5=1
        verProc_6=1.0.0
        tpInsc_8=1
        nrInsc_9=47287717
        codLotacao_13=000003
        iniValid_14=202203
        fimValid_15=
        tpLotacao_17=09
        tpInsc_18=1
        nrInsc_19=47287717000120
        fpas_21=515
        codTercs_22=0115
        SALVARS1020`;
    $.ajax({
        url: "https://api.tecnospeed.com.br/esocial/v1/evento/gerar/xml",
        dataType: 'json',
        type: "post",
        headers: {
            "content-type": "text/tx2",
            "cnpj_sh":"34350915000149",
            "token_sh":"3048136792bc6c57aecab949f3f79b74",
            "empregador":"26844068000140"
        },
        data: JSON.stringify(data),
        processData: false,
        // beforeSend: function (){
        //     console.log("Waiting...");
        // },
        error: function() {
            console.log("Error");
        },
        success: function (data){
            console.log(data);
        }
    });
})