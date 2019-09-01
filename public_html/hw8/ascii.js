"use strict";
let mars = null;
let frames = [];
let size = "12pt";
let frame_index = 0;
let speed = 250;
$(document).ready(() => {
  console.log("jquery started");
  disableButtonByID("#stopButton");
});
function start() {
  console.log("start");
  let textarea = $("textarea")[0].value;
  frames = textarea.split("=====\n");
  frame_index = 0;
  console.log(textarea);
  mars = setInterval(() => {
    //console.log("animating");
    animateIt();
  }, speed);
  disableButtonByID("#startButton");
  enableButtonByID("#stopButton");
}
function animateIt() {
  if (frame_index == frames.length) frame_index = 0;
  const nextFrame = frames[frame_index++];
  if (nextFrame == undefined || nextFrame == "") {
    console.log("undefiend frame");
    stop();
  } else $("textarea")[0].value = nextFrame;
}
function stop() {
  console.log("stop");
  clearInterval(mars);
  disableButtonByID("#stopButton");
  enableButtonByID("#startButton");
  $("textarea")[0].value = frames.join("#####\n");
}
function enableButtonByID(id) {
  $(id).attr("disabled", false);
}
function disableButtonByID(id) {
  $(id).attr("disabled", true);
}

function changeOption() {
  console.log("animate");
  let chosen = $("#animation")[0].value;
  console.log(chosen);
  // console.dir(ANIMATIONS);
  $("textarea")[0].value = ANIMATIONS[chosen];
  frames = ANIMATIONS[chosen].split("=====\n");
}
function changeSize() {
  size = $("[select[name='size']")[0].value;
  console.log(size);
  $("textarea").css("font-size", size);
}
function changeSpeed(elm) {
  elm = $(elm)[0].checked;
  if (elm) speed = 50;
  else speed = 250;
  console.log(elm);
  clearInterval(mars);
  mars = setInterval(() => {
    console.log("animating");
    animateIt();
  }, speed);
}
