<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pas product aan</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="stylesheet" type="text/css" href="/../../styles/sidebar.css">
    <link rel="stylesheet" type="text/css" href="/../../styles/navigation.css">
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
                <div class="mt-5 pt-5 row d-flex r h-100">
                    <div class="col-lg-12 col-xl-11">
                        <div class="card text-black" style="border-radius: 25px;">
                            <div class="card-body p-md-5">
                                <div class="row ">
                                    <div class="col-md-10 col-lg-6 col-xl-6 order-2 order-lg-1">
                                        <h1 class=" h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Wijzig product</h1>
                                        <form id="form" method="POST" name='myform' class="mx-1 mx-md-4">
                                            <label class="mb-4">Productnummer: <span id="id"></label>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="form-outline flex-fill mb-0">
                                                    <input required placeholder="Naam" type="text" name="name" value="" class="form-control" />
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="form-outline flex-fill mb-0">
                                                    <input required placeholder="Prijs" type="text" name="price" value="" class="form-control" />
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="form-outline flex-fill mb-0">
                                                    <input required placeholder="Voorraad" type="text" name="stock" class="form-control" />
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="form-outline flex-fill mb-0">
                                                    <textarea required placeholder="Beschrijving" rows="4" cols="50" name="description" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="d-flex  mb-3 mb-lg-4">
                                                <a onclick="validateform()" class="btn btn-primary btn-lg">Wijzig product</a>
                                            </div>

                                        </form>

                                    </div>
                                    <div class="row col-md-10 col-lg-6 col-xl-6 d-flex align-items-center order-1 order-lg-2">
                                        <div class="col-12" id="imagepreview">
                                        <div id="imgcontainer">

                                        </div>
                                        </div>
                                        <button id="upload_widget" class="col-12 btn btn-primary">Klik hier om een afbeelding toe te voegen</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <script src="/../../scripts/productedit.js"></script>

            <script src="https://upload-widget.cloudinary.com/global/all.js" type="text/javascript"></script>

            <script type="text/javascript">
                var myWidget = cloudinary.createUploadWidget({
                    cloudName: 'dg5wrkfe7',
                    uploadPreset: 'ml_default'
                }, (error, result) => {
                    if (!error && result && result.event === "success") {
                        console.log('Done! Here is the image info: ', result.info);
                        var img = result.info.url;
                        console.log(img);
                        showPreviewImage(img);
                    }
                })

                document.getElementById("upload_widget").addEventListener("click", function() {
                    myWidget.open();
                }, false);
            </script>
            <?
            include __DIR__ . '/../../components/footer.php';
            ?>
        </div>
    </div>
</body>

</html>