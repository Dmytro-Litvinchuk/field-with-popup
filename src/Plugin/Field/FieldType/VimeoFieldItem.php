<?php

namespace Drupal\vimeo_field\Plugin\Field\FieldType;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Field\Annotation\FieldType;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implemetation of the 'vimeo_field'
 *
 * @FieldType(
 *   id = "vimeo_field",
 *   label = @Translation("Embed Vimeo video"),
 *   module = "vimeo_field",
 *   description = @Translation("Output video from Vimeo."),
 *   category = @Translation("Custom"),
 *   default_widget = "vimeo_field_widget",
 *   default_formatter = "vimeo_filed_formatter"
 * )
 */
class VimeoFieldItem extends FieldItemBase {

  /**
   * @inheritDoc
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'value' => [
          'type' => 'varchar',
          'length' => 2083,
          'not null' => FALSE,
        ],
      ],
    ];
  }

  /**
   * @inheritDoc
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * @inheritDoc
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Vimeo video URL'));
    return $properties;
  }

}
