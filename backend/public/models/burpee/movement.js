const voice_path = $('#voice-path').val();
const model_path = $('#model-path').val() + '/model';
const max_reps = parseInt($('#max-reps').val());

let model, webcam, ctx, labelContainer, maxPredictions;

var progress = 327
var probprog = 327
var wprobprog = 327
var status = "stand"
var count = 0
var music = "stop"
var quit = 0
let isDone = 0;



window.onload = function(){
    document.getElementById('autoClickBtn').click();
}

async function init() {
    $('#progress-text').html(count + ' / ' + max_reps);

    const model_file = model_path + '/model.json';
    const metadata_file = model_path + '/metadata.json';

    // var audio = new Audio('/Voice/English/AreYouReady.mp3')
    // audio.play()

    model = await tmPose.load(model_file, metadata_file);
    maxPredictions = model.getTotalClasses();

    // Convenience function to setup a webcam
    const size = 500;
    const flip = true; // whether to flip the webcam
    webcam = new tmPose.Webcam(size, size, flip); // width, height, flip
    await webcam.setup(); // request access to the webcam
    await webcam.play();
    window.requestAnimationFrame(loop);

    // append/get elements to the DOM
    const canvas = document.getElementById("canvas");
    canvas.width = size; canvas.height = size;
    ctx = canvas.getContext("2d");
    labelContainer = document.getElementById("label-container");
    for (let i = 0; i < maxPredictions; i++) { // and class labels
        labelContainer.appendChild(document.createElement("div"));
    }

    $('#loading').html('');
}

function sleep(ms) {
    return new Promise(
        resolve => setTimeout(resolve, ms)
    );
}

async function loop(timestamp) {
    webcam.update(); // update the webcam frame
    await predict();
    window.requestAnimationFrame(loop);
}


async function predict() {

    const { pose, posenetOutput } = await model.estimatePose(webcam.canvas);
    // Prediction 2: run input through teachable machine classification model
    const prediction = await model.predict(posenetOutput);
    

    // DONE
    if(max_reps <= count && !isDone){
        // var audio = new Audio('/Voice/??????/?????????/???????????????.mp3');
        // audio.play();
        await fetch(window.location.pathname, {
            method: "POST"
        });

        $('#progress-text').html('DONE !!!');
        location.replace("/"); 
        isDone = 1;
    }

    // SQUAT COUNTER JAVASCRIPT
    // GOOD POSTURE PERCENTAGE
    $('#probability').html( (prediction[1].probability.toFixed(2) * 100).toFixed(0) );
    $('.probprog').css('stroke-dashoffset', probprog - (probprog * prediction[1].probability.toFixed(2)));
    
    // BAD POSTURE PERCENTAGE 
    $('#wprobability').html( (prediction[0].probability.toFixed(2) * 100).toFixed(0) );
    $('.wprobprog').css('stroke-dashoffset', wprobprog - (wprobprog * prediction[0].probability.toFixed(2)));

    //


    // Prediction #1: run input through posenet
    // estimatePose can take in an image, video or canvas html element
    
    if (prediction[0].probability >= 0.95) {
        if (status == "squat" && !isDone) {
            count++

            progress = 330 * (max_reps - count) / max_reps;
            
            $('.progress').css('stroke-dashoffset', progress);
            $('#counter').html(count);
            $('#progress-text').html(count + ' / ' + max_reps);                

            if((count >= 10) && (count % 10==0)){
                // var audio = new Audio('/Voice/English/VeryGood_UK.mp3')
                // audio.play();
                // await sleep(100);   
            } else {
                var audio = new Audio(voice_path + '/' +  count%10 + '.mp3');
                audio.play();
            }
        }
        status = "stand"
        await sleep(10);
    } else if (prediction[1].probability >= 0.95) {
        status = "squat"
        await sleep(10);
    }


    for (let i = 0; i < maxPredictions; i++) {
        if(i==0){
            const classPrediction = "STAND " + ": " + prediction[i].probability.toFixed(2);
            labelContainer.childNodes[i].innerHTML = classPrediction;   
        } else {
            const classPrediction = "DOWN "  + ": " + prediction[i].probability.toFixed(2);
            labelContainer.childNodes[i].innerHTML = classPrediction;
        }
    }

    // finally draw the poses
    drawPose(pose);
}

function drawPose(pose) {
    if (webcam.canvas) {
        ctx.drawImage(webcam.canvas, 0, 0);
        // draw the keypoints and skeleton
        if (pose) {
            const minPartConfidence = 0.5;
            tmPose.drawKeypoints(pose.keypoints, minPartConfidence, ctx);
            tmPose.drawSkeleton(pose.keypoints, minPartConfidence, ctx);
        }
    }
}