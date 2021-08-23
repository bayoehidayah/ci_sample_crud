<script>
    console.log(document.location.href);
    $(document).ready(function(){
        
        $("form").submit(function (e) { 
            e.preventDefault();
            
            var formData = $(this).serializeArray();
            $.ajax({
                type: "POST",
                url: "<?= base_url("auth/login/process") ?>",
                data: formData,
                dataType: "JSON",
                success: function (response) {
                    if(response.result){
                        swal.fire({
                            title : "Success!",
                            html : "Anda akan diarahkan ke halaman selanjutnya dalam beberapa detik",
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
                    else{
                        swal.fire({
                            title : "Oops!",
                            text : response.msg,
                            type : "error"
                        });
                    }
                },
                error : function(errorText){
                    console.log(errorText);
                    swal.fire({
                        title : "Oops!",
                        text : "Maaf tidak bisa memproses login anda. Harap periksa koneksi internet anda",
                        type : "error"
                    });
                }
            });
        });
    })
</script>