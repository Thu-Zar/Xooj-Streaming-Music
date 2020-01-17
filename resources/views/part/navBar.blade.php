
<div id="topContainer">

            <div id="navBarContainer">
                <nav class="navBar">

                    <a href="#" class="logoxooj">
                        <img src="{{asset('images/icons/xooj.jpg')}}">
                    </a>


                    <div class="group">
                        <div class="navItem">
                            <a href="{{ action('SearchController@search') }}" class="navItemLink">Search
                            <img src="{{asset('images/icons/search.png')}}" class="icon" alt="Search">
                            </a>
                        </div>
                    </div>

                    

                    <div class="group">
                       

                        <div class="navItem">
                            <a href="{{route('art.index')}}" class="navItemLink">Artist</a>
                        </div>

                        <div class="navItem">
                            <a href="{{route('index.index')}}" class="navItemLink">Album</a>
                        </div>
                        <div class="navItem">
                            <a href="{{route('favourite.index')}}" class="navItemLink">Favourite </a>
                        </div>
                        <div class="navItem">
                            <div class="top-right links">
                            <a href="{{route('login')}}" class="navItemLink">Login</a>
                            <br><br>
                            </div>
                        </div>
                    </div>




                </nav>
            </div>
            