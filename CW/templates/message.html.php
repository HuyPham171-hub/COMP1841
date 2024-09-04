<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Page</title>
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
            <a class="nav-link" href="/COMP1841/CW/pages/message.php">Message</a>
            </li>
            <li class="nav-item dropdown">
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
            </li>
        </ul>
        <form class="d-flex ms-auto" action="/COMP1841/CW/pages/logout.php" method="post">
                <button class="btn btn-outline-danger" type="submit">Logout</button>
            </form>
        </div>
    </div>
    </nav>
    <form action="" method="post" class="container mt-5">
        <div class="mb-3">
            <label for="message" class="form-label">Message:</label>
            <textarea id="message" name="message" class="form-control" rows="6" required></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Send Message</button>
    </form>
</body>
</html>
