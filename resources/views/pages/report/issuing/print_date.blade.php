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

        .header h4 {
            font-size: 28px;
        }

        .container {
            /* border: 1px solid black; */
        }

        table {
            width: 100%;
        }

        table,
        th,
        td {
            padding: 5px;
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 9pt;
        }
    </style>
</head>

<body>
    <div class="header">
        <h4>Report Issuing </h4> <br>
        <h6 style="font-size: 12px;">Buka Tutup Second</h6>
        <p style="font-size: 12px">Jl Godean, Km 7 Semarangan, Sleman Daerah Istimewa Yogyakarta Kode Pos 55285</p>
        <p style="margin: 5px">Periode : {{ request('start_date') }} sampai {{ request('end_date') }}</p>
    </div>
    <div class="container">
        <table>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>no_referensi</th>
                <th>customer</th>
                <th>Alamat</th>
                <th>items</th>
            </tr>
            @foreach ($items as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->tanggal }}</td>
                    <td>{{ $data->no_referensi }}</td>
                    <td>{{ $data->customer->nama }}</td>
                    <td>{{ $data->customer->alamat }}</td>
                    <td style="padding-left: 20px;">
                        <ul>
                            @foreach ($data->detail_barang_keluars as $detail)
                                <li> {{ $detail->item->nama }} - {{ $detail->qty }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>

</body>

</html>
