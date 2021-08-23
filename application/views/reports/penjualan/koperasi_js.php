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

        $("#searchReports").submit(function (e) {
            e.preventDefault();

            var form_data = $(this).serialize();
            console.log(form_data);
            $.ajax({
                type: "POST",
                url: "<?= base_url("laporan/penjualan/koperasi/process"); ?>",
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
                        $("#informationSection").show();
                        $("#reportResults").html("");
                        const res = response.data;
                        
                        $("#tanggalSection").text(res.tanggal);
                        $("#totalModal").text(res.total_modal);
                        $("#totalPenjualan").text(res.total_penjualan);
                        $("#totalKeuntungan").text(res.keuntungan);

                        for(const item of res.transaksi){
                            var html         = "";
                            const infoBarang = item.info_barang;
                            
                            //Set Title
                            html += '<div class="col-md-4"><div class="kt-portlet kt-portlet--mobile data-proces data-proces-profil"><div class="kt-portlet__head kt-portlet__head--lg"><div class="kt-portlet__head-label"><span class="kt-portlet__head-icon"><i class="kt-font-brand flaticon2-grids"></i></span><h3 class="kt-portlet__head-title">'+infoBarang.id+' | '+infoBarang.nama+'</h3></div></div>';

                            html += '<div class="kt-portlet__body table-responsive"><table class="table table-striped table-bordered table-hover table-checkable"><tbody>';

                            html += '<tr><td style="width:50%;">Stok Barang</td><td style="width:50%;">'+item.stok+'</td></tr>';

                            html += '<tr><td>Barang Masuk</td><td>'+item.incoming_stok+'</td></tr>';

                            html += '<tr><td>Harga Modal</td><td>'+infoBarang.harga_modal+'</td></tr>';

                            html += '<tr><td>Barang Terjual</td><td>'+item.sold_stok+'</td></tr>';

                            html += '<tr><td>Harga Jual</td><td>'+infoBarang.harga_jual+'</td></tr>';

                            html += '<tr><td>Sisa Stok</td><td>'+item.last_stok+'</td></tr>';

                            html += '<tr><td>Total Modal</td><td>'+item.total_modal+'</td></tr>';

                            html += '<tr><td>Total Penjualan</td><td>'+item.total_penjualan+'</td></tr>';

                            html += "</tbody></table></div></div></div>";

                            $("#reportResults").append(html);
                        }

                    }
                    else{
                        $("#informationSection").hide();
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
                    $("#informationSection").hide();
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