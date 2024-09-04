<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/COMP1841/CW/pages/home.php">GWER Forum</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/COMP1841/CW/pages/home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/COMP1841/CW/pages/posts.php">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/COMP1841/CW/pages/create_post.php">Ask Question</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/COMP1841/CW/pages/manage_modules.php">Manage Modules</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/COMP1841/CW/pages/manage_users.php">Manage Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/COMP1841/CW/pages/admin_message.php">User Messages</a>               
            </ul>
            <!-- Logout button form -->
            <form class="d-flex ms-auto" action="/COMP1841/CW/pages/logout.php" method="post">
                <button class="btn btn-outline-danger" type="submit">Logout</button>
            </form>
        </div>
    </div>
</nav>

    <main class="container mt-4">
        <h1><?=$title?></h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <th scope="row"><?=$user['user_id']?></th>
                        <td><?=$user['username']?></td>
                        <td><?=$user['email']?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="delete_user_id" value="<?=$user['user_id']?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    
</body>
</html>
