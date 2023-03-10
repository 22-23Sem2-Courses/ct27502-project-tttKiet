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
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="./assets/css/feedback.css">
    <link rel="stylesheet" href="./assets/css/header-nav.css">
    <link rel="stylesheet" href="./assets/css/footer.css">

</head>

<body>
    <div id="root">
        <header id="header">
            <?php
            include "./partials/header-nav.php"
            ?>
        </header>

        <main id="main" class="">
            <div class="feedback-content container">
                <h1 class="section-title text-center mb-5">Đánh giá về các sân bóng ở địa bàn TP Cần Thơ</h1>

                <!-- Modal -->
                <div class="modal fade" id="feedback-modal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered ">
                        <div class="modal-content ">
                            <form action="/feedback/add" name="form-add-feedback" method="post">
                                <div class="modal-header bg-success text-light bg-gradient">
                                    <h1 class="modal-title fs-5 " id="exampleModalLabel">Viết đánh giá của bạn
                                        về sân ...
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body ">
                                    <div class="row form-row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Địa chỉ email:</label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    placeholder="<?php echo $_SESSION['user']['email']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="fullName" class="form-label">Họ và tên:</label>

                                                <input type="text"
                                                    placeholder="<?php echo $_SESSION['user']['fullName']; ?>"
                                                    name="fullName" class="form-control" id="fullName" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-row mb-3">
                                        <div class="col">
                                            <div class="rating">
                                                <input type="radio" id="star5" name="rating" value="5" /><label
                                                    for="star5"></label>
                                                <input type="radio" id="star4" name="rating" value="4" /><label
                                                    for="star4"></label>
                                                <input type="radio" id="star3" name="rating" value="3" /><label
                                                    for="star3"></label>
                                                <input type="radio" id="star2" name="rating" value="2" /><label
                                                    for="star2"></label>
                                                <input type="radio" id="star1" name="rating" value="1" /><label
                                                    for="star1"></label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row form-row my-3">
                                        <div class="mb-3">
                                            <label for="content-feedback" class="form-label">Nội dung:</label>
                                            <textarea class="form-control" name="description" id="content-feedback"
                                                rows="3"></textarea>
                                        </div>
                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="btn-submit" class="btn btn-warning rounded-pill">Gửi đánh
                                        giá</button>
                                    <button type="button" class="btn btn-secondary rounded-pill"
                                        data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- item -->
                <div class="row feedback-row my-5">
                    <div class="col-5 card-stadium">
                        <!-- Stadium -->
                        <div class="card">
                            <img src="https://images.pexels.com/photos/3448250/pexels-photo-3448250.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                class="card-img-top img-content img-fluid" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Sân bóng 116</h5>
                                <p class="card-text">Sân bóng đá cỏ đẹp, mượt, ở gần Trường Đại Học Cần Thơ</p>
                                <p class="card-text">SDT: 0123456789</p>
                                <hr>
                                <div class="row">
                                    <div class="col pt-1">
                                        <div class="star-review list-group-item"><i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="col text-end">

                                        <?php

                                        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
                                            echo '
                                                    <button type="button" class="btn btn-success rounded-pill disabled" data-bs-toggle="modal" data-bs-target="#feedback-modal">
                                                    Bạn phải đăng nhập để viết đánh giá
                                                </button>   
                                                    ';
                                        } else {
                                            if (isset($_SESSION['user'])) {
                                                echo '
                                                <button type="button" class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#feedback-modal">
                                                Viết đánh giá
                                            </button>
                                                ';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Feedback -->
                    <div class="col-7 user-feedback">
                        <div class="row">
                            <h2 class="text-center">Một số đánh giá của các cầu thủ về sân 116</h2>
                        </div>

                        <?php foreach ($data['feedbacks'] as $feedback) : ?>
                        <div class="row mt-3 mx-3">
                            <div class="card">
                                <div class="card-header card-title">
                                    - Lại Thế Văn -
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <p class="card-text"><?php echo $feedback->description; ?></p>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="star-review list-group-item mt-1">
                                                <?php for ($i = 0; $i < $feedback->star; $i++) : ?>
                                                <i class="fa-solid fa-star"></i>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <p class="card-text text-end time-feedback">
                                                <?php echo $feedback->created_at; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <hr>


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
    <script>
    const rating = document.querySelector('.rating');
    const stars = rating.querySelectorAll('input');
    const btnSubmit = document.querySelector("#btn-submit");

    for (let i = 0; i < stars.length; i++) {
        stars[i].addEventListener('click', function() {
            for (let j = 0; j < stars.length; j++) {
                if (j <= i) {
                    stars[j].checked = true;
                } else {
                    stars[j].checked = false;
                }
            }
        });
    }
    </script>
</body>

</html>