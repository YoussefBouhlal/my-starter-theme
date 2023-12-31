import { unregisterBlockType, unregisterBlockStyle } from '@wordpress/blocks';
import domReady from '@wordpress/dom-ready';

domReady(function () {
    unregisterBlockType( 'core/archives' );
    unregisterBlockType( 'core/avatar' );
    unregisterBlockType( 'core/calendar' );
    unregisterBlockType( 'core/comment-author-name' );
    unregisterBlockType( 'core/comment-content' );
    unregisterBlockType( 'core/comment-date' );
    unregisterBlockType( 'core/comment-edit-link' );
    unregisterBlockType( 'core/comment-reply-link' );
    unregisterBlockType( 'core/comment-template' );
    unregisterBlockType( 'core/comments' );
    unregisterBlockType( 'core/comments-pagination' );
    unregisterBlockType( 'core/comments-pagination-next' );
    unregisterBlockType( 'core/comments-pagination-numbers' );
    unregisterBlockType( 'core/comments-pagination-previous' );
    unregisterBlockType( 'core/comments-query-loop' );
    unregisterBlockType( 'core/comments-title' );
    unregisterBlockType( 'core/home-link' );
    unregisterBlockType( 'core/latest-comments' );
    unregisterBlockType( 'core/latest-posts' );
    unregisterBlockType( 'core/legacy-widget' );
    unregisterBlockType( 'core/loginout' );
    unregisterBlockType( 'core/media-text' );
    unregisterBlockType( 'core/navigation' );
    unregisterBlockType( 'core/navigation-link' );
    unregisterBlockType( 'core/navigation-submenu' );
    unregisterBlockType( 'core/post-author' );
    unregisterBlockType( 'core/post-author-name' );
    unregisterBlockType( 'core/post-author-biography' );
    unregisterBlockType( 'core/post-comments' );
    unregisterBlockType( 'core/post-comments-form' );
    unregisterBlockType( 'core/post-content' );
    unregisterBlockType( 'core/post-date' );
    unregisterBlockType( 'core/post-excerpt' );
    unregisterBlockType( 'core/post-featured-image' );
    unregisterBlockType( 'core/post-navigation-link' );
    unregisterBlockType( 'core/post-template' );
    unregisterBlockType( 'core/post-terms' );
    unregisterBlockType( 'core/post-title' );
    unregisterBlockType( 'core/query' );
    unregisterBlockType( 'core/query-no-results' );
    unregisterBlockType( 'core/query-pagination' );
    unregisterBlockType( 'core/query-pagination-next' );
    unregisterBlockType( 'core/query-pagination-numbers' );
    unregisterBlockType( 'core/query-pagination-previous' );
    unregisterBlockType( 'core/query-title' );
    unregisterBlockType( 'core/read-more' );
    unregisterBlockType( 'core/site-logo' );
    unregisterBlockType( 'core/site-tagline' );
    unregisterBlockType( 'core/site-title' );
    unregisterBlockType( 'core/social-link' );
    unregisterBlockType( 'core/social-links' );
    unregisterBlockType( 'core/tag-cloud' );
    unregisterBlockType( 'core/term-description' );

    unregisterBlockStyle( 'core/button', [ 'squared', 'fill' ] );
	unregisterBlockStyle( 'core/separator', [ 'default', 'wide', 'dots' ] );
	unregisterBlockStyle( 'core/quote', [ 'default', 'large', 'plain' ] );
});