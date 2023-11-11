<?php
/**
 * Archive partial
 *
 * @package      YoussefBouhlal2023
 * @author       Youssef Bouhlal
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

echo '<article class="post-summary">';
mystartertheme_post_summary_image();

echo '<div class="post-summary__content">';
	mystartertheme_entry_category();
	mystartertheme_post_summary_title();
echo '</div>';

echo '</article>';
