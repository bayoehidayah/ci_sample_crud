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
												if($edit) { echo "Edit Transaksi Penunjang ". $penunjang['kdepeg'];} 
												else { echo "Transaksi Penunjang Baru";}
											?>
										</h3>
									</div>
								</div>
								<form action="#" method="post" enctype="multipart/form-data" id="penunjangForm">
									<div class="kt-portlet__body">
										<div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12">
												<div class="form-group">
													<label>Pegawai</label>
													<?php if($level != "Pegawai") { ?>
													<select class="form-control m-select2" id="pegawaiForm" name="pegawai" required>
														<option value="" selected disabled>Pilih Pegawai</option>
														<?php
															foreach($pegawai as $row){
																if($edit && $row->kdepeg == $penunjang['kdepeg']){
																	echo '<option value="'.$row->kdepeg.'" selected>'.$row->kdepeg.' - '.$row->nmapanjang.'</option>';
																}
																else{
                                                                    echo '<option value="'.$row->kdepeg.'">'.$row->kdepeg.' - '.$row->nmapanjang.'</option>';
																}
															}
														?>
													</select>
													<?php } else { ?>
													<input type="text" class="form-control" name="pegawai" readonly value="<?= $this->session->userdata("kdepeg"); ?>">
													<?php } ?>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Periode</label>
													<select class="form-control m-select2" id="periodeForm" name="periode" required>
														<option value="" selected disabled>Pilih Periode</option>
														<?php
															foreach($periode as $row){
																if($edit && $row->periode == $penunjang['periode']){
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
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Peran</label>
													<select class="form-control m-select2" id="peranForm" name="peran" required>
														<option value="" selected disabled>Pilih Peran</option>
														<?php
															foreach($peran as $row){
                                                                if($row->kdeaktivitas[0] != 5){
                                                                    continue;
                                                                }

																if($edit && $row->kdeperan == $penunjang['kdeperan']){
																	echo '<option value="'.$row->kdeperan.'" selected>'.$row->kdeperan.' - '.$row->nmaperan.'</option>';
																}
																else{
                                                                    echo '<option value="'.$row->kdeperan.'">'.$row->kdeperan.' - '.$row->nmaperan.'</option>';
																}
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
													<label>Dokumen</label>
													<select class="form-control m-select2" id="dokumenForm" name="dokumen" required>
														<option value="" selected disabled>Pilih Dokumen</option>
														<?php
															foreach($dokumen as $row){
																if($edit && $row->udi == $penunjang['udi_trdokumen']){
																	echo '<option value="'.$row->udi.'" selected>'.$row->nomskdokumen.' - '.$row->judul.'</option>';
																}
																else{
                                                                    echo '<option value="'.$row->udi.'">'.$row->nomskdokumen.' - '.$row->judul.'</option>';
																}
															}
														?>
													</select>
												</div>
											</div>
                                            <div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Poin Aktivitas</label>
													<input type="number" class="form-control" placeholder="Enter Point Aktivitas" name="poin_aktivitas" id="pointAktivitasForm" required <?php if($edit){ echo 'value="'.$penunjang['poinaktivitas'].'"';} ?> step=".01">
												</div>
											</div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 col-sm-12 col-form-label">Status Penunjang :</label>
                                            <div class="col-md-10 col-sm-12">
                                                <div class="kt-radio-inline">
                                                    <label class="kt-radio kt-radio--success">
                                                        <input type="radio" name="status_penunjang" value="Aktif" <?php if($edit && $penunjang['stsrek'] == "Aktif"){echo 'checked';} else if(!$edit){echo 'checked';} ?>> Aktif
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-radio kt-radio--danger">
                                                        <input type="radio" name="status_penunjang" value="Batal" <?php if($edit && $penunjang['stsrek'] == "Batal"){echo 'checked';} ?>> Batal
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 col-sm-12 col-form-label">Status Aktivitas :</label>
                                            <div class="col-md-10 col-sm-12">
                                                <div class="kt-radio-inline">
                                                    <label class="kt-radio kt-radio--success">
                                                        <input type="radio" name="status_aktivitas" value="Aktif" <?php if($edit && $aktivitas['stsrek'] == "Aktif"){echo 'checked';} else if(!$edit){echo 'checked';} ?>> Aktif
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-radio kt-radio--danger">
                                                        <input type="radio" name="status_aktivitas" value="Batal" <?php if($edit && $aktivitas['stsrek'] == "Batal"){echo 'checked';} ?>> Batal
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