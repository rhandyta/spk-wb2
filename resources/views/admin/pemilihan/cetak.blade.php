<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    /* Style the header */
    header {
        text-align: center;
        font-size: 20px;
        color: black;
    }

    h3 {
        text-align: center;
        line-height: 0.5;
    }

    p {
        text-align: center;
        line-height: 0.5;
    }

    td.b {
        text-align: center;
        border: 1px solid;
        border-collapse: collapse;
    }

    div.a {
        text-align: center;
    }

    div.c {
        text-align: right;
    }

    td.x {
    width: 17%;
    }

    td.y {
        width: 66%;
    }

    td.z {
        width: 17%;
    }

    table.a,
    th.a,
    td.a {
        border: 1px solid;
        border-collapse: collapse;
    }

    table.b {
        width: 40%;
        spacing: 40px;
        margin-left: auto;
        margin-right: 0px;
    }

    tr.b {
        height: 200px;
    }

    footer {
        text-align: center;
        font-size: 17px;
        color: black;
    }

    #foto {
        margin-bottom: 20px;
        margin-top: 5px;
    }

</style>

<body>
    <header>
        <div>
            <table>
                <tr>
                    <td class="x"><img src="{{ public_path('/kop1.png') }}" width="90" height="90">
                    </td>
                    <td class="y">
                        <h3>
                            <font color="blue">SMK WIRA BUANA 2</font>
                        </h3>
                        <p class="a">
                            <font size="3pt"><b>NPSN : 20268220 – NSS : 402020213136</b></font>
                        </p>
                        <p><b>TERAKREDITASI A</b></p>
                        <P class="a">
                            <font size="2pt">Teknik Otomotif (Teknik Kendaraan Ringan-Teknik Sepeda Motor)</font>
                        </P>
                        <P class="a">
                            <font size="2pt">Teknik Informatika (Rekayasa Perangkat Lunak-Teknik Komputer Jaringan)
                            </font>
                        </P>
                        <p class="a">
                            <font size="2pt">Jl. Camat Kanang RT.05 RW.07 No.13 Ds. Pabuaran Kec. BojonggedeKab. Bogor
                                Jawa Barat 16320 <br><br>
                                Telp/Fax (021) 87984656 – Email : smkwbbojonggede@gmail.com</font>
                        </p>
                    </td>
                    <td class="z"><img src="{{ public_path('/kop.png') }}" width="90" height="90"></td>
                </tr>
            </table>
            <hr>
        </div>
    </header>
    <div class="a">
        <h2>LAPORAN VOTING</h2><br><br>
    </div>
    <div>
        <center>

            <div class="table-responsive">
                <table class="a" style="width: 100%">
                    <thead>
                        <tr>
                            <th class="a">Kandidat</th>
                            <th class="a">Hak Suara</th>
                            <th class="a">Suara Masuk</th>
                            <th class="a">Suara Belum Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="b">{{ count($kandidat) }}</td>
                            <td class="b">{{ $jumlahsuara }}</td>
                            <td class="b">{{ $suaramasuk }}</td>
                            <td class="b">{{ $belumvoting }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <br><br><br><br>

            <table style="width:100%" class="a">
                <thead>
                    <tr>
                        <th class="a"> No </th>
                        <th class="a"> Foto </th>
                        <th class="a"> NIS </th>
                        <th class="a"> Nama Siswa</th>
                        <th class="a"> Jumlah Vote </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($kandidat as $k)
                        <tr>
                            <td class="b">{{ $no++ }}</td>
                            <td class="b" id="foto">
                                @if ($k->siswa->photo == 'default.jpg')
                                    <img src="{{ asset('assets/images/siswa/default.jpg') }}"
                                        style=" width: 40px; height:45px">
                                @endif
                                @if ($k->siswa->photo != 'default.jpg')
                                    <img src="https://drive.google.com/uc?id={{ $k->siswa->photo }}"
                                        style=" width: 40px; height:45px">
                                @endif
                            </td>
                            <td class="b">{{ $k->nis }}</td>
                            <td class="b">{{ $k->siswa->nama }}</td>
                            <td class="b">{{ count($k->pilihan) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </center>
    </div>
    </div>
    <br><br><br>
    <font size="3pt">Dengan demikian laporan ini di sampaikan, atas perhatian dan
        kerjasamanya kami
        ucapkan terima kasih.<br><br>Wassalamu'alaikum wr.wb.
    </font><br><br><br><br><br>
    <footer>
        <table class="b">
            <tr class="b">
                <td>Bogor,{{ date(' d F Y') }}</td>
            </tr>
            <tr>
                <td><b>Ihsan Laksono<b></td>
            </tr>
        </table>
    </footer>
</body>

</html>
