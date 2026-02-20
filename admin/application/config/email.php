<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// SMTP Configuration for Hostinger
$config['hostinger'] = array(
    'protocol'    => 'smtp',
    'smtp_host'   => 'smtp.hostinger.com',  // Hostinger SMTP server
    'smtp_port'   => 587,                   // Use 465 for SSL, 587 for TLS
    'smtp_user'   => 'your-email@yourdomain.com', // Your Hostinger email
    'smtp_pass'   => 'your-email-password',  // Your Hostinger email password
    'smtp_crypto' => 'tls',  // Use 'ssl' for port 465
    'mailtype'    => 'html',
    'charset'     => 'utf-8',
    'newline'     => "\r\n",
    'wordwrap'    => TRUE
);

// SMTP Configuration for Gmail
$config['gmail'] = array(
    'protocol'    => 'smtp',
    'smtp_host'   => 'smtp.gmail.com',  // Gmail SMTP server
    'smtp_port'   => 587,               // Use 465 for SSL, 587 for TLS
    'smtp_user'   => 'ayushr418@gmail.com', // Your Gmail address
    'smtp_pass'   => 'bjdrusaltyauilvp',  // Use App Password, not your main password
    'smtp_crypto' => 'tls',  // Use 'ssl' for port 465
    'mailtype'    => 'html',
    'charset'     => 'utf-8',
    'newline'     => "\r\n",
    'wordwrap'    => TRUE
);
