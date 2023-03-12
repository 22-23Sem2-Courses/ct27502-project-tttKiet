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
                <!-- item -->
                <?php foreach ($data['stadiums'] as $stadium) : ?>
                <div class="row feedback-row py-5">
                    <div class="col-5 card-stadium">
                        <!-- Stadium -->
                        <div class="card card-wrapper">
                            <img src="<?php echo $stadium['imgLink']; ?>" class="card-img-top img-content img-fluid"
                                alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $stadium['name']; ?></h5>
                                <p class="card-text">Địa chỉ: <?php echo $stadium['address']; ?></p>
                                <p class="card-text">SDT: <?php echo $stadium['phone']; ?></p>
                                <hr>
                                <div class="row">
                                    <div class="col pt-1">
                                        <div class="star-review list-group-item">
                                            <?php for ($i = 0; $i < $stadium['star']; $i++) : ?>
                                            <i class="fa-solid fa-star"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <div class="col text-end">
                                        <button type="button" class="btn btn-success rounded-pill">
                                            <a href="/feedback/stadium/<?php echo $stadium['id'] ?>"
                                                class="view-feedback-detail">Xem tất cả đánh
                                                giá</a>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <!-- Feedback -->
                    <div class="col-7 user-feedback">
                        <div class="row">
                            <h2 class="text-center">Một số đánh giá của các cầu thủ về <?php echo $stadium['name']; ?>
                            </h2>
                        </div>

                        <?php
                            $feedbacksBySId = $this->model("feedback");
                            $feedbacks = $feedbacksBySId->getFeedbackWithStadiumId($stadium['id']);
                            $count = 0;
                            foreach ($feedbacks as $feedback) {
                                if ($count == 3) {
                                    break;
                                }
                                echo '
                                <div class="row mt-3 mx-3">
                                <div class="card">
                                    <div class="card-header card-title ">
                                        - ' . $feedback['userName'] . ' -
                                    </div>
                                    <div class="card-body ">
                                        <div class="row">
                                            <p class="card-text">
                                            ' . $feedback['description'] . '
                        </p>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="star-review list-group-item mt-1">
                            ';

                                for ($i = 0; $i < $feedback['star']; $i++) {
                                    echo '<i class="fa-solid fa-star"></i>';
                                }

                                echo '
                    </div>
                </div>
                <div class="col">
                    <p class="card-text text-end time-feedback">
                        ' . $feedback['createdAt'] . '
                </div>
            </div>
    </div>
    </div>
    </div>
    ';
                                $count++;
                            }
                            ?>

                    </div>
                </div>
                <hr>

                <?php endforeach; ?>
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
    // const rating = document.querySelector('.rating');
    // const stars = rating.querySelectorAll('input');
    // const btnSubmit = document.querySelector("#btn-submit");

    // for (let i = 0; i < stars.length; i++) {
    //     stars[i].addEventListener('click', function() {
    //         for (let j = 0; j < stars.length; j++) {
    //             if (j <= i) {
    //                 stars[j].checked = true;
    //             } else {
    //                 stars[j].checked = false;
    //             }
    //         }
    //     });
    // }
    </script>
</body>

</html>