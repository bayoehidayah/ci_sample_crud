                        <!-- begin:: Content -->
                        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                        	<div class="kt-portlet kt-portlet--mobile">
                        		<div class="kt-portlet__head kt-portlet__head--lg">
                        			<div class="kt-portlet__head-label">
                        				<span class="kt-portlet__head-icon">
                        				    <i class="kt-font-brand flaticon2-plus"></i>
                        				</span>
                        				<h3 class="kt-portlet__head-title">
                        				    Validator Baru
                        				</h3>
                        			</div>
                        		</div>
                        		<form action="#" method="post" enctype="multipart/form-data" id="validatorForm">
                        			<div class="kt-portlet__body">
                        				<div class="row">
                        					<div class="col-md-6 col-sm-12 col-lg-6">
                        						<div class="form-group">
                        							<label>Unit Kerja</label>
                        							<select class="form-control m-select2" id="unitKerjaForm"
                        								name="ukerja" required>
                        								<option value="" selected disabled>Pilih Unit Kerja</option>
                        								<?php
															foreach($ukerja as $row){
                                                                echo '<option value="'.$row->kdeukerja.'">'.$row->kdeukerja.' - '.$row->nmaukerja.'</option>';
															}
														?>
                        							</select>
                        						</div>
                        					</div>
                        					<div class="col-md-6 col-sm-12 col-lg-6">
                        						<div class="form-group">
                        							<label>Satuan Kerja</label>
                        							<select class="form-control m-select2" id="satuanKerjaForm"
                        								name="satker" required>
                        								<option value="" selected disabled>Pilih Unit Kerja Telebih Dahulu</option>
                        							</select>
                        						</div>
                        					</div>
                        					<div class="col-md-12 col-sm-12 col-lg-12">
                        						<div class="form-group">
                        							<label>Pegawai</label>
                        							<select class="form-control m-select2" id="pegawaiForm" name="pegawai"
                        								required>
                        								<option value="" selected disabled>Pilih Satuan Kerja Terlebih Dahulu</option>
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
