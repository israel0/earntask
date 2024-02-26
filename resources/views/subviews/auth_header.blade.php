<div class="header">
    <div id="main-navbar" class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="image-title navbar-brand" href="/"><img width="56" src="{{asset('images/logo.png')}}"></a>                
                <input type="checkbox" id="navbar-toggle-cbox">
                <label for="navbar-toggle-cbox" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </label>
            </div>
            
            @auth
            @include("subviews.active_user_div")
            @endauth

            @guest
            @include("subviews.no_user_div")
            @endguest
        </div>
    </div>
</div>