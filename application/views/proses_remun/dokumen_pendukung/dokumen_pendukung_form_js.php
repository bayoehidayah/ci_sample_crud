<script>
    $(document).ready(function(){
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

		$('#tglSkDokumen, #tglMulaiForm, #tglAkhirForm').datepicker({
            format : "yyyy-mm-dd",
		    rtl: KTUtil.isRTL(),
			todayHighlight: true,
			orientation: "bottom left",
			templates: arrows
		});

        $('#periodeForm, #unitKerjaForm, #satuanKerjaForm, #pekerjaanForm, #aktivitasForm').select2();

        $("#unitKerjaForm").change(function(){
            var unit = $(this).val();

            var options = ''

            $.ajax({
                type: "POST",
                url: "<?= base_url("proses-remun/dokumen-pendukung/get/satuan-kerja"); ?>",
                data: {unit : unit},
                dataType: "JSON",
                beforeSend : function(){
                    $("#satuanKerjaForm").val("");
                },
                success: function (response) {
                    options = '<option value="" selected disabled>Pilih Satuan Kerja</option>';
                    $("#satuanKerjaForm").select2("destroy");

                    var i;
                    for(i = 0; i < response.satuan_kerja.length; i++){
                        options += '<option value="'+response.satuan_kerja[i].kdesatker+'">'+response.satuan_kerja[i].kdesatker+' - '+response.satuan_kerja[i].nmasatker+'</option>';
                    }

                    $("#satuanKerjaForm").html(options);
                    $("#satuanKerjaForm").select2();
                },
                error : function(){
                    swal.fire({
                        title : "Oops!",
                        text : "Terjadi kesalahan dalam mengambil data satuan kerja.",
                        type : "error"
                    });
                }
            });
        });

        $("#pekerjaanForm").change(function(){
            var pekerjaan = $(this).val();

            var options = ''

            $.ajax({
                type: "POST",
                url: "<?= base_url("proses-remun/dokumen-pendukung/get/aktivitas"); ?>",
                data: {pekerjaan : pekerjaan},
                dataType: "JSON",
                beforeSend : function(){
                    $("#aktivitasForm").val("");
                },
                success: function (response) {
                    options = '<option value="" selected disabled>Pilih Aktivitas</option>';
                    $("#aktivitasForm").select2("destroy");

                    var i;
                    for(i = 0; i < response.aktivitas.length; i++){
                        options += '<option value="'+response.aktivitas[i].kdeaktivitas+'">'+response.aktivitas[i].kdeaktivitas+' - '+response.aktivitas[i].nmaaktivitas+'</option>';
                    }

                    $("#aktivitasForm").html(options);
                    $("#aktivitasForm").select2();
                },
                error : function(){
                    swal.fire({
                        title : "Oops!",
                        text : "Terjadi kesalahan dalam mengambil data aktivitas.",
                        type : "error"
                    });
                }
            });
        });

        $("#dokumenForm").submit(function (e) { 
            e.preventDefault();
            
            var form_data = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php if($edit){echo base_url("proses-remun/dokumen-pendukung/update-dokumen/".$dokumen['idi']);} else{ echo base_url("proses-remun/dokumen-pendukung/set/new-dokumen"); } ?>",
                data: form_data,
                dataType: "JSON",
                processData:false,
                contentType:false,
                // cache:false,
                // async:false,
                beforeSend : function(){
                    swal.fire({
                        title : "Mohon tunggu...",
                        text : "Sedang memproses dokumen anda",
                        showConfirmButton : false,
                        allowOutsideClick : false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        }
                    })
                },
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
                                document.location.href = "<?= base_url("proses-remun/dokumen-pendukung"); ?>";
                            }
                        });
                    }
                    else{
                        swal.fire({
                            title : "Oops!",
                            html : response.msg,
                            type : "error"
                        });
                    }
                },
                error : function(textStatus){
                    console.log(textStatus);
                    swal.fire({
                        title : "Oops!",
                        html : "Terjadi kesalahan sistem.",
                        type : "error"
                    });
                }
            });
        });
    })
</script>