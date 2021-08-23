<script>
    var arrows;
    $(document).ready(function(){
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
        
        $('#tanggal').datepicker({
            format : "yyyy-mm-dd",
		    rtl: KTUtil.isRTL(),
            todayBtn: "linked",
            clearBtn: true,
			todayHighlight: true,
			orientation: "bottom left",
			templates: arrows
		});

        $('#listTransaksi').DataTable();

        $("#searchReports").submit(function (e) {
            e.preventDefault();

            var form_data = $(this).serialize();
            console.log(form_data);
            $.ajax({
                type: "POST",
                url: "<?= base_url("laporan/penjualan/by-faktur/process"); ?>",
                data: form_data,
                dataType: "JSON",
                beforeSend : function(){
                    swal.fire({
                        title : "Mohon tunggu...",
                        text : "Sedang memproses",
                        showConfirmButton : false,
                        allowOutsideClick : false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        }
                    })
                },
                success: function (response) {
                    if(response.result){
                        $(".informationSection").show();
                        $("#bodyLisyTransaksi").html("");
                        const res = response.data;
                        
                        $("#totalPenjualan").text(res.total_penjualan);

                        $('#listTransaksi').DataTable().clear().destroy();
                        for(const item of res.transaksi){
                            var html         = "";

                            html += '<tr><td>'+item.no+'</td>';

                            html += '<td>'+item.id+'</td>';

                            html += '<td>'+item.barang+'</td>';

                            html += '<td>'+item.jumlah+'</td>';

                            html += '<td>'+item.harga_jual+'</td>';

                            html += '<td>'+item.total_jual+'</td>';

                            html += '<td>'+item.id_user+' | '+item.nama_user+'</td></tr>';

                            $("#bodyListTransaksi").append(html);
                        }

                       
                        $('#listTransaksi').DataTable();
                    }
                    else{
                        $(".informationSection").hide();
                        swal.fire({
                            title : "Oops!",
                            html : response.msg,
                            type : "error"
                        });
                    }
                    swal.close()
                },
                error : function(textStatus){
                    console.log(textStatus);
                    $(".informationSection").hide();
                    swal.fire({
                        title : "Oops!",
                        html : "Terjadi kesalahan sistem.",
                        type : "error"
                    });
                }
            });
        });
    });
</script>