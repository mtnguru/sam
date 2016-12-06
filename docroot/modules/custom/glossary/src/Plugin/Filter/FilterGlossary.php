<?php

namespace Drupal\glossary\Plugin\Filter;

use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\taxonomy\Entity\Vocabulary;

/**
 * @Filter(
 *   id = "filter_glossary",
 *   title = @Translation("Glossary Filter"),
 *   description = @Translation("Link glossary terms to taxonomy term page"),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_TRANSFORM_REVERSIBLE,
 * )
 */
class FilterGlossary extends FilterBase {
  public static $taxonomy = null;

  public function process($text, $langcode) {
    if (self::$taxonomy == null) {
      $terms = \Drupal::entityManager()->getStorage('taxonomy_term')->loadTree($this->settings['taxonomy_id'], 0, null, true);
    }
    return new FilterProcessResult('<!-- processed -->' . $text);
  }

  /**
  * {@inheritdoc}
  */
  public static function defaultSettings() {
    return array(
      'taxonomy_id' => null,
    ) + parent::defaultSettings();
  }

  public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements = parent::settingsForm($form, $form_state);

    $vocabularies = Vocabulary::loadMultiple();
    foreach ($vocabularies as $name => $vocabulary) {
      $options[$name] = $vocabulary->get('name');
    }
    $form['taxonomy_id'] = array(
      '#type' => 'select',
      '#title' => $this->t('Select a Vocabulary'),
      '#default_value' => $this->settings['taxonomy_id'],
//    '#description' => $this->t('Display a short invitation after the default text.'),
      '#options' => $options,
    );
    return $form;
  }
}
