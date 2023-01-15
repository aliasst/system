
<!-- Default box -->
<div class="card">


    <div class="card-header">

        <a href="<?= PATH ?>/currency/add" class="btn btn-default btn-flat"><i class="fas fa-plus"></i> Добавить валюту</a>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered"><tbody>
                <?php foreach($currencies as $currency):?>
                <tr>
                    <td>
                        <?= $currency['name']?>
                    </td>
                    <td>
                        <?= $currency['short_name']?>
                    </td>
                    <!--<td width="50"><a class="btn btn-info btn-sm" href="<?= PATH ?>/category/edit?id=1"><i class="fas fa-pencil-alt"></i></a></td>-->
                    <td width="50"><a class="btn btn-danger btn-sm delete" href="<?= PATH ?>/currency/delete/<?= $currency['id']?>"><i class="far fa-trash-alt"></i></a></td>
                </tr>
                <?php endforeach;?>

                </tbody></table>

        </div>

    </div>

</div>
<!-- /.card -->