<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script type="text/javascript"
        src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <title>Checkout de Pagamento</title>
    <style>
        .main iframe {
            border: none;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

    </style>
</head>

<body style="background: rgb(207, 206, 206)">
    <div class="container-sm">
        <div class="row justify-content-md-center mt-5">
            <div class="col-8">
                <div class="card text-center ">
                    <div class="card-header">
                        Checkout de Pagamento
                    </div>
                    <div class="card-body">
                        <div id="alert_checkout"></div>
                        <div class="row justify-content-md-center mt-2">
                            <div class="col-11">
                                <div class="card bg-secondary text-white">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="text-start"><strong>CLIENTE</strong></p>
                                                <p class="text-start">{{ $inscricao[0]->nome }}</p>
                                            </div>
                                            <div class="col-6">
                                                <p class="text-end"><strong>DOCUMENTO</strong></p>
                                                <p class="text-end">{{ $inscricao[0]->cpf }}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <p class="text-start"><strong>DETALHES DA FATURA</strong></p>
                                        <p class="text-start">Inscrição - {{ $inscricao[0]->cursonome }}
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-end"><strong>VENCIMENTO</strong></p>
                                        <p class="text-end">
                                            {{ date('d/m/Y', strtotime('+3 days', strtotime(now()))) }}
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <p class="text-start"><strong>VALOR</strong></p>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-end">
                                            {{ 'R$ ' . number_format($inscricao[0]->valor, 2, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                    aria-selected="true"> <i class="fas fa-barcode"></i> Boleto</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                    aria-selected="false"><i class="far fa-credit-card"></i> Cartão de Crédito</button>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div id="alert-boleto"></div>
                                <div class="main">
                                    <iframe class="boleto" src=""></iframe>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="container mt-3">
                                    <div class="row">

                                        <div class="col-md-12 order-md-1">
                                            <h4 class="mb-3">Endereço de cobrança</h4>
                                            <form class="needs-validation" method="POST" id="formPagamentoCreditCard"
                                                novalidate>
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="primeiroNome">Nome</label>
                                                        <input type="text" class="form-control" id="primeiroNome"
                                                            name="primeiroNome" placeholder="" value=""
                                                            required>
                                                        <div class="invalid-feedback">
                                                            É obrigatório inserir um nome válido.
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="sobrenome">Sobrenome</label>
                                                        <input type="text" class="form-control" id="sobrenome"
                                                            name="sobrenome" placeholder="" value="" required>
                                                        <div class="invalid-feedback">
                                                            É obrigatório inserir um sobre nome válido.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <div class="mb-3">
                                                            <label for="email">Email </label>
                                                            <input type="email" class="form-control" id="email"
                                                                name="email" placeholder="fulano@exemplo.com"
                                                                value="" required>
                                                            <div class="invalid-feedback">
                                                                Por favor, insira um endereço de e-mail válido.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <div class="mb-3">
                                                            <label for="email">Data Nascimento </label>
                                                            <input type="date" class="form-control" id="datanasc"
                                                                name="datanasc"  value=""
                                                                required>
                                                            <div class="invalid-feedback">
                                                                Por favor, insira uma data válida.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 mb-3">
                                                        <div class="mb-3">
                                                            <label for="email">DDD </label>
                                                            <input type="number" class="form-control" id="ddd"
                                                                name="ddd" placeholder="38"
                                                                value="" required>
                                                            <div class="invalid-feedback">
                                                                Por favor, insira um ddd válido.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <div class="mb-3">
                                                            <label for="email">Telefone </label>
                                                            <input type="tel" class="form-control" id="telefone"
                                                                name="telefone" placeholder="fulano@exemplo.com"
                                                                value="" required>
                                                            <div class="invalid-feedback">
                                                                Por favor, insira um telefone válido.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="row">
                                                    <div class="col-md-3 mb-3">
                                                        <label for="cep">CEP</label>
                                                        <input type="number" class="form-control" value=""
                                                            id="cep" name="cep" placeholder="39400081" required>
                                                        <div class="invalid-feedback">
                                                            É obrigatório inserir um CEP.
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 mb-3">
                                                        <label for="endereco">Endereço</label>
                                                        <input type="text" class="form-control" value=""
                                                            id="endereco" name="endereco" placeholder="Rua dos bobos"
                                                            required>
                                                        <div class="invalid-feedback">
                                                            Por favor, insira seu endereço.
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="bairro">Bairro </label>
                                                        <input type="text" class="form-control" id="bairro"
                                                            name="bairro" placeholder="Bairro" value="" required>
                                                        <div class="invalid-feedback">
                                                            Por favor, insira seu bairro.
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2 mb-3">
                                                        <label for="numero">Número </label>
                                                        <input type="number" class="form-control" id="numero"
                                                            name="numero" placeholder="100" value="" required>
                                                        <div class="invalid-feedback">
                                                            Por favor, insira seu número.
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 mb-3">
                                                        <label for="numero">Complemento </label>
                                                        <input type="number" class="form-control" value=""
                                                            id="complemento" name="complemento" placeholder="A">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="cidade">Cidade</label>
                                                        <input type="text" class="form-control" id="cidade"
                                                            name="cidade" placeholder="Montes Claros"
                                                            value="" required>
                                                        <div class="invalid-feedback">
                                                            Por favor, insira uma CIdade válido.
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 mb-3">
                                                        <label for="UF">UF</label>
                                                        <input type="text" class="form-control" id="uf" value=""
                                                            name="uf" placeholder="MG" required>
                                                        <div class="invalid-feedback">
                                                            Por favor, insira um estado válido.
                                                        </div>
                                                    </div>

                                                </div>
                                                <hr class="mb-4">

                                                <h4 class="mb-3">Pagamento</h4>

                                                <table style="width: 100%" cellpadding="10">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label for="cc-nome">Nome no cartão</label>
                                                                        <input type="text" class="form-control"
                                                                            id="cc-nome" name="cc-nome" value="" placeholder=""
                                                                            required>
                                                                        <small class="text-muted">Nome completo,
                                                                            como
                                                                            mostrado no
                                                                            cartão.</small>
                                                                        <div class="invalid-feedback">
                                                                            O nome que está no cartão é obrigatório.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label for="cc-nome">CPF</label>
                                                                        <input type="text" class="form-control"
                                                                            id="cc_cpf" name="cc_cpf" value="" placeholder="12309845698"
                                                                            required>
                                                                        <div class="invalid-feedback">
                                                                            O cpf do proprietário do cartão é obrigatório. 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12"><label
                                                                            for="cc-numero">Número do cartão de
                                                                            crédito</label>
                                                                        <input type="text" class="form-control"
                                                                            id="cc-numero" name="cc-numero"
                                                                            placeholder="" value=""
                                                                            required>
                                                                        <div class="invalid-feedback">
                                                                            O número do cartão de crédito é obrigatório.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6"> <label
                                                                            for="cc-expiracao">Data de expiração</label>
                                                                        <input type="text" value="" class="form-control"
                                                                            id="cc-expiracao" name="cc-expiracao"
                                                                            placeholder="12/2026" required>
                                                                        <div class="invalid-feedback">
                                                                            Data de expiração é obrigatória.
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6"> <label
                                                                            for="cc-cvv">CVV</label>
                                                                        <input type="text" class="form-control"
                                                                            id="cc-cvv" value="" name="cc-cvv"
                                                                            placeholder="" required>
                                                                        <div class="invalid-feedback">
                                                                            Código de segurança é obrigatório.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="demo-container">
                                                                    <div class="card-wrapper"></div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>

                                                <div id="alert_card" class="mt-3">

                                                </div>
                                                <hr class="mb-4">
                                                <button class="btn btn-primary btn-lg btn-block btn-submit-form"
                                                    type="submit">Continuar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        MarcaSite Cursos
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>

    <script>
        var id = {{ $inscricao[0]->idinscrito }};
        var config = {
            routes: {
                gerarBoleto: "{{ route('checkout.gerarBoleto', ['', '']) }}",
                gerarCartaoCredito: "{{ route('checkout.gerarCartaoCredito', ['', '', '']) }}"
            },
            idSession: '{{ $idSession }}',
            inscricao: '{{ $inscricao[0]->valor }}'

        };
    </script>
    <script src="{{ asset('js/checkout/card/card.js') }}"></script>
    <script>
        var c = new Card({
            form: document.getElementById('formPagamentoCreditCard'),
            container: '.card-wrapper',
            formSelectors: {
                numberInput: 'input#cc-numero', // optional — default input[name="number"]
                expiryInput: 'input#cc-expiracao', // optional — default input[name="expiry"]
                cvcInput: 'input#cc-cvv', // optional — default input[name="cvc"]
                nameInput: 'input#cc-nome' // optional - defaults input[name="name"]
            },
            formatting: true,
            messages: {
                validDate: 'expire\ndate',
                monthYear: 'mm/yy'
            }
        });
    </script>
    <script src="{{ asset('js/checkout/script.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.min.js"
        integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous">
    </script>

</body>

</html>
