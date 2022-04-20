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
class BancoController extends Controller
{
    private $trabalhador,$endereco,$bancario,$nascimento,$categoria,$valorrublica,
    $documento,$dependente,$bolcartaoponto,$lancamentorublica,$comissionado,$basecalculo,
    $esocial;
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
    }
    public function cadastroTxt(Request $request)
    {
        $file = $request->file('file');
        $dados = file($file);
        foreach ($dados as $key => $linha) {
            $trabalhador = [
                'nome__completo' => '',
                'nome__social' => '',
                'foto'=>'',
                'grau__instrucao'=>'',
                'raca'=>'',
                'cpf' => '',
                'pis'=>'',
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
                'empresa'=>15,
                'tomador'=>null
            ];
            $trabalhador['matricula'] = str_replace("  ", "",substr(utf8_encode($linha), 0, 6));
            $trabalhador['nome__completo'] = str_replace("  ", "",substr(utf8_encode($linha), 6, 40));
            $trabalhador['logradouro'] = str_replace("  ", "",substr(utf8_encode($linha), 40, 40));
            $trabalhador['numero'] = str_replace("  ", "",substr(utf8_encode($linha), 111, 5));
            $trabalhador['localidade'] = str_replace("  ", "",substr(utf8_encode($linha), 116, 30));
            $trabalhador['cep'] = str_replace("  ", "",substr(utf8_encode($linha), 146, 8));
            $trabalhador['uf'] = str_replace("  ", "",substr(utf8_encode($linha), 154, 2));
            $telefone = str_replace("  ", "",substr(utf8_encode($linha), 156, 12));
            $ddd = '('.substr($telefone, 0, 2).')';
            $telefone = substr($telefone, 2, 10);
            $trabalhador['telefone'] = $ddd.$telefone;
            $trabalhador['situacao__contrato'] = str_replace("  ", "",str_replace("0", "",substr(utf8_encode($linha), 602, 8)));
            $datanascimento = str_replace("  ", "",substr($linha, 176, 8));
            $dia = substr($datanascimento, 0, 2);
            $mes = substr($datanascimento, 2,2);
            $ano = substr($datanascimento, 4,4);
            $datanascimento = $ano.'-'.$mes.'-'.$dia;
            $trabalhador['data_nascimento'] = $datanascimento;
            if (str_replace("  ", "",substr(utf8_encode($linha), 184, 1)) == 'M') {
                $trabalhador['sexo'] = 'Masculino';
            }elseif (str_replace("  ", "",substr(utf8_encode($linha), 184, 1)) == 'F') {
                $trabalhador['sexo'] = 'Feminino';
            }else{
                $trabalhador['sexo'] = 'Outro';
            }
            if (str_replace("  ", "",substr(utf8_encode($linha), 185, 1)) == '1') {
                $trabalhador['estado__civil'] = '1-Solteiro';
            }elseif (str_replace("  ", "",substr(utf8_encode($linha), 185, 1)) == '2') {
                $trabalhador['estado__civil'] = '2-Casado';
            }elseif (str_replace("  ", "",substr(utf8_encode($linha), 185, 1)) == '3') {
                $trabalhador['estado__civil'] = '3-Divorciados';
            }elseif (str_replace("  ", "",substr(utf8_encode($linha), 185, 1)) == '4') {
                $trabalhador['estado__civil'] = '4-Separados';
            }else{
                $trabalhador['estado__civil'] = '5-Viúvo';
            }
            $trabalhador['nome__mae'] = str_replace("  ", "",substr(utf8_encode($linha), 226, 40));
            
            $trabalhadors = $this->trabalhador->cadastro($trabalhador);
            if ($trabalhadors) {
                $trabalhador['trabalhador'] = $trabalhadors['id'];
                $enderecos = $this->endereco->cadastro($trabalhador); 
                $bancarios = $this->bancario->cadastro($trabalhador);
                $nascimentos = $this->nascimento->cadastro($trabalhador);
                $categorias = $this->categoria->cadastro($trabalhador);
                $documentos = $this->documento->cadastro($trabalhador);
            }
        }
        return response()->json(['result' => true], 200);
    }
}
