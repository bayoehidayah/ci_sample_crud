<script>
    $(document).ready(function(){
        
        $("#pegawaiForm, #userLevelFom").select2();

        $("#pegawaiForm").change(function(){
            let value = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url("auth/get/data-pegawai") ?>",
                data: {kdepeg : value},
                dataType: "JSON",
                beforeSend : function(){
                    $("#ukerja").val("");
                    $("#satker").val("");
                },
                success: function (response) {
                    if(response.result){
                        $("#ukerja").val(response.pegawai.kdeukerja);
                        $("#satker").val(response.pegawai.kdesatker);
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
                    $("#ukerja").val("");
                    $("#satker").val("");
                    swal.fire({
                        title : "Oops!",
                        text : "Terjadi kesalahan dalam mengambil data unit kerja dan satuan kerja",
                        type : "error"
                    });
                }
            });
        })
        
        $("#allHakAkses").click(function(){
            if($(this).is(':checked')){
                $(".hak-akses").prop("checked", true);
            }
            else{
                $(".hak-akses").prop("checked", false);
            }
        });

        $(".hak-akses").click(function(){
            if(!$(this).is(":checked")){
                $("#allHakAkses").prop("checked", false);
            }
            else if($("#viewAkses").is(":checked") && $("#readAkses").is(":checked") && $("#updateAkses").is(":checked") && $("#deleteAkses").is(":checked")){
                $("#allHakAkses").prop("checked", true);
            }
        });

        $("#userForm").submit(function(e){
            e.preventDefault();

            var form_data = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "<?= base_url("pegawai/user-password/user-password-new"); ?>",
                data: form_data,
                dataType: "JSON",
                success: function (response) {
                    if(response.result){
                        swal.fire({
                            title : "Success!",
                            html : response.msg,
                            type : "success",
                            timer : 2000,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            }
                        }).then((result) => {
                            if(result.dismiss === Swal.DismissReason.timer){
                                document.location.href = "<?= base_url("pegawai/user-password"); ?>";
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
                    // console.log(textStatus);
                    swal.fire({
                        title : "Oops!",
                        html : "Tidak dapat memproses data anda",
                        type : "error"
                    });
                }
            });
        });
    });
</script>