<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});	
	
	$("#periode").focus();
	
	$("#debet").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		}
	});
	$("#kredit").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		}
	});	
	
	$("#no_rek").keyup(function(){
		var no_rek = $("#no_rek").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/CariNamaRek",
			data	: "no_rek="+no_rek,
			cache	: false,
			dataType: "json",
			success	: function(data){
				$("#nama_rek").val(data.nama_rek);
			}
		});
	});
	
	function kosong(){
		//$("#periode").val('');
		$("#no_rek").val('');
		$("#nama_rek").val('');
		$("#debet").val('');
		$("#kredit").val('');	
	}
	
	$("#simpan").click(function(){
		var periode		= $("#periode").val();
		var no_rek		= $("#no_rek").val();
		
		var string = $("#my-form").serialize();
		
		//alert(string);
		
		if(periode.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Perideo Tidak Boleh Kosong',
				timeout:2000,
				showType:'slide'
			});
			$("#periode").focus();
			return false();
		}
		if(no_rek.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Nomor Rekening Tidak Boleh Kosong',
				timeout:2000,
				showType:'slide'
			});
			$("#no_rek").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/saldo_awal/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				$.messager.show({
					title:'Info',
					msg:data,
					timeout:2000,
					showType:'slide'
				});
				return false();
			}
		});
		return false();
	});
	
	$("#tambah_data").click(function(){
		
				kosong();
				$("#no_rek").focus();
		
	});
	
	$("#kembali").click(function(){
		window.location.assign('<?php echo base_url();?>index.php/saldo_awal');
	});
	
});
</script>
<fieldset class="atas">
<form id="my-form">
<table width="100%">
<tr>
	<td width="10%">Periode</td>
    <td width="5">:</td>
    <td>
    <select name="periode" id="periode" class="combo">
	<?php
    if(empty($periode)){
    ?>
    <option value="">-PILIH-</option>
    <?php
    }
    $year_awal = date('Y')-1;
    $year_akhir = date('Y');
    for($i=$year_awal;$i<=$year_akhir;$i++){
        if($periode==$i){
    ?>
        <option value="<?php echo $i;?>" selected="selected"><?php echo $i;?></option>
    <?php }else{ ?>
        <option value="<?php echo $i;?>"><?php echo $i;?></option>   
    <?php }
    } ?>
    </select>
    </td>
</tr>
<tr>    
	<td>No Rek</td>
    <td>:</td>
    <td>
        
    <input list="list_rek" name="no_rek" id="no_rek" value="<?php echo $no_rek;?>">
    <datalist id="list_rek">
      <?php
        $list_rek = $this->app_model->getListRek();
        foreach($list_rek->result() as $row){
        ?>
        <option value="<?php echo $row->no_rek;?>">
        <?php } ?>
    </datalist>
    </td>
</tr>
<tr>    
	<td>Nama Rekening</td>
    <td>:</td>
    <td><input type="text" name="nama_rek" id="nama_rek"  size="50" maxlength="50" value="<?php echo $nama_rek;?>" readonly="readonly" /></td>
</tr>
<tr>    
	<td>Debet</td>
    <td>:</td>
    <td><input type="text" name="debet" id="debet"  size="20" maxlength="20" value="<?php echo $debet;?>" onkeyup="formatNumber(this);" onchange="formatNumber(this);"/></td>
</tr>
<tr>    
	<td>Kredit</td>
    <td>:</td>
    <td><input type="text" name="kredit" id="kredit"  size="20" maxlength="20" value="<?php echo $kredit;?>" onkeyup="formatNumber(this);" onchange="formatNumber(this);"/></td>
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
</form>
</fieldset>   