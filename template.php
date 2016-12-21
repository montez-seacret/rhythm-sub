<?php

function rhythm_sub_preprocess_page(&$variables) {
    if (!empty($variables['node']) && $variables['node']->type == 'page') {

            hide($variables['title']);

			$_domain = domain_get_domain();
			$domain_id = $_domain['domain_id'];
			 
			if($domain_id == 3){
				$content ='<style>';
				$content .= '.views-field-field-vip { display: none;}';
				$content .= '</style>';
				return($content);
			}


     }
}
