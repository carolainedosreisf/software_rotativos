
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
    
}

?>