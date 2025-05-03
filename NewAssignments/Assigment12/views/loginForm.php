<?php
require_once('controllers/loginProc.php');

// Initialize form configuration
$formConfig = [
    'email' => [
        'type' => 'text',
        'regex' => 'email',
        'label' => '*Email',
        'name' => 'email',
        'id' => 'email',
        'errorMsg' => 'You must enter a valid email address.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'password' => [
        'type' => 'password',
        'regex' => 'password',
        'label' => '*Password',
        'name' => 'password',
        'id' => 'password',
        'errorMsg' => 'You must enter your password.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'masterStatus' => [
        'error' => false
    ]
];

// Initialize StickyForm
$stickyForm = new StickyForm();
$acknowledgment = '';

function init(){
    global $formConfig, $stickyForm, $acknowledgment;

    // Pre-fill admin credentials
    $formConfig['email']['value'] = 'hsharris@admin.com';
    $formConfig['password']['value'] = 'password';

    $passwordError = $formConfig['password']['error'] ? '<span class="text-danger">' . $formConfig['password']['error'] . '</span><br>' : '';

    return <<<HTML
    {$acknowledgment}
    <div class="container mt-5">
        <h2>Login</h2>
        <form method="post" action="">
            <div class="row">
                <!-- Email -->
                <div class="col-md-12 mb-3">
                    {$stickyForm->renderInput($formConfig['email'], 'mb-3')}
                </div>
            </div>
            <div class="row">
                <!-- Password -->
                <div class="col-md-12 mb-3">
                    <label for="password">*Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="{$formConfig['password']['value']}">
                    {$passwordError}
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Login">
        </form>
    </div>
HTML;
}
?>
