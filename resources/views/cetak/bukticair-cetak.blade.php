<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <link rel="icon" type="image/x-icon" href="{{ asset('image/favicon1.png') }}">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Cetak Pengajuan Dana - {{ $pengajuan->user->name }}</title>
 <style>
   body{

     margin: 5px 50px 15px 50px
   }
 </style>
</head>
<body>
 <table style="border-collapse: collapse; width: 100%; height: 10px;">
  <tbody>
  <tr style="height: 11px;">
  <td style="width: 20.0607%; height: 10px;">
  <h2><img src="{{ asset('image/icon-ma.png') }}" alt="" width="200" height="95" /></h2>
  </td>
  <td style="width: 79.9393%; height: 10px;">
  <h2 style="text-align: center; margin-bottom: 10px; margin-left: -200px">PT. MITRABARA ADIPERDANA. TBK</h2>
  <h3 style="text-align: center; margin-bottom: -61px; margin-left: -200px">Site Office : Muara Bengalun Malinau Kota,</h3>
  <h3 style="text-align: center; margin-bottom: 10px; margin-left: -200px">Kec. Malinau Kota, Kabupaten Malinau,</h3>
  <h3 style="text-align: center; margin-bottom: 10px; margin-left: -200px">Kalimantan Utara</h3>
  </td>

  </tbody>
  </table>
  <hr style="color: #000000; background-color: #000000;" />
  <br>
  <p style="text-align: center;"><span style="text-decoration: underline;"><strong>Bukti Pencairan Dana</strong></span></p>
  <table style="border-collapse: collapse; width: 100%;" border="1">
  <tbody>
  <tr>
  <td style="width: 33.0966%;">Perusahan</td>
  <td style="width: 66.9034%;">: PT. MITRABARA ADIPERDANA. TBK</td>
  </tr>
  <tr>
  <td style="width: 33.0966%;">Nama Pemohon</td>
  <td style="width: 66.9034%;">: {{ $pengajuan->nama_pj }}</td>
  </tr>
  <tr>
  <td style="width: 33.0966%;">Depertemen</td>
  <td style="width: 66.9034%;">: {{ $pengajuan->user->dept->nama_dept }}</td>
  </tr>
  <tr>
    <td style="width: 33.0966%;">Nama Kegiatan</td>
    <td style="width: 66.9034%;">: {{ $pengajuan->nama_kegiatan }}</td>
    </tr>
    <tr>
      <td style="width: 33.0966%;">Tujuan Kegiatan</td>
      <td style="width: 66.9034%;">: {{ $pengajuan->tujuan }}</td>
      </tr>
  <tr>
  <td style="width: 33.0966%;">Total Pencairan</td>
  <td style="width: 66.9034%;">: {{ NonRupiah($pengajuan->total_biaya)}}</td>
  </tr>
  <tr>
    <td style="width: 33.0966%;">Jenis Transaksi</td>
    <td style="width: 66.9034%;">: {{ $bukticairs->jenis_transaksi }}</td>
    </tr>

    <tr>
      <td style="width: 33.0966%;">Tanggal Pengajuan</td>
      <td style="width: 66.9034%;">: {{ Carbon\Carbon::parse($pengajuan->tanggaldiajukan)->format('d-m-Y') }}</td>
      </tr>

      <tr>
        <td style="width: 33.0966%;">Tanggal Pencairan</td>
        <td style="width: 66.9034%;">: {{ Carbon\Carbon::parse($bukticairs->tanggal_cair)->format('d-m-Y') }}</td>
        </tr>
  </tbody>
  </table>
  <br><br><br>
  <table style="border-collapse: collapse; width: 100%; font-size:14px" border="1">
   <thead>
     <tr >
       <th>Pemohon</th>
       <th>Diterima Oleh</th>
       <th>SPV Finance</th>
       <th>Finane HO</th>
     </tr>
   </thead>
   <tbody>
   <tr style="text-align: center">
   <td>
    <br>
    
    <br><br>
  </td>
   <td>
    <br>
   
    <br><br>
  </td>
   <td>
    <br>
   
    <br><br>
  </td>
   <td>
    <br>
   
    <br><br>
  </td>
  
   </tr>
   <tr style="text-align: center">
    <td>{{ $pengajuan->user->name }}</td>
    <td>{{ $pengajuan->user->name }}</td>
    <td>SPV Finance</td>
    <td>Finance HO</td>
    </tr>
   
   </tbody>
   </table>
   <script>
 
</script>
</body>
</html>