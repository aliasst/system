<!-- Default box -->
<div class="card">

    <div class="card-body">

        <form action="" method="post">



            <div class="card card-info">


                <div class="card-body">
                    <div class="tab-content">


                                <div class="form-group">
                                    <label class="required" for="title">Наименование</label>
                                    <input type="text" name="name" class="form-control" id="title" placeholder="Наименование" value="" >
                                </div>


                    </div>
                </div>
                <!-- /.card -->
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>

            <br><br>
            <?php if (isset($_GET['type']) & $_GET['type'] == 'legal') { ?>
            <a href="/legal-entities" class="btn btn-default">Вернуться назад</a>
            <?php }  else { ?>
                <a href="/physical-entities" class="btn btn-default">Вернуться назад</a>
            <?php }  ?>

        </form>

        <?php
        if (isset($_SESSION['form_data'])) {
            unset($_SESSION['form_data']);
        }
        ?>

    </div>

</div>
<!-- /.card -->
