"use strict";
(() => {
  var script = document.createElement("script");
  script.src = "http://code.jquery.com/jquery-3.4.1.min.js";
  script.type = "text/javascript";
  document.getElementsByTagName("head")[0].prepend(script);

  // Poll for jQuery to come into existance
  var checkReady = function(callback) {
    if (window.jQuery) {
      callback(jQuery);
    } else {
      window.setTimeout(function() {
        checkReady(callback);
      }, 20);
    }
  };

  // Start polling...
  checkReady(function($) {
    $(function() {
      console.log("jQuery loaded");
      // console.dir(window.jQuery);
      start();
    });
  });
})();
window.addEventListener("load", function() {
  var puzzleArea = document.getElementById("puzzlearea");
  var divs = puzzleArea.getElementsByTagName("div");

  // initialize each piece
  for (var i = 0; i < divs.length; i++) {
    var div = divs[i];

    // calculate x and y for this piece
    var x = (i % 4) * 100;
    var y = Math.floor(i / 4) * 100;

    // set basic style and background
    //   div.className = "puzzlepiece";
    div.style.left = x + "px";
    div.style.top = y + "px";
    div.style.backgroundImage = 'url("background.jpg")';
    div.style.backgroundPosition = -x + "px " + -y + "px";

    // store x and y for later
    div.x = x;
    div.y = y;
  }
  console.log("initialized the tiles");
});

function start() {
  let emptyTile = {
    x: 300,
    y: 300
  };
  $("#puzzlearea div").each(function(index) {
    //console.log(index);
    $(this).css({
      className: "puzzlepiece",
      // left: Math.random(),
      // top: Math.random(),
      backgroundImage: "url(background.jpg)"
      //backgroundPosition
    });
    $(this).addClass("puzzlepiece");
  });
  $("#puzzlearea div").click(function(event) {
    console.log("tile clicked");
    moveIfPossible($(this)[0]);
  });
  $("#puzzlearea div").hover(function(event) {
    console.log("tile hovered");
    if ($(this)[0]) highLightIfMovable($(this)[0]);
  });
  function highLightIfMovable(elm) {
    const me = getCurrentPixelPosition(elm);

    const neighbors = {
      t: { x: me.x, y: me.y - 100 },
      r: { x: me.x + 100, y: me.y },
      l: { x: me.x - 100, y: me.y },
      b: { x: me.x, y: me.y + 100 }
    };
    for (let n in neighbors) {
      if (isValidTile(neighbors[n])) {
        const tile = $(getTileByPosition(neighbors[n]));
        if (!tile[0]) {
          hightLightTile(elm);
          break;
        }
      }
    }
  }
  function moveIfPossible(elm) {
    console.log("ME: background position:", elm.x, elm.y);
    const me = getCurrentPixelPosition(elm);
    console.log("ME: current position:", me);
    const neighbors = getNeighbors(me);
    for (let n in neighbors) {
      if (isValidTile(neighbors[n])) {
        //console.log(neighbors[n]);
        const tile = $(getTileByPosition(neighbors[n]));
        if (tile[0]) console.log("My neighbor: ", tile[0].innerText);
        else {
          //console.log("empty tile encountered", neighbors[n]);
          moveTile(elm, neighbors[n], true);
          break;
        }
      }
    }
  }

  function getNeighbors(me = emptyTile) {
    return {
      t: { x: me.x, y: me.y - 100 },
      r: { x: me.x + 100, y: me.y },
      l: { x: me.x - 100, y: me.y },
      b: { x: me.x, y: me.y + 100 }
    };
  }
  function isValidTile(node) {
    const { x, y } = node;
    if (x < 0 || y < 0) return false;
    if (x > 300 || y > 300) return false;
    if (x + y > 500) return true; //empty tile
    return true;
  }
  function getTileByPosition(node) {
    const selector =
      "div[style*='left: " + node.x + "px; top: " + node.y + "px']";
    return $(selector).length > 0 ? $(selector)[0] : null;
  }
  function moveTile(node, empty, checkWinner = false) {
    console.log("MOVING ", node, " to EMPTY ", empty);
    emptyTile = getCurrentPixelPosition(node);
    const selector = {
      left: empty.x + "px",
      top: empty.y + "px"
    };
    $(node).css(selector);

    console.log("New Empty location: ", emptyTile);
    if (checkWinner) {
      setTimeout(checkIfWon, 0);
    }
  }
  function checkIfWon() {
    let counter = 0;
    let elm = null;
    const divs = $("#puzzlearea div");
    console.dir(divs);
    for (let div of divs) {
      elm = div.style;

      if (
        parseInt(elm.left) === -parseInt(elm.backgroundPositionX) &&
        parseInt(elm.top) === -parseInt(elm.backgroundPositionY)
      ) {
        counter++;
      } else {
        console.log(
          parseInt(elm.left),
          -parseInt(elm.backgroundPositionX),
          parseInt(elm.top),
          -parseInt(elm.backgroundPositionY)
        );
      }
    }
    console.log("Checking Winner: counter=", counter);
    if (counter == 15) alert("You won!");
  }
  function hightLightTile(node) {
    console.log("Highlighting  tile ", node);

    $(node).addClass("movablepiece");
  }
  function getCurrentPixelPosition(node) {
    const x = node.x > 0 ? "-" + node.x : node.x;
    const y = node.y > 0 ? "-" + node.y : node.y;
    const selector =
      "div[style*='background-position: " + x + "px " + y + "px']";
    console.log(selector);
    return {
      x: parseInt($(selector)[0].style.left),
      y: parseInt($(selector)[0].style.top)
    };
  }

  function shuffle() {
    const neighbors = getNeighbors();

    let arr = [];
    for (let n in neighbors) {
      if (isValidTile(neighbors[n])) {
        arr.push(neighbors[n]);
      }
    }
    console.log("Empty's neighbors:", arr);

    const random = Math.floor(Math.random() * arr.length);
    console.log(random);
    const me = getTileByPosition(arr[random]);
    console.log("To be moved:", me, emptyTile);
    if (me) moveTile(me, emptyTile);
  }
  $("#shufflebutton").click(() => {
    const t0 = performance.now();
    let i = 0;
    do {
      shuffle();
      i++;
    } while (performance.now() - t0 < 777 && i < 333);
    const t1 = performance.now();
    console.log(
      "Call to doSomething took " + (t1 - t0) + " milliseconds. & i is ",
      i
    );
  });
}
