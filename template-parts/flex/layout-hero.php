<?php
$title = get_sub_field('title');
$text = get_sub_field('text');
$image_id = get_sub_field('background_image');
$primary_cta = get_sub_field('primary_cta');
$secondary_cta = get_sub_field('secondary_cta');
$image_url = $image_id ? wp_get_attachment_image_url($image_id, 'full') : '';

$render_cta = static function ($cta, $class) {
  if (!is_array($cta) || empty($cta['url'])) {
    return;
  }

  $target = !empty($cta['target']) ? $cta['target'] : '_self';
  $rel = $target === '_blank' ? 'noopener noreferrer' : '';
  $label = !empty($cta['title']) ? $cta['title'] : '';

  if (!$label) {
    return;
  }
  ?>
  <a class="<?php echo esc_attr($class); ?>"
     href="<?php echo esc_url($cta['url']); ?>"
     target="<?php echo esc_attr($target); ?>"
     rel="<?php echo esc_attr($rel); ?>">
    <?php echo esc_html($label); ?>
  </a>
  <?php
};

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
        <?php $render_cta($primary_cta, 'hero__button hero__button--primary'); ?>
        <?php $render_cta($secondary_cta, 'hero__button hero__button--secondary'); ?>
      </div>
    <?php endif; ?>
  </div>
</div>
