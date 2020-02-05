<div class="add-task">
    <h1>Новое задание</h1>
    <form id="add-task-form"  enctype="multipart/form-data" action="/task/add"  method="post">
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
        <button type="submit" class="btn btn-primary" id="add-task-btn">Добавить задание</button>
    </form>
</div>
