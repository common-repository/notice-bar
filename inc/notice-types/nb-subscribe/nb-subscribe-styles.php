<?php
   if($nb_settings['notice']['section_1']['type']=='nb-subscribe-form' || (isset($nb_settings['notice']['section_2']['type']) && $nb_settings['notice']['section_2']['type']=='nb-subscribe-form') || (isset($nb_settings['notice']['section_3']['type']) && $nb_settings['notice']['section_3']['type']=='nb-subscribe-form')) 

{ 
echo
'<style>
.nb-customer {
    border-collapse: separate;
    display: table;
    position: relative;
}
.nb-customer-submit {
    position: relative;
    white-space: nowrap;
    vertical-align: middle;
    display: table-cell;
    border-collapse:seperate;
    border-radius:0;
}
input.input-customer {
   font-size: 10px;
   border-radius: 0;
   height: 31px;
   line-height: 15px;
   vertical-align: middle;
   margin-left: -2px;
   padding: 0.84375em 0.875em 0.78125em;
}
.success-msg, .failed-msg {
    position: absolute;
    font-size: 8px;
    z-index: 1;
    font-weight: bold;
    padding: 0 10px;
    color: #fff;
}
.success-msg{
    background:#008542;
}
.failed-msg{
      background: #DD3333;
}
</style>';
 } ?>