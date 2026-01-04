<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
}
if($_SESSION['isAdmin'] != true) {
  header('Location: /go/dashboard.php?error=forbidden');
}

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../resources/orm/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $prepared_properties = prepare_properties($_POST, prepare_dates($_POST));
  $cfa = Art\CfaQuery::create()->findPK($_POST['RecordId']);
  $cfa->fromArray($prepared_properties);
  $cfa->save();
  header("Location: /go/cfa/view.php?id=".$_POST['RecordId']."&status=201");
} else {
  header("Location: /go/cfa/view.php?id=".$_POST['RecordId']."&status=500&detail=notPOST");
}

function prepare_dates($raw_post) {
  $final_PrintDateSent_date = $raw_post["PrintDateSent-year"];
  if($raw_post["PrintDateSent-month"]) {
    $final_PrintDateSent_date = $final_PrintDateSent_date . "-" . $raw_post["PrintDateSent-month"];
    if($raw_post["PrintDateSent-day"]) {
      $final_PrintDateSent_date = $final_PrintDateSent_date . "-" . $raw_post["PrintDateSent-day"];
    }
  }
  $final_PrintDateReceipt_date = $raw_post["PrintDateReceipt-year"];
  if($raw_post["PrintDateReceipt-month"]) {
    $final_PrintDateReceipt_date = $final_PrintDateReceipt_date . "-" . $raw_post["PrintDateReceipt-month"];
    if($raw_post["PrintDateReceipt-day"]) {
      $final_PrintDateReceipt_date = $final_PrintDateReceipt_date . "-" . $raw_post["PrintDateReceipt-day"];
    }
  }
  $final_BuyerDatePurchase_date = $raw_post["BuyerDatePurchase-year"];
  if($raw_post["BuyerDatePurchase-month"]) {
    $final_BuyerDatePurchase_date = $final_BuyerDatePurchase_date . "-" . $raw_post["BuyerDatePurchase-month"];
    if($raw_post["BuyerDatePurchase-day"]) {
      $final_BuyerDatePurchase_date = $final_BuyerDatePurchase_date . "-" . $raw_post["BuyerDatePurchase-day"];
    }
  }
  $final_BuyerDateReceipt_date = $raw_post["BuyerDateReceipt-year"];
  if($raw_post["BuyerDateReceipt-month"]) {
    $final_BuyerDateReceipt_date = $final_BuyerDateReceipt_date . "-" . $raw_post["BuyerDateReceipt-month"];
    if($raw_post["BuyerDateReceipt-day"]) {
      $final_BuyerDateReceipt_date = $final_BuyerDateReceipt_date . "-" . $raw_post["BuyerDateReceipt-day"];
    }
  }
  return array($final_PrintDateSent_date, $final_PrintDateReceipt_date, $final_BuyerDatePurchase_date, $final_BuyerDateReceipt_date);
}

function prepare_properties($raw_post, $prepared_dates) {
  return array(
    'PieceId' => $raw_post['PieceId'],
    'PieceIdRun' => $raw_post['PieceIdRun'],
    'PieceIdCount' => $raw_post['PieceIdCount'],
    'PrintCompany' => $raw_post['PrintCompany'],
    'PrintDateSent' => $prepared_dates[0],
    'PrintDateReceipt' => $prepared_dates[1],
    'PrintMedium' => $raw_post['PrintMedium'],
    'PrintCost' => $raw_post['PrintCost'],
    'PrintNotes' => $raw_post['PrintNotes'],
    'BuyerName' => $raw_post['BuyerName'],
    'BuyerLocation' => $raw_post['BuyerLocation'],
    'BuyerDatePurchase' => $prepared_dates[2],
    'BuyerDateReceipt' => $prepared_dates[3],
    'Notes' => $raw_post['Notes']
  );
}

?>