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
			console.log(totalHarga);
			$("#totalHarga").val(totalHarga);
		});

		$("#addItem").submit(function (e) { 
			e.preventDefault();
			
			var harga       = $('option:selected', barang).data("harga");
			var nama_barang = $('option:selected', barang).text();
			var last_stok   = $('option:selected', last_stok).data("last-stok");

			var totalBarang = $("#total").val();
			if(last_stok < totalBarang){
				return swal.fire({
					title : "Oops!",
					html : "Total stok hanya tersisa "+last_stok,
					type : "info"
				});
			}

			const set = {
				id_barang : barang.val(),
				nama_barang : nama_barang,
				total_barang : totalBarang,
				total_harga : $("#totalHarga").val()
			};

			items.push(set);
			console.log(items);
		});
	});
</script>
