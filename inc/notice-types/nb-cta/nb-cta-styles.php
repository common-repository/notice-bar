<?php
   if((isset($nb_settings['notice']['section_1']['type']) && $nb_settings['notice']['section_1']['type']=='call-to-action') || (isset($nb_settings['notice']['section_2']['type']) && $nb_settings['notice']['section_2']['type']=='call-to-action') || (isset($nb_settings['notice']['section_3']['type']) && $nb_settings['notice']['section_3']['type']=='call-to-action')) 
   	
{
echo
'<style>
.nb-cta a {
    padding: 5px 6px;
    border-radius: 2px;
    color: #fff;
    font-size: 85%;
   background: #0085ba;
    box-shadow: 0 1px 0 #006799;
    text-shadow: 0 -1px 1px #006799,1px 0 1px #006799,0 1px 1px #006799,-1px 0 1px #006799;
    border-color: #0073aa #006799 #006799;
        transition: all 0.4s;
}
.nb-cta a:hover {
   background: #0095dd;
    border:none;
    color: #fff; 
}
.nb-cta {
    padding: 7px;
    width:100%;
    text-align:center;
}
.nb-cta-textarea {
    margin-bottom: 5px;
}
</style>';
}
