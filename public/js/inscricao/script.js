
$(document).on('click', '.linkpag', function () {
    var idUser = $(this).val();
    var button = $(this);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        //url: '{{ route("perfil.index") }}',
        url: config.routes.linkPag + '/' + idUser,
        //data: { 'status': value },
        beforeSend: function () {
            var loading = '<div class="spinner-border text-dark spinner-border-sm" role="status">';
            loading += '<span class="visually-hidden">Loading...</span>'
            loading += '</div>';
            button.html(loading);
            button.prop('disabled', true);
        },
        success: function (data) {
            button.html('<i class="fas fa-money-bill-wave"></i>');
            button.prop('disabled', false);
            $('#alert_geral').html('');
            if (data == 'er01') {
                var alert =
                    '<div class="alert alert-warning d-flex align-items-center" role="alert">';
                alert +=
                    '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">';
                alert += '<use xlink:href="#exclamation-triangle-fill"/></svg>'
                alert += '<div>';
                alert += '<ul>';
                alert += '<li> Token não cadastrado. </li>';
                alert += '</ul>';
                alert += '</div>';
                alert += '</div>';

                $('#alert_geral').html(alert);
            } else {
                var url = 'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=' + data;
                window.open(url, "Link de Pagamento");
            }


        },
        error: function (data) {
            $(this).html('');
            $(this).prop('disabled', false);
            $('#alert_geral').html('');
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

            $('#alert_geral').html(alert);
        }
    });
});
/**MUDANÇA DO STATUS */
$(document).on('change', '.statusInscrito', function () {

    var value = $(this).val();
    var idUser = $(this).attr("data-id")

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        //url: '{{ route("perfil.index") }}',
        url: config.routes.editStatus + '/' + idUser,
        data: { 'status': value },
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
            //$('#alert_geral').html(alert);
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

            $('#alert_geral').html(alert);
        }
    });
});


$(document).on('click', '#adicionarinscrito', function () {
    carregarCursos();
});
/**MOSTRAR CURSOS */
function carregarCursos() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'GET',
        //url: '{{ route("perfil.index") }}',
        url: config.routes.showCursos,
        //data: formData,
        dataType: 'json',
        success: function (data) {
            var options = '<option selected disabled>Selecione...</option>';

            $.each(data['cursos'], function (i, val) {
                options += '<option value = "' + val['id'] +
                    '" >' + val['nome'] + ' </option>';
            });

            $('.crusoid').html(options);
        },
        error: function (data) {
            console.log(data);
        }
    });
}

/**CRIAR INSCRITO */
$(document).on('submit', '#form_inscrito_create', function (e) {
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
            $('#alert_addinscrito').html(alert);
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
            $('#alert_addinscrito').html(alert);

        }
    });


});

/**PREENCHIMENTO DO CEP */
$(document).ready(function () {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");

    }

    //Quando o campo cep perde o foco.
    $("#cep").blur(function () {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");


                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#uf").val(dados.uf);

                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});

/**DELETAR INSCRITO - INICIO */
$(document).on('click', '.deleteinscrito', function () {
    var idUser = $(this).val();
    $('#idDelete').val(idUser);
    //deleteUser(idUser);
});
$(document).on('submit', '#form_inscrito_destroy', function (e) {
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
            $('#alert_destroyinscrito').html(alert);
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

            $('#alert_destroyinscrito').html(alert);
        }
    });
}
/**DELETAR INSCRITO - FIM */

/**VIEW E EDIT CURSO */
$(document).on('click', '.editinscrito', function () {
    var idUser = $(this).val();
    $('#idedit').val(idUser);
    carregarCursos()
    showInscrito(idUser);
});


$(document).on('submit', '#form_inscrito_edit', function (e) {
    e.preventDefault();
    var idUser = $('#idedit').val();
    //var values = new FormData(this);
    var values = $(this).serialize();
    putinscrito(idUser, values)
});

function putinscrito(idUser, values) {
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
            $('#alert_inscrito').html(alert);
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

            $('#alert_inscrito').html(alert);
        }
    });
}

function showInscrito(idUser) {
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
                $('#form_inscrito_edit #nome').val(data.nome);
                $('#form_inscrito_edit #empresa').val(data.empresa);
                $('#form_inscrito_edit #email').val(data.email);
                $('#form_inscrito_edit #cpf').val(data.cpf);
                $('#form_inscrito_edit #categoria').val(data.categoria);
                $('#form_inscrito_edit #curso').val(data.curso);
                $('#form_inscrito_edit #cep').val(data.cep);
                $('#form_inscrito_edit #rua').val(data.rua);
                $('#form_inscrito_edit #numero').val(data.numero);
                $('#form_inscrito_edit #complemento').val(data.complemento);
                $('#form_inscrito_edit #bairro').val(data.bairro);
                $('#form_inscrito_edit #cidade').val(data.cidade);
                $('#form_inscrito_edit #uf').val(data.uf);
                $('#form_inscrito_edit #telefone').val(data.telefone);
                $('#form_inscrito_edit #celular').val(data.celular);
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
            $('#alert_editinscrito').html(alert);
        }
    });
}
