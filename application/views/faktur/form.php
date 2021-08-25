                        <!-- begin:: Content -->
                        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                        	<div class="kt-portlet kt-portlet--mobile">
                        		<div class="kt-portlet__head kt-portlet__head--lg">
                        			<div class="kt-portlet__head-label">
                        				<span class="kt-portlet__head-icon">
                        					<i class="kt-font-brand     flaticon2-file"></i>
                        				</span>
                        				<h3 class="kt-portlet__head-title">
                        					<?= $title; ?>
                        				</h3>
                        			</div>
                        		</div>
                        		<div class="kt-portlet__body">
                        			<div class="form-group row">
                        				<label for="nama" class="col-2 col-form-label">Nama Pelanggan</label>
                        				<div class="col-10">
                        					<input class="form-control" type="text" name="nama" id="nama" value="<?php if($edit){ echo $faktur->nama_pelanggan; } ?>">
                        				</div>
                        			</div>
                        		</div>
                        	</div>

                        	<div class="kt-portlet kt-portlet--mobile">
                        		<div class="kt-portlet__head kt-portlet__head--lg">
                        			<div class="kt-portlet__head-label">
                        				<span class="kt-portlet__head-icon">
                        					<i class="kt-font-brand     flaticon2-list-1"></i>
                        				</span>
                        				<h3 class="kt-portlet__head-title">
                        					Daftar Barang
                        				</h3>
                        			</div>
                        			<div class="kt-portlet__head-toolbar">
                        				<div class="kt-portlet__head-wrapper">
                        					<div class="kt-portlet__head-actions">
                        						<a href="javascript:void(0);"
                        							class="btn btn-brand btn-elevate btn-icon-sm" id="btnAdd"
                        							data-toggle="modal" data-target="#modalBarang">
                        							<i class="la la-plus"></i>
                        							Barang
                        						</a>
                        					</div>
                        				</div>
                        			</div>
                        		</div>
                        		<div class="kt-portlet__body">
                        			<!--begin: Datatable -->
                        			<table class="table table-striped table-bordered table-hover table-checkable"
                        				id="tableItems">
                        				<thead>
                        					<tr>
                        						<th>#</th>
                        						<th>Barang</th>
                        						<th>Total</th>
                        						<th>Harga</th>
                        						<th>Actions</th>
                        					</tr>
                        				</thead>
                        				<tbody>

                        				</tbody>
                        				<tfoot>
                        					<tr>
                        						<td colspan="4">Total Barang</td>
                        						<td id="totalBarang"></td>
                        					</tr>
                        					<tr>
                        						<td colspan="4">Total Harga</td>
                        						<td id="totalSection"></td>
                        					</tr>
                        				</tfoot>
                        			</table>
                        		</div>
								<div class="kt-portlet__foot">
									<div class="pull-right">
										<button type="button" id="submitBtn" class="btn btn-primary">Submit</button>
									</div>
								</div>
                        	</div>
                        </div>
                        <form action="#" method="post" id="addItem">
                        	<div class="modal fade" id="modalBarang" tabindex="-1" role="dialog"
                        		aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        		<div class="modal-dialog modal-dialog-centered" role="document">
                        			<div class="modal-content">
                        				<div class="modal-header">
                        					<h5 class="modal-title" id="modalBarangTitle">Barang</h5>
                        					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        					</button>
                        				</div>
                        				<div class="modal-body">
                        					<div class="form-group">
                        						<label>Barang *</label>
                        						<select class="form-control m-select2" id="barang" name="barang"
                        							required>
                        							<option value="" selected disabled>Pilih Barang</option>
                        							<?php
														foreach($barang as $row){
															echo '<option value="'.$row->id.'" data-harga="'.$row->harga.'">'.$row->nama.'</option>';
														}
													?>
                        						</select>
                        					</div>
                        					<div class="form-group">
                        						<label>Harga</label>
                        						<div class="input-group">
                        							<div class="input-group-prepend"><span
                        									class="input-group-text">Rp</span></div>
                        							<input type="number" class="form-control" placeholder="Harga"
                        								name="harga" id="harga" readonly>
                        						</div>
                        					</div>

                        					<div class="form-group">
                        						<label>Total Barang * </label>
                        						<input type="number" class="form-control"
                        							placeholder="Total Barang Yang Dibeli" name="total_barang"
                        							id="total" required>
                        					</div>

                        					<div class="form-group">
                        						<label>Total Harga</label>
                        						<input type="number" class="form-control"
                        							placeholder="Total Barang x Harga" id="totalHarga" readonly>
                        					</div>
                        				</div>
                        				<div class="modal-footer">
                        					<button type="button" class="btn btn-secondary"
                        						data-dismiss="modal">Close</button>
                        					<button type="submi" class="btn btn-primary">Save changes</button>
                        				</div>
                        			</div>
                        		</div>
                        	</div>
                        </form>
