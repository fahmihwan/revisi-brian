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
        <h4>Report Receiving</h4> <br>
        <h6 style="">Buka Tutup Second</h6>
        <p style="">Jl Godean, Km 7 Semarangan, Sleman Daerah Istimewa Yogyakarta Kode Pos 55285</p>
    </div>
    <div class="container">
        <table style="width: 1000px">
            <tr>
                <td>Date</td>
                <td>{{ $item->tanggal }}</td>
            </tr>
            <tr>
                <td>Ball Number</td>
                <td>{{ $item->kode_ball }}</td>
            </tr>
            <tr>
                <td>Supplier</td>
                <td>{{ $item->supplier->nama }}</td>
            </tr>
            <tr>
                <td>Categori</td>
                <td>{{ $item->kategori_produk->nama }}</td>
            </tr>
            <tr>
                <td>Target Qty</td>
                <td>{{ $item->target_qty }}</td>
            </tr>
            <tr>
                <td>Open Qty</td>
                <td>{{ $item->open_qty }}</td>
            </tr>
            <tr>
                <td>Price</td>
                <td>{{ $item->harga }}</td>
            </tr>

        </table>
    </div>

</body>

</html>
