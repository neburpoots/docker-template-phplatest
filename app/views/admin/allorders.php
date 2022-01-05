<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alle bestellingen</title>
  <link rel="stylesheet" type="text/css" href="styles/style.css">
  <link rel="icon" type="image/x-icon" href="https://res.cloudinary.com/dg5wrkfe7/image/upload/v1639140004/Screenshot_2021-12-10_133950_oiwt5v.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="vh-100">


  <?php
    include __DIR__ . '/../components/header.php';
  ?>
  <div class="row myaccount">
    <aside class="col-sm-5 col-md-4 col-lg-3 col-xl-3">
        <?
            include __DIR__ . '/../components/sidenav.php';
        ?>
    </aside>
    <div class="col-sm-7 col-md-8 col-xl-9">
  <main>


    <div class="mt-5 pt-5">
    <h1 class="mb-5 pt-5">Alle bestellingen</h1>
    <?php foreach ($model as $order) : ?>
        <div class="row mt-5">
            <h4>Bestellingnummer: <? echo $order->getId()?></h4>
            <h6>Bestellingsdatum: 
                <?  
                    $result = $order->getOrderDate()->format('Y-m-d H:i:s');
                    if ($result) {
                        echo $result;
                    } else { // format failed
                        echo "Unknown Time";} 
                ?>        
            </h6>
        </div>
            <?php foreach ($order->getOrder_Lines() as $order_line) : ?>
                <div class="row border-top border-bottom">
                        <div class="row main align-items-center">
                            <div class="col-12 col-sm-12 col-xl-4">
                                <img class="img-fluid" src="<? echo $order_line->getProduct()->getImg() ?>">
                            </div>
                            <div class="col-12 col-sm-12 col-xl-4">
                                <div class="row "><h4><? echo $order_line->getProduct()->getName(); ?></h4></div>
                            </div>
                            <div class="col-6 col-sm-6 col-xl-2">
                                <div class="row "><h4>Aantal: <? echo $order_line->getQuantity(); ?></h4></div>
                            </div>
                            <div class="col-6 col-sm-6 col-xl-2">
                                <h4>&euro; <? echo $order_line->getProduct()->getPrice() * $order_line->getQuantity() ?> </h4>
                            </div>
                        </div>
                    </div> 
            <?php endforeach; ?>
            <div class="row mt-1">
                <h4>Total: &euro; <? echo $order->getTotal() ?></h4>
            </div>
 
    <?php endforeach; ?>

  </main>
  
  <?
  include __DIR__ . '/../components/footer.php';
  ?>
  </div>
</div>
</body>

</html>