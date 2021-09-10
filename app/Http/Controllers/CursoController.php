<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCursos;
use App\Models\curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = curso::get();

        return view('layouts.cursos.index', compact('cursos'));;
    }

    public function getcursos()
    {
        
        $cursos = curso::get();

        return compact('cursos');
    }

    public function create(StoreCursos $request)
    {


        $data = $request->all();
        if ($request->material->isValid()) {
            $file = $request->material->store('uploads', ['disk' => 'local']);
            $data['material'] = $file;
        }

        curso::create($data);

        return true;
    }
    public function put(Request $request, $id)
    {
        $curso = curso::find($id);
        if (!$curso) {
            return redirect()->back();
        } else {

            if ($request->material) {
                $validator = Validator::make($request->all(), [
                    'nome' => ['required', 'min:5', 'max:255'],
                    'descricao' => ['required', 'min:5', 'max:255'],
                    'valor' => ['required'],
                    'datainicio' => ['required'],
                    'datafim' => ['required'],
                    'qtdmaxima' => ['required'],
                    'material' => ['required', 'mimes:jpg,bmp,png,ppt,pptx,zip,pdf']
                ]);
                if ($validator->fails()) {
                    return $this;
                } else {
                    if ($request->material->isValid()) {
                        $file = $request->material->store('uploads', ['disk' => 'local']);
                        $curso->forceFill([
                            'nome' => $request->nome,
                            'descricao' => $request->descricao,
                            'valor' => $request->valor,
                            'datainicio' => $request->datainicio,
                            'datafim' => $request->datafim,
                            'qtdmaxima' => $request->qtdmaxima,
                            'material' => $file,
                        ])->save();
                    } else {
                        return 'erro';
                    }

                    return true;
                }
            } else {
                $validator = Validator::make($request->all(), [
                    'nome' => ['required', 'min:5', 'max:255'],
                    'descricao' => ['required', 'min:5', 'max:255'],
                    'valor' => ['required'],
                    'datainicio' => ['required'],
                    'datafim' => ['required'],
                    'qtdmaxima' => ['required']

                ]);
                if ($validator->fails()) {
                    return $this;
                } else {
                    $curso->forceFill([
                        'nome' => $request->nome,
                        'descricao' => $request->descricao,
                        'valor' => $request->valor,
                        'datainicio' => $request->datainicio,
                        'datafim' => $request->datafim,
                        'qtdmaxima' => $request->qtdmaxima,
                    ])->save();
                    return true;
                }
            }
        }
    }

    public function show($id)
    {
        $curso = curso::where('id', $id)->first();
        if (!$curso) {
            return false;
        } else {
            return $curso;
        }
    }
    public function download($id)
    {
        $curso = curso::where('id', $id)->first();
        if (!$curso) {
            return false;
        } else {
            return Storage::download($curso->material);
        }
    }

    public function destroy($id)
    {
        $curso = curso::where('id', $id)->first();
        if (!$curso) {
            return false;
        } else {

            $curso->delete();
            return true;
        }
    }
}
