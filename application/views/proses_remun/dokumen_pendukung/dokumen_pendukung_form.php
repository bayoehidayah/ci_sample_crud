                        <!-- begin:: Content -->
                        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
										<?php 
											if($edit) { echo '<i class="kt-font-brand flaticon2-edit"></i>'; } 
											else { echo '<i class="kt-font-brand flaticon2-plus"></i>';}
										?>
											
										</span>
										<h3 class="kt-portlet__head-title">
											<?php 
												if($edit) { echo "Edit Dokumen ". $dokumen['nomskdokumen'];} 
												else { echo "Buat Dokumen Baru";}
											?>
										</h3>
									</div>
								</div>
								<form action="#" method="post" enctype="multipart/form-data" id="dokumenForm">
									<div class="kt-portlet__body">
										<div class="row">
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Periode</label>
													<select class="form-control m-select2" id="periodeForm" name="periode" required>
														<option value="" selected disabled>Pilih Periode</option>
														<?php
															foreach($periode as $row){
																if($edit && $row->periode == $dokumen['periode']){
																	echo '<option value="'.$row->periode.'" selected>'.$row->periode.'</option>';
																}
																else{
                                                                    echo '<option value="'.$row->periode.'">'.$row->periode.'</option>';
																}
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Unit Kerja</label>
													<select class="form-control m-select2" id="unitKerjaForm" name="unit_kerja" required>
														<option value="" selected disabled>Pilih Unit Kerja</option>
														<?php
															foreach($unit_kerja as $row){
																if($edit && $row->kdeukerja == $dokumen['kdeukerja']){
																	echo '<option value="'.$row->kdeukerja.'" selected>'.$row->kdeukerja.' - '.$row->nmaukerja.'</option>';
																}
																else{
                                                                    echo '<option value="'.$row->kdeukerja.'">'.$row->kdeukerja.' - '.$row->nmaukerja.'</option>';
																}
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Satuan Kerja</label>
													<select class="form-control m-select2" id="satuanKerjaForm" name="satuan_kerja" required>
														<?php
															if($edit){
																echo '<option value="" disabled>Pilih Satuan Kerja</option>';
																foreach($satuan_kerja as $row){
																	if($row->kdesatker == $dokumen['kdesatker']){
																		echo '<option value="'.$row->kdesatker.'" selected>'.$row->kdesatker.' - '.$row->nmasatker.'</option>';
																	}
																	else{
																		echo '<option value="'.$row->kdesatker.'">'.$row->kdesatker.' - '.$row->nmasatker.'</option>';
																	}
																}
															}
															else{
																echo '<option value="" selected disabled>Pilih Unit Kerja Terlebih Dahulu</option>';
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Pekerjaan</label>
													<select class="form-control m-select2" id="pekerjaanForm" name="pekerjaan" required>
														<option value="" selected disabled>Pilih Pekerjaan</option>
														<?php
															foreach($pekerjaan as $row){
																if($edit && $row->kdepekerjaan == $dokumen['kdepekerjaan']){
																	echo '<option value="'.$row->kdepekerjaan.'" selected>'.$row->kdepekerjaan.' - '.$row->nmapekerjaan.'</option>';
																}
																else{
                                                                    echo '<option value="'.$row->kdepekerjaan.'">'.$row->kdepekerjaan.' - '.$row->nmapekerjaan.'</option>';
																}
															}
														?>
													</select>
												</div>
											</div>
                                            <div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Aktivitas</label>
													<select class="form-control m-select2" id="aktivitasForm" name="aktivitas" required>
														<?php
															if($edit){
																echo '<option value="" disabled>Pilih Aktivitas</option>';
																foreach($aktivitas as $row){
																	if($row->kdeaktivitas == $dokumen['kdeaktivitas']){
																		echo '<option value="'.$row->kdeaktivitas.'" selected>'.$row->kdeaktivitas.' - '.$row->nmaaktivitas.'</option>';
																	}
																	else{
																		echo '<option value="'.$row->kdeaktivitas.'">'.$row->kdeaktivitas.' - '.$row->nmaaktivitas.'</option>';
																	}
																}
															}
															else{
																echo '<option value="" selected disabled>Pilih Pekerjaan Terlebih Dahulu</option>';
															}
														?>
													</select>
												</div>
											</div>
										</div>
										<div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
										<div class="row">
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Tanggal SK. Dokumen</label>
													<input type="text" class="form-control" placeholder="Pilih Tanggal" name="tglskdokumen" id="tglSkDokumen" required <?php if($edit){ echo 'value="'.$dokumen['tglskdokumen'].'"';} ?>>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Nomor SK Dokumen</label>
													<input type="text" class="form-control" maxlength="30" size="30" placeholder="Enter Nomor SK Dokumen" name="nomskdokumen" id="nomskdokumen" required <?php if($edit){ echo 'value="'.$dokumen['nomskdokumen'].'"';} ?>>
												</div>
											</div>
											<div class="col-md-12 col-sm-12 col-lg-12">
												<div class="form-group">
													<label>Judul</label>
													<input type="text" class="form-control" maxlength="255" size="255" placeholder="Enter Judul Dokumen" name="judul" id="judul" required <?php if($edit){ echo 'value="'.$dokumen['judul'].'"';} ?>>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Tanggal Mulai</label>
													<input type="text" class="form-control" placeholder="Pilih Tanggal" name="tglmulai" id="tglMulaiForm" required <?php if($edit){ echo 'value="'.$dokumen['tglmulai'].'"';} ?>> 
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6`">
												<div class="form-group">
													<label>Tanggal Berakhir</label>
													<input type="text" class="form-control" placeholder="Pilih Tanggal" name="tglakhir" id="tglAkhirForm" required <?php if($edit){ echo 'value="'.$dokumen['tglakhir'].'"';} ?>>
												</div>
											</div>
										</div>
										<div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
										<div class="row">
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Jumlah Dana</label>
													<input type="number" class="form-control" min="1" maxlength="12" size="12" placeholder="Enter Jumlah Dana" name="jumlahdana" id="jumlahDana" required <?php if($edit){ echo 'value="'.$dokumen['jumlahdana'].'"';} ?>>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Sumber Dana</label>
													<input type="text" class="form-control" placeholder="Enter Sumber Dana" maxlength="30" size="30" name="sumberdana" id="sumberDana" required <?php if($edit){ echo 'value="'.$dokumen['sumberdana'].'"';} ?>>
												</div>
											</div>
											<?php if($edit) { ?>
											<div class="col-md-12">
												Dokumen : <a href="<?= base_url("proses-remun/dokumen-pendukung/dokumen-download/".$dokumen['idi']); ?>"><span class="la la-cloud-download"></span> <?= $dokumen['dok_trdok']; ?></a>
											</div>
											<br/><br/>
											<?php } ?>
											<div class="col-md-12 col-sm-12 col-lg-12">
												<div class="form-group">
													<label><?php if($edit){ echo 'Change Dokumen (Max : 2MB)'; }else {echo 'Search Dokumen (Max : 2 MB)';} ?></label>
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="validatedCustomFile" name="dokumen" <?php if(!$edit) { echo 'required'; } ?>>
    													<label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="kt-portlet__foot">
										<div class="kt-form__actions">
											<button type="submit" class="btn btn-primary">Submit</button>
											<button type="reset" class="btn btn-secondary">Reset</button>
										</div>
									</div>
								</form>
							</div>
                        </div>