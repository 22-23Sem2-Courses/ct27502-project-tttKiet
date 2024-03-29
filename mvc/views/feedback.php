<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Football Order</title>


    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                <h3 class="section-title text-center mb-3 group-box">Đánh giá về các sân bóng ở địa bàn TP Cần Thơ</h3>
                <!-- item -->
                <?php foreach ($data['stadiums'] as $stadium) : ?>
                    <div class="row feedback-row py-3">
                        <div class="col-12 col-lg-5 card-stadium">
                            <!-- Stadium -->
                            <div class="card card-wrapper">
                                <img src="<?php echo $stadium['imgLink']; ?>" class="card-img-top img-content img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fa-solid fa-futbol"></i>
                                        <?php echo $stadium['name']; ?></h5>
                                    <p class="card-text"><i class="fa-solid fa-location-dot"></i> </i> Địa chỉ:
                                        <?php echo $stadium['address']; ?></p>
                                    <p class="card-text"><i class="fa-solid fa-phone"></i> SDT:
                                        <?php echo $stadium['phone']; ?></p>
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
                                                <a href="/feedback/stadium/<?php echo $stadium['id'] ?>" class="view-feedback-detail">Xem tất cả đánh
                                                    giá</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <!-- Feedback -->
                        <div class="col-12 col-lg-7 user-feedback ">
                            <div class="row pt-2 mt-3 d-flex justify-content-center align-items-center">
                                <h2 class="feedback-title text-center group-box" style="width: 95%;">Một số đánh giá của
                                    các
                                    cầu thủ về
                                    <?php echo $stadium['name']; ?>
                                </h2>
                            </div>

                            <?php


                            $feedbacksBySId = $this->model("feedback");
                            $feedbacks = $feedbacksBySId->getFeedbackWithStadiumId($stadium['id']);
                            $count = 0;
                            if (count($feedbacks) <= 0) {
                                echo '
                                <div class="row pt-5 mt-5 title-no-feedback">
                                <h3 class="text-center text-light  w-50 bg-success py-3 shadow-lg rounded " style="font-size: 14px;">Sân này hiện tại chưa có đánh giá nào</h3>
                            </div>
                            
                    ';
                            } else {
                                foreach ($feedbacks as $feedback) {
                                    if ($count == 3) {
                                        break;
                                    }
                                    include_once "./partials/timeAgo.php";
                                    echo '
                        
                        <div class="row mt-3 mx-3">
                            <div class="card">
                                <div class="card-header card-title ">
                                    - ' . $feedback['userName'] . ' -
                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        <p class="card-text card-text-feedback">
                                            ' . $feedback['description'] . '
                                        </p>
                                    </div>
    
                                    <div class="row">
                                        <div class="col">
                                            <div class="star-review list-group-item mt-1">
                                                ';

                                    for ($i = 0; $i < $feedback['star']; $i++) {
                                        echo '<i class="fa-solid fa-star px-1"></i>';
                                    }
                                    echo '
                        </div>
                    </div>
                  
        ';
                                    echo ' <div class="col"> 
                                                ';
                                    if ($feedback['createdAt'] != $feedback['updatedAt']) {
                                        echo '
                                        <p class="card-text text-end time-feedback">
                                                            Đã chỉnh sửa vào: ' . time_ago($feedback['updatedAt']) . '
                                        ';
                                    } else {
                                        echo '
                                        <p class="card-text text-end time-feedback">
                                                            ' . time_ago($feedback['createdAt']) . '
                                        ';
                                    }
                                    echo '</div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            
                                            ';
                                    $count++;
                                }
                            }
                            ?>

                        </div>
                    </div>

                    <hr class="hr-custom">

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script>

    </script>
</body>

</html>