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
        <h4>Report Receiving </h4> <br>
        <h6 style="font-size: 12px;">Buka Tutup Second </h6>
        <p style="font-size: 12px">Jl Godean, Km 7 Semarangan, Sleman Daerah Istimewa Yogyakarta Kode Pos 55285</p>
        <p style="margin: 5px">Periode : {{ request('start_date') }} sampai {{ request('end_date') }}</p>
    </div>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kode Ball</th>
                    <th>Supplier</th>
                    <th>Kategori</th>
                    <th>Target Qty</th>
                    <th>Open Qty</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                @foreach ($datas as $data)
                    <?php $total += $data->harga; ?>
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->tanggal }}</td>
                        <td>{{ $data->kode_ball }}</td>
                        <td>{{ $data->supplier->nama }}</td>
                        <td>{{ $data->kategori_produk->nama }}</td>
                        <td>{{ $data->target_qty }}</td>
                        <td>{{ $data->open_qty }}</td>
                        <td>{{ 'Rp' . $data->harga }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7">total</td>
                    <td colspan="1">Rp.{{ $total }}</td>
                </tr>
            </tfoot>
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
