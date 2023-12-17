<?php
include("database_connection.php");
$alert = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO `notes` (`Title`, `Description`, `Time`) VALUES ('$title', '$description', current_timestamp())";

    $result = mysqli_query($connection, $sql);
    if ($result) {
        $alert = true;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php CRUD App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-black text-white">

    <?php
    include("navbar.php");
    if ($alert) {
        echo '
            <div class="alert alert-success" role="alert">
                Note Added Successfully!
            </div>';

        echo '<script>
            setTimeout(function () {
                document.querySelector(".alert").style.display = "none";
            }, 1000);
        </script>';
        $alert = false;
    }

    if (isset($_GET['delete_status']) && $_GET['delete_status'] == 'success') {
        echo '
        <div class="alert alert-danger" role="alert">
            Note deleted successfully
        </div>';

        echo '<script>
            setTimeout(function () {
                document.querySelector(".alert").style.display = "none";
                window.location.href = "index.php";
            }, 1000);
        </script>';
    }

    ?>



    <div class="container mt-5">
        <h1>Add Note</h1>
        <form action="/crud/" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">

            </div>
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea rows="4" class="form-control" name="description" placeholder="Leave Note Description here"
                    id="description"></textarea>

            </div>

            <button type="submit" class="btn btn-outline-primary mt-3 fw-bold fs-4">Add Note</button>
        </form>
    </div>

    <div class="container mt-5">
        <h1 class="text-center mb-5">All Notes</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Sr.</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                    <th scope="col">Time</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM `notes`";
                $result = mysqli_query($connection, $sql);
                $number = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $title = $row["Title"];
                    $description = $row["Description"];
                    $time = $row['Time'];
                    $serialNumber = $row["Sr."];
                    $number++;
                    echo '
                    <tr>
                        <th scope="row">' . $number . '</th>
                        <td>' . $title . '</td>
                        <td>' . $description . '</td>
                        <td><a class="btn btn-outline-primary m-2 text-black fw-bold" href="edit.php?title=' . urlencode($title) . '&description=' . urlencode($description) . '&serial=' . urlencode($serialNumber) . '">Edit</a>
                        <a class="btn btn-outline-danger m-2 text-black fw-bold" href="delete.php?serial=' . urlencode($serialNumber) . '">Delete</a>

                        </td>
                        <td>' . $time . '</td>

                    </tr>
                    ';
                }
                ?>


            </tbody>
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>