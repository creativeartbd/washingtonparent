<?php
/**
 * Theme basic setup
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Sidebare magazine shortcode
 */

add_shortcode( 'everstrap_sidebar_magazine', 'render_sidebar_magazine' );
function render_sidebar_magazine() {

   $html = '';

   $html .= '<div class="sidebar-newsletter-wrapper">';

      $magazine_image = everstrap_get_field( 'magazine_image', 'option' );
      if( $magazine_image ) {
         $html .= "<img src='$magazine_image'>";
      }

      $magazine = everstrap_get_field( 'magazine', 'option' );
      if( $magazine ) {

         $magazine_label = $magazine['magazine_label'];
         if( $magazine_label ) {
            $magazine_page_url = $magazine['magazine_page_url'];
            $html .= sprintf( "<p><a href='%s' target='_blank'>%s</a></p>", $magazine_page_url, $magazine_label );
         }
      }

      $newsletter = everstrap_get_field( 'newsletter', 'option' );
      if( $newsletter ) {

         $newsletter_label = $newsletter['newsletter_label'];
         $newsletter_class_name = $newsletter['newsletter_class_name'];

         if( $newsletter_label ) {
            $html .= sprintf( "<p><a href='#' data-toggle='%s' data-target='%s'>%s</a></p>", $newsletter_class_name, '#newsletterModal', $newsletter_label);
         }
      }

      $back_issues = everstrap_get_field( 'back_issues', 'option' );
      if( $back_issues ){

         $back_issues_label = $back_issues['back_issues_label'];
         $back_issues_page = $back_issues['back_issues_page'];
         $page_id = $back_issues_page->ID;
         $permalink = get_the_permalink( $page_id );

         if( $back_issues_label ) {
            $html .= sprintf( "<p><a href='%s'>%s</a></p>", $permalink, $back_issues_label );
         }
      }

      $current_stories = everstrap_get_field( 'current_stories', 'option' );
      if( $current_stories ){

         $current_stories_label = $current_stories['current_stories_label'];
         $current_stories_page = $current_stories['current_stories_page'];
         $page_id = $current_stories_page->ID;
         $permalink = 'issues/' . strtolower( date('F-Y') );

         if( $current_stories_label ) {
            $html .= sprintf( "<p><a href='%s'>%s</a></p>", $permalink, $current_stories_label );
         }
      }
   $html .= '</div>';

   return $html;
}


/**
 * Newsletter Shortcode
 */

 add_shortcode( 'everstrap_newsletter', 'render_everstrap_newsletter' );
 function render_everstrap_newsletter() {

    $data = '';
    $data .= '<div class="newsletter-widget-wrapper">';
    $data .= '<h2>Subscribe to our E-Newsletter and get exclusive giveaways!</h2>';
    $data .= '<form action="">';
    $data .= '<input type="text" name="email" placeholder="Email Address" class="form-control newsletter-input" required>';
    $data .= '<input type="submit" name="submit" value="Submit" class="btn btn-success btn-block newsletter-btn">';
    $data .= '</form>';
    $data .= '</div>';

    return $data;

 }
