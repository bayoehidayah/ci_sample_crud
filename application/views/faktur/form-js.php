<script>
	var items  = [];
	const edit = <?= $edit; ?>

	if(edit){
		items = <?= json_encode($list_items); ?>;
		loadData();
		countTotalHarga();
		countTotalBarang();
	}

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
				total_harga : parseInt(totalHarga),
				deleted 	: false
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

			var form_data = new FormData();
			const json_item = JSON.stringify(items);
			form_data.append("nama_pelanggan", $("#nama").val());
			form_data.append("items", json_item);

			var urlActions = "<?= base_url("faktur/save");  ?>";
			if(edit){
				form_data.append("id", "<?= $faktur->id; ?>")
				urlActions = "<?= base_url("faktur/update"); ?>";
			}

			$.ajax({
                type       : "POST",
                url        : urlActions,
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
		table.empty();
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

	function refreshNumber(){
		var table = $("#tableItems tbody tr").length;
		for(var i = 0; i < table; i++){
			const j = i + 1;
			$("#tableItems tbody tr td:first-child").eq(i).text(j);
		}
	}

	function countTotalBarang(){
		var total = 0;
		for(const e of items){
			if(typeof e.deleted != "undefined"){
				if(e.deleted){
					continue;
				}
			}

			total = parseInt(total) + parseInt(e.total_barang);
		}

		$("#totalBarang").text(formatCurrency(total, 0));
	}

	function countTotalHarga(){
		var total = 0;
		for(const e of items){
			if(typeof e.deleted != "undefined"){
				if(e.deleted){
					continue;
				}
			}

			total = parseInt(total) + parseInt(e.total_harga);
		}

		$("#totalSection").text("Rp "+formatCurrency(total, 0));
	}

	function deleteData(id){
		const find = items.find(x => x.id_barang === id)
		if(find){
			if(edit){
				find.deleted = true;
			}else{
				items = items.filter(el => el.id_barang != id);
			}

			$("#"+id).remove();
		}
		else{
			swal.fire({
				title : "Oops!",
				text : "Tidak dapat menghapus data",
				type : "error"
			});
		}

		refreshNumber();
		countTotalBarang();
		countTotalHarga();
	}
</script>
