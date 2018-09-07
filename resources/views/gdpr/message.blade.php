<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Member agreement</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Member agreement</h5>
                        <h6 class="card-subtitle mb-2 text-muted">GDPR adjustment</h6>
                        <p class="card-text">Lorem ipsum dolor sit amet, pro in cetero audire persius, et nam viderer
                            placerat explicari, atqui nusquam ea vel. Hinc denique ea has. No his exerci eloquentiam
                            vituperatoribus,
                            iriure petentium expetenda in pri. Et quod debet fabellas per, mel timeam antiopam
                            vituperatoribus ad. Possim minimum eu nam.
                            Ne duo simul putent. Ullum periculis vituperata cu sit. Ex vel cibo semper accusam, eum
                            dolorum percipit et. Ridens tacimates ullamcorper ut usu, movet quaerendum persequeris ad
                            mel.
                            Officiis lobortis salutatus ei vis, ad denique qualisque sententiae mel. Justo graece sea
                            ei, vero modus propriae ea mei.</p>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group float-left">
                                    <form class="form-inline" role="form" method="POST"
                                          action="{{ route('gdpr-terms-accepted') }}">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary">Accept</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group float-right">
                                    <form class="form-inline float-left" role="form" method="POST"
                                          action="{{ route('gdpr-terms-denied') }}">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-outline-danger">Deny</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>