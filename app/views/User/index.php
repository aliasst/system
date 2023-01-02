
<!-- Default box -->
<div class="card">




    <div class="card-header">
        <a href="<?= PATH ?>/user/add" class="btn btn-default btn-flat"><i class="fas fa-plus"></i> Добавить пользователя</a>
    </div>

    <div class="card-body">
        <?php if (!empty($users)): ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Login</th>
                        <th>Роль</th>

                        <th><i class="far fa-edit"></i></th>
                        <th><i class="far fa-trash-alt"></i></th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr <?php if ($user['id']) echo 'class=""' ?>>
                            <td width="50"><?= $user['id'] ?></td>
                            <td>
                                <?= $user['name'] ?>
                            </td>
                            <td><?= $user['role'] ?></td>

                            <td width="50">
                                <a class="btn btn-info btn-sm"
                                   href="<?= PATH ?>/user/edit/<?= $user['id']?>/">
                                    <i class="far far fa-edit"></i>
                                </a>
                            </td>
                            <td width="50">
                                <a class="btn btn-danger btn-sm delete"
                                   href="<?= PATH ?>/user/delete/<?= $user['id']?>/">
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


