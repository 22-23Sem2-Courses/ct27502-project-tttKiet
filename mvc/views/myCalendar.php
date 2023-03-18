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
        <link rel="stylesheet" href="/assets/css/myCalendar.css">
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
                                        <div class="name">Bùi Tuấn Kiệt</div>
                                    </div>
                                    <div class="info_gr">
                                        <span class="title">Email: </span>
                                        <span class="content">kietb@gmail.com</span>
                                    </div>
                                    <div class="info_gr">
                                        <span class="title">ID: </span>
                                        <span class="content">123213</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-8 col-12">
                            <div class="calendar">
                                <h2 class="group-box title-component">Lịch đặt sân của bạn</h2>

                                <?php foreach($data['order'] as $orderOfStaudium) : ?>

                                <div class="group-box">
                                    <div>
                                        <h2 class="title-3"><?= $orderOfStaudium[0]['stadiumName'] ?></h2>
                                        <span class="address">
                                            <pre> <?= $orderOfStaudium[0]['address'] ?> </pre>
                                        </span>
                                    </div>
                                    <hr>
                                    <?php foreach($orderOfStaudium as $order) : ?>

                                    <div class="group-order">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="group-order-left">
                                                <div class="yard-booked">
                                                    <span>Sân đã đặt</span>
                                                    <span>S<?= $order['id'] ?></span>
                                                    <span>( <?= $order['timeBook'] ?> )</span>
                                                </div>

                                            </div>
                                            <div class="group-order-right">
                                                <div class="price">
                                                    <div class="hour"><?= $order['numberHour'] ?> hour</div>
                                                    <div class="vnd"><?= $order['numberHour'] * $order['price'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="date-order">
                                            <span>Đã order ngày <?= $order['createdAt'] ?> </span>
                                        </div>
                                    </div>


                                    <?php endforeach; ?>

                                </div>

                                <?php endforeach; ?>
                            </div>

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