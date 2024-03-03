<div class="footer">

    <div class="logoFooter">
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo" loading="lazy">
        <img src="{{ asset('images/LogoNombre.png') }}" alt="User" class="logoNombre" loading="lazy">
    </div>

    <div class="linksFooter">
        <p class="item-1"><a href="{{ route('links.homePromotors') }}">Home Promotor</a></p>
        <p class="item-2"><a href="{{ route('links.aboutus') }}">Sobre nosotros</a></p>
        <p class="item-3"><a href="{{ route('links.legalnotice') }}">Avisos legales</a></p>


    </div>
    <div class="linksRRSS">
        
        <p class="item-5"><a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=Hello%20world"
                data-size="large">
                Tweet</a>
            <script>
                window.twttr = (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0],
                        t = window.twttr || {};
                    if (d.getElementById(id)) return t;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "https://platform.twitter.com/widgets.js";
                    fjs.parentNode.insertBefore(js, fjs);

                    t._e = [];
                    t.ready = function(f) {
                        t._e.push(f);
                    };

                    return t;
                }(document, "script", "twitter-wjs"));
            </script>
        </p>

        <p class="item-4"><a href="https://www.instagram.com"><img src="{{ asset('images/LogoInstagram.png') }}"
            alt="Logo de Instagram" class="logoInstagram" loading="lazy"></a></p>
        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>

        <!-- Your share button code -->
        <p class="item-6">
            <div class="fb-share-button" data-href="http://127.0.0.1:8000/" data-layout="button" data-size="large"></div>
        </p>
    </div>




</div>
