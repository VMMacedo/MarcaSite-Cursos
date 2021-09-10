<?php

namespace App\Http\Controllers;

use App\Models\inscricao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
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
            ->limit(7)
            ->get();
        $pendente = inscricao::where('status', 0)->get()->count();
        $pago = inscricao::where('status', 1)->get()->count();
        $cancelado = inscricao::where('status', 2)->get()->count();

        $cursototal = DB::table('inscricao')
            ->select(array(
                'cursos.nome',
                DB::raw('count(cursos.nome) as total')
            ))
            ->join('cursos', 'cursos.id', '=', 'inscricao.cursoid')
            ->groupBy('cursos.nome')
            ->orderBy('nome', 'asc')
            ->get();
            
        $array = array(
            compact('pendente'),
            compact('pago'),
            compact('cancelado'),
            compact('inscricoes'),
            compact('cursototal')
        );

        return $array;
    }
}
