<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4">Edit Post</h1>
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Post Title:</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Post Content:</label>
                        <textarea class="form-control" id="content" name="content" rows="10"><?= htmlspecialchars($post['content']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Select New Image:</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
