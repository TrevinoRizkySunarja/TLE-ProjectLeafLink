// Amount of time in seconds x 1000
var countDownTime = 10;

var waterPlant = setInterval(function() {

  // It always ends on 0 so why change it?
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
    //on experiation change plant image
  } else {
  countDownTime = countDownTime - 1;
  }
}, 1000);

//function to change plant image based on what timer ran out (first version is water)

//function to reset timer once the user has watered the plant (no concequences if they wait too long)

//