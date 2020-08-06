<?php
require('../config/travel-config.php');


// Periksa ada atau tidak variabel Kode pada URL (alamat browser)
if(isset($_GET['NomorJamaah'])){

  $NomorJamaah= isset($_GET['NomorJamaah']) ?  $_GET['NomorJamaah'] : '';

  // Perintah membaca data Pasien
  $mySql	= "SELECT * FROM jamaah
  WHERE nomor_id='$NomorJamaah'";
  $myQry	= mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
  $myData = mysql_fetch_array($myQry);
  //baca Variabel data
  $kodeBaru = $myData['nomor_id'];
  $Title = $myData['title'];
  $FirstName = $myData['first_name'];
  $LastName = $myData['last_name'];
  $SurName = $myData['surname'];
  $Gender = $myData['gender'];
  $place_of_birth = $myData['place_of_birth'];
  $tanggalLahir = $myData['birthdate'];
  $Status = $myData['status_jamaah'];
  $Contact = $myData['phone'];
  $Address = $myData['alamat'];
  $Email = $myData['email'];
  $City = $myData['kota'];
  $FamilyName = $myData['family_name'];
  $FamilyContact = $myData['family_contact'];
  $FamilyRelationship = $myData['family_relationship'];
  $Passport = $myData['no_pass'];
  $txtPoi = $myData['poi'];
  $txtDoi = $myData['doi'];
  $txtExpired = $myData['expired'];
  $officer = $myData['petugas'];
  $travel = $myData['travel'];

    $Packages_Program = $myData['packages_program'];
      $Kd_Umroh = $myData['kd_umroh'];
        $travel = $myData['travel'];
          $Depart = $myData['depart'];
            $Arrival = $myData['arrival'];
              $Room = $myData['room'];
                $nomor = $myData['nomor_room'];
                  $Mahrom = $myData['mahrom'];
                    $Mahrom_Status = $myData['mahrom_status'];
                      $metode_status = $myData['metode_status'];

                      $dataJumlah = 1 ;







  // pindah data jamaah ke register
  $dataKode = rand(000000,555555);
  $mySql  = "INSERT INTO `jamaah_daftar` (nomor_id, date_daftar, title,  first_name,
                                    last_name, surname, gender, place_of_birth, birthdate, status_jamaah,
                                    phone, alamat, email, kota, family_name, family_contact, family_relationship,
                                     no_pass, poi, doi, expired,
                                     petugas, travel)
                            VALUES ('$dataKode', NOW(), '$Title', '$FirstName',
                            '$LastName', '$SurName', '$Gender', '$place_of_birth', '$tanggalLahir', '$Status',
                            '$Contact', '$Address', '$Email', '$City', '$FamilyName', '$FamilyContact', '$FamilyRelationship',
                             '$Passport', '$txtPoi', '$txtDoi', '$txtExpired'
                            , '$officer', '$travel'  )";

     $myQry  = mysql_query($mySql, $Link) or die ("Gagal query".mysql_error());


     // untuk input track umroh

         $mySql  = "INSERT INTO `track_jamaah` (nomor_id, input_track,
                                           packages_program,
                                           depart, arrival, room, nomor_room,
                                           kd_umroh, staff, travel_agent, mahrom, mahrom_status, status_pay)
                                   VALUES ('$dataKode', NOW(),
                                   '$Packages_Program',
                                   '$Depart', '$Arrival', '$Room', '$Nomor_Room',
                                  '$Kd_Umroh' , '$officer', '$travel', '$Mahrom', '$Mahrom_Status' , '$metode_status')";

         $myQry  = mysql_query($mySql, $Link) or die ("Gagal query".mysql_error());

         // Skrip Update stok
           $stokSql = "UPDATE paket_umroh SET `kuota`= kuota - $dataJumlah,
                                               `daftar` = daftar + $dataJumlah
                                       WHERE kd_umroh='$Kd_Umroh'";
           mysql_query($stokSql, $Link) or die ("Gagal Query Edit Stok".mysql_error());

           //hapus data waiting
           $mySql = "DELETE FROM jamaah WHERE nomor_id='$kodeBaru'";
           mysql_query($mySql, $Link) or die ("Gagal kosongkan tmp".mysql_error());



     if($myQry){
     		// Refresh halaman
     		echo "<meta http-equiv='refresh' content='0; url=?page=DataJamaahRahmah'>";
     	}
  }
  else {
  echo "Nomor ID Jamaah Tidak Terbaca";
  exit;
  }

?>
