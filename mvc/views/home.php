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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Css -->
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="stylesheet" href="/assets/css/header-nav.css">
    <link rel="stylesheet" href="/assets/css/home.css">
    <link rel="stylesheet" href="/assets/css/footer.css">

</head>

<body>
    <div id="root">
        <header id="header">
            <?php
            if (isset($_GET['logout'])) {
                $_SESSION['loggedin'] = false;
                unset($_SESSION['loggedin']);
                unset($_SESSION['user']);
                session_destroy();
            }

            include "./partials/header-nav.php";

            ?>

            <div class="header__desc container">
                <div class="header__desc--wrap">
                    <div class="hello">
                        <h1> FOOTBALL -- ORDER</h1>
                        <p>
                            Đặt sân bóng đá trực tuyến - Tìm kiếm và đặt sân bóng đá dễ dàng với "Football -
                            order".
                        </p>

                        <p>
                            Với trang web đặt sân bóng đá của chúng tôi, bạn sẽ không còn phải tốn thời gian tìm
                            kiếm
                            sân bóng đá phù hợp. Hãy đăng ký ngay để trải nghiệm dịch vụ đặt sân bóng đá tốt nhất
                            của
                            chúng tôi!
                        </p>
                    </div>

                    <div class="header__desc-img">
                        <img src="./assets/images/football.jpg" alt="">
                    </div>
                </div>
            </div>

        </header>

        <main id="main">
            <div class="container">
                <div class="profit">
                    <h1 class="title">Lợi ích của người dùng khi sử dụng FOOTBALL - ORDER</h1>
                    <div class="profit__list row">
                        <div class="col-md-3 col-sm-12 profit__list--item">
                            <i class="fa-regular fa-magnifying-glass "></i>
                            <div>
                                <h2>Dễ dàng tìm kiếm sân bóng</h2>
                                <span>Trang web cung cấp cho bạn thông tin chi tiết về các sân bóng hiện có, giúp
                                    bạn dễ
                                    dàng tìm kiếm và lựa chọn sân bóng phù hợp với nhu cầu của mình.</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 profit__list--item">
                            <i class="fa-regular fa-check"></i>
                            <div>
                                <h2>Đặt sân bóng đúng giá</h2>
                                <span>Bạn có thể xem giá sân bóng đá trực tuyến, giúp bạn đặt sân với giá tốt nhất
                                    và
                                    tiết kiệm chi phí.</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 profit__list--item">
                            <i class="fa-regular fa-clock"></i>
                            <div>
                                <h2>Tiết kiệm thời gian</h2>
                                <span>Bạn không cần phải đến trực tiếp sân bóng để đặt sân, mà chỉ cần truy cập
                                    trang
                                    web và đặt sân bóng đá trực tuyến một cách nhanh chóng và tiện lợi từ bất cứ
                                    đâu.</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 profit__list--item">
                            <i class="fa-regular fa-shield"></i>
                            <h2>Đảm bảo chất lượng sân bóng</h2>
                            <span>Trang web sẽ cung cấp cho bạn các thông tin chi tiết về sân bóng, giúp bạn lựa
                                chọn
                                sân bóng có chất lượng tốt và đáp ứng nhu cầu của mình.</span>
                        </div>
                    </div>
                </div>
                <hr class="hr-custom">
                <div class="row">
                    <div class="profit">
                        <h1 class="title">Đối với chủ sân</h1>
                        <div class="profit__list row">
                            <div class="col-md-3 col-sm-12 profit__list--item">
                                <i class="fa-regular fa-people-roof"></i>
                                <div>
                                    <h2>Quản lý hiệu quả</h2>
                                    <span>Giải pháp quản lý sân đơn giản, dễ dàng mọi lúc mọi nơi trên mọi thiết bị.</span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 profit__list--item">
                                <i class="fa-regular fa-rectangle-ad"></i>
                                <div>
                                    <h2>Quảng bá hiệu quả</h2>
                                    <span>Trang thông tin sân bóng riêng biệt với hàng ngàn người truy cập hằng ngày!</span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 profit__list--item">
                                <i class="fa-regular fa-chart-simple"></i>
                                <div>
                                    <h2>Tăng trưởng doanh thu</h2>
                                    <span>Doanh thu tăng từ 10% trở lên! Cắt giảm chi phí, thời gian quản lý.</span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 profit__list--item">
                                <i class="fa-regular fa-headset"></i>
                                <h2>Hỗ trợ 24/7</h2>
                                <span>Luôn luôn sẵn sàng hỗ trợ bạn bất cứ lúc nào ở đâu</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer id="footer">
            <?php
            include "./partials/footer.php"
            ?>
        </footer>
    </div>
</body>

</html>