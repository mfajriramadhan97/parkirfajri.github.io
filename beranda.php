<?php
    include 'koneksi.php';

?>

<?php

date_default_timezone_set('Asia/Jakarta');


$tgl_masuk=date('Y-m-d');
$startTime = date("H:i:s");

if(isset($_POST["proses"])){
    $sql=mysqli_query($con,"insert transaksi set konsumen='$_POST[konsumen]',  jenis_kendaraan='$_POST[jenis_kendaraan]',
     no_polisi='$_POST[no_polisi]',tgl_masuk= '$tgl_masuk', waktu_masuk='$startTime', biaya=''");
	if($sql){
      

		echo"<script>alert('Data Berhasil di Simpan');document.location='beranda.php'</script>";
	}
}

// $kota=mysqli_query($con,"select *from transaksi where id='$_GET[id]'");
//     $a=mysqli_fetch_array($kota);

if(isset($_GET['update'])){
	$checkout=mysqli_query($con,"update transaksi set waktu_keluar='$startTime' where id='$_GET[id]'");
	if($checkout){		
        // $transaksi=mysqli_query($con,"select *from transaksi where id='$_GET[id]'");
        //  $b=mysqli_fetch_array($transaksi);

        // // $waktu_masuk = time($b['waktu_masuk']);
        // // $waktu_keluar = time($b['waktu_keluar']);

        // // //  $masuk  = strtotime('10:00:00');
        // //  $masuk = date(' H:i:s', $waktu_masuk);
        // // //  $keluar = strtotime('12:00:00');
        // //  $keluar = date(' H:i:s', $waktu_keluar);
        // $waktu  = date('H:i:s', strtotime($b["waktu_keluar"])) - date('H:i:s', strtotime($b["waktu_masuk"]));
    
        // $jam   = floor($waktu / (60 * 60));
        // $menit = $waktu - $jam * (60 * 60);

        // $biaya = 0;
        //     if($jam > 1){
        //         $biaya=(($jam-1)*1000)+5000;
        //         }
            
        //         echo $waktu;

        //         echo "<br>" .$b['waktu_masuk'];

        // mysqli_query($con,"insert transaksi set biaya='$biaya' where id='$_GET[id]'");
    }
}


?>


<form method="post" action="">
                <table>
                <tr>
                    <td><label> Konsumen</label></td>
                    <td>:</td>
                    <td><input type="text" name="konsumen" placeholder="Masukkan Nama" ></td>
                </tr>
                <tr>
                <td><label> Jenis Kendaraan</label></td>
                    <td>:</td>
                    <td>
                        <select name="jenis_kendaraan">
                            <option>Mobil</option>
                            <option>Motor</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td> <label> No Polisi</label></td>
                    <td>:</td>
                    <td><input type="text" name="no_polisi"></td>
                </tr>
                <input type="hidden" name="tgl_masuk" value="<?php echo date(" H:i:s"); ?>">
                <!-- <tr>
                <td><label>Tanggal Transaksi</label></td>
                    <td>:</td>
                    <td><input type="date" name="tgl_masuk"></td>
                </tr>
                <tr>
                    <td> <label>Nomor Handphone</label></td>
                        <td>:</td>
                        <td><input type="text" name="no_hp" ></td>
                    </tr>
                <tr>
                    <td>
                        <button type="submit" name="transaksi">Simpan</button>
                    </td>
                </tr> -->
                <tr>
                    <td>
                        <button type="submit" name="proses">Simpan</button>
                    </td>
                </tr> 
                </table>
            </form>
            <br>
            <br>
            <table border="2px">
                <thead>
                    <tr>
                        <th>Konsumen</th>
                        <!-- <th>Jenis Kendaraan</th> -->
                        <th> No Polisi</th>
                        <th> Masuk</th>
                        <th>Keluar</th>
                        <th>Jenis Kendaraan</th>
                        <th>biaya</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php

                         
$hitung = 0 ;
$jam = 0 ;

                            $query=mysqli_query($con,"select *from transaksi");
                            while($tampil=mysqli_fetch_array($query)){

                                $masuk  = strtotime($tampil['waktu_masuk']);
                                $keluar = strtotime($tampil['waktu_keluar']);
                                $waktu  = $keluar - $masuk;
                            
                                $jam   = floor($waktu / (60 * 60));
                                $menit = $waktu - $jam * (60 * 60);
                            
                                
                                $biaya = 0;
                                // if($jam){
                                    if($jam > 1){
                                        $biaya=(($jam-1)*1000)+5000;
                                        }else if($jam<= 1){
                                            $biaya = 5000;
                                         }
                              
                        ?><tr>
                            <td><?php echo $tampil['konsumen']?></td> 
                            <td><?php echo $tampil['no_polisi']?></td>       
                            <td><?php echo $tampil['waktu_masuk']?></td>       
                            <td><?php echo $tampil['waktu_keluar']?></td> 
                            <td><?php echo $tampil['jenis_kendaraan']?></td>
                            <!-- <td><?php// echo $tampil['biaya']?></td> -->
                            <td><?php echo $biaya ?></td>
                            <!-- <td><?php //echo 'Waktu tinggal: ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit'; ?></td> -->
                          
                            <td><a href="beranda.php?id=<?php echo $tampil['id']?>&update"><button type="button"  class="btn-primary">Checkout</button></a></td>
                    </tr>
						<?php } ?>                  
                </tbody>
            </table>