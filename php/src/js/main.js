var lastTimeID = 0;

$(document).ready(function() {
  $('#btnSend').click( function() {
    sendChatText();
    $('#chatInput').val("");
  });
  startChat();
});

// refresh the page in every 2 seconds.
function startChat(){
   setInterval( function() { getChatText(); }, 2000);
}

// function for get the chat text.
function getChatText() {
  $.ajax({
    type: "GET",
    url: "/refresh.php?lastTimeID=" + lastTimeID
  }).done( function( data )
  {
    var jsonData = JSON.parse(data);
    var jsonLength = jsonData.results.length;
    var html = "";
    for (var i = 0; i < jsonLength; i++) {
      var result = jsonData.results[i];
      html += '<div>(' + result.chattime + ') <b>' + result.usrname +'</b>: ' + result.chattext + '</div>';
      lastTimeID = result.id;
    }
    $('#view_ajax').append(html);
  });
}
// function for submit the chat lines to database.
function sendChatText(){
  var chatInput = $('#chatInput').val();
  if(chatInput != ""){
    $.ajax({
      type: "GET",
      url: "/submit.php?chattext=" + encodeURIComponent( chatInput )
    });
  }
}
// function to handle the browser close.
function logout() {
 var xmlhttp=new XMLHttpRequest();
 xmlhttp.open("GET", "logout.php", true);
 xmlhttp.send();
}
