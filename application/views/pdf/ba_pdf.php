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
        <tr><th>BERITA ACARA UJIAN TUGAS AKHIR</th></tr>
    </table>

    <table style="text-align: justify; margin-top: 20px; width: 100%;">
        <tr>
            <td>
                <p>
                    Pada hari ini, <?= date_time($data->date, 'day-indo') ." ".date_time($data->date, 'date-string-full', " ") ?> bertempat di ruang sidang
                    Fakultas Sains UIN SMH Banten telah melaksanakan Ujian Tugas Akhir mahasiswa yang bertanda tangan di bawah ini:
                </p>
            </td>
        </tr>
    </table>

    <table style="margin-top: 25px; width: 100%;">
        <tr>
            <td nowrap="nowrap" style="width: 110px;">Nama</td>
            <td nowrap="nowrap" style="width: 1px;">:</td>
            <td nowrap="nowrap"><?= $data->colleger_name ?></td>
        </tr>
        <tr>
            <td nowrap="nowrap">NIM</td>
            <td nowrap="nowrap">:</td>
            <td nowrap="nowrap"><?= $data->nim ?></td>
        </tr>
        <tr>
            <td nowrap="nowrap">Program Studi</td>
            <td nowrap="nowrap">:</td>
            <td nowrap="nowrap"><?= $data->study_program_name ?></td>
        </tr>
        <tr>
            <td nowrap="nowrap">Judul</td>
            <td nowrap="nowrap">:</td>
            <td nowrap="nowrap"><?= $data->title ?></td>
        </tr>
    </table>

    <table style="margin-top: 25px; text-align: center; width: 100%;">
        <tr><th>KEPUTUSAN UJIAN TUGAS AKHIR</th></tr>
    </table>

    <table style="text-align: justify; width: 100%;">
        <tr>
            <td>
                <p>
                    Setelah melihat, memperhatikan, dan mempertimbangkan hasil ujian, maka dengan ini Dewan Penguji
                    Ujian Tugas Akhir Fakultas Sains UIN Sultan Maulana Hasanuddin Banten memutuskan bahwa saudara dinyatakan
                    <strong> LULUS / TIDAK LULUS* </strong> <br>
                    Dengan nilai :.......... <br>
                    <br>
                    Kepada saudara diberikan waktu untuk melakukan perbaikan naskah <strong>paling lama 3 bulan</strong> dari waktu
                    pelaksanaan Ujian Tugas Akhir. Apabila dalam waktu yang telah ditentukan belum melakukan perbaikan, maka kelulusan dapat
                    ditangguhkan dan harus mengikuti ujian ulang. <br>
                    Demikian Berita Acara Ujian Tugas Akhir ini dibuat untuk dipergunakan sebagaimana mestinya.
                </p>
            </td>
        </tr>
    </table>

    <table style="text-align: center; margin-top: 25px; width: 100%;">
        <tr>
            <td style="width: 50%;"></td>
            <td style="width: 50%;">
                Serang, <?= date_time($data->date, 'date-string-full', " ") ?>
            </td>
        </tr>
        <tr>
            <th>Pembimbing Utama</th>
            <th>Pembimbing Pendamping</th>
        </tr>
        <tr>
            <td style="height: 70px;"></td>
            <td></td>
        </tr>
        <tr>
            <td>(<?= $data->main_lecturer_name ?>)</td>
            <td>(<?= $data->secondary_lecturer_name ?>)</td>
        </tr>
        <tr>
            <th style="height: 30px;">Penguji Utama</th>
            <th>Penguji Pendamping</th>
        </tr>
        <tr>
            <td style="height: 70px;"></td>
            <td></td>
        </tr>
        <tr>
            <td>(<?= $data->main_tester_name ?>)</td>
            <td>(<?= $data->secondary_tester_name ?>)</td>
        </tr>
        <tr>
            <td colspan="2" valign="bottom" style="height: 30px;">
                Mengetahui,
            </td>
        </tr>
        <tr>
            <th colspan="2" style="height: 30px;">Ketua Penguji</th>
        </tr>
        <tr>
            <td colspan="2" style="height: 70px;"></td>
        </tr>
        <tr>
            <td colspan="2">(<?= $data->lead_tester_name ?>)</td>
        </tr>
    </table>
  </body>
</html>
