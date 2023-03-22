<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Football Order</title>


    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <!-- Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!-- Css -->
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="stylesheet" href="/assets/css/header-nav.css">
    <link rel="stylesheet" href="/assets/css/listOrder.css">
    <link rel="stylesheet" href="/assets/css/footer.css">

</head>

<body>
    <div id="root">
        <header id="header">
            <?php
            include "./partials/header-nav.php"
            ?>
        </header>

        <main id="main" class="">
            <div class="container container-height">
                <div class="row">
                    <div class="col-xl-3 col-md-4 col-12">
                        <div class="information group-box d-flex">
                            <div class="avt"><img src="/assets/images/avatar.png" alt="avatar"></div>
                            <div class="user">
                                <div class="info_gr">
                                    <div class="name fs-16"><?= $_SESSION['user']['fullName'] ?></div>
                                </div>
                                <div class="info_gr">
                                    <span class="title">Email: </span>
                                    <span class="content"><?= $_SESSION['user']['email'] ?></span>
                                </div>
                                <div class="info_gr">
                                    <span class="title">ID: </span>
                                    <span class="content"><?= $_SESSION['user']['id'] ?></span>
                                </div>
                                <div class="info_gr">
                                    <span class="title">Chủ sân: </span>
                                    <span class="content"><?= $data['stadium'][0]['name'] ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="information group-box d-flex">
                            <div class="card user" style="width: 100%;">
                                <img src="<?= $data['stadium'][0]['imgLink'] ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title name fs-16"><?= $data['stadium'][0]['name'] ?></h5>
                                    <p class="card-text title fs-14">Địa chỉ: <?= $data['stadium'][0]['address'] ?></p>
                                    <a href="/feedback/stadium/<?= $data['stadium'][0]['id'] ?>" class="btn btn-primary"
                                        target="_blank">Xem tất cả đánh giá về sân của bạn</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-md-12 col-12">
                        <div class="calendar">
                            <h2 class="group-box title-component">Lịch đặt sân của <?= $data['stadium'][0]['name'] ?>
                                vào ngày <?= $data['currentDate'] ?>
                            </h2>

                            <div class="search-time-yard float-end pb-3 m-3 mt-4 option-view">
                                <!-- <button type="button" class="btn btn-primary btn-view-all me-2"><a
                                        href="/admin/list-order" class="text-decoration-none text-white">Xem tất cả
                                    </a></button> -->
                                <label for="date-booking-yard-day">Xem ngày:</label>
                                <input type="date" value='<?= $data['currentDate'] ?>' name="booking-yard-day"
                                    id="date-booking-yard-day" data-id="<?php echo $data['stadium'][0]['id']; ?>">
                            </div>
                            <div class="group-box">
                                <div class="tab-calendar">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-home" type="button" role="tab"
                                                aria-controls="pills-home" aria-selected="true">Lịch đặt sân</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-profile" type="button" role="tab"
                                                aria-controls="pills-profile" aria-selected="false">Sân trống</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                            aria-labelledby="pills-home-tab" tabindex="0">
                                            <!-- View Order -->
                                            <?php if (count($data['allOrder']) <= 0) : ?>
                                            <h2
                                                class="d-flex justify-content-center align-items-center w-100 pt-3 fs-18">
                                                Hiện
                                                tại
                                                không có
                                                lịch
                                                đặt sân nào</h2>
                                            <?php else : ?>

                                            <table class="table align-middle mb-0 bg-white table-striped"
                                                id="orders-table">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Tài khoản</th>
                                                        <th>Sân đã đặt</th>
                                                        <th>Thời gian</th>
                                                        <th>Tổng tiền</th>
                                                        <th>Trạng thái</th>
                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    <?php foreach ($data['allOrder'] as $order) : ?>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="/assets/images/avatar.png" alt=""
                                                                    style="width: 45px; height: 45px"
                                                                    class="rounded-circle" />
                                                                <div class="ms-3">
                                                                    <p class="fw-normal mb-1 fs-16">
                                                                        <?= $order['userName'] ?>
                                                                    </p>
                                                                    <p class="text-muted mb-0 fs-14">
                                                                        <?= $order['userEmail'] ?></p>
                                                                    <p class="text-muted mb-0 fs-14">
                                                                        <?= $order['userPhone'] ?></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="fw-normal mb-1 fs-16">Sân số <?= $order['id'] ?>
                                                            </p>
                                                            <p class="text-muted mb-0 fs-14">Sân <?= $order['type'] ?>
                                                                người
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p class="fw-normal mb-1 fs-16"><?= $order['numberHour'] ?>
                                                                tiếng
                                                            </p>

                                                            <p class="text-muted mb-0 fs-14">
                                                                <?= date('H:i:s', strtotime('' . $order['timeBook'] . '')) ?>
                                                                ->
                                                                <?= date('H:i:s', strtotime('' . $order['timeBook'] . ' + ' . round($order['numberHour'] * 60) . ' minutes')) ?>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p class="fw-normal mb-1 fs-16">
                                                                <?= $order['price'] *  $order['numberHour'] ?>.000 VNĐ
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="btn-check"
                                                                id="btn-check-2-outlined-<?= $order['order.id'] ?>"
                                                                autocomplete="off">
                                                            <label class="btn btn-outline-secondary title fs-16"
                                                                for="btn-check-2-outlined-<?= $order['order.id'] ?>">Đã
                                                                thanh toán</label><br>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>

                                            <?php endif; ?>
                                        </div>
                                        <!--  -->
                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                            aria-labelledby="pills-profile-tab" tabindex="0">
                                            <table class="table align-middle mb-0 bg-white table-striped"
                                                id="orders-table">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>STT</th>
                                                        <th>Loại sân </th>
                                                        <th>Thời gian trống</th>
                                                        <th>Giá tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($data['emptyStadium'] as $emptyChildrenStadium) : ?>

                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="">
                                                                    <p class="fw-normal mb-1 fs-14">
                                                                        <?= $emptyChildrenStadium['id'] ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="fw-normal mb-1 fs-14">Sân số
                                                                <?= $emptyChildrenStadium['id'] ?></p>

                                                        </td>
                                                        <td>
                                                            <p class="fw-normal mb-1 fs-14">Sân
                                                                <?= $emptyChildrenStadium['type'] ?>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <?php foreach ($emptyChildrenStadium['free'] as $emptyTime) : ?>
                                                            <p class="fw-normal my-1 fs-14">

                                                                <?= $emptyTime['from'] ?> -> <?= $emptyTime['end'] ?>
                                                            </p>
                                                            <?php endforeach; ?>
                                                        </td>
                                                        <td>
                                                            <p class="fw-normal mb-1 fs-14">
                                                                <?= $emptyChildrenStadium['price'] ?>.000 VNĐ
                                                            </p>
                                                        </td>
                                                    </tr>

                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- Toast -->
            <div id="toast-message" class="toast toast-cus align-items-center text-white bg-primary border-0"
                role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        Bạn đang đăng nhập với chế độ admin
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer>
            <?php
            include "./partials/footer.php"
            ?>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    jQuery(document).ready(function($) {
        const selectedDateInput = $('input[name="booking-yard-day"]');

        if (selectedDateInput) {
            selectedDateInput.change(function() {
                const selectedDate = selectedDateInput.val();
                window.location.href =
                    `http://football-order.localhost/admin/view-by-date/${selectedDate}`;
            });
        }

        function showToast() {
            var myToastEl = $('#toast-message');
            myToastEl.addClass('show', 'fade', 'toast-list-order');
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

        if (!localStorage.getItem('toastShow')) {
            // Show the toast message
            showToast();
            setTimeout(() => {
                hideToast();
            }, 1500);
            localStorage.setItem('toastShow', 'true');
        }


    });
    </script>
</body>

</html>