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
        <link rel="stylesheet" href="/assets/css/footer.css">

    </head>

    <body>
        <div id="root">


            <?php 
                if(isset($data['regDone']) && $data['regDone'] == true) {
                    echo '
                   <div class="wrap-model-done-reg">
                        <div class="model-done-reg">
                        <h2>
                            <i class="fa-regular fa-thumbs-up"></i>
                            Đăng ký thành công!
        
                        </h2>
                        <hr />
                        <p>Giờ đây bạn đã có thể sử dụng tài khoản này đăng nhập vào FOOTBAL - ORDER</p>
                        <a href="/user/login">Đăng nhập ngay</a>
                    </div>
                   </div>
                    ';
                }
            ?>
            <header id="header">
                <?php 
                    include "./partials/header-nav.php"
                ?>
            </header>

            <main id="main">
                <div class="container">
                    <div class="row">
                        <?php 
                                if(isset($data['register']) && $data['register'] == true) {
                                    echo '
                                    <div class="col-md-12">
                                    <form action="/user/register" name="form-register" method="post">
                                        <h2>Chào mừng bạn đến với </h2>
                                        <span class="text-hi">FOOTBALL ORDER</span>
                                        <div class="form-inp register">
                                            <div class="form-register">
                                                <div class="form-gr">
                                                    <label for="name">Họ và tên: </label>
                                                    <input id="name" name="name" placeholder="vd: Bùi Văn Đạt" required
                                                        type="text">
                    </div>
                    <div class="form-gr">
                        <label for="phone">Số điện thoại: </label>
                        <input id="phone" name="phone" placeholder="vd: 09123445678" pattern="[0-9]{10}" required
                            type="tel">
                    </div>
                    <div class="form-gr">
                        <label for="add">Địa chỉ: </label>
                        <textarea name="address" id="add" rows="3" required></textarea>
                    </div>
                </div>


                <div class="form-register">
                    <div class="form-gr">
                        <label for="email">Email: </label>
                        <input id="email" name="email" placeholder="vd: abcxyz123@gmail.com" required type="email">
                    </div>
                    <div class="form-gr">
                        <label for="pass">Mật khẩu: </label>
                        <input id="pass" name="pass" placeholder="***" type="password" required>
                    </div>
                    <div class="form-gr">
                        <label for="repass">Nhập lại mật khẩu: </label>
                        <input id="repass" name="repass" placeholder="" type="password" required>
                    </div>
                    <div class="form-gr">
                       <span class="label-err err-register">' .  $data['errMessage'] . ' </span>
                    </div>
                </div>

        </div>
        
        <div class="form-miss">
            <span>Bằng cách nhấn vào đăng ký, bạn đồng ý với các
                <a href="#">điều khoản</a>
                của chúng tôi.
            </span>

        </div>

        <div class="form-submit">
            <button type="submit" class="btn btn-primary btn-submit">Đăng ký thành viên</button>
        </div>

        </form>
        </div>
        ';
        } else {
        echo '
        <div class="col-md-4">
            <form action="/user/login" name="form-login" method="post">
                <h2>Chào mừng bạn đến với </h2>
                <span class="text-hi">FOOTBALL ORDER</span>
                <div class="form-inp">
                    <div class="form-gr">
                        <label for="email">Email: </label>
                        <input id="email" name="email" placeholder="vd: abcxyz123@gmail.com" required type="email">
                    </div>

                    <div class="form-gr">
                        <label for="pass">Mật khẩu: </label>
                        <input id="pass" name="pass" placeholder="***" type="password" required>
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
        ';
        }
        ?>



                    </div>
                </div>
            </main>

            <?php 
                include_once('../public/partials/footer.php');
            ?>
        </div>


        <script>
        const formElementRegister = document.querySelector('form[name="form-register"]');
        const passElement = document.querySelector('input[name="pass"]');
        const confirmPassElement = document.querySelector('input[name="repass"]');
        const errRegister = document.querySelector('.err-register');

        if (formElementRegister) {
            formElementRegister.addEventListener('submit', (e) => {
                if (passElement.value !== confirmPassElement.value) {
                    e.preventDefault();
                    errRegister.textContent = 'Mật khẩu nhập lại không chính xác!!!';
                } else {
                    errRegister.textContent = '';

                }
            })
        }
        </script>
    </body>

</html>