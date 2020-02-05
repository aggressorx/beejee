<h1>Текущие задания</h1>

<div class="sort">
    <div class="row">
        <div class="col-md-2">
            <span>Сортировка:</span>
        </div>
        <div class="col-md-10">
            <div class="sort-fields float-lg-right">
                <?php foreach ($arResult['sortFields'] as $field => $title): ?>
                    <span class="ml-3"><?= $title; ?></span>
                    <a class="sort-arrow arrow-down" href="<?= $arResult['urlNoSort'] ?>&sort=<?= $field; ?>">
                        <img src="/images/arrow/arrow.png" alt="Сортировка по возрастанию"
                             title="Сортировка по возрастанию <?= mb_strtolower($title); ?>">
                    </a>
                    <a class="sort-arrow arrow-up" href="<?= $arResult['urlNoSort'] ?>&sort=<?= $field; ?>&order=desc">
                        <img src="/images/arrow/arrow.png" alt="Сортировка по убыванию"
                             title="Сортировка по убыванию <?= mb_strtolower($title); ?>">

                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>


<div class="task-records">
    <?php foreach ($arResult['data'] as $data) : ?>
        <div class="task">
            <div class="user-info alert alert-primary">
                <div class="name">
                    <span>Пользователь:</span>
                    <span><?= $data['name']; ?></span>
                </div>
                <div class="email">
                    (<span>email:</span>
                    <span><?= $data['email']; ?></span>)
                </div>
                <div class="task-text">
                    <div class="alert alert-light">
                        <?= $data['task']; ?>
                    </div>
                </div>
                <?php if ($arResult['role'] === 'admin'): ?>
                    <div class="edit-task">
                        <a href="/task/edit?id=<?= $data['id']; ?>">Редактировать</a>
                    </div>
                <?php endif; ?>
                <div class="task-status">
                    <?php if (empty($data['status'])): ?>
                        <div class="alert-warning">
                            <span>Статус: не выполнено</span>
                        </div>
                    <?php else: ?>
                        <div class="alert-success">
                            <span>Статус: выполнено</span>

                        </div>
                    <?php endif; ?>
                    <?php if ($data['write_admin']): ?>
                        <div class="write-admin mt-1">
                            <span> Правлено администратором!</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<nav>
    <?= $arResult['pagination']; ?>
</nav>


