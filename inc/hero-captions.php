<?php
/**
 * Hero captions.
 *
 * Kadence row layouts that use a background image (the page heroes) get the
 * image's Media Library caption printed directly underneath them. Rows whose
 * image has no caption are left untouched, so a caption appears only where an
 * editor has filled one in (Media > the image > Caption).
 *
 * Styled by css/scss/nod/hero-captions.scss (.nod-hero-caption).
 */

add_filter('render_block_kadence/rowlayout', 'nod_hero_caption_after_row', 10, 2);

function nod_hero_caption_after_row($block_content, $block) {
    $image_id = isset($block['attrs']['bgImgID']) ? (int) $block['attrs']['bgImgID'] : 0;
    if (!$image_id) {
        return $block_content;
    }

    $caption = trim((string) wp_get_attachment_caption($image_id));
    if ($caption === '') {
        return $block_content;
    }

    return $block_content
        . '<p class="nod-hero-caption">' . wp_kses_post($caption) . '</p>';
}
