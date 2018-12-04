<?php
require_once "connection.php";
require_once "message.php";

// fetch data from database

$query = "SELECT * FROM tbl_students ORDER BY id DESC ";
$result = mysqli_query($connection, $query);
$numberOfData = mysqli_num_rows($result);

if (!empty($_GET['search'])) {
    $criteria = $_GET['search'];
    $query = "SELECT * FROM tbl_students WHERE
          name like '%$criteria%' ||
          email like '%$criteria%' ||
          gender like '%$criteria%' ||
          language like '%$criteria%'||
          country like '%$criteria%' ";
    $result = mysqli_query($connection, $query);
    $numberOfData = mysqli_num_rows($result);


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
            <h1><i class="glyphicon glyphicon-user"></i> Mange Students</h1>
            <hr>
            <?= messages(); ?>
            <div class="row">
                <div class="col-md-4">
                    <form action="insert.php" method="post">
                        <div class="form-group input-group-sm">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                        <div class="form-group input-group-sm">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email">
                        </div>
                        <div class="form-group input-group-sm">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                        <div class="form-group input-group-sm">
                            <label for="password_confirmation">Password Confirm</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                   id="password_confirmation">
                        </div>
                        <div class="form-group input-group-sm">
                            <label for="gender">Gender</label>
                            <input type="radio" name="gender" value="male">Male
                            <input type="radio" name="gender" value="female">Female
                        </div>
                        <div class="form-group input-group-sm">
                            <label for="language">Language</label>
                            <input type="checkbox" name="language[]" value="nepali">Nepali
                            <input type="checkbox" name="language[]" value="chinese">Chinese
                            <input type="checkbox" name="language[]" value="english">English
                        </div>
                        <div class="form-group input-group-sm">
                            <label for="country">Country</label>
                            <select name="country" id="country" class="form-control">
                                <option disabled selected>--select country--</option>
                                <option value="nepal">Nepal</option>
                                <option value="china">China</option>
                                <option value="germany">Germany</option>
                            </select>
                        </div>
                        <div class="form-group input-group-sm">
                            <button class="btn btn-success">
                                <i class="glyphicon glyphicon-plus"></i> Add Record
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <form action="">
                            <div class="col-md-6" style="padding-right: 1px;">
                                <div class="form-group">
                                    <input type="text" name="search" required
                                           placeholder="enter any keywords" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-left: 0;">
                                <div class="form-group">
                                    <button class="btn btn-primary">
                                        <i class="glyphicon glyphicon-search"></i> Search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <table class="table table-hover">
                        <tr>
                            <th>S.n</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Language</th>
                            <th>Country</th>
                            <th>Action</th>
                        </tr>
                        <?php if ($numberOfData > 0) : ?>
                            <?php foreach ($result as $key => $student) : ?>
                                <tr>
                                    <td><?= ++$key; ?></td>
                                    <td><?= ucfirst($student['name']); ?></td>
                                    <td><?= $student['email']; ?></td>
                                    <td><?= ucfirst($student['gender']); ?></td>
                                    <td>
                                        <?php
                                        $language = explode(',', $student['language']);
                                        $color = ['success', 'danger', 'warning', 'info'];
                                        foreach ($language as $lang) {
                                            $randNumber = rand(0, 3);
                                            echo "<span class='label label-$color[$randNumber]'>$lang</span>";
                                        }


                                        ?>
                                    </td>
                                    <td><?= ucfirst($student['country']); ?></td>
                                    <td>
                                        <a href="edit.php?criteria=<?= $student['id'] ?>"
                                           class="btn btn-primary btn-xs">
                                            <i class="glyphicon glyphicon-edit"></i> </a>
                                        <a href="delete.php?criteria=<?= $student['id'] ?>"
                                           class="btn btn-danger btn-xs" onclick="return confirm('are you sure ?')">
                                            <i class="glyphicon glyphicon-trash"></i> </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" align="center"><a href="" class="btn btn-danger btn-xs">Data not
                                        found</a></td>
                            </tr>
                        <?php endif; ?>
                    </table>
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