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
            border: 0.2px solid rgb(162, 162, 162);
            border-collapse: collapse;
            font-size: 9pt;
        }
    </style>
</head>

<body>
    <div class="header">
        <h4>Report Barang</h4> <br>
        <h6 style="">Buka Tutup Second</h6>
        <p style="">Jl Godean, Km 7 Semarangan, Sleman Daerah Istimewa Yogyakarta Kode Pos 55285</p>
    </div>
    <div class="container">
        <table style="width: 1000px">
            <tr>
                <td>Item</td>
                <td>{{ $item->name }}</td>
            </tr>
            <tr>
                <td>Brand</td>
                <td>{{ $item->category_brand->name }}</td>
            </tr>
            <tr>
                <td>Category</td>
                <td>{{ $item->category_product->name }}</td>
            </tr>
            <tr>
                <td>Qty</td>
                <td>{{ $item->qty }}</td>
            </tr>

        </table>
    </div>

</body>

</html>
