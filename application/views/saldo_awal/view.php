<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});	
});
/*
function editData(id){
	var periode = $("#periode").val();
	var string 	= "id="+id+"&periode="+periode;

	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/saldo_awal/edit",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){			
				$("#periode").focus();
				
				$("#no_rek").val(id);
				$("#periode").val(periode);
				$("#nama_rek").val(data.nama_rek);
			}
	});
	return false();
}
*/
</script>
<div style="float:left; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>index.php/saldo_awal">
Periode : 
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
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
<a href="<?php echo base_url();?>index.php/saldo_awal/tambah">
<button type="button" name="tambah_data" id="tambah_data" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>
</a>
</form>
</div>
<div style="padding:10px;"></div>
<table id="dataTable" width="100%">
<tr>
	<th>No</th>
    <th>No Rekening</th>
    <th>Nama Rekening</th>
    <th>Debet</th>
    <th>Kredit</th>
    <th width="80">Aksi</th>
</tr>
<?php
	if($data->num_rows()>0){
		$t_dr=0;
		$t_kr=0;
		$no =1;
		foreach($data->result_array() as $db){  
		?>    
    	<tr>
			<td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="150" ><?php echo $db['no_rek']; ?>
            <input type="hidden" name="no_rek<?php echo $no;?>" id="no_rek<?php echo $no;?>" value="<?php echo $db['no_rek'];?>" />
            </td>
            <td ><?php echo $db['nama_rek']; ?></td>
            <td align="right" width="100">
			<?php echo number_format($db['debet']);?>
            </td>
            <td align="right" width="100">
            <?php echo number_format($db['kredit']);?>
            </td>
            <td align="center" width="80">
            <a href="<?php echo base_url();?>index.php/saldo_awal/edit/<?php echo $db['periode'];?>/<?php echo $db['no_rek'];?>">
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>index.php/saldo_awal/hapus/<?php echo $db['periode'];?>/<?php echo $db['no_rek'];?>"
            onClick="return confirm('Anda yakin ingin menghapus data ini?')">
			<img src="<?php echo base_url();?>asset/images/del.png" title='Hapus'>
			</a>
            </td>
    </tr>
    <?php
		$t_dr = $t_dr+$db['debet'];
		$t_kr = $t_kr+$db['kredit'];
		$no++;
		}
	}else{
		$t_dr=0;
		$t_kr=0;
	?>
    	<tr>
        	<td colspan="5" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
<tr>
	<td colspan="3" align="right">Total</td>
    <td align="right"><?php echo number_format($t_dr);?></td>
    <td align="right"><?php echo number_format($t_kr);?></td>
</tr>    
</table>
<input type="hidden" id="jml_data" value="<?php echo $no;?>" />