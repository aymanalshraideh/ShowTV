    <!-- header -->
    <header class="header">
        <div class="header__wrap">
            <div class="container" style="    max-width: 100%;">
                <div class="row">
                    <div class="col-12">
                        <div class="header__content">
                            <!-- header logo -->
                            <a href="index.html" class="header__logo">
                                <img src="frontend-asset/img/logo.svg" alt="">
                            </a>
                            <!-- end header logo -->

                            <!-- header nav -->
                            <ul class="header__nav">
                                <!-- dropdown -->
                                <li class="header__nav-item">
                                    <a href="{{ route('home') }}" class="header__nav-link">Home</a>
                                </li>


                                @foreach ($tvShowsNav as $item)
                                    <li class="header__nav-item">
                                        <a href="{{ route('tvshows.show', $item->id) }}" class="header__nav-link">
                                            {{ $item->title }}
                                        </a>
                                    </li>
                                @endforeach

                                <!-- end dropdown -->



                                <!-- dropdown -->
                                <li class="dropdown header__nav-item">
                                    <a class="dropdown-toggle header__nav-link header__nav-link--more" href="#"
                                        role="button" id="dropdownMenuMore" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"><i class="icon ion-ios-more"></i></a>

                                    <ul class="dropdown-menu header__dropdown-menu" aria-labelledby="dropdownMenuMore">
                                        <li><a href="about.html">About</a></li>
                                        <li><a href="signin.html">Sign In</a></li>
                                        <li><a href="signup.html">Sign Up</a></li>
                                        <li><a href="404.html">404 Page</a></li>
                                    </ul>
                                </li>
                                <!-- end dropdown -->
                            </ul>
                            <!-- end header nav -->

                            <!-- header auth -->
                            <div class="header__auth">
                                <button class="header__search-btn" type="button">
                                    <i class="icon ion-ios-search"></i>
                                </button>

                                <a href="signin.html" class="header__sign-in">
                                    <i class="icon ion-ios-log-in"></i>
                                    <span>sign in</span>
                                </a>
                            </div>
                            <!-- end header auth -->

                            <!-- header menu btn -->
                            <button class="header__btn" type="button">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <!-- end header menu btn -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- header search -->
        <form action="#" class="header__search">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="header__search-content">
                            <input type="text" id="search"
                                placeholder="Search for a Episode , TV Series that you are looking for">

                        </div>
                        <div id="search-results"
                            style="background:white; border:1px solid #ccc;position:fixed; z-index:1000; width:80%;display:none; max-height:300px; overflow-y:auto;">
                        </div>


                    </div>
                </div>
            </div>
        </form>

        <!-- end header search -->
    </header>
    <!-- end header -->
