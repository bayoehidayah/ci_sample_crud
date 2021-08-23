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

		$('#tgllhr, #tmtgol, #tmtjabatan').datepicker({
            format : "yyyy-mm-dd",
		    rtl: KTUtil.isRTL(),
			todayHighlight: true,
			orientation: "bottom left",
			templates: arrows
        });
        
        $('#satker, #jendik, #golpns, #gender, #kdnpeg, #stspeg, #jnspeg, #nmajabf, #nmajab, #klsjab, #klsjabf, #jabakad, #ulapor, #stsrek').select2();

        $("#remunForm").submit(function (e) { 
            e.preventDefault();
            var form_data = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php if($edit){ echo base_url("pegawai/remun-unimed/update-pegawai"); } else { echo base_url("pegawai/remun-unimed/new-pegawai"); } ?>",
                data: form_data,
                dataType: "JSON",
                processData:false,
                contentType:false,
                beforeSend : function(){
                    swal.fire({
                        title : "Mohon tunggu...",
                        text : "Sedang memproses data anda",
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
                                document.location.href = "<?= base_url("pegawai/remun-unimed"); ?>";
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
                error : function(errorText){
                    swal.fire({
                        title : "Oops!",
                        text : "Terjadi kesalahan dalam menyimpan data",
                        type : "error"
                    });
                }
            });
        });
    });
</script>