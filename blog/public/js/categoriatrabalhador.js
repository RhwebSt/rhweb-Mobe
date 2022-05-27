let  categoriatrabalhador = [
"101-Empregado Geral inclusive o empregado público da administração direta ou indireta contratado pela CLT",
"102-Empregado Trabalhador rural por pequeno prazo da Lei 11.718/2008",
"103-Empregado Aprendiz",
"104-Empregado Doméstico",
"105-Empregado Contrato a termo firmado nos termos da Lei 9.601/1998",
"106-Trabalhador temporário Contrato nos termos da Lei 6.019/1974",
"107-Empregado Contrato de trabalho Verde e Amarelo sem acordo para antecipação mensal da multa rescisória do FGTS",
"108-Empregado Contrato de trabalho Verde e Amarelo com acordo para antecipação mensal da multa rescisória do FGTS",
"111-Empregado Contrato de trabalho intermitente",
"201-Trabalhador avulso portuário",
"202-Trabalhador avulso não portuário",
"301-Servidor público titular de cargo efetivo magistrado ministro de Tribunal de Contas conselheiro de Tribunal de Contas e membro do Ministério Público",
"302-Servidor público ocupante de cargo exclusivo em comissão", 
"303-Exercente de mandato eletivo",
"304-Servidor público exercente de mandato eletivo, inclusive com exercício de cargo em comissão",
"305-Servidor público indicado para conselho ou órgão deliberativo na condição de representante do governo órgão ou entidade da administração pública",
"306-Servidor público contratado por tempo determinado sujeito a regime administrativo especial definido em lei própria",
"307-Militar", 
"308-Conscrito", 
"309-Agente público Outros", 
"310-Servidor público eventual",
"311-Ministros juízes procuradores promotores ou oficiais de justiça à disposição da Justiça Eleitoral",
"312-Auxiliar local", 
"313-Servidor público exercente de atividade de instrutoria capacitação treinamento-curso ou concurso-ou convocado para pareceres técnicos ou depoimentos", 
"401-Dirigente Sindical informação prestada pelo sindicato",
"410-Trabalhador cedido/exercício em outro órgão/juiz auxiliar Informação prestada pelo cessionário/destino",
"701-Contribuinte individual Autônomo em geral exceto se enquadrado em uma das demais categorias de contribuinte individual",
"711-Contribuinte individual Transportador autônomo de passageiros",
"712-Contribuinte individual Transportador autônomo de carga",
"721-Contribuinte individual Diretor não empregado, com FGTS",
"722-Contribuinte individual Diretor não empregado, sem FGTS",
"723-Contribuinte individual Empresário sócio e membro de conselho de administração ou fiscal", 
"731-Contribuinte individual Cooperado que presta serviços por intermédio de cooperativa de trabalho",
"734-Contribuinte individual Transportador cooperado que presta serviços por intermédio de cooperativa de trabalho",
"738-Contribuinte individual Cooperado filiado a cooperativa de produção",
"741-Contribuinte individual Microempreendedor individual",
"751-Contribuinte individual Magistrado classista temporário da Justiça do Trabalho ou da Justiça Eleitoral que seja aposentado de qualquer regime previdenciário",
"761-Contribuinte individual Associado eleito para direção de cooperativa, associação ou entidade de classe de qualquer natureza ou finalidade bem como o síndico ou administrador eleito para exercer atividade de direção condominial desde que recebam remuneração",
"771-Contribuinte individual Membro de conselho tutelar nos termos da Lei 8.069/1990",
"781-Ministro de confissão religiosa ou membro de vida consagrada, de congregação ou de ordem religiosa",
"901-Estagiário",
"902-Médico residente",
"903-Bolsista, nos termos da Lei 8.958/1994",
"904-Participante de curso de formação, como etapa de concurso público, sem vínculo de emprego/estatutário"]


