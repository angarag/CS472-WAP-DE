$(document).ready(function() {
  const url = "http://mumstudents.org/cs472/2015-07-DE/Labs/8/urban.php";
  const data = {
    term: $("#term").val(),
    all: true
  };
  $("#lookup").click(function() {
    console.log("lookup clicked", $("#term").val());
    $.get(url, { term: $("#term").val() })
      .done(data => {
        console.log("data retrieved:", data);
        $("#result").text(data);
      })
      .fail(err => {
        console.error("Error: ", err);
        $("#result").text(err.responseText || err.statusText);
      });

    $.ajax({
      url: url,
      dataType: "html",
      contentType: "application/json; charset=utf-8",
      data: JSON.stringify(data),
      success: function(data) {
        console.log("xml: ", data);
      }
    });
    // //with JSONP
    // $.getJSON(url + "?term=fnord", function(data) {
    //   console.log("jsonp is working", data);
    //   $("#result").text(data);
    // }).fail(err => {
    //   console.log(err);
    // });
  });
});
