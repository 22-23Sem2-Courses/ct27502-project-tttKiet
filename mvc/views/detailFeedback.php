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
            <div class="feedback-content container">

                <?php

                echo '
                
                        <div class="row title-wrapper">
                        <div class="">
                        <a href="/feedback" class="text-dark back-btn "><i class="fa-solid fa-arrow-left"></i></a>
                        </div>
                        
                        <h3 class="section-title text-center mb-5 group-box pt-4" >Đánh giá chi tiết về sân ' . $data["stadium"]['name'] . '</h3>
                        
                        
                        </div>
                        
                        <!-- item -->
                        <div class="row feedback-row my-5">
                            <div class="col-md-6 card-stadium">
                                <!-- Stadium -->
                                <div class=" card card-wrapper">
                                    <img src="' . $data["stadium"]['imgLink'] . '" class="card-img-top img-content img-fluid" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"> ' . $data["stadium"]['name'] . '</h5>
                                        <p class="card-text">Địa chỉ: ' . $data["stadium"]['address'] . '</p>
                                        <p class="card-text">SDT: ' . $data["stadium"]['phone'] . '</p>
                                        <hr>
                                        <div class="row">
                                            <div class="col pt-1">
                                                <div class="star-review list-group-item">
    
                                                ';

                for ($i = 0; $i <  $data["stadium"]['star']; $i++) {
                    echo '<i class="fa-solid fa-star px-1"></i>';
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

                        ';

                // check user
                if (!isset($_SESSION['loggedin'])) {
                    echo '<div class="col-12 col-md-6 d-flex justify-content-center align-items-center flex-column pt-5">
                    <span class="badge text-bg-success mb-3 "><h3 class="login-require">Bạn hãy đăng nhập để viết đánh giá <i class="fa-sharp fa-solid fa-arrow-down mt-2"></i> </h3> </span>
                    <h3 class="login-require"><a class="text-decoration-none ms-4 " href="/user/login">Đăng nhập ngay</a></h3>
                    </div>';
                }
                ?>





                <!-- display all feedback here -->
                <?php

                $feedbacksBySId = $this->model("feedback");
                $feedbacks = $feedbacksBySId->getFeedbackWithStadiumId($data["stadium"]['id']);
                if (isset($_SESSION['loggedin']) && ($feedbacksBySId->checkAlreadyFeedback($data["stadium"]['id'], $_SESSION['user']['id']))) {
                    // Your feedback
                    foreach ($feedbacks as $feedback) {
                        if (($feedback['userId'] == $_SESSION['user']['id'])) {
                            echo '
                            <div class="col-12 col-md-6">
                                <div class="row mt-3 mx-3">
                                <h1 class="feedback-title py-3 text-center group-box" >Đánh giá của bạn
                                                về sân ' . $data['stadium']['name'] . '
                                            </h1>
                                <div class="card">
                                
                                    <div class="card-header card-title text-bg-success  rounded-top-4">
                                        - ' . $feedback['userName'] . ' - 
                                    </div>


                                    <div class="card-body">
                                        <div class="row">
                                            <p class="card-text">' . $feedback['description'] . '</p>
                                        </div>
                                        <input type="hidden" name="feedbackId" value="' . $feedback['id'] . '">
                                        <input type="hidden" name="stadiumId" value="' . $data["stadium"]['id'] . '">
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
                                            <div class="col">';
                            if ($feedback['createdAt'] != $feedback['updatedAt']) {
                                echo '
                                                <p class="card-text text-end time-feedback">
                                                                    Đã chỉnh sửa vào: ' . $feedback['updatedAt'] . '
                                                ';
                            } else {
                                echo '
                                                <p class="card-text text-end time-feedback">
                                                                    ' . $feedback['createdAt'] . '
                                                ';
                            }
                            echo '
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                                <div class="row">
                                    <div class="col text-end me-3 mt-4">                     
                                        <button type="button" class="btn btn-warning btn-action"><a href="/feedback/update/' . $data["stadium"]['id'] . '" class="text-decoration-none text-dark">Sửa đánh giá</a></button>

                                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-danger btn-action">Xoá đánh giá</button>
                                    </div>
                                </div>
                            </div>
                                ';
                        }
                    }
                }
                // Check admin
                else if (isset($_SESSION['loggedin']) && $_SESSION['user']['type'] == 'admin' && $data["stadium"]['userId'] == $_SESSION['user']['id']) {
                    echo '<div class="col-12 col-md-6 pt-5">
                            <div class="row">
                                <h2 class="feedback-title text-center pb-2 group-box" >Một số thông tin về sân của bạn</h2>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                <div class="card">
                                    <div class="card-body">
                                    <h5 class="card-title">Tổng số đánh giá</h5>
                                    <p class="card-text fs-14">Sân của bạn được được đánh giá ' . $data["stadium"]['star'] . '/5 <i class="fa-solid fa-star px-1"  <i class="fa-brands fa-facebook" style="color: #ffcc00;"></i> </p> 
                                    <p class="card-text fs-14">Hiện tại đã có ' . count($feedbacks) . ' đánh giá</p> 
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="card" style="height: 117px;">
                                    <div class="card-body">
                                    <h5 class="card-title">Tổng số giờ đã thuê</h5>
                                    <p class="card-text">Số giờ đã thuê: ' . $data['sumHours'] . ' giờ</p>
                                    <p class="card-text">Số lượt thuê sân: ' . $data['sumOrders'] . ' lượt</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                } else if (isset($_SESSION['loggedin'])) {
                    echo '
                    <!-- Write feedback -->
                            <div class="col-12 col-md-6 pt-5">
                                
                                <div class="form-wrapper">
                                
                                <form action="/feedback/add" name="form-add-feedback" id="form-add-feedback" class="form-add-feedback group-box" method="post"> 
                                        <div class="row py-3">
                                            <h1 class="modal-title  text-center " >Viết đánh giá của bạn
                                                về sân ' . $data['stadium']['name'] . '
                                            </h1>
                                        </div>
                                        <div class="row form-row ">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label ">Địa chỉ email:</label>
                                                    <input type="email" name="email" class="form-control " id="email" placeholder="' . $_SESSION['user']['email'] . '" disabled>
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
                                                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
                                                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
                                                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
                                                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
                                                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
                                                </div>
                                                <p class="text-danger fs-5 check-star" id="check-star">Bạn chưa chọn số sao ở đây</p>
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
                                        <button type="submit" id="btn-submit" class="btn btn-warning rounded ">Gửi đánh
                                            giá</button>
    
                                    </div>
                                </form>
                                </div>
                            </div>
                    ';
                }
                echo '</div>';
                echo '<div class="row">
                        <div class="row d-flex justify-content-center align-items-center">
                            <h2 class="feedback-title text-center mt-4 group-box " style="width: 100%;">Tất cả đánh giá của các cầu thủ về
                                ' . $data["stadium"]['name'] . '
                            </h2>
                        </div>
                        <div class="feedback-detail group-box">';


                // Another feedback
                foreach ($feedbacks as $feedback) {
                    if (!isset($_SESSION['user']) || ($feedback['userId'] != $_SESSION['user']['id'])) {

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
                            echo '<i class="fa-solid fa-star px-1"></i>';
                        }

                        echo '
    
                                                </div>
                                            </div>
                                            <div class="col">';
                        if ($feedback['createdAt'] != $feedback['updatedAt']) {
                            echo '
                                                                <p class="card-text text-end time-feedback">
                                                                                    Đã chỉnh sửa vào: ' . $feedback['updatedAt'] . '
                                                                ';
                        } else {
                            echo '
                                                                <p class="card-text text-end time-feedback">
                                                                                    ' . $feedback['createdAt'] . '
                                                                ';
                        }

                        echo '
                                                
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Bạn có chắc chắn là muốn xoá đánh giá này?
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fs-4">Thao tác sẽ xoá vĩnh viễn đánh giá và không thể khôi phục.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-delete-feedback" class="btn btn-danger btn-action">Xoá đánh
                        giá</button>
                    <button type="button" class="btn btn-warning btn-action" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast -->
    <!-- <div class="toast-container position-fixed top-0 end-0 p-5 ">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto fs-4">Football Order</strong>
                <small>bây giờ</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <p class="fs-5">Xoá đánh giá thành công</p>

            </div>
        </div>
    </div> -->
    </main>
    <!-- Footer -->
    <footer>
        <?php
        include "./partials/footer.php"
        ?>
    </footer>
    </div>
    </div>
    <!-- toast -->
    <?php
    $bootstrap['message'] = 'Bạn đã xoá feedback thành công';
    include "./partials/toast.php";
    ?>
    </div>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    jQuery.noConflict();
    jQuery(document).ready(function($) {
        const feedbackIdInput = $('input[name="feedbackId"]');
        const liveToast = $('#toast-message');
        // Delete feedback
        if (feedbackIdInput) {
            const feedbackId = feedbackIdInput.val();
            const stadiumIdInput = $('input[name="stadiumId"]');
            const stadiumId = stadiumIdInput.val();
            const toastMessage = $('.toast');
            $('#btn-delete-feedback').click(function() {
                // Send the POST request using jQuery
                $.ajax({
                    url: '/feedback/delete',
                    method: 'POST',
                    data: {
                        feedbackId,
                        stadiumId,
                    },
                    success: function(response) {
                        liveToast.addClass('fade show');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);

                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

            });
        }

        $('#form-add-feedback').submit(function(event) {
            const rating = $('input[name="rating"]:checked').val();
            if (!rating) {
                event.preventDefault(); // Prevent form submission
                $('#check-star').removeClass('check-star');
            }
        });
    });
    </script>
</body>

</html>