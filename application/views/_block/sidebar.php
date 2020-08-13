<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <!-- <div class="sidebar-brand-icon rotate-n-15"> -->
    <div class="sidebar-brand-icon">
        <img src="<?= base_url()?>/publik/img/logo.png" alt="" srcset="" class="logo-pemda">
    </div>
    <div class="sidebar-brand-text mx-3">Simantap</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Heading -->
    <div class="sidebar-heading">
    Menu
    </div>
    
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
    <a class="nav-link" href="<?= site_url('/')?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="charts.html">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Pendaftran</span></a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-table"></i>
        <span>Pemeriksaan</span></a>
		</li>
		
    <li class="nav-item">
    <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-table"></i>
        <span>Penetapan</span></a>
		</li>
		
    <li class="nav-item">
    <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-table"></i>
        <span>Pembayaran</span></a>
		</li>
		
    <li class="nav-item">
    <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-table"></i>
        <span>Penyerahan</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
					<i class="fas fa-fw fa-cog"></i>
					<span>Setting</span>
			</a>
			<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
					<h6 class="collapse-header">Setting Menu</h6>
					<a class="collapse-item" href="#">Daftar Jenis Ijin</a>
					<a class="collapse-item" href="#">Daftar Pengguna</a>
					<a class="collapse-item" href="#">Daftar Grup</a>
					<a class="collapse-item" href="#">Daftar Otoritas</a>
					<a class="collapse-item" href="#">Daftar Menu</a>
					</div>
			</div>
		</li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>