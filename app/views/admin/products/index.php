<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producten overzicht</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="vh-100">


    <?php
    include __DIR__ . '/../../components/header.php';
    ?>
    <div class="row myaccount">
        <aside class="col-sm-4 col-md-3">
            <?
            include __DIR__ . '/../../components/sidenav.php';
            ?>
        </aside>
        <div class="col-sm-8 col-md-9">
            <main>


                <div class="mt-5 pt-5 row">
                    <div class="col-6 ">
                        <h1 class="">Producten</h1>
                    </div>
                    <div class="col-6 pt-1 ">
                        <a href="/createproduct" class="btn btn-primary">Nieuw Product</a>
                    </div>
                    <div id="products">
                    </div>
                </div>
                <script src="./scripts/productindex.js"></script>
            </main>

            <?
            include __DIR__ . '/../../components/footer.php';
            ?>
        </div>
    </div>
</body>

</html>