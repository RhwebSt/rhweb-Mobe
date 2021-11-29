let cbo = [
    {
        "code": "0101",
        "name": "Oficiais generais das for\u00e7as armadas"
    },
    {
        "code": "0102",
        "name": "Oficiais das for\u00e7as armadas"
    },
    {
        "code": "0103",
        "name": "Pra\u00e7as das for\u00e7as armadas"
    },
    {
        "code": "0201",
        "name": "Oficiais superiores da pol\u00edcia militar"
    },
    {
        "code": "0202",
        "name": "Capit\u00e3es da  pol\u00edcia militar"
    },
    {
        "code": "0203",
        "name": "Tenentes da pol\u00edcia militar"
    },
    {
        "code": "0211",
        "name": "Subtenentes e sargentos da policia militar"
    },
    {
        "code": "0212",
        "name": "Cabos e soldados da pol\u00edcia militar"
    },
    {
        "code": "0301",
        "name": "Oficiais superiores do corpo de bombeiros militar"
    },
    {
        "code": "0302",
        "name": "Oficiais intermedi\u00e1rios do corpo de bombeiros militar"
    },
    {
        "code": "0303",
        "name": "Tenentes do corpo de bombeiros militar"
    },
    {
        "code": "0311",
        "name": "Subtenentes e sargentos do corpo de bombeiros militar"
    },
    {
        "code": "0312",
        "name": "Cabos e soldados do corpo de bombeiros militar"
    },
    {
        "code": "1111",
        "name": "Legisladores"
    },
    {
        "code": "1112",
        "name": "Dirigentes gerais da administra\u00e7\u00e3o p\u00fablica"
    },
    {
        "code": "1113",
        "name": "Magistrados"
    },
    {
        "code": "1114",
        "name": "Dirigentes do servi\u00e7o p\u00fablico"
    },
    {
        "code": "1115",
        "name": "Gestores p\u00fablicos"
    },
    {
        "code": "1130",
        "name": "Dirigentes de povos ind\u00edgenas, de quilombolas e cai\u00e7aras"
    },
    {
        "code": "1141",
        "name": "Dirigentes de partidos pol\u00edticos"
    },
    {
        "code": "1142",
        "name": "Dirigentes e administradores de entidades patronais e dos trabalhadores e de outros interesses s\u00f3cioecon\u00f4micos"
    },
    {
        "code": "1143",
        "name": "Dirigentes e administradores de entidades religiosas"
    },
    {
        "code": "1144",
        "name": "Dirigentes e administradores de organiza\u00e7\u00f5es da sociedade civil sem fins lucrativos"
    },
    {
        "code": "1210",
        "name": "Diretores gerais"
    },
    {
        "code": "1221",
        "name": "Diretores de produ\u00e7\u00e3o e opera\u00e7\u00f5es em empresa agropecu\u00e1ria, pesqueira , aq\u00fc\u00edcola e florestal"
    },
    {
        "code": "1222",
        "name": "Diretores de produ\u00e7\u00e3o e opera\u00e7\u00f5es em empresa da ind\u00fastria extrativa, transforma\u00e7\u00e3o e de servi\u00e7os de utilidade p\u00fablica"
    },
    {
        "code": "1223",
        "name": "Diretores de opera\u00e7\u00f5es de obras em empresa de constru\u00e7\u00e3o"
    },
    {
        "code": "1224",
        "name": "Diretores de opera\u00e7\u00f5es em empresa do com\u00e9rcio"
    },
    {
        "code": "1225",
        "name": "Diretores de servi\u00e7os de turismo, de alojamento e de alimenta\u00e7\u00e3o"
    },
    {
        "code": "1226",
        "name": "Diretores de opera\u00e7\u00f5es de servi\u00e7os em empresa de armazenamento, de transporte e de telecomunica\u00e7\u00e3o"
    },
    {
        "code": "1227",
        "name": "Diretores de opera\u00e7\u00f5es de servi\u00e7os em institui\u00e7\u00e3o de intermedia\u00e7\u00e3o financeira"
    },
    {
        "code": "1231",
        "name": "Diretores administrativos e financeiros"
    },
    {
        "code": "1232",
        "name": "Diretores de recursos humanos e rela\u00e7\u00f5es de trabalho"
    },
    {
        "code": "1233",
        "name": "Diretores de comercializa\u00e7\u00e3o e marketing"
    },
    {
        "code": "1234",
        "name": "Diretores de suprimentos e afins"
    },
    {
        "code": "1236",
        "name": "Diretores de servi\u00e7os de inform\u00e1tica"
    },
    {
        "code": "1237",
        "name": "Diretores de pesquisa e desenvolvimento"
    },
    {
        "code": "1238",
        "name": "Diretores de manuten\u00e7\u00e3o"
    },
    {
        "code": "1311",
        "name": "Diretores e gerentes de opera\u00e7\u00f5es em empresa de servi\u00e7os pessoais, sociais e culturais"
    },
    {
        "code": "1312",
        "name": "Gestores e especialistas de opera\u00e7\u00f5es em empresas, secretarias e unidades de servi\u00e7os de sa\u00fade"
    },
    {
        "code": "1313",
        "name": "Diretores e gerentes de institui\u00e7\u00e3o de servi\u00e7os educacionais"
    },
    {
        "code": "1411",
        "name": "Gerentes de produ\u00e7\u00e3o e opera\u00e7\u00f5es em empresa agropecu\u00e1ria, pesqueira, aq\u00fc\u00edcola e florestal"
    },
    {
        "code": "1412",
        "name": "Gerentes de produ\u00e7\u00e3o e opera\u00e7\u00f5es em empresa da ind\u00fastria extrativa, de transforma\u00e7\u00e3o e de servi\u00e7os de utilidade p\u00fablica"
    },
    {
        "code": "1413",
        "name": "Gerentes de obras em empresa de constru\u00e7\u00e3o"
    },
    {
        "code": "1414",
        "name": "Gerentes de opera\u00e7\u00f5es comerciais e de assist\u00eancia t\u00e9cnica"
    },
    {
        "code": "1415",
        "name": "Gerentes de opera\u00e7\u00f5es de servi\u00e7os em empresa de turismo, de alojamento e alimenta\u00e7\u00e3o"
    },
    {
        "code": "1416",
        "name": "Gerentes de opera\u00e7\u00f5es de servi\u00e7os em empresa de transporte, de comunica\u00e7\u00e3o e de log\u00edstica (armazenagem e distribui\u00e7\u00e3o)"
    },
    {
        "code": "1417",
        "name": "Gerentes de opera\u00e7\u00f5es de servi\u00e7os em institui\u00e7\u00e3o de intermedia\u00e7\u00e3o financeira"
    },
    {
        "code": "1421",
        "name": "Gerentes administrativos, financeiros, de riscos e afins"
    },
    {
        "code": "1422",
        "name": "Gerentes de recursos humanos e de rela\u00e7\u00f5es do trabalho"
    },
    {
        "code": "1423",
        "name": "Gerentes de comercializa\u00e7\u00e3o, marketing e comunica\u00e7\u00e3o"
    },
    {
        "code": "1424",
        "name": "Gerentes de suprimentos e afins"
    },
    {
        "code": "1425",
        "name": "Gerentes de tecnologia da informa\u00e7\u00e3o"
    },
    {
        "code": "1426",
        "name": "Gerentes de pesquisa e desenvolvimento e afins"
    },
    {
        "code": "1427",
        "name": "Gerentes de manuten\u00e7\u00e3o e afins"
    },
    {
        "code": "2011",
        "name": "Profissionais da biotecnologia"
    },
    {
        "code": "2012",
        "name": "Profissionais da metrologia"
    },
    {
        "code": "2021",
        "name": "Engenheiros de controle e automa\u00e7\u00e3o, engenheiros mecatr\u00f4nicos e afins"
    },
    {
        "code": "2030",
        "name": "Pesquisadores das ci\u00eancias biol\u00f3gicas"
    },
    {
        "code": "2031",
        "name": "Pesquisadores das ci\u00eancias naturais e exatas"
    },
    {
        "code": "2032",
        "name": "Pesquisadores de engenharia e tecnologia"
    },
    {
        "code": "2033",
        "name": "Pesquisadores das ci\u00eancias da sa\u00fade"
    },
    {
        "code": "2034",
        "name": "Pesquisadores das ci\u00eancias da agricultura"
    },
    {
        "code": "2035",
        "name": "Pesquisadores das ci\u00eancias sociais e humanas"
    },
    {
        "code": "2041",
        "name": "Peritos criminais"
    },
    {
        "code": "2111",
        "name": "Profissionais da matem\u00e1tica"
    },
    {
        "code": "2112",
        "name": "Profissionais de estat\u00edstica"
    },
    {
        "code": "2122",
        "name": "Engenheiros em computa\u00e7\u00e3o"
    },
    {
        "code": "2123",
        "name": "Administradores de tecnologia da informa\u00e7\u00e3o"
    },
    {
        "code": "2124",
        "name": "Analistas de tecnologia da informa\u00e7\u00e3o"
    },
    {
        "code": "2131",
        "name": "F\u00edsicos"
    },
    {
        "code": "2132",
        "name": "Qu\u00edmicos"
    },
    {
        "code": "2133",
        "name": "Profissionais das ci\u00eancias atmosf\u00e9ricas e espaciais e de astronomia"
    },
    {
        "code": "2134",
        "name": "Ge\u00f3logos, ocean\u00f3grafos, geof\u00edsicos e afins"
    },
    {
        "code": "2140",
        "name": "Engenheiros ambientais e afins"
    },
    {
        "code": "2141",
        "name": "Arquitetos e urbanistas"
    },
    {
        "code": "2142",
        "name": "Engenheiros civis e afins"
    },
    {
        "code": "2143",
        "name": "Engenheiros eletricistas, eletr\u00f4nicos e afins"
    },
    {
        "code": "2144",
        "name": "Engenheiros mec\u00e2nicos e afins"
    },
    {
        "code": "2145",
        "name": "Engenheiros qu\u00edmicos e afins"
    },
    {
        "code": "2146",
        "name": "Engenheiros metalurgistas, de materiais e afins"
    },
    {
        "code": "2147",
        "name": "Engenheiros de minas e afins"
    },
    {
        "code": "2148",
        "name": "Engenheiros agrimensores e engenheiros cart\u00f3grafos"
    },
    {
        "code": "2149",
        "name": "Engenheiros de produ\u00e7\u00e3o, qualidade, seguran\u00e7a e afins"
    },
    {
        "code": "2151",
        "name": "Oficiais de conv\u00e9s e afins"
    },
    {
        "code": "2152",
        "name": "Oficiais de m\u00e1quinas da marinha mercante"
    },
    {
        "code": "2153",
        "name": "Profissionais da pilotagem aeron\u00e1utica"
    },
    {
        "code": "2211",
        "name": "Bi\u00f3logos e afins"
    },
    {
        "code": "2212",
        "name": "Biom\u00e9dicos"
    },
    {
        "code": "2221",
        "name": "Engenheiros agrossilvipecu\u00e1rios"
    },
    {
        "code": "2222",
        "name": "Engenheiros de alimentos e afins"
    },
    {
        "code": "2232",
        "name": "Cirurgi\u00f5es-dentistas"
    },
    {
        "code": "2233",
        "name": "Veterin\u00e1rios e zootecnistas"
    },
    {
        "code": "2234",
        "name": "Farmac\u00eauticos"
    },
    {
        "code": "2235",
        "name": "Enfermeiros e afins"
    },
    {
        "code": "2236",
        "name": "Fisioterapeutas"
    },
    {
        "code": "2237",
        "name": "Nutricionistas"
    },
    {
        "code": "2238",
        "name": "Fonoaudi\u00f3logos"
    },
    {
        "code": "2239",
        "name": "Terapeutas ocupacionais e ortoptistas"
    },
    {
        "code": "2241",
        "name": "Profissionais da educa\u00e7\u00e3o f\u00edsica"
    },
    {
        "code": "2251",
        "name": "M\u00e9dicos cl\u00ednicos"
    },
    {
        "code": "2252",
        "name": "M\u00e9dicos em especialidades cir\u00fargicas"
    },
    {
        "code": "2253",
        "name": "M\u00e9dicos em medicina diagn\u00f3stica e terap\u00eautica"
    },
    {
        "code": "2261",
        "name": "Osteopatas e quiropraxistas"
    },
    {
        "code": "2263",
        "name": "Profissionais das terapias criativas,equoter\u00e1picas e naturol\u00f3gicas"
    },
    {
        "code": "2311",
        "name": "Professores de n\u00edvel superior na educa\u00e7\u00e3o infantil"
    },
    {
        "code": "2312",
        "name": "Professores de n\u00edvel superior do ensino fundamental (primeira a quarta s\u00e9ries)"
    },
    {
        "code": "2313",
        "name": "Professores de n\u00edvel superior no ensino fundamental de quinta a oitava s\u00e9rie"
    },
    {
        "code": "2321",
        "name": "Professores do ensino m\u00e9dio"
    },
    {
        "code": "2331",
        "name": "Professores do ensino profissional"
    },
    {
        "code": "2332",
        "name": "Instrutores de ensino profissional"
    },
    {
        "code": "2341",
        "name": "Professores de matem\u00e1tica, estat\u00edstica e inform\u00e1tica do ensino superior"
    },
    {
        "code": "2342",
        "name": "Professores de ci\u00eancias f\u00edsicas, qu\u00edmicas e afins do ensino superior"
    },
    {
        "code": "2343",
        "name": "Professores de arquitetura e urbanismo, engenharia, geof\u00edsica e geologia do ensino superior"
    },
    {
        "code": "2344",
        "name": "Professores de ci\u00eancias biol\u00f3gicas e da sa\u00fade do ensino superior"
    },
    {
        "code": "2345",
        "name": "Professores na \u00e1rea de forma\u00e7\u00e3o pedag\u00f3gica do ensino superior"
    },
    {
        "code": "2346",
        "name": "Professores nas \u00e1reas de l\u00edngua e literatura do ensino superior"
    },
    {
        "code": "2347",
        "name": "Professores de ci\u00eancias humanas do ensino superior"
    },
    {
        "code": "2348",
        "name": "Professores de ci\u00eancias econ\u00f4micas, administrativas e cont\u00e1beis do ensino superior"
    },
    {
        "code": "2349",
        "name": "Professores de artes do ensino superior"
    },
    {
        "code": "2392",
        "name": "Professores de educa\u00e7\u00e3o especial"
    },
    {
        "code": "2394",
        "name": "Programadores, avaliadores e orientadores de ensino"
    },
    {
        "code": "2410",
        "name": "Advogados"
    },
    {
        "code": "2412",
        "name": "Procuradores e advogados p\u00fablicos"
    },
    {
        "code": "2413",
        "name": "Tabeli\u00e3es e registradores"
    },
    {
        "code": "2422",
        "name": "Membros do minist\u00e9rio p\u00fablico"
    },
    {
        "code": "2423",
        "name": "Delegados de pol\u00edcia"
    },
    {
        "code": "2424",
        "name": "Defensores p\u00fablicos e procuradores da assist\u00eancia judici\u00e1ria"
    },
    {
        "code": "2429",
        "name": "Profissionais da intelig\u00eancia"
    },
    {
        "code": "2511",
        "name": "Profissionais em pesquisa e an\u00e1lise antropol\u00f3gica sociol\u00f3gica"
    },
    {
        "code": "2512",
        "name": "Economistas"
    },
    {
        "code": "2513",
        "name": "Profissionais em pesquisa e an\u00e1lise geogr\u00e1fica"
    },
    {
        "code": "2514",
        "name": "Fil\u00f3sofos"
    },
    {
        "code": "2515",
        "name": "Psic\u00f3logos e psicanalistas"
    },
    {
        "code": "2516",
        "name": "Assistentes sociais e economistas dom\u00e9sticos"
    },
    {
        "code": "2521",
        "name": "Administradores"
    },
    {
        "code": "2522",
        "name": "Contadores e afins"
    },
    {
        "code": "2523",
        "name": "Secret\u00e1rias(os) executivas(os) e afins"
    },
    {
        "code": "2524",
        "name": "Profissionais de recursos humanos"
    },
    {
        "code": "2525",
        "name": "Profissionais de administra\u00e7\u00e3o ec\u00f4nomico-financeira"
    },
    {
        "code": "2526",
        "name": "Profissionais da administra\u00e7\u00e3o dos servi\u00e7os de seguran\u00e7a"
    },
    {
        "code": "2527",
        "name": "Profissionais de planejamento, programa\u00e7\u00e3o e controles logisticos"
    },
    {
        "code": "2531",
        "name": "Profissionais de publicidade"
    },
    {
        "code": "2532",
        "name": "Profissionais de comercializac\u00e3o e consultoria de servi\u00e7os banc\u00e1rios"
    },
    {
        "code": "2533",
        "name": "Corretores de valores, ativos financeiros, mercadorias e derivativos"
    },
    {
        "code": "2541",
        "name": "Auditores fiscais e t\u00e9cnicos da receita federal"
    },
    {
        "code": "2542",
        "name": "Auditores fiscais da previd\u00eancia social"
    },
    {
        "code": "2543",
        "name": "Auditores fiscais do trabalho"
    },
    {
        "code": "2544",
        "name": "Fiscais de tributos estaduais e municipais"
    },
    {
        "code": "2545",
        "name": "Profissionais da fiscaliza\u00e7\u00e3o de atividades urbanas"
    },
    {
        "code": "2611",
        "name": "Profissionais do jornalismo"
    },
    {
        "code": "2612",
        "name": "Profissionais da informa\u00e7\u00e3o"
    },
    {
        "code": "2613",
        "name": "Arquivistas e muse\u00f3logos"
    },
    {
        "code": "2614",
        "name": "Fil\u00f3logos,tradutores ,int\u00e9rpretes e afins"
    },
    {
        "code": "2615",
        "name": "Profissionais da escrita"
    },
    {
        "code": "2616",
        "name": "Editores"
    },
    {
        "code": "2617",
        "name": "Locutores, comentaristas e rep\u00f3rteres de r\u00e1dio e televis\u00e3o"
    },
    {
        "code": "2618",
        "name": "Fot\u00f3grafos profissionais"
    },
    {
        "code": "2621",
        "name": "Produtores art\u00edsticos e culturais"
    },
    {
        "code": "2622",
        "name": "Diretores de espet\u00e1culos e afins"
    },
    {
        "code": "2623",
        "name": "Cen\u00f3grafos"
    },
    {
        "code": "2624",
        "name": "Artistas visuais,desenhistas industriais e conservadores-restauradores de bens culturais"
    },
    {
        "code": "2625",
        "name": "Atores"
    },
    {
        "code": "2626",
        "name": "M\u00fasicos compositores, arranjadores, regentes e music\u00f3logos"
    },
    {
        "code": "2627",
        "name": "M\u00fasicos int\u00e9rpretes"
    },
    {
        "code": "2628",
        "name": "Artistas da dan\u00e7a (exceto dan\u00e7a tradicional e popular)"
    },
    {
        "code": "2629",
        "name": "Designer de interiores de n\u00edvel superior"
    },
    {
        "code": "2631",
        "name": "Ministros de culto, mission\u00e1rios, te\u00f3logos e profissionais assemelhados"
    },
    {
        "code": "2711",
        "name": "Chefes de cozinha e afins"
    },
    {
        "code": "3001",
        "name": "T\u00e9cnicos em mecatr\u00f4nica"
    },
    {
        "code": "3003",
        "name": "T\u00e9cnicos em eletromec\u00e2nica"
    },
    {
        "code": "3011",
        "name": "T\u00e9cnicos de laborat\u00f3rio industrial"
    },
    {
        "code": "3012",
        "name": "T\u00e9cnicos de apoio \u00e0 bioengenharia"
    },
    {
        "code": "3111",
        "name": "T\u00e9cnicos qu\u00edmicos"
    },
    {
        "code": "3112",
        "name": "T\u00e9cnicos de produ\u00e7\u00e3o de ind\u00fastrias qu\u00edmicas, petroqu\u00edmicas, refino de petr\u00f3leo, g\u00e1s e afins"
    },
    {
        "code": "3113",
        "name": "T\u00e9cnicos em materiais, produtos cer\u00e2micos e vidros"
    },
    {
        "code": "3114",
        "name": "T\u00e9cnicos em fabrica\u00e7\u00e3o de produtos pl\u00e1sticos e de borracha"
    },
    {
        "code": "3115",
        "name": "T\u00e9cnicos em controle ambiental, utilidades e tratamento de efluentes"
    },
    {
        "code": "3116",
        "name": "T\u00e9cnicos t\u00eaxteis"
    },
    {
        "code": "3117",
        "name": "Coloristas"
    },
    {
        "code": "3121",
        "name": "T\u00e9cnicos em constru\u00e7\u00e3o civil (edifica\u00e7\u00f5es)"
    },
    {
        "code": "3122",
        "name": "T\u00e9cnicos em constru\u00e7\u00e3o civil (obras de infraestrutura)"
    },
    {
        "code": "3123",
        "name": "T\u00e9cnicos em geom\u00e1tica"
    },
    {
        "code": "3131",
        "name": "T\u00e9cnicos em eletricidade e eletrot\u00e9cnica"
    },
    {
        "code": "3132",
        "name": "T\u00e9cnicos em eletr\u00f4nica"
    },
    {
        "code": "3133",
        "name": "T\u00e9cnicos em telecomunica\u00e7\u00f5es"
    },
    {
        "code": "3134",
        "name": "T\u00e9cnicos em calibra\u00e7\u00e3o e instrumenta\u00e7\u00e3o"
    },
    {
        "code": "3135",
        "name": "T\u00e9cnicos em fot\u00f4nica"
    },
    {
        "code": "3141",
        "name": "T\u00e9cnicos mec\u00e2nicos na fabrica\u00e7\u00e3o e montagem de m\u00e1quinas, sistemas e instrumentos"
    },
    {
        "code": "3142",
        "name": "T\u00e9cnicos mec\u00e2nicos (ferramentas)"
    },
    {
        "code": "3143",
        "name": "T\u00e9cnicos em mec\u00e2nica veicular"
    },
    {
        "code": "3144",
        "name": "T\u00e9cnicos mec\u00e2nicos na manuten\u00e7\u00e3o de m\u00e1quinas, sistemas e instrumentos"
    },
    {
        "code": "3146",
        "name": "T\u00e9cnicos em metalurgia (estruturas met\u00e1licas)"
    },
    {
        "code": "3147",
        "name": "T\u00e9cnicos em siderurgia"
    },
    {
        "code": "3161",
        "name": "T\u00e9cnicos em geologia"
    },
    {
        "code": "3163",
        "name": "T\u00e9cnicos em minera\u00e7\u00e3o"
    },
    {
        "code": "3171",
        "name": "T\u00e9cnicos de desenvolvimento de sistemas e aplica\u00e7\u00f5es"
    },
    {
        "code": "3172",
        "name": "T\u00e9cnicos em opera\u00e7\u00e3o e monitora\u00e7\u00e3o de computadores"
    },
    {
        "code": "3180",
        "name": "Desenhistas t\u00e9cnicos, em geral"
    },
    {
        "code": "3181",
        "name": "Desenhistas t\u00e9cnicos da constru\u00e7\u00e3o civil e arquitetura"
    },
    {
        "code": "3182",
        "name": "Desenhistas t\u00e9cnicos da mec\u00e2nica"
    },
    {
        "code": "3183",
        "name": "Desenhistas t\u00e9cnicos em eletricidade, eletr\u00f4nica, eletromec\u00e2nica, calefa\u00e7\u00e3o, ventila\u00e7\u00e3o e refrigera\u00e7\u00e3o"
    },
    {
        "code": "3184",
        "name": "Desenhistas t\u00e9cnicos de produtos e servi\u00e7os diversos"
    },
    {
        "code": "3185",
        "name": "Desenhistas projetistas de constru\u00e7\u00e3o civil e arquitetura"
    },
    {
        "code": "3186",
        "name": "Desenhistas projetistas da mec\u00e2nica"
    },
    {
        "code": "3187",
        "name": "Desenhistas projetistas da eletr\u00f4nica"
    },
    {
        "code": "3188",
        "name": "Desenhistas projetistas e modelistas de produtos e servi\u00e7os diversos"
    },
    {
        "code": "3191",
        "name": "T\u00e9cnicos do vestu\u00e1rio"
    },
    {
        "code": "3192",
        "name": "T\u00e9cnicos do mobili\u00e1rio e afins"
    },
    {
        "code": "3201",
        "name": "T\u00e9cnicos em biologia"
    },
    {
        "code": "3211",
        "name": "T\u00e9cnicos agr\u00edcolas"
    },
    {
        "code": "3212",
        "name": "T\u00e9cnicos florestais"
    },
    {
        "code": "3213",
        "name": "T\u00e9cnicos em aq\u00fcicultura"
    },
    {
        "code": "3221",
        "name": "Tecn\u00f3logos e t\u00e9cnicos em terapias complementares e est\u00e9ticas"
    },
    {
        "code": "3222",
        "name": "T\u00e9cnicos e auxiliares de enfermagem"
    },
    {
        "code": "3223",
        "name": "T\u00e9cnicos em \u00f3ptica e optometria"
    },
    {
        "code": "3224",
        "name": "T\u00e9cnicos de odontologia"
    },
    {
        "code": "3225",
        "name": "T\u00e9cnicos em pr\u00f3teses ortop\u00e9dicas"
    },
    {
        "code": "3226",
        "name": "T\u00e9cnicos de imobiliza\u00e7\u00f5es ortop\u00e9dicas"
    },
    {
        "code": "3231",
        "name": "T\u00e9cnicos em pecu\u00e1ria"
    },
    {
        "code": "3241",
        "name": "Tecn\u00f3logos e t\u00e9cnicos em m\u00e9todos de diagn\u00f3sticos e terap\u00eautica"
    },
    {
        "code": "3242",
        "name": "T\u00e9cnicos de laborat\u00f3rios de sa\u00fade e bancos de sangue"
    },
    {
        "code": "3250",
        "name": "En\u00f3logos, perfumistas e aromistas"
    },
    {
        "code": "3251",
        "name": "T\u00e9cnico em farm\u00e1cia e em manipula\u00e7\u00e3o farmac\u00eautica"
    },
    {
        "code": "3252",
        "name": "T\u00e9cnicos em produ\u00e7\u00e3o, conserva\u00e7\u00e3o  e de qualidade de alimentos"
    },
    {
        "code": "3253",
        "name": "T\u00e9cnicos de apoio \u00e0 biotecnologia"
    },
    {
        "code": "3281",
        "name": "T\u00e9cnicos em necr\u00f3psia e taxidermistas"
    },
    {
        "code": "3311",
        "name": "Professores de n\u00edvel m\u00e9dio na educa\u00e7\u00e3o infantil"
    },
    {
        "code": "3312",
        "name": "Professores de n\u00edvel m\u00e9dio no ensino fundamental"
    },
    {
        "code": "3313",
        "name": "Professores de n\u00edvel m\u00e9dio no ensino profissionalizante"
    },
    {
        "code": "3321",
        "name": "Professores leigos no ensino fundamental"
    },
    {
        "code": "3322",
        "name": "Professores pr\u00e1ticos no ensino profissionalizante"
    },
    {
        "code": "3331",
        "name": "Instrutores e professores de cursos livres"
    },
    {
        "code": "3341",
        "name": "Inspetores de alunos e afins"
    },
    {
        "code": "3411",
        "name": "Pilotos de avia\u00e7\u00e3o comercial, mec\u00e2nicos de v\u00f4o e afins"
    },
    {
        "code": "3412",
        "name": "T\u00e9cnicos mar\u00edtimos, fluvi\u00e1rios e pescadores de conv\u00e9s"
    },
    {
        "code": "3413",
        "name": "T\u00e9cnicos mar\u00edtimos e fluvi\u00e1rios de m\u00e1quinas"
    },
    {
        "code": "3421",
        "name": "Especialistas em log\u00edstica de transportes"
    },
    {
        "code": "3422",
        "name": "Despachantes aduaneiros"
    },
    {
        "code": "3423",
        "name": "T\u00e9cnicos em transportes rodovi\u00e1rios"
    },
    {
        "code": "3424",
        "name": "T\u00e9cnicos em transportes metroferrovi\u00e1rios"
    },
    {
        "code": "3425",
        "name": "T\u00e9cnicos em transportes a\u00e9reos"
    },
    {
        "code": "3426",
        "name": "T\u00e9cnicos em transportes por vias naveg\u00e1veis e opera\u00e7\u00f5es portu\u00e1rias"
    },
    {
        "code": "3511",
        "name": "T\u00e9cnicos em contabilidade"
    },
    {
        "code": "3513",
        "name": "T\u00e9cnicos em administra\u00e7\u00e3o"
    },
    {
        "code": "3514",
        "name": "Serventu\u00e1rios da justi\u00e7a e afins"
    },
    {
        "code": "3515",
        "name": "T\u00e9cnicos em secretariado, taqu\u00edgrafos e estenotipistas"
    },
    {
        "code": "3516",
        "name": "T\u00e9cnicos em seguran\u00e7a do trabalho"
    },
    {
        "code": "3517",
        "name": "T\u00e9cnicos de seguros e afins"
    },
    {
        "code": "3518",
        "name": "Agentes de investiga\u00e7\u00e3o e identifica\u00e7\u00e3o"
    },
    {
        "code": "3519",
        "name": "T\u00e9cnicos da intelig\u00eancia"
    },
    {
        "code": "3522",
        "name": "Agentes da sa\u00fade e do meio ambiente"
    },
    {
        "code": "3523",
        "name": "Agentes  fiscais metrol\u00f3gicos e de qualidade"
    },
    {
        "code": "3524",
        "name": "Profissionais de direitos autorais e de avaliac\u00e3o de produtos dos meios de comunica\u00e7\u00e3o"
    },
    {
        "code": "3532",
        "name": "T\u00e9cnicos em opera\u00e7\u00f5es e servi\u00e7os banc\u00e1rios"
    },
    {
        "code": "3541",
        "name": "Especialistas em promo\u00e7\u00e3o de produtos e vendas"
    },
    {
        "code": "3542",
        "name": "Compradores"
    },
    {
        "code": "3543",
        "name": "Analistas de com\u00e9rcio exterior"
    },
    {
        "code": "3544",
        "name": "Leiloeiros e avaliadores"
    },
    {
        "code": "3545",
        "name": "Corretores de seguros"
    },
    {
        "code": "3546",
        "name": "Corretores de im\u00f3veis"
    },
    {
        "code": "3547",
        "name": "Representantes comerciais aut\u00f4nomos"
    },
    {
        "code": "3548",
        "name": "T\u00e9cnicos em servi\u00e7os de turismo e organiza\u00e7\u00e3o de eventos"
    },
    {
        "code": "3711",
        "name": "T\u00e9cnicos em biblioteconomia"
    },
    {
        "code": "3712",
        "name": "T\u00e9cnicos em museologia e afins"
    },
    {
        "code": "3713",
        "name": "T\u00e9cnicos em artes gr\u00e1ficas"
    },
    {
        "code": "3714",
        "name": "Recreadores"
    },
    {
        "code": "3721",
        "name": "Captadores de imagens em movimento"
    },
    {
        "code": "3722",
        "name": "Operadores de rede de teleprocessamento e afins"
    },
    {
        "code": "3731",
        "name": "T\u00e9cnicos de opera\u00e7\u00e3o de emissoras de r\u00e1dio"
    },
    {
        "code": "3732",
        "name": "T\u00e9cnicos em opera\u00e7\u00e3o de sistemas de televis\u00e3o e de produtoras de v\u00eddeo"
    },
    {
        "code": "3741",
        "name": "T\u00e9cnicos em \u00e1udio"
    },
    {
        "code": "3742",
        "name": "T\u00e9cnicos em cenografia"
    },
    {
        "code": "3743",
        "name": "T\u00e9cnicos em opera\u00e7\u00e3o de aparelhos de proje\u00e7\u00e3o"
    },
    {
        "code": "3744",
        "name": "T\u00e9cnicos em montagem, edi\u00e7\u00e3o e finaliza\u00e7\u00e3o de filme e v\u00eddeo"
    },
    {
        "code": "3751",
        "name": "Designers de interiores, de vitrines e visual merchandiser e afins (n\u00edvel m\u00e9dio)"
    },
    {
        "code": "3761",
        "name": "Dan\u00e7arinos tradicionais e populares"
    },
    {
        "code": "3762",
        "name": "Artistas de circo (circenses)"
    },
    {
        "code": "3763",
        "name": "Apresentadores de eventos, programas e espet\u00e1culos"
    },
    {
        "code": "3764",
        "name": "Modelos"
    },
    {
        "code": "3771",
        "name": "Atletas profissionais"
    },
    {
        "code": "3772",
        "name": "\u00c1rbitros desportivos"
    },
    {
        "code": "3911",
        "name": "T\u00e9cnicos de planejamento e controle de produ\u00e7\u00e3o"
    },
    {
        "code": "3912",
        "name": "T\u00e9cnicos de controle da produ\u00e7\u00e3o"
    },
    {
        "code": "3951",
        "name": "T\u00e9cnicos de apoio em pesquisa e desenvolvimento"
    },
    {
        "code": "4101",
        "name": "Supervisores administrativos"
    },
    {
        "code": "4102",
        "name": "Supervisores de servi\u00e7os financeiros, de c\u00e2mbio e de controle"
    },
    {
        "code": "4110",
        "name": "Agentes, assistentes e auxiliares administrativos"
    },
    {
        "code": "4121",
        "name": "Operadores de equipamentos de entrada e transmiss\u00e3o de dados"
    },
    {
        "code": "4122",
        "name": "Cont\u00ednuos"
    },
    {
        "code": "4131",
        "name": "Auxiliares de contabilidade"
    },
    {
        "code": "4132",
        "name": "Escritur\u00e1rios de servi\u00e7os banc\u00e1rios"
    },
    {
        "code": "4141",
        "name": "Almoxarifes e armazenistas"
    },
    {
        "code": "4142",
        "name": "Apontadores e conferentes"
    },
    {
        "code": "4151",
        "name": "Auxiliares de servi\u00e7os de documenta\u00e7\u00e3o, informa\u00e7\u00e3o e pesquisa"
    },
    {
        "code": "4152",
        "name": "Trabalhadores nos servi\u00e7os de classifica\u00e7\u00e3o e entregas de correspond\u00eancias, encomendas e publica\u00e7\u00f5es"
    },
    {
        "code": "4201",
        "name": "Supervisores de atendimento ao p\u00fablico e de pesquisa"
    },
    {
        "code": "4211",
        "name": "Caixas e bilheteiros (exceto caixa de banco)"
    },
    {
        "code": "4212",
        "name": "Coletadores de apostas e de jogos"
    },
    {
        "code": "4213",
        "name": "Cobradores e afins"
    },
    {
        "code": "4221",
        "name": "Recepcionistas"
    },
    {
        "code": "4222",
        "name": "Operadores de telefonia"
    },
    {
        "code": "4223",
        "name": "Operadores de telemarketing"
    },
    {
        "code": "4231",
        "name": "Despachantes documentalistas e afins"
    },
    {
        "code": "4241",
        "name": "Entrevistadores e recenseadores"
    },
    {
        "code": "4242",
        "name": "Aplicadores de provas e afins"
    },
    {
        "code": "5101",
        "name": "Supervisores dos servi\u00e7os de transporte, turismo, hotelaria e administra\u00e7\u00e3o de edif\u00edcios"
    },
    {
        "code": "5102",
        "name": "Supervisores de lavanderia"
    },
    {
        "code": "5103",
        "name": "Supervisores dos servi\u00e7os de prote\u00e7\u00e3o, seguran\u00e7a e outros"
    },
    {
        "code": "5111",
        "name": "Trabalhadores de seguran\u00e7a e atendimento aos usu\u00e1rios nos transportes"
    },
    {
        "code": "5112",
        "name": "Fiscais e cobradores dos transportes coletivos"
    },
    {
        "code": "5114",
        "name": "Guias de turismo"
    },
    {
        "code": "5115",
        "name": "Condutores de turismo"
    },
    {
        "code": "5121",
        "name": "Trabalhadores dos servi\u00e7os dom\u00e9sticos em geral"
    },
    {
        "code": "5131",
        "name": "Mordomos e governantas"
    },
    {
        "code": "5132",
        "name": "Cozinheiros"
    },
    {
        "code": "5133",
        "name": "Camareiros, roupeiros e afins"
    },
    {
        "code": "5134",
        "name": "Trabalhadores no atendimento em estabelecimentos de servi\u00e7os de alimenta\u00e7\u00e3o, bebidas e hotelaria"
    },
    {
        "code": "5135",
        "name": "Trabalhadores auxiliares nos servi\u00e7os de alimenta\u00e7\u00e3o"
    },
    {
        "code": "5136",
        "name": "Churrasqueiros, pizzaiolos e sushimen"
    },
    {
        "code": "5141",
        "name": "Trabalhadores nos servi\u00e7os de administra\u00e7\u00e3o de edif\u00edcios"
    },
    {
        "code": "5142",
        "name": "Trabalhadores nos servi\u00e7os de coleta de res\u00edduos, de limpeza e conserva\u00e7\u00e3o de \u00e1reas p\u00fablicas"
    },
    {
        "code": "5143",
        "name": "Trabalhadores nos  servi\u00e7os de manuten\u00e7\u00e3o de edifica\u00e7\u00f5es"
    },
    {
        "code": "5151",
        "name": "Trabalhadores em servi\u00e7os de promo\u00e7\u00e3o e apoio \u00e0 sa\u00fade"
    },
    {
        "code": "5152",
        "name": "Auxiliares de laborat\u00f3rio da sa\u00fade"
    },
    {
        "code": "5153",
        "name": "Trabalhadores de aten\u00e7\u00e3o, defesa e prote\u00e7\u00e3o a pessoas em situa\u00e7\u00e3o de risco e adolescentes em conflito com a lei"
    },
    {
        "code": "5161",
        "name": "Trabalhadores nos servi\u00e7os de embelezamento e higiene"
    },
    {
        "code": "5162",
        "name": "Cuidadores de crian\u00e7as, jovens, adultos e idosos"
    },
    {
        "code": "5163",
        "name": "Tintureiros, lavadeiros e afins, a m\u00e1quina"
    },
    {
        "code": "5164",
        "name": "Lavadores e passadores de roupa, a m\u00e3o"
    },
    {
        "code": "5165",
        "name": "Trabalhadores dos servi\u00e7os funer\u00e1rios"
    },
    {
        "code": "5166",
        "name": "Trabalhadores auxiliares dos servi\u00e7os funer\u00e1rios"
    },
    {
        "code": "5167",
        "name": "Astr\u00f3logos e numer\u00f3logos"
    },
    {
        "code": "5168",
        "name": "Esot\u00e9ricos e paranormais"
    },
    {
        "code": "5171",
        "name": "Bombeiros e salva-vidas"
    },
    {
        "code": "5172",
        "name": "Policiais, guardas-civis municipais e agentes de tr\u00e2nsito"
    },
    {
        "code": "5173",
        "name": "Vigilantes e guardas de seguran\u00e7a"
    },
    {
        "code": "5174",
        "name": "Porteiros, vigias e afins"
    },
    {
        "code": "5191",
        "name": "Motociclistas e ciclistas de entregas r\u00e1pidas"
    },
    {
        "code": "5192",
        "name": "Trabalhadores da coleta e sele\u00e7\u00e3o de material recicl\u00e1vel"
    },
    {
        "code": "5193",
        "name": "Trabalhadores de servi\u00e7os veterin\u00e1rios, de higiene e est\u00e9tica de animais dom\u00e9sticos"
    },
    {
        "code": "5198",
        "name": "Profissionais do sexo"
    },
    {
        "code": "5199",
        "name": "Outros trabalhadores dos servi\u00e7os"
    },
    {
        "code": "5201",
        "name": "Supervisores de vendas e de presta\u00e7\u00e3o de servi\u00e7os"
    },
    {
        "code": "5211",
        "name": "Operadores do com\u00e9rcio em lojas e mercados"
    },
    {
        "code": "5231",
        "name": "Instaladores de produtos e acess\u00f3rios"
    },
    {
        "code": "5241",
        "name": "Vendedores em domic\u00edlio"
    },
    {
        "code": "5242",
        "name": "Vendedores em bancas, quiosques e barracas"
    },
    {
        "code": "5243",
        "name": "Vendedores ambulantes"
    },
    {
        "code": "6110",
        "name": "Produtores agropecu\u00e1rios em geral"
    },
    {
        "code": "6120",
        "name": "Produtores agr\u00edcolas polivalentes"
    },
    {
        "code": "6121",
        "name": "Produtores agr\u00edcolas na cultura de gram\u00edneas"
    },
    {
        "code": "6122",
        "name": "Produtores agr\u00edcolas na cultura de plantas fibrosas"
    },
    {
        "code": "6123",
        "name": "Produtores agr\u00edcolas na olericultura"
    },
    {
        "code": "6124",
        "name": "Produtores agr\u00edcolas no cultivo de flores e plantas ornamentais"
    },
    {
        "code": "6125",
        "name": "Produtores agr\u00edcolas na fruticultura"
    },
    {
        "code": "6126",
        "name": "Produtores agr\u00edcolas na cultura de plantas estimulantes"
    },
    {
        "code": "6127",
        "name": "Produtores agr\u00edcolas na cultura de plantas oleaginosas"
    },
    {
        "code": "6128",
        "name": "Produtores de especiarias e de plantas arom\u00e1ticas e medicinais"
    },
    {
        "code": "6130",
        "name": "Produtores em pecu\u00e1ria polivalente"
    },
    {
        "code": "6131",
        "name": "Produtores em pecu\u00e1ria de animais de grande porte"
    },
    {
        "code": "6132",
        "name": "Produtores em pecu\u00e1ria de animais de m\u00e9dio porte"
    },
    {
        "code": "6133",
        "name": "Produtores da avicultura e cunicultura"
    },
    {
        "code": "6134",
        "name": "Produtores de animais e insetos \u00fateis"
    },
    {
        "code": "6201",
        "name": "Supervisores na explora\u00e7\u00e3o agropecu\u00e1ria"
    },
    {
        "code": "6210",
        "name": "Trabalhadores agropecu\u00e1rios em geral"
    },
    {
        "code": "6220",
        "name": "Trabalhadores de apoio \u00e0 agricultura"
    },
    {
        "code": "6221",
        "name": "Trabalhadores agr\u00edcolas na cultura de gram\u00edneas"
    },
    {
        "code": "6222",
        "name": "Trabalhadores agr\u00edcolas na cultura de plantas fibrosas"
    },
    {
        "code": "6223",
        "name": "Trabalhadores agr\u00edcolas na olericultura"
    },
    {
        "code": "6224",
        "name": "Trabalhadores agr\u00edcolas no cultivo de flores e plantas ornamentais"
    },
    {
        "code": "6225",
        "name": "Trabalhadores agr\u00edcolas na fruticultura"
    },
    {
        "code": "6226",
        "name": "Trabalhadores agr\u00edcolas nas culturas de plantas estimulantes"
    },
    {
        "code": "6227",
        "name": "Trabalhadores agr\u00edcolas na cultura de plantas oleaginosas"
    },
    {
        "code": "6228",
        "name": "Trabalhadores agr\u00edcolas da cultura de especiarias e de plantas arom\u00e1ticas e medicinais"
    },
    {
        "code": "6230",
        "name": "Tratadores polivalentes de animais"
    },
    {
        "code": "6231",
        "name": "Trabalhadores na pecu\u00e1ria de animais de grande porte"
    },
    {
        "code": "6232",
        "name": "Trabalhadores na pecu\u00e1ria de animais de m\u00e9dio porte"
    },
    {
        "code": "6233",
        "name": "Trabalhadores na avicultura e cunicultura"
    },
    {
        "code": "6234",
        "name": "Trabalhadores na cria\u00e7\u00e3o de insetos e animais \u00fateis"
    },
    {
        "code": "6301",
        "name": "Supervisores na \u00e1rea florestal e aq\u00fcicultura"
    },
    {
        "code": "6310",
        "name": "Pescadores polivalentes"
    },
    {
        "code": "6311",
        "name": "Pescadores profissionais artesanais de \u00e1gua doce"
    },
    {
        "code": "6312",
        "name": "Pescadores de \u00e1gua costeira e alto mar"
    },
    {
        "code": "6313",
        "name": "Criadores de animais aqu\u00e1ticos"
    },
    {
        "code": "6314",
        "name": "Trabalhadores de apoio \u00e0 pesca"
    },
    {
        "code": "6320",
        "name": "Trabalhadores florestais polivalentes"
    },
    {
        "code": "6321",
        "name": "Extrativistas e reflorestadores de esp\u00e9cies produtoras de madeira"
    },
    {
        "code": "6322",
        "name": "Extrativistas florestais de esp\u00e9cies produtoras de gomas e resinas"
    },
    {
        "code": "6323",
        "name": "Extrativistas florestais de esp\u00e9cies produtoras de fibras, ceras e \u00f3leos"
    },
    {
        "code": "6324",
        "name": "Extrativistas florestais de esp\u00e9cies produtoras de alimentos silvestres"
    },
    {
        "code": "6325",
        "name": "Extrativistas florestais de esp\u00e9cies produtoras de subst\u00e2ncias arom\u00e1ticas, medicinais e t\u00f3xicas"
    },
    {
        "code": "6326",
        "name": "Carvoejadores"
    },
    {
        "code": "6410",
        "name": "Trabalhadores da mecaniza\u00e7\u00e3o agr\u00edcola"
    },
    {
        "code": "6420",
        "name": "Trabalhadores da mecaniza\u00e7\u00e3o florestal"
    },
    {
        "code": "6430",
        "name": "Trabalhadores da irriga\u00e7\u00e3o e drenagem"
    },
    {
        "code": "7101",
        "name": "Supervisores da extra\u00e7\u00e3o mineral"
    },
    {
        "code": "7102",
        "name": "Supervisores da constru\u00e7\u00e3o civil"
    },
    {
        "code": "7111",
        "name": "Trabalhadores da extra\u00e7\u00e3o de minerais s\u00f3lidos"
    },
    {
        "code": "7112",
        "name": "Trabalhadores de extra\u00e7\u00e3o de minerais s\u00f3lidos (operadores de m\u00e1quinas)"
    },
    {
        "code": "7113",
        "name": "Trabalhadores da extra\u00e7\u00e3o de minerais l\u00edquidos e gasosos"
    },
    {
        "code": "7114",
        "name": "Garimpeiros e operadores de salinas"
    },
    {
        "code": "7121",
        "name": "Trabalhadores de beneficiamento de min\u00e9rios"
    },
    {
        "code": "7122",
        "name": "Trabalhadores de beneficiamento de pedras ornamentais"
    },
    {
        "code": "7151",
        "name": "Trabalhadores na opera\u00e7\u00e3o de m\u00e1quinas de terraplenagem e funda\u00e7\u00f5es"
    },
    {
        "code": "7152",
        "name": "Trabalhadores de estruturas de alvenaria"
    },
    {
        "code": "7153",
        "name": "Montadores de estruturas de concreto armado"
    },
    {
        "code": "7154",
        "name": "Trabalhadores na opera\u00e7\u00e3o de m\u00e1quinas de concreto usinado"
    },
    {
        "code": "7155",
        "name": "Trabalhadores de montagem de estruturas de madeira, metal e comp\u00f3sitos em obras civis"
    },
    {
        "code": "7156",
        "name": "Trabalhadores de instala\u00e7\u00f5es el\u00e9tricas"
    },
    {
        "code": "7157",
        "name": "Aplicadores de materiais isolantes"
    },
    {
        "code": "7161",
        "name": "Revestidores de concreto"
    },
    {
        "code": "7162",
        "name": "Telhadores (revestimentos r\u00edgidos)"
    },
    {
        "code": "7163",
        "name": "Vidraceiros (revestimentos r\u00edgidos)"
    },
    {
        "code": "7164",
        "name": "Gesseiros"
    },
    {
        "code": "7165",
        "name": "Aplicadores de revestimentos cer\u00e2micos, pastilhas, pedras e madeiras"
    },
    {
        "code": "7166",
        "name": "Pintores de obras e revestidores de interiores (revestimentos flex\u00edveis)"
    },
    {
        "code": "7170",
        "name": "Ajudantes de obras civis"
    },
    {
        "code": "7201",
        "name": "Supervisores de usinagem, conforma\u00e7\u00e3o e tratamento de metais"
    },
    {
        "code": "7202",
        "name": "Supervisores da fabrica\u00e7\u00e3o e montagem metalmec\u00e2nica"
    },
    {
        "code": "7211",
        "name": "Ferramenteiros e afins"
    },
    {
        "code": "7212",
        "name": "Preparadores e operadores de m\u00e1quinas-ferramenta convencionais"
    },
    {
        "code": "7213",
        "name": "Afiadores e polidores de metais"
    },
    {
        "code": "7214",
        "name": "Operadores de m\u00e1quinas de usinagem cnc"
    },
    {
        "code": "7221",
        "name": "Trabalhadores de forjamento de metais"
    },
    {
        "code": "7222",
        "name": "Trabalhadores de fundi\u00e7\u00e3o de metais puros e de ligas met\u00e1licas"
    },
    {
        "code": "7223",
        "name": "Trabalhadores de moldagem de metais e de ligas met\u00e1licas"
    },
    {
        "code": "7224",
        "name": "Trabalhadores de trefila\u00e7\u00e3o e estiramento de metais puros e ligas met\u00e1licas"
    },
    {
        "code": "7231",
        "name": "Trabalhadores de tratamento t\u00e9rmico de metais"
    },
    {
        "code": "7232",
        "name": "Trabalhadores de tratamento de superf\u00edcies de metais e de comp\u00f3sitos (termoqu\u00edmicos)"
    },
    {
        "code": "7233",
        "name": "Trabalhadores da pintura de equipamentos, ve\u00edculos, estruturas met\u00e1licas e de comp\u00f3sitos"
    },
    {
        "code": "7241",
        "name": "Encanadores e instaladores de tubula\u00e7\u00f5es"
    },
    {
        "code": "7242",
        "name": "Trabalhadores de tra\u00e7agem e montagem de estruturas met\u00e1licas e de comp\u00f3sitos"
    },
    {
        "code": "7243",
        "name": "Trabalhadores de soldagem e corte de ligas met\u00e1licas"
    },
    {
        "code": "7244",
        "name": "Trabalhadores de caldeiraria e serralheria"
    },
    {
        "code": "7245",
        "name": "Operadores de m\u00e1quinas de conforma\u00e7\u00e3o de metais"
    },
    {
        "code": "7246",
        "name": "Tran\u00e7adores e laceiros de cabos de a\u00e7o"
    },
    {
        "code": "7250",
        "name": "Ajustadores mec\u00e2nicos polivalentes"
    },
    {
        "code": "7251",
        "name": "Montadores de m\u00e1quinas, aparelhos e acess\u00f3rios em linhas de montagem"
    },
    {
        "code": "7252",
        "name": "Montadores de m\u00e1quinas industriais"
    },
    {
        "code": "7253",
        "name": "Montadores de m\u00e1quinas pesadas e equipamentos agr\u00edcolas"
    },
    {
        "code": "7254",
        "name": "Mec\u00e2nicos montadores de motores e turboalimentadores"
    },
    {
        "code": "7255",
        "name": "Montadores de ve\u00edculos automotores (linha de montagem)"
    },
    {
        "code": "7256",
        "name": "Montadores de sistemas e estruturas de aeronaves"
    },
    {
        "code": "7257",
        "name": "Instaladores de equipamentos de refrigera\u00e7\u00e3o e ventila\u00e7\u00e3o"
    },
    {
        "code": "7301",
        "name": "Supervisores de montagens e instala\u00e7\u00f5es eletroeletr\u00f4nicas"
    },
    {
        "code": "7311",
        "name": "Montadores de equipamentos eletroeletr\u00f4nicos"
    },
    {
        "code": "7312",
        "name": "Montadores de aparelhos de telecomunica\u00e7\u00f5es"
    },
    {
        "code": "7313",
        "name": "Instaladores-reparadores de  linhas e equipamentos de telecomunica\u00e7\u00f5es"
    },
    {
        "code": "7321",
        "name": "Instaladores e reparadores de linhas e cabos el\u00e9tricos, telef\u00f4nicos e de comunica\u00e7\u00e3o de dados"
    },
    {
        "code": "7401",
        "name": "Supervisores da mec\u00e2nica de precis\u00e3o e instrumentos musicais"
    },
    {
        "code": "7411",
        "name": "Mec\u00e2nicos de instrumentos de precis\u00e3o"
    },
    {
        "code": "7421",
        "name": "Confeccionadores de instrumentos musicais"
    },
    {
        "code": "7501",
        "name": "Supervisores de joalheria e afins"
    },
    {
        "code": "7502",
        "name": "Supervisores de vidraria, cer\u00e2mica e afins"
    },
    {
        "code": "7510",
        "name": "Joalheiros e lapidadores de gemas"
    },
    {
        "code": "7511",
        "name": "Artes\u00e3os de metais preciosos e semi-preciosos"
    },
    {
        "code": "7521",
        "name": "Sopradores, moldadores e modeladores de vidros e afins"
    },
    {
        "code": "7522",
        "name": "Trabalhadores da transforma\u00e7\u00e3o de vidros planos"
    },
    {
        "code": "7523",
        "name": "Ceramistas (prepara\u00e7\u00e3o e fabrica\u00e7\u00e3o)"
    },
    {
        "code": "7524",
        "name": "Vidreiros e ceramistas (arte e decora\u00e7\u00e3o)"
    },
    {
        "code": "7601",
        "name": "Supervisores da ind\u00fastria t\u00eaxtil"
    },
    {
        "code": "7602",
        "name": "Supervisores na ind\u00fastria do curtimento"
    },
    {
        "code": "7603",
        "name": "Supervisores na confec\u00e7\u00e3o do vestu\u00e1rio"
    },
    {
        "code": "7604",
        "name": "Supervisores na confec\u00e7\u00e3o de cal\u00e7ados"
    },
    {
        "code": "7605",
        "name": "Supervisores da confec\u00e7\u00e3o de artefatos de tecidos, couros e afins"
    },
    {
        "code": "7606",
        "name": "Supervisores das artes gr\u00e1ficas"
    },
    {
        "code": "7610",
        "name": "Trabalhadores polivalentes das ind\u00fastrias t\u00eaxteis"
    },
    {
        "code": "7611",
        "name": "Trabalhadores da classifica\u00e7\u00e3o de fibras t\u00eaxteis e lavagem de l\u00e3"
    },
    {
        "code": "7612",
        "name": "Operadores da fia\u00e7\u00e3o"
    },
    {
        "code": "7613",
        "name": "Operadores de tear e m\u00e1quinas similares"
    },
    {
        "code": "7614",
        "name": "Trabalhadores de acabamento, tingimento e estamparia das ind\u00fastrias t\u00eaxteis"
    },
    {
        "code": "7618",
        "name": "Inspetores e revisores de produ\u00e7\u00e3o t\u00eaxtil"
    },
    {
        "code": "7620",
        "name": "Trabalhadores polivalentes do curtimento de couros e peles"
    },
    {
        "code": "7621",
        "name": "Trabalhadores da prepara\u00e7\u00e3o do curtimento de couros e peles"
    },
    {
        "code": "7622",
        "name": "Trabalhadores do curtimento de couros e peles"
    },
    {
        "code": "7623",
        "name": "Trabalhadores do acabamento de couros e peles"
    },
    {
        "code": "7630",
        "name": "Profissionais polivalentes da confec\u00e7\u00e3o de roupas"
    },
    {
        "code": "7631",
        "name": "Trabalhadores da prepara\u00e7\u00e3o da confec\u00e7\u00e3o de roupas"
    },
    {
        "code": "7632",
        "name": "Operadores de m\u00e1quinas para costura de pe\u00e7as do vestu\u00e1rio"
    },
    {
        "code": "7633",
        "name": "Operadores de m\u00e1quinas para bordado e acabamento de roupas"
    },
    {
        "code": "7640",
        "name": "Trabalhadores polivalentes da confec\u00e7\u00e3o de cal\u00e7ados"
    },
    {
        "code": "7641",
        "name": "Trabalhadores da prepara\u00e7\u00e3o da confec\u00e7\u00e3o de cal\u00e7ados"
    },
    {
        "code": "7642",
        "name": "Operadores de m\u00e1quinas de costurar e montar cal\u00e7ados"
    },
    {
        "code": "7643",
        "name": "Trabalhadores de acabamento de cal\u00e7ados"
    },
    {
        "code": "7650",
        "name": "Trabalhadores polivalentes da confec\u00e7\u00e3o de artefatos de tecidos e couros"
    },
    {
        "code": "7651",
        "name": "Trabalhadores da prepara\u00e7\u00e3o de artefatos de tecidos, couros e tape\u00e7aria"
    },
    {
        "code": "7652",
        "name": "Trabalhadores da confec\u00e7\u00e3o de artefatos de tecidos, couros e sint\u00e9ticos"
    },
    {
        "code": "7653",
        "name": "Operadores de m\u00e1quinas na confec\u00e7\u00e3o de artefatos de  couro"
    },
    {
        "code": "7654",
        "name": "Trabalhadores do acabamento de artefatos de tecidos e couros"
    },
    {
        "code": "7661",
        "name": "Trabalhadores da pr\u00e9-impress\u00e3o gr\u00e1fica"
    },
    {
        "code": "7662",
        "name": "Trabalhadores da impress\u00e3o gr\u00e1fica"
    },
    {
        "code": "7663",
        "name": "Trabalhadores do acabamento gr\u00e1fico"
    },
    {
        "code": "7664",
        "name": "Trabalhadores de laborat\u00f3rio fotogr\u00e1fico e radiol\u00f3gico"
    },
    {
        "code": "7681",
        "name": "Trabalhadores de tecelagem manual, tric\u00f4, croch\u00ea, rendas e afins"
    },
    {
        "code": "7682",
        "name": "Trabalhadores artesanais da confec\u00e7\u00e3o de pe\u00e7as e tecidos"
    },
    {
        "code": "7683",
        "name": "Trabalhadores artesanais da confec\u00e7\u00e3o de cal\u00e7ados e artefatos de couros e peles"
    },
    {
        "code": "7686",
        "name": "Trabalhadores tipogr\u00e1ficos linotipistas e afins"
    },
    {
        "code": "7687",
        "name": "Encadernadores e recuperadores de livros (pequenos lotes ou a unidade)"
    },
    {
        "code": "7701",
        "name": "Supervisores em ind\u00fastria de madeira, mobili\u00e1rio e da carpintaria veicular"
    },
    {
        "code": "7711",
        "name": "Marceneiros e afins"
    },
    {
        "code": "7721",
        "name": "Trabalhadores de tratamento e prepara\u00e7\u00e3o da madeira"
    },
    {
        "code": "7731",
        "name": "Operadores de m\u00e1quinas de desdobramento da madeira"
    },
    {
        "code": "7732",
        "name": "Operadores de m\u00e1quinas de aglomera\u00e7\u00e3o e prensagem de chapas"
    },
    {
        "code": "7733",
        "name": "Operadores de usinagem convencional de madeira"
    },
    {
        "code": "7734",
        "name": "Operadores de m\u00e1quina de usinar madeira (produ\u00e7\u00e3o em s\u00e9rie)"
    },
    {
        "code": "7735",
        "name": "Operadores de m\u00e1quinas de usinagem de madeira cnc"
    },
    {
        "code": "7741",
        "name": "Montadores de m\u00f3veis e artefatos de madeira"
    },
    {
        "code": "7751",
        "name": "Trabalhadores de arte e  do acabamento em madeira do mobili\u00e1rio"
    },
    {
        "code": "7764",
        "name": "Confeccionadores de artefatos de madeira, m\u00f3veis de vime e afins"
    },
    {
        "code": "7771",
        "name": "Carpinteiros navais"
    },
    {
        "code": "7772",
        "name": "Carpinteiros de carrocerias e carretas"
    },
    {
        "code": "7801",
        "name": "Supervisores de trabalhadores de embalagem e etiquetagem"
    },
    {
        "code": "7811",
        "name": "Condutores de processos robotizados"
    },
    {
        "code": "7813",
        "name": "Operadores de ve\u00edculos subaqu\u00e1ticos controlados remotamente"
    },
    {
        "code": "7817",
        "name": "Trabalhadores subaqu\u00e1ticos"
    },
    {
        "code": "7821",
        "name": "Operadores de m\u00e1quinas e equipamentos de eleva\u00e7\u00e3o"
    },
    {
        "code": "7822",
        "name": "Operadores de equipamentos de movimenta\u00e7\u00e3o de cargas"
    },
    {
        "code": "7823",
        "name": "Motoristas de ve\u00edculos de pequeno e m\u00e9dio porte"
    },
    {
        "code": "7824",
        "name": "Motoristas de \u00f4nibus urbanos, metropolitanos e rodovi\u00e1rios"
    },
    {
        "code": "7825",
        "name": "Motoristas de ve\u00edculos de cargas em geral"
    },
    {
        "code": "7826",
        "name": "Operadores de ve\u00edculos sobre trilhos e cabos a\u00e9reos"
    },
    {
        "code": "7827",
        "name": "Trabalhadores aquavi\u00e1rios"
    },
    {
        "code": "7828",
        "name": "Condutores de animais e de ve\u00edculos de tra\u00e7\u00e3o animal e pedais"
    },
    {
        "code": "7831",
        "name": "Trabalhadores de manobras de transportes sobre trilhos"
    },
    {
        "code": "7832",
        "name": "Trabalhadores de cargas e descargas de mercadorias"
    },
    {
        "code": "7841",
        "name": "Trabalhadores de embalagem e de etiquetagem"
    },
    {
        "code": "7842",
        "name": "Alimentadores de linhas de produ\u00e7\u00e3o"
    },
    {
        "code": "7911",
        "name": "Artes\u00e3os"
    },
    {
        "code": "8101",
        "name": "Supervisores de produ\u00e7\u00e3o em ind\u00fastrias qu\u00edmicas, petroqu\u00edmicas e afins"
    },
    {
        "code": "8102",
        "name": "Supervisores de produ\u00e7\u00e3o em ind\u00fastrias de transforma\u00e7\u00e3o de pl\u00e1sticos e borrachas"
    },
    {
        "code": "8103",
        "name": "Supervisores de produ\u00e7\u00e3o em ind\u00fastrias de produtos farmac\u00eauticos, cosm\u00e9ticos e afins"
    },
    {
        "code": "8110",
        "name": "Operadores polivalentes de equipamentos em ind\u00fastrias qu\u00edmicas, petroqu\u00edmicas e afins"
    },
    {
        "code": "8111",
        "name": "Operadores de equipamentos de moagem e mistura de materiais (tratamentos qu\u00edmicos e afins)"
    },
    {
        "code": "8112",
        "name": "Operadores de calcina\u00e7\u00e3o e de tratamentos qu\u00edmicos de materiais radioativos"
    },
    {
        "code": "8113",
        "name": "Operadores de equipamentos de filtragem e separa\u00e7\u00e3o"
    },
    {
        "code": "8114",
        "name": "Operadores de equipamentos de destila\u00e7\u00e3o, evapora\u00e7\u00e3o e rea\u00e7\u00e3o"
    },
    {
        "code": "8115",
        "name": "Operadores de equipamentos de produ\u00e7\u00e3o e refino de petr\u00f3leo e g\u00e1s"
    },
    {
        "code": "8116",
        "name": "Operadores de equipamentos de coqueifica\u00e7\u00e3o"
    },
    {
        "code": "8117",
        "name": "Operadores de instala\u00e7\u00f5es e m\u00e1quinas de produtos pl\u00e1sticos, de borracha e moldadores de parafinas"
    },
    {
        "code": "8118",
        "name": "Operadores de m\u00e1quinas e instala\u00e7\u00f5es de produtos farmac\u00eauticos, cosm\u00e9ticos e afins"
    },
    {
        "code": "8121",
        "name": "Trabalhadores da fabrica\u00e7\u00e3o de muni\u00e7\u00e3o e explosivos qu\u00edmicos"
    },
    {
        "code": "8131",
        "name": "Operadores de processos das ind\u00fastrias de transforma\u00e7\u00e3o de produtos qu\u00edmicos, petroqu\u00edmicos e afins"
    },
    {
        "code": "8181",
        "name": "Laboratoristas industriais auxiliares"
    },
    {
        "code": "8201",
        "name": "Supervisores de produ\u00e7\u00e3o em ind\u00fastrias sider\u00fargicas"
    },
    {
        "code": "8202",
        "name": "Supervisores na fabrica\u00e7\u00e3o de materiais para constru\u00e7\u00e3o (vidros e cer\u00e2micas)"
    },
    {
        "code": "8211",
        "name": "Operadores de instala\u00e7\u00f5es de sinteriza\u00e7\u00e3o"
    },
    {
        "code": "8212",
        "name": "Operadores de fornos de primeira  fus\u00e3o e aciaria"
    },
    {
        "code": "8213",
        "name": "Operadores de equipamentos de lamina\u00e7\u00e3o"
    },
    {
        "code": "8214",
        "name": "Operadores de equipamentos de acabamento de chapas e metais"
    },
    {
        "code": "8221",
        "name": "Forneiros metal\u00fargicos (segunda fus\u00e3o e reaquecimento)"
    },
    {
        "code": "8231",
        "name": "Operadores na prepara\u00e7\u00e3o de massas para abrasivo, vidro, cer\u00e2mica, porcelana e materiais de constru\u00e7\u00e3o"
    },
    {
        "code": "8232",
        "name": "Operadores de equipamentos de fabrica\u00e7\u00e3o  e beneficiamento de cristais, vidros, cer\u00e2micas, porcelanas, fibras de vidro, abrasivos e afins"
    },
    {
        "code": "8233",
        "name": "Operadores de instala\u00e7\u00f5es e equipamentos de fabrica\u00e7\u00e3o de materiais de constru\u00e7\u00e3o"
    },
    {
        "code": "8281",
        "name": "Trabalhadores da fabrica\u00e7\u00e3o de cer\u00e2mica estrutural para constru\u00e7\u00e3o"
    },
    {
        "code": "8301",
        "name": "Supervisores da fabrica\u00e7\u00e3o de celulose e papel"
    },
    {
        "code": "8311",
        "name": "Preparadores de pasta para fabrica\u00e7\u00e3o de papel"
    },
    {
        "code": "8321",
        "name": "Operadores de m\u00e1quinas de fabricar papel e papel\u00e3o"
    },
    {
        "code": "8331",
        "name": "Operadores de m\u00e1quinas na fabrica\u00e7\u00e3o de produtos de papel e papel\u00e3o"
    },
    {
        "code": "8332",
        "name": "Trabalhadores artesanais de produtos de papel e papel\u00e3o"
    },
    {
        "code": "8401",
        "name": "Supervisores da fabrica\u00e7\u00e3o de alimentos, bebidas e fumo"
    },
    {
        "code": "8411",
        "name": "Trabalhadores da ind\u00fastria de beneficiamento de gr\u00e3os, cereais e afins"
    },
    {
        "code": "8412",
        "name": "Trabalhadores no beneficiamento do sal"
    },
    {
        "code": "8413",
        "name": "Trabalhadores na fabrica\u00e7\u00e3o e refino de a\u00e7\u00facar"
    },
    {
        "code": "8414",
        "name": "Trabalhadores na fabrica\u00e7\u00e3o e conserva\u00e7\u00e3o de alimentos"
    },
    {
        "code": "8415",
        "name": "Trabalhadores na pasteuriza\u00e7\u00e3o do leite e na fabrica\u00e7\u00e3o de latic\u00ednios  e afins"
    },
    {
        "code": "8416",
        "name": "Trabalhadores na industrializa\u00e7\u00e3o de caf\u00e9, cacau, mate e de produtos afins"
    },
    {
        "code": "8417",
        "name": "Trabalhadores na fabrica\u00e7\u00e3o de cacha\u00e7a, cerveja, vinhos e outras bebidas"
    },
    {
        "code": "8418",
        "name": "Operadores de equipamentos na fabrica\u00e7\u00e3o de p\u00e3es, massas aliment\u00edcias, doces, chocolates e achocolatados"
    },
    {
        "code": "8421",
        "name": "Cigarreiros e beneficiadores de fumo"
    },
    {
        "code": "8422",
        "name": "Charuteiros"
    },
    {
        "code": "8481",
        "name": "Trabalhadores artesanais na conserva\u00e7\u00e3o de alimentos"
    },
    {
        "code": "8482",
        "name": "Trabalhadores artesanais na pasteuriza\u00e7\u00e3o do leite e na fabrica\u00e7\u00e3o de latic\u00ednios e afins"
    },
    {
        "code": "8483",
        "name": "Padeiros, confeiteiros e afins"
    },
    {
        "code": "8484",
        "name": "Trabalhadores na degusta\u00e7\u00e3o e classifica\u00e7\u00e3o de gr\u00e3os e afins"
    },
    {
        "code": "8485",
        "name": "Magarefes e afins"
    },
    {
        "code": "8486",
        "name": "Trabalhadores artesanais na ind\u00fastria do fumo"
    },
    {
        "code": "8601",
        "name": "Supervisores da produ\u00e7\u00e3o de utilidades"
    },
    {
        "code": "8611",
        "name": "Operadores de instala\u00e7\u00f5es de gera\u00e7\u00e3o e distribui\u00e7\u00e3o de energia el\u00e9trica, hidr\u00e1ulica, t\u00e9rmica ou nuclear"
    },
    {
        "code": "8612",
        "name": "Operadores de instala\u00e7\u00f5es de distribui\u00e7\u00e3o de energia el\u00e9trica"
    },
    {
        "code": "8621",
        "name": "Operadores de m\u00e1quinas a vapor e utilidades"
    },
    {
        "code": "8622",
        "name": "Operadores de instala\u00e7\u00f5es de capta\u00e7\u00e3o, tratamento e distribui\u00e7\u00e3o de \u00e1gua"
    },
    {
        "code": "8623",
        "name": "Operadores de instala\u00e7\u00f5es de capta\u00e7\u00e3o e esgotos"
    },
    {
        "code": "8624",
        "name": "Operadores de instala\u00e7\u00f5es de extra\u00e7\u00e3o, processamento, envasamento e distribui\u00e7\u00e3o de gases"
    },
    {
        "code": "8625",
        "name": "Operadores de instala\u00e7\u00f5es de refrigera\u00e7\u00e3o e ar-condicionado"
    },
    {
        "code": "9101",
        "name": "Supervisores em servi\u00e7os de repara\u00e7\u00e3o e manuten\u00e7\u00e3o de m\u00e1quinas e equipamentos industriais, comerciais e residenciais"
    },
    {
        "code": "9102",
        "name": "Supervisores em servi\u00e7os de repara\u00e7\u00e3o e manuten\u00e7\u00e3o veicular"
    },
    {
        "code": "9109",
        "name": "Supervisores de outros trabalhadores de servi\u00e7os de repara\u00e7\u00e3o, conserva\u00e7\u00e3o e manuten\u00e7\u00e3o"
    },
    {
        "code": "9111",
        "name": "Mec\u00e2nicos de manuten\u00e7\u00e3o de bombas, motores, compressores e equipamentos de transmiss\u00e3o"
    },
    {
        "code": "9112",
        "name": "Mec\u00e2nicos de manuten\u00e7\u00e3o e instala\u00e7\u00e3o de aparelhos de  climatiza\u00e7\u00e3o e refrigera\u00e7\u00e3o"
    },
    {
        "code": "9113",
        "name": "Mec\u00e2nicos de manuten\u00e7\u00e3o de m\u00e1quinas industriais"
    },
    {
        "code": "9131",
        "name": "Mec\u00e2nicos de manuten\u00e7\u00e3o de m\u00e1quinas pesadas e equipamentos agr\u00edcolas"
    },
    {
        "code": "9141",
        "name": "Mec\u00e2nicos de manuten\u00e7\u00e3o aeron\u00e1utica"
    },
    {
        "code": "9142",
        "name": "Mec\u00e2nicos de manuten\u00e7\u00e3o de motores e equipamentos navais"
    },
    {
        "code": "9143",
        "name": "Mec\u00e2nicos de manuten\u00e7\u00e3o metroferrovi\u00e1ria"
    },
    {
        "code": "9144",
        "name": "Mec\u00e2nicos de manuten\u00e7\u00e3o de ve\u00edculos automotores"
    },
    {
        "code": "9151",
        "name": "T\u00e9cnicos em manuten\u00e7\u00e3o e repara\u00e7\u00e3o de instrumentos de medi\u00e7\u00e3o e precis\u00e3o"
    },
    {
        "code": "9152",
        "name": "Restauradores de instrumentos musicais"
    },
    {
        "code": "9153",
        "name": "T\u00e9cnicos em manuten\u00e7\u00e3o e repara\u00e7\u00e3o de equipamentos biom\u00e9dicos"
    },
    {
        "code": "9154",
        "name": "Reparadores de equipamentos fotogr\u00e1ficos"
    },
    {
        "code": "9191",
        "name": "Lubrificadores"
    },
    {
        "code": "9192",
        "name": "Trabalhadores de manuten\u00e7\u00e3o de ro\u00e7adeiras, motoserras e similares"
    },
    {
        "code": "9193",
        "name": "Mec\u00e2nicos de manuten\u00e7\u00e3o de bicicletas e equipamentos esportivos e de gin\u00e1stica"
    },
    {
        "code": "9501",
        "name": "Supervisores de manuten\u00e7\u00e3o eletroeletr\u00f4nica industrial, comercial e predial"
    },
    {
        "code": "9502",
        "name": "Supervisores de manuten\u00e7\u00e3o eletroeletr\u00f4nica veicular"
    },
    {
        "code": "9503",
        "name": "Supervisores de manuten\u00e7\u00e3o eletromec\u00e2nica"
    },
    {
        "code": "9511",
        "name": "Eletricistas de manuten\u00e7\u00e3o eletroeletr\u00f4nica"
    },
    {
        "code": "9513",
        "name": "Instaladores e mantenedores de sistemas eletroeletr\u00f4nicos de seguran\u00e7a"
    },
    {
        "code": "9531",
        "name": "Eletricistas eletr\u00f4nicos de manuten\u00e7\u00e3o veicular (a\u00e9rea, terrestre e naval)"
    },
    {
        "code": "9541",
        "name": "Instaladores e mantenedores eletromec\u00e2nicos de elevadores, escadas e portas autom\u00e1ticas"
    },
    {
        "code": "9542",
        "name": "Reparadores de aparelhos eletrodom\u00e9sticos"
    },
    {
        "code": "9543",
        "name": "Reparadores de equipamentos de escrit\u00f3rio"
    },
    {
        "code": "9911",
        "name": "Conservadores de vias permanentes (trilhos)"
    },
    {
        "code": "9912",
        "name": "Mantenedores de equipamentos de parques de divers\u00f5es e similares"
    },
    {
        "code": "9913",
        "name": "Reparadores de carrocerias de ve\u00edculos"
    },
    {
        "code": "9921",
        "name": "Trabalhadores elementares de servi\u00e7os de manuten\u00e7\u00e3o veicular"
    },
    {
        "code": "9922",
        "name": "Trabalhadores operacionais de conserva\u00e7\u00e3o de vias permanentes (exceto trilhos)"
    }
]