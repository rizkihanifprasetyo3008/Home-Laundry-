<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <title>HomeLaundry Admin</title>
</head>

<body>

    <body class="bg-light">
        <header>
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <h1>HomeLaundry</h1>
                            <p>Admin HomeLaundry</p>
                        </div>
                        <div class="col-md-4">
                            
                            <?php
                            if (isset($_SESSION['admin'])) : ?>
                                <a>Welcome, <?php echo  $_SESSION["admin"]["name"] ?></a>
                                <a class="btn btn-danger " href="logout.php">Log Out</a>
                            <?php else : ?>
                                <a href="login.php" class="btn btn-secondary">Log In</a>
                                <a href="register.php" class="btn btn-success">Register</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </body>