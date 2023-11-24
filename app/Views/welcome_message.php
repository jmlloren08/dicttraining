<?php include 'template/header.php'; ?>

<body>

    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="#">
                        <span>
                            DILG STS
                        </span>
                    </a>    

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav  ">
                            <?php if (session('user')) : ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="dashboard">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="login/logout">Logout</a>
                                </li>
                            <?php else : ?>
                        </ul>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="quote_btn-container">
                                    <a href="login" class="quote_btn">
                                        Login
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="quote_btn-container">
                                    <a href="register" class="quote_btn">
                                        Register
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->
        <!-- slider section -->
        <section class="slider_section ">
            <div id="customCarousel1" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container ">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="img-box">
                                        <img src="images/slider-img.png" alt="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="detail-box">
                                        <h1>Welcome <?= session('user') ? session('user')['username'] : "to DILG Support Ticket System"; ?> </h1>
                                        <p>
                                        At the core of our platform is a commitment to streamline and enhance your customer support experience.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- end slider section -->
    </div>

    <!-- service section -->
    <section class="service_section layout_padding" id="services">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Our Services
                </h2>
                <p>
                Our Support Ticket System offers a range of solutions, from efficient ticket management to personalized customer interactions. Dive into a world where issue resolution is seamless, communication is instant, and customer satisfaction is paramount. Discover how our services redefine support excellence for your business.
                </p>
            </div>
        </div>
    </section>
    <!-- end service section -->

    <!-- about section -->

    <section class="about_section layout_padding" id="about">
        <div class="container  ">
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2>
                                About Us
                            </h2>
                        </div>
                        <p>
                        Learn about our dedication to efficiency, user-friendly interfaces, and the seamless resolution of issues. Discover how we empower businesses to prioritize customer satisfaction through our innovative ticketing solutions. Your journey to efficient support starts with understanding who we are and what drives us.
                        </p>
                        <a href="#">
                            Read More
                        </a>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="img-box">
                        <img src="images/about-img.png" alt="">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- end about section -->

    <!-- contact section -->

    <section class="contact_section layout_padding" id="contact">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-4 offset-md-1">
                    <div class="form_container">
                        <div class="heading_container">
                            <h2>
                                Request A Call back
                            </h2>
                        </div>
                        <form action="">
                            <div>
                                <input type="text" placeholder="Full Name " />
                            </div>
                            <div>
                                <input type="email" placeholder="Email" />
                            </div>
                            <div>
                                <input type="text" placeholder="Phone number" />
                            </div>
                            <div>
                                <input type="text" class="message-box" placeholder="Message" />
                            </div>
                            <div class="d-flex ">
                                <button>
                                    SEND
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 col-lg-7 px-0">
                    <div class="map_container">
                        <div class="map">
                            <div id="googleMap"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end contact section -->

    <div class="footer_container">
        <!-- info section -->

        <section class="info_section ">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3 ">
                        <div class="info_detail">
                            <h4>
                                DILG STS
                            </h4>
                            <p>
                            Learn more about our commitment to delivering a seamless support experience, where every interaction is a step towards customer satisfaction and business success.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2 mx-auto">
                        <div class="info_link_box">
                            <h4>
                                Links
                            </h4>
                            <div class="info_links">
                                <a class="" href=".">
                                    Home
                                </a>
                                <a class="" href="#about">
                                    About
                                </a>
                                <a class="" href="#services">
                                    Services
                                </a>
                                <a class="" href="#contact">
                                    Contact Us
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-0 ml-auto">
                        <div class="info_contact">
                            <h4>
                                Address
                            </h4>
                            <div class="contact_link_box">
                                <a href="#">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <span>
                                        Balintawak, Pagadian City
                                    </span>
                                </a>
                                <a href="#">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <span>
                                        Call 062 925 0282
                                    </span>
                                </a>
                                <a href="#">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <span>
                                        r9dilg@gmail.com
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- end info section -->

        <!-- footer section -->
        <footer class="footer_section">
            <div class="container">
                <p>
                    &copy; <span id="displayYear"></span> All Rights Reserved.
                    <a href="#">DILG Region IX</a>
                </p>
            </div>
        </footer>
        <!-- footer section -->
    </div>

    <?php include 'template/scripts.php'; ?>

</body>

</html>