    <!-- header -->
    <header class="header">
        <div class="header__wrap">
            <div class="container" style="    max-width: 100%;">
                <div class="row">
                    <div class="col-12">
                        <div class="header__content">
                            <!-- header logo -->
                            <a href="{{ route('home') }}" class="header__logo">
                                <img src="{{ asset('frontend-asset/img/logo.png') }}" alt="">
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



          
                            </ul>
                            <!-- end header nav -->

                            <!-- header auth -->
                            <div class="header__auth">
                                <button class="header__search-btn" type="button">
                                    <i class="icon ion-ios-search"></i>
                                </button>

                                @auth

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="header__sign-in" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            <span> Log Out</span>
                                        </a>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="header__sign-in">
                                        <i class="icon ion-ios-log-in"></i>
                                        <span>sign in</span>
                                    </a>
                                @endauth

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
