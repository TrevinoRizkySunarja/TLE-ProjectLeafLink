document.getElementById("waterPlant").addEventListener("click", waterPlant);
window.onload = function(){
    goodState = false;
    countDownTime = 10;
    runWaterTimer();
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
  var distance = countDownTime - endTimer;
  console.log(distance); //to check if the time is over in console

  // If the count down is finished
  if (distance <= 0) {
    clearInterval(waterPlant);
    goodState = false;
    document.getElementById("plantImg").src = "Includes/images/plantDehidrated.png";
  } else {
    countDownTime = countDownTime - 1;
  }
}, 1000);
};



//function to change plant image based on what timer ran out (first version is water)
function waterPlant(){
    if (goodState == false){
        document.getElementById("plantImg").src = "Includes/images/digitalPlant.png";
        goodState = true;
        resetTime();
    } else if (goodState == true){
        //don't do anything cuz nothing is needed, kept this just in case of a notify?
    }
};


