<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});	
	
	$("#tgl").datepicker({
			dateFormat:"dd-mm-yy"
    });
	
	$("#no_bukti").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
		CariAnggota(isi);
	});
	
	$(".angka").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		}
	});
	
	$("#view").show();
	$("#form").hide();
	
	$("#tambah").click(function(){
		$("#view").hide();
		$("#form").show();
		buat_nojurnal();
		kosong();
		$("#no_bukti").focus();
		tampil_data();
		//$("#tampil_data").html('hai...');
	});
	
	function kosong(){
		$(".kosong").val('');
		$(".angka").val('');
		$("#no_bukti").val('');
		$("#ket").val('');
	}
	
	function buat_nojurnal(){
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/CariNoJurnal",
			//data	: string,
			cache	: false,
			dataType: "json",
			success	: function(data){
				$("#no_jurnal").val(data.nojurnal);
				$("#tgl").val(data.tgl);
			}
		});
		
	}
	
	$("#no_rek").keyup(function(){
		CariNoRek();
	});
	
	$("#no_rek").change(function(){
		CariNoRek();
	});
	
	function CariNoRek(){
		var no_rek = $("#no_rek").val();
		var string = "no_rek="+no_rek;
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/CariNamaRek",
			data	: string,
			cache	: false,
			dataType: "json",
			success	: function(data){
				$("#nama_rek").val(data.nama_rek);
			}
		});
	}
	$("#simpan").click(function(){
		var no_jurnal	= $("#no_jurnal").val();
		var tgl			= $("#tgl").val();
		var no_bukti	= $("#no_bukti").val();
		var ket			= $("#ket").val();
		var no_rek 		= $("#no_rek").val();
		var debet 		= $("#dr").val();
		var kredit 		= $("#kr").val();
		
		var string = "no_jurnal="+no_jurnal+"&tgl="+tgl+"&no_bukti="+no_bukti+
					"&ket="+ket+"&no_rek="+no_rek+"&debet="+debet+"&kredit="+kredit;
		
		if(no_bukti.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, No Bukti Tidak Boleh Kosong',
				timeout:2000,
				showType:'slide'
			});
			$("#no_bukti").focus();
			return false;
		}
		if(no_rek.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, No Rek Tidak Boleh Kosong',
				timeout:2000,
				showType:'slide'
			});
			
			$("#no_rek").focus();
			return false();
		}
		if(nama_rek.length==0){
			//alert("Maaf, Nama Rekening tidak boleh kosong");
			$.messager.show({
				title:'Info',
				msg:'Maaf, Nama Rek Tidak Boleh Kosong',
				timeout:2000,
				showType:'slide'
			});
			
			$("#no_rek").focus();
			return false();
		}
		if(debet.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Debet Tidak Boleh Kosong',
				timeout:2000,
				showType:'slide'
			});
			$("#dr").focus();
			return false();
		}
		if(kredit.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Kredit Tidak Boleh Kosong',
				timeout:2000,
				showType:'slide'
			});
			$("#kr").focus();
			return false();
		}
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/jurnal_umum/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				$.messager.show({
					title:'Info',
					msg:data,
					timeout:2000,
					showType:'slide'
				});
				tampil_data();
			}
		});
		
	});
	
	function tampil_data(){
		var no_jurnal = $("#no_jurnal").val();
		var string = "no_jurnal="+no_jurnal;
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/jurnal_umum/DetailJurnalUmum",
			data	: string,
			cache	: false,
			success	: function(data){
				$("#tampil_data").html(data);
			}
		});
	}
	
	$("#tambah_data").click(function(){
		$(".kosong").val('');
		$(".angka").val('');
		$("#no_jurnal").focus();
		//buat_nojurnal();
	});
	
	$("#kembali").click(function(){
		window.location.assign('<?php echo base_url();?>index.php/jurnal_umum');
	});
});

function editData(id){
	var string = "id="+id;
	//alert(id);
	
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/jurnal_umum/edit",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){
				
				$("#no_bukti").val(data.no_bukti);
				$("#no_jurnal").val(data.no_jurnal);
				$("#ket").val(data.ket);
				$("#tgl").val(data.tgl);
				//$("#no_rek").focus();
				
				$("#view").hide();
				$("#form").show();
				tampil_data();
			}
	});
	
	function tampil_data(){
		var no_jurnal = $("#no_jurnal").val();
		var string = "no_jurnal="+no_jurnal;
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/jurnal_umum/DetailJurnalUmum",
			data	: string,
			cache	: false,
			success	: function(data){
				$("#tampil_data").html(data);
			}
		});
	}
	
}
</script>
<div id="view">
<div style="float:left; padding-bottom:5px;">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>

