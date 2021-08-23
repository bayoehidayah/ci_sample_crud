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
												if($edit) { echo "Edit Pengguna ". $pengguna->id;} 
												else { echo "Buat Pengguna Baru";}
											?>
										</h3>
									</div>
								</div>
								<form action="#" method="post" enctype="multipart/form-data" id="penggunaForm">
									<input type="hidden" id="edit" value="<?= $edit; ?>">
									<input type="hidden" id="tipe" value="<?= $pengguna->tipe; ?>">
									<div class="kt-portlet__body">
                                        <div class="row">
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Tipe Pengguna *</label>
													<select class="form-control" id="tipePengguna" name="tipe" required <?php if($edit){ echo "readonly"; } ?>>
														<option value="" selected disabled>Pilih Tipe Pengguna</option>
														<?php foreach($type as $key => $val) { ?>
															<option value="<?= $key; ?>" <?php if($edit && $pengguna->tipe == $key){ echo "selected"; }?>><?= $val; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
                                            <div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>ID Pengguna *</label>
													<input type="text" class="form-control" placeholder="Auto Generate From Tipe Pengguna" name="id" id="idPengguna" required <?php if($edit){ echo 'value="'.$pengguna->id.'"';} ?> readonly>
												</div>
                                            </div>

											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Nama Pengguna *</label>
													<input type="text" class="form-control" placeholder="Enter Nama Pengguna" name="nama" id="nama" required <?php if($edit){ echo 'value="'.$pengguna->nama.'"';} ?> size="50" maxlength="50">
												</div>
                                            </div>

											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Nama Anak</label>
													<input type="text" class="form-control" placeholder="Enter Nama Anak" name="nama_anak" id="nama_anak" <?php if($edit){ echo 'value="'.$pengguna->nama_anak.'"';} ?>>
												</div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Email *</label>
													<input type="email" class="form-control" placeholder="Enter Email Pengguna" name="email" id="email" required <?php if($edit){ echo 'value="'.$pengguna->email.'"';} ?> >
												</div>
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
													<label>Password</label>
													<input type="password" class="form-control" name="password" id="password" <?php if(!$edit){ echo 'placeholder="Enter Password Pengguna"  required ';} else { echo 'placeholder="Kosongkan jika tidak ingin mengubah"';  }?> >
												</div>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
										<div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4">
                                                <div class="form-group">
                                                    <label>NIK</label>
													<input type="number" class="form-control" placeholder="Enter NIK" name="nik" id="nik" required <?php if($edit){ echo 'value="'.$pengguna->nik.'"';} ?> >
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
                                                    <label>Pekerjaan</label>
													<input type="text" class="form-control" placeholder="Enter Pekerjaan" name="pekerjaan" id="pekerjaan" required <?php if($edit){ echo 'value="'.$pengguna->pekerjaan.'"';} ?> >
                                                </div>
											</div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
                                                    <label>No HP</label>
													<input type="text" class="form-control" placeholder="Enter No HP" name="no_hp" id="no_hp" required <?php if($edit){ echo 'value="'.$pengguna->no_hp.'"';} ?> >
                                                </div>
											</div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
                                                    <label>Bank</label>
													<input type="text" class="form-control" placeholder="Enter Bank" name="bank" id="bank" required <?php if($edit){ echo 'value="'.$pengguna->bank.'"';} ?> >
                                                </div>
											</div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
                                                    <label>No Rek</label>
													<input type="text" class="form-control" placeholder="Enter No Rek" name="no_rek" id="no_rek" required <?php if($edit){ echo 'value="'.$pengguna->no_rek.'"';} ?> >
                                                </div>
											</div>
											<div class="col-md-4 col-sm-12 col-lg-4">
												<div class="form-group">
                                                    <label>No KTP</label>
													<input type="text" class="form-control" placeholder="Enter No KTP" name="no_ktp" id="no_ktp" required <?php if($edit){ echo 'value="'.$pengguna->no_ktp.'"';} ?> >
                                                </div>
											</div>
											<div class="col-md-12 col-sm-12 col-lg-12">
												<div class="form-group">
                                                    <label>Alamat</label>
													<textarea name="alamat" id="alamat" rows="5" class="form-control"><?php if($edit){ echo $pengguna->alamat; } ?></textarea>
                                                </div>
											</div>
										</div>
										<div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
										<div class="row">
											<?php if($edit && ($pengguna->photo != "" || $pengguna->photo != null)) { ?>
											<div class="col-md-12">
												Foto : <a href="<?= base_url("download/photo/user/".$pengguna->id); ?>"><span class="la la-cloud-download"></span> <?= $pengguna->photo; ?></a>
											</div>
											<br/><br/>
											<?php } ?>
											<div class="col-md-12 col-sm-12 col-lg-12">
												<div class="form-group">
													<label><?php if($edit && ($pengguna->photo != "" || $pengguna->photo != null)){ echo 'Change Foto (Max : 2MB)'; }else {echo 'Search Foto (Max : 2 MB)';} ?></label>
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