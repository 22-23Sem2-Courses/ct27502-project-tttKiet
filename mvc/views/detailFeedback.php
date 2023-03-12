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
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="stylesheet" href="/assets/css/feedback.css">
    <link rel="stylesheet" href="/assets/css/header-nav.css">
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
            <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-bs-autohide="false">
                <div class="toast-header">
                    <img src="..." class="rounded me-2" alt="...">
                    <strong class="me-auto">Bootstrap</strong>
                    <small>11 mins ago</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Hello, world! This is a toast message.
                </div>
            </div>
            <div class="feedback-content container">
                <?php

                echo '
                        <h1 class="section-title text-center mb-5">Tất cả đánh giá chi tiết về sân ' . $data["stadium"]['name'] . '</h1>
                        <!-- item -->
                        <div class="row feedback-row my-5">
                            <div class="col-6 card-stadium">
                                <!-- Stadium -->
                                <div class=" card card-wrapper">
                                    <img src="' . $data["stadium"]['imgLink'] . '" class="card-img-top img-content img-fluid" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Tên sân bóng: ' . $data["stadium"]['name'] . '</h5>
                                        <p class="card-text">Địa chỉ: ' . $data["stadium"]['address'] . '</p>
                                        <p class="card-text">SDT: ' . $data["stadium"]['phone'] . '</p>
                                        <hr>
                                        <div class="row">
                                            <div class="col pt-1">
                                                <div class="star-review list-group-item">
    
                                                ';

                for ($i = 0; $i < $data["stadium"]["star"]; $i++) {
                    echo '<i class="fa-solid fa-star"></i>';
                }

                echo '
                                              
                                                </div>
                                            </div>
                                            <div class="col text-end">
                                            </div>
                                        </div>
                                    </div>
    
                                </div>
                            </div>
    
                            <!-- Write feedback -->
                            <div class="col-6">
                                
                                <div class="form-wrapper">
                                
                                <form action="/feedback/add" name="form-add-feedback" class="form-add-feedback" method="post"> 
                                        <div class="row py-3">
                                            <h1 class="modal-title fs-5 text-center" >Viết đánh giá của bạn
                                                về sân ' . $data['stadium']['name'] . '
                                            </h1>
                                        </div>
                                        <div class="row form-row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Địa chỉ email:</label>
                                                    <input type="email" name="email" class="form-control" id="email" placeholder="' . $_SESSION['user']['email'] . '" disabled>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="fullName" class="form-label">Họ và tên:</label>
    
                                                    <input type="text" placeholder="' . $_SESSION['user']['fullName'] . '" name="fullName" class="form-control" id="fullName" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-row mb-3">
                                            <div class="col">
                                                <div class="rating">
                                                    <input type="radio" id="star5" name="rating" value="5" required/><label for="star5"></label>
                                                    <input type="radio" id="star4" name="rating" value="4" required/><label for="star4"></label>
                                                    <input type="radio" id="star3" name="rating" value="3" required/><label for="star3"></label>
                                                    <input type="radio" id="star2" name="rating" value="2" required/><label for="star2"></label>
                                                    <input type="radio" id="star1" name="rating" value="1" required/><label for="star1"></label>
                                                </div>
    
                                            </div>
                                        </div>
    
                                        <div class="row form-row my-3">
                                            <div class="mb-3">
                                                <label for="content-feedback" class="form-label">Nội dung:</label>
                                                <textarea class="form-control" name="description" id="content-feedback" rows="3" required></textarea>
                                            </div>
                                        </div>
    
                                        <!-- Hidden input -->
                                        <input type="hidden" name="stadiumId" value="' . $data["stadium"]['id'] . '">
                                        <input type="hidden" name="userId" value="' . $_SESSION['user']['id'] . '">
    
                                    
                                    <div class="text-end">
                                        <button type="submit" id="btn-submit" class="btn btn-warning rounded-pill ">Gửi đánh
                                            giá</button>
    
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        ';

                ?>



                <div class="row">
                    <div class="row">
                        <h2 class="text-center mt-4">Tất cả đánh giá của các cầu thủ về
                            <?php echo $data["stadium"]['name'] ?>
                        </h2>
                    </div>
                    <div class="feedback-detail">

                        <!-- display all feedback here -->
                        <?php

                        $feedbacksBySId = $this->model("feedback");
                        $feedbacks = $feedbacksBySId->getFeedbackWithStadiumId($data["stadium"]['id']);

                        // Your feedback
                        foreach ($feedbacks as $feedback) {
                            if ($feedback['userId'] == $_SESSION['user']['id']) {
                                echo '
                            <div class="row mt-3 mx-3">
                            <div class="card">
                                <div class="card-header card-title bg-success text-white">
                                    - ' . $feedback['userName'] . ' - <span class="badge text-bg-danger rounded-pill ms-5">Đây là đánh giá của bạn</span>
                                </div>


                                <div class="card-body">
                                    <div class="row">
                                        <p class="card-text">' . $feedback['description'] . '</p>
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
                                            ' . $feedback['createdAt'] . '</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            ';
                            }
                        }

                        // Another feedback
                        foreach ($feedbacks as $feedback) {
                            if ($feedback['userId'] != $_SESSION['user']['id']) {

                                echo '
                                <div class="row mt-3 mx-3">
                                <div class="card">
                                    <div class="card-header card-title ">
                                        - ' . $feedback['userName'] . ' -
                                    </div>
    
    
                                    <div class="card-body">
                                        <div class="row">
                                            <p class="card-text">' . $feedback['description'] . '</p>
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
                                                ' . $feedback['createdAt'] . '</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                ';
                            }
                        }
                        ?>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script>

    </script>
</body>

</html>