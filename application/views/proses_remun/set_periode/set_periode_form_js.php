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

		$('#tglMulaiForm, #tglBerakhirForm, #tglBayarForm, #tglBayar1Form, #tglBayar2Form').datepicker({
            format : "yyyy-mm-dd",
		    rtl: KTUtil.isRTL(),
			todayHighlight: true,
			orientation: "bottom left",
			templates: arrows
		});

        $('#rektorForm, #wakilRektorForm, #kepalaBUKForm, #bendaharaForm').select2();

        $("#rektorForm").change(function(){
            var rektor = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url("proses-remun/set-up-periode/get/nip"); ?>",
                data: {
                    kode : rektor
                },
                dataType: "JSON",
                success: function (response) {
                    if(response.result){
                        $("#nipRektor").val(response.nip);
                    }
                    else{
                        $("#nipRektor").val(0);
                    }
                },
                error : function(){
                    swal({
                        title : "Oops!",
                        text : "NIP tidak bisa ditampilkan. Periksa koneksi internet anda",
                        type : "error"
                    });
                }
            });
        });

        $("#wakilRektorForm").change(function(){
            var rektor = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url("proses-remun/set-up-periode/get/nip"); ?>",
                data: {
                    kode : rektor
                },
                dataType: "JSON",
                success: function (response) {
                    if(response.result){
                        $("#nipWakilRektor").val(response.nip);
                    }
                    else{
                        $("#nipWakilRektor").val(0);
                    }
                },
                error : function(){
                    swal({
                        title : "Oops!",
                        text : "NIP tidak bisa ditampilkan. Periksa koneksi internet anda",
                        type : "error"
                    });
                }
            });
        });

        $("#kepalaBUKForm").change(function(){
            var rektor = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url("proses-remun/set-up-periode/get/nip"); ?>",
                data: {
                    kode : rektor
                },
                dataType: "JSON",
                success: function (response) {
                    if(response.result){
                        $("#nipKepalaBUK").val(response.nip);
                    }
                    else{
                        $("#nipKepalaBUK").val(0);
                    }
                },
                error : function(){
                    swal({
                        title : "Oops!",
                        text : "NIP tidak bisa ditampilkan. Periksa koneksi internet anda",
                        type : "error"
                    });
                }
            });
        });

        $("#bendaharaForm").change(function(){
            var rektor = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url("proses-remun/set-up-periode/get/nip"); ?>",
                data: {
                    kode : rektor
                },
                dataType: "JSON",
                success: function (response) {
                    if(response.result){
                        $("#nipBendahara").val(response.nip);
                    }
                    else{
                        $("#nipBendahara").val(0);
                    }
                },
                error : function(){
                    swal({
                        title : "Oops!",
                        text : "NIP tidak bisa ditampilkan. Periksa koneksi internet anda",
                        type : "error"
                    });
                }
            });
        });


        $("#periodeForm").submit(function(e){
            e.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "<?php if($edit) {echo base_url("proses-remun/set-up-periode/update-periode/".$periode['idi']); } else{ echo base_url("proses-remun/set-up-periode/set/new-periode"); } ?>",
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
                                document.location.href = "<?= base_url("proses-remun/set-up-periode"); ?>";
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
                        html : "Tidak bisa memulai proses pembuatan periode baru. <br/>Periksa koneksi internet anda",
                        type : "error"
                    });
                }
            });
        });
    })
</script>