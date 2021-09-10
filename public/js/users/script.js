$(document).on('click', '.editUser', function () {
    var idUser = $(this).val();
    $('#idedit').val(idUser);
    carregarPerfil();
    showUser(idUser);
});

$(document).on('click', '.deleteUser', function () {
    var idUser = $(this).val();
    $('#idDelete').val(idUser);
    //deleteUser(idUser);
});


$(document).on('click', '#adicionarUser', function () {
    carregarPerfil();
});

$(document).on('submit', '#form_users_destroy', function (e) {
    e.preventDefault();
    var idUser = $('#idDelete').val();
    deleteUser(idUser)
});

$(document).on('submit', '#form_users_edit', function (e) {
    e.preventDefault();
    var idUser = $('#idedit').val();
    var values = $(this).serialize();
    putUser(idUser, values)
});

function putUser(idUser, values) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    id = idUser;
    $.ajax({
        type: 'PUT',
        //url: '{{ route("perfil.index") }}',
        url: config.routes.edit + '/' + idUser,
        data: values,
        dataType: 'json',
        success: function (data) {
            if (data === true || data === 1) {
                var alert =
                    '<div class="alert alert-success d-flex align-items-center" role="alert">';
                alert +=
                    '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">';
                alert += '<use xlink:href="#check-circle-fill"/></svg>'
                alert += '<div>';
                alert += 'Atualizado com Sucesso!';
                alert += '</div>';
                alert += '</div>';

            } else {
                var alert =
                    '<div class="alert alert-primary   d-flex align-items-center" role="alert">';
                alert +=
                    '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">';
                alert += '<use xlink:href="#info-fill"/></svg>'
                alert += '<div>';
                alert += data;
                alert += '</div>';
                alert += '</div>';
            }
            $('#alert_editUser').html(alert);
            document.location.reload(true);
        },
        error: function (data) {
            var alert =
                '<div class="alert alert-warning d-flex align-items-center" role="alert">';
            alert +=
                '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">';
            alert += '<use xlink:href="#exclamation-triangle-fill"/></svg>'
            alert += '<div>';
            alert += '<ul>';

            var error = data.responseText;
            try {
                var objeto = JSON.parse(error);
                if (objeto.hasOwnProperty('errors')) {
                    $.each(objeto.errors, function (i, val) {
                        alert += '<li>' + val[0] + '</li>';
                    });

                } else {
                    alert += '<li>' + error + '</li>';
                }
            } catch (e) {
                alert += '<li>' + error + '</li>';
            }

            alert += '</ul>';
            alert += '</div>';
            alert += '</div>';

            $('#alert_editUser').html(alert);
        }
    });
}

function deleteUser(idUser) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    id = idUser;
    $.ajax({
        type: 'DELETE',
        //url: '{{ route("perfil.index") }}',
        url: config.routes.destroy + '/' + idUser,
        //data: {id: idUser},
        dataType: 'json',
        success: function (data) {
            if (data === true || data === 1) {
                var alert =
                    '<div class="alert alert-success d-flex align-items-center" role="alert">';
                alert +=
                    '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">';
                alert += '<use xlink:href="#check-circle-fill"/></svg>'
                alert += '<div>';
                alert += 'Excluído com Sucesso!';
                alert += '</div>';
                alert += '</div>';

            } else {
                var alert =
                    '<div class="alert alert-primary   d-flex align-items-center" role="alert">';
                alert +=
                    '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">';
                alert += '<use xlink:href="#info-fill"/></svg>'
                alert += '<div>';
                alert += data;
                alert += '</div>';
                alert += '</div>';
            }
            $('#alert_destroyUser').html(alert);
            document.location.reload(true);
        },
        error: function (data) {
            var alert =
                '<div class="alert alert-warning d-flex align-items-center" role="alert">';
            alert +=
                '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">';
            alert += '<use xlink:href="#exclamation-triangle-fill"/></svg>'
            alert += '<div>';
            alert += '<ul>';

            var error = data.responseText;
            try {
                var objeto = JSON.parse(error);
                if (objeto.hasOwnProperty('errors')) {
                    $.each(objeto.errors, function (i, val) {
                        alert += '<li>' + val[0] + '</li>';
                    });

                } else {
                    alert += '<li>' + error + '</li>';
                }
            } catch (e) {
                alert += '<li>' + error + '</li>';
            }

            alert += '</ul>';
            alert += '</div>';
            alert += '</div>';

            $('#alert_destroyUser').html(alert);
        }
    });
}

