document.getElementById("waterPlant").addEventListener("click", waterPlant);
window.onload = function(){
    //set up water timer
    goodState = false;
    countDownTime = 10;
    runWaterTimer();
    initiate(); //to load in all other variables
};

window.onclick = function(event) { //when clicked next to the pop up
  if (event.target == popup) {
    popup.style.display = "none";
  }
}

//empty variables
/*variables pop up*/
var popup;
var TextForPopup;
var xSpan; 

/*variables water timer*/
var countDownTime;
var goodState;


function initiate(){
    popup = document.getElementById("popUp");
    TextForPopup = document.getElementById("popUpText");
    xSpan = document.getElementById("closeSpan");
}

//reset time when plant has been watered
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
    //call notifaction function ✨✨✨✨ 
    showNotification(1);
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

//blur background on notification

function showNotification(notifyType) { //show notification
  popup.style.display = "block";
  switch (notifyType) {
    case 1:
        TextForPopup = "Tekst voor water geven";
    break;
    case 2:
        TextForPopup = "Tekst om pot te veranderen";
    break;
    case 3:
        TextForPopup = "Tekst bemesten";
    break;
    case 4:
        TextForPopup = "Tekst kortwieken plant";
    break;
    case 5:
        TextForPopup = "Tekst over licht"; //might wanna give more specific reason
    break;
    case 6:
        TextForPopup = "Bekijk status van je plant";
    break;
  }
}

// xSpan.onclick = function() { //remove when pressed x
//   popup.style.display = "none";
// }

