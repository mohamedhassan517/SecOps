var interval;

function genarateResponse() {
  var input = document.getElementById("text");

  var out = document.getElementById("output");

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      input.value = "";
      out.value = "";

      var text = request.responseText;

      var i = 0;

      interval = setInterval(function () {
        if (i < text.length) {
          out.value = out.value + text.charAt(i);
          i++;
        } else {
          clearInterval(interval);
        }
      }, 20);
    }
  };
  request.open("GET", "genarateResponse.php?prompt=" + input.value, true);
  request.send();
}

function stopGenarate() {
  clearInterval(interval);
}
