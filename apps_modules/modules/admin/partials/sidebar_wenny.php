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
                <div class="pull-left image">
                    <img src="<?php echo base_url('public/themes/admin/'); ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Alexander Pierce</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

			<?php echo $template['partials_menu']; ?>


            <!-- SIDEBAR MENU FROM USER PRIVILEGE -->
			<?php if (empty($menu)) { ?>
				<?php $menu = $this->config->item('menu'); ?>
			<?php } ?>
			<?php if (!empty($menu)) { ?>
			<?php $parent = '0';
			$parent_child = '0';
			$id           = '';
			$id_child     = ''; ?>
			<?php foreach ($menu

			as $key => $m) { ?>
            <!-- <?php $link = $m['menu_link']; ?> -->
			<?php if ($m['menu_display']) { ?>
			<?php if (!$m['is_parent'] && $m['lvl'] == '1' && empty($m['child'])) { ?>
                <li <?php echo (in_array($this->uri->segment(1), array($m['menu_link'])) && in_array($this->uri->segment(3), array($m['id']))) ? "{$class_active_class}" : ''; ?>>
                    <a href="<?php echo base_url($link); ?>"><i class="<?php echo $m['menu_icon']; ?>"></i> <span><?php echo $m['menu_name']; ?></span></a>
                </li>
			<?php } elseif ($m['lvl'] == '1' && !empty($m['child']) && $menu[$key + 1]['lvl'] == '2' && empty($menu[$key + 1]['child'])) { ?>
		<?php $id = $m['id']; ?>
            <li <?php echo (in_array($this->uri->segment(1), $m['link_array']) && in_array($this->uri->segment(3), $m['child'])) ? "{$class_active}" : ''; ?>>
                <a href="#"><i class="<?php echo $m['menu_icon']; ?>"></i> <span><?php echo $m['menu_name']; ?></span></a>
                <ul class="treeview-menu">
					<?php } elseif (!$m['is_parent'] && $m['lvl'] == '2' && empty($m['child'])) { ?>
                        <li <?php echo (in_array($this->uri->segment(1), array($m['menu_link'])) && in_array($this->uri->segment(3), array($m['id']))) ? "{$class_active_class}" : ''; ?>><a href="<?php echo base_url($link); ?>"><i class="<?php echo $m['menu_icon']; ?>"></i> <span><?php echo $m['menu_name']; ?></span></a></li>
					<?php }
                    elseif ($m['lvl'] == '2' && !empty($m['child'])) { ?>
				<?php $id_child = $m['id']; ?>
                    <li <?php echo (in_array($this->uri->segment(1), $m['link_array']) && in_array($this->uri->segment(3), $m['child'])) ? "{$class_active}" : ''; ?>>
                        <a href="#"><i class="<?php echo $m['menu_icon']; ?>"></i> <span><?php echo $m['menu_name']; ?></span></a>
                        <ul class="treeview-menu">
							<?php } elseif (!$m['is_parent'] && $m['lvl'] == '3' && empty($m['child'])) { ?>
                                <li <?php echo (in_array($this->uri->segment(1), array($m['menu_link'])) && in_array($this->uri->segment(3), array($m['id']))) ? "{$class_active_class}" : ''; ?>><a href="<?php echo base_url($link); ?>"><i class="<?php echo $m['menu_icon']; ?>"></i> <span><?php echo $m['menu_name']; ?></span></a></li>
							<?php } ?>

							<?php if (!empty($menu[$key + 1])) {
							$next = $menu[$key + 1]; ?>
							<?php if (!empty($id) && $next['lvl'] == '1') { ?>
							<?php if ($next['parent'] != $id) { ?>
                        </ul>
                    </li>
				<?php $id = '';
				} ?>
				<?php } ?>
					<?php if (!empty($id_child) && $next['lvl'] == '2') { ?>
					<?php if ($next['parent'] != $id_child) { ?>
                </ul>
            </li>
		<?php $id_child = '';
		} ?>
		<?php } ?>
			<?php } else if (!empty($id)) { ?>
        </ul>
        </li>
		<?php } ?>
		<?php } ?>
		<?php } ?>
		<?php } else { ?>
			<?php
			$class_active_1_case  = $this->uri->segment(1);
			$class_active_1_check = array('mod_dashboard');
			?>
            <li<?php echo (in_array($class_active_1_case, $class_active_1_check)) ? "{$class_active_class}" : ''; ?>><a href="<?php echo site_url('mod_dashboard'); ?>"><i class="fa fa-home"></i> <span>Beranda</span></a></li>

		<?php } ?>

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
