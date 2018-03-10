// JQuery Sticy Header
jQuery(document).ready(function(a) {
    $this=a(".header-fixed");$adminbar=a("#wpadminbar");
    if($this.length!=0)
    {height=($adminbar.length!=0)?Math.abs($this.height()-$adminbar.height()): $this.height();
        $this.parent("header").css("padding-bottom",height)
    }});