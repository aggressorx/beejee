<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/styles/bootstrap.min.css">
    <link rel="stylesheet" href="/styles/style.css">
    <title>Задания</title>
</head>
<body>
<div class="container">
    <div class="row">
            <div class="col-md-10">
                    <a class="btn btn-primary" id="btn-show-form-task" href="/task/add">Добавить задание</a>
                    <a class="btn btn-primary" id="btn-show-form-task" href="/">Список заданий</a>
<!--                    <button type="button" class="btn btn-primary" id="btn-show-form-task">Добавить задание</button>-->
                    <div class="user-auth float-lg-right">
                        <?php if (!empty($_SESSION['user'])): ?>
                            <span><?= $_SESSION['user']['login']; ?></span>
                            <a href="/user/logout" class="logout" id="btn-out-auth">[Выход]</a>
                        <?php else: ?>
                            <a href="/user/login" id="btn-form-auth">Авторизация</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="alert-success"><?= ($_SESSION['success']) ? $_SESSION['success'] : ''; ?></div>
                    <div class="alert-danger"><?= ($_SESSION['error']) ? $_SESSION['error'] : ''; ?></div>
                    <?php unset($_SESSION['success']); ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
<!--        </header>-->
    </div>

    <div class="row">
        <div class="col-md-10">
            <?php echo $content; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <footer class="footer">
            </footer>
        </div>

    </div>
</div>

<!--Модалка добавления нового задания-->
<div class="modal fade" id="modal-form-task" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Создать новое задание</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-task-form"  enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="user-name" class="col-form-label">Имя пользователя</label>
                        <input type="text" class="form-control" name="name" id="user-name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                               placeholder="name@domen.com" required>
                        <div class="invalid-feedback">Please enter a valid email address.</div>
                    </div>
                    <div class="form-group">
                        <label for="task-text" class="col-form-label">Текст задания:</label>
                        <textarea class="form-control" id="task-text" name="task" rows="5" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть окно</button>
                <button type="submit" class="btn btn-primary" id="add-task-btn">Добавить задание</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Форма аторизации</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="user-data-form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="user-name" class="col-form-label">Имя пользователя</label>
                        <input type="text" class="form-control" name="login" id="user-name" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-message-error">

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть окно</button>
                <button type="button" class="btn btn-primary" id="btn-auth">Авторизоваться</button>
            </div>
        </div>
    </div>
</div>


<script src="/scripts/jquery-3.4.1.min.js"></script>
<script src="/scripts/bootstrap.bundle.min.js"></script>
<script src="/scripts/script.js"></script>


</body>
</html>