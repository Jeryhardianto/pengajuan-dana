<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <link rel="icon" type="image/x-icon" href="{{ asset('image/favicon1.png') }}">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Laporan</title>
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
  <p style="text-align: center;"><span style="text-decoration: underline;"><strong>LAPORAN</strong></span></p>
  
  <table style="border-collapse: collapse; width: 100%;" border="1">
  <tbody>
  <tr style="font-weight: bold">
  <td>No</td>
  <td>Nama Kegiatan</td>
  <td>Nama Penanggungjawab</td>
  <td>Tujuan</td>
  <td>Catatan</td>
  <td>Total Biaya</td>
  <td width="20%">Rincian</td>
  </tr>
  @php
    $total = 0;
  @endphp
 @foreach ($pengajuans as $pg)
 <tr>
 <td>{{ $loop->iteration }}</td>
 <td>{{ $pg->nama_kegiatan }}</td>
 <td>{{ $pg->nama_pj }}</td>
 <td>{{ $pg->tujuan }}</td>
 <td>{{ $pg->catatan }}</td>
 <td>{{ NonRupiah($pg->total_biaya) }}</td>
 <td >
     @foreach ($pg->rincian as $rc)
         {{ $rc->nama_peralatan }} = {{ NonRupiah($rc->biaya) }}<br>
        
     @endforeach
 </td>
 </tr>
 @endforeach

  </tbody>
  </table>
  <br><br><br>
  <table style="border-collapse: collapse; width: 100%; font-size:14px" border="1">
    <thead>
      <tr >
   
        <th>Finance</th>
        <th>Direktur</th>
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
    </tr>
    <tr style="text-align: center">
     <td>Finance</td>
     <td>Direktur</td>
     </tr>
    </tbody>
    </table>
</body>
</html>