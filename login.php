<?php 

  $is_valide = false;

  if( $_SERVER['REQUEST_METHOD'] === "POST" ){
    
    $email = htmlspecialchars($_POST['email']);
    $lgoin_password = $_POST['password'];
    
    $mysqli = require_once "database.php";
    $query = sprintf( "SELECT * FROM users WHERE `email` = '%s'", $mysqli->real_escape_string($email) );
    
    $result = $mysqli->query( $query );
    $user = $result->fetch_assoc();
    
    if( $user ){
      if( password_verify( $lgoin_password, $user['password_hash'] ) ){
        echo "Login successful";
        exit;
      }
    }

    $is_valide = true;
  }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    
    <h1>Login</h1>
    <?php if( $is_valide ){ ?>
      <em>Invalid Login</em>
    <?php } ?>
    <form method="post">
        <label for="email">email</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($_POST['email']); ?>">
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        
        <button>Log in</button>
    </form>
    
</body>
</html>