<?php
include("database_connection.php");

if (isset($_GET['title'])) {
    $title = $_GET['title'];
    $description = $_GET['description'];
    $serialNumber = $_GET['serial'];
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php CRUD App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-black text-white">

    <?php include("navbar.php");
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $serialNumber = $_POST["serialNumber"];

        $sql = "UPDATE `notes` SET `Title` = '$title', `Description` = '$description' WHERE `Sr.` = '$serialNumber'";

        $result = mysqli_query($connection, $sql);

        if ($result) {
            echo '
                <div class="alert alert-info" role="alert">
                    Note Updated successfully
                </div>';

            echo '<script>
                    setTimeout(function () {
                        document.querySelector(".alert").style.display = "none";
                        window.location.href = "index.php";
                    }, 1000);
                </script>';
        }
    }
    ?>


    <div class="container mt-5">
        <h1>Update Note</h1>
        <form action="/crud/edit.php" method="POST">
            <div class="mb-3">
                <label for="serialNumber" class="form-label">Serial Number</label>
                <input type="text" readonly class="form-control" id="serialNumber" name="serialNumber" aria-describedby="emailHelp" value='<?php echo $serialNumber; ?>'>

            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" value='<?php echo $title; ?>'>

            </div>
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea rows="4" class="form-control" name="description" placeholder="Leave Note Description here" id="description"><?php echo $description; ?></textarea>

            </div>

            <button type="submit" class="btn btn-outline-primary mt-3 fw-bold fs-4">Update Note</button>
        </form>
    </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>