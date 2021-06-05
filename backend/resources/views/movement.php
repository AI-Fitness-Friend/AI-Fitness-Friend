<div class="container">
    <header><h2 style="margin-top: 5%;"><?=$movement->name?></h2></header>
    
    
    <!-- Customize-->
    <div>
        <div>
            <button id="autoClickBtn" class="button" type="button" onclick="init()">Let's Go</button>
            <br><br>
            <h2 id="progress-text"></h2>
        </div>
        <br><br>
        <h1 id="loading" style="color: red;">  Loading.... </h1>
        <div style="width: 500px;">
            <canvas id="canvas"></canvas>
        </div>
        <div id="label-container"></div>
        Voice Setting : <?=$voice->name?>
    </div>

    <!--workout--->
    <div class="added_container" style="margin-top: -53%">
        <div class="added_frame">
            <!-- COUNTER -->
            <div class="added_headline">
                <div class="small">JUMP</div>Counter
            </div>
            <div class="added_circle-big">
                <div class="text">
                    <span id="counter">0</span><div class="small"></div>

                </div>
                <svg>
                    <circle class="bg" cx="57" cy="57" r="52" />
                    <circle class="progress" cx="57" cy="57" r="52" />
                </svg>
            </div>


            <!-- GOOD POSTURE ACCURACY PERCENTAGE -->
            <div class="added_headline">
                <div class="small">GOOD</div>
            
            </div>
            <div class="added_circle-big">
                <div class="text">
                    <span id="probability">0</span>%<div class="small"></div>

                </div>
                <svg>
                    <circle class="bg" cx="57" cy="57" r="52" />
                    <circle class="probprog" cx="57" cy="57" r="52" />
                </svg>
            </div>
            

            <!-- BAD POSTURE ACCURACY PERCENTAGE -->
            <div class="added_headline">
                <p class="small" style="text-align: center;">BAD</p>
            </div>
            <div class="added_circle-big">
                <div class="text">
                    <span id="wprobability">0</span>%<div class="small"></div>

                </div>
                <svg>
                    <circle class="bg" cx="57" cy="57" r="52" />
                    <circle class="wprobprog" cx="57" cy="57" r="52" />
                </svg>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="voice-path" value="<?=$voice->path?>">
<input type="hidden" id="model-path" value="<?=$movement->model_path?>">
<input type="hidden" id="max-reps" value="<?=$movement->times?>">

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="/js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.3.1/dist/tf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@teachablemachine/pose@0.8/dist/teachablemachine-pose.min.js"></script>

<script>
var pubnub = new PubNub({
        publishKey: 'demo',
        subscribeKey: 'demo'
        });
        var channel = "c3-spline" + Math.random();
        eon.chart({
        pubnub: pubnub,
        channels: [channel],
        generate: {
            bindto: '#chart',
            data: {
            labels: true,
            type: 'pie'
            },
            bar: {
            width: {
                ratio: 0.4
            }
            }
        }
        });

    setInterval(function(){
        pubnub.publish({
            channel: channel,
            message: {
            eon: {
                //Math.floor(Math.random() * 99); 
                'Austin': Math.floor(Math.random() * 99),
                'New York': Math.floor(Math.random() * 99)
            }
            }
        });
        }, 300);
</script>

<script src="<?=$movement->model_path . '/movement.js'?>"></script>