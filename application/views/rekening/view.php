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
		$("#no_rek").focus();
		return false();
	});
	
	function kosong(){
		$("#rek_induk").val('');
		$("#no_rek").val('');
		$("#nama_rek").val('');
		return false();
	}
	$("#simpan").click(function(){
		var rek_induk	= $("#rek_induk").val();
		var no_rek 		= $("#no_rek").val();
		var nama_rek 	= $("#nama_rek").val();
		
		var string = "rek_induk="+rek_induk+"&no_rek="+no_rek+"&nama_rek="+nama_rek;
		
		if(no_rek.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, No Rek Tidak Boleh Kosong',
				timeout:2000,
				showType:'slide'
			});
			$("#no_rek").focus();
			return false;
		}
		if(nama_rek.length==0){
			//alert("Maaf, Nama Rekening tidak boleh kosong");
			$.messager.show({
				title:'Info',
				msg:'Maaf, Nama Rek Tidak Boleh Kosong',
				timeout:2000,
				showType:'slide'
			});
			$("#nama_rek").focus();
			return false;
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/rekening/simpan",
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
			url		: "<?php echo site_url(); ?>/rekening/tambah",
			cache	: false,
			success	: function(data){
				kosong();
				$("#no_rek").focus();
			}
		});
		return false();
	});
	
	$("#kembali").click(function(){
		window.location.assign('<?php echo base_url();?>index.php/rekening');
		return false();
	});
});

function editData(id){
	var string = "id="+id;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/rekening/edit",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){
				$("#view").hide();
				$("#form").show();
				
				$("#no_rek").focus();
				
				$("#no_rek").val(id);
				$("#rek_induk").val(data.level);
				$("#nama_rek").val(data.nama_rek);
				return false();
			}
	});
}
</script>
<div id="view">

    <div style="float:left; padding-bottom:5px;">
    <button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>
    
    <a href="<?php echo base_url();?>index.php/rekening">
    <button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
    </a>
    </div>
    <div style="float:right; padding-bottom:5px;">
    <form name="form" method="post" action="<?php echo base_url();?>index.php/rekening">
    Cari Perihal : <input type="text" name="txt_cari" id="txt_cari" size="50" />
    <button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
    </form>
    </div>

<div style="padding:10px;"></div>
<table id="dataTable" width="100%">
<tr>
	<th>No</th>
    <th>No Rekening</th>
    <th>Nama Rekening</th>
    <th>Aksi</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){  
		?>    
    	<tr>
			<td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="150" ><?php echo $db['no_rek']; ?></td>
            <td ><?php echo $db['nama_rek']; ?></td>
            <td align="center" width="80">
            <?php echo "<a href='javascript:editData(\"{$db['no_rek']}\")'>";?>
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>index.php/rekening/hapus/<?php echo $db['no_rek'];?>"
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
<fieldset class="atas">
<table width="100%">
<tr>
	<td width="10%">Rek Induk</td>
    <td width="5">:</td>
    <td>
    <select name="rek_induk" id="rek_induk" class="combo">
    <option value="0">-PILIH-</option>
    <?php
	foreach($list->result() as $t){
	?>
    <option value="<?php echo $t->no_rek;?>"><?php echo $t->nama_rek;?></option>
    <?php } ?>
    </select>
    </td>
</tr>
<tr>    
	<td>No Rek</td>
    <td>:</td>
    <td><input type="text" name="no_rek" id="no_rek" size="12" maxlength="12" /></td>
</tr>
<tr>    
	<td>Nama Rekening</td>
    <td>:</td>
    <td><input type="text" name="nama_rek" id="nama_rek"  size="50" maxlength="50" /></td>
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
</div>