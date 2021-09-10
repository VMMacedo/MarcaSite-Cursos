/**DELETAR INSCRITO - INICIO */
$(document).on('click', '.deletegateway', function () {
    var idUser = $(this).val();
    $('#idDelete').val(idUser);
});
$(document).on('submit', '#form_gateway_destroy', function (e) {
    e.preventDefault();
    var idUser = $('#idDelete').val();
    deleteGateway(idUser)
});
function deleteGateway(idUser) {
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
            $('#alert_destroyGateway').html(alert);
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

            $('#alert_destroyGateway').html(alert);
        }
    });
}
/**DELETAR INSCRITO - FIM */

/**VIEW E EDIT GATEWAY */
$(document).on('click', '.editgateway', function () {
    var idUser = $(this).val();
    $('#idedit').val(idUser);
    showGateway(idUser);
});


$(document).on('submit', '#form_gateway_edit', function (e) {
    e.preventDefault();
    var idUser = $('#idedit').val();
    //var values = new FormData(this);
    var values = $(this).serialize();
    putgateway(idUser, values)
});

function putgateway(idUser, values) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    id = idUser;
    $.ajax({
        type: 'POST',
        //url: '{{ route("perfil.index") }}',
        url: config.routes.edit + '/' + idUser,
        data: values,
        success: function (data) {
            if (data === true || data === '1') {
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
            $('#alert_gatewayedit').html(alert);
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

            $('#alert_gatewayedit').html(alert);
        }
    });
}

function showGateway(idUser) {
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
                $('#form_gateway_edit #email').val(data.email);
                $('#form_gateway_edit #token').val(data.token);
               
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
            $('#alert_gatewayedit').html(alert);
        }
    });
}

/**CRIAR GATEWAY */
$(document).on('submit', '#form_gateway_create', function (e) {
    e.preventDefault();
    var values = $(this).serialize();
    //var values = new FormData(this);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: config.routes.create,
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
            $('#alert_addtoken').html(alert);
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
                    alert += '<li>' + objeto.message + '</li>';
                }
            } catch (e) {
                alert += '<li>' + error + '</li>';
            }

            alert += '</ul>';
            alert += '</div>';
            alert += '</div>';
            $('#alert_addtoken').html(alert);

        }
    });


});