<!-- Default box -->
<div class="card">

    <div class="card-body">

        <form action="" method="post">



            <div class="card card-info">


                <div class="card-body">
                    <div class="tab-content">

                        <div class="form-group">
                            <label class="required" for="title">Пароль</label>
                            <input type="text" name="password" class="form-control" id="title" placeholder="Логин" value="<?= $user['password'] ?>">
                        </div>

                        <div class="form-group">
                            <label class="" for="week">Роль</label>

                            <select class="form-control" name="role" id="week" required="required">
                                <option <?php if($user['role'] == 'superadmin'): echo 'selected'; endif;?> value="superadmin">
                                    Супер-админ</option>
                                <option <?php if($user['role'] == 'admin'): echo 'selected'; endif;?> value="admin">
                                    Админ</option>
                                <option <?php if($user['role'] == 'user'): echo 'selected'; endif;?> value="user">
                                    Пользователь</option>


                            </select>

                        </div>


                        <div class="form-group">
                            <label class="" for="category">Компания</label>
                            <select class="form-control" name="company_id" id="category" required="required">
                                <option value="0">Не выбрано</option>

                                <?php foreach($entities as $entity):?>

                                    <?php
                                    $selected = '';
                                        $selected = ($user['company_id'] == $entity['id']) ? 'selected' : '';
                                    ?>
                                    <option <?= $selected ?> value="<?= $entity['id']?>">
                                        <?= $entity['name']?></option>
                                <?php endforeach;?>


                            </select>

                        </div>


                    </div>
                </div>
                <!-- /.card -->
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
