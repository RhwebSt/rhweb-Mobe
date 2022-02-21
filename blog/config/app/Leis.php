<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leis extends Model
{
    public function categorias()
    {
        $primeiroTextoCategoria = ["101-Trabalhador geral contratado pela CLT conforme a Lei N° 9.601/1998",
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
        "904-Participante de curso de formação conforme Lei N° 11.273/2006"];


        $segundoTextoCategoria = ["101-Dispõe sobre o contrato de trabalho por prazo determinado e dá outras providências. Sob a categoria 101",
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
        "904-Dispõe sobre a atividade da categoria 904"];
        return[
            $primeiroTextoCategoria,
            $segundoTextoCategoria
        ];
    }
}
