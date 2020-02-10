<?php

namespace Drupal\vimeo_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * @FieldFormatter(
 *   id = "vimeo_filed_formatter",
 *   module = "vimeo_field",
 *   label = @Translation("Displays video thumbnail"),
 *   field_types = {
 *    "vimeo_field"
 *   }
 * )
 */
class VimeoFieldFormatter extends FormatterBase {

  /**
   * @inheritDoc
   */
  public static function defaultSettings() {
    return [
      'width' => '640',
      'height' => '360',
      'format' => 'default',
    ] + parent::defaultSettings();
  }

  /**
   * @inheritDoc
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements = [];
    $elements['width'] = [
      '#type' => 'number',
      '#title' => t('Vimeo video width'),
      '#default_value' => $this->getSetting('width'),
    ];
    $elements['height'] = [
      '#type' => 'number',
      '#title' => t('Vimeo video height'),
      '#default_value' => $this->getSetting('height'),
    ];
    $elements['format'] = [
      '#title' => $this->t('Player format'),
      '#type' => 'select',
      '#options' => [
        'default' => $this->t('default'),
        'pop-up' => $this->t('pop-up'),
      ],
      '#default_value' => $this->getSetting('format'),
    ];
    return $elements;
  }

  /**
   * @inheritDoc
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];
    $width = $this->getSetting('width');
    $height = $this->getSetting('height');
    $format = $this->getSetting('format');
    foreach ($items as $delta => $item) {
      $element[$delta] = [
        '#theme' => 'vimeo_video_formatter',
        '#url' => $item->value,
        '#width' => $width,
        '#height' => $height,
        '#format' => $format,
      ];
    }
    return $element;
  }

  public function settingsSummary() {
    $summary = [];
    $settings = $this->getSettings();
    if (!empty($settings['width']) && !empty($settings['height'])) {
      $summary[] = t('Video size: @width x @height </br> Player format: @format',
        ['@width' => $settings['width'], '@height' => $settings['height'], '@format' => $settings['format']]);
    }
    else {
      $summary[] = t('Define video size');
    }
    return $summary;
  }

}
