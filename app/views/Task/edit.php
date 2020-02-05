<div class="add-task">
    <h1>Редактирование задания</h1>
    <form id="add-task-form" enctype="multipart/form-data" action="/task/edit" method="post">
        <div class="form-group">
            <label for="user-name" class="col-form-label">Имя пользователя</label>
            <input type="text" class="form-control" name="name" id="user-name"
                   value="<?= $arResult['data']['name'] ?? null; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="<?= $arResult['data']['email'] ?? null; ?>" required>
            <div class="invalid-feedback">Укажите верный email.</div>
        </div>
        <div class="form-group">
            <label for="task-text" class="col-form-label">Текст задания:</label>
            <textarea class="form-control" id="task-text" name="task" rows="5"
                      required><?= $arResult['data']['task'] ?? null; ?></textarea>
        </div>

        <div class="form-group form-check">
            <input type="checkbox" name="status" class="form-check-input" id="status" value="1"
                   <?= (!empty($arResult['data']['status'])) ? 'checked' : ''; ?> >
            <label class="form-check-label" for="status">Статус</label>
        </div>
        <input type="hidden" name="id"value="<?= $arResult['data']['id']; ?>" >
        <button type="submit" class="btn btn-primary">Применить изменения</button>
    </form>
</div>
