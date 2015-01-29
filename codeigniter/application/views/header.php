<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="utf-8">
    <meta name="viewport"   content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Knjižara</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/fileinput.min.css">
    <link href="/assets/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container content">
        <div class="row clearfix">
            <div class="col-md-12 column menu">
                <nav class="navbar navbar-default navbar-inverse" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/"><span class="glyphicon glyphicon-book"></span>&nbspKnjižara</a>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-left">
                            <?php if($user) : ?>
                                <li>
                                    <a href="/korisnik/mojprofil">Moj profil</a>
                                </li>
                                <li>
                                    <a href="/knjiga/pretraga">Pretraga</a>
                                </li>
                                <li>
                                    <a href="/korisnik/partneri">Popis klijenata-partnera</a>
                                </li>
                                <?php if($user->privilege === "admin") : ?>
                                    <li>
                                        <a href="/admin/prijavljeni">Popis prijavljenih klijenata</a>
                                    </li>
                                    <li>
                                        <a href="/statistika">Statistika</a>
                                    </li>
                                    <li>
                                        <a href="/knjiga/popis">Knjige</a>
                                    </li>
                                    <li>
                                        <a href="/knjiga/nova">Dodaj knjigu</a>
                                    </li>
                                <?php endif ?>
                            <?php endif ?>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                        <?php if(!$user) : ?>
                            <li>
                                <a href="/prijava">Prijava</a>
                            </li>
                        <?php  else : ?>
                            <li>
                                <p class="navbar-text">Prijavljeni ste kao <a href="/korisnik/mojprofil"><?php echo $user->username ?></a>,<a href="/prijava/odjava">Odjava</a></p>
                            </li>

                        <?php endif; ?>
                        </ul>
                    </div>

                </nav>
            </div>
        </div>