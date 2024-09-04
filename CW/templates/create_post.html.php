<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>,
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<form action="" method="post" enctype="multipart/form-data" class="container mt-5">
    <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" id="title" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Content:</label>
        <textarea id="content" name="content" class="form-control" rows="6" required></textarea>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image:</label>
        <input type="file" id="image" name="image" class="form-control" accept="image/*">
    </div>

    <div class="mb-3">
        <label for="module" class="form-label">Module:</label>
        <select id="module" name="module" class="form-select" required>
            <option value="">Select a module</option>
            <?php foreach ($modules as $module): ?>
                <option value="<?= htmlspecialchars($module['module_id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <?= htmlspecialchars($module['module_name'], ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Add</button>
</form>

</body>
</html>