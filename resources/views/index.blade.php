<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wave Cafe HTML Template by Tooplate</title>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}" />
    <!-- https://fontawesome.com/ -->
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Open+Sans:300,400') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css')}}"> --}}
    <!-- https://fonts.google.com/ -->
    <link rel="stylesheet" href="{{ asset('css/tooplate-wave-cafe.css') }}" />
    <!--
Tooplate 2121 Wave Cafe
https://www.tooplate.com/view/2121-wave-cafe
-->
</head>

<body>
    <div class="tm-container">
        <div class="tm-row">
            <!-- Site Header -->
            <div class="tm-left">
                <div class="tm-left-inner">
                    <div class="tm-site-header">
                        <i class="fas fa-coffee fa-3x tm-site-logo"></i>
                        <h1 class="tm-site-name">Wave Cafe</h1>
                    </div>
                    <nav class="tm-site-nav">
                        <ul class="tm-site-nav-ul">
                            <li class="tm-page-nav-item">
                                <a href="#drink" class="tm-page-link active">
                                    <i class="fas fa-mug-hot tm-page-link-icon"></i>
                                    <span>Drink Menu</span>
                                </a>
                            </li>
                            <li class="tm-page-nav-item">
                                <a href="#about" class="tm-page-link">
                                    <i class="fas fa-users tm-page-link-icon"></i>
                                    <span>About Us</span>
                                </a>
                            </li>
                            <li class="tm-page-nav-item">
                                <a href="#special" class="tm-page-link">
                                    <i class="fas fa-glass-martini tm-page-link-icon"></i>
                                    <span>Special Items</span>
                                </a>
                            </li>
                            <li class="tm-page-nav-item">
                                <a href="#contact" class="tm-page-link">
                                    <i class="fas fa-comments tm-page-link-icon"></i>
                                    <span>Contact</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="tm-right">
                <main class="tm-main">
                    <div id="drink" class="tm-page-content">
                        <!-- Drink Menu Page -->
                        <nav class="tm-black-bg tm-drinks-nav">
                            <ul>
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="#" class="tm-tab-link active"
                                            data-id="{{ $category->id }}">{{ $category->category_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                        @foreach ($categories as $category)
                            <div id="{{ $category->id }}" class="tm-tab-content">
                                <div class="tm-list">
                                    @foreach ($beverages as $beverage)
                                        @if ($beverage->category_id == $category->id)
                                            <div class="tm-list-item">
                                                <img src="{{ asset('storage/' . $beverage->image) }}" alt="Image"
                                                    class="tm-list-item-img" />
                                                <div class="tm-black-bg tm-list-item-text">
                                                    <h3 class="tm-list-item-name">
                                                        {{ $beverage->beverage_title }}<span
                                                            class="tm-list-item-price">${{ $beverage->beverage_price }}</span>
                                                    </h3>
                                                    <p class="tm-list-item-description">
                                                        {{ $beverage->beverage_content }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        <!-- end Drink Menu Page -->
                    </div>

                    <!-- About Us Page -->
                    @include('about')
                    <!-- end About Us Page -->

                    <!-- Special Items Page -->
                    <div id="special" class="tm-page-content">
                        <div class="tm-special-items">
                            @foreach ($specialItems as $item)
                                <div class="tm-black-bg tm-special-item">
                                    <img src="{{ asset('storage/' . $item->image) }}" width="300px" height="300px"
                                        alt="Image" />
                                    <div class="tm-special-item-description">
                                        <h2 class="tm-text-primary tm-special-item-title">
                                            {{ $item->beverage_title }}
                                        </h2>
                                        <p class="tm-special-item-text">
                                            {{ $item->beverage_content }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- end Special Items Page -->

                    <!-- Contact Page -->
                    <div id="contact" class="tm-page-content">
                        <div class="tm-black-bg tm-contact-text-container">
                            <h2 class="tm-text-primary">Contact Wave</h2>
                            <p>
                                Wave Cafe Template has a video background. You can use this
                                layout for your websites. Please contact Tooplate's Facebook
                                page. Tell your friends about our website.
                            </p>
                        </div>
                        <div class="tm-black-bg tm-contact-form-container tm-align-right">
                            <form action="{{ route('contact.store') }}" method="POST" id="contact-form">
                                @csrf
                                <div class="tm-form-group">
                                    <input type="text" name="contact_name" class="tm-form-control" placeholder="Name"
                                        required="" />
                                </div>
                                <div class="tm-form-group">
                                    <input type="email" name="contact_email" class="tm-form-control"
                                        placeholder="Email" required="" />
                                </div>
                                <div class="tm-form-group tm-mb-30">
                                    <textarea rows="6" name="contact_message" class="tm-form-control" placeholder="Message" required=""></textarea>
                                </div>
                                <div>
                                    <button type="submit" class="tm-btn-primary tm-align-right">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end Contact Page -->
                </main>
            </div>
        </div>
        <br><br><br><br><br><br><br><br>
        <footer class="tm-site-footer">
            <p class="tm-black-bg tm-footer-text">
                Copyright 2020 Wave Cafe | Design:
                <a href="{{ asset('https://www.tooplate.com') }}" class="tm-footer-link" rel="sponsored"
                    target="_parent">Tooplate</a>
            </p><br><br>
            <div class="container text-white">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </div>
        </footer>
    </div>



    <!-- Background video -->
    <div class="tm-video-wrapper">
        <i id="tm-video-control-button" class="fas fa-pause"></i>
        <video autoplay muted loop id="tm-video">
            <source src="{{ asset('video/wave-cafe-video-bg.mp4') }}" type="video/mp4" />
        </video>
    </div>

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script>
        function setVideoSize() {
            const vidWidth = 1920;
            const vidHeight = 1080;
            const windowWidth = window.innerWidth;
            const windowHeight = window.innerHeight;
            const tempVidWidth = (windowHeight * vidWidth) / vidHeight;
            const tempVidHeight = (windowWidth * vidHeight) / vidWidth;
            const newVidWidth =
                tempVidWidth > windowWidth ? tempVidWidth : windowWidth;
            const newVidHeight =
                tempVidHeight > windowHeight ? tempVidHeight : windowHeight;
            const tmVideo = $("#tm-video");

            tmVideo.css("width", newVidWidth);
            tmVideo.css("height", newVidHeight);
        }

        function openTab(evt, id) {
            $(".tm-tab-content").hide();
            $("#" + id).show();
            $(".tm-tab-link").removeClass("active");
            $(evt.currentTarget).addClass("active");
        }

        function initPage() {
            let pageId = location.hash;

            if (pageId) {
                highlightMenu($(`.tm-page-link[href^="${pageId}"]`));
                showPage($(pageId));
            } else {
                pageId = $(".tm-page-link.active").attr("href");
                showPage($(pageId));
            }
        }

        function highlightMenu(menuItem) {
            $(".tm-page-link").removeClass("active");
            menuItem.addClass("active");
        }

        function showPage(page) {
            $(".tm-page-content").hide();
            page.show();
        }

        $(document).ready(function() {
            /***************** Pages *****************/

            initPage();

            $(".tm-page-link").click(function(event) {
                if (window.innerWidth > 991) {
                    event.preventDefault();
                }

                highlightMenu($(event.currentTarget));
                showPage($(event.currentTarget.hash));
            });

            /***************** Tabs *******************/

            $(".tm-tab-link").on("click", (e) => {
                e.preventDefault();
                openTab(e, $(e.target).data("id"));
            });

            $(".tm-tab-link.active").click(); // Open default tab

            /************** Video background *********/

            setVideoSize();

            // Set video background size based on window size
            let timeout;
            window.onresize = function() {
                clearTimeout(timeout);
                timeout = setTimeout(setVideoSize, 100);
            };

            // Play/Pause button for video background
            const btn = $("#tm-video-control-button");

            btn.on("click", function(e) {
                const video = document.getElementById("tm-video");
                $(this).removeClass();

                if (video.paused) {
                    video.play();
                    $(this).addClass("fas fa-pause");
                } else {
                    video.pause();
                    $(this).addClass("fas fa-play");
                }
            });
        });
    </script>
</body>

</html>
