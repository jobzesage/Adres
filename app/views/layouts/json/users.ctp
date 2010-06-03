<?php
header("Pragma: no-cache");
header("Cache-Control: no-store, no-cache, max-age=0, must-revalidate");
//header('Content-Type: text/x-json');

$response = array('status' => $status);

if (isset($msg)) {
	$response['msg'] = $msg;
}

$response['data'] = trim($content_for_layout);

if (isset($paginator) && is_object($paginator) && $paginator->params['paging']) {
	$response['pagination'] = $this->element('pagination');
}

echo json_encode($response);