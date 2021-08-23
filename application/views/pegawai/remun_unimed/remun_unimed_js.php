<script>
    $(document).ready(function() {
        $('#tablePegawai').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": true, 
            "order": [[ 0, 'asc' ]],
            "ajax":
            {
                "url": "<?php echo base_url('pegawai/remun-unimed/get-pegawai') ?>",
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [[10, 50, 100],[ 10, 50, 100]],
            "columns": [
                { "data": "kdepeg" }, 
                { "data": "nip" }, 
                { "data": "nmapanjang" },
                { "data": "gender" },
                { "render": function ( data, type, row ) {
                        var html  = '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="<?= base_url("pegawai/remun-unimed/"); ?>'+row.idi+'" title="Edit Pegawai Remun Unimed"><i class="la la-edit"></i></a>';
                        html += '<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete Pegawai Remun Unimed" onclick="delPegawai(\''+row.idi+'\')"><i class="la la-trash"></i></a>';
                        return html;
                    }
                },
            ],
        });
    });

    function delPegawai(kde){
        swal.fire({
            title : "Perhatian!",
            html : "Data pegawai tidak dapat dikembalikan",
            type : "info",
            showCancelButton : true,
            showLoaderOnConfirm : true,
            preConfirm : () => {
                return fetch("<?= base_url("pegawai/remun-unimed/del-pegawai/"); ?>" + kde)
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
                    swal.showValidationMessage("Terjadi kesalahan dalam menghapus pegawai");
                })
            },
            allowOutsideClick : () => !swal.isLoading()
        }).then((result) => {
            if(result.value){
                swal.fire({
                    title : "Success!",
                    text : "Pegawai telah berhasil dihapus",
                    type : "success",
                    timer : 2000,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                }).then((result) => {
                    if(result.dismiss === Swal.DismissReason.timer){
                        location.reload();
                    }
                });
            }
        });
    } 
</script>