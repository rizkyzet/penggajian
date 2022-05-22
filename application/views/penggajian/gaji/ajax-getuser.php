<table class="table table-striped" id="table-gaji">
    <thead>
        <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Total Gaji</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        foreach ($gaji as $g) : ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $g['nip'] ?></td>
                <td><?= $g['nama'] ?></td>
                <td><?= $g['bulan'] ?></td>
                <td><?= $g['tahun'] ?></td>
                <td><?= rupiah($g['total_gaji']) ?></td>
                <td>
                    <a class="btn btn-info" href="<?= base_url('/gaji/detail/' . $g['idnya_gaji']) ?>">Detail</a>
                    <a class="btn btn-primary" href="<?= base_url('/gaji/edit/' . $g['idnya_gaji']) ?>">Edit</a>
                    <a class="btn btn-danger" href="<?= base_url('/gaji/delete/' . $g['idnya_gaji']) ?>" onclick="return confirm('yakin ingin hapus?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>