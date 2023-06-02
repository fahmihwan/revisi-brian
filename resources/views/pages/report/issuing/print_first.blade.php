<!DOCTYPE html>
<html>

<head>
    <title>.</title>

    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }

        .header {
            padding: 20px 0px;
            text-align: center;
        }

        .container table tr td {
            font-size: 20px;
        }

        .header h4 {
            font-size: 38px;
        }

        .container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        table {
            width: 100%;
        }


        table,
        td {
            padding: 20px;
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 9pt;
        }
    </style>
</head>

<body>
    <div class="header">
        <h4>Laporan Barang Keluar</h4> <br>
        <h6 style="">Buka Tutup Second</h6>
        <p style="">Jl Godean, Km 7 Semarangan, Sleman Daerah Istimewa Yogyakarta Kode Pos 55285</p>
    </div>
    <div class="container">
        <table style="width: 1000px">
            <tr>
                <td>no referensi</td>
                <td>{{ $item->no_referensi }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>{{ $item->tanggal }}</td>
            </tr>
            <tr>
                <td>Customer</td>
                <td>{{ $item->customer->nama }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>{{ $item->customer->alamat }}</td>
            </tr>
            <tr>
                <td>Items</td>
                <td>
                    <ul>
                        @foreach ($item->detail_barang_keluars as $data)
                            <li>{{ $data->item->nama }} | {{ $data->qty }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>

        </table>
    </div>
    <div style="padding: 20px; width: 200px; float: right; margin-top: 60px;">
        Yogyakarta, {{date('d-m-Y')}}
        <br>
        <br>
        <br>
        <br>
        <p style="text-align: center">{{auth()->user()->nama}}</p>
    </div>
</body>

</html>
