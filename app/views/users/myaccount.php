<?php
    $user = unserialize($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mijn account</title>
  <link rel="stylesheet" type="text/css" href="styles/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="vh-100">


  <?php
    include __DIR__ . '/../components/header.php';
  ?>
  <div class="row myaccount">
    <aside class="col-sm-4 col-md-3">
        <?
            include __DIR__ . '/../components/sidenav.php';
        ?>
    </aside>
    <div class="col-sm-8 col-md-9">
  <main>


    <div class="mt-5 pt-5">
    <h1 class="mb-5 pt-5">Welkom <? echo $user->getName();?>!</h1>
    <section>
        <table class="table">
            <tr>
                <td><h5>Uw naam: </h5></td>
                <td><h5><? echo $user->getName();?></h5></td>
            </tr>
            <tr>
                <td><h5>Uw E-mail: </h5></td>
                <td><h5><? echo $user->getEmail();?></h5></td>
            </tr>
        </table>
    </section>

    </div>
  </main>
  
  <?
  include __DIR__ . '/../components/footer.php';
  ?>
  </div>
</div>
</body>

</html>