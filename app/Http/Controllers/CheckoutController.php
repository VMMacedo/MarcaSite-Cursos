<?php

namespace App\Http\Controllers;

use App\Models\gateway;
use App\Models\inscricao;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**CONTROLLER PARA VERIFICAR O ID DA INSCRICAO E GERAR NOVO PAGAMENTO */
    public function index($id)
    {
        $inscricao = inscricao::select('inscricao.id as idinscrito', 'inscricao.nome as nome', 'cpf', 'cursos.nome as cursonome', 'cursos.valor as valor')
            ->where('inscricao.id', $id)
            ->join('cursos', 'inscricao.cursoid', '=', 'cursos.id')
            ->get();

        if (!$inscricao || sizeof($inscricao) == 0) {
            return false;
        } else {
            //return $inscricao;
            $idSession = $this->gerarSessao();

            return view('layouts.checkout.index')->with('inscricao', $inscricao)->with('idSession', $idSession);
        }
    }

    /**Geração de boleto pelo Pagseguro */
    public function gerarBoleto($id, $hash)
    {
        $inscricao = inscricao::select(
            'inscricao.nome as nome',
            'cpf',
            'cursos.nome as cursonome',
            'cursos.valor as valor',
            'rua',
            'bairro',
            'numero',
            'cidade',
            'uf',
            'complemento',
            'cep',
            'email',
            'telefone'
        )
            ->where('inscricao.id', $id)
            ->join('cursos', 'inscricao.cursoid', '=', 'cursos.id')
            ->get();

        if (!$inscricao || sizeof($inscricao) == 0) {
            return false;
        } else {

            $gateway = $this->getToken();
            if ($gateway != false) {

                $client = new \GuzzleHttp\Client();
                $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions?email=" . $gateway->email . "&token=" . $gateway->token . "";
                $params = [
                    'form_params' => [
                        'paymentMethod' => 'boleto',
                        'paymentMode' => 'default',
                        'currency' => 'BRL',
                        'extraAmount' => '0.00',
                        'feeAmount' => '0.00',
                        'itemId1' => $id,
                        'itemDescription1' => 'Inscrição - ' . $inscricao[0]->cursonome,
                        'itemAmount1' => (string) number_format($inscricao[0]->valor, 2, '.', ''),
                        'itemQuantity1' => '1',
                        'notificationURL' => $gateway->urlnotificacao,
                        'reference' => $id,
                        'senderName' => $inscricao[0]->nome,
                        'senderCPF' => $inscricao[0]->cpf,
                        'senderAreaCode' => substr($inscricao[0]->telefone, 0, 2),
                        'senderPhone' => substr($inscricao[0]->telefone, 2),
                        'senderEmail' => $inscricao[0]->email,
                        'senderHash' => $hash,
                        'shippingAddressRequired' => false,
                        'undefined' => ''
                    ]
                ];
                try {
                    $request = $client->post($url, $params);

                    if ($request->getStatusCode() == 200) {
                        $response = $request->getBody()->getContents();
                        $responseXml = simplexml_load_string($response);
                        $json = json_encode($responseXml);
                        $array = json_decode($json, TRUE);
                        return $array;
                    } else {
                        return 'Erro ao gerar Boleto.';
                    }
                } catch (\Throwable $th) {
                    throw $th;
                }
            } else {
                return false;
            }
        }
    }

    /**GERAR PAGAMENTO COM CARTÃO DE CRÉDITO */
    public function gerarCartaoCredito(Request $request, $id, $token, $hash)
    {


        $inscricao = inscricao::select(
            'inscricao.nome as nome',
            'cpf',
            'cursos.nome as cursonome',
            'cursos.valor as valor',
            'rua',
            'bairro',
            'numero',
            'cidade',
            'uf',
            'complemento',
            'cep',
            'email',
            'telefone'
        )
            ->where('inscricao.id', $id)
            ->join('cursos', 'inscricao.cursoid', '=', 'cursos.id')
            ->get();

        if (!$inscricao || sizeof($inscricao) == 0) {
            return false;
        } else {

            $gateway = $this->getToken();
            if ($gateway != false) {

                $client = new \GuzzleHttp\Client();
                $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions?email=" . $gateway->email . "&token=" . $gateway->token . "";
                $params = [
                    'form_params' => [
                        'paymentMode' => 'default',
                        'paymentMethod' => 'creditCard',
                        'receiverEmail' => $inscricao[0]->email,
                        'currency' => 'BRL',
                        'extraAmount' => '0.00',
                        'itemId1' => '1',
                        'itemDescription1' => 'Inscrição - ' . $inscricao[0]->cursonome,
                        'itemAmount1' => (string) number_format($inscricao[0]->valor, 2, '.', ''),
                        'itemQuantity1' => '1',
                        'notificationURL' => $gateway->urlnotificacao,
                        'reference' => $id,
                        'senderName' => $inscricao[0]->nome,
                        'senderCPF' => $inscricao[0]->cpf,
                        'senderAreaCode' => substr($inscricao[0]->telefone, 0, 2),
                        'senderPhone' => substr($inscricao[0]->telefone, 2),
                        'senderEmail' => $inscricao[0]->email,
                        'senderHash' => $hash,
                        'shippingAddressRequired' => false,
                        /*'shippingAddressStreet' => 'Av.%20Brig.%20Faria%20Lima',
                        'shippingAddressNumber' => '1384',
                        'shippingAddressComplement' => '5o%20andar',
                        'shippingAddressDistrict' => 'Jardim%20Paulistano',
                        'shippingAddressPostalCode' => '1452002',
                        'shippingAddressCity' => 'Sao%20Paulo',
                        'shippingAddressState' => 'SP',
                        'shippingAddressCountry' => 'BRA',
                        'shippingType' => '1',
                        'shippingCost' => '01.00',*/
                        'creditCardToken' => $token,
                        'installmentQuantity' => '1',
                        'installmentValue' => (string) number_format($inscricao[0]->valor, 2, '.', ''),
                        //'noInterestInstallmentQuantity' => '1',
                        'creditCardHolderName' => $request->primeiroNome . ' ' . $request->sobrenome,
                        'creditCardHolderCPF' => $request->cc_cpf,
                        'creditCardHolderBirthDate' => date('d/m/Y', strtotime(str_replace("-", "/", $request->datanasc))),
                        'creditCardHolderAreaCode' => $request->ddd,
                        'creditCardHolderPhone' => $request->telefone,
                        'billingAddressStreet' => $request->endereco,
                        'billingAddressNumber' => $request->numero,
                        'billingAddressComplement' => $request->complemento,
                        'billingAddressDistrict' => $request->bairro,
                        'billingAddressPostalCode' => $request->cep,
                        'billingAddressCity' => $request->cidade,
                        'billingAddressState' => $request->uf,
                        'billingAddressCountry' => 'BRA',
                        'receiverEmail' => $gateway->email
                    ]
                ];

                try {
                    $request = $client->post($url, $params);

                    if ($request->getStatusCode() == 200) {
                        $response = $request->getBody()->getContents();
                        $responseXml = simplexml_load_string($response);
                        $json = json_encode($responseXml);
                        $array = json_decode($json, TRUE);
                        return $array;
                    } else {
                        return 'Erro ao gerar Boleto.';
                    }
                } catch (\Throwable $th) {
                    throw $th;
                }
            } else {
                return false;
            }
        }
    }

    public function tratarWebhook(Request $request)
    {
        header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");
        /**Tratando as notificações vinda do PAGSEGURO */
        if (isset($request->notificationType) && $request->notificationType == 'transaction') {
            $gateway = $this->getToken();
            if ($gateway != false) {
                $client = new \GuzzleHttp\Client(['defaults' => [
                    'verify' => false
                ]]);
                $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/' . $request->notificationCode . '?email=' . $gateway->email . '&token=' . $gateway->token;
                $params = [];
                $request = $client->get($url, $params);
                $response = $request->getBody()->getContents();
                if ($request == 'Unauthorized') {
                    return false;
                }
                $responseXml = simplexml_load_string($response);
                
                $status = (int) $responseXml->status;
                /**VERIFICAR STATUS PAGO e atualizar na tabela*/
                if ($status === 3) {
                    $inscrito = inscricao::find($responseXml->reference);
                    if (!$inscrito) {
                        return false;
                    } else {
                        $inscrito->forceFill([
                            'status' => 1,
                        ])->save();
                        return true;
                    }
                }
                /*$json = json_encode($transaction);
                $array = json_decode($json,TRUE);*/
            }
        }
    }

    /**Função para gerar sessao para pagamento do Pagseguro */
    private function gerarSessao()
    {
        $gateway = $this->getToken();
        if ($gateway != false) {
            $client = new \GuzzleHttp\Client();
            $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions?email=" . $gateway->email . "&token=" . $gateway->token . "";
            $myBody = array();
            try {
                $request = $client->post($url,  ['form_params' => $myBody]);
                if ($request->getStatusCode() == 200) {
                    $response = $request->getBody()->getContents();
                    $responseXml = simplexml_load_string($response);
                    $id = $responseXml->id;
                    return $id;
                } else {
                    return 'Erro ao gerar Sessão.';
                }
            } catch (\Throwable $th) {
                return $th;
            }
        } else {
            return false;
        }
    }

    private function getToken()
    {
        $gateway = gateway::get()->first();

        return $gateway;
    }
}
