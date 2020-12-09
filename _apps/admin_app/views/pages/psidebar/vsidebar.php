<section class="sidebar">
	<ul class="sidebar-menu" data-widget="tree">
		<li id="link-dashboard">
			<a href="<?=site_url();?>../../dashboard">
				<i class="fas fa-chevron-right f10"></i> <span> Utama</span>
			</a>
		</li>
		<li id="menu1" class="treeview">
			<a href="#">
				<i class="fas fa-chevron-right f10"></i> <span> Museum</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li id="msm-submenu">
					<a href="<?=site_url();?>../../msm/submenu"><i class="far fa-circle text-red f8"></i> Menu</a>
				</li>
				<li id="msm-category">
					<a href="<?=site_url();?>../../msm/category"><i class="far fa-circle text-red f8"></i> <span> Kategori</span></a>
				</li>
				<li id="msm-detail">
					<a href="<?=site_url();?>../../msm/detail"><i class="far fa-circle text-red f8"></i> <span> Detail</span></a>
				</li>
				<li id="msm-about">
					<a href="<?=site_url();?>../../msm/about"><i class="far fa-circle text-red f8"></i> Tentang</a>
				</li>
			</ul>
		</li>
		<li id="menu2" class="treeview">
			<a href="#">
				<i class="fas fa-chevron-right f10"></i> <span> Memorial</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li id="mom-school"><a href="<?=site_url();?>../../mom/school"><i class="far fa-circle text-red f8"></i> Profil Sekolah</a></li>
				<li id="mom-submenu"><a href="<?=site_url();?>../../mom/submenu"><i class="far fa-circle text-red f8"></i> Menu</a></li>
				<li id="mom-ensiklopedia"><a href="<?=site_url();?>../../mom/ensiklopedia"><i class="far fa-circle text-red f8"></i> Ensiklopedia</a></li>
				<li id="mom-alumni"><a href="<?=site_url();?>../../mom/alumni"><i class="far fa-circle text-red f8"></i> Alumni</a></li>
				<li id="mom-alumni-category"><a href="<?=site_url();?>../../mom/alumni/category"><i class="far fa-circle text-red f8"></i> Kategori Alumni</a></li>
				<li id="mom-alumni-detail"><a href="<?=site_url();?>../../mom/alumni/detail"><i class="far fa-circle text-red f8"></i> Detail Alumni</a></li>
				<li id="mom-about">
					<a href="<?=site_url();?>../../mom/about"><i class="far fa-circle text-red f8"></i> Tentang</a>
				</li>
			</ul>
		</li>
		<?php
			if ($this->session->userdata('id_level') == 1) {
				echo '
					<li id="link-user">
						<a href="'.site_url().'../../access">
							<i class="fas fa-chevron-right f10"></i> <span> Hak Akses</span>
						</a>
					</li>
				';
			} 
		?>
	</ul>
</section>