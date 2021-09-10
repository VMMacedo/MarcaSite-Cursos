$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'GET',
        url: config.routes.show,
        //data: { 'status': value },
        beforeSend: function () {
            var load = '<div class="spinner-border text-dark" style="width: 5rem; height: 5rem;" role="status">';
            load += '<span class="visually-hidden">Loading...</span>';
            load += '</div>';
            $('#alertageral').html(load)
        },
        success: function (data) {
            if (typeof data === 'object') {
                $('#alertageral').html('');
                var pendente = data[0]['pendente'];
                var pago = data[1]['pago'];
                var cancelado = data[2]['cancelado'];
                google.charts.load('current', {
                    packages: ['corechart', 'table', 'bar']
                });
                var cursosInscritos = data[4]['cursototal'];
                var inscritostabela = data[3]['inscricoes'];

                google.charts.setOnLoadCallback(function () { drawChart(pendente, pago, cancelado) });
                google.charts.setOnLoadCallback(function () { drawChart2(cursosInscritos) });
                google.charts.setOnLoadCallback(function () { drawTable3(inscritostabela) });

                var inscritos = data[3]['inscricoes'].length;
                $('#card1').html(card1(inscritos));
                $('#card2').html(card2(pago));
            } else {
                $('#alertageral').html(data)
            }


        },
        error: function (data) {
            $('#alertageral').html('');
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

            $('#alertageral').html(alert);
        }
    });
});

function card1(value) {
    var card1 = ' <div class="card text-white bg-success mb-3">';
    card1 += '<div class="card-header h3">Inscritos</div>';
    card1 += '<div class="card-body">';
    card1 += '<p class="card-text fs-1">' + value + '</p>';
    card1 += '</div>';
    card1 += '</div>';

    return card1;
}

function card2(value) {
    var card2 = ' <div class="card text-dark bg-info mb-3">';
    card2 += '<div class="card-header h3">Pago</div>';
    card2 += '<div class="card-body">';
    card2 += '<p class="card-text fs-1">' + value + '</p>';
    card2 += '</div>';
    card2 += '</div>';

    return card2;
}

function drawChart(pendente, pago, cancelado) {
    var data = google.visualization.arrayToDataTable([
        ['Status', 'Total'],
        ['Pendente', pendente],
        ['Pago', pago],
        ['Cancelado', cancelado]
    ]);

    var options = {
        title: 'Status Inscrito',
        is3D: true,
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
    chart.draw(data, options);
}


function drawChart2(cursosInscritos) {
    var array = [
        ['Curso', 'Total']
    ];


    $.each(cursosInscritos, function (i, val) {
        array.push([val['nome'], parseInt(val['total'])])
    })
    var data = new google.visualization.arrayToDataTable(array);

    var options = {
        legend: { position: 'none' },
        chart: {
            title: 'Inscritos por Curso',
        },
        hAxis: {
            title: 'Cursos',
        },
        vAxis: {
            title: 'Total'
        },

    };

    var chart = new google.visualization.ColumnChart(
        document.getElementById('chart_div'));
    chart.draw(data, options);
}


function drawTable3(inscritostabela) {
    var array = [];
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Nome');
    data.addColumn('string', 'UF');
    data.addColumn('string', 'Categoria');
    data.addColumn('string', 'Curso');
    $.each(inscritostabela, function (i, val) {
        array.push([val['nome'], val['uf'], val['categoria'], val['cursonome']])
    })
    data.addRows(array);

    var table = new google.visualization.Table(document.getElementById('table_div'));

    table.draw(data, {
        showRowNumber: true,
        width: '100%',
        height: '100%'
    });
}