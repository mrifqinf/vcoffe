<?php
// session_start();
// JIKA SUDAH ADA SESSION TIDAK BISA MASUK KE MENU LOGIN DENGAN LINK
if (!empty($_SESSION['username_vcoffe'])) {
    header('location:home');
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.111.3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="icon" href="assets/images/icon_title.png" type="png" sizes="16x16">
    <title>Register V-Coffe</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        :root {
            --gradient: linear-gradient(65deg, rgba(133, 88, 111, 1) 0%, rgba(223, 211, 195, 1) 61%, rgba(248, 237, 227, 1) 100%);
        }

        body {
            min-height: 100vh;
            background: var(--gradient);
            background-size: 200%;
            background-position: left;
            animation: gradient-animation 10s infinite alternate;
        }

        @keyframes gradient-animation {
            0% {
                background-position: left;
            }

            100% {
                background-position: right;
            }
        }
    </style>

    <link href="assets/css/login.css" rel="stylesheet">
</head>

<body class="text-center justify-content-center">
    <!-- <div class="card p-3" style="width: 23rem;"> -->
    <main class="form-signin w-100 m-auto rounded-4" style="background-color: #F8EDE3;">
        <form novalidate class="needs-validation" action="proses/p_registerguest.php" method="POST">
            <!-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
            <i class="bi bi-cup-hot-fill fs-1"></i>
            <h1 class="h3 my-3 fw-normal">Cafe V~Coffe</h1>
            <div class="form-floating">
                <input name="rname" type="text" class="form-control mb-2" id="floatingInput" placeholder="Yourname" required>
                <label for="floatingInput">Name</label>
                <div class="invalid-feedback mb-2">
                    Input your name
                </div>
            </div>
            <div class="form-floating">
                <input name="rusername" type="email" class="form-control mb-2" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">Email address</label>
                <div class="invalid-feedback mb-2">
                    Input valid username
                </div>
            </div>
            <div class="form-floating">
                <input name="rpassword" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
                <div class="invalid-feedback mb-2">
                    Input password
                </div>
            </div>
            <div class="form-floating">
                <input name="rnohp" type="number" class="form-control mb-2" id="floatingInput" placeholder="081212341234" required>
                <label for="floatingInput">Phone Number</label>
                <div class="invalid-feedback">
                    Input phone number
                </div>
            </div>
            <button class="w-100 mt-3 mb-3 btn btn-lg fw-bold text-light" style="background-color: #85586F;" type="submit" value="sumbit" name="register_validate">Register</button>
            Have a Account? <a class="link-dark link-underline-opacity-0 fw-semibold" href="login">Login Here!</a>
            <p class="mt-5 mb-3 text-body-secondary">&copy;2023 Muhammad Rifqi Nurfadillah</p>
        </form>
    </main>

    <!-- SCRIPT FOR FORM VALIDATION FROM BOOTSTRAP -->
    <script>
        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
    <!-- </div> -->
</body>

</html>