<a href="<?php echo base_url();?>index.php/jurnal_umum">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>
</div>
<div style="float:right; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>index.php/jurnal_umum">
Cari No.Jurnal/No.Rek : <input type="text" name="txt_cari" id="txt_cari" size="50" />
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
</form>
</div>
<div style="padding:10px;"></div>
<table id="dataTable" width="100%">
<tr>
	<th>No</th>
    <th>No Jurnal</th>
    <th>Tanggal</th>
    <th>No Bukti</th>
    <th>No Rek</th>
    <th>Nama Rek</th>
    <th>Debet</th>
    <th>Kredit</th>
    <th>Aksi</th>
</tr>
<?php
	if($data->num_rows()>0){
		$jml_dr=0;
		$jml_kr=0;
		$no =1+$hal;
		foreach($data->result_array() as $db){  
		$tgl = $this->app_model->tgl_indo($db['tgl_jurnal']);
		$nama_rek = $this->app_model->CariNamaRek($db['no_rek']);
		?>    
    	<tr>
			<td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="100" ><?php echo $db['no_jurnal']; ?></td>
            <td align="center" width="100"><?php echo $tgl; ?></td>
            <td align="center" ><?php echo $db['no_bukti']; ?></td>
            <td align="center" width="80" ><?php echo $db['no_rek']; ?></td>
            <td ><?php echo $nama_rek; ?></td>            
            <td align="right" width="100" ><?php echo number_format($db['debet']); ?></td>
            <td align="right" width="100" ><?php echo number_format($db['kredit']); ?></td>
            <td align="center" width="80">
            <?php echo "<a href='javascript:editData(\"{$db['no_jurnal']}\")'>";?>
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>index.php/jurnal_umum/hapus/<?php echo $db['no_jurnal'];?>"
            onClick="return confirm('Anda yakin ingin menghapus nomor jurnal ini?')">
			<img src="<?php echo base_url();?>asset/images/del.png" title='Hapus'>
			</a>
            </td>
    </tr>
    <?php
		$jml_dr = $jml_dr+$db['debet'];
		$jml_kr = $jml_kr+$db['kredit'];
		$no++;
		}
	}else{
		$jml_dr = 0;
		$jml_kr = 0;
	?>
    	<tr>
        	<td colspan="9" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
<tr>
	<td align="right" colspan="6"><b>Jumlah</b></td>
    <td align="right"><b><?php echo number_format($jml_dr);?></b></td>
    <td align="right"><b><?php echo number_format($jml_kr);?></b></td>    
</tr>        
</table>
<?php echo "<table align='center'><tr><td>".$paginator."</td></tr></table>"; ?>
</div>
<div id="form">
<fieldset>
<table width="100%">
<tr>
	<td width="50%" valign="top">
        <table width="100%">
        <tr>
            <td width="20%">No Bukti</td>
            <td width="5">:</td>
            <td>
            <input type="text" name="no_bukti" id="no_bukti" size="20" maxlength="20" />
            </td>
        </tr>
        <tr>    
            <td>Keterangan</td>
            <td>:</td>
            <td>
            <textarea name="ket" id="ket" style="width:300px; height:50px;"></textarea>
            </td>
        </tr>
        </table>
	</td>
    <td width="50%" valign="top">
        <table width="100%">
        <tr>
            <td width="20%">No Jurnal</td>
            <td width="5">:</td>
            <td>
            <input type="text" name="no_jurnal" id="no_jurnal" size="20" maxlength="20" readonly="readonly" />
            </td>
        </tr>
        <tr>    
            <td>Tanggal</td>
            <td>:</td>
            <td>
            <input type="text" name="tgl" id="tgl" size="15" maxlength="15" />
            </td>
        </tr>
        </table>
	</td>
</tr>
</table>            
</fieldset>
<div style="margin:5px;"></div>
<fieldset class="atas">
<table width="100%">
<tr>
	<th>No Rek</th>
    <th>Nama Rekening</th>
    <th>Debet</th>
    <th>Kredit</th>
</tr>    
<tr>
	<td align="center">
    <select name="no_rek" id="no_rek" class="kosong">
    <option value="">-PILIH-</option>
    <?php
	foreach($list_rek->result_array() as $t){
	?>
    <option value="<?php echo $t['no_rek'];?>"><?php echo $t['no_rek'];?> | <?php echo $t['nama_rek'];?></option>
    <?php } ?>
    </select>
    </td>
    <td align="center"><input type="text" name="nama_rek" id="nama_rek" class="kosong" size="50" maxlength="50" readonly="readonly" /></td>
    <td align="center"><input type="text" name="dr" id="dr" class="angka" size="20" maxlength="20" onkeyup="formatNumber(this);" onchange="formatNumber(this);"/></td>
    <td align="center"><input type="text" name="kr" id="kr" class="angka" size="20" maxlength="20" onkeyup="formatNumber(this);" onchange="formatNumber(this);"/></td>
</tr>    
</table>
</fieldset>

<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
    <button name="tambah_data" id="tambah_data" class="easyui-linkbutton" data-options="iconCls:'icon-add'">TAMBAH</button>
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-close'">TUTUP</button>
    </td>
</tr>
</table>  
</fieldset>   
</div>
<div id="tampil_data"></div>