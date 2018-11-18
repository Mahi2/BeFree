<center>
    <center><h6><?= _lang("choose_language"); ?>: </h6></center>
    <br/>
    <form action="">
        <select name="language" class="form-control" size="4" onChange="top.location.href=this.options[this.selectedIndex].value;" required autofocus>
            <option value="?lang=en" <?= ($currLang == 'en') ? 'selected' : '' ?>>English</option>
            <option value="?lang=de" <?= ($currLang == 'de') ? 'selected' : '' ?> >Deutsch</option>
            <option value="?lang=es" <?= ($currLang == 'es') ? 'selected' : '' ?> >Español</option>
            <option value="?lang=bg" <?= ($currLang == 'bg') ? 'selected' : '' ?>>Български</option>
        </select>
    </form>
</center>
<br/>
<form action="?step=database" method="post">
    <br/>
    <center>
        <input name="nextstep" type="submit" class="btn btn-primary" value="<?= _lang('continue') ?>"/>
    </center>
</form>