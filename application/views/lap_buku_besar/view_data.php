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
<table id="dataTable" width="100%">
<tr>
	<th>No</th>
    <th>No Jurnal</th>
    <th>Tanggal</th>
    <th>No Bukti</th>
    <th>Keterangan</th>
    <th>No Rek</th>
    <th>Nama Rek</th>
    <th>Debet</th>
    <th>Kredit</th>
    <th>Saldo</th>
</tr>
<?php
	if($data->num_rows()>0){
		$periode = date('Y')-1;
		$saldo = 0;
		$dr_sa = $this->app_model->dr_sa($no_rek,$periode);
		$kr_sa = $this->app_model->kr_sa($no_rek,$periode);
		$saldo = $dr_sa-$kr_sa;
		?>
        <tr>
            <td colspan="7" align="center"><b>Saldo Awal Tahun <?php echo $periode;?></b></td>            
            <td align="right" width="100" ><?php echo number_format($dr_sa); ?></td>
            <td align="right" width="100" ><?php echo number_format($kr_sa); ?></td>
            <td align="right" width="100" ><?php echo number_format($saldo); ?></td>
    	</tr>
        <?php
		$jml_dr=0;
		$jml_kr=0;
		$no =1;
		foreach($data->result_array() as $db){  
		$tgl = $this->app_model->tgl_indo($db['tgl_jurnal']);
		$nama_rek = $this->app_model->CariNamaRek($db['no_rek']);
		$saldo = $saldo+$db['debet']-$db['kredit'];
		?>    
    	<tr>
            <td align="center" width="20" ><?php echo $no; ?></td>
            <td align="center" width="100" ><?php echo $db['no_jurnal']; ?></td>
            <td align="center" width="100"><?php echo $tgl; ?></td>
            <td align="center" width="80" ><?php echo $db['no_bukti']; ?></td>
            <td ><?php echo $db['ket']; ?></td>
            <td align="center" width="80" ><?php echo $db['no_rek']; ?></td>
            <td width="150"><?php echo $nama_rek; ?></td>            
            <td align="right" width="80" ><?php echo number_format($db['debet']); ?></td>
            <td align="right" width="80" ><?php echo number_format($db['kredit']); ?></td>
            <td align="right" width="80" ><?php echo number_format($saldo); ?></td>
    </tr>
    <?php
		$jml_dr = $jml_dr+$db['debet'];
		$jml_kr = $jml_kr+$db['kredit'];
		$no++;
		}
	}else{
		$jml_dr=0;
		$jml_kr=0;
	?>
    	<tr>
        	<td colspan="9" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
</table>