<aside class="main-sidebar">
	<?php $class_active = ''; ?>
	<?php $class_active_class = ''; ?>
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">

		<!-- Sidebar Menu -->
		<ul class="sidebar-menu" data-widget="tree">


			<li class="bg-white">
				<?php $image_logo = base_url('public/globals/logo-symbol.png'); ?>
				<a href="<?php echo base_url(); ?>" style="margin: 0; padding: 0;">
					<img src="<?php echo $image_logo; ?>" class="img-responsive img-logo"/>
				</a>
			</li>

			<!-- Sidebar user panel (optional) -->
			<div class="user-panel">
				<?php
				$user_login_id   = ($_SESSION[SESSION_LOGAPPS]['app_user_id']);
				$user_login_name = func_decrypt($_SESSION[SESSION_LOGAPPS]['app_user_name']);
				$user_login_name = word_limiter($user_login_name, 3);
				$get_photo       = $this->db->get_where('apps_operator', array('id' => $user_login_id))->row_array();
				$photo           = base_url('public/themes/admin/dist/img/profile-default-2.jpg');
				if (file_exists("{$get_photo['file_path']}{$get_photo['file_name_original']}")) {
					$photo = base_url("{$get_photo['file_path']}{$get_photo['file_name_original']}");
				}
				?>
				<div class="pull-left image">
					<img src="<?php echo $photo ?>" class="img-circle" alt="User Image">
				</div>
				<div class="pull-left info">
					<p><?php echo $user_login_name; ?></p>
					<!-- Status -->
					<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>

			<?php echo $template['partials_menu']; ?>


			<li class="header" id="sticky-footer">
				<p class="text-white"><i class="fa fa-spinner fa-spin"></i> Site Benchmarking</p>
				<p class="text-white"><strong><i class="fa fa-area-chart"></i> Memory Usage</strong> {memory_usage}</p>
				<p class="text-white"><strong><i class="fa fa-clock-o"></i> Elapsed Time</strong> {elapsed_time} sec</p>
			</li>

		</ul>
		<!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>
