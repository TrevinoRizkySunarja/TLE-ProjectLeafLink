window.onload = function(){
    //set up water timer
    goodState = true;
    countDownTime = 20;
    runWaterTimer();
    initiate(); 
    preventScroll();
};

window.onclick = function(event) { //when clicked next to the pop up
  if (event.target == popup) {
    popup.style.display = "none";
  }
}

/*variables pop up*/
var popup;
var TextForPopup;
var xSpan; 

/*variables water timer*/
var countDownTime;
var goodState;

/*alarm variables*/
var editAlarms;
var notifications = [false, false, false, false, false]

function initiate(){ //to load in all other variables
    popup = document.getElementById("popUp");
    TextForPopup = document.getElementById("popUpText");
    xSpan = document.getElementById("closeSpan");
    editAlarms = false;

    document.getElementById("btnAlarmSet").addEventListener("click", selectAlarms);
    document.getElementById("btnWaterPlant").addEventListener("click", userWaterPlant); //add to different button to water plant

}

function preventScroll() {
  // Get the current page scroll position
  scrollTop =
  window.pageYOffset ||
  document.documentElement.scrollTop;
    scrollLeft =
       window.pageXOffset ||
        document.documentElement.scrollLeft,

        // if any scroll is attempted,
        // set this to the previous value
        window.onscroll = function () {
        window.scrollTo(scrollLeft, scrollTop);
      };
}


//reset time when plant has been watered
function resetTime(){
    countDownTime = 20;
    runWaterTimer();
};

function runWaterTimer(){
var waterPlant = setInterval(function() {

  var endTimer = 0;
  var distance = countDownTime - endTimer;
  // console.log(distance); //to check if the time is over in console

  // If the count down is finished
  if (distance <= 0) {
    clearInterval(waterPlant);
    goodState = false;
    document.getElementById("plantImg").src = "Includes/images/plantDehidrated.png";
    document.getElementById("status").innerText = "Status: Thirsty";
    showNotification(1);
  } else {
    countDownTime = countDownTime - 1;
  }
}, 1000);
};

//function to change plant image based on what timer ran out (first version is water)
function userWaterPlant(){
    if (goodState == false){
        document.getElementById("plantImg").src = "Includes/images/digitalPlant.png";
        document.getElementById("status").innerText = "Status: Healthy";
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
    case 7:
        TextForPopup.innerText = "chose what you'd like a notifaction of!";
    break;
    case 8:
        TextForPopup.innerText = "notification settings off";
    break;
    //alerts
    case 9:
        TextForPopup.innerText = "Water plant alert on";
    break;
    case 10:
        TextForPopup.innerText = "Change pot alert on";
    break;
    case 11:
        TextForPopup.innerText = "Fertalize alert on";
    break;
    case 12:
        TextForPopup.innerText = "Trim plant on";
    break;
    case 13:
        TextForPopup.innerText = "Light change on";
    break;
    case 14:
        TextForPopup.innerText = "Water plant alert off";
    break;
    case 15:
        TextForPopup.innerText = "Change pot alert off";
    break;
    case 16:
        TextForPopup.innerText = "Fertalize alert off";
    break;
    case 17:
        TextForPopup.innerText = "Trim plant off";
    break;
    case 18:
        TextForPopup.innerText = "Light change off";
    break;
  }
}

/*alarm system*/
function selectAlarms(){
  if(editAlarms == false){
    editAlarms = true;
    document.getElementById("interaction").style.display = "block";
    document.getElementById("information").style.display = "none";
    document.getElementById("btnAlarmSet").src = "Includes/images/alarmchoice_active.png"
    document.getElementById("btnNotifWaterPlant").addEventListener("click", waterplantAlarm);
    document.getElementById("btncChangePot").addEventListener("click", changePotAlarm);
    document.getElementById("btnFertalizePlant").addEventListener("click", fertalizePlant);
    document.getElementById("btnTrimPlant").addEventListener("click", tripPlant);
    document.getElementById("btnChangeLight").addEventListener("click", changeLight);
    showNotification(7);

  } else{
    editAlarms = false;
    document.getElementById("interaction").style.display = "none";
    document.getElementById("information").style.display = "flex";
    document.getElementById("btnAlarmSet").src = "Includes/images/alarmchoice_inactive.png"
    document.getElementById("btnNotifWaterPlant").removeEventListener("click", waterplantAlarm);
    document.getElementById("btncChangePot").removeEventListener("click", changePotAlarm);
    document.getElementById("btnFertalizePlant").removeEventListener("click", fertalizePlant);
    document.getElementById("btnTrimPlant").removeEventListener("click", tripPlant);
    document.getElementById("btnChangeLight").removeEventListener("click", changeLight);
    showNotification(8);
  }
}

function waterplantAlarm(){
  if(notifications[0] == false){
    notifications[0] = true;
    showNotification(9)
  } else {
    showNotification(14);
    notifications[0] = false;
  }
}

function changePotAlarm(){
  if(notifications[0] == false){
    notifications[0] = true;
    showNotification(10)
  } else {
    showNotification(15);
    notifications[0] = false;
  }
}

function fertalizePlant(){
    if(notifications[0] == false){
    notifications[0] = true;
    showNotification(11)
  } else {
    showNotification(16);
    notifications[0] = false;
  }
}

function tripPlant(){
    if(notifications[0] == false){
    notifications[0] = true;
    showNotification(12)
  } else {
    showNotification(17);
    notifications[0] = false;
  }
}

function changeLight(){
      if(notifications[0] == false){
    notifications[0] = true;
    showNotification(13);
  } else {
    showNotification(18);
    notifications[0] = false;
  }
}