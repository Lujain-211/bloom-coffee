<?php
$title = get_sub_field('title');
$text = get_sub_field('text');
$image_id = get_sub_field('background_image');
$primary_cta = get_sub_field('primary_cta');
$secondary_cta = get_sub_field('secondary_cta');
$image_url = $image_id ? wp_get_attachment_image_url($image_id, 'full') : '';

$background_style = $image_url
  ? ' style="' . esc_attr('--hero-background-image: url("' . esc_url($image_url) . '")') . '"'
  : '';
?>
<div class="hero__panel"<?php echo $background_style; ?>>
  <div class="hero__content">
    <?php if ($title): ?>
      <h1 class="hero__title"><?php echo esc_html($title); ?></h1>
    <?php endif; ?>

    <?php if ($text): ?>
      <div class="hero__text"><?php echo wp_kses_post($text); ?></div>
    <?php endif; ?>

    <?php if ($primary_cta || $secondary_cta): ?>
      <div class="hero__actions">
        <a href="<?php echo esc_url($primary_cta['url']); ?>" class="btn btn-primary"><?php echo esc_html($primary_cta['title']); ?></a>
    <a href="<?php echo esc_url($secondary_cta['url']); ?>" class="btn btn-secondary"><?php echo esc_html($secondary_cta['title']); ?></a>
      </div>
    <?php endif; ?>
  </div>
</div>
