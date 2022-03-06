<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Aloha!</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }
    </style>

</head>

<body>

    <table width="100%">
        <tr>
            <td align="right">
                <h3>MTSN 3 Jakarta Selatan</h3>
                <pre>
                Jl. Pupan No.3 B, RT.5/RW.8, Pd. Pinang, Kec. Kby. 
                Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 
                12310
                +62 896 2320 0581
            </pre>
            </td>
        </tr>

    </table>


    <br />

    <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th scope="col">NIS</th>
                <th scope="col">Nama Siswa</th>
                <th scope="col">Nama Kelas</th>
                <th scope="col">Bulan bayar</th>
                <th scope="col">Tahun bayar</th>
                <th scope="col">Status</th>
                <th scope="col">jumlah pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php $total_bayar = 0; ?>
            <?php foreach ($read as $a) : ?>
                <tr>
                    <td><?php echo $a['nis'] ?></td>
                    <td><?php echo $a['nama'] ?></td>
                    <td><?php echo $a['nama_kelas'] ?></td>
                    <td><?php echo $a['bln_bayar'] ?></td>
                    <td><?php echo $a['thn_bayar'] ?></td>
                    <?php
                    $jumlah = $a['jumlah_bayar'];
                    $total_bayar += $jumlah;
                    ?>
                    <?php if ($a['status_pembayaran'] == 'Lunas') : ?>
                        <td><button class="btn btn-success"><?= $a['status_pembayaran']; ?></button></td>

                    <?php else : ?>
                        <td><button class="btn btn-warning"><?= $a['status_pembayaran']; ?></button></td>
                    <?php endif; ?>
                    <td><?php echo $a['jumlah_bayar'] ?></td>

                </tr>
            <?php endforeach; ?>

        </tbody>

        <tfoot>
            <tr>
                <td colspan="5"></td>
                <td align="right">Total Rp</td>
                <td align="right" class="gray"><?= $total_bayar; ?></td>
            </tr>
        </tfoot>
    </table>

</body>

</html>