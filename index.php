<?php
//connect to db
$conn = new mysqli("localhost", "root", "", "crudNotes");

if ($conn->connect_error) {
    echo "Error while connecting to database : {$conn->connect_error}";
    die();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="CRUD -CREATE, READ, UPDATE,  DELETE; APPLICATION" />
    <meta name="subject" content="JNOTES 2.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Jaydeep Sahu sahujaydeep4321@gmail.com">
    <!-- <meta http-equiv="refresh" content="10;"> -->

    <title>JNotes-2.0</title>

    <link rel="shortcut icon" href="img/shortcut-icon.png">

    <!-- ____________________________BOOTSTRAPS CSS CDN____________________________________ -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <!-- ____________________________DATATABLE CSS CDN____________________________________ -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">


    <!-- ____________________________GOOGLE FONTS CDN____________________________________ -->


    <!-- ____________________________LINK : CSS ____________________________________ -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            max-width: 100vw !important;

            overflow-x: hidden;
        }

        *:focus {
            outline: none;
        }

        @media (max-width:320px) {
            #notesTableContainer {
                max-width: 99vw !important;
                overflow-x: auto;

            }
        }

        button {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        th:first-child,
        td:last-child {
            text-align: center;
        }

        thead>tr>th:first-child {
            width: fit-content;
        }
    </style>
</head>

<body>

    <!-- _________________________ EDIT MODAL  ________________________ -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal" id="editmodaltoggle"
        style="display: none;">
        Launch Edit modal
    </button>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalTitle">Edit Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="text" id="idEdit" name="sno" hidden>
                        <div class="form-group">
                            <label for="title">Note Title</label>
                            <input type="text" class="form-control" id="titleEdit" name="title"
                                aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Note Description</label>
                            <textarea class="form-control" id="descriptionEdit" name="description" required>
                                </textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Save changes</button>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- _________________________ NAVBAR  ________________________ -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand font-weight-bold" href="#"> <em class="fas fa fa-2x" id="jLogo">J</em>Notes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-lg-flex justify-content-lg-between" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact US</a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>-->
                </ul>
                <form class="d-flex justify-content-lg-between">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn bg-dark text-white" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- _________________________ INSERT/UPDATE STATUS ALERT  ________________________ -->

    <?php
    include_once "alerts.php";
    ?>
    <!-- _________________________ INSERT-BOX  ________________________ -->

    <div class="container my-4">
        <h2>Add a Note</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="title">Note Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp"
                    placeholder="Enter Note Title" required>
            </div>
            <div class="form-group">
                <label for="description">Note Description</label>
                <textarea class="form-control" id="desc" name="description" placeholder="Enter Description" required>
                    </textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>


    <!-- _________________________ SELECT-BOX  ________________________ -->

    <div class="container" id="notesTableContainer">
        <div class="row">
            <div class="col-lg-12 col-mg-12 col-sm-12">
                <table class="table table-striped" id="notesTable">
                    <thead>
                        <tr>
                            <th scope="col" class=" text-center">S.No.</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col" class=" text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $sq = "SELECT * FROM notes ORDER BY sno;";
                        $res = $conn->query($sq);

                        if ($res->num_rows == 0) {
                            echo "<tr>
                                        <th scope='row'>-</th>
                                        <td>-</td><td>-</td><td>-</td>
                                </tr>";
                        } else {
                            $k = 1;
                            while ($row = $res->fetch_assoc()) {
                        ?>
                        <tr>
                            <th scope="row">
                                <?php echo $k;
                                        $k = $k + 1; ?>
                            </th>
                            <td>
                                <?php echo $row['title']; ?>
                            </td>
                            <td>
                                <?php echo $row['description']; ?>
                            </td>

                            <td> <button class="btn btn-sm editnotes" id="<?php echo $row['sno']; ?>">
                                    <em class="fa fa-edit mr-2 text-success"></em></button>
                                <button class="btn btn-sm deletenotes" id="<?php echo 'd' . $row['sno']; ?>"><em
                                        class="fa text-danger fa-close"></em></button>
                            </td>
                        </tr>
                        <?php }
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>


    </div>


    <?php
    //INSERT/UPDATE/DELETE TO DB
    if (($_SERVER['REQUEST_METHOD'] == "POST")) {
        $timeout = "<script>
        const timeout = setTimeout(() => { location.href = 'index.php' }, 3000);
    </script>";

        if (isset($_POST["sno"])) {
            //UPDATE THE NOTE

            $sno =  $_POST["sno"];
            $title = trim($_POST["title"]);
            $description = trim($_POST["description"]);

            $uq = "UPDATE notes SET  title = '{$title}', description = '{$description}' WHERE sno = {$sno};";

            $res = $conn->query($uq);

            if ($res) {

                echo "<script>
                    document.getElementById('updateStatusSuccess').style.display = 'block';
                </script>";
            } else {
                echo "<script>
                    document.getElementById('updateStatusFailure').style.display = 'block';
                </script>";
            }
        } else if (strlen(trim($_POST["description"]))) {
            //INSERT THE NOTE
            $title = trim($_POST["title"]);
            $description = trim($_POST["description"]);

            $iq = "INSERT INTO notes(title,description) VALUES('{$title}', '{$description}');";

            $res = $conn->query($iq);

            if ($res) {
                echo "<script>
                    document.getElementById('insertStatusSuccess').style.display = 'block';
                </script>";
            } else {
                echo "<script>
                    document.getElementById('insertStatusFailure').style.display = 'block';
                </script>";
            }
        }
        echo $timeout;
    } else if (isset($_GET['delete'])) {
        $sno = (int)$_GET['delete'];

        $dq = "DELETE FROM notes WHERE sno = {$sno}";

        $res = $conn->query($dq);

        if ($res) {
            echo "<script>
                document.getElementById('deleteStatusSuccess').style.display = 'block';
            </script>";
        } else {
            echo "<script>
                document.getElementById('deleteStatusFailure').style.display = 'block';
            </script>";
        }
        echo "<script>
            const timeout = setTimeout(() => { location.href = 'index.php' }, 3000);
        </script>";
    }

    ?>






    <!-- ____________________________ AJAX CDN____________________________________ -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <!-- ____________________________FONT AWESOME CDN____________________________________ -->
    <script src="https://kit.fontawesome.com/36553a87b3.js" crossorigin="anonymous"></script>

    <!-- ____________________________BOOTSTRAPS JS CDN____________________________________ -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>

    <!-- ____________________________ jQuery CDN____________________________________ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- ____________________________DATATABLE CSS CDN & CALL____________________________________ -->
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <!-- ____________________________SCRIPT:SRC ____________________________________ -->
    <script src="js/main.js"></script>

</body>


</html>

<?php
$conn->commit();
$conn->close();
?>