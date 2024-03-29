<?php

require_once "head.php";

    $content  = "

<div class='container'>

    <div class='card o-hidden border-0 shadow-lg my-5'>
      <div class='card-body p-0'>
        <!-- Nested Row within Card Body -->
        <div class='row'>
          <div class='col-lg-5 d-none d-lg-block bg-register-image'></div>
          <div class='col-lg-7'>
            <div class='p-5'>
              <div class='text-center'>
                <h1 class='h4 text-gray-900 mb-4'>Creer un compte</h1>
              </div>
              <form class='user' method='post' action='?cl=EmploierControlleur&mt=addaction'>
                <div class='form-group row'>
                  <div class='col-sm-6 mb-3 mb-sm-0'>
                    <input type='text' class='form-control form-control-user' id='exampleFirstName' name='data[firstname]' placeholder='First Name' required>
                  </div>
                  <div class='col-sm-6'>
                    <input type='text' class='form-control form-control-user' id='exampleLastName' name='data[lastname]'  placeholder='Last Name' required>
                  </div>
                </div>
                <div class='form-group'>
                  <input type='email' class='form-control form-control-user' id='exampleInputEmail' name='data[email]'  placeholder='Email Address' required>
                </div>
                <div class='form-group row'>
                  <div class='col-sm-6 mb-3 mb-sm-0'>
                    <input type='password' class='form-control form-control-user' id='exampleInputPassword' name='data[pwd]'  placeholder='Password' required>
                  </div>
                  <div class='col-sm-6'>
                    <input type='password' class='form-control form-control-user' id='exampleRepeatPassword' name='data[pwd_cnf]'  placeholder='Repeat Password' required   >
                  </div>
                </div>
                <button href='#'type='submit' class='btn btn-primary btn-user btn-block'>
S'inscrir
                </button>
                <hr>
                <a href='#' class='btn btn-google btn-user btn-block'>
                  <i class='fab fa-google fa-fw'></i> Register with Google
                </a>
                <a href='#' class='btn btn-facebook btn-user btn-block'>
                  <i class='fab fa-facebook-f fa-fw'></i> Register with Facebook
                </a>
              </form>
              <hr>
              <div class='text-center'>
                <a class='small' href='?forgetpwd'>Mot de passe oublier?</a>
              </div>
              <div class='text-center'>
                <a class='small' href='?login'>Déja un indcrit? Connexion!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>";

    echo $content;
    require_once "footer.php";


