
$(document).ready(function () {
    $('#table-gaji').dataTable();

    $('#bulan, #tahun').on('change', function () {
        const bulan = $('#bulan').val();
        const tahun = $('#tahun').val();

        $.ajax({
            url: 'http://localhost/penggajian/gaji/get_gaji',
            cache: false,
            data: {
                bulan,
                tahun
            },
            method: 'post',
            success: function (data) {

                $('.container-table').html(data);
                $("#table-gaji").DataTable({
                    destroy: true, //use for reinitialize datatable
                });
            }

        })



        
    })




})


