@extends('layouts.principal.index')
@section('title', 'Inscrição')
@section('ContentTitle', 'Inscrição')
@section('content')
    <button type="button" class="btn btn-dark btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addinscrito"
        id="adicionarinscrito"><i class="fas fa-plus"></i> Adicionar</button>
    <table id="table-inscricao" class="table table-hover table-sm align-middle" style="width:100%, ">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Categoria</th>
                <th>CPF</th>
                <th>UF</th>
                <th>Status</th>
                <th>Curso</th>
                <th>Valor</th>
                <th class="text-center">Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inscricoes as $inscricao)
                <tr>
                    <td> {{ $inscricao->id }}</td>
                    <td>{{ $inscricao->nome }}</td>
                    <td>{{ $inscricao->email }}</td>
                    <td>{{ $inscricao->categoria }}</td>
                    <td>{{ $inscricao->cpf }}</td>
                    <td>{{ $inscricao->uf }}</td>
                    <td>
                        <select class="form-select statusInscrito" data-id="{{ $inscricao->id }}" id="statusInscrito"
                            name="statusInscrito" aria-label="Status do Inscrito">
                            <option {{ $inscricao->status == 0 ? 'selected' : '' }} value="0">Pendente</option>
                            <option {{ $inscricao->status == 1 ? 'selected' : '' }} value="1">Pago</option>
                            <option {{ $inscricao->status == 2 ? 'selected' : '' }} value="2">Cancelado</option>
                        </select>

                    </td>
                    <td>{{ $inscricao->cursonome }}</td>
                    <td>{{ 'R$ ' . number_format($inscricao->cursovalor, 2, ',', '.') }}</td>
                    <td class="text-center">
                        <div class="row">
                            <div class="col-4">
                                <button type="button" value="{{ $inscricao->id }}" class="btn btn-success btn-sm linkpag"
                                    id="linkpag" title="Link PagSeguro">
                                    <i class="fas fa-money-bill-wave"></i></button>
                            </div>
                            <div class="col-4">
                                <button type="button" value="{{ $inscricao->id }}"
                                    class="btn btn-secondary btn-sm editinscrito" id="editinscrito" title="Editar"
                                    data-bs-toggle="modal" data-bs-target="#editinscritomodal"><i
                                        class="fas fa-edit"></i>
                                </button>
                            </div>
                            <div class="col-4">
                                <button type="button" value="{{ $inscricao->id }}"
                                    class="btn btn-danger btn-sm deleteinscrito " title="Excluir" id="deleteinscrito"
                                    data-bs-toggle="modal" data-bs-target="#deleteinscritomodal"><i
                                        class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="alert_geral">

    </div>
    <!-- Modal Inscritos Adicionar -->
    <div class="modal fade" id="addinscrito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">

                <form method="POST" id="form_inscrito_create">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Realizar Inscrição</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="nome" class="form-label">Nome</label>
                                    <input type="text" required class="form-control" id="nome" name="nome"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="empresa" class="form-label">Empresa</label>
                                    <input type="text" required class="form-control" id="empresa" name="empresa"
                                        aria-describedby="empresa">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" required name="email" id="email" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input type="number" required name="cpf" id="cpf" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="categoria" class="form-label">Categoria</label>
                                    <select class="form-select" name="categoria" id="categoria"
                                        aria-label="Default select example">
                                        <option disabled selected>Selecione...</option>
                                        <option value="Estudante">Estudante</option>
                                        <option value="Profissional">Profissional</option>
                                        <option value="Associado">Associado</option>

                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="crusoid" class="form-label">Cursos</label>
                                    <select class="form-select crusoid" name="cursoid" id="cursoid"
                                        aria-label="Default select example">
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="senha" class="form-label">Senha</label>
                                    <input type="password" required name="senha" id="senha" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="senhaConfirmar" class="form-label">Confirmar Senha</label>
                                    <input type="password" required name="senhaConfirmar" id="senhaConfirmar"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="cep" class="form-label">CEP</label>
                                    <input type="number" required name="cep" id="cep" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="rua" class="form-label">Rua</label>
                                    <input type="text" required name="rua" id="rua" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="numero" class="form-label">Número</label>
                                            <input type="text" required name="numero" id="numero" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="complemento" class="form-label">Complemento</label>
                                            <input type="text" name="complemento" id="complemento" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="bairro" class="form-label">Bairro</label>
                                    <input type="text" required name="bairro" id="bairro" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="cidade" class="form-label">Cidade</label>
                                    <input type="text" required name="cidade" id="cidade" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="uf" class="form-label">UF</label>
                                    <input type="text" required name="uf" id="uf" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <input type="number" name="telefone" id="telefone" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="celular" class="form-label">Celular</label>
                                    <input type="number" required name="celular" id="celular" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div id="alert_addinscrito"></div>
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
    <div class="modal fade" id="editinscritomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <form method="POST" id="form_inscrito_edit">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="idedit" id="idedit" value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Inscrito</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="nome" class="form-label">Nome</label>
                                    <input type="text" required class="form-control" id="nome" name="nome"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="empresa" class="form-label">Empresa</label>
                                    <input type="text" required class="form-control" id="empresa" name="empresa"
                                        aria-describedby="empresa">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" required name="email" id="email" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input type="number" required name="cpf" id="cpf" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="categoria" class="form-label">Categoria</label>
                                    <select class="form-select" name="categoria" id="categoria"
                                        aria-label="Default select example">
                                        <option disabled selected>Selecione...</option>
                                        <option value="Estudante">Estudante</option>
                                        <option value="Profissional">Profissional</option>
                                        <option value="Associado">Associado</option>

                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="crusoid" class="form-label">Cursos</label>
                                    <select class="form-select crusoid" name="cursoid" id="cursoid"
                                        aria-label="Default select example">
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="senha" class="form-label">Senha</label>
                                    <input type="password" name="senha" id="senha" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="senhaConfirmar" class="form-label">Confirmar Senha</label>
                                    <input type="password" name="senhaConfirmar" id="senhaConfirmar"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="cep" class="form-label">CEP</label>
                                    <input type="number" required name="cep" id="cep" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="rua" class="form-label">Rua</label>
                                    <input type="text" required name="rua" id="rua" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="numero" class="form-label">Número</label>
                                            <input type="text" required name="numero" id="numero" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="complemento" class="form-label">Complemento</label>
                                            <input type="text" name="complemento" id="complemento" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="bairro" class="form-label">Bairro</label>
                                    <input type="text" required name="bairro" id="bairro" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="cidade" class="form-label">Cidade</label>
                                    <input type="text" required name="cidade" id="cidade" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="uf" class="form-label">UF</label>
                                    <input type="text" required name="uf" id="uf" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <input type="number" name="telefone" id="telefone" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="celular" class="form-label">Celular</label>
                                    <input type="number" required name="celular" id="celular" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div id="alert_inscrito"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" value="">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Inscritos Destroy -->
    <div class="modal fade" id="deleteinscritomodal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" id="form_inscrito_destroy">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="idDelete" id="idDelete" value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deletar Inscrito</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3>Deseja excluir este Inscrito?</h3>
                        <div id="alert_destroyinscrito">
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
                create: "{{ route('inscricao.create') }}",
                destroy: "{{ route('inscricao.destroy', '') }}",
                show: "{{ route('inscricao.show', '') }}",
                edit: "{{ route('inscricao.put', '') }}",
                showCursos: "{{ route('cursos.get') }}",
                editStatus: "{{ route('inscricao.pustatus', '') }}",
                linkPag: "{{ route('inscricao.linkPagamento', '') }}"
            }

        };
    </script>
    <script src="{{ asset('js/inscricao/script.js') }}"></script>
@endsection
