$(document).ready(() => {
  console.log("jQuery is ready now");
  let has_started = null;
  let has_hit_walls = null;
  let maze_event_counter = null;
  let non_maze_event_counter = 0;
  const start_snapshot = {
    maze_event_counter: null,
    non_maze_event_counter: null
  };
  reset();

  //   $("*:not(#maze)").mouseover(function() {
  //     if (
  //       !$(this)
  //         .parents()
  //         .is("#maze")
  //     ) {
  //       console.log(
  //         "#mouse over events on non-maze selectors = ",
  //         ++non_maze_event_counter
  //       );
  //     }
  //   });
  $("#maze").mouseout(function() {
    console.log("mouse is leaving #maze container");
    ++non_maze_event_counter;
  });
  $("#maze").mouseenter(function() {
    console.log("mouse is entering #maze container");
  });
  $("#maze *").mouseover(function() {
    console.log("#mazeEvents = ", ++maze_event_counter);
    if ($(this).hasClass("boundary")) {
      console.log($(this));
      //Exercise 1
      $(this).addClass("youlose");
      $("#status").text("You lose! :(");
      //Exercise 2
      $(".boundary").addClass("youlose");
      has_hit_walls = true;
    } else {
      if ($(this).is("#end")) {
        console.log("you reached the end");
        console.log(
          "END: #mazeEvents, #nonMazeEvent vs snapshot =",
          maze_event_counter,
          non_maze_event_counter,
          start_snapshot
        );

        //alert("You win!");
        if (has_hit_walls)
          $("#status").text(
            "You lose! Because you hit the wall before, click S to start!"
          );
        else {
          if (!has_started) $("#status").text("Click S to start!");
          else if (
            maze_event_counter - 1 !== start_snapshot.maze_event_counter ||
            non_maze_event_counter - 2 !== start_snapshot.non_maze_event_counter
          )
            $("#status").text("You cheated, click S to start!");
          else {
            $("#status").text("You win! :)");
            reset(false);
          }
        }
      } else {
        if ($(this).is("#start")) {
          start_helper();
        }
      }
    }
  });
  $("#maze #start").click(function() {
    start_helper(true);
  });
  function reset(status_reset = true) {
    if (status_reset) $("#status").html("<br/>");
    $(".boundary").removeClass("youlose");
    has_started = false;
    has_hit_walls = false;
    maze_event_counter = 0;
    non_maze_event_counter = 0;
    start_snapshot.maze_event_counter = 0;
    start_snapshot.non_maze_event_counter = 0;
  }
  function start_helper(set_text = false) {
    reset();
    has_started = true;
    start_snapshot.non_maze_event_counter = non_maze_event_counter;
    start_snapshot.maze_event_counter = maze_event_counter;
    console.log("START snapshot =", start_snapshot);
    if (set_text) $("#status").text("You started!");
  }
});
