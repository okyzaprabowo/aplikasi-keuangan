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
	<th rowspan="2">No</th>
    <th rowspan="2">No Rek</th>
    <th rowspan="2">Nama Rek</th>
    <th colspan="2">Neraca</th>
</tr>
<tr>
    <th>Debet</th>
    <th>Kredit</th>
</tr>    
<?php
	if($data->num_rows()>0){
		$t_dr_ju = 0;
		$t_kr_ju = 0;
		$t_dr_ajp = 0;
		$t_kr_ajp = 0;
		$t_dr_nssp = 0;
		$t_kr_nssp = 0;
		$t_dr_lr = 0;
		$t_kr_lr = 0;
		$t_dr_n = 0;
		$t_kr_n = 0;
		$no =1;
		foreach($data->result_array() as $db){  
		$periode = $th-1;
		
		$ns = $this->app_model->neraca_saldo($db['no_rek'],$th);
		if($ns>0){
			$dr_ju = $ns;
			$kr_ju = 0;
		}else{
			$dr_ju = 0;
			$kr_ju = -1*$ns;
		}
		$dr_ajp = $this->app_model->dr_ajp($db['no_rek'],$th);
		$kr_ajp = $this->app_model->kr_ajp($db['no_rek'],$th);
		//nssp
		if(($dr_ju-$kr_ju)+($dr_ajp-$kr_ajp)>0){	
			$dr_nssp=($dr_ju-$kr_ju)+($dr_ajp-$kr_ajp);
		}else{
			$dr_nssp = 0;
		}
		if(($dr_ju-$kr_ju)+($dr_ajp-$kr_ajp)<0){		
			$kr_nssp=-1*(($dr_ju-$kr_ju)+($dr_ajp-$kr_ajp));
		}else{
			$kr_nssp = 0;
		}
		//rugi laba
		if(substr($db['no_rek'],0,1)>=4){
			$dr_lr = $dr_nssp;
			$kr_lr = $kr_nssp;
		}else{
			$dr_lr=0;
			$kr_lr=0;
		}
		//neraca
		if(substr($db['no_rek'],0,1)<4){
			//no akun ini harus di isi 3102 dengan prive pemilik modal, 
			//kalo ada perubahan di ganti ya...hehehehe nanti kita pikirkan lagi
			if($db['no_rek']=='3102'){
				$dr_n = 0;
				$kr_n = -1*($dr_nssp);
			}else{
				$dr_n = $dr_nssp;
				$kr_n = $kr_nssp;
			}
		}else{
			$dr_n=0;
			$kr_n=0;
		}
		//$fil =substr($db['no_rek'],1,1);
		if(substr($db['no_rek'],0,1)<'4'){
		?>    
    	<tr>
			<td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="80" ><?php echo $db['no_rek']; ?></td>
            <td ><?php echo $db['nama_rek']; ?></td>
            <td align="right" width="80"><?php echo number_format($dr_n); ?></td>
            <td align="right" width="80"><?php echo number_format($kr_n); ?></td>
    	</tr>
    <?php
		}
		$t_dr_ju = $t_dr_ju+$dr_ju;
		$t_kr_ju = $t_kr_ju+$kr_ju;
		$t_dr_ajp = $t_dr_ajp+$dr_ajp;
		$t_kr_ajp = $t_kr_ajp+$kr_ajp;
		$t_dr_nssp = $t_dr_nssp+$dr_nssp;
		$t_kr_nssp = $t_kr_nssp+$kr_nssp;
		$t_dr_lr = $t_dr_lr+$dr_lr;
		$t_kr_lr = $t_kr_lr+$kr_lr;
		$t_dr_n = $t_dr_n+$dr_n;
		$t_kr_n = $t_kr_n+$kr_n;
		$no++;
		}
	}else{
		$t_dr_ju = 0;
		$t_kr_ju = 0;
		$t_dr_ajp = 0;
		$t_kr_ajp = 0;
		$t_dr_nssp = 0;
		$t_kr_nssp = 0;
		$t_dr_lr = 0;
		$t_kr_lr = 0;
		$t_dr_n = 0;
		$t_kr_n = 0;
	?>
    	<tr>
        	<td colspan="4" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
<tr>
	<?php 
	$lr = ($t_kr_lr-$t_dr_lr);
	$s_dr_lr = $lr+$t_dr_lr;
	$s_kr_n = $lr+$t_kr_n;
	if($lr>0){
		$ket = 'LABA';
	}else{
		$ket = 'RUGI';
	}
	?>
    <td colspan="3" align="center" ><b><?php echo $ket;?></b></td>
	<td align="right"><b><?php echo number_format(0);?></b></td>
    <td align="right"><b><?php echo number_format($lr);?></b></td>
</tr>    
<tr>
	<td colspan="3" align="center">Saldo</td>
    <td align="right"><b><?php echo number_format($t_dr_n+0);?></b></td>
    <td align="right"><b><?php echo number_format($t_kr_n+$lr);?></b></td>
</tr>
</table>