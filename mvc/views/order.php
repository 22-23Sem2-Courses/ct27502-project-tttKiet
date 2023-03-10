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
        <link rel="stylesheet" href="/assets/css/order.css">
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
                    <div>
                        <h1 class='title'>Tham khảo các sân bóng đá tại FOOTBALL - ORDER</h1>
                    </div>
                    <div class="row g-5">
                        <?php foreach($data['stadiums'] as $stadium): ?>
                        <div class="col-md-3 col-sm-4 col-12">
                            <div class="card">
                                <div class="card__image">
                                    <img src="<?php echo $stadium['imgLink']  ?>" alt="FOOT BALL - Yard">
                                    <div class="card__title">
                                        <h1 class="title__name"> <?php echo $stadium['name'] ?> </h1>
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
                                        </div>
                                    </div>
                                </div>
                                <div class="card__address">
                                    <span><?php echo $stadium['address'] ?></span>
                                </div>
                                <div class="card__book">
                                    <a href="/order/book/'<?php echo $stadium['id']?>" class="yard">
                                        <span>
                                            <i class="uil uil-book-medical"></i></span>
                                        Đặt sân</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>





                    </div>
                </div>


            </main>
            <!-- TEST -->


            <div>
                <?php
                include "./partials/footer.php"
                ?>
            </div>
        </div>
    </body>

</html>

<!-- Pull LTV -->