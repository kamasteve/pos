<?php
/*******************************************************************************
* Simplified PHP Invoice System                                                *
*                                                                              *
* Version: 1.1.1	                                                               *
* Author:  James Brandon                                    				   *
*******************************************************************************/

// Debugging
ini_set('error_reporting', E_ALL);

 //DATABASE INFORMATION
define('DATABASE_HOST', 'localhost');
define('DATABASE_NAME', 'gikomba');
define('DATABASE_USER', 'root');
define('DATABASE_PASS', '');

// COMPANY INFORMATION
define('COMPANY_LOGO', '../images/logo.png');
define('COMPANY_LOGO_WIDTH', '356');
define('COMPANY_LOGO_HEIGHT', '95');
define('COMPANY_NAME','Techisoft Property Managers');
define('COMPANY_ADDRESS_1','66 Kanjatta');
define('COMPANY_ADDRESS_2','Unit 5C, Office 14');
define('COMPANY_ADDRESS_3','Camdem');
define('COMPANY_COUNTY','Nairobi');
define('COMPANY_POSTCODE','E17 8EE');

define('COMPANY_NUMBER','Company No: 48486468'); // Company registration number
define('COMPANY_VAT', 'Company VAT: 468546846'); // Company TAX/VAT number

// EMAIL DETAILS
define('EMAIL_FROM', 'sales@domain.com'); // Email address invoice emails will be sent from
define('EMAIL_NAME', 'Company Name Ltd'); // Email from address
define('EMAIL_SUBJECT', 'Invoice subject'); // Invoice email subject
define('EMAIL_BODY_INVOICE', 'Invoice body'); // Invoice email body
define('EMAIL_BODY_QUOTE', 'Invoice body'); // Invoice email body
define('EMAIL_BODY_RECEIPT', 'Invoice body'); // Invoice email body

// OTHER SETTINFS
define('INVOICE_PREFIX', 'SSJ'); // Prefix at start of invoice - leave empty '' for no prefix
define('INVOICE_INITIAL_VALUE', '1000'); // Initial invoice order number (start of increment)
define('INVOICE_THEME', '#222222'); // Theme colour, this sets a colour theme for the PDF generate invoice
define('TIMEZONE', 'Europe/London'); // Timezone - See for list of Timezone's http://php.net/manual/en/function.date-default-timezone-set.php
define('DATE_FORMAT', 'YYYY/MM/DD'); // DD/MM/YYYY or MM/DD/YYYY
define('CURRENCY', 'KES '); // Currency symbol
define('ENABLE_VAT', true); // Enable TAX/VAT
define('VAT_INCLUDED', false); // Is VAT included or excluded?
define('VAT_RATE', '0'); // This is the percentage value

define('PAYMENT_DETAILS', 'Techisoft Solutions Ltd<br>Sort Code: 00-00-00<br>Account Number: 12345678'); // Payment information
define('FOOTER_NOTE', 'http://www.techisoft.co.ke/');

// CONNECT TO THE DATABASE
$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

?>