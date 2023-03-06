<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Football Order</title>


        <!-- Icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

        <!-- Boots Chap 5-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- Css -->
        <link rel="stylesheet" href="/assets/css/index.css">
        <link rel="stylesheet" href="/assets/css/header-nav.css">
        <link rel="stylesheet" href="/assets/css/login.css">

    </head>

    <body>
        <div id="root">
            <header id="header">
                <?php 
                    include "./partials/header-nav.php"
                ?>
            </header>

            <main id="main">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <form action="/user/login" name="form-login" method="post">
                                <h2>Chào mừng bạn đến với </h2>
                                <span class="text-hi">FOOTBALL ORDER</span>
                                <div class="form-inp">
                                    <div class="form-gr">
                                        <label for='email'>Email: </label>
                                        <input id="email" placeholder="vd: abcxyz123@gmail.com" required type="email">
                                    </div>

                                    <div class="form-gr">
                                        <label for='pass'>Mật khẩu: </label>
                                        <input id="pass" placeholder="***" type="password" required>
                                    </div>
                                </div>

                                <div class="form-submit">
                                    <button type="submit" class="btn btn-primary btn-submit">Đăng nhập</button>
                                </div>

                                <div class="form-miss">
                                    <span>Quên mật khẩu?</span>
                                    <span>Bạn chưa có tài khoản?
                                        <a href="/user/register">Đăng ký</a>
                                        ngay?</span>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-8">
                            <div class="img">
                                <img src="/assets/images/login-right-1.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>

</html>