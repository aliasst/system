<!-- Default box -->
<div class="card">




    <div class="card-body">


        <form id="viewexp" action="" method="post">
            <input type="hidden" name="entity" value="<?= $entity['id'] ?>">

            <div class="form-group">
                <label class="" for="category">Категория расходов</label>
                <select class="form-control" name="category" id="category" required="required">
                    <option value="1">Без категории</option>

                    <?php foreach($categories as $category):?>

                        <?php
                        $selected = '';
                        if(isset($_SESSION['form_data']['category'])){
                            $selected = ($_SESSION['form_data']['category'] == $category['id']) ? 'selected' : '';
                        }
                        ?>
                        <option <?= $selected ?> value="<?= $category['id']?>">
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
                        if(isset($_SESSION['form_data']['year'])){
                            $selected = ($year == $_SESSION['form_data']['year']) ? 'selected' : '';
                        }

                        echo '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label class="" for="month">Месяц</label>
                <?php

                if(isset($_SESSION['form_data']['month'])){
                    $selected = $_SESSION['form_data']['month'];
                } else {
                    $selected = '';
                }
                ?>
                <select class="form-control" name="month" id="month" required="required">
                    <option <?php if($selected == 1) : echo 'selected'; endif;?> value="1">
                        Январь</option>
                    <option <?php if($selected == 2): echo 'selected'; endif;?> value="2">
                        Февраль</option>

                    <option <?php if($selected == 3): echo 'selected'; endif;?> value="3">
                        Март</option>

                    <option <?php if($selected == 4): echo 'selected'; endif;?> value="4">
                        Апрель</option>

                    <option <?php if($selected == 5): echo 'selected'; endif;?> value="5">
                        Май</option>

                    <option <?php if($selected == 6): echo 'selected'; endif;?> value="6">
                        Июнь</option>

                    <option <?php if($selected == 7): echo 'selected'; endif;?> value="7">
                        Июль</option>

                    <option <?php if($selected == 8): echo 'selected'; endif;?> value="8">
                        Август</option>

                    <option <?php if($selected == 9): echo 'selected'; endif;?> value="9">
                        Сентябрь</option>

                    <option <?php if($selected == 10): echo 'selected'; endif;?> value="10">
                        Октябрь</option>

                    <option <?php if($selected == 11): echo 'selected'; endif;?> value="11">
                        Ноябрь</option>

                    <option <?php if($selected == 12): echo 'selected'; endif;?> value="12">
                        Декабрь</option>
                </select>

            </div>


            <div class="form-group">
                <label class="" for="week">Неделя</label>
                <?php

                if(isset($_SESSION['form_data']['week'])){
                    $selected = $_SESSION['form_data']['week'];
                } else {
                    $selected = '';
                }
                ?>
                <select class="form-control" name="week" id="week" required="required">
                    <option <?php if($selected == 6): echo 'selected'; endif;?> value="6">
                        Весь месяц</option>
                    <option <?php if($selected == 1): echo 'selected'; endif;?> value="1">
                        1 неделя</option>
                    <option <?php if($selected == 2): echo 'selected'; endif;?> value="2">
                        2 неделя</option>

                    <option <?php if($selected == 3): echo 'selected'; endif;?> value="3">
                        3 неделя</option>

                    <option <?php if($selected == 4): echo 'selected'; endif;?> value="4">
                        4 неделя</option>

                    <option <?php if($selected == 5): echo 'selected'; endif;?> value="5">
                        5 неделя</option>
                </select>

            </div>




            <button type="submit" class="btn btn-primary">Показать</button>



        </form>

        <?php
        if (isset($_SESSION['form_data'])) {
            unset($_SESSION['form_data']);
        }
        ?>

    </div>






    <div class="card-body">


        <?php if (!empty($sortexpenses)): ?>
        <?php foreach ($sortexpenses as $key => $expenses):

                ?>

                <H4>  <?= $key ?></H4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Месяц</th>
                            <th>Неделя</th>
                            <th>Год</th>
                            <th>Cумма</th>

                            <th><i class="far fa-trash-alt"></i></th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sum = 0;
                        foreach ($expenses as $expense):
                            $sum = $sum + $expense['sum'];
                            ?>
                            <tr>
                                <td width="70"><?= $expense['month_name'] ?></td>
                                <td width="70"><?php if($expense['week']) echo $expense['week_name']; ?></td>
                                <td width="70"><?= $expense['year'] ?> г.</td>
                                <td width="120"><?= $expense['sum'] ?> <?= $expense['short_name'] ?></td>


                                <td width="70">
                                    <a class="btn btn-danger btn-sm delete"
                                       href="<?= PATH ?>/deleteexpenses/<?= $expense['id']?>/">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="5"><b>Итого: <?= $sum; ?></b></td>
                        </tr>
                        </tbody>
                    </table>

                </div>



            <?php endforeach; ?>




            <a href="" class="ex-export-js btn btn-primary">Экспорт в Excel</a>



        <?php elseif (!empty($expenses)): ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Cумма</th>
                        <th>Категория</th>

                        <th>Неделя</th>
                        <th>Месяц</th>
                        <th>Год</th>

                        <th><i class="far fa-trash-alt"></i></th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($expenses as $expense):

                        ?>
                        <tr>
                            <td width="120"><?= $expense['sum'] ?> <?= $expense['short_name'] ?></td>
                            <td>
                                <?= $expense['name'] ?>
                            </td>
                            <td width="70"><?php if($expense['week']) echo $expense['week_name']; ?></td>
                            <td width="70"><?= $expense['month_name'] ?></td>
                            <td width="70"><?= $expense['year'] ?> г.</td>
                           

                            <td width="70">
                                <a class="btn btn-danger btn-sm delete"
                                   href="<?= PATH ?>/deleteexpenses/<?= $expense['id']?>/">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <a href="" class="ex-export-js-week btn btn-primary">Экспорт в Excel</a>


        <?php endif; ?>

    </div>










</div>
<!-- /.card -->
