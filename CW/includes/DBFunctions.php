<?php
##QUERY FUNCTION##
function query($pdo, $sql, $parameters = []) 
{
	$query = $pdo->prepare($sql);
	$query->execute($parameters);
	return $query;
}

##ALL POSTS##
function allPosts($pdo) 
{
	$posts = query($pdo, 'SELECT p.post_id,p.title, p.content, p.image_url, p.created_at, p.updated_at, username, module_name FROM posts AS p
	INNER JOIN users AS u ON p.user_id = u.user_id
	INNER JOIN modules AS m ON p.module_id = m.module_id');

	return $posts->fetchAll();
}

##GET POST##
function getPost($pdo, $post_id) 
{
	$parameters = [':post_id' => $post_id];
	$query = query($pdo, 'SELECT posts.*, users.username, modules.module_name FROM posts
	LEFT JOIN users ON posts.user_id = users.user_id
	LEFT JOIN modules ON posts.module_id = modules.module_id
	WHERE posts.post_id = :post_id', $parameters);
	return $query->fetch();
}

##TOTAL POSTS##
function totalPost($pdo) 
{
	$query = query($pdo, 'SELECT COUNT(*) FROM posts');
	$row = $query->fetch();
	return $row[0];
}

##INSERT POST##
function insertPost($pdo, $title, $content, $image_url, $user_id, $module_id) 
{
	$query = 'INSERT INTO posts (title, created_at, content, image_url, user_id, module_id)
	VALUES (:title, CURDATE(), :content , :image_url , :user_id, :module_id)';
	$parameters = [':title' => $title, ':content' => $content , ':image_url' => $image_url , ':user_id' => $user_id, ':module_id' => $module_id];
	query($pdo, $query, $parameters);
}

##UPDATE POST##
function updatePost($pdo, $post_id, $title, $content, $image_url) 
{
    $query = 'UPDATE posts SET title = :title, content = :content, image_url = :image_url, updated_at = NOW() WHERE post_id = :post_id';
    $parameters = [':title' => $title, ':content' => $content, ':image_url' => $image_url, ':post_id' => $post_id];
    query($pdo, $query, $parameters);
}
##DELETE POST##
function deletePost($pdo, $post_id) 
{
    try {
        // Begin a transaction
        $pdo->beginTransaction();
        
        // Delete associated records from the answers table
        $parameters = [':post_id' => $post_id];
        query($pdo, 'DELETE FROM answers WHERE post_id = :post_id', $parameters);
        
        // Delete the post
        query($pdo, 'DELETE FROM posts WHERE post_id = :post_id', $parameters);
        
        // Commit the transaction
        $pdo->commit();
    } catch (PDOException $e) {
        // Roll back the transaction if an error occurs
        $pdo->rollBack();
        throw $e; // Re-throw the exception to be handled higher up
    }
}


##ALL USERS##
function allUsers($pdo) 
{
	$authors = query($pdo, 'SELECT * FROM users');
	return $authors->fetchAll();
}

##ALL MODULES##
function allModules($pdo) 
{
    // Check if $pdo is not null before using it
    if ($pdo !== null) {
        $query = query($pdo, 'SELECT * FROM modules');
        return $query->fetchAll();
    } else {
        // Handle the case when $pdo is null (optional)
        return array();
    }
}

// INSERT COMMENT
function insertComment($pdo, $content, $post_id, $user_id) 
{
    $query = 'INSERT INTO answers (content, post_id, user_id, created_at)
              VALUES (:content, :post_id, :user_id, NOW())'; // Use NOW() to get the current datetime
    $parameters = [
        ':content' => $content,
        ':post_id' => $post_id,
        ':user_id' => $user_id
    ];
    query($pdo, $query, $parameters);
}

// GET COMMENTS FOR POST
function getCommentsForPost($pdo, $post_id) {
    $query = 'SELECT answers.*, users.username 
              FROM answers
              INNER JOIN users ON answers.user_id = users.user_id
              WHERE post_id = :post_id';
    $parameters = [':post_id' => $post_id];
    $result = query($pdo, $query, $parameters);
    return $result->fetchAll();
}

//UPDATE CMT
function updateComment($pdo, $comment_id, $content) 
{
    $query = 'UPDATE answers SET content = :content, updated_at = NOW() WHERE answer_id = :answer_id';
    $parameters = [':content' => $content, ':answer_id' => $comment_id];
    query($pdo, $query, $parameters);
}

//DELETE CMT
function deleteComment($pdo, $comment_id) 
{
    $parameters = [':comment_id' => $comment_id];
    query($pdo, 'DELETE FROM answers WHERE answer_id = :comment_id', $parameters);
}

// UPDATE IMAGE PATH
function updateImage($pdo, $post_id, $image) 
{
    // Check if a new image is provided
    if ($image['error'] === UPLOAD_ERR_OK) {
        // Upload the new image
        $target_dir = "../images/";
        $target_file = $target_dir . basename($image["name"]);
        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            // Update the image URL in the database
            $image_url = $target_file;
            $query = 'UPDATE posts SET image_url = :image_url, updated_at = NOW() WHERE post_id = :post_id';
            $parameters = [':image_url' => $image_url, ':post_id' => $post_id];
            query($pdo, $query, $parameters);
            return $image_url;
        } else {
            // Error occurred while uploading the image
            return null;
        }
    } else {
        // No new image provided, return the existing image URL
        return null;
    }
}

//Get CMT
function getComment($pdo, $comment_id) 
{
    $query = 'SELECT answers.*, users.username 
              FROM answers
              INNER JOIN users ON answers.user_id = users.user_id
              WHERE answer_id = :comment_id';
    $parameters = [':comment_id' => $comment_id];
    $result = query($pdo, $query, $parameters);
    return $result->fetch();
}

// Function to get user by email
function getUserByEmail($pdo, $email) {
    $query = 'SELECT * FROM users WHERE email = :email';
    $parameters = [':email' => $email];
    $result = query($pdo, $query, $parameters);
    return $result->fetch();
}
// Function to delete a module by module_id
function deleteModule($pdo, $module_id) 
{
    try {
        $pdo->beginTransaction();

        // Delete the module
        $parameters = [':module_id' => $module_id];
        query($pdo, 'DELETE FROM modules WHERE module_id = :module_id', $parameters);

        // Commit the transaction
        $pdo->commit();
    } catch (PDOException $e) {
        // Roll back the transaction if an error occurs
        $pdo->rollBack();
        throw $e; // Re-throw the exception to be handled higher up
    }
}

// Function to add a new module
function addModule($pdo, $module_name) 
{
    try {
        // Insert the new module into the database
        $query = 'INSERT INTO modules (module_name) VALUES (:module_name)';
        $parameters = [':module_name' => $module_name];
        query($pdo, $query, $parameters);
    } catch (PDOException $e) {
        throw $e; // Re-throw the exception to be handled higher up
    }
}
// Function to delete a user from the users table
function deleteUser($pdo, $user_id) 
{
    // First, delete all messages related to the user
    $stmt = $pdo->prepare('DELETE FROM messages WHERE user_id = :user_id');
    $stmt->execute([':user_id' => $user_id]);

    // Then, delete all posts related to the user
    $stmt = $pdo->prepare('DELETE FROM posts WHERE user_id = :user_id');
    $stmt->execute([':user_id' => $user_id]);

    // Finally, delete the user
    $stmt = $pdo->prepare('DELETE FROM users WHERE user_id = :user_id');
    $stmt->execute([':user_id' => $user_id]);
}


// Function to insert a message into the messages table
function insertMessage($pdo, $message, $user_id) {
    $sql = "INSERT INTO messages (message_text, created_at, user_id) VALUES (:message, CURRENT_TIMESTAMP, :user_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':message', $message, PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
}
// Function to fetch all messages with associated username and email from the users table
function allMessages($pdo) {
    $stmt = $pdo->query("
        SELECT m.*, u.username, u.email
        FROM messages m
        INNER JOIN users u ON m.user_id = u.user_id
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function registerUser($pdo, $username, $email, $password) {
    try {
        $current_time = date('Y-m-d H:i:s'); // Current timestamp

        $sql = "INSERT INTO users (username, email, password, created_at, updated_at) 
                VALUES (:username, :email, :password, :created_at, :updated_at)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':created_at', $current_time);
        $stmt->bindParam(':updated_at', $current_time);

        return $stmt->execute();
    } catch (PDOException $e) {
        // Log the error or handle it as needed
        return false;
    }
}


?>