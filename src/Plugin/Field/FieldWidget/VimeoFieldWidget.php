<?php

namespace Drupal\vimeo_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * @FieldWidget(
 *   id = "vimeo_field_widget",
 *   module = "vimeo_field",
 *   label = @Translation("Vimeo video URL"),
 *   field_types = {
 *    "vimeo_field"
 *   }
 * )
 */
class VimeoFieldWidget extends WidgetBase {

  /**
   * @inheritDoc
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $value = isset($items[$delta]->value) ? $items[$delta]->value : NULL;
    $element += [
      '#type' => 'url',
      '#title' => t('Vimeo URL'),
      '#default_value' => $value,
      // It is not working and I don't know why? ('#pattern' => '*.vimeo.com')
      '#element_validate' => [
        [$this, 'validate'],
      ],
    ];
    return ['value' => $element];
  }

  /**
   * Validation only vimeo URL.
   *
   * @param $element
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  public static function validate($element, FormStateInterface $form_state) {
    $value = trim($element['#value']);
    if ($value !== '' && strpos($value, 'vimeo.com') === FALSE) {
      $form_state->setError($element, t('It is not vimeo URL'));
    }
  }

}
