<!-- Default box -->
<div class="card">

    <div class="card-header">
        <a class="btn <?php if($per == 'month'){echo 'btn-info';}else{echo 'btn-default';}?> btn-flat" href="<?= PATH ?>/addexpenses/<?= $entity['id']?>/?per=month ">
            <i class="fas fa-plus-square"></i> За месяц
        </a>
        <a class="btn <?php if($per == 'week'){echo 'btn-info';}else{echo 'btn-default';}?> btn-flat" href="<?= PATH ?>/addexpenses/<?= $entity['id']?>/?per=week ">
            <i class="fas fa-plus-square"></i> За неделю
        </a>
        <a class="btn <?php if($per == 'day'){echo 'btn-info';}else{echo 'btn-default';}?> btn-flat" href="<?= PATH ?>/addexpenses/<?= $entity['id']?>/?per=day ">
            <i class="fas fa-plus-square"></i> За день
        </a>


    </div>


    <div class="card-body">


        <form action="" method="post">


            <div class="form-group">
                <label class="" for="category">Категория расходов</label>
                <select class="form-control" name="category" id="category" required="required">
                    <?php foreach($categories as $category):?>
                        <option value="<?= $category['id']?>">
                            <?= $category['name']?></option>
                    <?php endforeach;?>


                </select>

            </div>

            <div class="form-group">
                <label class="" for="year">Год</label>
                <?php
                $yearCurrent = date ("Y");
                $yearArray = range(2021, $yearCurrent + 1);
                ?>
                <!-- выводим выпадающий список -->
                <select class="form-control" name="year" id="year" required="required" >
                    <?php
                    foreach ($yearArray as $year) {
                        // если вы хотите выбрать конкретный год
                        $selected = ($year == $yearCurrent) ? 'selected' : '';
                        echo '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label class="" for="month">Месяц</label>
                <select class="form-control" name="month" id="month" required="required">
                    <option value="1">
                        Январь</option>
                    <option value="2">
                        Февраль</option>

                    <option value="3">
                        Март</option>

                    <option value="4">
                        Апрель</option>

                    <option value="5">
                        Май</option>

                    <option value="6">
                        Июнь</option>

                    <option value="7">
                        Июль</option>

                    <option value="8">
                        Август</option>

                    <option value="9">
                        Сентябрь</option>

                    <option value="10">
                        Октябрь</option>

                    <option value="11">
                        Ноябрь</option>

                    <option value="12">
                        Декабрь</option>
                </select>

            </div>

            <?php if($per == 'week'){ ?>
                <div class="form-group">
                    <label class="" for="week">Неделя</label>
                    <select class="form-control" name="week" id="week" required="required">
                        <option value="1">
                            1 неделя</option>
                        <option value="2">
                            2 неделя</option>

                        <option value="3">
                            3 неделя</option>

                        <option value="4">
                            4 неделя</option>

                        <option value="5">
                            5 неделя</option>
                    </select>

                </div>
            <?php } ?>



            <?php if($per == 'day'){ ?>
                <div class="form-group">
                    <label for="day">День</label>
                    <input type="text" name="day" class="form-control" id="day" placeholder="День" value="1">
                </div>
                <?php } ?>





            <div class="form-group">
                <label for="sum">Расход</label>
                <input type="text" name="sum" class="form-control" id="description" placeholder="Расход" value="">
            </div>



            <button type="submit" class="btn btn-primary">Сохранить</button>

        </form>

        <?php
        if (isset($_SESSION['form_data'])) {
            unset($_SESSION['form_data']);
        }
        ?>

    </div>
</div>
<!-- /.card -->
