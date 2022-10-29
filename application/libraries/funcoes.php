
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Funcoes {
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    function getPostAngular()
    {
        return json_decode(file_get_contents('php://input'),true);
    }

    function get($campo)
    {
        return isset($_GET[$campo])?$_GET[$campo]:'';
    }

    function formatar_cpf_cnpj($doc) 
    {
 
        $doc = preg_replace("/[^0-9]/", "", $doc);
        $qtd = strlen($doc);
 
        if($qtd >= 11) {
 
            if($qtd === 11 ) {
 
                $docFormatado = substr($doc, 0, 3) . '.' .
                                substr($doc, 3, 3) . '.' .
                                substr($doc, 6, 3) . '.' .
                                substr($doc, 9, 2);
            } else {
                $docFormatado = substr($doc, 0, 2) . '.' .
                                substr($doc, 2, 3) . '.' .
                                substr($doc, 5, 3) . '/' .
                                substr($doc, 8, 4) . '-' .
                                substr($doc, -2);
            }
 
            return $docFormatado;
 
        } else {
            return $doc;
        }
    }

    function formatar_telefone($doc) 
    {
        $qtd = strlen($doc);
        switch ($qtd) {
            case 8:
                $docFormatado = substr($doc, 0, 4) . '-' .
                                substr($doc, 4, 4);
                break;
            case 9:
                $docFormatado = substr($doc, 0, 5) . '-' .
                                substr($doc, 5, 4);
                break;
            case 10:
                $docFormatado = '('.substr($doc, 0, 2) . ') ' .
                                substr($doc, 2, 4) . '-' .
                                substr($doc, 6, 4);
                break;
            case 11:
                $docFormatado = '('.substr($doc, 0, 2) . ') ' .
                                substr($doc, 2, 5) . '-' .
                                substr($doc, 7, 4);
                    break;
            case 12:
                $docFormatado = '+'.substr($doc, 0, 2) .' ' .
                                '('.substr($doc, 2, 2) . ') ' .
                                substr($doc, 4, 4) . '-' .
                                substr($doc, 8, 4);
                break;
            case 13:
                $docFormatado = '+'.substr($doc, 0, 2) .' ' .
                                '('.substr($doc, 2, 2) . ') ' .
                                substr($doc, 4, 5) . '-' .
                                substr($doc, 9, 4);
                    break;
            
            default:
                $docFormatado =  $doc;
                break;
        }

        return $docFormatado;
    }

    function formataData($data)
    {
        $formato = 'd/m/Y';
        $DataEspecifica = DateTime::createFromFormat($formato, $data);
        $retorno = $DataEspecifica->format('Y-m-d');
        return $retorno;
    }

    public function formataHora($desc)
    {
        if(strlen($desc)<4){
            return $desc;
        }
        $desc = trim(str_replace(":","",$desc));
        $hr = substr($desc,0,2);
        $min = substr($desc,2,2);
        return $hr.":".$min;
    }

    public function formataPlacaVeiculo($placa)
    {
        $definidor = substr($placa, 4, 1);
        return is_numeric($definidor) ?(substr($placa, 0, 3).'-'.substr($placa, 3, 4)):$placa;
    }

    public function gerarPdf($html)
    {
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetHTMLFooter('
                <table width="100%">
                    <tr>
                        <td width="50%">'.Date('d/m/Y H:i').'</td>
                        <td width="50%" class="text-right">{PAGENO}/{nbpg}</td>
                    </tr>
                </table>');
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    function getStatusClasse($status,$tipo,$tipo2='P')
    {
        if($tipo2=='P'){
            switch ($status) {
                case 'B':
                    $status_desc = 'Aberto';
                    $classe = 'btn-warning';
                    break;
                case 'A':
                    $status_desc = 'Aguardando Pagamento';
                    $classe = 'btn-danger';
                    break;
                case 'P':
                    $status_desc = 'Processando Pagamento';
                    $classe = 'btn-pocessando-pagamento';
                    break;
                case 'F':
                    $status_desc = 'Finalizado';
                    $classe = 'btn-success';
                    break;
                default:
                    $status_desc = '';;
                    $classe = '';
                    break;
            }
        }else {
            switch ($status) {
                case 'N':
                    $status_desc = 'Não Iniciada';
                    $classe = 'btn-warning';
                    break;
                case 'E':
                    $status_desc = 'Em Andamento';
                    $classe = 'btn-info';
                    break;
                case 'F':
                    $status_desc = 'Finalizada';
                    $classe = 'btn-success';
                    break;
                default:
                    $status_desc = '';;
                    $classe = '';
                    break;
            }
        }
        

        return $tipo=='C'?$classe:$status_desc;
    }

    public function verificaSituacaoEmpresa()
    {
        $EmpresaId = $this->CI->session->userdata('EmpresaId');
        $this->CI->load->model('Pagamentos_model');
        $obj = $this->CI->Pagamentos_model->getVerificaPagamento($EmpresaId);
        return $obj['Situacao'];
    }
    
    public function getEmpresaSoftware()
    {
        $this->CI->load->model('Empresa_model');
        $obj = $this->CI->Empresa_model->getEmpresa(7);
        $obj['NumeroTelefone1Format'] = $this->formatar_telefone($obj['NumeroTelefone1']);
        $obj['NumeroTelefone2Format'] = $this->formatar_telefone($obj['NumeroTelefone2']);
        return $obj;
    }

    public function getMeses($mes=0)
    {
        $meses = [
            '1'=> 'Janeiro',
            '2'=> 'Fevereiro',
            '3'=> 'Março',
            '4'=> 'Abril',
            '5'=> 'Maio',
            '6'=> 'Junho',
            '7'=> 'Julho',
            '8'=> 'Agosto',
            '9'=> 'Setembro',
            '10'=> 'Outubro',
            '11'=> 'Novembro',
            '12'=> 'Dezembro'
        ];

        if($mes==0){
            return $meses;
        }else{
            return $meses[$mes];
        }
    }

    public function getDiasSemana()
    {
        return  [
                '0'=> 'Segunda-feira',
                '1'=> 'Terça-feira',
                '2'=> 'Quarta-feira',
                '3'=> 'Quinta-feira',
                '4'=> 'Sexta-feira',
                '5'=> 'Sábado',
                '6'=> 'Domingo',
            ];
    }

    public function getTiposCahves()
    {
        return  [
                '0'=> 'Chave Pix Não Cadastrada',
                '1'=> 'CNPJ',
                '2'=> 'CPF',
                '3'=> 'E-mail',
                '4'=> 'Telefone',
                '5'=> 'Aleatória',
            ];
    }
}

?>