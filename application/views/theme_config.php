<?php
	$uri_1 = $this->uri->segment(1);
	$uri_2 = $this->uri->segment(2);
	$uri_3 = $this->uri->segment(3);
?>
<html>
    <head>
		<meta charset="utf-8" />
		<title><?= $page_title; ?></title>
		<meta name="description" content="Login page example">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Googles -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-157507484-1"></script>
		<!-- <script> WebFont.load({ google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},active: function() { sessionStorage.fonts = true; } });  window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-157507484-1');</script> -->

		<!--end::Googles -->

		<!--begin::Page Custom Styles(used by this page) -->
        <?php if($login) { ?>
		<link href="<?= base_url("assets/app/custom/login/login-v1.default.css"); ?>" rel="stylesheet" type="text/css" />
        <?php } else if($error){  ?>
		<link href="<?= base_url("assets/app/custom/error/error-v3.default.css"); ?>" rel="stylesheet" type="text/css" />
		<?php }?>
		<link href="<?= base_url("assets/vendors/custom/fullcalendar/fullcalendar.bundle.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/custom/datatables/datatables.bundle.css"); ?>" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles -->

		<!--begin:: Global Mandatory Vendors -->
		<link href="<?= base_url("assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css"); ?>" rel="stylesheet" type="text/css" />

		<!--end:: Global Mandatory Vendors -->

		<!--begin:: Global Optional Vendors -->
		<link href="<?= base_url("assets/vendors/general/tether/dist/css/tether.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/general/bootstrap-daterangepicker/daterangepicker.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/general/select2/dist/css/select2.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/general/ion-rangeslider/css/ion.rangeSlider.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/general/nouislider/distribute/nouislider.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/general/owl.carousel/dist/assets/owl.theme.default.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/general/dropzone/dist/dropzone.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/general/summernote/dist/summernote.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/general/animate.css/animate.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/general/toastr/build/toastr.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/general/morris.js/morris.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/general/sweetalert2/dist/sweetalert2.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/general/socicon/css/socicon.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/custom/vendors/line-awesome/css/line-awesome.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/custom/vendors/flaticon/flaticon.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/custom/vendors/flaticon2/flaticon.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/vendors/custom/vendors/fontawesome5/css/all.min.css"); ?>" rel="stylesheet" type="text/css" />

		<!--end:: Global Optional Vendors -->

		<!--begin::Global Theme Styles(used by all pages) -->
		<link href="<?= base_url("assets/demo/default/base/style.bundle.css"); ?>" rel="stylesheet" type="text/css" />

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->
		<link href="<?= base_url("assets/demo/default/skins/header/base/dark.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/demo/default/skins/header/menu/dark.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/demo/default/skins/brand/dark.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url("assets/demo/default/skins/aside/dark.css"); ?>" rel="stylesheet" type="text/css" />

		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="<?= base_url("assets/media/logos/logo remun.png"); ?>"/>

		<style>
			.select2-container {
				width: 100% !important;
				padding: 0;
			}
			.kt-header{
				background-color: #1e1e2d;
			}
			.kt-header .kt-menu__link-text{
				color:#fff;
			}

			.kt-header .kt-menu__link{
				background-color: #282f48;
				border-radius: 4px;
			}
			
		</style>
	</head>
	<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-footer--fixed kt-page--loading">

        <?php if($login || $error) {
            echo $content;
		}
        else{
            echo $sidebar;
			echo $topbar;
			echo $content;
            echo $footer;
        }
        ?>

		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>
		<!-- This App Made By : Bayu Hidayah M.
		Visit my personal website : https://bayhid.com
		Contact me : bayhidmelandisaja@gmail.com -->
        <!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};
		</script>

        <!--begin:: Global Mandatory Vendors -->
		<script src="<?= base_url("assets/vendors/general/jquery/dist/jquery.js"); ?>" typ="text/javascript"></script>
		<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
		<script src="<?= base_url("assets/vendors/general/popper.js/dist/umd/popper.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/bootstrap/dist/js/bootstrap.min.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/js-cookie/src/js.cookie.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/moment/min/moment.min.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/sticky-js/dist/sticky.min.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/wnumb/wNumb.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/app/custom/general/vendor.js"); ?>" typ="text/javascript"></script>

		<!--end:: Global Mandatory Vendors -->

		<!--begin:: Global Optional Vendors -->
		<script src="<?= base_url("assets/vendors/general/jquery-form/dist/jquery.form.min.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/block-ui/jquery.blockUI.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/custom/components/vendors/bootstrap-datepicker/init.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/custom/components/vendors/bootstrap-timepicker/init.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/bootstrap-daterangepicker/daterangepicker.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/bootstrap-switch/dist/js/bootstrap-switch.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/custom/components/vendors/bootstrap-switch/init.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/select2/dist/js/select2.full.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/ion-rangeslider/js/ion.rangeSlider.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/typeahead.js/dist/typeahead.bundle.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/handlebars/dist/handlebars.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/inputmask/dist/jquery.inputmask.bundle.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/nouislider/distribute/nouislider.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/owl.carousel/dist/owl.carousel.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/autosize/dist/autosize.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/clipboard/dist/clipboard.min.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/dropzone/dist/dropzone.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/summernote/dist/summernote.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/markdown/lib/markdown.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/bootstrap-markdown/js/bootstrap-markdown.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/custom/components/vendors/bootstrap-markdown/init.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/bootstrap-notify/bootstrap-notify.min.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/custom/components/vendors/bootstrap-notify/init.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/jquery-validation/dist/jquery.validate.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/jquery-validation/dist/additional-methods.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/custom/components/vendors/jquery-validation/init.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/toastr/build/toastr.min.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/raphael/raphael.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/morris.js/morris.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/chart.js/dist/Chart.bundle.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/custom/vendors/jquery-idletimer/idle-timer.min.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/waypoints/lib/jquery.waypoints.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/counterup/jquery.counterup.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/es6-promise-polyfill/promise.min.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/sweetalert2/dist/sweetalert2.min.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/custom/components/vendors/sweetalert2/init.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/jquery.repeater/src/lib.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/jquery.repeater/src/jquery.input.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/jquery.repeater/src/repeater.js"); ?>" typ="text/javascript"></script>
		<script src="<?= base_url("assets/vendors/general/dompurify/dist/purify.js"); ?>" typ="text/javascript"></script>

		<!--end:: Global Optional Vendors -->

		<!--begin::Global Theme Bundle(used by all pages) -->
		<script src="<?= base_url("assets/demo/default/base/scripts.bundle.js"); ?>" typ="text/javascript"></script>
		<script src="//www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
		<script src="//www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
		<script src="//www.amcharts.com/lib/3/radar.js" type="text/javascript"></script>
		<script src="//www.amcharts.com/lib/3/pie.js" type="text/javascript"></script>
		<script src="//www.amcharts.com/lib/3/plugins/tools/polarScatter/polarScatter.min.js" type="text/javascript"></script>
		<script src="//www.amcharts.com/lib/3/plugins/animate/animate.min.js" type="text/javascript"></script>
		<script src="//www.amcharts.com/lib/3/plugins/export/export.min.js" type="text/javascript"></script>
		<script src="//www.amcharts.com/lib/3/themes/light.js" type="text/javascript"></script>
		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts(used by this page) -->
        <?php if($login) { ?>
		<!-- <script src="<?= base_url("assets/app/custom/login/login-v1.js"); ?>" typ="text/javascript"></script> -->
        <?php } else{ ?>
		<script src="<?= base_url("assets/vendors/custom/datatables/datatables.bundle.js"); ?>" type="text/javascript"></script>
		<!-- <script src="<?= base_url("assets/app/custom/general/dashboard.js"); ?>" typ="text/javascript"></script> -->
        <?php } ?>
		<!--end::Page Scripts -->

        <!-- begin::Costum Script -->
		<script>
			function formatCurrency(amount, decimalCount = 2, decimal = ",", thousands = ".") {
				try {
					decimalCount = Math.abs(decimalCount);
					decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

					const negativeSign = amount < 0 ? "-" : "";

					let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
					let j = (i.length > 3) ? i.length % 3 : 0;

					return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
				} catch (e) {
					console.log(e)
				}
			}
		</script>
		<?php include($js); ?>

        <!-- end::Costum Script -->

		<!--begin::Global App Bundle(used by all pages) -->
		<script src="<?= base_url("assets/app/bundle/app.bundle.js"); ?>" typ="text/javascript"></script>

		<!--end::Global App Bundle -->

    </body>
</html>