function showUser(idUser) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    id = idUser;
    $.ajax({
        type: 'GET',
        //url: '{{ route("perfil.index") }}',
        url: config.routes.show + '/' + idUser,
        //data: {id: idUser},
        dataType: 'json',
        success: function (data) {
            if (data.id) {
                $('#editname').val(data.name);
                $('#editemail').val(data.email);
                $('#editid_perfil').val(data.perfilid);
            }
        },
        error: function (data) {
            var alert =
                '<div class="alert alert-warning d-flex align-items-center" role="alert">';
            alert +=
                '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">';
            alert += '<use xlink:href="#exclamation-triangle-fill"/></svg>'
            alert += '<div>';
            alert += '<ul>';

            var error = data.responseText;
            try {
                var objeto = JSON.parse(error);
                if (objeto.hasOwnProperty('errors')) {
                    $.each(objeto.errors, function (i, val) {
                        alert += '<li>' + val[0] + '</li>';
                    });

                } else {
                    alert += '<li>' + error + '</li>';
                }
            } catch (e) {
                alert += '<li>' + error + '</li>';
            }

            alert += '</ul>';
            alert += '</div>';
            alert += '</div>';
            $('#alert_editUser').html(alert);
        }
    });
}

function carregarPerfil() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'GET',
        //url: '{{ route("perfil.index") }}',
        url: config.routes.perfil,
        //data: formData,
        dataType: 'json',
        success: function (data) {
            var options = '<option selected disabled value="0">Selecione...</option>';

            $.each(data['perfils'], function (i, val) {
                options += '<option value = "' + val['id'] +
                    '" >' + val['nome'] + ' </option>';
            });

            $('.id_perfil').html(options);
        },
        error: function (data) {
            console.log(data);
        }
    });
}

$(document).on('submit', '#form_users_create', function (e) {
    e.preventDefault();
    var values = $(this).serialize();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: config.routes.CreateUser,
        data: values,
        dataType: 'json',
        success: function (data) {

            if (data === true || data === 1) {
                var alert =
                    '<div class="alert alert-success d-flex align-items-center" role="alert">';
                alert +=
                    '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">';
                alert += '<use xlink:href="#check-circle-fill"/></svg>'
                alert += '<div>';
                alert += 'Criado com Sucesso!';
                alert += '</div>';
                alert += '</div>';

            } else {
                var alert =
                    '<div class="alert alert-primary   d-flex align-items-center" role="alert">';
                alert +=
                    '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">';
                alert += '<use xlink:href="#info-fill"/></svg>'
                alert += '<div>';
                alert += data;
                alert += '</div>';
                alert += '</div>';
            }
            $('#alert_addUser').html(alert);
            document.location.reload(true);

        },
        error: function (data) {
            var alert =
                '<div class="alert alert-warning d-flex align-items-center" role="alert">';
            alert +=
                '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">';
            alert += '<use xlink:href="#exclamation-triangle-fill"/></svg>'
            alert += '<div>';
            alert += '<ul>';

            var error = data.responseText;
            try {
                var objeto = JSON.parse(error);
                if (objeto.hasOwnProperty('errors')) {
                    $.each(objeto.errors, function (i, val) {
                        alert += '<li>' + val[0] + '</li>';
                    });

                } else {
                    alert += '<li>' + error + '</li>';
                }
            } catch (e) {
                alert += '<li>' + error + '</li>';
            }

            alert += '</ul>';
            alert += '</div>';
            alert += '</div>';
            $('#alert_addUser').html(alert);

        }
    });


});