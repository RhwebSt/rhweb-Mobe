<?php

namespace App\Http\Controllers\Administrador\Tomador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tomador;
use App\Taxa;
use App\Endereco;
use App\Bancario;
use App\RetencaoFatura;
use App\CartaoPonto;
use App\Parametrosefip;
use App\TaxaTrabalhador;
use App\IncideFolhar;
use App\IndiceFatura;
use App\TabelaPreco;
use App\Bolcartaoponto;
use App\Lancamentorublica;
use App\Lancamentotabela;
use App\Comissionado;
use App\ValoresRublica;
use App\Rublica;
use App\BaseCalculo;

class BancoController extends Controller
{
    private $rublica, $tomador, $valorrublica, $taxa, $endereco, $bancario,
        $tabelapreco, $cartaoponto, $parametrosefip, $incidefolhar, $indicefatura,
        $comissionado, $retencaofatura, $bolcartaoponto, $lancamentorublica, $lancamentotabela, $basecalculo;
    public function __construct()
    {
        $this->rublica = new Rublica;
        $this->tomador = new Tomador;
        $this->valorrublica = new ValoresRublica;
        $this->taxa = new Taxa;
        $this->endereco = new Endereco;
        $this->bancario = new Bancario;
        $this->tabelapreco = new TabelaPreco;
        $this->cartaoponto = new CartaoPonto;
        $this->parametrosefip = new Parametrosefip;
        $this->incidefolhar = new IncideFolhar;
        $this->indicefatura = new IndiceFatura;
        $this->comissionado = new Comissionado;
        $this->retencaofatura = new RetencaoFatura;
        $this->bolcartaoponto = new Bolcartaoponto;
        $this->lancamentorublica = new Lancamentorublica;
        $this->lancamentotabela = new Lancamentotabela;
        $this->basecalculo = new BaseCalculo;
    }
    public function cadastroTxt(Request $request)
    {
       
        $empresa = $request->all('empresa');
        $tomadores = '';
        $tabela = '';
        $descricao = '';
        $rubli = '';
       for ($i=0; $i < 2; $i++) { 
            $file = $request->file('file'.$i);
            if (strpos(strtoupper($file->getClientOriginalName()), 'TOMADOR') !== false) {
                $tomadores = $file;
                $tomadores = file($tomadores);
            }else{
                $tabela = $file;
                $tabela = file($tabela);
            }
        }
       
           

            $matricula = [];
            $idtomador = [];
            $rublicas = $this->rublica->listaRublicaTabelaPreco();
            $complemento = [
                'A-Área',
                'AC-Acesso',
                'ACA-Acampamento',
                'ACL-Acesso Local',
                'AE-Área Especial',
                'AER-Aeroporto',
                'AL-Alameda',
                'ALD-Aldeia',
                'AMD-Avenida Marginal Direita',
                'AME-Avenida Marginal Esquerda',
                'AN-Anel Viário',
                'ANT-Antiga Estrada',
                'ART-Artéria',
                'AT-Alto',
                'ATL-Atalho',
                'A V-Área Verde',
                'AV-Avenida',
                'AVC-Avenida Contorno',
                'AVM-Avenida Marginal',
                'AVV-Avenida Velha',
                'BAL-Balneário',
                'BC-Beco',
                'BCO-Buraco',
                'BL-Bloco',
                'BLO-Balão',
                'BLV-Bulevar',
                'BSQ-Bosque',
                'BVD-Boulevard',
                'BX-Baixa',
                'C-Cais',
                'CAL-Calçada',
                'CAM-Caminho',
                'CAN-Canal',
                'CH-Chácara',
                'CHA-Chapadão',
                'CIC-Ciclovia',
                'CIR-Circular',
                'CJ-Conjunto',
                'COL-Colônia',
                'COM-Comunidade',
                'CON-Condomínio',
                'COR-Corredor',
                'CPO-Campo',
                'CGR-Córrego',
                'CTN-Contorno',
                'DSC-Descida',
                'DSV-Desvio',
                'DT-Distrito',
                'EB-Entre Bloco',
                'EIM-Estrada Intermunicipal',
                'ENS-Enseada',
                'ENT-Entrada Particular',
                'EQ-Entre Quadra',
                'ESC-Escada',
                'ESD-Escadaria',
                'ESE-Estrada Estadual',
                'ESI-Estrada Vicinal',
                'ESL-Estrada de Ligação',
                'ESM-Estrada Municipal',
                'ESP-Esplanada',
                'ESS-Estrada de Servidão',
                'EST-Estrada',
                'ESV-Estrada Velha',
                'ETA-Estrada Antiga',
                'ETC-Estação',
                'ETC-Estádio',
                'ETN-Estância',
                'ETP-Estrada Particular',
                'ETT-Estacionamento',
                'EVA-Evangélica',
                'EVD-Elevada',
                'EX-Eixo Industrial',
                'FAV-Favela',
                'FAZ-Fazenda',
                'FER-Ferrovia',
                'FNT-Fonte',
                'FRA-Feira',
                'FTE-Forte',
                'GAL-Galeria',
                'GJA-Granja',
                'HAB-Núcleo Habitacional',
                'IA-Ilha',
                'IGP-Igarapé',
                'IND-Indeterminado',
                'IOA-Ilhota',
                'JD-Jardim',
                'JDE-Jardinete',
                'LD-Ladeira',
                'LGA-Lagoa',
                'LGO-Lago',
                'LOT-Loteamento',
                'LRG- Largo',
                'LT-Lote',
                'MER-Mercado',
                'MNA-Marina',
                'MOD-Modulo',
                'MRG-Projeção',
                'MRO-Morro',
                'MTE-Monte',
                'NUC-Núcleo',
                'NUR-Núcleo Rural',
                'O-Outros',
                'OUT-Outeiro',
                'PAR-Paralela',
                'PAS-Passeio',
                'PAT-Pátio',
                'PC-Praça',
                'PCE-Praça de Esportes',
                'PDA-Parada',
                'PDO-Paradouro',
                'PNT-Ponta',
                'PR-Praia',
                'PRL-Prolongamento',
                'PRM-Parque Municipal',
                'PRQ-Parque',
                'PRR-Parque Residencial',
                'PSA-Passarela',
                'PSG-Passagem',
                'PSP- Passagem de Pedestre',
                'PSS-Passagem Subterrânea',
                'PTE-Ponte',
                'PTO-Porto',
                'Q-Quadra',
                'QTA-Quinta',
                'QTS-Quintas',
                'R-Rua',
                'R I-Rua Integração',
                'R L-Rua de Ligação',
                'R P-Rua Particular',
                'R V-Rua Velha',
                'RAM-Ramal',
                'RCR-Recreio',
                'REC-Recanto',
                'RER-Retiro',
                'RES-Residencial',
                'RET-Reta',
                'RLA-Ruela',
                'RMP-Rampa',
                'ROA-Rodo Anel',
                'ROD-Rodovia',
                'ROT-Rotula',
                'RPE-Rua de Pedestre',
                'RPR-Margem',
                'RTN-Retorno',
                'RTT-Rotatória',
                'SEG-Segunda Avenida',
                'SIT-Sitio',
                'SRV-Servidão',
                'ST-Setor',
                'SUB-Subida',
                'TCH-Trincheira',
                'TER-Terminal',
                'TR-Trecho',
                'TRV-Trevo',
                'TUN-Túnel',
                'TV-Travessa',
                'TVP-Travessa Particular',
                'TVV-Travessa Velha',
                'UNI-Unidade',
                'V-Via',
                'V C-Via Coletora',
                'V L-Via Local',
                'VAC-Via de Acesso',
                'VAL-Vala',
                'VCO-Via Costeira',
                'VD-Viaduto',
                'V-E-Via Expressa',
                'VER-Vereda',
                'VEV-Via Elevado',
                'VL-Vila',
                'VLA-Viela',
                'VLE- Vale',
                'VLT-Via Litorânea',
                'VPE-Via de Pedestre',
                'VRT-Variante',
                'ZIG- Zigue-Zague',
            ];
            // $id = '';
            $matual = $this->valorrublica->where('empresa_id',$empresa['empresa'])->first();
            foreach ($tomadores as $i => $linha) {
                if ($linha) {
                    $tomador = [
                        'nome__completo' => '',
                        'nome__fantasia' => '',
                        'tipo' => '',
                        'cnpj' => '',
                        'matricula' => '',
                        'simples' => '',
                        'telefone' => '',
                        'complemento__endereco'=>'',
                        'cep' => '',
                        'logradouro' => '',
                        'numero' => '',
                        'bairro' => '',
                        'localidade' => '',
                        'uf' => '',
                        'taxa_adm' => '',
                        'taxa__fed' => '',
                        'deflator' => '',
                        'das' => '',
                        'cod__fpas' => null,
                        'cod__grps' => null,
                        'cod__recol' => null,
                        'cod__fap' => null,
                        'cnae' => null,
                        'fap__aliquota' => null,
                        'rat__ajustado' => null,
                        'fpas__terceiros' => null,
                        'aliq__terceiros' => null,
                        'alimentacao' => '',
                        'transporte' => '',
                        'epi' => '',
                        'seguro__trabalhador' => '',
                        'folhartransporte' => '',
                        'folhartipotrans' => '',
                        'folharalim' => '',
                        'folhartipoalim' => '',
                        'dias_uteis' => '',
                        'sabados' => '',
                        'domingos' => '',
                        'banco' => '',
                        'agencia' => '',
                        'operacao' => '',
                        'conta' => '',
                        'pix' => '',
                        'empresa' => $empresa['empresa'],
                        'trabalhador' => null,
                    ];
                    $tomador['matricula'] = str_replace("  ", "",substr(utf8_encode($linha), 2, 4));
                    if ($tomador['matricula']) {
                        array_push($matricula,(int)$tomador['matricula']);
                    }
                    $tomador['nome__completo'] = str_replace("  ", "",substr(utf8_encode($linha), 6, 40));
                    $tipo = substr(utf8_encode($linha), 46, 3);
                
                    if (mb_strpos($tipo, ' ') !== false) {
                        $tipo = explode(' ',$tipo);
                    
                        foreach ($complemento as $key => $comvalor) {
                            $valor = explode('-',$comvalor);
                            if ($valor[0] === str_replace("  ", "",$tipo[0])) {
                                $tomador['complemento__endereco'] = $comvalor;
                            }
                        }
                    }
                
                    $tomador['logradouro'] = str_replace("  ", "",substr(utf8_encode($linha), 47, 40));
                    $tomador['numero'] = str_replace("  ", "",substr(utf8_encode($linha), 86, 5));
                    $tomador['bairro'] = str_replace("  ", "",substr(utf8_encode($linha), 91, 30));
                    $tomador['localidade'] = str_replace("  ", "",substr(utf8_encode($linha), 121, 30));
                    $tomador['uf'] = str_replace("  ", "",substr(utf8_encode($linha), 151, 2));
                    $tomador['cep'] = str_replace("  ", "",substr(utf8_encode($linha), 153, 8));
                    $tomador['telefone'] = str_replace("  ", "",substr(utf8_encode($linha), 161, 12));
                    $tomador['tipo'] = substr($linha, 173, 1) == 1 ? str_replace("  ", "",substr(utf8_encode($linha), 173, 1)) . '-CNPJ' : str_replace("  ", "",substr(utf8_encode($linha), 173, 1)) . '-CPF';
                    $tomador['cnpj'] = str_replace("  ", "",substr(utf8_encode($linha), 174, 14));
                    $verificar = $this->tomador->where([
                        ['tscnpj',$tomador['cnpj']],
                        ['empresa_id',$empresa['empresa']]
                    ])->count();
                    // dd($tomador);
                    if (!$verificar) {
                        $tomadors = $this->tomador->cadastro($tomador);
                        if ($tomadors) {
                            $tomador['tomador'] = $tomadors['id'];
                            array_push($idtomador,$tomadors['id']);
                            foreach ($tabela as $t => $tabelas) {
                                // dd((int) str_replace("  ", "",substr(utf8_encode($tabelas), 6, 6)));
                               
                                    // dd($tabelas,$tomador['matricula'],str_replace("  ", "",substr(utf8_encode($tabelas), 6, 6)));
                                    foreach ($rublicas as $key => $rublica) {
                                        if ($tomador['matricula'] ===  str_replace("  ", "",substr(utf8_encode($tabelas), 8, 4))) {
                                        // dd((int)str_replace("  ", "",substr(utf8_encode($tabelas), 12, 4)));
                                            $date = str_replace("  ", "",substr(utf8_encode($tabelas), 2, 4));
                                            if ((int)str_replace("  ", "",substr(utf8_encode($tabelas), 12, 4)) == 1 && $rublica->rsrublica == 1000) {
                                                // $date = str_replace("  ", "",substr(utf8_encode($tabelas), 2, 6));
                                                // $date = substr_replace($date, '-', 2, 0);
                                                // dd($date);
                                                $dadostabelapreco = [
                                                    'ano' => $date,
                                                    'rubricas' =>  $rublica->rsrublica,
                                                    'descricao' =>$rublica->rsdescricao,
                                                    'status' => '',
                                                    'valor' => number_format((float)str_replace("  ", "",substr(utf8_encode($tabelas), 65, 4)), 2, ',', '.'),
                                                    'valor__tomador' =>number_format((float)str_replace("  ", "",substr(utf8_encode($tabelas), 65, 4)), 2, ',', '.'),
                                                    'empresa' => $empresa['empresa'],
                                                    'tomador' => $tomadors['id']
                                                ];
                                                $veritabela = $this->tabelapreco->where([
                                                    ['tomador_id', $tomadors['id']],
                                                    ['tsrubrica',$rublica->rsrublica],
                                                    ['tsano',$date],
                                                ])->count();
                                                if (!$veritabela) {
                                                    $this->tabelapreco->cadastro($dadostabelapreco);
                                                }
                                                // $this->tabelapreco->cadastro($dadostabelapreco);
                                            } 
                                            if ((int)str_replace("  ", "",substr(utf8_encode($tabelas), 12, 4)) == 2 && $rublica->rsrublica == 1002) {
                                                
                                            
                                                $dadostabelapreco = [
                                                    'ano' => $date,
                                                    'rubricas' =>  $rublica->rsrublica,
                                                    'descricao' =>$rublica->rsdescricao,
                                                    'status' => '',
                                                    'valor' => number_format((float)str_replace("  ", "",substr(utf8_encode($tabelas), 65, 4)), 2, ',', '.'),
                                                    'valor__tomador' =>number_format((float)str_replace("  ", "",substr(utf8_encode($tabelas), 65, 4)), 2, ',', '.'),
                                                    'empresa' => $empresa['empresa'],
                                                    'tomador' => $tomadors['id']
                                                ];
                                                $veritabela = $this->tabelapreco->where([
                                                    ['tomador_id', $tomadors['id']],
                                                    ['tsrubrica',$rublica->rsrublica],
                                                    ['tsano',$date],
                                                ])->count();
                                                if (!$veritabela) {
                                                    $this->tabelapreco->cadastro($dadostabelapreco);
                                                }
                                            }
                                            if ((int)str_replace("  ", "",substr(utf8_encode($tabelas), 12, 4)) == 3 && $rublica->rsrublica == 1003) {
                                                
                                            
                                                $dadostabelapreco = [
                                                    'ano' => $date,
                                                    'rubricas' =>  $rublica->rsrublica,
                                                    'descricao' =>$rublica->rsdescricao,
                                                    'status' => '',
                                                    'valor' => number_format((float)str_replace("  ", "",substr(utf8_encode($tabelas), 65, 4)), 2, ',', '.'),
                                                    'valor__tomador' =>number_format((float)str_replace("  ", "",substr(utf8_encode($tabelas), 65, 4)), 2, ',', '.'),
                                                    'empresa' => $empresa['empresa'],
                                                    'tomador' => $tomadors['id']
                                                ];
                                                $veritabela = $this->tabelapreco->where([
                                                    ['tomador_id', $tomadors['id']],
                                                    ['tsrubrica',$rublica->rsrublica],
                                                    ['tsano',$date],
                                                ])->count();
                                                if (!$veritabela) {
                                                    $this->tabelapreco->cadastro($dadostabelapreco);
                                                }
                                            }
                                            if ((int)str_replace("  ", "",substr(utf8_encode($tabelas), 12, 4)) == 4 && $rublica->rsrublica == 1004) {
                                                
                                            
                                                $dadostabelapreco = [
                                                    'ano' => $date,
                                                    'rubricas' =>  $rublica->rsrublica,
                                                    'descricao' =>$rublica->rsdescricao,
                                                    'status' => '',
                                                    'valor' => number_format((float)str_replace("  ", "",substr(utf8_encode($tabelas), 65, 4)), 2, ',', '.'),
                                                    'valor__tomador' =>number_format((float)str_replace("  ", "",substr(utf8_encode($tabelas), 65, 4)), 2, ',', '.'),
                                                    'empresa' => $empresa['empresa'],
                                                    'tomador' => $tomadors['id']
                                                ];
                                                $veritabela = $this->tabelapreco->where([
                                                    ['tomador_id', $tomadors['id']],
                                                    ['tsrubrica',$rublica->rsrublica],
                                                    ['tsano',$date],
                                                ])->count();
                                                if (!$veritabela) {
                                                    $this->tabelapreco->cadastro($dadostabelapreco);
                                                }
                                            }
                                            if ((int)str_replace("  ", "",substr(utf8_encode($tabelas), 12, 4)) == 5 && $rublica->rsrublica == 1005) {
                                                
                                            
                                                $dadostabelapreco = [
                                                    'ano' => $date,
                                                    'rubricas' =>  $rublica->rsrublica,
                                                    'descricao' =>$rublica->rsdescricao,
                                                    'status' => '',
                                                    'valor' => number_format((float)str_replace("  ", "",substr(utf8_encode($tabelas), 65, 4)), 2, ',', '.'),
                                                    'valor__tomador' =>number_format((float)str_replace("  ", "",substr(utf8_encode($tabelas), 65, 4)), 2, ',', '.'),
                                                    'empresa' => $empresa['empresa'],
                                                    'tomador' => $tomadors['id']
                                                ];
                                                $veritabela = $this->tabelapreco->where([
                                                    ['tomador_id', $tomadors['id']],
                                                    ['tsrubrica',$rublica->rsrublica],
                                                    ['tsano',$date],
                                                ])->count();
                                                if (!$veritabela) {
                                                    $this->tabelapreco->cadastro($dadostabelapreco);
                                                }
                                            }
                                      
                                        }
                                        // else{
                                        //     $dadostabelapreco = [
                                        //         'ano' => date('Y'),
                                        //         'rubricas' => $rublica->rsrublica,
                                        //         'descricao' => $rublica->rsdescricao,
                                        //         'status' => '',
                                        //         'valor' => 0,
                                        //         'valor__tomador' => 0,
                                        //         'empresa' =>  $empresa['empresa'],
                                        //         'tomador' => $tomadors['id']
                                        //     ];
                                        //     $veritabela = $this->tabelapreco->where([
                                        //         ['tomador_id', $tomadors['id']],
                                        //         ['tsrubrica',$rublica->rsrublica],
                                        //         ['tsano',date('Y')],
                                        //     ])->count();
                                        //     if (!$veritabela) {
                                        //         $this->tabelapreco->cadastro($dadostabelapreco);
                                        //     }
                                        // }
                                    }
                                // else{
                                //     foreach ($rublicas as $key => $rublica) {
                                //         $dadostabelapreco = [
                                //             'ano' => date('Y'),
                                //             'rubricas' => $rublica->rsrublica,
                                //             'descricao' => $rublica->rsdescricao,
                                //             'status' => '',
                                //             'valor' => 0,
                                //             'valor__tomador' => 0,
                                //             'empresa' =>  $empresa['empresa'],
                                //             'tomador' => $tomadors['id']
                                //         ];
                                //         $veritabela = $this->tabelapreco->where([
                                //             ['tomador_id', $tomadors['id']],
                                //             ['tsrubrica',$rublica->rsrublica],
                                //             ['tsano',date('Y')],
                                //         ])->count();
                                //         if (!$veritabela) {
                                //             $this->tabelapreco->cadastro($dadostabelapreco);
                                //         }
                                //     }
                                // }
                            }
                            $incidefolhars = $this->incidefolhar->cadastro($tomador);
                            $enderecos = $this->endereco->cadastro($tomador);
                            $taxas = $this->taxa->cadastro($tomador);
                            $bancarios = $this->bancario->cadastro($tomador);
                            // $retencaofaturas = $retencaofatura->cadastro($dados);
                            $cartaoponto = $this->cartaoponto->cadastro($tomador);
                            $parametrosefips = $this->parametrosefip->cadastro($tomador);
                            // $taxatrabalhador = $taxatrabalhador->cadastro($dados);
                            $indicefaturas = $this->indicefatura->cadastro($tomador);
                        }
                    }
                }
            }
        //    dd($idtomador);
            $matricula = max($matricula);
            $this->valorrublica->where('empresa_id', $empresa['empresa'])
            ->chunkById(100, function ($valorrublica) use ($matricula,$empresa,$matual) {
                foreach ($valorrublica as $valorrublicas) {
                    if ($valorrublicas->vimatriculartomador >= 0 && $matricula > $matual->vimatriculartomador) {
                        $this->valorrublica->where('empresa_id', $empresa['empresa'])
                        ->update(['vimatriculartomador'=>$matricula]);
                    }
                }
            });
        
        return response()->json(['result' => true], 200);
        try {
        } catch (\Throwable $th) {
            $this->valorrublica->where('empresa_id', $empresa['empresa'])
            ->chunkById(100, function ($valorrublica) use ($matual,$empresa) {
                foreach ($valorrublica as $valorrublicas) {
                    if ($valorrublicas->vimatriculartomador >= 0) {
                        $this->valorrublica->where('empresa_id', $empresa['empresa'])
                        ->update(['vimatriculartomador'=>$matual->vimatriculartomador]);
                    }
                }
            });
            $this->tomador->whereIn('id',$idtomador)->delete();
            return response()->json(['result' => true], 500);
           
        }
    }
}
