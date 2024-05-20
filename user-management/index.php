<?php
include_once "DbConnection.php";
session_start();
$isLoggedIn = isset($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        #header {
            background-color: gray;
            width: 100%;
            height: 100px;
            padding-top: 30px;
            padding-left: 50px;
        }

        img {
            height: 285px;
            width: 100%;
        }

        u {
            padding-left: 30px;
        }

        ul {
            list-style-type: none;
        }

        ul li:hover {
            background-color: green;
            text-decoration: none;
            color: white;
        }

        li {
            text-decoration: underline;
        }
    </style>
</head>
<body class="container">
<header class="row">
    <h1 id="header" class=" col-sm-12  bg-info ">LOGO</h1>
</header>
<nav class="row navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container">

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php
                    if (!$isLoggedIn){
                        echo "login.php";
                    }
                    else{
                        echo "logout.php";
                    }
                    ?>"><?php
                        if (!$isLoggedIn) {
                            echo "Login";
                        } else {
                            echo "Logout";
                        }
                        ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php
                    if (!$isLoggedIn) {
                        echo "register.php";
                    }
                    else{
                        echo "myaccount.php?id=".$_SESSION['id'];
                    }

                    ?>">
                        <?php
                        if (!$isLoggedIn) {
                            echo "Register";
                        } else {
                            echo "My Account";
                        }
                        ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="quanly.php">Management</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main>
    <aside class="row">
        <div class="col-sm-3 bg-info">
            <ul class="list-group bg-info">
                <li class=" p-3 ">Home</li>
                <li class=" p-3 ">About us</li>
                <li class=" p-3 ">Products</li>
                <li class=" p-3 ">Services</li>
                <li class=" p-3 ">Contact</li>
            </ul>
        </div>
        <article class="col-sm-9 bg-info ">
            <img src="https://lh3.googleusercontent.com/proxy/7v4jrhphB5j_n7A9AAxQPk5gdVp-kawPq2lzWV_CuZqJNVIAOkdMSPHJF5Na22xmkrGt9jU4chs1va8-xRf4qDwgtg99B5f4d_ER">
        </article>
    </aside>
    <article class="row mt-2">
        <div class="col-sm-12 bg-info p-5">
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            <p>It is a long established fact that a reader will be distracted by the readable content of a page when
                looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution
                of letters, as opposed to using 'Content here, content here', making it look like readable English. Many
                desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a
                search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have
                evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
        </div>
    </article>
</main>
<footer class="row">
    <p class="text-center bg-primary p-1">Copyright 2013. Stock Footage | Designed by www.krishnacreationz.com</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>