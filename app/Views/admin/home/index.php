<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col">
        <table>
            <thead>
                <tr>
                    <th>nama</th>
                    <th>email</th>
                    <th>role</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u ) :?>
                    <tr>
                        <td>
                            <?= $u['name']; ?>
                        </td>
                        <td>
                            <?= $u['email']; ?>
                        </td>
                        <td>
                            <?= $u['role']; ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>