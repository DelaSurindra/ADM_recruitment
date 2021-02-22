<h3><strong>FORMULIR PEMBUKAAN REKENING NASABAH PERORANGAN</strong></h3>
<img src="image/Logo_BNI_Syariah_Colored.png" style="width: 15%; float:right;margin-bottom:20px;">
<p style="margin-top: 100px;"><strong>DATA PEMBERI DANA (BENEFICIARY OWNER)</strong></p>

<table class="table table-bordered">
    <?php $dataDownload = Session::get('data_download'); ?>
    <tbody>
        <tr>
            <td>NAMA PEMBERI SUMBERDANA</td>
            <td>: {{ $dataDownload['pemberi_dana'] }}</td>
        </tr>
        <tr>
            <td>TANDA PENGENAL</td>
            <td>: Kartu Tanda Penduduk (KTP)</td>
        </tr>
        <tr>
            <td>NOMOR IDENTITAS</td>
            <td>: {{ $dataDownload['pemberi_noktp'] }}</td>
        </tr>
        <tr>
            <td>NOMOR HP</td>
            <td>: {{ $dataDownload['pemberi_nohp'] }}</td>
        </tr>
        <tr>
            <td>NOMOR NPWP</td>
            <td>: {{ $dataDownload['pemberi_npwp'] }}</td>
        </tr>
        <tr>
            <td>SUMBER DANA</td>
            <td>: {{ $dataDownload['sumber_dana'] }}</td>
        </tr>
        <tr>
            <td>HUBUNGAN PEMBERI SUMBER DANA</td>
            <td>: {{ $dataDownload['pemberi_hubungan'] }}</td>
        </tr>
    </tbody>
</table>
<p><strong>Dengan menandatangani ini saya menyatakan:</strong></p>
<strong>
    <ol type="a" style="margin-top:-10px;">
        <li>Bank telah memberikan penjalasan yang cukup mengenai penggunaan formulir ini dana saya memahami segala konsekuensi atas pemanfaatan data tersebut termasuk manfaat dan resiko yang melekat dari pemanfaatan data tersebut.</li>
        <li>Segala informasi yang saya berikan adalah benar.</li>
        <li>Saya membebaskan Bank dari segala tuntutan maupun gugatan pihak manapun termasuk saya sendiri atas penggunaan formulir ini.</li>
    </ol>
</strong>

<p style="float:left">KTP</p>
<img src="{{ $dataDownload['image_pemberi_ktp'] }}" style="float:left; width: 20%;margin-left:18px">

<p style="float:right; margin-right:190px;">TTD</p>
<img src="{{ $dataDownload['image_pemberi_ttd'] }}" style="float:right; width: 20%; clear:both; margin-right:40px;">

<table style="width:100%; margin-top:250px;">
    <tr>
        <td style="text-align:right;">_ _ _ _,20_ _ _</td>
    </tr>
</table>
<table style="width:100%; margin-top:100px;">
    <tr>
        <td style="text-align: right;">(_____________________________)</td>
    </tr>
    <tr>
        <td style="text-align: right;">TANDA TANGAN & NAMA JELAS NASABAH</td>
    </tr>
</table>