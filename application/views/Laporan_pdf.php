<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title_pdf;?></title>
        <style>
            #table {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #table td, #table th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #table tr:nth-child(even){background-color: #f2f2f2;}

            #table tr:hover {background-color: #ddd;}

            #table th {
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: left;
                background-color: #4CAF50;
                color: white;
            }
        </style>
    </head>
    <body>
        <div style="text-align:center">
            <h3> Laporan PDF Toko Dita</h3>
        </div>
        <table id="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nomor Nota</th>
                    <th>Nama Barang</th>
                    <th>Nama Satuan</th>
                    <th>Harga Jual</th>
                    <th>Subtotal</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
            <?php
    if($laporan)
    {
        foreach($laporan as $item) {
        ?>
        <tr >
                <td scope="row">1</td>
                <td><?= $item->nomor_nota; ?></td>
                <td><?= $item->nama_barang; ?></td>
                <td><?= $item->nama_satuan; ?></td>
                <td><?= $item->harga_jual; ?></td>
                <td><?= $item->subtotal; ?></td>
                <td><?= $item->tanggal; ?></td>
        </tr>
        <?php 
        }
    }
    ?>
            </tbody>
        </table>
    </body>
</html>