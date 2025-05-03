<?php
require_once 'controllers/addAdminProc.php';
function init(){
    global $formConfig, $stickyForm, $acknowledgment;

return<<<HTML
{$acknowledgment}
<div class="container mt-5">
    <h2>Add Administrator</h2>
    <p>Fields with * are required</p>
    <form method="post" action="">
        <div class="row">
            <!-- First Name -->
            <div class="col-md-6">
                {$stickyForm->renderInput($formConfig['first_name'], 'mb-3')}
            </div>
            <!-- Last Name -->
            <div class="col-md-6">
                {$stickyForm->renderInput($formConfig['last_name'], 'mb-3')}
            </div>
        </div>

        <div class="row">
            <!-- Email -->
            <div class="col-md-6">
                {$stickyForm->renderInput($formConfig['email'], 'mb-3')}
            </div>
            <!-- Password -->
            <div class="col-md-6">
                {$stickyForm->renderInput($formConfig['password'], 'mb-3')}
            </div>
        </div>

        <div class="row">
            <!-- Status -->
            <div class="col-md-6">
                {$stickyForm->renderSelect($formConfig['status'], 'mb-3')}
            </div>
        </div>

        <input type="submit" class="btn btn-primary" value="Add Admin">
    </form>
</div>
HTML;
}
?>