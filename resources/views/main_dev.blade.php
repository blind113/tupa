<!DOCTYPE html>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="IE=edge;"/>
<!-- Title -->
<title>@yield('title')</title>
<meta charset="UTF-8">
<meta name="description" content="Admin Dashboard Template" />
<meta name="keywords" content="admin,dashboard" />
<meta name="author" content="Steelcoders" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Styles -->
<link href="{{ asset('assets/plugins/pace-master/themes/blue/pace-theme-flash.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/uniform/css/uniform.default.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/select2/css/select2.css') }}" rel="stylesheet" type="text/css"/>    
<link href="{{ asset('assets/plugins/fontawesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css"/>
<!-- <link href="{{ asset('assets/plugins/line-icons/simple-line-icons.css') }}" rel="stylesheet" type="text/css"/>	-->
<!--<link href="{{ asset('assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css') }}" rel="stylesheet" type="text/css"/>-->
<link href="{{ asset('assets/plugins/waves/waves.min.css') }}" rel="stylesheet" type="text/css"/>	
<!-- <link href="{{ asset('assets/plugins/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css"/>-->
<link href="{{ asset('assets/plugins/3d-bold-navigation/css/style.css') }}" rel="stylesheet" type="text/css"/> 
<link href="{{ asset('assets/plugins/slidepushmenus/css/component.css') }}" rel="stylesheet" type="text/css"/>	
<!--<link href="{{ asset('assets/plugins/weather-icons-master/css/weather-icons.min.css') }}" rel="stylesheet" type="text/css"/> -->	
<link href="{{ asset('assets/plugins/metrojs/MetroJs.min.css') }}" rel="stylesheet" type="text/css"/>	
<link href="{{ asset('assets/plugins/datatables/css/jquery.datatables.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/datatables/css/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/datatables/buttons/css/buttons.bootstrap.css') }}" rel="stylesheet" type="text/css"/>	
<!-- Theme Styles -->
<link href="{{ asset('assets/css/modern_caixa.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/themes/caixa.css') }}" class="theme-color" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css"/>
<!-- <script src="{{ asset('assets/plugins/3d-bold-navigation/js/modernizr.js') }}"></script> -->
<script src="{{ asset('assets/plugins/offcanvasmenueffects/js/snap.svg-min.js') }}"></script>
<!-- Javascripts -->
<script src="{{ asset('assets/plugins/jquery/jquery-2.1.3.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pace-master/pace.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-blockui/jquery.blockui.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!--<script src="{{ asset('assets/plugins/switchery/switchery.min.js') }}"></script>-->
<!--<script src="{{ asset('assets/plugins/uniform/jquery.uniform.min.js') }}"></script>-->
<script src="{{ asset('assets/plugins/offcanvasmenueffects/js/classie.js') }}"></script>
<script src="{{ asset('assets/plugins/offcanvasmenueffects/js/main.js') }}"></script>
<script src="{{ asset('assets/plugins/waves/waves.min.js') }}"></script>
<!--<script src="{{ asset('assets/plugins/3d-bold-navigation/js/main.js') }}"></script>-->
<!--<script src="{{ asset('assets/plugins/waypoints/jquery.waypoints.min.js') }}"></script> -->
<!-- <script src="{{ asset('assets/plugins/jquery-counterup/jquery.counterup.min.js') }}"></script> -->
<!-- <script src="{{ asset('assets/plugins/flot/jquery.flot.min.js') }}"></script> -->
<!--
Scripts que podem ser utilizados no dashboard
<script src="{{ asset('assets/plugins/flot/jquery.flot.time.min.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.symbol.min.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.resize.min.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>   
-->     
<!-- <script src="{{ asset('assets/plugins/curvedlines/curvedLines.js') }}"></script> -->
<!-- <script src="{{ asset('assets/plugins/metrojs/MetroJs.min.js') }}"></script> -->
<!-- script para o dashboard -->
<script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
<script src="{{ asset('assets/plugins/chartsjs/Chart.min.js') }}"></script>
<!--<script src="{{ asset('assets/plugins/chartsjs/chartjs-plugin-labels.js') }}"></script>-->
<!-- fim dos scripts para o dashboard -->
<script src="{{ asset('assets/js/modern.js') }}"></script>
<script>var varToken = "{{ csrf_token() }}";</script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<!--<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>-->
<script src="{{ asset('assets/js/pages/caixa.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables/js/jquery.datatables.js') }}"></script>
<!-- <script src="{{ asset('/assets/plugins/datatables/buttons/js/buttons.dataTables.js') }}"></script> -->
<script src="{{ asset('/assets/plugins/datatables/buttons/js/dataTables.buttons.js') }}"></script> 
<script src="{{ asset('/assets/plugins/datatables/buttons/js/buttons.bootstrap4.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables/buttons/js/buttons.html5.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables/buttons/js/buttons.flash.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables/buttons/js/buttons.print.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables/buttons/js/buttons.colVis.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables/buttons/js/dataTables.tableTools.js') }}"></script>
<script src="{{ asset('assets/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js') }}"></script>
<!-- <script src="{{ asset('/assets/plugins/datatables/buttons/js/dataTables.min.js') }}"></script> -->
<script src="{{ asset('/assets/plugins/excellentexport/excellentexport.js') }}"></script>
<script src="{{ asset('/assets/js/falacomigo/listarSolicitacoesPlansul.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<noscript>
erro!
</noscript>


