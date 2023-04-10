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
        <link rel="stylesheet" href="/assets/css/myAccount.css">
        <link rel="stylesheet" href="/assets/css/header-nav.css">
        <link rel="stylesheet" href="/assets/css/footer.css">

    </head>

    <body>
        <div id="root">
            <header id="header">
                <?php
                include "./partials/header-nav.php";
            ?>

            </header>

            <main id="main">
                <div class="container container-w1138">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="information group-box d-flex">
                                <div class="avt"><img src="../assets/images/avatar.png" alt="avatar"></div>
                                <div class="user">
                                    <div class="info_gr">
                                        <div class="name"><?= $_SESSION['user']['fullName'] ?></div>
                                    </div>
                                    <div class="info_gr">
                                        <span class="title">Email: </span>
                                        <span class="content"><?= $_SESSION['user']['email'] ?></span>
                                    </div>
                                    <div class="info_gr">
                                        <span class="title">ID: </span>
                                        <span class="content"><?= $_SESSION['user']['id'] ?></span>
                                    </div>

                                </div>
                            </div>

                            <div class="group-box">
                                <div class="info_gr">
                                    <div class="change change-info">
                                        Thay đổi thông tin
                                    </div>
                                    <div class="change change-pass">
                                        Đổi mật khẩu
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-12">
                            <div class="account">
                                <h2 class="group-box title-component">Tài khoản của bạn</h2>
                                <div class="group-box">
                                    <div class="info_gr">
                                        <span class="title info__lable">Số điện thoại: </span>
                                        <span class="content"><?= $_SESSION['user']['phone'] ?></span>
                                    </div>
                                    <div class="info_gr">
                                        <span class="title info__lable">Địa chỉ: </span>
                                        <span class="content"><?= $_SESSION['user']['address'] ?></span>
                                    </div>

                                    <div class="info_gr">
                                        <span class="title info__lable">Người dùng: </span>
                                        <span class="content"><?= $_SESSION['user']['type'] ?></span>
                                    </div>
                                    <div class="info_gr">
                                        <span class="title info__lable">Mật khẩu: </span>
                                        <span class="content">***</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </main>
            <!-- model -->
            <div class="model-change-info">
                <div class="model-wrap">
                    <span class="model-header__close">X</span>
                    <div class="model-header">
                        <h2>Thay đổi thông tin của bạn</h2>
                    </div>

                    <div class="model-body">
                        <div class="model-body__header">

                        </div>

                        <form action="/user/change-info" name="changeInfo" method="POST">
                            <div class="model-body__main">
                                <div class="info_gr gr_input row">
                                    <span class="title info__lable col-md-3 col-12">Số điện thoại: </span>
                                    <input class="content model-input col-md-8 col-12" name="phone"
                                        value="<?= $_SESSION['user']['phone'] ?>" />
                                </div>
                                <div class="info_gr gr_input row">
                                    <span class="title info__lable col-md-3 col-12">Địa chỉ: </span>
                                    <textarea rows="5" name="address"
                                        class="content model-input col-md-8 col-12"><?= $_SESSION['user']['address'] ?> </textarea>
                                </div>

                            </div>

                            <div class="model-body__submit row">
                                <div class='col-sm-8 col-12 offset-md-3'>
                                    <button type="submit" class='btn btn-primary'>Thay đổi</button>
                                    <button type="button" class='btn btn-secondary btn-no'>Hủy</button>
                                </div>
                            </div>
                        </form>
                        <hr>

                        <div class="model-body__footer">
                            <span class="thanks">Cám ơn bạn đã sử dụng dịch vụ của chúng tôi!!!</span>
                        </div>

                    </div>
                </div>
            </div>

            <!-- model change password -->
            <div class="model-change-pass">
                <div class="model-wrap">
                    <span class="model-header__close">X</span>
                    <div class="model-header">
                        <h2>Thay đổi mật khẩu</h2>
                    </div>

                    <div class="model-body">
                        <div class="model-body__header">

                        </div>

                        <form action="/user/change-password" name="changePass" method="POST">
                            <div class="model-body__main">
                                <div class="info_gr gr_input row">
                                    <span class="title info__lable col-md-3 col-12">Mật khẩu cũ: </span>
                                    <input type="password" required class="content model-input col-md-8 col-12"
                                        name="password" />
                                </div>
                                <div class="info_gr gr_input row">
                                    <span class="title info__lable col-md-3 col-12">Mật khẩu mới: </span>
                                    <input type="password" required rows="5" name="new-password"
                                        class="content model-input col-md-8 col-12" />
                                </div>
                                <div class="info_gr gr_input row">
                                    <span class="title info__lable col-md-3 col-12">Nhập lại khẩu mới: </span>
                                    <input type="password" required rows="5" name="re-new-password"
                                        class="content model-input col-md-8 col-12" />
                                </div>
                                <div class="info_gr gr_input row">
                                    <span class="title info__lable  col-12 err"></span>
                                </div>

                            </div>

                            <div class="model-body__submit row">
                                <div class='col-sm-8 col-12 offset-md-3'>
                                    <button type="submit" class='btn btn-primary'>Thay đổi</button>
                                    <button type="button" class='btn  btn-secondary btn-no'>Hủy</button>
                                </div>
                            </div>
                        </form>
                        <hr>

                        <div class="model-body__footer">
                            <span class="thanks">Cám ơn bạn đã sử dụng dịch vụ của chúng tôi!!!</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- toast -->
            <?php
                // $bootstrap['message'] = 'Ok! Bạn đã đặt sân thành công.';
                include "./partials/toast.php";
            ?>

            <footer id="footer">
                <?php
            include "./partials/footer.php"
            ?>
            </footer>
        </div>

        <!-- Jquery -->
        <script src=" https://code.jquery.com/jquery-3.6.4.js"
            integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous">
        </script>


        <script>
        $(document).ready(function() {
            const groupOrder = $('.group-order');
            const modelChangeInfo = $('.model-change-info');
            const modelChangePass = $('.model-change-pass');
            const changeInfo = $('.change-info');
            const changePass = $('.change-pass');
            // nut x
            const modelHeader__close = $('.model-header__close');
            // body model
            const messageSuccess = $('.message-success');
            // nut huy
            const btnNo = $('.btn-no');
            // pass
            const inputPassword = $('input[name="password"');
            const inputNewPassword = $('input[name="new-password"');
            const inputReNewPassword = $('input[name="re-new-password"');

            const err = $('.err');
            // 
            const messageModel = $('.message-model');
            const changeInfoForm = $('form[name="changeInfo"]');
            const changePassForm = $('form[name="changePass"]');



            changeInfo.on('click', function() {
                modelChangeInfo.addClass('show');
            })
            changePass.on('click', function() {
                modelChangePass.addClass('show');
            })

            // modelChangePass
            changePassForm.on('submit', function(e) {

                if (inputNewPassword.val() !== inputReNewPassword.val()) {
                    // validate form
                    e.preventDefault();
                    err.text('Nhập lại mật khẩu không chính xác!')

                } else {
                    e.preventDefault();
                    $.post({
                        url: `/user/change-password`,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            'password': inputPassword.val(),
                            'new-password': inputNewPassword.val(),
                        },
                        success: function(data, status) {
                            if (data.code === 0) {
                                messageModel.text('Thay đổi mật khẩu thành công!')
                                modelChangePass.removeClass('show');
                                showToast();
                                setTimeout(() => {
                                    hideToast();
                                }, 3000)
                                inputPassword.val('')
                                inputNewPassword.val('')
                                inputReNewPassword.val('')
                                err.text('')

                            } else if (data.code === 3) {
                                err.text('Mật khẩu cũ nhập không chính xác!')
                            } else if (data.code === 2) {
                                err.text('Mật khẩu mới không được trùng với mật khẩu cũ!')
                            }

                        },

                        error: function(xhr, status, error) {
                            console.log('XHR:', xhr);
                            console.log('Status:', status);
                            console.log('Error:', [error]);
                        }
                    })
                }
            });

            // modelChangeInfo
            changeInfoForm.on('submit', function(e) {
                const inputPhone = $('input[name="phone"]');
                const inputAddress = $('textarea[name="address"]');
                if (!true) {
                    // validate form
                    e.preventDefault();
                } else {
                    e.preventDefault();
                    $.post({
                        url: `/user/change-info`,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            phone: inputPhone.val(),
                            address: inputAddress.val(),
                        },
                        success: function(data, status) {
                            if (data.code === 0) {
                                messageModel.text('Thay đổi thông tin thành công!')
                                modelChangeInfo.removeClass('show');
                                showToast();
                                setTimeout(() => {
                                    hideToast();
                                }, 3000)
                            }

                        },

                        error: function(xhr, status, error) {
                            console.log('XHR:', xhr);
                            console.log('Status:', status);
                            console.log('Error:', [error]);
                        }
                    })
                }
            });

            function showToast() {
                var myToastEl = $('#toast-message');
                myToastEl.addClass('show', 'fade');
                if (myToastEl.hasClass('hide')) {
                    myToastEl.removeClass('hide');

                }
            }

            function hideToast() {
                var myToastEl = $('#toast-message');
                myToastEl.removeClass('hide');
                if (myToastEl.hasClass('show')) {
                    myToastEl.removeClass('show');

                }
            }
            $('.btn-close').on('click', function() {
                hideToast();
            })

            // click X
            modelHeader__close.each(function() {
                $(this).on('click', function(e) {
                    if (modelChangePass.hasClass('show')) {
                        modelChangePass.removeClass('show');
                        inputPassword.val('')
                        inputNewPassword.val('')
                        inputReNewPassword.val('')
                        err.text('')

                    }
                    if (modelChangeInfo.hasClass('show')) {
                        modelChangeInfo.removeClass('show');
                    }
                });
            })

            btnNo.each(function() {
                $(this).on('click', function(e) {
                    if (modelChangePass.hasClass('show')) {
                        modelChangePass.removeClass('show');
                        inputPassword.val('')
                        inputNewPassword.val('')
                        inputReNewPassword.val('')
                        err.text('')

                    }
                    if (modelChangeInfo.hasClass('show')) {
                        modelChangeInfo.removeClass('show');
                    }
                });
            })

            // click ra ngoài
            modelChangeInfo.on('click', function(e) {
                const isModel = $(e.target).closest('.model-wrap').length;
                if (!isModel) {
                    if (modelChangeInfo.hasClass('show')) {
                        modelChangeInfo.removeClass('show');
                    }
                }
            });
            modelChangePass.on('click', function(e) {
                const isModel = $(e.target).closest('.model-wrap').length;
                if (!isModel) {
                    if (modelChangeInfo.hasClass('show')) {
                        modelChangeInfo.removeClass('show');
                    }
                }
            });
        });
        </script>
    </body>

</html>