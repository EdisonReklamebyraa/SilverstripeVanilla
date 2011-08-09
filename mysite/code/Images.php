<?php
class Images extends Image {

  function generatePageBanner($gd) {
    $gd->setQuality(100);
    return $gd->croppedResize(617, 400);
  }


}
?>