<body class="page-header-fixed page-sidebar-fixed compact-menu">
<input type="hidden" id="classe_menu" name="classe_menu"/>
<div class="overlay"></div>
<!-- sidebar de informativos -->
<main class="page-content content-wrap">
<div class="navbar">
<div class="navbar-inner"> 
<div class="logo-box">
<a href="{{ url('/') }}" class="logo-text">
<span>
<img src="{{ asset('assets/images/logo_branca.png') }}" alt="" width=" ">
</span>
</a>
</div><!-- Logo Box -->
<div class="search-button">
<a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a>
</div>

<div class="topmenu-outer">
<div class="top-menu">
<ul class="nav navbar-nav navbar-left">   
<li>        
<div style="color: #fff; font-weight: 300; font-size: 20px; padding-top: 15px;">PLANSUL - CURITIBA</div>
</li>                                

</ul>
<ul class="nav navbar-nav navbar-right">
<!-- necessário implementar a busca
<li>	
<a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a>
</li>
-->      
<li>
<a href="#" id="sair" class="waves-effect waves-button waves-classic">
<i class="glyphicon glyphicon-user"><span style="font-size: 18px; font-family: arial"> SAIR</span></i>
</a>
</li>     
</ul><!-- Nav -->
</div><!-- Top Menu -->
</div>
</div>
</div><!-- Navbar -->

<div class="page-sidebar sidebar">
  <div class="page-sidebar-inner slimscroll">
    <div class="sidebar-header">
      <div class="sidebar-profile">
        <div class="sidebar-profile-details">
          <span style=" font-size: 14px;">
            <?php //echo $empregado ?><br><small><?php //echo $empregados->funcoes ?></small>
          </span>
        </div>
      </div>
    </div>
    <ul class="menu accordion-menu">
      <li>
        <a href="{{ url('/ocorrencias/') }}" class="waves-effect waves-button;">
          <span class="menu-icon glyphicon glyphicon-home"></span>
          <p>Home</p>
        </a>
      </li>
	  <?php
	  $id_usuario = session('id_usuario');
	  		$supervisores = [
				'P523625'
				,'P587239'
				,'P536004'
				,'P523625'
				,'P548524'
			];
			if(in_array(strtoupper($id_usuario), $supervisores)):
			?>
			<li>
				<a href="{{ url('/ocorrencias/escalada') }}" class="waves-effect waves-button;">
				  <span class="menu-icon glyphicon glyphicon-hand-up"></span>
				  <p>Escaladas</p>
				</a>
	  	  <li>
        <a href='/ocorrencias/faq/criar' class="waves-effect waves-button;">
          <span class="menu-icon glyphicon glyphicon-certificate"></span>
          <p>Cria FAQ</p>
        </a>
      </li>
	  <li>
        <a href='/ocorrencias/exportar/respostas' class="waves-effect waves-button;">
          <span class="menu-icon glyphicon glyphicon-download"></span>
          <p>Exportar</p>
        </a>
      </li>
			<?php
		endif;
		if(!is_null(session('id_usuario'))):
		?>

			</li>
				  <li>
        <a href='/ocorrencias/editar' class="waves-effect waves-button;">
          <span class="menu-icon glyphicon glyphicon-edit"></span>
          <p>Editar Resposta</p>
        </a>
      </li>
	  	  <li>
        <a target="_blank" href='/pdf.pdf' class="waves-effect waves-button;">
          <span class="menu-icon glyphicon glyphicon-file"></span>
          <p>URA Cidadão</p>
        </a>
      </li>
	  <li>
        <a target="_blank" href='/pdf/ocorrencias/URA_COMERCIAL.pdf' class="waves-effect waves-button;">
          <span class="menu-icon glyphicon glyphicon-file"></span>
          <p>URA COMERCIAL</p>
        </a>
      </li>
	  <li>
        <a target="_blank" href='/pdf/ocorrencias/URA_NEGOCIAL.pdf' class="waves-effect waves-button;">
          <span class="menu-icon glyphicon glyphicon-file"></span>
          <p>URA NEGOCIAL</p>
        </a>
      </li>
	  <li>
        <a target="_blank" href='/pdf/ocorrencias/URA_STE.pdf' class="waves-effect waves-button;">
          <span class="menu-icon glyphicon glyphicon-file"></span>
          <p>URA STE</p>
        </a>
      </li>
  <li>
        <a target="_blank" href='/pdf/ocorrencias/URA_SAC-CAIXA.pdf' class="waves-effect waves-button;">
          <span class="menu-icon glyphicon glyphicon-file"></span>
          <p>URA SAC-CAIXA</p>
        </a>
      </li>
	  <?php
	  endif;
	  ?>
    </ul>
  </div><!-- Page Sidebar Inner -->
