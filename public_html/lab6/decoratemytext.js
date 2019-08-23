$(document).ready(() => {
  console.log("Windows loaded");

  $("body").css({ width: "1024px", margin: "0 auto" });
  $("fieldset div#text").css({
    display: "flex",
    flexDirection: "column",
    flexWrap: "wrap",
    alignContent: "flex-end"
  });

  $("fieldset div#decoration input").css({
    display: "block"
  });
  $("fieldset div#text span").css("font-size", "12px");
});

function mars() {
  console.log("clicked");
  //Exercise 1:
  //$("fieldset div#text span").css("font-size", "1.5em");
  //Exercise 2:
  timer = setInterval(() => {
    helper();
  }, 500);
  function helper() {
    $fsize = $("fieldset div#text span").css("font-size");
    console.log($fsize);
    $("fieldset div#text span").css("font-size", parseInt($fsize) + 2 + "px");
  }
}

function checkbox(elm) {
  console.log("checkbox clicked");
  console.dir(elm);
  elm = $(elm);
  if (elm.attr("checked")) {
    $("body").css({
      backgroundImage: `url(
        "http://www.cs.washington.edu/education/courses/190m/CurrentQtr/labs/6/hundred-dollar-bill.jpg"
)`
    });
    $("fieldset").css({
      "font-weight": "bold"
    });
    $("fieldset div span").css({
      color: "green",
      textDecoration: "underline"
    });
  } else {
    $("fieldset").css({
      "font-weight": "normal"
    });
    $("fieldset div span").css({
      color: "black",
      textDecoration: "none"
    });
    $("body").css({
      backgroundImage: `url(
        ""
)`
    });
  }
}
