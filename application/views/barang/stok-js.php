<script src="<?= base_url("assets/app/custom/general/crud/forms/widgets/bootstrap-datepicker.js"); ?>" type="text/javascript"></script>
<script>
    var table;
    $(document).ready(function(){
        table = $('#tableStok').DataTable({
            'responsive' : true,
            "processing": true,
            "serverSide": true,
            "ordering": true, 
            "order": [[ 0, 'asc' ]],
            "ajax":
            {
                "url": "<?= base_url('barang/stok/datas') ?>",
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [[10, 50, 100],[ 10, 50, 100]],
            "columns": [
                { "data": "id" }, 
                { "data": "tanggal" }, 
                { "data": "created_by" },
                { "data": "created_at" },
                { "render": function ( data, type, row ) {
                        var html  = '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="<?= base_url("barang/stok/tanggal/") ?>'+row.tanggal+'" title="Edit Barang"><i class="la la-eye"></i></a>';
                        html += '<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete Stok" onclick="delStok(\''+row.id+'\')"><i class="la la-trash"></i></a>';
                        return html;
                    }
                },
            ],
        });

        $("#btnAdd").click(function(){
            Swal.fire({ 
                title: 'Masukkan Tanggal',
                html: '<input type="date" name="" class="form-control" id="datePicker" required placeholder="Select date" /><br/>',
                showCancelButton: true,
                confirmButtonText: 'Process',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    const tgl = Swal.getPopup().querySelector("#datePicker").value;
                    console.log("Tanggal : "+tgl);

                    const myHeaders = new Headers();
                    myHeaders.append('Content-Type', 'application/x-www-form-urlencoded');

                    return fetch(`<?= base_url("barang/stok/set-tanggal") ?>`, {
                        method : "POST",
                        headers: myHeaders,
                        mode: 'cors',
                        cache: 'default',
                        body : JSON.stringify({
                            tanggal : tgl
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }

                        return response.json()
                    })
                    .then(data => {
                        if(!data.result){
                            return swal.showValidationMessage(data.msg);
                        }

                        return data;
                    })
                    .catch(error => { 
                        console.error(error);
                        swal.showValidationMessage("Terjadi kesalahan dalam memproses data");
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
            .then((result) => {
                console.log(result.value);
                if (result.value) {
                    Swal.fire({
                        title : "Mohon tunggu...",
                        text : result.value.msg,
                        type : "success",
                        timer : 2000,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        }
                    }).then((r) => {
                        if(r.dismiss === Swal.DismissReason.timer){
                            document.location.href = result.value.redirect_to;
                        }
                    });
                }
            })
        });
    });

    var arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        }
    } else {
        arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    }

    function delStok(id){
        swal.fire({
            title : "Perhatian!",
            html : "Data tidak dapat dikembalikan. <br/> <b>Apakah anda yakin?</b>",
            type : "warning",
            showCancelButton : true,
            showLoaderOnConfirm : true,
            preConfirm : () => {
                return fetch("<?= base_url("barang/stok/delete/"); ?>" + id)
                .then(response => {
                    if(!response.ok){
                        throw new Error(response.statusText);
                    }
                    return response.json()
                })
                .then(data => {
                    if(!data.result){
                        swal.showValidationMessage(data.msg);
                    }
                })
                .catch(error => {
                    console.log(error);
                    swal.showValidationMessage("Terjadi kesalahan dalam menghapus stok");
                })
            },
            allowOutsideClick : () => !swal.isLoading()
        }).then((result) => {
            if(result.value){
                swal.fire({
                    title : "Success!",
                    text : "Stok telah berhasil dihapus",
                    type : "success",
                    timer : 2000,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                }).then((result) => {
                    if(result.dismiss === Swal.DismissReason.timer){
                        table.ajax.reload(null, false)
                    }
                });
            }
        }) 
    }
</script>