<?= $this->include('templates/auth/header') ?>

<div class="card-body">
    <div id="flash" style="display: none;">
        <?= session()->flash; ?>
    </div>
    <?= $this->renderSection('content'); ?>
</div>

<?= $this->include('templates/auth/footer') ?>