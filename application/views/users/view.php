<script type="text/javascript">
$(document).ready(function(){
  $(':input:not([type="submit"])').each(function() {
    $(this).focus(function() {
      $(this).addClass('hilite');
    }).blur(function() {
      $(this).removeClass('hilite');});
  });


  $("#view").show();
  $("#form").hide();

    $("#tambah").click(function(){
      $("#view").hide();
      $("#form").show();
      $("#username").focus();
      return false();
    });

  function kosong(){
    $("#username").val('');
    $("#pwd").val('');
    $("#nama").val('');
    return false();
  }
  $("#simpan").click(function(){
    var username = $("#username").val();
    var nama = $("#nama").val();

    var string = $("#my-form").serialize();
    //alert(string);

    if(username.length==0){
      $.messager.show({
        title:'Info',
        msg:'Maaf, Username Tidak Boleh Kosong',
        timeout:2000,
        showType:'slide'
      });
      $("#username").focus();
      return false;
    }
    if(nama.length==0){
      $.messager.show({
        title:'Info',
        msg:'Maaf, Nama Lengkap Tidak Boleh Kosong',
        timeout:2000,
        showType:'slide'
      });
      $("#nama").focus();
      return false;
    }

    $.ajax({
      type	: 'POST',
      url		: "<?php echo site_url(); ?>/users/simpan",
      data	: string,
      cache	: false,
      success	: function(data){
        $.messager.show({
          title:'Info',
          msg:data,
          timeout:2000,
          showType:'slide'
        });
      },
      error : function(xhr, teksStatus, kesalahan) {
        $.messager.show({
          title:'Info',
          msg: 'Server tidak merespon :'+kesalahan,
          timeout:2000,
          showType:'slide'
        });
        return false();
      }
    });
    return false();
  });

  $("#tambah_data").click(function(){
    $.ajax({
      type	: 'POST',
      url		: "<?php echo site_url(); ?>/users/tambah",
      cache	: false,
      success	: function(data){
        kosong();
        $("#username").focus();
      }
    });
    return false();
  });

  $("#kembali").click(function(){
    window.location.assign('<?php echo base_url();?>index.php/users');
    return false();
  });
});

function editData(id){
  var string = "id="+id;
  $.ajax({
      type	: 'POST',
      url		: "<?php echo site_url(); ?>/users/edit",
      data	: string,
      cache	: true,
      dataType : "json",
      success	: function(data){
        $("#view").hide();
        $("#form").show();

        $("#username").focus();

        $("#username").val(id);
        $("#nama").val(data.nama);
        $("#level").val(data.level);
        return false();
      }
  });
}
</script>
<div id="view">

    <div style="float:left; padding-bottom:5px;">
    <button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>

    <a href="<?php echo base_url();?>index.php/users">
    <button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
    </a>
    </div>
    <div style="float:right; padding-bottom:5px;">
    <form name="form" method="post" action="<?php echo base_url();?>index.php/users">
    Cari Username/Nama Lengkap : <input type="text" name="txt_cari" id="txt_cari" size="50" />
    <button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
    </form>
    </div>

<div style="padding:10px;"></div>
<table id="dataTable" width="100%">
<tr>
  <th>No</th>
    <th>Username</th>
    <th>Nama Lengkap</th>
    <th>Level</th>
    <th>Aksi</th>
</tr>
<?php
  if($data->num_rows()>0){
    $no =1+$hal;
    foreach($data->result_array() as $db){
    ?>
      <tr>
      <td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="150" ><?php echo $db['username']; ?></td>
            <td ><?php echo $db['nama_lengkap']; ?></td>
            <td ><?php echo $db['level']; ?></td>
            <td align="center" width="80">
            <?php echo "<a href='javascript:editData(\"{$db['username']}\")'>";?>
      <img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
      </a>
            <a href="<?php echo base_url();?>index.php/users/hapus/<?php echo $db['username'];?>"
            onClick="return confirm('Anda yakin ingin menghapus data ini?')">
      <img src="<?php echo base_url();?>asset/images/del.png" title='Hapus'>
      </a>
            </td>
    </tr>
    <?php
    $no++;
    }
  }else{
  ?>
      <tr>
          <td colspan="6" align="center" >Tidak Ada Data</td>
        </tr>
    <?php
  }
?>
</table>
<?php echo "<table align='center'><tr><td>".$paginator."</td></tr></table>"; ?>

</div>
<div id="form">
<form name="my-form" id="my-form">
<fieldset class="atas">
<table width="100%">
<tr>
  <td width="10%">Username</td>
    <td width="5">:</td>
    <td><input type="text" name="username" id="username" size="30" maxlength="30" /></td>
</tr>
<tr>
  <td>Password</td>
    <td>:</td>
    <td><input type="password" name="pwd" id="pwd" size="30" maxlength="30" /></td>
</tr>
<tr>
  <td>Nama Lengkap</td>
    <td>:</td>
    <td><input type="text" name="nama" id="nama"  size="50" maxlength="50" /></td>
</tr>
<tr>
  <td>Nama Lengkap</td>
    <td>:</td>
    <td>
    <select name="level" id="level">
        <option value="">-Pilih</option>
        <option value="super admin">Super Admin</option>
        <option value="admin">Admin</option>
        <option value="user">User</option>
    </select>
    </td>
</tr>    
</table>
</fieldset>
<fieldset class="bawah">
<table width="100%">
<tr>
  <td colspan="3" align="center">
    <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
    <button type="button" name="tambah_data" id="tambah_data" class="easyui-linkbutton" data-options="iconCls:'icon-add'">TAMBAH</button>
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    </td>
</tr>
</table>
</fieldset>
</form>
</div>
