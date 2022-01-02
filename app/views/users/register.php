<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registreren</title>
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

                  <h1 class=" h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registreer</h1>
                  <form method="POST" name='registration' class="mx-1 mx-md-4">

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input required placeholder="Uw naam" type="text" name="name" value="<? echo $validation->getConceptName();?>" class="form-control" />
                      </div>
                    </div>

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

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input required placeholder="Herhaal je wachtwoord" type="password" name="passwordrepeat" class="form-control" />
                      </div>
                    </div>

                    <div class="d-flex pl-3 mx-4 mb-3 mb-lg-4">
                      <input type="submit" name="submit" value="Registreer" class="btn btn-primary btn-lg">
                    </div>

                  </form>
                  <div class="mx-1 mx-md-4">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                      $validation->processValidation($_POST["name"], $_POST["email"], $_POST["password"], $_POST["passwordrepeat"]);
                      if ($validation->getPassed()) {
                        $validation = new RegisterValidation();
                        echo '<div class="text-success">';
                        echo "Succesvol een account aangemaakt";
                        echo '</div>';
                      } else {
                        echo '<div class="text-danger">';
                        if(!empty($validation->getNameErr())) {
                          echo $validation->getNameErr();
                        } elseif(!empty($validation->getEmailErr())) {
                          echo $validation->getEmailErr();
                        } elseif(!empty($validation->getPasswordErr())) {
                          echo $validation->getPasswordErr();
                        } elseif(!empty($validation->getPasswordRepeatErr())) {
                          echo $validation->getPasswordRepeatErr();
                        }
                        echo '</div>';
                      }
                    }
                    ?>
                  </div>
                  <div class="mt-5 mx-1 mx-md-4">
                    <h5 class="h5">Heeft u al een account?</h4>
                      <a href="/login" type="button" class="btn btn-primary">Login</a>
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