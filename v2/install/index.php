<?php
include "core.php";
head();
?>
<center>
    <center>
        <h6>
            <?php
            echo lang_key("choose_language");
            ?>: </h6></center>
    <br/>
    <select name="language" class="form-control" size="4"
            onChange="top.location.href=this.options[this.selectedIndex].value;" required autofocus>
        <option value="?lang=en" <?php
        if ($curr_lang == "en") {
            echo 'selected';
        }
        ?>>English
        </option>
        <option value="?lang=de" <?php
        if ($curr_lang == "de") {
            echo 'selected';
        }
        ?>>Deutsch
        </option>
        <option value="?lang=es" <?php
        if ($curr_lang == "es") {
            echo 'selected';
        }
        ?>>Español
        </option>
        <option value="?lang=bg" <?php
        if ($curr_lang == "bg") {
            echo 'selected';
        }
        ?>>Български
        </option>
    </select>

</center>

<br/>

<form action="database.php" method="post">

    <br/>
    <center>

        <input name="nextstep" type="submit" class="btn btn-primary" value="<?php
        echo lang_key("continue");
        ?>"/>
</form>
</center>
<?php
footer();
?>
