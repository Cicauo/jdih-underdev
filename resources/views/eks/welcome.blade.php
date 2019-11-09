<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ env('APP_NAME').' - '.env('INS_NAME') }}</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
	@include('eks.welcome_style')
</head>

<body>

    <!-- Tes Screen 
    <div class="tesScreen"></div>
    <!-- /Tes Screen -->

    <!-- Body primary-->
    <div class="container main-body">

        <!-- Header -->
        <div class="container header-bg" id="bg">
            <!-- Desktop -->
            <nav class="navbar navbar-expand-lg navbar-light nav-desktop">
                <ul class="ul-nostyle logo">
                    <li class="col-logo" id="logo1"></li>
                    <li class="col-logo" id="logo2"></li>
                </ul>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <!--
              <li class="nav-item active">
                <a class="nav-link" href="#" onclick="toggleVisibility('');">Beranda<span class="sr-only">(current)</span></a>
              </li>
              -->
                        <li class="nav-item">
                            <a class="nav-link" href="#Menu1" onclick="toggleVisibility('Menu1');">Tentang Kami</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Anotasi Putusan Pengadilan
                </a>
                            <div class="dropdown-menu menu-produk-hukum" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#Menu2" onclick="toggleVisibility('Menu2');">Produk 1</a>
                                <a class="dropdown-item" href="#Menu2" onclick="toggleVisibility('Menu2');">Produk 2</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Informasi
                </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#Menu4" onclick="toggleVisibility('Menu4');">Artikel</a>
                                <a class="dropdown-item" href="#Menu3" onclick="toggleVisibility('Menu3');">Buku</a>
                            </div>
                        </li>

                    </ul>
					<!-- 
                    <div>
                        <a href="{{ route('login') }}">
                            <button class="btn btn-outline-success login my-2 my-sm-0" type="submit" /*data-toggle="modal" data-target="#loginForm" */>Login</button>
                        </a>
                    </div>
					-->

            </nav>

            <!-- The Modal Login-->
            <div class="modal fade modal-login" id="loginForm">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <h2>Login</h2>
                            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                @csrf
                                <input class="form-control form-control" type="text" placeholder="Email">
                                <input class="form-control form-control" type="password" placeholder="Kata Sandi">
                                <button type="submit" class="btn btn-primary float-right" href="#section2">Masuk</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /The Modal Login-->

            <!-- Mobile -->
            <div id="menuMobile" class="navbar nav-mobile navbar-expand-sm bg-dark navbar-dark fixed-top" style="z-index: 1">
                <ul class="ul-nostyle" style="width: 100%">
                    <li style="float: left;width: 90%;">
                        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
						<img style="width: 35px;margin-top: -12px;" src="{{ asset('front/images/logo-garing-mob.png') }}" alt="">
						<span style="font-weight:500">JDIH</span>
                    </li>
                    <li class="float-right">
                        <button style=" margin-top: 4px; " type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            <i class="fas fa-search"></i>
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Menu SideBar -->
            <div id="mySidenav" class="sidenav nav-mobile">
                <div class="row nav-mobile-head">
                    <div class="col">
                        <a class="align-middle">
						  Menu
						</a>
                    </div>
                    <div class="col float-right">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    </div>
                </div>

                <a href="#Menu1" onclick="toggleVisibility('Menu1');closeNav()">Tentang Kami</a>
                <button class="dropdown-btn">Anotasi Putusan Pengadilan
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-container menu-produk-hukum-m">
                    <a href="#Menu2" onclick="toggleVisibility('Menu2');closeNav()">Produk 1</a>
                    <a href="#Menu2" onclick="toggleVisibility('Menu2');closeNav()">Produk 2</a>
                    <a href="#Menu2" onclick="toggleVisibility('Menu2');closeNav()">Something else here</a>
                </div>

                <button class="dropdown-btn">Informasi
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-container">
                    <a href="#Menu4" onclick="toggleVisibility('Menu3');closeNav()">Buku</a>
                    <a href="#Menu2" onclick="toggleVisibility('Menu4');closeNav()">Artikel</a>
                </div>

                <div class="btn-login-mobile">
                    <a href="{{ route('login') }}">
						<div class="btn btn-primary">Login</div>
					</a>
                </div>
            </div>

            <!-- The Modal FORM-->
            <div class="modal fade formobile" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Cari Dokumen</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form id="fSearch2">
                                <select name="id_peraturan" class="selectpicker form-control form-control-lg" data-dropup-auto="false">
                                    <option value="">Jenis Peraturan</option>
                                    @foreach($peraturan as $p)
									<option value="{{ $p->id }}">{{ $p->nama_peraturan }}</option>
									@endforeach
                                </select>
                                <!--  
								<select class="selectpicker form-control form-control-lg" data-dropup-auto="false">
                                    <option>Katalog</option>
                                    <option>1 Select</option>
                                    <option>2 select</option>
                                </select>
								-->
                                <input class="form-control form-control-lg" name="nomor_dokumen" type="text" placeholder="Nomor">
                                <input class="form-control form-control-lg" name="tahun_dokumen" type="text" placeholder="Tahun">
                                <input class="form-control form-control-lg" name="key" type="text" placeholder="Tentang">
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <a href="#Menu2" onclick="toggleVisibility('Menu22')" class="btn btn-primary" data-dismiss="modal" style="padding: 16px;">Cari</a>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Slider Flickity-->
            <div class="carousel" data-flickity='{ "autoPlay": true }'>
                <div class="carousel-cell slide1">
                    <h3>Selamat Datang</h3>
                    <p>Jaringan Dokumentasi dan Informasi Hukum</p>
                    <p>BLITAR KOTA</p>
                </div>
                <div class="carousel-cell slide2">
                    <h3>Info Terbaru 1</h3>
                    <p>Jaringan Dokumentasi dan Informasi Hukum</p>
                    <p>BLITAR KOTA</p>
                </div>
                <div class="carousel-cell slide3">
                    <h3>Info terbaru 2</h3>
                    <p>Jaringan Dokumentasi dan Informasi Hukum</p>
                    <p>BLITAR KOTA</p>
                </div>
            </div>
            </div>
            <!-- /Header -->

            <!-- Form Desktop -->
            <div class="form-desktop">
                <div class="container header" id="myHeader">
                    <form class="row" id="fSearch">
                        <h1 class="col-lg-12 col-xl-12 col-nopadding">Cari Dokumen</h1>
                        <!--<div class="col-lg-2 col-xl-2 item">
						 <select class="selectpicker" data-dropup-auto="false">
							<option>Please select</option>
							<option>Peraturan</option>
							<option>1 Select</option>
							<option>2 select</option>
						  </select>
					   </div>-->

                        <div class="col-lg-2 col-xl-2 item">
                            <select class="selectpicker form-control" name="id_peraturan" data-dropup-auto="false">
                                <option value="">Jenis Peraturan</option>
                                @foreach($peraturan as $p)
								<option value="{{ $p->id }}">{{ $p->nama_peraturan }}</option>
								@endforeach
                            </select>
                        </div>

                        <!--  
						<div class="col-lg-2 col-xl-2 item">
                            <select class="selectpicker form-control" name="id_katalog" data-dropup-auto="false">
                                <option value="">Katalog</option>
                                @foreach($katalog as $k)
								<option value="{{ $k->id }}">{{ $k->nama_katalog }}</option>
								@endforeach
                            </select>
                        </div>
						-->

                        <div class="row col-lg-4 col-xl-4 col-nopadding col-nomargin">
                            <div class="col-lg-6 col-xl-6 item">
                                <input class="form-control" type="text" name="nomor_dokumen" placeholder="Nomor">
                            </div>

                            <div class="col-lg-6 col-xl-6 item">
                                <input class="form-control" type="text" name="tahun_dokumen" placeholder="Tahun">
                            </div>
                        </div>

                        <div class="col-lg-4 col-xl-4 item">
                            <input class="form-control" type="text" name="key" placeholder="Tentang">
                        </div>

                        <div class="col-lg-2 col-xl-2 item">
                            <a href="#Menu2" onclick="toggleVisibility('Menu2');" class="btn btn-outline-success my-2 my-sm-0"> Cari </a>
                        </div>
                    </form>

                    <div class='scrolltop'>
                        <a href="#top" class='scroll icon'> <i class="fa fa-4x fa-angle-up"></i> </a>
                    </div>
                </div>
            </div>
            <!-- /Form Desktop -->

            <!-- Content Detail -->
            <!--For perfect scroll-->
            <div class="content-detail">
                <div class="container">

                    <div class="row">
                        <div class="content-secondary col-md-12">
                            <div class="content title">
                                <h2>BLITAR KOTAl</h2>
                                <p>Jaringan Dokumentasi dan Informasi Hukum</p>
                            </div>
							
                            <div class="content">
                                <div class="row">
                                    <div class="col item">
                                        <div class="col "><i class="fas fa-thumbs-up detail-item"></i></div>
                                        <div class="col ">
                                            <p>Memudahkan Anda mencari dan mendapatkan dokumen hukum yang ada 
                                            di <br/>BLITAR KOTA</p>
                                        </div>
                                    </div>

                                    <!--  
									<div class="col item">
                                        <div class="col"><i class="fas fa-scroll detail-item"></i></div>
                                        <div class="col">
                                            <p></p>
                                        </div>
                                    </div>
									-->

                                    <div class="col item">
                                        <div class="col"><i class="fas fa-balance-scale detail-item"></i></div>
                                        <div class="col">
                                            <p>Dokumen yang Anda dapatkan adalah dokumen yang ada di <br>Blitar Kota</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="modal fade abstract" id="modal-anotasi">
						<div class="modal-dialog modal-xl">
							<div class="modal-content">

								<div class="modal-header">
									<h4 class="modal-title"></h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<div class="modal-body row">
									
								</div>

								<div class="modal-footer">
									<span class="btn-donlot"></span>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
								</div>

							</div>
						</div>
					</div>

                    <!-- Content: document results, tentang kami, informasi, siaran pers, penumuman, berita, artikel -->
                    <div class="container content-link" id="Menu1">
                        <div class="row">
                            <!--++++ Tentang Kami ++++-->

                            <div class="content-primary" style="width:100%;">
                                <div class="content title">
                                    <h2>Tentang Kami</h2>
                                </div>

                                <div class="content cms_tentang_kami">
                                    <center>
                                        <p>Badan Pertanahan Nasional (BPN) adalah Lembaga Pemerintah Non Kementrian yang berada di bawah dan bertanggung jawab kepada Presiden dan dipimpin oleh Kepala. (Sesuai dengan Perpres No. 63 Tahun 2013)Badan Pertanahan Nasional mempunyai tugas melaksanakan tugas pemerintahan di bidang pertanahan secara nasional, regional dan sektoral sesuai dengan ketentuan peraturan perundang-undangan.</p>
                                    </center>

                                    <h3>Visi</h3>
                                    <p>Menjadi lembaga yang mampu mewujudkan tanah dan pertanahan untuk sebesar-besar kemakmuran rakyat, serta keadilan dan keberlanjutan sistem kemasyarakatan, kebangsaan dan kenegaraan Republik Indonesia.</p>

                                    <h3>Misi</h3>
                                    <p>Mengembangkan dan menyelenggarakan politik dan kebijakan pertanahan untuk:</p>
                                    <ul>
                                        <li>Peningkatan kesejahteraan rakyat, penciptaan sumber-sumber baru kemakmuran rakyat, pengurangan kemiskinan dan kesenjangan pendapatan, serta pemantapan ketahanan pangan.</li>
                                        <li>peningkatan tatanan kehidupan bersama yang lebih berkeadilan dan bermartabat dalam kaitannya dengan penguasaan, pemilikan, penggunaan dan pemanfaatan tanah (P4T).</li>
                                        <li>Perwujudan tatanan kehidupan bersama yang harmonis dengan mengatasi berbagai sengketa, konflik dan perkara pertanahan di seluruh tanah air dan penataan perangkat hukum dan sistem pengelolaan pertanahan sehingga tidak melahirkan sengketa, konflik dan perkara di kemudian hari.</li>
                                        <li>Keberlanjutan sistem kemasyarakatan, kebangsaan dan kenegaraan Indonesia dengan memberikan akses seluas-luasnya pada generasi yang akan datang terhadap tanah sebagai sumber kesejahteraan masyarakat. </li>
                                        <li>Menguatkan lembaga pertanahan sesuai dengan jiwa, semangat, prinsip dan aturan yang tertuang dalam UUPA dan aspirasi rakyat secara luas.</li>
                                    </ul>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="container content-link" id="Menu2" style="display: none;">
                        <div class="row">
                            <!--++++ List: document result ++++-->

                            <div class="/*content-primary*/" style="width:100%; padding:56px 32px">
                                <div class="content title" style="text-align:center;">
                                    <h2>Hasil Pencarian</h2>
                                </div>

                                <div class="content" style=" background-color: #f1f1f1; border: solid 1px #dee2e6; ">
									<div style="padding:10px 0px" id="countSearchRsl"></div>
                                    <div id="search-result"> </div>
                                    <div id="banner-ku">
										
										<div class="banner-item">
											<a href="" target="_blank">
												<img src="{{ asset('uploads/cms/banner/ban1.png') }}" alt="">
											</a>
										</div>
										<div class="banner-item">
											<a href="" target="_blank">
												<img src="{{ asset('uploads/cms/banner/ban2.png') }}" alt="">
											</a>
										</div>
										
									</div>
									<div class="clearfix"></div>
                                    <ul class="pagination pagi-doc justify-content-center">
                                        <!--
										<li class="page-item"><a class="page-link" href="javascript:void(0);">Sebelumnya</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:void(0);">Selanjutnya</a></li>
										-->
                                    </ul>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="container content-link" id="Menu33" style="display: none;">
                        <div class="row">
                            <!--++++ Detail: siaran pers, penumuman, berita, artikel ++++-->

                            <div class="content-primary">
                                <div class="content title">
                                    <h2>Artikel</h2>

                                    <h3>Title Content</h3>
                                    <p> Kamis, 03 September 2015</p>
                                </div>

                                <div class="content content-img">
                                    <img src="{{ asset('front/images/ex_img.jpg') }}" class="img-fluid" width="400px;">
                                </div>

                                <div class="content">
                                    <p>1Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                                    <p>2Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                                    <p>3Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                                    <p>4Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                                    <p>5Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                                    <p>6Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="container content-link" id="Menu4" style="display: none;">
                        <div class="row">
                            <!--++++ List: Siaran pers, penumuman, berita, artikel with modal detail++++-->

                            <div class="content-primary w100">
                                <div class="content title">
                                    <h2>Artikel</h2>
                                </div>

                                <div class="content">
                                    <div class="title-info">
                                        <p><b class="tot-art">0</b> Artikel</p>
                                    </div>
									
									<div id="artikel-result"></div>

                                    <ul class="pagination pagi-art justify-content-center">
                                        
                                    </ul>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="container content-link" id="Menu3" style="display: none;">
                        <div class="row">
                            <!--++++ List: Siaran pers, penumuman, berita, artikel with modal detail++++-->

                            <div class="content-primary w100">
                                <div class="content title">
                                    <h2>Buku</h2>
                                </div>

                                <div class="content">
                                    <div class="title-info">
                                        <p><b class="tot-buku">0</b> Buku</p>
                                    </div>
									
									<div id="buku-result"></div>

                                    <ul class="pagination pagi-buku justify-content-center">
                                        
                                    </ul>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <!-- /Content Detail -->

            <div class="container content-item" style="padding-top: 48px;">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="content title">
                        <h5>Maklumat Pelayanan Informasi</h5>
                    </div>

                    <div class="content">
                        <p>Dengan ini kami berupaya memberikan Pelayanan Pengelola Informasi dan Dokumentasi yang berkaitan dengan BLITAR KOTA dengan Santun, Responsif, sesuai dengan Undang - Undang Republik Indonesia Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik.</p>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Body primary-->

        <footer class="container">
            <div class="row">
                <!--  <div class="line-footer"></div>  -->
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <h3>Alamat Kami</h3>
                    <p class="cms_alamat"> ----------------- </p>
					<div class="counter"></div>
				</div>

                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 align-footer">
                    <h3>Hubungi Kami</h3>
                    <ul>
                        <li><h6><a style="color:#fff;" href="tel:021-7228901">081-456120185</a></h6></li>
                        <li><h6><a style="color:#fff;" href="mailto:humas@atrbpn.go.id">admin@blitarkota.go.id</a></h6></li>
                    </ul>
                </div>
            </div>
        </footer>

        <!-- Optional JavaScript -->
        <script src="{{ asset('front/js/bootstrap.js') }}"></script>
		
		<!-- 
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        -->
        <script type="text/javascript" src="{{ asset('limitless/js/core/libraries/jquery.min.js') }}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		
		@include('eks.welcome_script')
		
        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "100%";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("main").style.marginLeft = "0";
            }
        </script>

        <script>
            /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
            var dropdown = document.getElementsByClassName("dropdown-btn");
            var i;

            for (i = 0; i < dropdown.length; i++) {
                dropdown[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                    } else {
                        dropdownContent.style.display = "block";
                    }
                });
            }
        </script>

        <script>
            window.onscroll = function() {
                myFunction()
            };

            var header = document.getElementById("myHeader");
            var sticky = header.offsetTop;

            function myFunction() {
                if (window.pageYOffset > sticky) {
                    header.classList.add("sticky");
                } else {
                    header.classList.remove("sticky");
                }
            }
        </script>

        <!--
    <script>
      window.onscroll = function() {myMenu()};

      var menu = document.getElementById("menuMobile");
      var sticky = header.offsetTop;

      function myMenu() {
        if (window.pageYOffset > sticky) {
          menu.classList.add("sticky");
        } else {
          menu.classList.remove("sticky");
        }
      }
    </script>

  <script>
  // When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
      document.getElementById("navbarCC").style.padding = "30px 10px";
      document.getElementById("logo").style.fontSize = "25px";
    } else {
      document.getElementById("navbarCC").style.padding = "80px 10px";
      document.getElementById("logo").style.fontSize = "35px";
    }
  }
  </script>
