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
        <h4>Report Barang</h4> <br>
        <h6 style="font-size: 12px;">Buka Tutup Second</h6>
        <p style="font-size: 12px">Jl Godean, Km 7 Semarangan, Sleman Daerah Istimewa Yogyakarta Kode Pos 55285</p>
    </div>
    <div class="container">
        <table>
            <tr>
            <tr>
                <th>No</th>
                <th>Item</th>
                <th>Brand</th>
                <th>Kategori</th>
                <th>Qty</th>
            </tr>
            </tr>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->kategori_brand->nama }}</td>
                    <td>{{ $item->kategori_produk->nama }}</td>
                    <td>{{ $item->qty }}</td>
                </tr>
            @endforeach

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
