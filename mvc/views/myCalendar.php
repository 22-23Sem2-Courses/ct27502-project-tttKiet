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

                        </div>
                        <div class="col-md-8 col-12">
                            <div class="calendar">
                                <h2 class="group-box title-component">Lịch đặt sân của bạn</h2>
                                <?php
                                    if(count($data['order']) == 0) {
                                        echo "
                                        <h2 class='group-box notications'>Bạn chưa đặt / thuê sân nào!</h2>
                                        ";
                                    }
                                ?>
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

                                    <div class="group-order" data-id="<?= $order['order.id']?>">
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
                                                    <div class="hour"><?= $order['numberHour'] ?> giờ</div>
                                                    <div class="vnd"><?= $order['numberHour'] * $order['price'] ?>.000đ
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

                <!-- Model details -->
                <div class="model-details">
                    <div class="model-wrap">
                        <span class="model-header__close">X</span>
                        <div class="model-header">
                            <h2>Chi tiết order</h2>
                        </div>

                        <div class="model-body">
                            <div class="model-body__header">
                                <div class="gr-show">
                                    <h3 class="gr-show__label">Tên sân: </h3>
                                    <span class="content nameDetails">Sân DHCT</span>
                                </div>
                                <div class="gr-show">
                                    <h3 class="gr-show__label">Vị trí: </h3>
                                    <span class="content addressdetails">Sân DHCT sad ssadsadsa</span>
                                </div>
                                <hr>
                            </div>

                            <div class="model-body__main">
                                <div class="gr-show">
                                    <h3 class="gr-show__label">Thuê sân số: </h3>
                                    <span class="content childrenId">S1</span>
                                </div>
                                <div class="gr-show">
                                    <h3 class="gr-show__label">Ngày thực chiến: </h3>
                                    <span class="content dateBook">12 - 2 - 2022</span>
                                </div>
                                <div class="gr-show">
                                    <h3 class="gr-show__label">Giờ thực chiến: </h3>
                                    <span class="content hourModel">13h PM</span>
                                </div>
                                <div class="gr-show">
                                    <h3 class="gr-show__label">Số giờ thuê: </h3>
                                    <span class="content numberHourModel">3 Giờ</span>
                                </div>
                                <div class="gr-show">
                                    <h3 class="gr-show__label">Đơn giá: </h3>
                                    <span class="content alone-price">200k / H</span>
                                </div>
                                <div class="gr-show">
                                    <h3 class="gr-show__label">Thành tiền: </h3>
                                    <span class="content sum-price">400k / H</span>
                                </div>
                                <hr>
                            </div>

                            <div class="model-body__footer">
                                <span class="createdAt">Thuê ngày: 12/2/2002</span>
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

        <!-- Jquery -->
        <script src=" https://code.jquery.com/jquery-3.6.4.js"
            integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous">
        </script>


        <script>
        $(document).ready(function() {
            const groupOrder = $('.group-order');
            const modelDetails = $('.model-details');
            const modelHeader__close = $('.model-header__close');

            //  content model
            const name = $('.nameDetails');
            const address = $('.addressdetails');
            const childrenId = $('.childrenId');
            const dateBook = $('.dateBook');
            const hour = $('.hourModel');
            const numberHour = $('.numberHourModel');
            const alonePrice = $('.alone-price');
            const sumPrice = $('.sum-price');
            const createdAt = $('.createdAt');


            groupOrder.on('click', function(e) {
                // Mở modelDetails
                modelDetails.addClass('show');
                const billId = $(e.currentTarget).data('id');

                $.ajax({
                    type: "GET",
                    url: `/user/details/${billId}`,
                    data: {
                        billId: billId
                    },
                    success: function(data) {
                        if (data.code === 0) {
                            showModeldetails(...data.data);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // handle the error
                        console.log(jqXHR)
                    }
                });

            })

            // Add content

            const showModeldetails = (data) => {
                name.text(data.stadiumName);
                address.text(data.address);
                childrenId.text(`S` + data.id);

                let date = new Date(data.timeBook);

                const formattedDate = date.toLocaleDateString("vi-VN", {
                    day: "numeric",
                    month: "numeric",
                    year: "numeric"
                });
                const formattedTime = date.toLocaleTimeString("vi-VN", {
                    hour: "numeric",
                    minute: "numeric",
                    hour12: true
                });
                dateBook.text(formattedDate);
                hour.text(formattedTime);
                numberHour.text(data.numberHour + ' giờ');
                alonePrice.text(data.price + `.000đ`);
                sumPrice.text(data.price * data.numberHour + `.000đ`);

                let createdAtDate = new Date(data.createdAt);

                const createdAtFormat = createdAtDate.toLocaleDateString("vi-VN", {
                    day: "numeric",
                    month: "numeric",
                    year: "numeric"
                });
                createdAt.text(`Đã order ngày: ` + createdAtFormat);
            }

            // click X
            modelHeader__close.on('click', function(e) {
                modelDetails.removeClass('show');
            });

            // click ra ngoài
            modelDetails.on('click', function(e) {
                const isModel = $(e.target).closest('.model-wrap').length;
                if (!isModel) {
                    if (modelDetails.hasClass('show')) {
                        modelDetails.removeClass('show');
                    }
                }
            });
        });
        </script>
    </body>

</html>