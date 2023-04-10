<div class="navbar">
    <div class="header__nav container">
        <a href='/' class="header__nav--logo">
            <img src="/assets/images/logo.jpg" alt="FootBall" class="img">
        </a>

        <div class='wrap-auth'>
            <div class='more'>
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="header__list ">
                <ul class="header__list--nav">
                    <li class="header__list--item">
                        <a href="/" class="header__item--link">Trang chủ</a>
                    </li>
                    <li class="header__list--item">
                        <a href="/about" class="header__item--link">Giới thiệu</a>
                    </li>
                    <?php
                    $currentDate = date('Y-m-d');
                    if (isset($_SESSION['loggedin']) && $_SESSION['user']['type'] == 'admin') {
                        echo '
                            <li class="header__list--item">
                                <a href="/admin/view-by-date/' . $currentDate . '" class="header__item--link">Xem lịch</a>
                            </li>
                        ';
                    } else {
                        echo '                                        
                            <li class="header__list--item">
                                <a href="/order" class="header__item--link">Đặt sân</a>
                            </li>                                            
                        ';
                    }
                    ?>
                    <li class="header__list--item">
                        <a href="/feedback" class="header__item--link">Đánh giá</a>
                    </li>
                </ul>

                <div class="authentication">

                    <?php
                    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
                        echo "
                                <a href='/user/login' class='login'>
                                    ĐĂNG NHẬP
                                </a>
                            ";
                    } else {
                        if (isset($_SESSION['user'])) {
                            echo "
                                    <div href='/user/login' class='user'>
                                        {$_SESSION['user']['email']}
                
                                         <div class='icon-down'>
                                            <i class='fa-solid fa-chevron-down'></i>
                                            <div class='menu__user'>
                                                <a  href='/user/account' class='menu__user--item'>
                                                    Tài khoản của tôi
                                                </a>
                                                
                                ";
                        }
                        if (isset($_SESSION['user']) && $_SESSION['user']['type'] == 'user') {
                            echo "<a href='/user/soccer-field-booking-calendar' class='menu__user--item'>
                            Xem lịch đặt sân
                        </a>";
                        }

                        echo "
                                    
                            <a href='/?logout=true' class='menu__user--item'>
                            Đăng xuất
                         </a>
                      </div>
                  </div>
              </div>         
                                ";
                    }
                    ?>


                </div>
            </div>
        </div>
    </div>
</div>

<!-- script -->

<script>
    const more = document.querySelector('.more');
    const headerList = document.querySelector('.header__list');
    more.onclick = () => {
        headerList.classList.toggle('active')
    }
</script>