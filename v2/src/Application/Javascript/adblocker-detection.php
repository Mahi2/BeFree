<script type="text/javascript" id="<?= $this->name ?>">
    document.addEventListener("DOMContentLoaded", function() {
        var testAd = document.createElement("div");
        testAd.innerHTML = "&nbsp;";
        testAd.className = "adscard";
        document.body.appendChild(testAd);
        window.setTimeout(function() {
            if (testAd.offsetHeight === 0) {
                window.location = <?= $redirect ?> ;
            }
            testAd.remove();
        });

    }, false);
</script>';