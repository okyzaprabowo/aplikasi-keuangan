<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});	
	
	$("#no_rek").focus();
	
	$("#tgl").datepicker({
		dateFormat      : "dd-mm-yy",        
	  	showOn          : "button",
	  	buttonImage     : "<?php echo base_url();?>asset/images/calendar.gif",
	  	buttonImageOnly : true				
	});
	
	function kosong(){
		$("#rek_induk").val('0');
		$("#no_rek").val('');
		$("#nama_rek").val('');
		
	}
	$("#simpan").click(function(){
		var rek_induk	= $("#rek_induk").val();
		var no_rek 		= $("#no_rek").val();
		var nama_rek 	= $("#nama_rek").val();
		
		var string = "rek_induk="+rek_induk+"&no_rek="+no_rek+"&nama_rek="+nama_rek;
		
		if(no_rek.length==0){
			alert("Maaf, Nomor Rekening tidak boleh kosong");
			$("#no_rek").focus();
			return false;
		}
		if(nama_rek.length==0){
			alert("Maaf, Nama Rekening tidak boleh kosong");
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
			}
		});
		
	});
	
	$("#tambah_data").click(function(){
		kosong();
		$("#no_rek").focus();
		/*
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
		*/
	});
	
	$("#kembali").click(function(){
		window.location.assign('<?php echo base_url();?>index.php/rekening');
		return false();
	});
	
});
</script>
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
    <option value="<?php echo $t->level;?>"><?php echo $t->nama_rek;?></option>
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