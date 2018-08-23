<?php
include "core.php";
head();
?>
<center>
  <center>
    <h6>
      <?php
        echo lang_key("choose_language");
        ?>: </h6></center><br />
                                <select name="language" class="form-control" size="4"  onChange="top.location.href=this.options[this.selectedIndex].value;" required autofocus>
                                  <option value="?lang=en" <?php
if ($curr_lang == "en") {
    echo 'selected';
}
?>>
