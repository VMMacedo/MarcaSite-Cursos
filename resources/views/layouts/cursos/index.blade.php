@extends('layouts.principal.index')
@section('title', 'Cursos')
@section('ContentTitle', 'Cursos')
@section('content')
    <button type="button" class="btn btn-dark btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addcurso"
        id="adicionarcurso"><i class="fas fa-plus"></i> Adicionar</button>
    <table id="table-curso" class="table table-hover table-sm align-middle" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Quantidade Máxima</th>
                <th>Ínicio</th>
                <th>Fim</th>
                <th>Material</th>
                <th class="text-center">Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cursos as $curso)
                <tr>
                    <td> {{ $curso->id }}</td>
                    <td>{{ $curso->nome }}</td>
                    <td>{{ $curso->descricao }}</td>
                    <td>{{ 'R$ ' . number_format($curso->valor, 2, ',', '.') }}</td>
                    <td class="text-center">{{ $curso->qtdmaxima }}</td>
                    <td>{{ date('d/m/Y', strtotime($curso->datainicio)) }}</td>
                    <td>{{ date('d/m/Y', strtotime($curso->datafim)) }}</td>
                    <td>
                        @if ($curso->material)
                            <a href="{{ route('cursos.download.material', $curso->id) }}" download="{{ $curso->nome }}">
                                Download
                            </a>
                        @else
                            Sem material
                        @endif
                    </td>
                    <td class="text-center">
                        <button type="button" value="{{ $curso->id }}" class="btn btn-secondary btn-sm editcurso"
                            id="editcurso" data-bs-toggle="modal" data-bs-target="#editcursomodal"><i
                                class="fas fa-edit"></i>
                            Editar</button>
                        <button type="button" value="{{ $curso->id }}" class="btn btn-danger btn-sm deletecurso mr-2"
                            id="deletecurso" data-bs-toggle="modal" data-bs-target="#deletecursomodal"><i
                                class="fas fa-trash-alt"></i>
                            Excluir</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Modal Cursos Adicionar -->
    <div class="modal fade" id="addcurso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" id="form_cursos_create" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adicionar Curso</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" required class="form-control" id="nome" name="nome"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <input type="text" name="descricao" id="descricao" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="valor" class="form-label">Valor</label>
                            <input type="number" step="0.01" required name="valor" id="valor" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="datainicio" class="form-label">Data de Ínicio</label>
                            <input type="date" required name="datainicio" id="datainicio" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="datafim" class="form-label">Data Final</label>
                            <input type="date" required name="datafim" id="datafim" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="qtdmaxima" class="form-label">Quantidade Máxima</label>
                            <input type="number" required name="qtdmaxima" id="qtdmaxima" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="material" class="form-label">Material</label>
                            <input type="file" required name="material" id="material" class="form-control">
                        </div>
                        <div id="alert_addcurso">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" value="">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Cursos Editar -->
    <div class="modal fade" id="editcursomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" id="form_cursos_edit" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="idedit" id="idedit" value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Curso</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <input type="text" name="descricao" id="descricao" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="valor" class="form-label">Valor</label>
                            <input type="number" step="0.01" name="valor" id="valor" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="datainicio" class="form-label">Data de Ínicio</label>
                            <input type="date" name="datainicio" id="datainicio" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="datafim" class="form-label">Data Final</label>
                            <input type="date" name="datafim" id="datafim" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="qtdmaxima" class="form-label">Quantidade Máxima</label>
                            <input type="number" name="qtdmaxima" id="qtdmaxima" class="form-control">
                        </div>
                        <p id="materialDown" class="text-danger">
                            <a href="" download="">
                                Download
                            </a>
                        </p>
                        <div class="mb-3">
                            <label for="material" class="form-label">Material</label>
                            <input type="file" name="material" id="material" class="form-control">
                        </div>
                        <div id="alert_editcurso">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" value="">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Usuários Destroy -->
    <div class="modal fade" id="deletecursomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" id="form_curso_destroy">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="idDelete" id="idDelete" value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deletar Curso</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3>Deseja excluir este Curso?</h3>
                        <div id="alert_destroycurso">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                        <button type="submit" class="btn btn-primary" value="">Sim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var config = {
            routes: {
                create: "{{ route('cursos.create') }}",
                destroy: "{{ route('cursos.destroy', '') }}",
                show: "{{ route('cursos.show', '') }}",
                download: "{{ route('cursos.download.material', '') }}",
                edit: "{{ route('cursos.put', '') }}",
            }

        };
    </script>
    <script src="{{ asset('js/cursos/script.js') }}"></script>
@endsection