</div><!-- Page Sidebar -->
<div class="page-inner">
<div class="page-title">
<h3>@yield('title2')</h3>
<!--<div class="page-breadcrumb">
<ol class="breadcrumb">
<?php // if($path=='/'):?> 
<li style="font-size: 13px; color: #90999c;">Home</li>
<?php //else:?>
<li><a href="{{ url()->previous() }}">Voltar</a></li>
<?php //endif; ?>

<li class="active">@yield('action')</li>              
</ol>
</div>-->
</div>
<div id="main-wrapper">
<div class="row" style = "margin-left: 10px;">

@yield('content')

</div>
</div><!-- Main Wrapper -->
<div class="page-footer">
<p class="no-s"><?php echo date('Y'); ?> &copy; Caixa Econômica Federal</p>
</div>
</div><!-- Page Inner -->
</main><!-- Page Content -->
<!--MODAL DE EXIBICAO DE CHECKLIST-->
<div class="modal fade" id="modalChecklist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" data-keyboard="false" aria-hidden="true">
<div class="modal-dialog modal-lg" style="width:30%;border:none;">
<div class="modal-content" >
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel2">CHECKLIST DIÁRIO DA PA</h4>
</div>
<div class="modal-body">
<form action="javascript:void(0);" id="formChecklist" >
@csrf
<strong style="center">Informe o número da sua PA e assinale os itens que estão operacionais. Caso um ou mais itens não estejam, deixe o(s) campo(s) em branco.</strong>
<br><br>
<div class="form-group">
<strong>PA:</strong>
<input type="number" name="pa" min="2000" max="4000" id="id_PA" required>
</div>
<div class="form-group">
<label for="teclado" style="font-size:15px">
<strong>TECLADO:</strong>
<br>
<input type="checkbox" id="teclado" name="teclado" value="ok"> OK
</label>
</div>
<div class="form-group">
<label for="mouse" style="font-size:15px">
<strong>MOUSE:</strong>
<br>
<input type="checkbox" id="mouse" name="mouse" value="ok"> OK
</label>
</div>
<div class="form-group">
<label for="cabo" style="font-size:15px">
<strong>CABO QD:</strong>
<br>
<input type="checkbox" id="cabo" name="cabo" value="ok"> OK
</label>
</div>
<div class="form-group">
<label for="mobilia" style="font-size:15px">
<strong>MOBÍLIA (MESA E CADEIRA):</strong>
<br>
<input type="checkbox" id="mobilia" name="mobilia" value="ok"> OK
</label>
</div>
<small><p>Obs.: Caso algum item não esteja funcional, informe ao seu supervisor.</p></small>
<br>
<button type="submit" class="btn btn-primary btn-block">Salvar</button>
</form>
</div>
</div>
</div>
</div>
</body>
<script>
	$('#sair').click(function(e){
		e.preventDefault();
		$.ajax({
			url: '/ocorrencias/api/logout',
			data:{
				id_usuario: '<?= session('id_usuario') ?>',
				"_token": "{{ csrf_token() }}" 
			},
			method:'post',
			success:function(result){
				console.log('Sucesso');
				location.reload();
			},error:function(result) {
				alert("Ocorreu um erro no sistema! Informe o Aministrador!");
			}        
		});
	});
</script>
</html>


