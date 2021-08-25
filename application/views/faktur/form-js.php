<script>
	var items  = [];
	var barang = $("#barang");
	$(document).ready(function(){
        $("#btnAdd").click(function(){
            $("#addItem")[0].reset();
        });

		barang.change(function(){
			var harga = $('option:selected', this).data("harga");
			$("#harga").val(harga);
		});

		$("#total").change(function(){
			var harga = $('option:selected', barang).data("harga");
			var total = $(this).val();
			var totalHarga = harga * total;
			$("#totalHarga").val(totalHarga);
		});

		$("#addItem").submit(function (e) { 
			e.preventDefault();
			
			var harga       = $('option:selected', barang).data("harga");
			var nama_barang = $('option:selected', barang).text();
			var id_barang   = barang.val();
			var totalBarang = $("#total").val();
			var totalHarga  = $("#totalHarga").val();
			const set       = {
				id_barang   : id_barang,
				nama_barang : nama_barang,
				total_barang: parseInt(totalBarang),
				total_harga : parseInt(totalHarga)
			};

			//Jika sudah ada maka akan diupdate
			const find = items.find(x => x.id_barang === id_barang)
			if(find){
				find.total_barang = parseInt(find.total_barang) + parseInt(totalBarang);
				find.total_harga  = parseInt(find.total_harga) + parseInt(totalHarga);
				toTable(find, $("#tableItems tbody tr").length + 1);
			}else{
				items.push(set);
				if(items.length == 1){
					loadData();
				}else{
					toTable(set, $("#tableItems tbody tr").length + 1);
				}
			}

			countTotalHarga();
			countTotalBarang();
		});

		$("#submitBtn").click(function (e) { 
			e.preventDefault();
			if(items.length == 0){
				return swal.fire({
					title : "Oops!",
					html : "Harap memilih setidaknya satu barang",
					type : "info"
				});
			}
			console.log(items);
			var form_data = new FormData();
			form_data.append("nama_pelanggan", $("#nama").val());
			form_data.append("items", items);

			$.ajax({
                type       : "POST",
                url        : "<?php echo base_url("faktur/save");  ?>",
                data       : form_data,
                dataType   : "JSON",
                cache	   : false,
                processData: false,
                contentType: false,
                beforeSend : function(){
                    swal.fire({
                        title : "Mohon tunggu...",
                        text : "Sedang memproses data",
                        showConfirmButton : false,
                        allowOutsideClick : false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        }
                    })
                },
                success: function (response) {
					console.log(response);
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
                                // document.location.href = "<?= base_url("faktur"); ?>"
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
                error : function(jqXHR, errorText, errorMessage){
					console.log(errorMessage);
					console.log(errorText);
                    swal.fire({
                        title : "Oops!",
                        text : "Terjadi kesalahan dalam menyimpan data",
                        type : "error"
                    });
                }
            });
		});
	});

	//Load All
	function loadData(){
		var table = $("#tableItems tbody");
		//Empty table first
		table.html("");
		var i = 1;
		for(const e of items){
			let item = '<tr id="'+e.id_barang+'">'
			item += '<td>'+(i++)+'</td>'
			item += '<td>'+e.nama_barang+'</td>'
			item += '<td id="'+e.id_barang+'-total">'+formatCurrency(e.total_barang, 0)+'</td>'
			item += '<td id="'+e.id_barang+'-harga">Rp '+formatCurrency(e.total_harga, 0)+'</td>'
			item += '<td><a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete Item" onclick="deleteData(\''+e.id_barang+'\')"><i class="la la-trash"></i></a></td>'
			item += '</tr>';

			table.append(item);
		}
	}
	
	//Add one data
	function toTable(items2, startNumber = 1){
		var table = $("#tableItems tbody");

		const row = $("#"+items2.id_barang);
		if(row.length){
			$("#"+items2.id_barang+"-total").text(formatCurrency(items2.total_barang, 0));
			$("#"+items2.id_barang+"-harga").text("Rp "+formatCurrency(items2.total_harga, 0));
		}
		else{
			let item = '<tr id="'+items2.id_barang+'">'
			item += '<td>'+(startNumber++)+'</td>'
			item += '<td>'+items2.nama_barang+'</td>'
			item += '<td id="'+items2.id_barang+'-total">'+formatCurrency(items2.total_barang, 0)+'</td>'
			item += '<td id="'+items2.id_barang+'-harga">Rp '+formatCurrency(items2.total_harga, 0)+'</td>'
			item += '<td><a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete Item" onclick="deleteData(\''+items2.id_barang+'\')"><i class="la la-trash"></i></a></td>'
			item += '</tr>';
			table.append(item);
		}
	}

	function refreshDataNumber(){
		var number = $("#tableItems tbody tr").length;
		for(i = 1; i <= number; i++){
			$("#tableItems tbody tr td:first-child").text(i);
		}
	}

	function countTotalBarang(){
		var total = 0;
		for(const e of items){
			total += e.total_barang
		}

		$("#totalBarang").text(formatCurrency(total, 0));
	}

	function countTotalHarga(){
		var total = 0;
		for(const e of items){
			total += e.total_harga
		}

		$("#totalSection").text("Rp "+formatCurrency(total, 0));
	}

	function deleteData(id){
		items = items.filter(el => el.id_barang != id);
		$("#"+id).remove();
		// refreshDataNumber();
	}
</script>
