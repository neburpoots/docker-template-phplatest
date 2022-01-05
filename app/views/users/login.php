<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="icon" type="image/x-icon" href="https://res.cloudinary.com/dg5wrkfe7/image/upload/v1639140004/Screenshot_2021-12-10_133950_oiwt5v.png">
  <link rel="stylesheet" type="text/css" href="styles/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

  <?
  include __DIR__ . '/../components/header.php';
  ?>
  <main>
    <div class="container mt-5 pt-5">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                  <h1 class=" h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login</h1>
                  <form method="POST" name='login' class="mx-1 mx-md-4">

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input required placeholder="Uw E-mail" type="email" name="email" class="form-control" />
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input required placeholder="Wachtwoord" type="password" name="password" class="form-control" />
                      </div>
                    </div>

                    <div class="d-flex pl-3 mx-4 mb-3 mb-lg-4">
                      <input type="submit" name="submit" value="Login" class="btn btn-primary btn-lg">
                    </div>

                  </form>
                  <div class="mx-1 mx-md-4">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                      $validation->processValidation($_POST["email"], $_POST["password"]);
                      if ($validation->getPassed()) {
                        $validation = new LoginValidation();
                        echo '<div class="text-success">';
                        echo '<script> location.reload(); </script>';
                        echo "Ingelogd";
                        echo '</div>';
                      } else {
                        echo '<div class="text-danger">';
                        if(!empty($validation->getEmailErr())) {
                          echo $validation->getEmailErr();
                        } elseif(!empty($validation->getPasswordErr())) {
                          echo $validation->getPasswordErr();
                        }
                        echo '</div>';
                      }
                    }
                    ?>
                  </div>
                  <div class="mt-5 mx-1 mx-md-4">
                    <h5 class="h5">Heeft u nog geen account?</h4>
                      <a href="/register" class="btn btn-primary">Registreer</a>
                  </div>
                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp" class="img-fluid" alt="Sample image">

                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>


  </main>
  <?
  include __DIR__ . '/../components/footer.php';
  ?>
  
  <script>
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
  </script>
</body>

</html>