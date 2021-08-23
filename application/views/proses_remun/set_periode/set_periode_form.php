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
												if($edit) { echo "Edit Periode ". $periode['periode'];} 
												else { echo "Buat Periode Baru";}
											?>
										</h3>
									</div>
								</div>
								<form action="#" method="post" enctype="multipart/form-data" id="periodeForm">
									<div class="kt-portlet__body">
										<div class="row">
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Periode</label>
													<input type="text" class="form-control" placeholder="Enter Periode" maxlength="5" size="5" name="periode" id="periodeForm" required <?php if($edit){ echo 'value="'.$periode['periode'].'"';} ?>>
												</div>
											</div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Tanggal Mulai</label>
													<input type="text" class="form-control" placeholder="Pilih Tanggal" name="tgl_mulai" id="tglMulaiForm" required <?php if($edit){ echo 'value="'.$periode['tglmulai'].'"';} ?>>
												</div>
											</div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Tanggal Berakhir</label>
													<input type="text" class="form-control" placeholder="Pilih Tanggal" name="tgl_berakhir" id="tglBerakhirForm" required <?php if($edit){ echo 'value="'.$periode['tglakhir'].'"';} ?>>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Pir</label>
													<input type="number" class="form-control" min="1" maxlength="12" size="12" placeholder="Enter Pir"name="pir" id="pirForm" required <?php if($edit){ echo 'value="'.$periode['pir'].'"';} ?>>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Reduksi</label>
													<input type="number" class="form-control" min="1" max="100.00" placeholder="Enter Pir" name="reduksi" id="reduksiForm" required <?php if($edit){ echo 'value="'.$periode['reduksi_real'].'"';} ?>>
												</div>
											</div>
										</div>
										<div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
										<div class="row">
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Judul Laporan 1</label>
													<input type="text" class="form-control" placeholder="Enter Judul Laporan" maxlength="100" size="100" name="judul11" id="laporanJudul11" required <?php if($edit){ echo 'value="'.$periode['judul11'].'"';} ?>>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Judul Laporan 2</label>
													<input type="text" class="form-control" placeholder="Enter Judul Laporan" maxlength="100" size="100" name="judul12" id="laporanJudul12" required <?php if($edit){ echo 'value="'.$periode['judul12'].'"';} ?>>
												</div>
											</div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Remun Dosen 30%</label>
													<input type="nunmber" class="form-control" min="1" maxlength="12" size="12" placeholder="Enter Remun" name="remundos1" id="remundos1Form" required <?php if($edit){ echo 'value="'.$periode['remundos1'].'"';} ?>>
												</div>
											</div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Remun Pegawai 30%</label>
													<input type="number" class="form-control" min="1" maxlength="12" size="12" placeholder="Enter Remun" name="remunpeg1" id="remunpeg1Form" required <?php if($edit){ echo 'value="'.$periode['remunpeg1'].'"';} ?>> 
												</div>
											</div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Tanggal Bayar 30%</label>
													<input type="text" class="form-control" placeholder="Pilih Tanggal" name="tgl_bayar1" id="tglBayar1Form" required <?php if($edit){ echo 'value="'.$periode['tglbayar1'].'"';} ?>>
												</div>
											</div>
										</div>
										<div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
										<div class="row">
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Judul Laporan 1</label>
													<input type="text" class="form-control" placeholder="Enter Judul Laporan" maxlength="100" size="100" name="judul21" id="laporanJudul21" required <?php if($edit){ echo 'value="'.$periode['judul21'].'"';} ?>>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Judul Laporan 2</label>
													<input type="text" class="form-control" placeholder="Enter Judul Laporan" maxlength="100" size="100" name="judul22" id="laporanJudul22" required <?php if($edit){ echo 'value="'.$periode['judul22'].'"';} ?>>
												</div>
											</div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Remun Dosen 70%</label>
													<input type="number" class="form-control" min="1" maxlength="12" size="12" placeholder="Enter Remun" name="remundos2" id="remundos2Form" required <?php if($edit){ echo 'value="'.$periode['remundos2'].'"';} ?>>
												</div>
											</div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Remun Pegawai 70%</label>
													<input type="number" class="form-control" min="1" maxlength="12" size="12" placeholder="Enter Remun" name="remunpeg2" id="remunpeg2Form" required <?php if($edit){ echo 'value="'.$periode['remunpeg2'].'"';} ?>>
												</div>
											</div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Tanggal Bayar 70%</label>
													<input type="text" class="form-control" placeholder="Pilih Tanggal" name="tgl_bayar2" id="tglBayar2Form" required <?php if($edit){ echo 'value="'.$periode['tglbayar2'].'"';} ?>>
												</div>
											</div>
										</div>
										<div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
										<div class="row">
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Rektor</label>
													<select class="form-control m-select2" id="rektorForm" name="rektor">
														<option value="" selected disabled>Pilih Rektor</option>
														<?php
															foreach($pegawai as $row){
																if($edit && $row->nmapanjang == $periode['nmarektor']){
																	echo '<option value="'.$row->kdepeg.'" selected>'.$row->kdepeg.' - '.$row->nmapanjang.'</option>';
																}
																else{
																	echo '<option value="'.$row->kdepeg.'">'.$row->kdepeg.' - '.$row->nmapanjang.'</option>';
																}
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>NIP Rektor</label>
													<input type="text" class="form-control" placeholder="NIP Rektor" maxlength="18" size="18" name="niprektor" id="nipRektor" readonly required <?php if($edit){ echo 'value="'.$periode['niprektor'].'"';} ?>>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Wakil Rektor</label>
													<select class="form-control m-select2" id="wakilRektorForm" name="wakil_rektor">
														<option value="" selected disabled>Pilih Wakil Rektor</option>
														<?php
															foreach($pegawai as $row){
																if($edit && $row->nmapanjang == $periode['nmawr2']){
																	echo '<option value="'.$row->kdepeg.'" selected>'.$row->kdepeg.' - '.$row->nmapanjang.'</option>';
																}
																else{
																	echo '<option value="'.$row->kdepeg.'">'.$row->kdepeg.' - '.$row->nmapanjang.'</option>';
																}
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>NIP Wakil Rektor</label>
													<input type="text" class="form-control" placeholder="NIP Wakil Rektor" maxlength="18" size="18" name="wakilniprektor" id="nipWakilRektor" readonly required <?php if($edit){ echo 'value="'.$periode['nipwr2'].'"';} ?>>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Kepala BUK</label>
													<select class="form-control m-select2" id="kepalaBUKForm" name="kepala_buk">
														<option value="" selected disabled>Pilih Kepala BUK</option>
														<?php
															foreach($pegawai as $row){
																if($edit && $row->nmapanjang == $periode['nmakabuk']){
																	echo '<option value="'.$row->kdepeg.'" selected>'.$row->kdepeg.' - '.$row->nmapanjang.'</option>';
																}
																else{
																	echo '<option value="'.$row->kdepeg.'">'.$row->kdepeg.' - '.$row->nmapanjang.'</option>';
																}
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>NIP Kepala BUK</label>
													<input type="text" class="form-control" placeholder="NIP Kepala BUK" maxlength="18" size="18" name="nipkepalabuk" id="nipKepalaBUK" readonly required <?php if($edit){ echo 'value="'.$periode['nipkabuk'].'"';} ?>>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Bendahara</label>
													<select class="form-control m-select2" id="bendaharaForm" name="bendahara">
														<option value="" selected disabled>Pilih Bendahara</option>
														<?php
															foreach($pegawai as $row){
																if($edit && $row->nmapanjang == $periode['nmabendahara']){
																	echo '<option value="'.$row->kdepeg.'" selected>'.$row->kdepeg.' - '.$row->nmapanjang.'</option>';
																}
																else{
																	echo '<option value="'.$row->kdepeg.'">'.$row->kdepeg.' - '.$row->nmapanjang.'</option>';
																}
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>NIP Bendahara</label>
													<input type="text" class="form-control" placeholder="NIP Bendahara" maxlength="18" size="18" name="nipbendahara" id="nipBendahara" readonly required <?php if($edit){ echo 'value="'.$periode['nipbendahara'].'"';} ?>>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-md-2 col-sm-12 col-form-label">Status :</label>
											<div class="col-md-10 col-sm-12">
												<div class="kt-radio-inline">
													<label class="kt-radio kt-radio--success">
														<input type="radio" name="status_periode" value="Aktif" <?php if($edit && $periode['stsrek'] == "Aktif"){echo 'checked';} else if(!$edit){echo 'checked';} ?>> Aktif
														<span></span>
													</label>
													<label class="kt-radio kt-radio--danger">
														<input type="radio" name="status_periode" value="Tdk.Aktif" <?php if($edit && $periode['stsrek'] == "Tdk. Aktif"){echo 'checked';} ?>> Tidak Aktif
														<span></span>
													</label>
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