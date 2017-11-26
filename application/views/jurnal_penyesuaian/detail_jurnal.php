<script type="text/javascript">
$(function() {
	$("#dataTable.detail tr:even").addClass("stripe1");
	$("#dataTable.detail tr:odd").addClass("stripe2");
	$("#dataTable.detail tr").hover(
		function() {
			$(this).toggleClass("highlight");
		},
		function() {
			$(this).toggleClass("highlight");
		}
	);
});
function hapusData(id){
	var no_jurnal = $("#no_jurnal").val();
	var string = "no_jurnal="+no_jurnal+"&no_rek="+id;
	
	var pilih = confirm('Data yang akan dihapus no rek = '+id+ '?');
	if (pilih==true) {
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/jurnal_penyesuaian/hapusDetail",
			data	: string,
			cache	: false,
			success	: function(data){
				$("#tampil_data").html(data);
			}
		});
	}
}
</script>

<table id="dataTable" class="detail" width="100%">
<tr>
	<th>No</th>
    <th>#Rek</th>
    <th>Nama Rek</th>
    <th>Debet</th>
    <th>Kredit</th>
    <th>Hapus</th>
</tr>
<?php 
if($data->num_rows() > 0){
	$no=1;
	foreach($data->result() as $t){
		$nama_rek = $this->app_model->CariNamaRek($t->no_rek);
?>
	<tr>
    	<td width="5" align="center"><?php echo $no;?></td>
        <td width="100" align="center"><?php echo $t->no_rek;?></td>
        <td ><?php echo $nama_rek;?></td>
        <td align="right"><?php echo number_format($t->debet);?></td>
        <td align="right"><?php echo number_format($t->kredit);?></td>
        <td align="center" width="80">
            <?php echo "<a href='javascript:hapusData(\"{$t->no_rek}\")'>";?>
			<img src="<?php echo base_url();?>asset/images/del.png" title='Hapus'>
			</a>
		</td>
	</tr>        
<?php	
		$no++;
	}
?>

<?php
}else{
?>
<tr>
	<td colspan="6" align="center">Tidak ada data</td>
</tr>
<?php 
}
?>
</table>    