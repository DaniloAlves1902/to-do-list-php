<?php
require_once("database/conn.php");

$tasks = [];

$sql = $pdo->query("SELECT * FROM task ORDER BY id ASC");

if ($sql->rowCount() > 0) {
    $tasks = $sql->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>To Do List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="src/styles/styles.css" />
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
</head>

<body>
    <div id="to_do">
        <h1>To Do List</h1>

        <!-- Formulário principa -->
        <form action="actions/create.php" method="POST" class="to-do-form">
            <input
                type="text"
                name="description"
                placeholder="Write your task here"
                required />

            <button type="submit" class="form-button">
                <i class="fa-solid fa-plus"></i>
            </button>
        </form>

        <?php foreach ($tasks as $task): ?>
            <div id="tasks">
                <div class="task">
                    <input
                        type="checkbox"
                        name="progress"
                        class="progress <?= $task['completed'] ? 'done' : '' ?>"
                        data-task-id="<?= $task['id'] ?>"
                        <?= $task['completed'] ? 'checked' : '' ?> />

                    <p class="task-description">
                        <?= $task['description'] ?>
                    </p>

                    <div class="task-actions">
                        <a class="action-button edit-button">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <a
                            href="actions/delete.php?id=<?= $task['id'] ?>"
                            class="action-button delete-button">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>

                    <form
                        action="actions/update.php"
                        class="to-do-form edit-task hidden"
                        method="POST">

                        <input
                            type="text"
                            class="hidden"
                            name="id"
                            value="<?= $task['id'] ?>">

                        <input
                            type="text"

                            name="description"
                            placeholder="Edit your task here"
                            value="<?= $task['description'] ?>" />
                        <button type="submit" class="form-button confirm-button">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>

            </div>

    </div>

    <script src="./src/js/script.js"></script>
</body>

</html>