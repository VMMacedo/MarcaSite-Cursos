/**VIEW E EDIT CURSO */
$(document).on('click', '.editcurso', function () {
    var idUser = $(this).val();
    $('#idedit').val(idUser);

    showCurso(idUser);
});


$(document).on('submit', '#form_cursos_edit', function (e) {
    e.preventDefault();
    var idUser = $('#idedit').val();
    var values = new FormData(this);
    putcurso(idUser, values)
});

function putcurso(idUser, values) {
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
        cache: false,
        contentType: false,
        processData: false,
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
            $('#alert_editcurso').html(alert);
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

            $('#alert_editcurso').html(alert);
        }
    });
}

function showCurso(idUser) {
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
                $('#form_cursos_edit #nome').val(data.nome);
                $('#form_cursos_edit #descricao').val(data.descricao);
                $('#form_cursos_edit #valor').val(data.valor);
                $('#form_cursos_edit #datainicio').val(data.datainicio);
                $('#form_cursos_edit #datafim').val(data.datafim);
                $('#form_cursos_edit #qtdmaxima').val(data.qtdmaxima);
                if (data.material) {
                    $('#form_cursos_edit #materialDown a').prop('href', config.routes.download + '/' + data.id);
                    $('#form_cursos_edit #materialDown a').prop('Download', data.nome);
                } else {
                    $('#form_cursos_edit #materialDown a').prop('href', '#');
                }


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
            $('#alert_editcurso').html(alert);
        }
    });
}


/**DELETAR CURSO - INICIO */
$(document).on('click', '.deletecurso', function () {
    var idUser = $(this).val();
    $('#idDelete').val(idUser);
    //deleteUser(idUser);
});
$(document).on('submit', '#form_curso_destroy', function (e) {
    e.preventDefault();
    var idUser = $('#idDelete').val();
    deleteCurso(idUser)
});
function deleteCurso(idUser) {
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
            $('#alert_destroycurso').html(alert);
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

            $('#alert_destroycurso').html(alert);
        }
    });
}
/**DELETAR CURSO - FIM */

/**CRIAR CURSO */
$(document).on('submit', '#form_cursos_create', function (e) {
    e.preventDefault();
    //var values = $(this).serialize();
    var values = new FormData(this);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: config.routes.create,
        data: values,
        //dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data === true || data === '1') {
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
            $('#alert_addcurso').html(alert);
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
            $('#alert_addcurso').html(alert);

        }
    });


});