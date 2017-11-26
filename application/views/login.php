<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $nama_program; ?></title>
<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/style_login.css" type="text/css" />
<link rel="icon" href="<?=base_url()?>asset/img/inti.ico" type="image/ico">
<link href="<?php echo base_url();?>asset/css/fonts/stylesheet.css" rel="stylesheet" type="text/css" />
<style type="text/css">
button {margin: 0; padding: 0;}
button {margin: 2px; position: relative; padding: 4px 4px 4px 2px; 
cursor: pointer; float: left;  list-style: none;}
button span.ui-icon {float: left; margin: 0 4px;}
</style>
</head>
<body>
<div class="blok_header">
    <div class="header">
      <div class="logo">
      <a href="<?php echo base_url();?>index.php/home">
      <img src="<?php echo base_url();?>asset/images/logo_koperasi_150.png" width="85" height="71" border="0" alt="logo" /></a>
      </div>
      <div class="judul">
      <h1><?php echo $instansi;?></h1>
      <p>Alamat : <?php echo $alamat_instansi;?></p>
      </div>
      <div class="clr"></div>
	</div>
    <div class="clr"></div>
    <div class="header_text_bg">
    	<div class="clr"></div>
        <div id="header">
        <h1><?php echo $nama_program; ?></h1>
        <h3>Halaman Administrator</h3>
        </div> 
	</div>       
</div>              
<?php echo form_open('login/index'); ?>
<fieldset>
    <legend>Login</legend>
    <table width="100%">
    <tr>
    	<td>Username</td>
        <td>:</td>
		<td><?php echo form_input($username,set_value('username')); ?></td>
	</tr>
    <tr>       
		<td>Password</td>
        <td>:</td>
		<td><?php echo form_input($password); ?></td>
	</tr>
    </table>        
</fieldset>
<fieldset class="tblFooters">
	<div id="error">
    <?php echo validation_errors(); ?>
	<?php echo $this->session->flashdata('result_login'); ?>
    </div>
	<?php echo form_button($submit,'Login');?>
</fieldset>

<?php echo form_close(); ?>

<div id="footer" align="center">
	<p>Copyright &copy; <?php echo $instansi;?> 2017</p>
	<p>Halaman ini dimuat selama <strong>{elapsed_time}</strong> detik</p>
</div>

</body>
</html>