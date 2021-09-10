<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInscrito;
use App\Models\gateway;
use App\Models\inscricao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class InscricaoController extends Controller
{
    public function index()
    {
        $inscricoes = DB::table('inscricao')
            ->select(array(
                'inscricao.id',
                'inscricao.nome',
                'inscricao.email',
                'inscricao.cpf',
                'inscricao.empresa',
                'inscricao.categoria',
                'cursos.id as cursoid',
                'cursos.nome as cursonome',
                'cursos.valor as cursovalor',
                'inscricao.uf',
                'inscricao.status',
            ))
            ->join('cursos', 'cursos.id', '=', 'inscricao.cursoid')
            ->orderBy('cursos.id', 'desc')
            ->get();

        return view('layouts.inscricao.index', compact('inscricoes'));;
    }

    public function ListInscritos()
    {
        $inscricoes = DB::table('inscricao')
            ->select(array(
                'inscricao.id',
                'inscricao.nome',
                'inscricao.email',
                'inscricao.cpf',
                'inscricao.empresa',
                'inscricao.categoria',
                'cursos.id as cursoid',
                'cursos.nome as cursonome',
                'cursos.valor as cursovalor',
                'inscricao.uf',
                'inscricao.status',
            ))
            ->join('cursos', 'cursos.id', '=', 'inscricao.cursoid')
            ->orderBy('cursos.id', 'desc')
            ->get();

        return compact('inscricoes');
    }

    public function create(CreateInscrito $request)
    {

        $data = $request->all();
        if ($request->senha != $request->senhaConfirmar) {
            return 'Senha Incorreta. Favor verificar';
        }

        inscricao::create($data);
        return true;
    }
    public function put(Request $request, $id)
    {
        if (!$request->cursoid) {
            return 'Selecione o curso';
        }
        $inscrito = inscricao::find($id);
        if (!$inscrito) {
            return redirect()->back();
        } else {
           
            if ($request->senha != "") {
                if ($request->senha != $request->senhaConfirmar) {
                    return 'Senha não correspondente.';
                }

                $validator = Validator::make($request->all(), [
                    'nome' => ['required', 'max:255'],
                    'email' => ['required', 'max:255'],
                    'cpf' => ['required', 'max:13'],
                    'cep' => ['required', 'max:8'],
                    'rua' => ['required', 'max:200'],
                    'bairro' => ['required', 'max:200'],
                    'cidade' => ['required', 'max:200'],
                    'uf' => ['required', 'min:2', 'max:2'],
                    'numero' => ['required', 'min:1', 'max:6'],
                    'empresa' => ['required', 'max:100'],
                    'telefone' => ['max:12'],
                    'celular' => ['required', 'max:12'],
                    'categoria' => ['required', 'max:20'],
                    'senha' => ['required', 'min:8', 'max:30'],
                    'cursoid' => ['required'],
                ]);
                if ($validator->fails()) {
                    return $this;
                }

                $inscrito->forceFill([
                    'nome' => $request->nome,
                    'email' => $request->email,
                    'cpf' => $request->cpf,
                    'cep' => $request->cep,
                    'rua' => $request->rua,
                    'bairro' => $request->bairro,
                    'cidade' => $request->cidade,
                    'uf' => $request->uf,
                    'numero' => $request->numero,
                    'empresa' => $request->empresa,
                    'telefone' => $request->telefone,
                    'celular' => $request->celular,
                    'categoria' => $request->categoria,
                    'senha' => $request->senha,
                    'cursoid' => $request->cursoid
                ])->save();
                return true;
            } else {
                $validator = Validator::make($request->all(), [
                    'nome' => ['required', 'max:255'],
                    'email' => ['required', 'max:255'],
                    'cpf' => ['required', 'max:13'],
                    'cep' => ['required', 'max:8'],
                    'rua' => ['required', 'max:200'],
                    'bairro' => ['required', 'max:200'],
                    'cidade' => ['required', 'max:200'],
                    'uf' => ['required', 'min:2', 'max:2'],
                    'numero' => ['required', 'min:1', 'max:6'],
                    'empresa' => ['required', 'max:100'],
                    'telefone' => ['max:12'],
                    'celular' => ['required', 'max:12'],
                    'categoria' => ['required', 'max:20'],
                    'cursoid' => ['required'],
                ]);
                if ($validator->fails()) {
                    return $this;
                }

                $inscrito->forceFill([
                    'nome' => $request->nome,
                    'email' => $request->email,
                    'cpf' => $request->cpf,
                    'cep' => $request->cep,
                    'rua' => $request->rua,
                    'bairro' => $request->bairro,
                    'cidade' => $request->cidade,
                    'uf' => $request->uf,
                    'numero' => $request->numero,
                    'empresa' => $request->empresa,
                    'telefone' => $request->telefone,
                    'celular' => $request->celular,
                    'categoria' => $request->categoria,
                    'cursoid' => $request->cursoid
                ])->save();
                return true;
            }
        }
    }

    public function putStatus(Request $request, $id)
    {

        $inscrito = inscricao::find($id);
        if (!$inscrito) {
            return redirect()->back();
        } else {
            $inscrito->forceFill([
                'status' => $request->status,
            ])->save();
            return true;
        }
    }

    public function show($id)
    {
        $inscrito = inscricao::where('id', $id)->first();
        if (!$inscrito) {
            return false;
        } else {
            return $inscrito;
        }
    }

    public function destroy($id)
    {
        $inscrito = inscricao::where('id', $id)->first();
        if (!$inscrito) {
            return false;
        } else {

            $inscrito->delete();
            return true;
        }
    }

    public function linkPagamento($id)
    {

        //$inscrito = inscricao::where('id', $id)->first();
        $inscrito = DB::table('inscricao')
            ->select(array(
                'inscricao.id',
                'inscricao.nome',
                'inscricao.email',
                'inscricao.cpf',
                'inscricao.empresa',
                'inscricao.categoria',
                'inscricao.rua',
                'inscricao.numero',
                'inscricao.bairro',
                'inscricao.cep',
                'inscricao.cidade',
                'inscricao.uf',
                'inscricao.complemento',
                'cursos.id as cursoid',
                'cursos.nome as cursonome',
                'cursos.valor as cursovalor',
                'inscricao.uf',
                'inscricao.status',
            ))
            ->join('cursos', 'cursos.id', '=', 'inscricao.cursoid')
            ->where('inscricao.id', $id)
            ->first();
        $gateway = gateway::get()->first();

        if (!$inscrito or $gateway->count() < 1) {
            return 'er01';
        } else {
            $client = new \GuzzleHttp\Client();
            $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/checkout/?email=" . $gateway->email . "&token=" . $gateway->token . "";
            $myBody = array(
                'currency' => 'BRL',
                'itemId1' => $inscrito->cursoid,
                'itemDescription1' => $inscrito->cursonome,
                'itemAmount1' => number_format($inscrito->cursovalor, 2, '.', ''),
                'itemQuantity1' => 1,
                'itemWeight1' => 0,
                'reference' => $inscrito->id,
                'senderName' => $inscrito->nome,
                //'senderAreaCode' => $inscrito,
                //'senderPhone' => $inscrito,
                'senderCPF' => $inscrito->cpf,
                //'senderBornDate' => $inscrito
                'senderEmail' => $inscrito->email,
                'shippingType' => 1,
                'shippingAddressStreet' => $inscrito->rua,
                'shippingAddressNumber' => $inscrito->numero,
                'shippingAddressComplement' => $inscrito->complemento,
                'shippingAddressDistrict' => $inscrito->bairro,
                'shippingAddressPostalCode' => $inscrito->cep,
                'shippingAddressCity' => $inscrito->cidade,
                'shippingAddressState' => $inscrito->uf,
                'shippingAddressCountry' => 'BRA',
                //'extraAmount' => $inscrito,
                'redirectURL' => 'http://local.curso.com/inscricao',
                'notificationURL' => 'http://local.curso.com/webhook',
                'maxUses' => 1,
                'maxAge' => 3000,
                //'shippingCost' => 0.01
                'excludePaymentMethodGroup' => 'BOLETO',
                'paymentMethodGroup1' => 'CREDIT_CARD',
                'paymentMethodConfigKey1_1' => 'MAX_INSTALLMENTS_LIMIT',
                'paymentMethodConfigValue1_1' => '4',
            );
            //dd($myBody);
            try {
                $request = $client->post($url,  ['form_params' => $myBody]);
                if ($request->getStatusCode() == 200) {
                    $response = $request->getBody()->getContents();
                    $responseXml = simplexml_load_string($response);
                    $code = $responseXml->code;
                    return $code;
                } else {
                    return 'Erro ao gerar Cobrança.';
                }
            } catch (\Throwable $th) {
                return $th;
            }
        }
    }
}
