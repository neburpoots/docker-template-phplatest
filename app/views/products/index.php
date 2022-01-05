<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producten</title>
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
            <h1 class="mb-5 pt-5">Onze videokaarten</h1>

            <div class="row">
                <?php foreach ($model as $product) : ?>
                    <div class="col-sm-12 col-md-6 col-lg-4 pb-5">
                        <div class="card h-100">
                            <img class="card-img-top" src="<? echo $product->getImg(); ?>" alt="Product afbeelding">
                            <div class="card-body">
                                <h5 class="card-title"><? echo $product->getName(); ?> </h5>
                                <p class="card-text"><? echo $product->getDescription(); ?> </p>
                                <h5 class="card-title"> € <? echo $product->getPrice(); ?></h5>
                            </div>
                            <div class="card-footer mt-auto">
                                <a href="shoppingcart/addtoCart?id=<?echo $product->getId()?>" class="btn btn-primary">Voeg to aan winkelwagen</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </main>
    <?
    include __DIR__ . '/../components/footer.php';
    ?>
</body>

</html>