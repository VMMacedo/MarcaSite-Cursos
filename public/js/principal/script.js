$(document).on('click', '.nav-link-menu', function () {
    $('.nav-link-menu').removeClass('active');
    $(this).addClass('active');
});

$(document).ready(function () {
    $('table').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ dados por página",
            "zeroRecords": "Nothing found - sorry",
            "info": "Mostrando _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "Procurar",
            "paginate": {
                "previous": "Anterior",
                "next": "Próximo"
            }
        },
        "order": [[ 0, "desc" ]],
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        initComplete: function () {
            var btns = $('.dt-button');
            btns.addClass('btn btn-primary btn-sm');
            btns.removeClass('dt-button');
           

        }
    });
});