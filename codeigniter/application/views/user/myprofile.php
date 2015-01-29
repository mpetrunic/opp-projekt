<div class="row clearfix">
    <?php if($success_message) : ?>
        <div class="alert alert-success">
            <?php echo $success_message ?>
        </div>
    <?php endif ?>
    <div class="page-header">
        <h1>Moj profil</h1>
    </div>

    <div class="col-md-2 column">
        <div class="thumbnail">
            <img id="slika" class="img-thumbnail" src="/assets/img/unknown.gif"  />
            <div class="caption">
                <h3><?php echo $user->username ?> [<?php echo $user->id ?>]</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 column">
        <h4><b>Ime:</b> <?php echo $user->name ?></h4>
        <h4><b>Prezime:</b> <?php echo $user->surname ?></h4>
        <h4><b>Nadimak:</b> <?php echo $user->nickname ?></h4>
        <h4><b>E-mail:</b> <?php echo $user->email ?></h4>
        <h4><b>Rang: </b> <?php echo $user->rank ?></h4>
        <h4><b>Ukupan broj kupljenih knjiga:</b> <?php echo $user->total_bought_books ?></h4>
        <h4><b>Broj knjiga kupljenih od knjizare:</b> <?php echo $user->number_of_bookstore_books ?></h4>
        <h4><b>Broj knjiga kupljenih od drugih korisnika:</b> <?php echo $user->number_of_user_books ?></h4>
        <h4><b>Ukupna cijena kupljenih knjiga:</b> <?php echo number_format($user->total_bought_books_price, 2, ",", ".") ?> kn</h4>
        <h4><b>Broj klijenata-partnera:</b> <?php echo $user->number_clients_and_partners ?></h4>
    </div>
</div>
<div class="row clearfix">
    <div class="col-md-12 column">
        <div class="panel panel-default">
            <div class="panel-heading">Popis kupljenih knjiga</div>
            <div class="panel-body">
                <p>
                    Ovdje je dostupan popis svih knjiga koje ste kupili.
                </p>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>Br.</th>
                    <th>Naslov</th>
                    <th>Nabavna Cijena</th>
                    <th>Datum i Vrijeme Kupnje</th>
                    <th>Prodavač</th>
                    <th>Knjiga</th>
                    <th>Certifikat</th>
                </tr>
                </thead>
                <tbody>
                <?php if(count($user->purchases->all) == 0) { ?>
                    <tr><td colspan="7" ><p class="text-center">Trenutno nemate niti jednu kupljenu knjigu!</p></td></tr>
                <?php } else { ?>
                    <?php $i = 0 ?>
                    <?php foreach($user->purchases->all as $purchase) : ?>
                        <?php $i++; ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><a href="/knjiga/prikaz/<?php echo $purchase->book->id ?>"><?php echo $purchase->book->deed->title ?></a></td>
                            <td><?php echo number_format($purchase->purchase_price, 2, ",", ".") ?></td>
                            <td><?php echo $purchase->created_on ?></td>
                            <?php if($purchase->seller->id == null) { ?>
                                <td>Knjižara</td>
                            <?php } else { ?>
                                <td><?php echo $purchase->seller->name ?> <?php echo $purchase->seller->surname ?></td>
                            <?php } ?>
                            <td><a target="_blank" href="/knjiga/preuzimanje/<?php echo $purchase->book->id ?>"><button class="btn btn-default">Preuzmi</button></a></td>
                            <td><a target="_blank" href="/knjiga/certifikat/<?php echo $purchase->book->id ?>"><button class="btn btn-default">Preuzmi</button></a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
