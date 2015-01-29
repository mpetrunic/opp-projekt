<div class="row clearfix">
    <div class="page-header">
        <h1>Korisnički profil</h1>
    </div>

    <div class="col-md-2 column">
        <div class="thumbnail">
            <img id="slika" class="img-thumbnail" src="/assets/img/unknown.gif" width="170px" height="auto" />
            <div class="caption">
                <h3><?php echo $user->username ?> [<?php echo $user->id ?>]</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 column">
        <h4><b>E-mail:</b> <?php echo $user->email ?></h4>
        <h4><b>Rang: </b> <?php echo $user->rank ?></h4>
        <h4><b>Ukupan broj kupljenih knjiga:</b> <?php echo $user->total_bought_books ?></h4>
        <h4><b>Broj knjiga kupljenih od knjizare:</b> <?php echo $user->number_of_bookstore_books ?></h4>
        <h4><b>Broj knjiga kupljenih od drugih korisnika:</b> <?php echo $user->number_of_user_books ?></h4>
        <h4><b>Ukupna cijena kupljenih knjiga:</b> <?php echo number_format($user->total_bought_books_price, 2, ",", ".") ?> kn</h4>
        <h4><b>Broj klijenata-partnera:</b> <?php echo $user->number_clients_and_partners ?></h4>
    </div>
</div>