let primeiroTextoCategoria = [
"101-Trabalhador geral contratado pela CLT conforme a Lei N° 9.601/1998",
"102-Trabalhador rural por pequeno prazo da Lei 11.718/2008",
"103-Trabalhador aprendiz conforme a Lei N°10.097/2000",
"104-Trabalhador doméstico conforme a Lei Complementar Nº150, de 1 de Junho de 2015",
"105-Trabalhador por Contrato a termo firmado nos termos da Lei 9.601/1998",
"106-Trabalhador Temporário conforme a Lei 6.017/1974",
"111-Trabalhador Empegrado Contrato de Trabalho Intermitente",
"201-Trabalhador avulso portuário conforme a Lei N° 9.719/1998",
"202-Trabalhador avulso não portuário conforme a Lei 12.023/2009",
"301-Servidor publico de cargo efetivo conforme a Lei 8.112/1990",
"302-Servidor público ocupante de cargo exclusivo em comissão conforme a Lei 8.647/1993",
"304-Servidor Exercente de mandato eletivo conforme a Lei 8.213/1991",
"305-Servidor publico indicado para conselho ou órgão deliberativo conforme a Lei N° 10.887/2004",
"306-Servidor publico contratado por tempo determinado conforme a Lei N° 8.745/1993",
"307-Trabalhador Militar conforme Lei N° 13.954/2019",
"308-Trabalhador conscrito conforme a Lei N° 57.654/1966",
"309-Agente publico conforme a Lei N° 8.429/1992",
"310-Servidor público exercente de atividade de instrutoria conforme Decreto N°6.114/2007",
"311-Servidor público Ministros juízes procuradores promotores ou oficiais de justiça à disposição da Justiça Eleitoral",
"312-Trabalhador Auxiliar local",
"313-Servidor público exercente de atividade de instrutoria capacitação treinamento-curso ou concurso-ou convocado para pareceres técnicos ou depoimentos",
"401-Dirigente sindical conforme Decreto N° 9.502/1946",
"410-Trabalhador cedido/exercício em outro órgão/juiz auxiliar conforme Lei N° 7.064/1982",
"701-Contribuinte individual - Autônomo em geral conforme a lei N° .890/1973",
"711-Contribuinte individual - Transportador autônomo conforme a Lei N° 11.442/2007",
"712-Contribuinte individual - Transportador autônomo conforme a Lei N° 11.442/2007",
"721-Contribuinte individual – Diretor não empregado conforme a lei N 6.919/1981",
"722-Contribuinte individual – Diretor não empregado conforme a lei N 6.919/1981",
"731-Contribuinte individual Cooperado que presta serviços por intermédio de cooperativa de trabalho",
"734-Contribuinte individual Transportador cooperado que presta serviços por intermédio de cooperativa de trabalho",
"738-Contribuinte individual Cooperado filiado a cooperativa de produção",
"741-Contribuinte individual – Microempreendedor individual conforme a Lei Complementar N° 128/ 2008",
"751-Contribuinte individual - Magistrado classista temporário conforme a Lei N° 7.119/1983",
"761-Contribuinte individual - Associado eleito para direção de cooperativa conforme a Lei N° 9.876/1999",
"771-Contribuinte individual – Membro de conselho tutelar conforme Lei N° 13.824/2019",
"781-Ministro de confissão religiosa ou membro de vida consagrada conforme a Lei N° 6.696/1979",
"901-Estagiário conforme a Lei N° 11.788/2008 ",
"902-Medico residente conforme a Lei N° 6.932/1981",
"903-Bolsista nos termos da Lei N° 8.958/1994",
"904-Participante de curso de formação conforme Lei N° 11.273/2006"]


