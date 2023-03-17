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

                                    <?php 
                                        for($i = 1; $i <= 5; $i++)
                                            if(round($data['stadium'] -> star) < $i) {
                                                echo '<span class="star-item">
                                                         <i class="fa-regular fa-star"></i>
                                                     </span>';
                                            } else {
                                                echo '
                                                    <span class="star-item">
                                                        <i class="fa-solid fa-star"></i>
                                                    </span>
                                                ';
                                            }
                                    ?>

                                    <span class="star-int">
                                        <?php echo $data['stadium'] -> star ?>
                                    </span>

                                    <span class="star__report"><a
                                            href='/feedback/stadium/<?= $data['stadium'] -> id ?>'>(<?= $data['stadium'] -> star ?>
                                            đánh
                                            giá)</a></span>
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
                                    <h3 class='book-title book-title-pri'>Tìm kiếm sân trống</h3>
                                    <div class="search-time-yard">
                                        <label for="date-booking-yard-day">Xem ngày: </label>
                                        <input type="date" value='<?php echo date('Y-m-d'); ?>' name="booking-yard-day"
                                            id="date-booking-yard-day" data-id="<?php echo $data['stadium'] -> id; ?>">

                                    </div>
                                </div>

                                <!-- San trong -->
                                <div class="free-time-yard"></div>
                                <hr />
                                <div class="booking ">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class='booking__input'>
                                                <label for="hour-booking" class='book-title'>Chọn giờ đá: </label>
                                                <input required value='18:00:00' name='hour-booking' id="hour-booking"
                                                    type="time">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class='booking__input'>
                                                <label for="book" class='book-title'>Số giờ thuê: </label>
                                                <select name="book" id="book">
                                                    <option value="1" default>1h</option>
                                                    <option value="1.5">1,5h</option>
                                                    <option value="2">2h</option>
                                                    <option value="2,5">2,5h</option>
                                                    <option value="3">3h</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class='booking__input' id='book-yard'>
                                                <!-- Chọn sân -->
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <span class='err'>
                                                <!-- Lỗi-->
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="book__submit">
                                    <button type="submit" class='book-here btn btn-primary btn-submit-booking'> Đặt
                                        ngay</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div id="model-auth">
                    <div id="model-auth__container">
                        <div class="container">
                            <div class="row g-5">
                                <div class="col-md-12 col-12">
                                    <div class='row g-5'>
                                        <div class="col-12">
                                            <h3 class="title1">Xác nhận Bill đặt sân của bạn</h3>
                                        </div>
                                        <div class="col-md-9 border-r ">
                                            <div class="model-auth__bill">
                                                <div>
                                                    <div class="model-auth__bill--decs">
                                                        <div class="wrap-detai">
                                                            <h3>Sân bóng:</h3>
                                                            <span
                                                                id='model__name__yard'><?php echo $data['stadium'] -> name ?></span>
                                                        </div>
                                                        <div class="wrap-detai">
                                                            <h3>Địa chỉ:</h3>
                                                            <span id='model__address'>
                                                                <?php echo $data['stadium'] -> address ?>
                                                            </span>
                                                        </div>
                                                        <div class="wrap-detai">
                                                            <h3>Mã sân:</h3>
                                                            <span id='model__stadiumChildrenId'>S4</span>
                                                        </div>
                                                        <div class="wrap-detai">
                                                            <h3>Số người chơi tối đa:</h3>
                                                            <span id='model__type'>5</span>
                                                        </div>
                                                        <div class="wrap-detai">
                                                            <h3>Ngày thuê:</h3>
                                                            <span id='model__date__book'>14/2/2002</span>
                                                        </div>

                                                        <div class="wrap-detai">
                                                            <h3>Số giờ thuê:</h3>
                                                            <span id='model__number__booking'>3 Giờ</span>
                                                        </div>

                                                        <div class="wrap-detai">
                                                            <h3>Đơn giá:</h3>
                                                            <span id='model__price'>100k / h</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 left-align">
                                            <div class="wrap-detai">
                                                <h3>Tổng thiệt hại:</h3>
                                                <span id='model__price__danger'>100k x 3 = 300k</span>
                                            </div>
                                            <div class="wrap-detai">
                                                <h3>Thành tiền:</h3>
                                                <span id='model__price__sum'>300k</span>
                                            </div>

                                            <div class="authen">
                                                <button class="btn btn-auth btn-agree btn-primary">Đồng ý</button>
                                                <button class="btn btn-auth btn-back btn-danger">Hủy</button>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <span class="please">**Vui lòng thanh toán sau khi thuê sân và không hủy
                                                lịch đã
                                                đặt!</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="close">
                            <i class="fa-solid fa-x"></i>
                        </div>
                    </div>
                </div>
            </main>
            <div>
                <?php
                    include "./partials/footer.php"
                ?>
            </div>
            <!-- toast -->
            <?php
                $bootstrap['message'] = 'Ok! Bạn đã đặt sân thành công.';
                include "./partials/toast.php";
            ?>

        </div>


        <!-- Jquery -->
        <script src=" https://code.jquery.com/jquery-3.6.4.js"
            integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous">
        </script>

        <!-- bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
        </script>



        <script>
        $(document).ready(function() {

            const dateBookingInput = $('input[name="booking-yard-day"]');
            const hourBook = $('input[name="hour-booking"]');
            const bookHere = $('.book-here');
            const freeTimeYard = $('.free-time-yard');
            const numberHourSelect = $('#book');
            const modelAuth = $('#model-auth');
            const modelAuthX = $('.close');

            // model
            const btnBack = $('.btn-back');
            const btnAgree = $('.btn-agree');

            // Element Jquery model-auth
            const model__stadiumChildrenId = $('#model__stadiumChildrenId');
            const model__type = $('#model__type');
            const model__date__book = $('#model__date__book');
            const model__number__booking = $('#model__number__booking');
            const model__price = $('#model__price');
            const model__price__danger = $('#model__price__danger');
            const model__price__sum = $('#model__price__sum');


            const dateValue = dateBookingInput.val();
            let arrayYardChildren = [];

            dateBookingInput.on('change', function(e) {
                getData(<?php echo $data['stadium'] -> id; ?>);
                model__date__book.text($(this).val())

            })

            // handle model
            bookHere.on('click', function(e) {
                if (modelAuth) {
                    const dateValue = dateBookingInput.val();
                    const hourBooking = hourBook.val()
                    const numberHour = numberHourSelect.val();
                    const yard = $('#yard');
                    const yardId = yard.val();
                    if (!dateValue || !hourBook || !numberHour) {

                    } else {
                        isAddOrder(dateValue, hourBooking, numberHour, yardId)
                    }
                }
            });

            // Click nút hủy
            btnBack.on('click', function() {
                modelAuth.removeClass('show')
            })

            // Click nút xác thực
            btnAgree.on('click', function() {
                const dateValue = dateBookingInput.val();
                const hourBooking = hourBook.val()
                const numberHour = numberHourSelect.val();
                const yard = $('#yard');
                const yardId = yard.val();
                if (!dateValue || !hourBook || !numberHour) {

                } else {
                    bookCalendar(dateValue, hourBooking, numberHour,
                        <?php echo $_SESSION['user']['id']?>,
                        yardId);
                }
            })

            modelAuthX.on('click', function() {
                modelAuth.removeClass('show')
                $('body').css('overflow', 'auto');
            })

            getData(<?php echo $data['stadium'] -> id; ?>);


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
                        if (data.code === 0) {
                            getData(<?php echo $data['stadium'] -> id; ?>);

                            showToast();
                            setTimeout(() => {
                                hideToast();
                            }, 3000)
                            modelAuth.removeClass('show')
                        }

                    },

                    error: function(xhr, status, error) {
                        console.log('XHR:', xhr);
                        console.log('Status:', status);
                        console.log('Error:', [error]);
                    }
                })
            }


            function isAddOrder(dateValue, hourTimeBook, hour, stadiumChildrenId) {
                $.get({
                    url: `/order/canAddOrder/${dateValue}/${hourTimeBook}/${hour}/${stadiumChildrenId}`,
                    dataType: 'json',
                    type: 'GET',
                    success: function(data, status) {
                        let err = $('.err');
                        if (data.code === 0) {
                            modelAuth.addClass('show')
                            err.text('')

                        } else if (data.code === 1) {
                            err.text('Thời gian đặt sân của bạn nằm ngoài giờ sân trống!')
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('XHR:', xhr);
                        console.log('Status:', status);
                        console.log('Error:', [error]);
                    }
                })
            }

            numberHourSelect.on('change', function(e) {
                const value = e.target.value;
                model__number__booking.text(value + ' giờ');
                sumPrice()
            });

            function sumPrice() {
                const yard = $('#yard');
                let value = yard.val();
                const currYard = arrayYardChildren.find((e) => e.id == value)
                const sum = currYard.price * numberHourSelect.val();
                model__price__danger.text(`${currYard.price}.000đ X ${numberHourSelect.val()} = ${sum}.000đ`)
                model__price__sum.text(`${sum}.000đ`)
            };

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

            function renderHtmlForChooseYard(arrayYardChildren) {
                const yardChildren = document.querySelector('#book-yard');
                let html = `
                <label for="yard" class='book-title'>Chọn sân: </label>
                    <select name="yard" id="yard">
                `;
                html += arrayYardChildren.reduce((init, val) => {
                    return init + `
                        <option value="${val.id}">S${val.id}</option>
                    `;
                }, '');

                html += '</select>\
                <span class="price"></span>\
                ';
                yardChildren.innerHTML = html;

                const yard = $('#yard');
                const price = $('.price');

                let value = yard.val();
                const currYard = arrayYardChildren.find((e) => e.id == value)

                // default value
                let htmlDefault = `
                        <span class="hlight">${currYard.price}.000đ </span> / 1h
                    `;
                price.html(htmlDefault);
                model__type.text(currYard.type)
                model__price.html(`${currYard.price}.000đ / 1h`);
                model__date__book.text(dateBookingInput.val());
                model__stadiumChildrenId.text('S' + value);
                model__number__booking.text(numberHourSelect.val() + ' giờ')
                sumPrice()

                yard.on('change', function(e) {
                    const price = $('.price');
                    let value = e.target.value;
                    model__stadiumChildrenId.text('S' + value);
                    const currYard = arrayYardChildren.find((e) => e.id == value)
                    let html = `
                        ${currYard.price}.000đ / 1h
                    `;

                    model__price.html(html)
                    model__type.text(currYard.type)
                    price.html(html);
                    sumPrice()
                })
            };

            function renderHtml(data) {
                arrayYardChildren = [...data.order.map((v, i) => {
                    return {
                        id: v.id,
                        price: v.price,
                        type: v.type
                    }
                })];

                renderHtmlForChooseYard(arrayYardChildren);
                let html = '';
                if (data.code === 0) {
                    for (let i = 0; i < data.order.length; i++) {
                        html += `
                            <div>
                                <div class="icon-yard">
                                    <i class="fa-solid fa-angle-down"></i>
                                    <h1 class="yard-name">Sân ${data.order[i].type} - S${data.order[i].id} </h1>
                                </div>
                                <ul class="list-yard">
                                    ${data.order[i].free.reduce((init, data) => {
                                        return init + `
                                            <li class="list-yard-item">
                                                <i class="fa-solid fa-circle"></i>
                                                <span> Trống từ  <span>${data.from} - ${data.end}</span></span>
                                            </li>
                                        `;
                                    }, '')}
    
                                </ul>
                            </div>
                        `;
                    }

                    freeTimeYard.html(html);
                }
            };

        })



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
        </script>



    </body>

</html>