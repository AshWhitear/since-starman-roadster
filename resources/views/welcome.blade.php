<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Starman</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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

            .position-ref {
                position: relative;
                top: 30%;
            }

            @media (max-width: 767.98px) {
                .position-ref {
                    top: 5%;
                }
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
                bottom: 0px;
                width: 100%;
                text-align: center;
                position: absolute;
                left: 0px;
            }

            #roadster-img img{
                width: 100%;
            }

            /**/

            @import "compass/css3";

            body{
                background:radial-gradient(200% 100% at bottom center,#161819,#161819,#161819,#161819);
                background:radial-gradient(220% 105% at top center,#000 10%,#000 30%,#002e53 75%,#002e53);
                background-attachment:fixed;
                overflow:hidden;
            }
            @keyframes rotate{
                0%{
                    transform:perspective(400px) rotateZ(20deg) rotateX(-40deg) rotateY(0);
                }
                100%{
                    transform:perspective(400px) rotateZ(20deg) rotateX(-40deg) rotateY(-360deg);
                }
            }
            .stars{
                transform:perspective(500px);
                transform-style:preserve-3d;
                position:absolute;
                bottom:0;
                perspective-origin:50% 100%;
                left:50%;
                animation:rotate 90s infinite linear;
            }
            .star{
                width:2px;
                height:2px;
                background:#F7F7B6;
                //border-radius:100%;
                position:absolute;
                top:0;
                left:0;
                transform-origin:0 0 -300px;
                transform:translate3d(0,0,-300px);
                backface-visibility:hidden;
            }

        </style>
    </head>
    <body>
    <div class="stars"></div>
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm">
                    <div class="position-ref full-height">

                        <div class="content">

                            <div class="row">
                                <div class="col-sm">
                                    <div id='countdown-container' class="title m-b-md" data-timestamp="1517949422">
                                        Starman
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-sm links">
                                    <a href="https://www.youtube.com/watch?v=wbSwFU6tY1c">Lift off</a>
                                </div>
                                <div class="col-sm links">
                                    <a href="https://www.youtube.com/watch?v=aBr2kKAHN6M&feature=youtu.be">Live view</a>
                                </div>
                                <div class="col-sm links">
                                    <a href="https://www.flickr.com/search/?text=falcon%20heavy%20roadster">Beautiful Images</a>
                                </div>
                                <div class="col-sm links">
                                    <a href="https://twitter.com/elonmusk">In Musk we trust</a>
                                </div>
                                <div class="col-sm links">
                                    <a href="http://whereisroadster.com/">Where is Starman Now?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="roadster-img">
                <img src="{{ asset("images/roadster-drawn.png") }}" />
            </div>

        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>

        <script>

            var since = moment.unix( document.querySelector('#countdown-container').getAttribute('data-timestamp') );
            document.getElementById('countdown-container').innerHTML = since.from( moment() );

            $(document).ready(function(){
                var stars=800;
                var $stars=$(".stars");
                var r=800;
                for(var i=0;i<stars;i++){
                    var $star=$("<div/>").addClass("star");
                    $stars.append($star);
                }
                $(".star").each(function(){
                    var cur=$(this);
                    var s=0.2+(Math.random()*1);
                    var curR=r+(Math.random()*300);
                    cur.css({
                        transformOrigin:"0 0 "+curR+"px",
                        transform:" translate3d(0,0,-"+curR+"px) rotateY("+(Math.random()*360)+"deg) rotateX("+(Math.random()*-50)+"deg) scale("+s+","+s+")"

                    })
                })
            })
            //THANK YOU https://codepen.io/lbebber/ - this is also gorgeous!!

            /*(function() {
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

            }).call(this);*/

            //THANK YOU Linmiao Xu, this is beautiful! - https://codepen.io/linrock/pen/Amdhr
        </script>
    </body>
</html>
