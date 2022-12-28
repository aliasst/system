<!-- Default box -->
<div class="card">

    <div class="card-header">
        <a href="<?= PATH ?>/entity/add/?type=physical" class="btn btn-default btn-flat"><i class="fas fa-plus"></i> Добавить новое физическое лицо</a>
    </div>

    <div class="card-body">
        <?php if (!empty($entities)): ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Наименование</th>
                        <th>Добавлено</th>
                        <th><i class="fas fa-plus-square"></i></th>
                        <th><i class="far fa-eye"></i></th>
                        <th><i class="far fa-trash-alt"></i></th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($entities as $entity): ?>
                        <tr <?php if ($entity['id']) echo 'class=""' ?>>
                            <td width="50"><?= $entity['id'] ?></td>
                            <td>
                                <?= $entity['name'] ?>
                            </td>
                            <td><?= $entity['created_at'] ?></td>
                            <td width="50">
                                <a class="btn btn-info btn-sm" href="<?= PATH ?>/addexpenses/<?= $entity['id']?>/?per=week">
                                    <i class="fas fa-plus-square"></i>
                                </a>
                            </td>
                            <td width="50">
                                <a class="btn btn-info btn-sm"
                                   href="<?= PATH ?>/viewexpenses/<?= $entity['id']?>/?per=week">
                                    <i class="far far fa-eye"></i>
                                </a>
                            </td>
                            <td width="50">
                                <a class="btn btn-danger btn-sm delete"
                                   href="<?= PATH ?>/entity/delete/<?= $entity['id']?>/">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>



        <?php else: ?>
            <p>Ничего не найдено...</p>
        <?php endif; ?>

    </div>
</div>
<!-- /.card -->
