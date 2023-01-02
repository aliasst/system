<!-- Default box -->
<div class="card">

    <div class="card-body">

        <form action="" method="post">



            <div class="card card-info">


                <div class="card-body">
                    <div class="tab-content">


                        <div class="form-group">
                            <label class="required" for="title">Логин</label>
                            <input type="text" name="login" class="form-control" id="title" placeholder="Логин" value="" >
                        </div>

                        <div class="form-group">
                            <label class="required" for="title">Пароль</label>
                            <input type="text" name="password" class="form-control" id="title" placeholder="Логин" value="">
                        </div>

                        <div class="form-group">
                            <label class="" for="week">Роль</label>

                            <select class="form-control" name="role" id="week" required="required">
                                <option value="superadmin">
                                    Супер-админ</option>
                                <option value="admin">
                                    Админ</option>
                                <option value="user">
                                    Пользователь</option>


                            </select>

                        </div>


                    </div>
                </div>
                <!-- /.card -->
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
            <br><br>
            <a href="/users" class="btn btn-default">Вернуться назад</a>

        </form>

        <?php
        if (isset($_SESSION['form_data'])) {
            unset($_SESSION['form_data']);
        }
        ?>

    </div>

</div>
<!-- /.card -->
