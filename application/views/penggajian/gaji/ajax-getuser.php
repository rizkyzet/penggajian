<table class="table table-striped" id="table-gaji">
    <thead>
        <tr>
            <th>No</th>
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
                <th><?= $i++ ?></th>
                <th><?= $g['nama'] ?></th>
                <th><?= $g['bulan'] ?></th>
                <th><?= $g['tahun'] ?></th>
                <th><?= $g['total_gaji'] ?></th>
                <th></th>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>