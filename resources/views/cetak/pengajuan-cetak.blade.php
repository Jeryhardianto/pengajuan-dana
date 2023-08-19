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
  <p style="text-align: center;"><span style="text-decoration: underline;"><strong>FORM PENGAJUAN DANA</strong></span></p>
  <table style="border-collapse: collapse; width: 100%;" border="1">
  <tbody>
  <tr>
  <td style="width: 33.0966%;">Nama Kegiatan</td>
  <td style="width: 66.9034%;">: {{ $pengajuan->nama_kegiatan }}</td>
  </tr>
  <tr>
  <td style="width: 33.0966%;">Nama Penanggungjawab</td>
  <td style="width: 66.9034%;">: {{ $pengajuan->nama_pj }}</td>
  </tr>
  <tr>
  <td style="width: 33.0966%;">Tujuan Kegiatan</td>
  <td style="width: 66.9034%;">: {{ $pengajuan->tujuan }}</td>
  </tr>
  <tr>
  <td style="width: 33.0966%;">Total Biaya</td>
  <td style="width: 66.9034%;">: {{ NonRupiah($pengajuan->total_biaya)}}</td>
  </tr>
  </tbody>
  </table>
  <p style="text-align: center;"><strong><span style="text-decoration: underline;">RINCIAN</span> </strong></p>
  <table style="border-collapse: collapse; width: 100%;" border="1">
  <tbody>
  <tr>
  <td style="width: 7.48103%;">No</td>
  <td style="width: 41.1458%;">Keterangan</td>
  <td style="width: 51.3731%;">Jumlah</td>
  </tr>
  @php
    $total = 0;
  @endphp
 @foreach ($detailItems as $di)
 <tr>
 <td style="width: 7.48103%;">{{ $loop->iteration }}</td>
 <td style="width: 41.1458%;">{{ $di->nama_peralatan }}</td>
 <td style="width: 51.3731%;">{{ NonRupiah($di->biaya) }}</td>
 </tr>
 @php
   $total = $total + $di->biaya
 @endphp
 @endforeach

  <tr>
   <td colspan="2" style="text-align: center">Total</td>
   <td>{{ NonRupiah($total) }}</td>
  </tr>
  </tbody>
  </table>
  <p><b>Catatan : {!! $pengajuan->catatan !!}</b></p>
  <table style="border-collapse: collapse; width: 100%; font-size:14px" border="1">
   <thead>
     <tr  >
       <th>Dibuat Oleh</th>
       <th>Diperiksa Oleh</th>
       <th>Diperiksa Oleh</th>
       <th>Disetujui Oleh</th>
     </tr>
   </thead>
   <tbody>
   <tr style="text-align: center">
   <td>
    <br>
     @if ( $pengajuan->user_id )
         tdd
     @endif
    <br><br>
  </td>
   <td>
    <br>
    @if ( $pengajuan->finance1_id )
      tdd
    @endif
    <br><br>
  </td>
   <td>
    <br>
    @if ( $pengajuan->finance2_id )
      tdd
    @endif
    <br><br>
  </td>
   <td>
    <br>
    @if ( $pengajuan->direktur_id )
      tdd
    @endif
    <br><br>
  </td>
  
   </tr>
   <tr style="text-align: center">
    <td>{{ $pengajuan->user->name }}</td>
    <td>Finance 1</td>
    <td>Finance 2</td>
    <td>Direktur</td>
    </tr>
   
   </tbody>
   </table>
   <script>
 
</script>
</body>
</html>