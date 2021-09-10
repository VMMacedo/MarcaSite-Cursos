<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGateway;
use App\Models\gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GatewayController extends Controller
{
    public function index()
    {
        $gateway = gateway::get();

        return view('layouts.gateway.index', compact('gateway'));;
    }

    public function create(StoreGateway $request)
    {

        $count = gateway::get()->count();
        if ($count > 0) {
            return 'Já existe um token cadastrado.';
        }

        $data = $request->all();

        gateway::create($data);
        return true;
    }
    public function show($id)
    {
        $gateway = gateway::where('id', $id)->first();
        if (!$gateway) {
            return false;
        } else {
            return $gateway;
        }
    }

    public function put(StoreGateway $request, $id)
    {
        $gateway = gateway::find($id);
        if (!$gateway) {
            return redirect()->back();
        } else {
            $gateway->forceFill([
                'email' => $request->email,
                'token' => $request->token,
            ])->save();
            return true;
        }
    }

    public function destroy($id)
    {
        $gateway = gateway::where('id', $id)->first();
        if (!$gateway) {
            return false;
        } else {

            $gateway->delete();
            return true;
        }
    }
}
