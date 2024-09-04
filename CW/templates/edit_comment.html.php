
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comment</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z24q2+jtw7kXt/dJg/yJ79T2k9Bqs7ibJv3+Tk" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="card-title">Edit Comment</h5>
            </div>
            <div class="card-body">
                <form action="edit_comment.php?comment_id=<?= htmlspecialchars($comment_id) ?>" method="post">
                    <div class="mb-3">
                        <label for="content" class="form-label">Comment:</label>
                        <textarea class="form-control" id="content" name="content" rows="5"><?= htmlspecialchars($comment['content']) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
