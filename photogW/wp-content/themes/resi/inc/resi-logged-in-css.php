<?php

add_action('wp_head', 'add_css_head');

function add_css_head() {
   if ( is_user_logged_in() ) {
   ?>
      <style>
          .header-cover {
			top:82px;
           }
      </style>
   <?php
   } else {
   ?>
      <style>
          .header-cover {
            top:50px;     
           }
      </style>
   <?php
   }
}