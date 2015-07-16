# plg_articleclass

plugin to get the posibility to add a class to an article only

the class can be called in override, e.g. com_content/article/default.php

    $attribs = new JRegistry($this->item->attribs);
    $attribs = json_decode($attribs, 'true');
    $cssclass = $attribs['cssclass'];

To add the value use a simple echo

    <div class="<?php echo $cssclass; ?>">

Enjoy!
