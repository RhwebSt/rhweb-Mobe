<?php

namespace App\Http\Controllers\Administrador\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
use App\Endereco;
use App\Bancario;
use App\Nascimento;
use App\Categoria;
use App\Documento;
use App\Dependente;
use App\Bolcartaoponto;
use App\Lancamentorublica;
use App\Comissionado;
use App\ValoresRublica;
use App\BaseCalculo;
use App\Esocial;
use App\Arquivo;
class BancoController extends Controller
{
    private $trabalhador,$endereco,$bancario,$nascimento,$categoria,$valorrublica,
    $documento,$dependente,$bolcartaoponto,$lancamentorublica,$comissionado,$basecalculo,
    $esocial,$arquivo;
    public function __construct()
    {
        $this->trabalhador = new Trabalhador;
        $this->endereco = new Endereco;
        $this->bancario = new Bancario;
        $this->nascimento = new Nascimento;
        $this->categoria = new Categoria;
        $this->valorrublica = new ValoresRublica;
        $this->documento = new Documento;
        $this->dependente = new Dependente;
        $this->bolcartaoponto = new Bolcartaoponto;
        $this->lancamentorublica = new Lancamentorublica; 
        $this->comissionado = new Comissionado;
        $this->basecalculo = new BaseCalculo;  
        $this->esocial = new Esocial; 
        $this->arquivo = new Arquivo;
    }
    public function cadastroTxt(Request $request)
    {
        $file = $request->file('file');
        $empresa = $request->all('empresa');
        $dados = file($file);
        $matricula = [];
        $idtrabalhador = [];
        $matual = $this->valorrublica->where('empresa_id',$empresa['empresa'])->first();
        
            foreach ($dados as $key => $linha) {
                $trabalhador = [
                    'nome__completo' => '',
                    'nome__social' => '',
                    'foto'=>'',
                    'grau__instrucao'=>'',
                    'raca'=>'',
                    'cpf' => '',
                    'pis'=>'',
                    'rg'=>'',
                    'dataEmissaoRg'=>'',
                    'ufRg'=>'',
                    'data_nascimento'=>'',
                    'pais__nascimento'=>'',
                    'pais__nacionalidade'=>'', 
                    'nome__mae'=>'',
                    'sexo'=>'',
                    'estado__civil'=>'',
                    'telefone'=>'',
                    'cep'=>'',
                    'logradouro'=>'',
                    'numero'=>'',
                    'bairro'=>'',
                    'localidade'=>'',
                    'uf'=>'',
                    'data__admissao'=>'',
                    'categoria__contrato'=>'',
                    'cbo'=>'',
                    'ctps'=>'',
                    'serie__ctps'=>'',
                    'uf__ctps'=>'',
                    'data__afastamento'=>'',
                    'banco'=>'',
                    'agencia'=>'',
                    'operacao'=>'',
                    'conta'=>'',
                    'pix'=>'',
                    'situacao__contrato'=>'',
                    'empresa'=>$empresa['empresa'],
                    'tomador'=>null
                ];
                $trabalhador['matricula'] = str_replace("  ", "",substr(utf8_encode($linha), 0, 6));
                if ($trabalhador['matricula']) {
                    array_push($matricula,(int)$trabalhador['matricula']);
                }
                $trabalhador['nome__completo'] = str_replace("  ", "",substr(utf8_encode($linha), 6, 40));
                $trabalhador['logradouro'] = str_replace("  ", "",substr(utf8_encode($linha), 40, 40));
                $trabalhador['numero'] = str_replace("  ", "",substr(utf8_encode($linha), 111, 5));
                $trabalhador['localidade'] = str_replace("  ", "",substr(utf8_encode($linha), 116, 30));
                $trabalhador['cep'] = str_replace("  ", "",substr(utf8_encode($linha), 146, 8));
                $trabalhador['uf'] = str_replace("  ", "",substr(utf8_encode($linha), 155, 2));
                $telefone = str_replace("  ", "",substr(utf8_encode($linha), 157, 12));
                $ddd = '('.substr($telefone, 0, 2).')';
                $telefone = substr($telefone, 2, 10);
                $trabalhador['telefone'] = $ddd.$telefone;
                // $trabalhador['situacao__contrato'] = str_replace("  ", "",str_replace("0", "",substr(utf8_encode($linha), 602, 8)));
                $trabalhador['cbo'] = str_replace("  ", "",substr(utf8_encode($linha), 171, 6));
                $datanascimento = str_replace("  ", "",substr($linha, 176, 8));
                $dia = substr($datanascimento, 0, 2);
                $mes = substr($datanascimento, 2,2);
                $ano = substr($datanascimento, 4,4);
                $datanascimento = $ano.'-'.$mes.'-'.$dia;
                $trabalhador['data_nascimento'] = $datanascimento;
                if (str_replace("  ", "",substr(utf8_encode($linha), 185, 1)) == 'M') {
                    $trabalhador['sexo'] = 'Masculino';
                }elseif (str_replace("  ", "",substr(utf8_encode($linha), 185, 1)) == 'F') {
                    $trabalhador['sexo'] = 'Feminino';
                }else{
                    $trabalhador['sexo'] = 'Outro';
                }
                if (str_replace("  ", "",substr(utf8_encode($linha), 186, 1)) == '1') {
                    $trabalhador['estado__civil'] = '1-Solteiro';
                }elseif (str_replace("  ", "",substr(utf8_encode($linha), 186, 1)) == '2') {
                    $trabalhador['estado__civil'] = '2-Casado';
                }elseif (str_replace("  ", "",substr(utf8_encode($linha), 186, 1)) == '3') {
                    $trabalhador['estado__civil'] = '3-Divorciados';
                }elseif (str_replace("  ", "",substr(utf8_encode($linha), 186, 1)) == '4') {
                    $trabalhador['estado__civil'] = '4-Separados';
                }elseif (str_replace("  ", "",substr(utf8_encode($linha), 186, 1)) == '5'){
                    $trabalhador['estado__civil'] = '5-Viúvo';
                }
                $trabalhador['nome__mae'] = str_replace("  ", "",substr(utf8_encode($linha), 227, 40));

                $trabalhador['conta'] = str_replace("  ", "",substr(utf8_encode($linha), 278, 13));
                $trabalhador['ufRg'] = str_replace("  ", "",substr(utf8_encode($linha), 330, 2));
                $trabalhador['rg'] = str_replace("  ", "",substr(utf8_encode($linha), 306, 15));
                $dataemissao = str_replace("  ", "",substr($linha, 321, 8));
                $dia = substr($dataemissao, 0, 2);
                $mes = substr($dataemissao, 2,2);
                $ano = substr($dataemissao, 4,4);
                $dataemissao = $ano.'-'.$mes.'-'.$dia;
                $trabalhador['dataEmissaoRg'] = $dataemissao;
            
                
                $trabalhador['cpf'] = str_replace("  ", "",substr(utf8_encode($linha), 391, 11));
                $trabalhador['pis'] = str_replace("  ", "",substr(utf8_encode($linha), 406, 11));
                if (str_replace("  ", "",substr(utf8_encode($linha), 473, 1)) == '1') {
                    $trabalhador['raca'] = '1-Branco';
                }elseif (str_replace("  ", "",substr(utf8_encode($linha), 473, 1)) == '2') {
                    $trabalhador['raca'] = '2-Preta';
                }elseif (str_replace("  ", "",substr(utf8_encode($linha), 473, 1)) == '3') {
                    $trabalhador['raca'] = '3-Pardo';
                }elseif (str_replace("  ", "",substr(utf8_encode($linha), 473, 1)) == '4') {
                    $trabalhador['raca'] = '4-Amarela';
                }elseif (str_replace("  ", "",substr(utf8_encode($linha), 473, 1)) == '5') {
                    $trabalhador['raca'] = '5-Indígena';
                }else{
                    $trabalhador['raca'] = '6-Não informado';
                }
                $dataafastamento = str_replace("  ", "",substr($linha, 477, 8));
                $dia = substr($dataafastamento, 0, 2);
                $mes = substr($dataafastamento, 2,2);
                $ano = substr($dataafastamento, 4,4);
                $dataafastamento = $ano.'-'.$mes.'-'.$dia;
                if ($dataafastamento === '0000-00-00') {
                    $trabalhador['situacao__contrato'] = 'ATIVO';
                }
                $trabalhador['data__afastamento'] = $dataafastamento;
                $trabalhador['categoria__contrato'] = str_replace("  ", "",substr(utf8_encode($linha), 485, 3));
                $dataadimissao = str_replace("  ", "",substr($linha, 726, 8));
                $dia = substr($dataadimissao, 0, 2);
                $mes = substr($dataadimissao, 2,2);
                $ano = substr($dataadimissao, 4,4);
                $dataadimissao = $ano.'-'.$mes.'-'.$dia;
                $trabalhador['data__admissao'] = $dataadimissao;
                $trabalhador['banco'] = str_replace("  ", "",substr(utf8_encode($linha), 735, 3));
                $trabalhador['agencia'] = str_replace("  ", "",substr(utf8_encode($linha), 738, 5));
                $trabalhador['operacao'] = str_replace("  ", "",substr(utf8_encode($linha), 743, 4));
                // dd($trabalhador);
                $verifica = $this->trabalhador->where([
                    ['tscpf', $trabalhador['cpf']],
                    ['empresa_id',$empresa['empresa']]
                ])->count();
                if (!$verifica) {
                    $trabalhadors = $this->trabalhador->cadastro($trabalhador);
                    if ($trabalhadors) {
                        array_push($idtrabalhador,$trabalhadors['id']);
                        $trabalhador['trabalhador'] = $trabalhadors['id'];
                        $enderecos = $this->endereco->cadastro($trabalhador); 
                        $bancarios = $this->bancario->cadastro($trabalhador);
                        $nascimentos = $this->nascimento->cadastro($trabalhador);
                        $categorias = $this->categoria->cadastro($trabalhador);
                        $documentos = $this->documento->cadastro($trabalhador);
                        $this->arquivo->cadastrorg($trabalhador);
                    }
                }
              
            }
            $matricula = max($matricula);
            $this->valorrublica->where('empresa_id', $empresa['empresa'])
            ->chunkById(100, function ($valorrublica) use ($matricula, $empresa,$matual) {
                foreach ($valorrublica as $valorrublicas) {
                    if ($valorrublicas->vimatricular >= 0 && $matricula > $matual->vimatricular) {
                        $this->valorrublica->where('empresa_id',$empresa['empresa'])
                        ->update(['vimatricular'=>$matricula]);
                    }
                }
            });
            return response()->json(['result' => true], 200);
            try {  
        } catch (\Throwable $th) {
            $this->valorrublica->where('empresa_id', $empresa['empresa'])
            ->chunkById(100, function ($valorrublica) use ($matual, $empresa) {
                foreach ($valorrublica as $valorrublicas) {
                    if ($valorrublicas->vimatricular >= 0) {
                        $this->valorrublica->where('empresa_id',$empresa['empresa'])
                        ->update(['vimatricular'=>$matual->vimatricular]);
                    }
                }
            });
            $this->trabalhador->whereIn('id',$idtrabalhador)->delete();
            return response()->json(['result' => true], 500);
        }
       
    }
}
