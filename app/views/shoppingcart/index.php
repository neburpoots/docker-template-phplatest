<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkelwagen</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="icon" type="image/x-icon" href="https://res.cloudinary.com/dg5wrkfe7/image/upload/v1639140004/Screenshot_2021-12-10_133950_oiwt5v.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <?
    include __DIR__ . '/../components/header.php';
    ?>
    <main>
        <div class="container mt-5 pt-5">
            <h1 class="mb-5 pt-5">Winkelwagen</h1>

            <div class="row">
                <?php
                $shoppingCart = unserialize($_SESSION["shoppingcart"]);
                ?>
                <?php foreach ($shoppingCart->getCartProducts() as $cartProduct) : ?>
                    <div class="row border-top border-bottom">
                        <div class="row main align-items-center">
                            <div class="col-12 col-sm-12 col-xl-4"><img class="img-fluid" src="<? echo $cartProduct->getProduct()->getImg() ?>"></div>
                            <div class="col-12 col-sm-12 col-xl-4">
                                <div class="row "><h4><? echo $cartProduct->getProduct()->getName(); ?></h4></div>
                                <div class="row text-muted"><h6><? echo $cartProduct->getProduct()->getDescription(); ?></h6></div>

                            </div>
                            <div class="col-4 col-sm-4 col-xl-1"> 
                                <div class="row">
                                    <a href="/shoppingcart/decreaseamount?id=<? echo $cartProduct->getProduct()->getId() ?>">-</a>
                                    <a href="#" class=""><? echo $cartProduct->getAmount() ?></a>
                                    <a href="/shoppingcart/increaseamount?id=<? echo $cartProduct->getProduct()->getId() ?>">+</a> 
                                </div>
                            </div>
                            <div class="col-4 col-sm-4 col-xl-2">
                                <h4>&euro; <? echo $cartProduct->getProduct()->getPrice() * $cartProduct->getAmount() ?> </h4>
                            </div>
                            <div class="col-4 col-sm-4 col-xl-1">
                                <h2>
                                    <a href="/shoppingcart/removeItem?id=<? echo $cartProduct->getProduct()->getId() ?>">
                                        <span class="close">&#10005;</span>
                                    </a>
                                <h2>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="row">
                <h1 class="mt-5 mb-5">Total: &euro; <? echo $shoppingCart->getTotal(); ?></h1>
                <?php if(count($shoppingCart->getCartProducts()) > 0) : ?>
                    <a href="/shoppingcart/orderItems" class="btn btn-primary">Reken af</a>
                <?php else : ?>
                    <p class="btn btn-secondary">Reken af</p>
                <?php endif; ?>
            </div>
        </div>

    </main>
    <?
    include __DIR__ . '/../components/footer.php';
    ?>
</body>

</html>