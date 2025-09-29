document.getElementById("waterPlant").addEventListener("click", waterPlant);
document.getElementById("btnAlarmSet").addEventListener("click", selectAlarms);

window.onload = function(){
    //set up water timer
    goodState = false;
    countDownTime = 100;
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
        TextForPopup.innerText = "Tekst voor water geven";
    break;
    case 2:
        TextForPopup.innerText = "Tekst om pot te veranderen";
    break;
    case 3:
        TextForPopup.innerText = "Tekst bemesten";
    break;
    case 4:
        TextForPopup.innerText = "Tekst kortwieken plant";
    break;
    case 5:
        TextForPopup.innerText = "Tekst over licht"; //might wanna give more specific reason
    break;
    case 6:
        TextForPopup.innerText = "Bekijk status van je plant";
    break;
  }
}

//save for later
// xSpan.onclick = function() { //remove when pressed x
//   popup.style.display = "none";
// }



/*alarm system*/
function selectAlarms(){
  alert("choose alarms");
  // document.getElementById("waterPlant").addEventListener("click", waterPlant);
  document.getElementById("btncChangePot").addEventListener("click", function(){alert("change pot alert on")});
  document.getElementById("btnFertalizePlant").addEventListener("click", function(){alert("fertalize alert on")});
  document.getElementById("btnTrimPlant").addEventListener("click", function(){alert("trim plant on")});
  document.getElementById("btnChangeLight").addEventListener("click", function(){alert("light change on")});

}
// 1. if alarm clock pressed then change look of 'info element' and then add event listeners to other buttons
// 2. add pop up to communicate to user that they are in 'chose alarms' mode
//if active and pressed again then change eventlisteners back to what they were (or delete and reapply by just running an external function to prevent a huge mess)

//(for each event listener) if pressed then bool true (for now) that they want to recieve notifications

/* other settings */
//event listener >> open up pop up with right options
//add event listeners to all those elements if they are there otherwise don't (to prevent errors)
/*setting types:
> pot notifications 
> information buttons (what a setting does) 
> mute pot notifications
> mute phone notifcations (no sound but still get a reminder)
> sliders for how loud each notification type (behind it to mute it)*/

/*other buttons*/
//change pot >> change image to one different pot 
//for prototype version 2 only change faces for each action of the pot, this will be an indivual image (just the face)

/* Bonus: */
//sounds that the pot makes over the phone
//reminder notification to water it when on the page itself
//Add API for action temprature measuring 

/* Idea for image directories: 1.icons 2.background 3.plants (for saving) */