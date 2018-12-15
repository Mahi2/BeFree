<?php
/**
 *   This file is part of the Befree.
 *
 *   @copyright   Henrique Mukanda <mahi2hm@outlook.fr>
 *   @copyright   Bernard ngandu <ngandubernard@gmail.com>
 *   @link    https://github.com/Mahi2/BeFree
 *   @link    https://github.com/bernard-ng/Befree
 *   @license   http://framework.zend.com/license/new-bsd New BSD License
 *
 *   For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 */


?>
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