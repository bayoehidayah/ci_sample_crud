                        <!-- begin:: Content -->
                        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
										    <i class="kt-font-brand flaticon2-plus"></i>											
										</span>
										<h3 class="kt-portlet__head-title">
											Buat User Password Baru
										</h3>
									</div>
								</div>
								<form action="#" method="post" enctype="multipart/form-data" id="userForm">
									<div class="kt-portlet__body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12">
												<div class="form-group">
													<label>Pegawai</label>
													<select class="form-control m-select2" id="pegawaiForm" name="pegawai" required>
														<option value="" selected disabled>Pilih Pegawai</option>
														<?php
															foreach($pegawai as $row){
                                                                echo '<option value="'.$row->kdepeg.'">'.$row->kdepeg.' - '.$row->nmapanjang.'</option>';
															}
														?>
													</select>
												</div>
											</div>
                                            <div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Username</label>
													<input type="text" class="form-control" placeholder="Enter Username" name="username" id="username" required maxlength="30" size="30">
												</div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Password</label>
													<input type="password" class="form-control" placeholder="Enter Password" name="password" id="password" required>
												</div>
                                            </div>
                                            <div class="col-md-3 col-sm-12 col-lg-3">
												<div class="form-group">
													<label>Kode Aplikasi</label>
													<input type="text" class="form-control" placeholder="Enter Kode Aplikasi" name="kdeaplikasi" id="kdeaplikasi" maxlength="30" size="30">
												</div>
                                            </div>
                                            <div class="col-md-3 col-sm-12 col-lg-3">
												<div class="form-group">
													<label>Level User</label>
													<select class="form-control m-select2" id="userLevelFom" name="user_level" required>
														<option value="" selected disabled>Pilih Level User</option>
														<option value="Super">Super</option>
														<!-- <option value="BLU">BLU</option>
														<option value="Rektor">Rektor</option>
														<option value="Biro">Biro</option>
														<option value="Fakultas">Fakultas</option>
														<option value="Prodi">Prodi</option>
														<option value="Unit">Unit</option>
														<option value="SDM">SDM</option> -->
														<option value="Op Fakultas">Op Fakultas</option>
														<option value="Op Unit">Op Unit</option>
														<!-- <option value="Validator">Validator</option> -->
														<option value="Verifikator">Verifikator</option>
														<option value="LPPM">LPPM</option>
														<option value="Kepegawaian">Kepegawaian</option>
														<option value="BAAK">BAAK</option>
														<option value="Pegawai">Pegawai</option>
													</select>
												</div>
                                            </div>
                                            <div class="col-md-3 col-sm-12 col-lg-3">
												<div class="form-group">
													<label>Unit Kerja</label>
													<input type="text" class="form-control" placeholder="Silahkan pilih pegawai" name="ukerja" id="ukerja" required readonly>
												</div>
                                            </div>
                                            <div class="col-md-3 col-sm-12 col-lg-3">
												<div class="form-group">
													<label>Satuan Kerja</label>
													<input type="text" class="form-control" placeholder="Silahkan pilih pegawai" name="satker" id="satker" required readonly>
												</div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Hak Akses</label>
                                            <div class="kt-checkbox-inline">
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" name="akses[]" value="all_true" id="allHakAkses"> All
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" name="akses[]" value="view_true" class="hak-akses" id="viewAkses"> View
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" name="akses[]" value="read_true" class="hak-akses" id="readAkses"> Read
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" name="akses[]" value="update_true" class="hak-akses" id="updateAkses"> Update
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" name="akses[]" value="delete_true" class="hak-akses" id="deleteAkses"> Delete
                                                    <span></span>
                                                </label>
                                            </div>
                                            <span class="form-text text-muted">Batasan yang dapat dilakukan oleh user berdasarkan level user.</span>
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