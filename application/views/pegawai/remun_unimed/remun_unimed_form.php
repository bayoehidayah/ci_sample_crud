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
												if($edit) { echo "Edit Pegawai ". $pegawai['kdepeg'];} 
												else { echo "Buat Pegawai Baru";}
											?>
										</h3>
									</div>
								</div>
								<form action="#" method="post" enctype="multipart/form-data" id="remunForm">
									<div class="kt-portlet__body">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Kode Pegawai</label>
													<input type="text" class="form-control" placeholder="Ex : AAA00001" name="kdepeg" id="kdepeg" required <?php if($edit){ echo 'value="'.$pegawai['kdepeg'].'" readonly';} ?> size="8" maxlength="8">
												</div>
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>NIP</label>
													<input type="number" class="form-control" placeholder="Enter NIP Pegawai" name="nip" id="nip" required <?php if($edit){ echo 'value="'.$pegawai['nip'].'"';} ?> size="18" maxlength="18" min="1">
												</div>
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>NIDN</label>
													<input type="text" class="form-control" placeholder="Enter NIDN Pegawai" name="nidn" id="nidn" required <?php if($edit){ echo 'value="'.$pegawai['nidn'].'"';} ?> size="12" maxlength="12">
												</div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Nama Pegawai</label>
													<input type="text" class="form-control" placeholder="Enter Nama Pegawai (Asli)" name="nmapeg" id="nmapeg" required <?php if($edit){ echo 'value="'.$pegawai['nmapeg'].'"';} ?> size="50" maxlength="50">
												</div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Nama Panjang</label>
													<input type="text" class="form-control" placeholder="Enter Nama Pegawai (Dengan Gelar)" name="nmapanjang" id="nmapanjang" required <?php if($edit){ echo 'value="'.$pegawai['nmapanjang'].'"';} ?> size="50" maxlength="50">
												</div>
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Tempat Lahir</label>
													<input type="text" class="form-control" placeholder="Enter Nama Pegawai" name="temlhr" id="temlhr" required <?php if($edit){ echo 'value="'.$pegawai['temlhr'].'"';} ?> size="30" maxlength="30">
												</div>
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Tanggal Lahir</label>
													<input type="text" class="form-control" placeholder="Pilih Tanggal" name="tgllhr" id="tgllhr" required <?php if($edit){ echo 'value="'.$pegawai['tgllhr'].'"';} ?> size="30" maxlength="30">
												</div>
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Jenis Kelamin</label>
													<select class="form-control" id="gender" name="gender" required>
														<option value="" selected disabled>Pilih Jenis Kelamin</option>
														<option value="L" <?php if($edit && $pegawai['gender'] == "L"){ echo "selected"; }?>>Laki-Laki</option>
														<option value="P" <?php if($edit && $pegawai['gender'] == "P"){ echo "selected"; }?>>Perempuan</option>
													</select>
												</div>
											</div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
										<div class="row">
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Jenis Pendidikan</label>
													<select class="form-control m-select2" id="jendik" name="jendik" required>
                                                        <option value="" disabled selected>Pilih Jenis Pendidikan</option>
														<?php
                                                            foreach($jendik as $row){
                                                                if($edit && $row->kdejendik == $pegawai['jendik']){
                                                                    echo '<option value="'.$row->kdejendik.'" selected>'.$row->jendik.'</option>';
                                                                }
                                                                else{
                                                                    echo '<option value="'.$row->kdejendik.'">'.$row->jendik.'</option>';
                                                                }
                                                            }
														?>
													</select>
												</div>
											</div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Golongan PNS</label>
													<select class="form-control m-select2" id="golpns" name="golpns" required>
                                                        <option value="" disabled selected>Pilih Golongan PNS</option>
                                                        <option value="">-</option>
														<?php
                                                            foreach($golpns as $row){
                                                                if($edit && $row->golpns == $pegawai['golpns']){
                                                                    echo '<option value="'.$row->golpns.'" selected>'.$row->golpns.'</option>';
                                                                }
                                                                else{
                                                                    echo '<option value="'.$row->golpns.'">'.$row->golpns.'</option>';
                                                                }
                                                            }
														?>
													</select>
												</div>
											</div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>TMT Golongan</label>
													<input type="text" class="form-control" placeholder="Pilih Tanggal" name="tmtgol" id="tmtgol" required <?php if($edit){ echo 'value="'.$pegawai['tmtgol'].'"';} ?> size="30" maxlength="30">
												</div>
                                            </div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>KDN Pegawai</label>
													<select class="form-control m-select2" id="kdnpeg" name="kdnpeg" required>
                                                        <option value="" disabled selected>Pilih KDN Pegawai</option>
														<?php
                                                            foreach($kdnpeg as $row){
                                                                if($edit && $row->kdekdnpeg == $pegawai['kdekdnpeg']){
                                                                    echo '<option value="'.$row->kdekdnpeg.'" selected>'.$row->kdekdnpeg.' - '.$row->kdnpeg.'</option>';
                                                                }
                                                                else{
                                                                    echo '<option value="'.$row->kdekdnpeg.'">'.$row->kdekdnpeg.' - '.$row->kdnpeg.'</option>';
                                                                }
                                                            }
														?>
													</select>
												</div>
											</div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Status Pegawai</label>
													<select class="form-control m-select2" id="stspeg" name="stspeg" required>
                                                        <option value="" disabled selected>Pilih Status Pegawai</option>
														<?php
                                                            foreach($stspeg as $row){
                                                                if($edit && $row->kdestspeg == $pegawai['kdestspeg']){
                                                                    echo '<option value="'.$row->kdestspeg.'" selected>'.$row->kdestspeg.' - '.$row->stspeg.'</option>';
                                                                }
                                                                else{
                                                                    echo '<option value="'.$row->kdestspeg.'">'.$row->kdestspeg.' - '.$row->stspeg.'</option>';
                                                                }
                                                            }
														?>
													</select>
												</div>
											</div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Jenis Pegawai</label>
													<select class="form-control m-select2" id="jnspeg" name="jnspeg" required>
                                                        <option value="" disabled selected>Pilih Jenis Pegawai</option>
														<?php
                                                            foreach($jnspeg as $row){
                                                                if($edit && $row->kdejnspeg == $pegawai['kdejnspeg']){
                                                                    echo '<option value="'.$row->kdejnspeg.'" selected>'.$row->kdejnspeg.' - '.$row->jnspeg.'</option>';
                                                                }
                                                                else{
                                                                    echo '<option value="'.$row->kdejnspeg.'">'.$row->kdejnspeg.' - '.$row->jnspeg.'</option>';
                                                                }
                                                            }
														?>
													</select>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Jabatan F</label>
													<select class="form-control m-select2" id="nmajabf" name="nmajabf" required>
                                                        <option value="" disabled selected>Pilih Jabatan F</option>
														<?php
                                                            foreach($nmajab as $row){
                                                                if($edit && $row->kdenmajab == $pegawai['kdenmajabf']){
                                                                    echo '<option value="'.$row->kdenmajab.'" selected>'.$row->kdenmajab.' - '.$row->nmajab.'</option>';
                                                                }
                                                                else{
                                                                    echo '<option value="'.$row->kdenmajab.'">'.$row->kdenmajab.' - '.$row->nmajab.'</option>';
                                                                }
                                                            }
														?>
													</select>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Jabatan</label>
													<select class="form-control m-select2" id="nmajab" name="nmajab" required>
                                                        <option value="" disabled selected>Pilih Jabatan</option>
														<?php
                                                            foreach($nmajab as $row){
                                                                if($edit && $row->kdenmajab == $pegawai['kdenmajab']){
                                                                    echo '<option value="'.$row->kdenmajab.'" selected>'.$row->kdenmajab.' - '.$row->nmajab.'</option>';
                                                                }
                                                                else{
                                                                    echo '<option value="'.$row->kdenmajab.'">'.$row->kdenmajab.' - '.$row->nmajab.'</option>';
                                                                }
                                                            }
														?>
													</select>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Kelas Jabatan F</label>
													<select class="form-control m-select2" id="klsjabf" name="klsjabf" required>
                                                        <option value="" disabled selected>Pilih Kelas Jabatan F</option>
														<?php
                                                            foreach($klsjab as $row){
                                                                if($edit && $row->kdeklsjab == $pegawai['kdeklsjab']){
                                                                    echo '<option value="'.$row->kdeklsjab.'" selected>'.$row->kdeklsjab.' - '.$row->nmaklsjab.'</option>';
                                                                }
                                                                else{
                                                                    echo '<option value="'.$row->kdeklsjab.'">'.$row->kdeklsjab.' - '.$row->nmaklsjab.'</option>';
                                                                }
                                                            }
														?>
													</select>
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Kelas Jabatan</label>
													<select class="form-control m-select2" id="klsjab" name="klsjab" required>
                                                        <option value="" disabled selected>Pilih Kelas Jabatan</option>
														<?php
                                                            foreach($klsjab as $row){
                                                                if($edit && $row->kdeklsjab == $pegawai['kdeklsjab']){
                                                                    echo '<option value="'.$row->kdeklsjab.'" selected>'.$row->kdeklsjab.' - '.$row->nmaklsjab.'</option>';
                                                                }
                                                                else{
                                                                    echo '<option value="'.$row->kdeklsjab.'">'.$row->kdeklsjab.' - '.$row->nmaklsjab.'</option>';
                                                                }
                                                            }
														?>
													</select>
												</div>
											</div>
                                            <div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>TMT Jabatan</label>
													<input type="text" class="form-control" placeholder="Pilih Tanggal" name="tmtjabatan" id="tmtjabatan" required <?php if($edit){ echo 'value="'.$pegawai['tmtjabatan'].'"';} ?> size="30" maxlength="30">
												</div>
                                            </div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Jabatan Akademik</label>
													<select class="form-control m-select2" id="jabakad" name="jabakad" required>
                                                        <option value="" disabled selected>Pilih Jabatan Akademik</option>
														<?php
                                                            foreach($jabakad as $row){
                                                                if($edit && $row->kdejabakad == $pegawai['kdejabakad']){
                                                                    echo '<option value="'.$row->kdejabakad.'" selected>'.$row->kdejabakad.' - '.$row->jabakad.'</option>';
                                                                }
                                                                else{
                                                                    echo '<option value="'.$row->kdejabakad.'">'.$row->kdejabakad.' - '.$row->jabakad.'</option>';
                                                                }
                                                            }
														?>
													</select>
												</div>
											</div>
                                            <div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Keterangan Jabatan</label>
													<input type="text" class="form-control" placeholder="Enter Keterangan Jabatan" name="ket_jabatan" id="ket_jabatan" <?php if($edit){ echo 'value="'.$pegawai['ket_jabatan'].'"';} ?> size="100" maxlength="100">
												</div>
                                            </div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Satuan Kerja</label>
													<select class="form-control m-select2" id="satker" name="satker" required>
                                                        <option value="" disabled selected>Pilih Satuan Kerja</option>
														<?php
                                                            foreach($satker as $row){
                                                                if($edit && $row->kdesatker == $pegawai['kdesatker']){
                                                                    echo '<option value="'.$row->kdesatker.'" selected>'.$row->kdesatker.' - '.$row->nmasatker.'</option>';
                                                                }
                                                                else{
                                                                    echo '<option value="'.$row->kdesatker.'">'.$row->kdesatker.' - '.$row->nmasatker.'</option>';
                                                                }
                                                            }
														?>
													</select>
												</div>
											</div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Unit Laporan</label>
													<select class="form-control m-select2" id="ulapor" name="ulapor" required>
                                                        <option value="" disabled selected>Pilih Unit Laporan</option>
														<?php
                                                            foreach($ulapor as $row){
                                                                if($edit && $row->kdeulapor == $pegawai['kdeulapor']){
                                                                    echo '<option value="'.$row->kdeulapor.'" selected>'.$row->kdeulapor.' - '.$row->nmaulapor.'</option>';
                                                                }
                                                                else{
                                                                    echo '<option value="'.$row->kdeulapor.'">'.$row->kdeulapor.' - '.$row->nmaulapor.'</option>';
                                                                }
                                                            }
														?>
													</select>
												</div>
											</div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Status Rek</label>
													<select class="form-control m-select2" id="stsrek" name="stsrek" required>
                                                        <option value="" disabled selected>Pilih Status Rek</option>
														<option value="Aktif" <?php if($edit && $pegawai['stsrek'] == "Aktif"){echo "selected";} ?>>Aktif</option>
														<option value="Tdk.Aktif" <?php if($edit && $pegawai['stsrek'] == "Tdk.Aktif"){echo "selected";} ?>>Tdk.Aktif</option>
														<option value="TB" <?php if($edit && $pegawai['stsrek'] == "TB"){echo "selected";} ?>>TB</option>
														<option value="DPK" <?php if($edit && $pegawai['stsrek'] == "DPK"){echo "selected";} ?>>DPK</option>
													</select>
												</div>
											</div>
										</div>
										<div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
										<div class="row">
											<?php if($edit && ($pegawai['pasfoto'] != "" || $pegawai['pasfoto'] != null)) { ?>
											<div class="col-md-12">
												Foto : <a href="<?= base_url("pegawai/remun-unimed/foto-download/".$pegawai['idi']); ?>"><span class="la la-cloud-download"></span> <?= $pegawai['pasfoto']; ?></a>
											</div>
											<br/><br/>
											<?php } ?>
											<div class="col-md-12 col-sm-12 col-lg-12">
												<div class="form-group">
													<label><?php if($edit && ($pegawai['pasfoto'] != "" || $pegawai['pasfoto'] != null)){ echo 'Change Foto (Max : 2MB)'; }else {echo 'Search Foto (Max : 2 MB)';} ?></label>
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="validatedCustomFile" name="foto">
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