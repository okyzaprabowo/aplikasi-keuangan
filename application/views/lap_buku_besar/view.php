<script type="text/javascript">
$(document).ready(function(){
	$("#cari").click(function(){
		var e = 'cari';
		tampil_data(e);
		return false();
	});
	
	$("#cetak").click(function(){
		var e = 'cetak';
		tampil_data(e);
		//window.open('<?php echo site_url();?>/lap_surat_keputusan/cetak/'+tgl1+'/'+tgl2);
		return false();
	});
	
	function tampil_data(e){
		var th		= $("#th").val();
		var bln		= $("#bln").val();
		var no_rek 	= $("#no_rek").val();

		
		var string 	= "no_rek="+no_rek+"&th="+th+"&bln="+bln;
		var string2	= no_rek+"/"+th+"/"+bln;
		
		if(th.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf Tahun Tidak Boleh Kosong',
				timeout:2000,
				showType:'slide'
			});
			$("#th").focus();
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
		if(e=='cari'){
			$("#tampil_data").html('');
			$.ajax({
				type	: 'POST',
				url		: "<?php echo site_url(); ?>/lap_buku_besar/view_data",
				data	: string,
				cache	: false,
				success	: function(data){
					//$("#tampil_data").html(data);
					var win = $.messager.progress({
					title:'Please waiting',
					msg:'Loading data...'
					});
					setTimeout(function(){
						$.messager.progress('close');
						$("#tampil_data").html(data);
					},2800)
				}
			});
			return false();
		}else{
			window.open('<?php echo site_url();?>/lap_buku_besar/cetak_data/'+string2);
			return false();
		}
	}
	
});
</script>	
<div id="view">
    <div style="padding-bottom:5px;" align="center">
    Tahun : 
    <select name="th" id="th" class="kosong">
    <option value="">-PILIH-</option>
    <?php
    foreach($list_th->result_array() as $t){
    ?>
    <option value="<?php echo $t['th'];?>"><?php echo $t['th'];?></option>
    <?php } ?>
    </select>
    Bulan : 
    <select name="bln" id="bln" class="kosong">
    <option value="">-PILIH-</option>
    <?php
    foreach($list_bln->result_array() as $t){
        $bln = $this->app_model->getBulan($t['bln']);
    ?>
    <option value="<?php echo $t['bln'];?>"><?php echo $bln;?></option>
    <?php } ?>
    </select>
    No.Rek : 
    <select name="no_rek" id="no_rek" class="kosong">
    <option value="">-PILIH-</option>
    <?php
    foreach($list_rek->result_array() as $t){
    ?>
    <option value="<?php echo $t['no_rek'];?>"><?php echo $t['no_rek'];?> | <?php echo $t['nama_rek'];?></option>
    <?php } ?>
    </select>
    <button type="button" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
    <button type="button" name="cetak" id="cetak" class="easyui-linkbutton" data-options="iconCls:'icon-print'">Cetak</button>
    </div>
</div>
<div id="tampil_data"></div>