-->

        <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

        <!-- (Optional) Latest compiled and minified JavaScript translation files 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script>
		-->
        <script type="text/javascript">
            var divs = ["Menu1", "Menu2", "Menu3", "Menu4"];
            var visibleDivId = null;

            function toggleVisibility(divId) {
				
				if(divId=='Menu2'){
					search();
				}else if(divId=='Menu22'){
					divId='Menu2';
					search2()
				}else if(divId=='Menu4'){
					load_artikel()
				}else if(divId=='Menu3'){
					load_buku()
				}
				
                if (visibleDivId === divId) {
                    //visibleDivId = null;
                } else {
                    visibleDivId = divId;
                }
                hideNonVisibleDivs();
            }

            function hideNonVisibleDivs() {
                var i, divId, div;
                for (i = 0; i < divs.length; i++) {
                    divId = divs[i];
                    div = document.getElementById(divId);
                    if (visibleDivId === divId) {
                        div.style.display = "block";
                    } else {
                        div.style.display = "none";
                    }
                }
            }
        </script>
        <!--
		<script>
		  $(window).scroll(function() {
			if ($(this).scrollTop() > 50 ) {
				$('.scrolltop:hidden').stop(true, true).fadeIn();
			} else {
				$('.scrolltop').stop(true, true).fadeOut();
			}
		});
		$(function(){$(".scroll").click(function(){$("html,body").animate({scrollTop:$(".thetop").offset().top},"1000");return false})})
		</script>
		-->

</body>

</html>