<script>
    $(document).ready(function(){

        $('#pegawaiForm, #periodeForm, #peranForm, #dokumenForm').select2();

        $("#peranForm").change(function(){
            var peran = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url("transaksi/peran/get-poin") ?>",
                data: { kdeperan : peran },
                dataType: "JSON",
                beforeSend : function(){
                    $("#pointAktivitasForm").val(0);
                },
                success: function (response) {
                    $("#pointAktivitasForm").val(response.poin);
                },
                error : function(){
                    $("#pointAktivitasForm").val(0);
                    swal.fire({
                        title : "Oops!",
                        text : "Terjadi kesalahan dalam mengambil poin aktivitas",
                        type : "error"
                    });
                }
            });
        });

        $("#penunjangForm").submit(function(e){
            e.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "<?php if($edit) {echo base_url("aplikasi-unit-kerja/transaksi-penunjang/update-transaksi/".$penunjang['idi']); } else{ echo base_url("aplikasi-unit-kerja/transaksi-penunjang/set/new-transaksi"); } ?>",
                data: form_data,
                dataType: "JSON",
                success: function (response) {
                    if(response.result){
                        swal.fire({
                            title : "Success!",
                            text : response.msg,
                            type : "success",
                            timer : 2000,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            }
                        }).then((result) => {
                            if(result.dismiss === Swal.DismissReason.timer){
                                document.location.href = "<?= base_url("aplikasi-unit-kerja/transaksi-penunjang"); ?>";
                            }
                        });
                    }
                    else{
                        swal.fire({
                            title : "Oops!",
                            text : response.msg,
                            type : "error"
                        });
                    }
                },
                error : function(textStatus){
                    console.log(textStatus);
                    swal.fire({
                        title : "Oops!",
                        html : "Tidak bisa memulai proses penyimpanan transaksi penunjang. <br/>Periksa koneksi internet anda",
                        type : "error"
                    });
                }
            });
        });
    })
</script>