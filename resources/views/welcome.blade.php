<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Starman</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #161819;
                color: #fff;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
                padding: 0;
                width: 100%;
                overflow: hidden;
            }

            canvas#world{
                position: absolute;
            }

            .full-height {
                height: 80vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #fff;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            #roadster-img{
                position: absolute;
                bottom: 0px;
                width: 100%;
                text-align: center;
            }

        </style>
    </head>
    <body>
        <canvas id="world"></canvas>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div id='countdown-container' class="title m-b-md" data-timestamp="1517949422">
                    Starman
                </div>

                <div class="links">
                    <a href="https://www.youtube.com/watch?v=wbSwFU6tY1c">Lift off</a>
                    <a href="https://www.youtube.com/watch?v=aBr2kKAHN6M&feature=youtu.be">Live view</a>
                    <a href="https://www.flickr.com/search/?text=falcon%20heavy%20roadster">Beautiful Images</a>
                    <a href="https://twitter.com/elonmusk">In Musk we trust</a>
                    <a href="http://whereisroadster.com/">Where is Starman Now?</a>
                </div>
            </div>
        </div>
        <div id="roadster-img">
            <img src="{{ asset("images/roadster-drawn.png") }}" />
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>

        <script>

            var since = moment.unix( document.querySelector('#countdown-container').getAttribute('data-timestamp') );
            document.getElementById('countdown-container').innerHTML = since.from( moment() );

            (function() {
                var COLORS, Confetti, NUM_CONFETTI, PI_2, canvas, confetti, context, drawCircle, i, range, resizeWindow, xpos;

                NUM_CONFETTI = 150;

                COLORS = [[255, 255, 255], [255, 255, 255], [255, 255, 255], [255, 255, 255], [255, 255, 255]];

                PI_2 = 2 * Math.PI;

                canvas = document.getElementById("world");

                context = canvas.getContext("2d");

                window.w = 0;

                window.h = 0;

                resizeWindow = function() {
                    window.w = canvas.width = window.innerWidth;
                    return window.h = canvas.height = window.innerHeight;
                };

                window.addEventListener('resize', resizeWindow, false);

                window.onload = function() {
                    return setTimeout(resizeWindow, 0);
                };

                range = function(a, b) {
                    return (b - a) * Math.random() + a;
                };

                drawCircle = function(x, y, r, style) {
                    context.beginPath();
                    context.arc(x, y, r, 0, PI_2, false);
                    context.fillStyle = style;
                    return context.fill();
                };

                xpos = 0.5;

                document.onmousemove = function(e) {
                    return xpos = e.pageX / w;
                };

                window.requestAnimationFrame = (function() {
                    return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function(callback) {
                        return window.setTimeout(callback, 1000 / 60);
                    };
                })();

                Confetti = class Confetti {
                    constructor() {
                        this.style = COLORS[~~range(0, 5)];
                        this.rgb = `rgba(${this.style[0]},${this.style[1]},${this.style[2]}`;
                        this.r = ~~range(2, 6);
                        this.r2 = 2 * this.r;
                        this.replace();
                    }

                    replace() {
                        this.opacity = 0;
                        this.dop = 0.03 * range(1, 4);
                        this.x = range(-this.r2, w - this.r2);
                        this.y = range(-20, h - this.r2);
                        this.xmax = w - this.r;
                        this.ymax = h - this.r;
                        this.vx = range(0, 2) + 8 * xpos - 5;
                        return this.vy = 0.7 * this.r + range(-1, 1);
                    }

                    draw() {
                        var ref;
                        this.x += this.vx;
                        this.y += this.vy;
                        this.opacity += this.dop;
                        if (this.opacity > 1) {
                            this.opacity = 1;
                            this.dop *= -1;
                        }
                        if (this.opacity < 0 || this.y > this.ymax) {
                            this.replace();
                        }
                        if (!((0 < (ref = this.x) && ref < this.xmax))) {
                            this.x = (this.x + this.xmax) % this.xmax;
                        }
                        return drawCircle(~~this.x, ~~this.y, this.r, `${this.rgb},${this.opacity})`);
                    }

                };

                confetti = (function() {
                    var j, ref, results;
                    results = [];
                    for (i = j = 1, ref = NUM_CONFETTI; 1 <= ref ? j <= ref : j >= ref; i = 1 <= ref ? ++j : --j) {
                        results.push(new Confetti);
                    }
                    return results;
                })();

                window.step = function() {
                    var c, j, len, results;
                    requestAnimationFrame(step);
                    context.clearRect(0, 0, w, h);
                    results = [];
                    for (j = 0, len = confetti.length; j < len; j++) {
                        c = confetti[j];
                        results.push(c.draw());
                    }
                    return results;
                };

                step();

            }).call(this);

            //THANK YOU Linmiao Xu, this is beautiful! - https://codepen.io/linrock/pen/Amdhr
        </script>
    </body>
</html>
