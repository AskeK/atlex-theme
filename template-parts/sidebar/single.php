<?php

if(in_array(get_post_type(get_the_ID()),array('forlob','ovelse'))){
    get_template_part('template-parts/forms/item-finder-form');
}
