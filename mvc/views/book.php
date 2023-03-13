<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Football Order</title>


        <!-- Icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

        <!-- Bootstrap 5-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <!-- Css -->
        <link rel="stylesheet" href="/assets/css/index.css">
        <link rel="stylesheet" href="/assets/css/header-nav.css">
        <link rel="stylesheet" href="/assets/css/book.css">
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
                <div class='container'>
                    <div class='row g-5'>
                        <div class="col-md-8 col-12">
                            <div class="image">
                                <img src="<?php echo $data['stadium'] -> imgLink ?>" alt="">
                            </div>

                            <div class='content'>
                                <div class='pt-4'>
                                    <h1 class="title"><?php echo $data['stadium'] -> name ?></h1>
                                </div>

                                <div class="star">
                                    <span class="star-item">
                                        <i class="fa-solid fa-star"></i>
                                    </span>
                                    <span class="star-item">
                                        <i class="fa-solid fa-star"></i>
                                    </span>
                                    <span class="star-item">
                                        <i class="fa-solid fa-star"></i>
                                    </span>
                                    <span class="star-item">
                                        <i class="fa-solid fa-star"></i>
                                    </span>
                                    <span class="star-item">
                                        <i class="fa-regular fa-star"></i>
                                    </span>
                                    <span class="star-item">
                                        <i class="fa-regular fa-star"></i>
                                    </span>

                                    <span class="star-int">
                                        <?php echo $data['stadium'] -> star ?>
                                    </span>

                                    <span class="star__report"><a href='/feedback/1'>(2 đánh giá)</a></span>
                                </div>

                                <div class="location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <?php echo $data['stadium'] -> address ?>
                                </div>
                                <hr />
                                <div>
                                    <h1 class="title">Khung giờ</h1>
                                    <div class="time-open">
                                        Mở cửa từ <span class="hightLight"><?php echo $data['stadium'] -> openTime ?>
                                            -
                                            <?php echo $data['stadium'] -> closeTime ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                            <div class="description">
                                <div class="time">
                                    <h2>Tìm kiếm sân trống</h2>
                                    <div class="search-time-yard">
                                        <input type="date" value='<?php echo date('Y-m-d'); ?>' name="booking-yard-day"
                                            id="date-booking-yard-day">

                                        <button type="button" data-id="<?php echo $data['stadium'] -> id; ?>"
                                            class='btn btn-secondary btn-cus btn-search-date'>Tìm kiếm</button>
                                    </div>
                                </div>

                                <!-- San trong -->
                                <div class="free-time-yard"></div>
                                <hr />
                                <div class="booking ">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class='booking__input'>
                                                <h3>Chọn giờ đá</h3>
                                                <input required value='18:00:00' name='hour-booking' type="time">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class='booking__input'>
                                                <h3>Số giờ thuê</h3>
                                                <select name="book" id="book">
                                                    <option value="1" default>1h</option>
                                                    <option value="1.5">1,5h</option>
                                                    <option value="2">2h</option>
                                                    <option value="2,5">2,5h</option>
                                                    <option value="3">3h</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="book__submit">
                                    <button type="submit" class='book-here btn btn-primary btn-cus'> Đặt
                                        ngay</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <div>
                <?php
                    include "./partials/footer.php"
                ?>
            </div>
        </div>
        <!-- Jquery -->

        <script src=" https://code.jquery.com/jquery-3.6.4.js"
            integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
        <script>
        $(document).ready(function() {
            const searchElement = $('.btn-search-date');
            const dateBookingInput = $('input[name="booking-yard-day"]');
            const hourBook = $('input[name="hour-booking"]');
            const bookHere = $('.book-here');
            const freeTimeYard = $('.free-time-yard');
            const numberHourSelect = $('#book');
            const dateValue = dateBookingInput.val();

            searchElement.on('click', function(e) {
                getData($(e.currentTarget).attr('data-id'));
            });

            bookHere.on('click', function(e) {
                const dateValue = dateBookingInput.val();
                const hourBooking = hourBook.val()
                const numberHour = numberHourSelect.val();

                // console.log(dateValue)
                // console.log(hourBooking)
                // console.log(numberHour)
                if (!dateValue || !hourBook || !numberHour) {

                } else {
                    bookCalendar(dateValue, hourBooking, numberHour, 1, 1);
                }
            })


            getData(searchElement.attr('data-id'));

            function bookCalendar(dateValue, hourTimeBook, hour, userId, stadiumChildrenId) {
                $.post({
                    url: `/order/booking`,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        dateValue,
                        hourTimeBook,
                        numberHour: hour,
                        userId,
                        stadiumChildrenId
                    },
                    success: function(data, status) {
                        console.log(data);
                    },
                    error: function(xhr, status, error) {
                        console.log('XHR:', xhr);
                        console.log('Status:', status);
                        console.log('Error:', [error]);
                    }
                })
            }

            function getData(id) {
                const dateValue = dateBookingInput.val();

                $.get({
                    url: `/order/filterEmptyYard/${id}/${dateValue}`,
                    dataType: 'json',
                    type: 'GET',
                    success: function(data, status) {
                        renderHtml(data);
                    },
                    error: function(xhr, status, error) {
                        console.log('XHR:', xhr);
                        console.log('Status:', status);
                        console.log('Error:', [error]);
                    }
                })
            };

            function renderHtml(data) {
                let html = '';
                if (data.code === 0) {
                    for (let i = 0; i < data.order.length; i++) {
                        html += `
                            <ul class="list-yard">
                                <li class="icon-yard">
                                    <i class="fa-solid fa-angle-down"></i>
                                    <h1 class="yard-name">Sân số ${i + 1} (sân ${data.order[i].type})</h1>
                                </li>
                                ${data.order[i].free.reduce((init, data) => {
                                    return init + `
                                        <li class="list-yard-item">
                                            <i class="fa-solid fa-circle"></i>
                                            <span> Trống từ ${data.from} - ${data.end}</span>
                                        </li>
                                    `;
                                }, '')}

                            </ul>
                        `;
                    }

                    freeTimeYard.html(html);
                }
            }


        })
        </script>
    </body>

</html>