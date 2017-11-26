<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Selamat Datang di Sistem Akuntansi Standar</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="index, follow">
<meta http-equiv="Copyright" content="Deddy Rusdiansyah">
<meta name="author" content="Deddy Rusdiansyah">
<meta http-equiv="imagetoolbar" content="no">
<meta name="language" content="Indonesia">
<meta name="revisit-after" content="7">
<meta name="webcrawlers" content="all">
<meta name="rating" content="general">
<meta name="spiders" content="all">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/layout.css">
<link href="<?php echo base_url();?>asset/css/fonts/stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="<?=base_url()?>asset/img/inti.ico" type="image/ico">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/themes/cupertino/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/smoothness/jquery-ui-1.7.2.custom.css">

<script type="text/javascript" src="<?php echo base_url();?>asset/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/js/clock.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/js/app.js" ></script>

<!--datepicker-->
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/ui.core.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/ui.datepicker-id.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/ui.datepicker.js"></script>

<!--Polling-->
<script type="text/javascript" src="<?php echo base_url();?>asset/js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/js/exporting.js"></script>

<!-- notifikasi -->
<script type="text/javascript" src="<?php echo base_url();?>asset/js/notifikasi.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/js/jquery.cookie.js"></script>

    
<script type="text/javascript">
$(function() {
	$("#dataTable tr:even").addClass("stripe1");
	$("#dataTable tr:odd").addClass("stripe2");
	$("#dataTable tr").hover(
		function() {
			$(this).toggleClass("highlight");
		},
		function() {
			$(this).toggleClass("highlight");
		}
	);
});
</script>
    

</head>
<body onLoad="goforit()">
<div class="header" style="height:70px;background:white;padding:2px;margin:0;">
		<div style="float:left; padding:0px; margin:0px;">
        <img src='<?php echo base_url();?>asset/images/logo_koperasi_85.png' style="padding:0; margin:0;" width="85" height="71">
        </div>
        <div class="judul" style="float:left; line-height:3px; margin-top:0px; padding:2px 5px;">
        <h1><?php echo $instansi;?></h1>
      <p><b><?php echo $usaha;?></b></p>
      <p><?php echo $alamat_instansi;?></p>
      </div>
		<div style="float:right; line-height:3px; text-align:center;">
        <br /><br />
        <h1><?php echo $nama_program;?></h1>
        <p>.:: Jurnal Umum - Buku Besar - Laporan Laba Rugi ::.</p>
        </div>
	</div>

	<div class="panel-header" fit="true" style="height:21px;padding-top:1px;padding-right:20px">
		<div style="float:left;">
			<a href="<?php echo base_url();?>index.php/home" class="easyui-linkbutton" data-options="plain:true" iconCls="icon-home">Home</a>
            <a href="<?php echo base_url();?>index.php/login/logout" class="easyui-linkbutton" data-options="plain:true" iconCls="icon-logout">Logout</a>
		</div>
		<div style="float:right; padding-top:5px;">
			<?php echo $this->session->userdata('nama_lengkap');?> &rarr;
            <span id="clock"></span>
		</div>
	</div>
	<!-- awal kiri -->
    <?php echo $this->load->view('menu_kiri');?>
    
    <div id="tt" class="easyui-tabs" style="height:570px;">
        <div title="<?php echo $judul;?>" style="padding:10px">
		<?php echo $content;?>
        </div>
    </div>


<div class="panel-header" fit="true" style="height:20px;text-align:center;">
Copyright &copy; <?php echo $instansi;?> 2017.
</div>
</body>
</html>
