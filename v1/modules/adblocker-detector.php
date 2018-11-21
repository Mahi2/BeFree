<?php
  //ADBlock Detector
  $table  = $prefix . 'adblocker-settings';
  $query  = $mysqli->query("SELECT * FROM '$table'");
  $row    = $query->fetch_assoc();

  if($row['detection'] == 1){
    echo '
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {

var testAd = document.createElement("div");
testAd.innerHTML = "&nbsp;";
testAd.className = "adscard";
document.body.appendChild(testAd);
window.setTimeout(function() {
  if (testAd.offsetHeight === 0) {
	window.location = "' . $row['redirect'] . '";
  }
  testAd.remove();
});

}, false);

</script>';

}
?>
