
<!-- Default box -->
<div class="card">




    <div class="card-header">
        <H5 style="margin-bottom:20px;">Категории расходов для юридических лиц</H5>

        <a href="<?= PATH ?>/category/add?type=1" class="btn btn-default btn-flat"><i class="fas fa-plus"></i> Добавить категорию</a>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered"><tbody>
                <?php foreach($categories_1 as $category):?>
                <tr>
                    <td>
                        <?= $category['name']?>
                    </td>
                    <!--<td width="50"><a class="btn btn-info btn-sm" href="<?= PATH ?>/category/edit?id=1"><i class="fas fa-pencil-alt"></i></a></td>-->
                    <td width="50"><a class="btn btn-danger btn-sm delete" href="<?= PATH ?>/category/delete/<?= $category['id']?>"><i class="far fa-trash-alt"></i></a></td>
                </tr>
                <?php endforeach;?>

                </tbody></table>

        </div>

    </div>

</div>

<div class="card">
    <div class="card-header">
        <H5 style="margin-bottom:20px;">Категории расходов для физических лиц</H5>

        <a href="<?= PATH ?>/category/add?type=2" class="btn btn-default btn-flat"><i class="fas fa-plus"></i> Добавить категорию</a>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered"><tbody>
                <?php foreach($categories_2 as $category):?>
                    <tr>
                        <td>
                            <?= $category['name']?>
                        </td>
                        <!--<td width="50"><a class="btn btn-info btn-sm" href="<?= PATH ?>/category/edit?id=1"><i class="fas fa-pencil-alt"></i></a></td>-->
                        <td width="50"><a class="btn btn-danger btn-sm delete" href="<?= PATH ?>/category/delete/<?= $category['id']?>"><i class="far fa-trash-alt"></i></a></td>
                    </tr>
                <?php endforeach;?>

                </tbody></table>

        </div>

    </div>


</div>
<!-- /.card -->