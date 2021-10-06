/*setSessionId*/
PagSeguroDirectPayment.setSessionId(config.idSession);

/*getPaymentMethods*/
PagSeguroDirectPayment.getPaymentMethods({
    amount: config.inscricao,
    success: function (response) {
        console.log(response);
    },
    error: function (response) {
        // Callback para chamadas que falharam.
        console.log(response);
    },
    complete: function (response) {
        // Callback para todas chamadas.
        console.log(response);
    }
});

/*onSenderHashReady*/
PagSeguroDirectPayment.onSenderHashReady(function (response) {
    if (response.status == 'error') {
        console.log(response.message);
        return false;
    }
    hash = response.senderHash; //Hash estará disponível nesta variável.
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        url: config.routes.gerarBoleto + '/' + id + '/' + hash,
        //data: values,
        cache: false,
        contentType: "application/json",
        processData: false,
        beforeSend: function (data) {
            let gif = '<div class="spinner-grow text-primary mt-4" role="status">'
            gif += '<span class="visually-hidden">Loading...</span>'
            gif += '</div> <p><strong>Carregando...</strong></p>'
            $('#alert-boleto').html(gif)
        },
        success: function (data) {
            console.log(data.paymentLink);
            $('#alert-boleto').html("");
            $('.main').css({ height: "700px" });
            $('.boleto').attr('src', data.paymentLink)
        },
        error: function (data) {
            $('#alert-boleto').html("");
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

            $('#alert_checkout').html(alert);
        }
    });
});

$(document).on('submit', '#formPagamentoCreditCard', function (e) {
    e.preventDefault();
    var values = $(this).serialize();
    let cardbin = $('#cc-numero').val().replace(/[^0-9]/g, '');
    let cvv = $('#cc-cvv').val().replace(/[^0-9]/g, '');
    let expiration = $('#cc-expiracao').val().split("/");
    let expirationMonth = expiration[0].replace(/[^0-9]/g, '');
    let expirationYear = expiration[1].replace(/[^0-9]/g, '');
    PagSeguroDirectPayment.getBrand({
        cardBin: cardbin.substring(0, 6),
        success: function (response) {
            let brand = response.brand.name;
            //console.log(response);
            //bandeira encontrada
            PagSeguroDirectPayment.createCardToken({
                cardNumber: cardbin, // Número do cartão de crédito
                brand: brand, // Bandeira do cartão
                cvv: cvv, // CVV do cartão
                expirationMonth: expirationMonth, // Mês da expiração do cartão
                expirationYear: expirationYear, // Ano da expiração do cartão, é necessário os 4 dígitos.
                success: function (response) {
                    let token = response.card.token;

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: config.routes.gerarCartaoCredito + '/' + id + '/' + token + '/' + hash,
                        data: values,
                        cache: false,
                        //contentType: "application/json",
                        processData: false,
                        beforeSend: function (data) {
                            $('.btn-submit-form').html("Carregando...");
                            $('.btn-submit-form').attr('disabled', true);
                        },
                        success: function (data) {
                            $('.btn-submit-form').html("Continuar");
                            $('.btn-submit-form').attr('disabled', false);
                            if (data.code) {
                                let card = '<div class="card text-white bg-success mb-2 mt-3" >';
                                card += '<div class="card-header text-center">Comprovante de Pagamento</div>';
                                card += '<div class="card-body">';
                                card += '<h5 class="card-title text-center">Autenticação</h5>';
                                card += '<p class="card-text text-center">' + data.code + '</p>';
                                card += '</div>';
                                card += '</div>';
                                $('#profile').html(card);
                            }

                        },
                        error: function (data) {
                            $('.btn-submit-form').html("Continuar");
                            $('.btn-submit-form').attr('disabled', false);
                            $('#alert_card').html("");
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

                            $('#alert_card').html(alert);
                        }
                    });
                },
                error: function (response) {
                    var alert =
                        '<div class="alert alert-warning d-flex align-items-center" role="alert">';
                    alert +=
                        '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">';
                    alert += '<use xlink:href="#exclamation-triangle-fill"/></svg>'
                    alert += '<div>';
                    alert += '<ul>';
                    alert += '<li>Dados do cartão incorretos. Favor verificar.</li>';
                    alert += '</ul>';
                    alert += '</div>';
                    alert += '</div>';
                    $('#alert_card').html(alert);
                },
                complete: function (response) {
                    // Callback para todas chamadas.
                }
            });
        },
        error: function (response) {
            var alert =
                '<div class="alert alert-warning d-flex align-items-center" role="alert">';
            alert +=
                '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">';
            alert += '<use xlink:href="#exclamation-triangle-fill"/></svg>'
            alert += '<div>';
            alert += '<ul>';
            alert += '<li>Dados do cartão incorretos. Favor verificar.</li>';
            alert += '</ul>';
            alert += '</div>';
            alert += '</div>';
            $('#alert_card').html(alert);
            //tratamento do erro
        },
        complete: function (response) {
            //tratamento comum para todas chamadas
        }
    });

});

// Exemplo de JavaScript para desativar o envio do formulário, se tiver algum campo inválido.
(function () {
    'use strict';

    window.addEventListener('load', function () {
        // Selecione todos os campos que nós queremos aplicar estilos Bootstrap de validação customizados.
        var forms = document.getElementsByClassName('needs-validation');

        // Faz um loop neles e previne envio
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

