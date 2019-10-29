<?php

function sendMail($from, $to,$subject, $body,
		$extra= array('head'=>'','headline'=>'','footline'=>'')) {
	$to = implode(', ', $to);
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	// Additional headers
	$headers .= 'From: Integrity Worship Center <'.$from.'>' . "\r\n";
	
	$message = '<html>';
	$message .= '<head>';
	
	if (!empty($extra['head']))
		$message .= $extra['head'];
	
	$message .= '<title> IWC: '.$subject.'<title>';
	$message .= '</head>';
	$message .= '<body>';
	if (!empty($extra['headline']))
		$message .= $extra['headline'];
	
	$message .= $body;
	
	if (!empty($extra['footline']))
		$message .= $extra['footline'];
	
	$message .= '</body>';
	$message .= '</html>';
	
	if(mail($to, $subject, $message,$headers))
		return true;
	
}