let segundoTextoCategoria = [
"101-Dispõe sobre o contrato de trabalho por prazo determinado e dá outras providências. Sob a categoria 101",
"102-Dispõe sobre a categoria 102 e estabelece normas transitórias sobre a aposentadoria do trabalhador rural; prorroga o prazo de contratação de financiamentos rurais de que trata o § 6o do art.",
"103-Dispõe sobre a atividade da categoria 103",
"104-Dispõe sobre a atividade da categoria 104",
"105-Dispõe sobre o contrato de trabalho por prazo determinado e dá outras providências. Categoria 105",
"106-Dispõe sobre o Trabalho Temporário nas Empresas Urbanas, e dá outras Providências. Categoria 106",
"111-Dispõe sobre a atividade de Trabalhadores categoria 111",
"201-Dispõe sobre normas e condições gerais de proteção ao trabalho portuário. Categoria 201",
"202-se caracteriza pela intermediação obrigatória do sindicato profissional nos termos de instrumento coletivo negociado. Categoria 202",
"301-Dispõe sobre o regime jurídico dos servidores públicos civis da União, das autarquias e das fundações públicas federais. Categoria 301",
"302-Dispõe sobre a vinculação do servidor público civil, ocupante de cargo em comissão sem vínculo efetivo com a Administração Pública Federal, ao Regime Geral de Previdência Social e dá outras providências. Categoria 302",
"304-Dispõe sobre os Planos de Benefícios da Previdência Social e dá outras providências. Categoria 304",
"305-Dispõe sobra a atividade da categoria 305",
"306-Dispõe sobre a contratação por tempo determinado para atender a necessidade temporária de excepcional interesse público. Categoria 306",
"307-Dispõe sobre a atividade da categoria 307",
"308-Dispõe sobre a atividade da categoria 308",
"309-Dispõe sobre a atividade da categoria 309",
"311-Dispõe sobre a atividade da categoria 311",
"312-Dispõe sobre a atividade da categoria 312",
"313-Dispõe sobre a atividade da categoria 313",
"401-Dispõe sobre a atividade da categoria 401",
"410-Dispõe sobre a atividade da categoria 410",
"701-Dispõe sobre a atividade da categoria 701",
"711-Dispõe sobre a atividade da categoria 711",
"712-Dispõe sobre a atividade da categoria 712",
"721-Dispõe sobre a atividade da categoria 721",
"722-Dispõe sobre a atividade da categoria 722",
"731-Dispõe sobre a atividade da categoria 731",
"734-Dispõe sobre a atividade da categoria 734",
"738-Dispõe sobre a atividade da categoria 738",
"741-Dispõe sobre a atividade da categoria 741",
"751-Dispõe sobre a atividade da categoria 751",
"761-Dispõe sobre a atividade da categoria 761",
"771-Dispõe sobre a atividade da categoria 771",
"781-Dispõe sobre a atividade da categoria 781",
"901-Dispõe sobre a atividade da categoria 901",
"902-Dispõe sobre a atividade da categoria 902",
"903-Dispõe sobre a atividade da categoria 903",
"904-Dispõe sobre a atividade da categoria 904"]

// categoriatrabalhador.forEach((element,index) => {
//     let categoriatrabalhador = element.split('-');
//     let primeira = '';
//     let segunda = '';
//     primeiroTextoCategoria.forEach(p => {
//         if (p.indexOf(categoriatrabalhador[0]) !== -1) {
//             primeira = p.split('-')
//         }
//     });
//     segundoTextoCategoria.forEach(s => {
//         if (s.indexOf(categoriatrabalhador[0]) !== -1) {
//             segunda = s.split('-')
//         }
//     });
   
//     $.ajax({
//         url: "http://127.0.0.1:8000/administrador/categoria",
//         type: 'POST',
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         data:{
//             'codigo__categoria':categoriatrabalhador[0],
//             'descricao__categoria':categoriatrabalhador[1],
//             'texto1':primeira[1],
//             'codigo__cbo':primeira[0],
//             'codigo__cbo2':segunda[0],
//             'texto2':segunda[1],
//             'classes':'',
//             'user':''
//         },
//         // contentType: 'application/json',
//         success: function(data) {
//             // let nome = ''
//             // data.forEach(element => {
//             //     nome += `<option value="${element.cscodigo}-${element.csdescricao}">`
//             //     // nome += `<option value="${element.csdescricao}">`
//             // });
//             // $('#cbo_list').html(nome)
//         }
//     })
// });



