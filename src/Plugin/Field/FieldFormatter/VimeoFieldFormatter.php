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
      'width' => '560',
      'height' => '315',
    ] + parent::defaultSettings();
  }

  /**
   * @inheritDoc
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
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
    return $elements;
  }

  /**
   * @inheritDoc
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];
    $width = $this->getSetting('width');
    $height = $this->getSetting('height');
    foreach ($items as $delta => $item) {
      $element[$delta] = [
        '#type' => 'inline_template',
        '#template' => '<iframe width="{{ width }}" height="{{ height }}"
          src="{{ url }}" class="pop-up" hidden></iframe>',
        '#context' => [
          'url' => $item->value,
          'width' => $width,
          'height' => $height,
        ],
        /**'#attributes' => [
          // Add class.
          'class' => [
            'popup',
          ],
          // Hide container.
          'style' => [
            'display:none;',
          ],
        ],
         */
      ];
    }
    return $element;
  }

  public function settingsSummary() {
    $summary = [];
    $settings = $this->getSettings();
    if (!empty($settings['width']) && !empty($settings['height'])) {
      $summary[] = t('Video size: @width x @height', ['@width' => $settings['width'], '@height' => $settings['height']]);
    }
    else {
      $summary[] = t('Define video size');
    }
    return $summary;
  }

}
