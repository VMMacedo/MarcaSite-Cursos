@extends('layouts.principal.index')
@section('title', 'Usuários')
@section('ContentTitle', 'Usuários')
@section('content')
    <button type="button" class="btn btn-dark btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addUser"
        id="adicionarUser"><i class="fas fa-plus"></i> Adicionar</button>
    <table id="table-filial" class="table table-hover table-sm align-middle" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Perfil</th>
                <th class="text-center">Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td> {{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->nome }}</td>
                    <td class="text-center">
                        <button type="button" value="{{ $user->id }}" class="btn btn-secondary btn-sm editUser"
                            id="editUser" data-bs-toggle="modal" data-bs-target="#edituser"><i class="fas fa-edit"></i>
                            Editar</button>
                        <button type="button" value="{{ $user->id }}" class="btn btn-danger btn-sm deleteUser mr-2"
                            id="deleteUser" data-bs-toggle="modal" data-bs-target="#deleteuser"><i
                                class="fas fa-trash-alt"></i>
                            Excluir</button>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Usuários Adicionar -->
    <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ route('users.create') }}" method="POST" id="form_users_create">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adicionar Usuário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" required class="form-control" id="name" name="name"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" required name="email" id="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="id_perfil" class="form-label">Perfil</label>
                            <select class="form-select id_perfil" required name="id_perfil" id="id_perfil"
                                aria-label="Default select example">

                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" required name="password" id="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                            <input type="password" required name="password_confirmation" id="password_confirmation"
                                class="form-control">
                        </div>
                        <div id="alert_addUser">
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
    <!-- Modal Usuários Editar -->
    <div class="modal fade" id="edituser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form  method="POST" id="form_users_edit">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="idedit" id="idedit" value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Usuário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" required class="form-control" id="editname" name="name"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" required name="email" id="editemail" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="id_perfil" class="form-label">Perfil</label>
                            <select class="form-select id_perfil" required name="id_perfil" id="editid_perfil"
                                aria-label="Default select example">

                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" name="password" id="editpassword" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                            <input type="password" name="password_confirmation" id="editpassword_confirmation"
                                class="form-control">
                        </div>
                        <div id="alert_editUser">
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
    <div class="modal fade" id="deleteuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" id="form_users_destroy">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="idDelete" id="idDelete" value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deletar Usuário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3>Deseja excluir este usuário?</h3>
                        <div id="alert_destroyUser">
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
                perfil: "{{ route('perfil.index') }}",
                CreateUser: "{{ route('users.create') }}",
                show: "{{ route('users.show', '') }}",
                destroy: "{{ route('users.destroy', '') }}",
                edit: "{{ route('users.put', '') }}"

            },
            vars: {
                users: '{!! $users->toJson() !!}'
            }
        };
    </script>
    <script src="{{ asset('js/users/script.js') }}"></script>
@endsection
