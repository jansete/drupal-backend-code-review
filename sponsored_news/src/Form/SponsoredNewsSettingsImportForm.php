<?php

namespace Drupal\sponsored_news\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class SponsoredNewsSettingsImportForm.
 *
 * @package Drupal\idn_training_courses\Form
 */
class SponsoredNewsSettingsImportForm extends FormBase {

  /**
   * @var \Drupal\sponsored_news\SponsoredNews\SponsoredNews
   */
  private $sponsoredNews;

  /**
   * @var \Drupal\file\FileInterface
   */
  private $file;

  /**
   * SponsoredNewsSettingsImportForm constructor.
   */
  public function __construct() {
    $this->sponsoredNews = \Drupal::service('sponsored_news');
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'sponsored_news_settings_import_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['provider'] = array(
      '#type' => 'select',
      '#title' => 'Provider',
      '#options' => [
        'izuku' => 'Izuku',
        'Shoyo' => 'Shoyo',
      ],
    );

    $upload_validators = [
      'file_validate_extensions' => ['xml'],
    ];

    $form['file'] = [
      '#type' => 'file',
      '#description' => 'Only ' . implode(', ', $upload_validators['file_validate_extensions']) . ' files are allowed.',
      '#size' => 50,
      '#upload_location' => 'temporary://',
      '#upload_validators' => $upload_validators,
      '#attributes' => ['class' => ['file-import-input']],
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => 'Import',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $upload_validators = [
      'file_validate_extensions' => ['xml'],
    ];

    $this->file = file_save_upload('file', $upload_validators, 'temporary://', 0);

    // Ensure we have the file uploaded.
    if (!$this->file) {
      $form_state->setError($form['file'], 'File to import not found.');
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->sponsoredNews->import($form_state->getValue('provider'), $this->file);
    $redirect_url = Url::fromRoute('sponsored_news.listing');
    $form_state->setRedirectUrl($redirect_url);
  }

}
