<?php if ($pager->hasPreviousPage()): ?>
    <a href="<?= $pager->getFirst() ?>" class="px-3 py-1 border rounded-l bg-white hover:bg-gray-100">Awal</a>
    <a href="<?= $pager->getPreviousPage() ?>" class="px-3 py-1 border bg-white hover:bg-gray-100">Sebelumnya</a>
<?php endif ?>

<?php foreach ($pager->links() as $link): ?>
    <a href="<?= $link['uri'] ?>" class="px-3 py-1 border <?= $link['active'] ? 'bg-blue-500 text-white' : 'bg-white hover:bg-gray-100' ?>">
        <?= $link['title'] ?>
    </a>
<?php endforeach ?>

<?php if ($pager->hasNextPage()): ?>
    <a href="<?= $pager->getNextPage() ?>" class="px-3 py-1 border bg-white hover:bg-gray-100">Selanjutnya</a>
    <a href="<?= $pager->getLast() ?>" class="px-3 py-1 border rounded-r bg-white hover:bg-gray-100">Sebelumnya</a>
<?php endif ?>
