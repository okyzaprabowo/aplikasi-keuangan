<div id="form">
<?php
$info = $this->session->flashdata('info');
if(!empty($info)){
?>
    <p><?php echo $info;?></p>
<?php
}?>
<?php
$error = $this->session->flashdata('error');
if(!empty($error)){
?>
    <p><?php echo $error;?></p>
<?php
}?>
<form name="my-form" id="my-form" method="post" action="<?php echo site_url();?>/profile/simpan" enctype="multipart/form-data" autocomplete="off">
<fieldset class="atas">
<table width="100%">
<tr>
  <td width="10%">Username</td>
    <td width="5">:</td>
    <td><input type="text" name="username" id="username" size="30" maxlength="30" value="<?php echo $username;?>" readonly/></td>
</tr>
<tr>
  <td>Password</td>
    <td>:</td>
    <td><input type="password" name="pwd" id="pwd" size="30" maxlength="30" value=""    />*) Kosongkan jika tidak diubah</td>
</tr>
<tr>
  <td>Nama Lengkap</td>
    <td>:</td>
    <td><input type="text" name="nama" id="nama"  size="50" maxlength="50" value="<?php echo $nama;?>" /></td>
</tr>
<tr>
  <td>Foto</td>
    <td>:</td>
    <td><input type="file" name="foto" id="foto" /></td>
</tr>
</table>
</fieldset>
<fieldset class="bawah">
<table width="100%">
<tr>
  <td colspan="3" align="center">
    <button type="submit" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
</tr>
</table>
</fieldset>
</form>
</div>