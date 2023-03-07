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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

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

                <!-- Toggle -->
                <div class="row create-feedback">
                    <div class="col-6">
                        <p>
                            <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Viết đánh giá của bạn
                            </button>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <form>
                                <div class="row form-row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Địa chỉ email</label>
                                            <input type="email" class="form-control" id="email">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Số điện thoại</label>
                                            <input type="number" class="form-control" id="phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-row mb-3">
                                    <div class="col">
                                        <select class="form-select">
                                            <option selected>Chọn sân bóng</option>
                                            <option value="1">Sân 116</option>
                                            <option value="2">Sân quân đội</option>
                                            <option value="3">Sân CTU</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">1 <i class="fa-solid fa-star star-color"></i></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">2 <i class="fa-solid fa-star star-color"></i></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">3 <i class="fa-solid fa-star star-color"></i></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-row my-3">
                                    <div class="mb-3">
                                        <label for="content-feedback" class="form-label">Nội dung:</label>
                                        <textarea class="form-control" id="content-feedback" rows="3"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Gửi đánh giá</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- item -->
                <div class="row feedback-row my-5">
                    <div class="col-5 card-stadium">
                        <div class="card">
                            <img src="https://images.pexels.com/photos/3448250/pexels-photo-3448250.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top img-content img-fluid" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Sân bóng 116</h5>
                                <p class="card-text">Sân bóng đá cỏ đẹp, mượt, ở gần Trường Đại Học Cần Thơ</p>
                                <p class="card-text">SDT: 0123456789</p>
                                <hr>
                                <div class="star-review list-group-item"><i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                            </div>
                            <!-- <div class="card-body">
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-7 user-feedback">
                        <div class="row">
                            <h2 class="text-center">Một số đánh giá của các cầu thủ về sân 116</h2>
                        </div>
                        <div class="row mt-3 mx-3">
                            <div class="card">
                                <div class="card-header card-title">
                                    - Lại Thế Văn -
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <p class="card-text">Đèn sáng, sân êm, cho 5 sao</p>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="star-review list-group-item mt-1"><i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <p class="card-text text-end time-feedback">20/1/2021</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 mx-3">
                            <div class="card">
                                <div class="card-header card-title">
                                    - Bùi Tuấn Kiệt -
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <p class="card-text">Sân khá ổn, anh có thể đá được, đội mình cân hết. Cho 4 sao</p>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="star-review list-group-item mt-1">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <p class="card-text text-end time-feedback">20/1/2021</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <hr>

                <!-- item -->
                <div class="row feedback-row my-5">
                    <div class="col-5 card-stadium">
                        <div class="card">
                            <img src="https://images.pexels.com/photos/3448250/pexels-photo-3448250.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top img-content img-fluid" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Sân bóng 116</h5>
                                <p class="card-text">Sân bóng đá cỏ đẹp, mượt, ở gần Trường Đại Học Cần Thơ</p>
                                <p class="card-text">SDT: 0123456789</p>
                                <hr>
                                <div class="star-review list-group-item"><i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                            </div>
                            <!-- <div class="card-body">
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-7 user-feedback">
                        <div class="row">
                            <h2 class="text-center">Một số đánh giá của các cầu thủ về sân 116</h2>
                        </div>
                        <div class="row mt-3 mx-3">
                            <div class="card">
                                <div class="card-header card-title">
                                    - Lại Thế Văn -
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <p class="card-text">Đèn sáng, sân êm, cho 5 sao</p>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="star-review list-group-item mt-1"><i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <p class="card-text text-end time-feedback">20/1/2021</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 mx-3">
                            <div class="card">
                                <div class="card-header card-title">
                                    - Bùi Tuấn Kiệt -
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <p class="card-text">Sân khá ổn, anh có thể đá được, đội mình cân hết. Cho 4 sao</p>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="star-review list-group-item mt-1">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <p class="card-text text-end time-feedback">20/1/2021</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>