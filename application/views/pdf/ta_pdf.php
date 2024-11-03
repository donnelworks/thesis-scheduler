<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <style type="text/css">
      body {
        font-size: 11pt;
        font-family: "Times New Roman", serif;
      }

      table {
        border-collapse: collapse;
        width: 100%;
      }

      .tbl-data td, .tbl-data th {
        border: 1px solid #000;
        text-align: left;
      }

      .tbl-data th, .tbl-data td {
        padding: 5px;
      }
    </style>

  </head>

  <body>

    <table style="text-align: center; width: 100%;">
        <tr><th>SURAT TUGAS</th></tr>
        <tr><th>Nomor: <?= $data->number ?></th></tr>
    </table>

    <table style="text-align: justify; margin-top: 20px; width: 100%;">
        <tr>
            <td>
                <p>
                    Dekan Fakultas Sains UIN Sultan Maulana Hasanuddin Banten, menugaskan dosen-dosen yang Namanya tercantum
                    dalam kolom 4 untuk melaksanakan tugas sebagai Dewan Penguji Ujian Tugas Akhir Mahasiswa Program Studi <?= $data->study_program_name ?>
                    yang namanya tersebut dalam kolom 2. Ujian ini akan dilaksanakan pada Hari <?= date_time($data->date, 'day-indo') .", ".date_time($data->date, 'date-string-full', " ") ?>
                    mulai pukul <?= explode(":", $data->start_time)[0].".".explode(":", $data->start_time)[1] ?> WIB sampai dengan pukul <?= explode(":", $data->end_time)[0].".".explode(":", $data->end_time)[1] ?> WIB
                    bertempat di Ruang Sidang Fakultas Sains UIN Sultan Maulana Hasanuddin Banten.
                </p>
            </td>
        </tr>
    </table>

    <table class="tbl-data" style="margin-top: 25px; width: 100%;">
        <tr>
            <th style="text-align: center;">No</th>
            <th style="text-align: center;">NAMA/NIM/JUDUL</th>
            <th style="text-align: center;">WAKTU</th>
            <th style="text-align: center;">MAJELIS PENGUJI</th>
        </tr>
        <tr>
            <th style="text-align: center;"><em>1</em></th>
            <th style="text-align: center;"><em>2</em></th>
            <th style="text-align: center;"><em>3</em></th>
            <th style="text-align: center;"><em>4</em></th>
        </tr>
        <tr>
            <td valign="top" style="width: 1px;">1</td>
            <td valign="top">
                <strong><?= "$data->colleger_name/$data->nim" ?></strong> <br>
                <em><?= $data->title ?></em>
            </td>
            <td valign="top" nowrap="nowrap"><?= explode(":", $data->start_time)[0].".".explode(":", $data->start_time)[1] ?> s.d <?= explode(":", $data->end_time)[0].".".explode(":", $data->end_time)[1] ?></td>
            <td valign="top">
                <strong>KETUA PENGUJI:</strong>
                <?= $data->lead_tester_name ?> <br>
                <strong>PENGUJI UTAMA:</strong>
                <?= $data->main_tester_name ?> <br>
                <strong>PENGUJI PENDAMPING:</strong>
                <?= $data->secondary_tester_name ?> <br>
                <strong>PEMBIMBING UTAMA:</strong>
                <?= $data->main_lecturer_name ?> <br>
                <strong>PEMBIMBING PENDAMPING:</strong>
                <?= $data->secondary_lecturer_name ?> <br>
            </td>
        </tr>
    </table>

    <p>Demikian surat tugas ini dibuat, agar dilaksanakan sebagaimana mestinya.</p>

    <table style="margin-top: 25px; margin-bottom: 25px; width: 100%;">
        <tr>
            <td></td>
            <td nowrap="nowrap" style="width: 250px;">
                Serang, <?= date_time($data->date, 'date-string-full', " ") ?>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">a.n</td>
            <td>Dekan</td>
        </tr>
        <tr>
            <td></td>
            <td>Wakil Dekan Bid. Akademik</td>
        </tr>
        <tr>
            <td style="height: 70px;"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td><u>Dr. Eko Wahyu Wibowo, M.M</u></td>
        </tr>
        <tr>
            <td></td>
            <td>NIP. 197504142003121002</td>
        </tr>
    </table>
    
    <div>
        <p style="font-size: 6pt; font-family: Calibri, sans-serif; font-style: italic;">
            <u>Tembusan disampaikan kepada:</u> <br>
            1. Wakil Dekan I, Fakultas Sains UNI Sultan Maulana Hasanuddin Banten <br>
            2. Ketua Prodi Fisika <br>
            3. Mahasiswa yang bersangkutan <br>
            <br>
            <u>Catatan:</u> <br>
            <ol style="font-size: 6pt; font-family: Calibri, sans-serif; padding-left: 15px; margin-top: 0; font-style: italic;">
                <li>Peserta sidang diwajibkan hadir selambat-lambatnya 10 menit sebelum waktu pelaksanaan.</li>
                <li>Peserta sidang memasuki ruang sidang 15 menit sebelum ujian sidang dimulai di ruang sidang, sesuai dengan jadwal yang telah diumumkan, untuk melaksanakan persiapan.</li>
                <li>
                    Peserta sidang diwajibkan mengenakan Pakaian rapih: <br>
                    Perempuan: Jas Almamater dan Rok/Celana berwarna Hitam (Kemeja berwarna putih, jilbab: hitam) <br>
                    Laki-loki: Jas Almamoter & Celana bahan berwarna Hitam (Kemeja berwarna putih)
                </li>
                <li>Membawa Laptop sendiri.</li>
                <li>Selama pelaksanaan sidang berlangsung, peserta dilarang:</li>
                <ul style="padding-left: 13px; list-style: disc; color: #000;">
                    <li>Melakukan atau mencoba melakukan kegiatan yang dapat mengganggu kelancaran/ketertiban jalannya sidang.</li>
                    <li>Melakukan kegiatan yang menyebabkan kotornya lokasi sidang.</li>
                    <li>Bertindak tidak jujur dalam menjalankan ujian sidang.</li>
                    <li>Peserta sidang wajib mengikuti seluruh rangkaian jalannya sidang dari awal hingga pengumuman hasil sidang.</li>
                    <li>Peserta yang tidak mengikuti seluruh rangkaian jalannya sidang tanpa sepengetahuan dan seijin ketua sidang atau Prodi, dinyatakan tidak lulus.</li>
                </ul>
            </ol>
        </p>
    </div>
    
  </body>
</html>
