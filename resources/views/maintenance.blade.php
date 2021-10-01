<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UKM POLICY ~ Maintenance</title>
    <style>
        body {margin: 0}
        #particles {
            height: 100vh;
            width: 100%;
            background-color: #000;
            display: block;
            margin: 0;
            padding: 0;
        }
        .desc {
            text-align: center;
            color: #fff;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(-50%) translateY(-50%);
        }
        img {
            height: 200px;
        }
        h1 {
            text-transform: uppercase;
        }
        p {
            text-transform: uppercase;
            opacity: .8;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="desc">
        <img src="{{ asset('images/policy2.png') }}" alt="Linux Pinguin">
        <h1>UKM-POLICY</h1>
        <p>Website sedang dalam perbaikan</p>
    </div>
    <div id="particles">
    </div>

    <script src="{{ asset('plugins/particlesjs/particles.min.js') }}"></script>
    <script>/* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
        particlesJS.load('particles', "{{ asset('particles.json') }}", function() {
          console.log('callback - particles.js config loaded');
        });        
    </script>
</body>
</html>