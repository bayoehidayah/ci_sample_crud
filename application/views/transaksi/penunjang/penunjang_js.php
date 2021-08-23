<script>
    $(document).ready(function() {
        // var i = 0;
        <?php if($count_penunjang > 0){ ?>
        $('#tablePenunjang').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": true, 
            "order": [[ 0, 'asc' ]],
            "ajax":
            {
                "url": "<?php echo base_url('aplikasi-unit-kerja/transaksi-penunjang/get-penunjang') ?>",
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [[10, 50, 100],[ 10, 50, 100]],
            "columns": [
                { "data": "periode" }, 
                { "render" : function( data, type, row) {
                        var html = '<a href="javascript:void(0);" onclick="detailPegawai(\''+row.kdepeg+'\');">'+row.kdepeg+'</a>';
                        return html;1
                    }
                },
                { "data": "kdeperan" },
                { "render" : function( data, type, row) {
                        var status_val1, status_val2 = "";
                        if(row.status_validasi.appvukerja1 == 1){ status_val1 = "Tervalidasi"; } else { status_val1 = "Tidak Tervalidasi"; }
                        if(row.status_validasi.appvukerja2 == 1){ status_val2 = "Tervalidasi"; } else { status_val2 = "Tidak Tervalidasi"; }
                        return "Validator 1 : "+status_val1+"<br/>Validator 2 :"+status_val2;
                    }
                },
                { "render": function ( data, type, row ) {
                        var html = "";
                        <?php if($level == "Super" || $level == "Validator" || $level == "Verifikator") {?>
                        html += '<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Lihat Info Transaksi Penunjang" onclick="infoTransaksi(\''+row.udi+'\', \'penunjang\')"><i class="la la-question-circle"></i></a>';

                        <?php } if($level != "Validator" && $level != "Verifikator") { ?>
                        html += '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="<?= base_url("aplikasi-unit-kerja/transaksi-penunjang/"); ?>'+row.idi+'" title="Edit Transaksi Penunjang"><i class="la la-edit"></i></a>';
                        html += '<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete Transaksi Penunjang" onclick="delPenunjang(\''+row.idi+'\')"><i class="la la-trash"></i></a>';
                        <?php } if($level == "Super" || $level == "Validator") { ?>  
                        if(((row.status_validasi.vukerja1 == null || row.status_validasi.vukerja1 == "") || (row.status_validasi.vukerja2 == null || row.status_validasi.vukerja2 == "")) && !row.status_validasi.val_refused && !row.status_validasi.ver_refused){
                            html += '<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Validasi Transaksi Penunjang" onclick="validasiTransaksi(\''+row.udi+'\', \''+row.periode+'\')"><i class="la la-check-circle"></i></a>';
                            html += '<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Tolak Transaksi Penunjang" onclick="refusedValidasiTransaksi(\''+row.udi+'\')"><i class="la la-times-circle"></i></a>';
                        }
                        <?php } ?>

                        <?php if($level == "Super" || $level == "Verifikator") { ?>
                        if(((row.status_validasi.appvukerja1 == 1 || row.status_validasi.appvukerja2 == 1) && (row.status_validasi.appvuniv1 == 0 || row.status_validasi.appvuniv2 == 0)) && !row.status_validasi.ver_refused && !row.status_validasi.val_refused){
                            html += '<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Verifikasi Transaksi Penunjang" onclick="verifikasiTransaksi(\''+row.udi+'\', \''+row.periode+'\')"><i class="la la-file-archive-o"></i></a>';
                            html += '<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Tolak Transaksi Penunjang" onclick="refusedVerifikasiTransaksi(\''+row.udi+'\')"><i class="la la-minus-square"></i></a>';
                        }
                        else if(row.status_validasi.appvuniv1 == 1 && row.status_validasi.appvuniv2 == 1){
                            html += '<a href="javascript:void(0)" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Telah Terverifikasi oleh dua verifikator"><i class="la la-exclamation-circle"></a>';
                        }
                        <?php } ?>
                        return html;
                    }
                },
            ],
        });
        <?php } else { ?>
        $('#tablePenunjang').DataTable();
        <?php } ?>
    });
    function delPenunjang(id){
        swal.fire({
            title : "Perhatian!",
            html : "Transaksi penunjang dengan rekaman aktivitas yang berhubungan juga akan dihapus. <br/> <b>Apakah anda yakin?</b>",
            type : "warning",
            showCancelButton : true,
            showLoaderOnConfirm : true,
            preConfirm : () => {
                return fetch("<?= base_url("aplikasi-unit-kerja/transaksi-penunjang/delete-penunjang/"); ?>" + id)
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
                    swal.showValidationMessage("Terjadi kesalahan dalam menghapus transaksi penunjang");
                })
            },
            allowOutsideClick : () => !swal.isLoading()
        }).then((result) => {
            if(result.value){
                swal.fire({
                    title : "Success!",
                    text : "Transaksi penunjang telah berhasil dihapus",
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
        }) 
    }
</script>