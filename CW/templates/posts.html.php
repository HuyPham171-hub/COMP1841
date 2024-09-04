<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
    <style>
        .container {
            margin-top: 20px;
        }

        .border-start {
            border-left: 1px solid #dee2e6 !important;
        }

        .border-end {
            border-right: 1px solid #dee2e6 !important;
        }

        .question-title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .post-meta {
            font-size: 14px;
            color: #6c757d;
        }

        .post-content {
            margin-bottom: 20px;
        }

        .comment-actions {
            margin-top: 15px;
        }

        .comment-actions .btn {
            margin-right: 10px;
        }

        .comment-content {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 border-start border-end">
               
                <h1 class="question-title"><?= htmlspecialchars($post['title']) ?></h1>

              
                <div class="post-meta">
                    <div>Created at: <?= htmlspecialchars($post['created_at']) ?></div>
                    <div>Updated at: <?= htmlspecialchars($post['updated_at']) ?></div>
                    <div>Username: <?= htmlspecialchars($post['username']) ?></div>
                </div>

              
                <div class="post-content">
                    <p><?= htmlspecialchars($post['content']) ?></p>
                </div>

              
                <?php if (!empty($post['image_url'])): ?>
                    <div class="mb-3">
                        <img src="../images/<?= htmlspecialchars($post['image_url']) ?>" alt="Image" class="img-fluid">
                    </div>
                <?php endif; ?>
                 
                
                 <div>
                    <a href="edit_post.php?post_id=<?= $post['post_id'] ?>" class="btn btn-primary">Edit</a>
                    <form action="delete_post.php" method="post" style="display: inline;">
                        <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>

             
                <div class="text-center">
                    <a href="#" class="badge bg-primary"><?= htmlspecialchars($post['module_name']) ?></a>
                </div>

               
                <div class="mt-4">
                    <h3 class="mb-3">Comments</h3>
                    
                    <form action="#" method="post" class="mb-3">
                        <div class="mb-3">
                            <label for="comment" class="form-label">Your Comment:</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="post_id" value="<?= htmlspecialchars($post['post_id']) ?>">
                        <button type="submit" name="submit_comment" class="btn btn-primary">Submit</button>
                    </form>

            
                    <?php foreach ($comments as $comment): ?>
                        <div class="border p-3 mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <div><strong><?= htmlspecialchars($comment['username']) ?></strong></div>
                                <div><small>Posted on <?= htmlspecialchars($comment['created_at']) ?></small></div>
                            </div>
                            <div class="comment-content">
                                <p><?= htmlspecialchars($comment['content']) ?></p>
                            </div>
                          
                            <div class="comment-actions">
                                <a href="edit_comment.php?comment_id=<?= $comment['answer_id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                <form action="../pages/delete_comment.php" method="post" class="d-inline">
                                    <input type="hidden" name="comment_id" value="<?= $comment['answer_id'] ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
