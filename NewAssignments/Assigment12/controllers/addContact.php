<?php

require_once('classes/StickyForm.php');
require_once('classes/Pdo_methods.php');

$acknowledgment = "<p></p>";//I use $acknowledgment as a placeholder because sometimes it has data and sometimes it does not and if it does not I don't want the space to collapse. 

$formConfig = [
    'first_name' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => '*First Name',
        'name' => 'first_name',
        'id' => 'first_name',
        'errorMsg' => 'You must enter a valid first name',
        'error' => '',
        'required' => true,
        'value' => 'Scott'
    ],
    'last_name' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => '*Last Name',
        'name' => 'last_name',
        'id' => 'last_name',
        'errorMsg' => 'You must enter a valid last name.',
        'error' => '',
        'required' => true,
        'value' => 'Shaper'
    ],
    'address' => [
        'type' => 'text',
        'regex' => 'address',
        'label' => '*Address',
        'name' => 'address',
        'id' => 'address',
        'errorMsg' => 'You must enter a valid address.',
        'error' => '',
        'required' => true,
        'value' => '123 Anyplace'
    ],
    'state' => [
        'type' => 'select',
        'label' => '*State',
        'name' => 'state',
        'id' => 'state',
        'errorMsg' => 'You must select a state.',
        'error' => '',
        'selected' => 'mi',
        'required' => true,
        'options' => [
            '0' => 'Please Select a State',
            'ca' => 'California',
            'tx' => 'Texas',
            'mi' => 'Michigan',
            'ny' => 'New York',
            'fl' => 'Florida'
        ]
    ],
    'zip_code' => [
        'type' => 'text',
        'regex' => 'zip',
        'label' => '*Zip Code',
        'name' => 'zip_code',
        'id' => 'zip_code',
        'errorMsg' => 'You must enter a valid zip code.',
        'error' => '',
        'required' => true,
        'value' => '12345'
    ],
    'phone' => [
        'type' => 'text',
        'regex' => 'phone',
        'label' => '*Phone',
        'name' => 'phone',
        'id' => 'phone',
        'errorMsg' => 'You must enter a valid phone number.',
        'error' => '',
        'required' => true,
        'value' => '999.999.9999'
    ],
    'email' => [
        'type' => 'text',
        'regex' => 'email',
        'label' => '*Email',
        'name' => 'email',
        'id' => 'email',
        'errorMsg' => 'You must enter a valid email address.',
        'error' => '',
        'required' => true,
        'value' => 'sshaper@wccnet.edu'
    ],
    'age_range' => [
        'type' => 'radio',
        'label' => '*Age Range',
        'name' => 'age_range',
        'id' => 'age_range',
        'errorMsg' => 'You must select an age range.',
        'error' => '',
        'required' => false,
        'value' => '',
        'options' => [
            '0-17' => [
                'value' => '0-17',
                'label' => '0-17',
                'checked' => false
            ],
            '18-29' => [
                'value' => '18-29',
                'label' => '18-29',
                'checked' => false
            ],
            '30-39' => [
                'value' => '30-39',
                'label' => '30-39',
                'checked' => false
            ],
            '40-49' => [
                'value' => '40-49',
                'label' => '40-49',
                'checked' => false
            ],
            '50+' => [
                'value' => '50+',
                'label' => '50+',
                'checked' => false
            ]
        ]
    ],
    'contact_method' => [
        'type' => 'checkbox',
        'label' => 'Contact Options',
        'name' => 'contact_method',
        'id' => 'contact_method',
        'errorMsg' => 'Please select at least one contact method.',
        'error' => '',
        'required' => false,
        'options' => [
            'newsletter' => [
                'value' => 'newsletter',
                'label' => 'Newsletter',
                'checked' => false
            ],
            'email' => [
                'value' => 'email',
                'label' => 'Email Updates',
                'checked' => false
            ],
            'text' => [
                'value' => 'text',
                'label' => 'Text Updates',
                'checked' => false
            ]
        ]
    ],
    'masterStatus' => [
        'error' => false
    ]

];


// Initialize StickyForm instance
$stickyForm = new StickyForm();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $formConfig = $stickyForm->validateForm($_POST, $formConfig);
    if (!$stickyForm->hasErrors() && $formConfig['masterStatus']['error'] == false) {
      
      $pdo = new PdoMethods;

      $sql = "INSERT INTO contactMod (firstName, lastName, address, state, zip, phone, email, age_range, contact_method) 
              VALUES (:fname, :lname, :address, :state, :zip, :phone, :email, :age_range, :contact_method)";

      // Convert checkbox array to string for storage
      $contact_methods = isset($_POST['contact_method']) ? implode(',', $_POST['contact_method']) : '';

      $bindings = [
        [':fname', $_POST['first_name'], 'str'],
        [':lname', $_POST['last_name'], 'str'],
        [':address', $_POST['address'], 'str'],
        [':state', $_POST['state'], 'str'],
        [':zip', $_POST['zip_code'], 'str'],
        [':phone', $_POST['phone'], 'str'],
        [':email', $_POST['email'], 'str'],
        [':age_range', $_POST['age_range'], 'str'],
        [':contact_method', $contact_methods, 'str']
      ];

      $result = $pdo->otherBinded($sql, $bindings);

      if($result === 'error'){
        $acknowledgment = '<p style="color: red">There was an error adding the name</p>';
      }
      else {
        $acknowledgment = '<p style="color: green">Name has been added</p>';
      }
    }  
}