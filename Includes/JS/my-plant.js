document.getElementById("waterPlant").addEventListener("click", waterPlant);
window.onload = function(){
    goodState = false;
};

var countDownTime;
var goodState;

function resetTime(){
    countDownTime = 10;
    runWaterTimer();
};

function runWaterTimer(){
var waterPlant = setInterval(function() {

  var endTimer = 0;

  // Distance between countdown time and the ending for calculation, can be removed after display is gone
  var distance = countDownTime - endTimer;
  console.log(distance);

  // Calcs for counting down on "needing water"
  var minutes = Math.floor((distance) / (1 * 60));
  var seconds = Math.floor((distance) / 1);

  // Display for testing
  document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";

  // If the count down is finished
  if (distance <= 0) {
    clearInterval(waterPlant);
    document.getElementById("demo").innerHTML = "EXPIRED";
    goodState = false;
    //document.getElementById("plantImg").src = "plantDying.png";
  } else {
    countDownTime = countDownTime - 1;
  }
}, 1000);
};



//function to change plant image based on what timer ran out (first version is water)
function waterPlant(){
    if (goodState == false){
        //document.getElementById("plantImg").src = "plantAlive.png";
        goodState = true;
        resetTime();
    } else if (goodState == true){
        //don't do anything cuz nothing is needed, kept this just in case of a notify?
    }
};

//function to reset timer once the user has watered the plant (no concequences if they wait too long)