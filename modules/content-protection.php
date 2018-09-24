<?php
//Content Protection
$table = $prefix . 'content-protection';
$query = $mysqli->query("SELECT * FROM `$table`");

if ($srow['jquery_include'] == 1) {
    echo '<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>';
}

while ($row = $query->fetch_assoc()) {

    //Disable Right Click (Context Menu)
    if ($row['function'] == 'rightclick' && $row['enabled'] == 1) {
        echo '
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
      $(document).bind("contextmenu",function(e) {
		  ';
        if ($row['alert'] == 1)
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
          e.preventDefault();
      });
}, false);
</script>
';
    }

    //Disable Right Click on Images
    if ($row['function'] == 'rightclick_images' && $row['enabled'] == 1) {
        echo '
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
$(\'img\').bind(\'contextmenu\', function(e){
';
        if ($row['alert'] == 1)
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
return false;
});
}, false);
</script>
';
    }

    //Disable Cut
    if ($row['function'] == 'cut' && $row['enabled'] == 1) {
        echo '
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
      $(document).bind("cut",function(e) {
		  ';
        if ($row['alert'] == 1)
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
          e.preventDefault();
      });
}, false);
</script>
';
    }

    //Disable Copy
    if ($row['function'] == 'copy' && $row['enabled'] == 1) {
        echo '
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
      $(document).bind("copy",function(e) {
		  ';
        if ($row['alert'] == 1)
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
          e.preventDefault();
      });
}, false);
</script>
';
    }

    //Disable Paste
    if ($row['function'] == 'paste' && $row['enabled'] == 1) {
        echo '
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
      $(document).bind("paste",function(e) {
		  ';
        if ($row['alert'] == 1)
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
          e.preventDefault();
      });
}, false);
</script>
';
    }

    //Disable Drag
    if ($row['function'] == 'drag' && $row['enabled'] == 1) {
        echo '
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
      $(document).bind("drag",function(e) {
          e.preventDefault();
      });
}, false);
</script>
';
    }

    //Disable Drop
    if ($row['function'] == 'drop' && $row['enabled'] == 1) {
        echo '
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
      $(document).bind("drop",function(e) {
          e.preventDefault();
      });
}, false);
</script>
';
    }

    //Disable PrintScreen
    if ($row['function'] == 'printscreen' && $row['enabled'] == 1) {
        echo '
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
$(document).keyup(function (e) {
    if(!e) e = window.event;
    var keyCode = e.which || e.keyCode
    if (keyCode  == 44) {
        ';
        if ($row['alert'] == 1)
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
        ccd();
    }
});
}, false);
</script>
';
    }

    //Disable Printing
    if ($row['function'] == 'print' && $row['enabled'] == 1) {
        echo '
<style type="text/css" media="print">
    /* Disable Printing */
    * { display: none; }
</style>
<script language="javascript">
document.addEventListener("DOMContentLoaded", function() {
jQuery(document).bind("keyup keydown", function(e){
    if(e.ctrlKey && e.keyCode == 80){
        ';
        if ($row['alert'] == 1)
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
        return false;
    }
});
}, false);
</script>
';
    }

    //Disable View Source Keyboard Shortcut
    if ($row['function'] == 'view_source' && $row['enabled'] == 1) {
        echo '
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
document.onkeydown = function(e) {
        if (e.ctrlKey && (e.keyCode === 85)) {
            ';
        if ($row['alert'] == 1)
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
            return false;
        } else {
            return true;
        }
};
}, false);
</script>
';
    }

    //Keep the website out of frames
    if ($row['function'] == 'iframe_out' && $row['enabled'] == 1) {
        echo '
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
if(top.location!=self.location) top.location=self.location;
}, false);
</script>
';
    }

    //Disable Selecting
    if ($row['function'] == 'selecting' && $row['enabled'] == 1) {
        echo '
<style>
/*  */
body{
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
</style>
';
    }

}
?>
