<?php
require_once "connection.php";
require_once "message.php";

if (!empty($_GET) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    if ((int)$_GET['criteria']) {
        $id = $_GET['criteria'];
        $query = "SELECT * FROM tbl_students WHERE id=" . $id;
        $result = mysqli_query($connection, $query);
        $findData = mysqli_fetch_assoc($result);

        $language = explode(',', $findData['language']);


    } else {
        $_SESSION['error'] = 'Invalid Criteria';
        header('Location:index.php');
        exit();
    }

} else {
    $_SESSION['error'] = 'Invalid Access';
    header('Location:index.php');
    exit();
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP8AM CRUD</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1><i class="glyphicon glyphicon-edit"></i> Edit Info</h1>
                    <hr>
                    <?= messages(); ?>
                    <form action="update.php" method="post">
                        <input type="hidden" name="criteria" value="<?= $findData['id'] ?>">
                        <div class="form-group input-group-sm">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="<?= $findData['name'] ?>" class="form-control"
                                   id="name">
                        </div>
                        <div class="form-group input-group-sm">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="<?= $findData['email'] ?>" class="form-control"
                                   id="email">
                        </div>

                        <div class="form-group input-group-sm">
                            <label for="gender">Gender</label>
                            <input type="radio" name="gender" <?= $findData['gender'] == 'male' ? 'checked' : ' ' ?>
                                   value="male">Male
                            <input type="radio" name="gender" <?= $findData['gender'] == 'female' ? 'checked' : ' ' ?>
                                   value="female">Female
                        </div>
                        <div class="form-group input-group-sm">
                            <label for="language">Language</label>
                            <input type="checkbox" name="language[]"
                                <?= in_array('nepali', $language) ? 'checked' : '' ?> value="nepali">Nepali

                            <input type="checkbox"
                                <?= in_array('chinese', $language) ? 'checked' : '' ?> name="language[]"
                                   value="chinese">Chinese
                            <input type="checkbox"
                                   name="language[]" <?= in_array('english', $language) ? 'checked' : '' ?>
                                   value="english">English
                        </div>
                        <div class="form-group input-group-sm">
                            <label for="country">Country</label>
                            <select name="country" id="country" class="form-control">
                                <option disabled selected>--select country--</option>
                                <option <?= $findData['country'] == 'nepal' ? 'selected' : '' ?> value="nepal">Nepal
                                </option>
                                <option <?= $findData['country'] == 'china' ? 'selected' : '' ?> value="china">China
                                </option>
                                <option <?= $findData['country'] == 'germany' ? 'selected' : '' ?> value="germany">
                                    Germany
                                </option>
                            </select>
                        </div>
                        <div class="form-group input-group-sm">
                            <button class="btn btn-primary">
                                <i class="glyphicon glyphicon-plus"></i> Update Info
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="bootstrap/js/jquery.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script>
    $(document).ready(function () {
        setTimeout(function () {
            $('.alert').hide('slow')
        }, 2000);
    });
</script>

</body>
</html>