@extends('layouts.principal.index')
@section('title', 'Gateway')
@section('ContentTitle', 'Gateway')
@section('content')
    <button type="button" class="btn btn-dark btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addgatewaymodal"
        id="addgateway"><i class="fas fa-plus"></i> Adicionar</button>
    <table id="table-gateway" class="table table-hover table-sm align-middle" style="width:100%, ">
        <thead>
            <tr>
                <th>#</th>
                <th>Email</th>
                <th>Token</th>
                <th class="text-center">Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gateway as $gate)
                <tr>
                    <td> {{ $gate->id }}</td>
                    <td>{{ $gate->email }}</td>
                    <td>{{ $gate->token }}</td>
                    <td class="text-center">
                        <button type="button" value="{{ $gate->id }}" class="btn btn-secondary btn-sm editgateway"
                            id="editgateway" title="Editar" data-bs-toggle="modal" data-bs-target="#editgatewaymodal"><i
                                class="fas fa-edit"></i>
                            Editar
                        </button>
                        <button type="button" value="{{ $gate->id }}" class="btn btn-danger btn-sm deletegateway"
                            title="Excluir" id="deletegateway" data-bs-toggle="modal"
                            data-bs-target="#deletegatewaymodal"><i class="fas fa-trash-alt"></i>
                            Excluir
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Modal Gateway Adicionar -->
    <div class="modal fade" id="addgatewaymodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <form method="POST" id="form_gateway_create">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Inserir Token</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="">
                            Esse tipo de autenticação é utilizada para que você efetue vendas através da sua conta
                            PagSeguro,
                            informando o <B>e-mail</B> e <B>token</B>, que devem ser encaminhados via parâmetro no momento de sua chamada.
                            O e-mail utilizado será o mesmo do cadastro de sua conta PagSeguro,
                            já o token você pode obtê-lo através de sua tela logada em sua conta PagSeguro.
                        </p>
                        <div class="
                            row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" required class="form-control" id="email" name="email"
                                    aria-describedby="email">
                            </div>
                            <div class="mb-3">
                                <label for="token" class="form-label">Token</label>
                                <input type="text" required class="form-control" id="token" name="token"
                                    aria-describedby="token">
                            </div>
                        </div>
                    </div>
                    <div id="alert_addtoken"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" value="">Salvar</button>
            </div>
            </form>
        </div>
    </div>
    </div>
    <!-- Modal Gateway Editar -->
    <div class="modal fade" id="editgatewaymodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" id="form_gateway_edit">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="idedit" id="idedit" value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Token</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" required class="form-control" id="email" name="email"
                                        aria-describedby="emailHelp">
                                </div>

                                <div class="mb-3">
                                    <label for="token" class="form-label">Token</label>
                                    <input type="text" required name="token" id="token" class="form-control">
                                </div>

                            </div>
                            <div id="alert_gatewayedit"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary" value="">Salvar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- Modal Usuários Destroy -->
    <div class="modal fade" id="deletegatewaymodal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" id="form_gateway_destroy">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="idDelete" id="idDelete" value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deletar Token</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3>Deseja excluir este Token?</h3>
                        <div id="alert_destroyGateway">
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
                create: "{{ route('gateway.create') }}",
                destroy: "{{ route('gateway.destroy', '') }}",
                show: "{{ route('gateway.show', '') }}",
                edit: "{{ route('gateway.put', '') }}"
            }

        };
    </script>
    <script src="{{ asset('js/gateway/script.js') }}"></script>
@endsection
