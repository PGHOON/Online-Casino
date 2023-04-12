<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lance Login Successful</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
    <img src="logo_vector.png" alt="Logo" class="center">
    <div class="container">
        <h1>
            <?php foreach ($data as $logged_user) ?>
            <?php echo $logged_user['userName'] . $logged_user['password']; ?>
        </h1>
    </div>
</body>

</html>