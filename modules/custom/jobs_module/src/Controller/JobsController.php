<?php
namespace Drupal\jobs_module\Controller;


use Drupal\Core\Controller\ControllerBase;

use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;
use Drupal\node\Entity\Node;


class JobsController extends ControllerBase {
  public function content() {

    $title = \Drupal::request()->request ->get('job-name') ?? null;
    $location = \Drupal::request()->request ->get('location') ?? null;
    $checkbox = \Drupal::request()->request ->get('full-time-only') ?? null;


    $jobs = [];
    $query = \Drupal::entityQuery('node')
              ->condition('type', 'job');
    if($title)
      $query->condition('title', $title, 'CONTAINS');
    if($location)
      $query->condition('field_country', $location, 'CONTAINS');
    if($checkbox)
      $query->condition('field_job_type', $checkbox, 'CONTAINS');
//
//    'field_job_type', 'Full Time', 'CONTAINS'

    $nids = $query->execute();

    foreach ($nids as $i => $nid){
      $node = Node::load($nid);

      $fid = $node->field_company_logo->getValue()[0]['target_id'] ?? null;
      $file = File::load($fid);
      $image_uri = $file->getFileUri();
      $style = ImageStyle::load('thumbnail');
      $url = $style->buildUrl($image_uri);


      $jobs[$nid] = array(
        "id" => $nid,
        "title" =>$node->getTitle(),
        "company" => $node->field_company->getValue()[0]['value'],
        "job_type" => $node->field_job_type->getValue()[0]['value'],
        "date" => $node->field_date->getValue()[0]['value'],
        "logo" => $url,
        "country" => $node->field_country->getValue()[0]['value'],


      );


    }

// dump($jobs);
//    die();
    return [
      '#theme' => 'jobs_page',

      '#jobs' => $jobs,
    ];


  }
}
