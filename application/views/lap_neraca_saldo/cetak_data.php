<style type="text/css">
*{
font-family: Arial;
margin:0px;
padding:0px;
}
@page {
 margin-left:3cm 2cm 2cm 2cm;
}
table.grid{
width:20.99cm ;
font-size: 9pt;
border-collapse:collapse;
}
table.grid th{
padding-top:1mm;
padding-bottom:1mm;
}
table.grid th{
background: #F0F0F0;
border-top: 0.2mm solid #000;
border-bottom: 0.2mm solid #000;
text-align:center;
padding-left:0.2cm;
border:1px solid #000;
}
table.grid tr td{
padding-top:0.5mm;
padding-bottom:0.5mm;
padding-left:2mm;
border-bottom:0.2mm solid #000;
border:1px solid #000;
}
h1{
font-size: 20pt;
}
h2{
font-size: 16pt;
}
h3{
font-size: 14pt;
}
.profil{
display: block;
width:20.99cm ;
font-size:10px;
margin:0px;
padding:0px;
}
.profil .koperasi{
font-size:14px;
font-weight:bold;
}
.header{
display: block;
width:20.99cm ;
margin-bottom: 0.3cm;
text-align: center;
}

</style>
<?php
$profil = '<h3>'.$instansi.'</h3>';
$profil .= $alamat_instansi;
$judul = "NERACA SALDO";
?>
<div class="profil"><?php echo $profil;?></div>
<div class="header"><h2><?php echo $judul;?></h2>
<p>Tanggal : <?php echo $this->app_model->tgl_indo(date('Y-m-d'));?> </p>
</div>
<table  class="grid" width="100%">
<tr>
	<th rowspan="2">No</th>
    <th rowspan="2">No Rek</th>
    <th rowspan="2">Nama Rek</th>
    <th colspan="2">Neraca Saldo</th>
</tr>
<tr>
    <th>Debet</th>
    <th>Kredit</th>
</tr>    
<?php
	if($data->num_rows()>0){
		$t_dr=0;
		$t_kr=0;
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
		?>    
    	<tr>
			<td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="80" ><?php echo $db['no_rek']; ?></td>
            <td ><?php echo $db['nama_rek']; ?></td>
            <td align="right" width="80"><?php echo number_format($dr_ju); ?></td>
            <td align="right" width="80"><?php echo number_format($kr_ju); ?></td>
    </tr>
    <?php
		$t_dr = $t_dr+$dr_ju;
		$t_kr = $t_kr+$kr_ju;
		$no++;
		}
	}else{
		$t_dr=0;
		$t_kr=0;
	?>
    	<tr>
        	<td colspan="9" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
<tr>
	<td colspan="3" align="center">Saldo</td>
    <td align="right"><?php echo number_format($t_dr);?></td>
    <td align="right"><?php echo number_format($t_kr);?></td>
</table>