$(document).ready(function () {
    let numberId = 1;

    $('#jam').on('change', function () {
        let hargaPerJam = 50000;
        let jam = $(this).val();

        console.log('ok');
        $('#nominal_jam_tambahan').val(jam * hargaPerJam);

        $('.currency').toArray().forEach(function (field) {
            new Cleave(field, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        });
    })

    $('#id_guru').on('change', function () {
        const idGuru = $(this).val();


        $.ajax({
            url: 'http://localhost/penggajian/gaji/get_gaji_pokok',
            cache: false,
            data: {
                id_guru: idGuru
            },
            method: 'post',
            success: function (data) {
                const dataGuru = JSON.parse(data);
                console.log(dataGuru.gaji_pokok);
                $('#gaji_pokok').val(dataGuru.gaji_pokok);
                $('.currency').toArray().forEach(function (field) {
                    new Cleave(field, {
                        numeral: true,
                        numeralThousandsGroupStyle: 'thousand'
                    });
                });
            }

        })
    })


    $('.btn-tambah-gaji').on('click', function (e) {
        numberId++;
        $('.container-tambahan-gaji').append(`
        <div class="form-row mb-2 tambahan-gaji row_${numberId}" id="form_${numberId}">
        <div class="form-group col">
            <input type="text" class="form-control" placeholder="Deskripsi" name="deskripsi[]" required>
        </div>
        <div class="form-group col">
            <input type="text" class="form-control currency gaji-mengajar" placeholder="Nominal" name="nominal[]" required>
        </div>
        <div class="form-group col-1">
            <button id=${numberId} type="button" class="btn btn-primary btn-hapus-gaji">
                <i class="fas fa-times"></i>
            </button>
        </div>
        </div>
    `);

        $(`#form_${numberId}`).hide();
        $(`#form_${numberId}`).slideDown();

        $('.currency').toArray().forEach(function (field) {
            new Cleave(field, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        });
    })

    $(document).on('click', '.btn-hapus-gaji', function () {
        let idHapus = $(this).attr('id');

        $(`#form_${idHapus}`).remove().fade();
        console.log(idHapus);

    });

    // $('#button-create').click(function (e) {
    //     const form = $('form-gaji');

    //     if (form.validate()) {
    //         e.preventDefault();
    //     }else{
    //         console.log('gak valid')
    //     }
    // })


    $('#button-create').click(function (e) {
        e.preventDefault();

        const dataString = $('#form-gaji').serialize();
   
        $.ajax({
            type: 'POST',
            url: 'http://localhost/penggajian/gaji/validation_form_gaji',
            data: dataString,
            success: function (data) {

                const response = JSON.parse(data);

                if (response.type == 'error') {
                    const error = response.error;
                    let i = 0;
                    for (const property in error) {
                        console.log(`${property}: ${error[property]}`);
                        
                        setTimeout(() => {
                            iziToast.error({
                                title: `Error`,
                                message: `${error[property]}`,
                                position: 'topRight'
                            });
                        }, i * 300)
                        i++
                    }
                   
                } else {
                    console.log('valid');
                    // $('#form-gaji').submit();
                    document.location.href = 'http://localhost/penggajian/gaji';
                }

            }
        })
    })
})