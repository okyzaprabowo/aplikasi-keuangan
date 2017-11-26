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
width:31.4cm ;
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
width:31.4cm ;
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
width:31.4cm ;
margin-bottom: 0.3cm;
text-align: center;
}
.attr{
font-size:9pt;
width: 100%;
padding-top:2pt;
padding-bottom:2pt;
border-top: 0.2mm solid #000;
border-bottom: 0.2mm solid #000;
}
.pagebreak {
width:31.4cm ;
page-break-after: always;
margin-bottom:10px;
}
.akhir {
width:31.4cm ;
font-size:13px;
}
.page {
width:31.4cm ;
font-size:12px;
}

</style>
<?php
$profil = '<h3>'.$instansi.'</h3>';
$profil .= $alamat_instansi;
$judul = "BUKU BESAR<br>";
$judul .= $no_rek;
$saldo = 0;
function myheader($profil,$judul,$no_rek,$periode,$dr_sa,$kr_sa,$saldo){
?>
<div class="profil"><?php echo $profil;?></div>
<div class="header"><h2><?php echo $judul;?></h2></div>
<table class="grid">
<tr>
	<th>No</th>
    <th>Tanggal</th>
    <th>No.Bukti</th>
    <th>Keterangan</th>
    <th>No.Rek</th>
    <th>Nama Rek</th>
    <th>Debet</th>
    <th>Kredit</th>
    <th>Saldo</th>
</tr>    
<?php
$saldo = $dr_sa-$kr_sa;
?>
<tr>
	<td colspan="6" align="center"><b>Saldo Awal Tahun <?php echo $periode;?></b></td>            
	<td align="right" width="100" ><?php echo number_format($dr_sa); ?></td>
	<td align="right" width="100" ><?php echo number_format($kr_sa); ?></td>
	<td align="right" width="100" ><?php echo number_format($saldo); ?></td>
</tr>
<?php		
}
function myfooter(){	
	echo "</table>";
}
	//$saldo=0;
	$saldo = $dr_sa-$kr_sa;
	$jml_dr=0;
	$jml_kr=0;
	$no=1;
	$page =1;
	foreach($data->result_array() as $r_data){
	$tgl 		= $this->app_model->tgl_indo($r_data['tgl_jurnal']);
	$nama_rek 	= $this->app_model->CariNamaRek($r_data['no_rek']);
	$saldo = $saldo+$r_data['debet']-$r_data['kredit'];
	if(($no%25) == 1){
   	if($no > 1){
        myfooter();
	?>
    <div class="pagebreak" align="right">
    <div class="page" align="center">Hal - <?php echo $page;?></div>
    </div>
    <?php
		$page++;
  	}
   	myheader($profil,$judul,$no_rek,$periode,$dr_sa,$kr_sa,$saldo);
	}
	?>
    <tr>
    	<td align="center"><?php echo $no;?></td>
        <td align="center"><?php echo $r_data['no_jurnal'];?></td>
        <td align="center"><?php echo $tgl;?></td>
        <td ><?php echo $r_data['ket'];?></td>
        <td align="center"><?php echo $r_data['no_rek'];?></td>
        <td ><?php echo $nama_rek;?></td>
        <td align="right"><?php echo number_format($r_data['debet']);?></td>
        <td align="right"><?php echo number_format($r_data['kredit']);?></td>
        <td align="right"><?php echo number_format($saldo);?></td>
    </tr>    
    <?php
	$no++;
	$jml_dr = $jml_dr+$r_data['debet'];
	$jml_kr = $jml_kr+$r_data['kredit'];
	}
myfooter();	
	echo "</table>";
	echo "<br>";
	echo "<div class='page' align='center'>Hal - ".$page."</div>";
?>