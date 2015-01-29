<div class="row clearfix">
    <div class="col-md-2 column">
    </div>
    <div class="col-md-8 column">
        <div class="page-header">
            <h1>Popis klijenata-partnera</h1>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Korisnik</th>
                <th>Naslov knjige</th>
                <th>Vrsta trgovine</th>
                <th>Datum i vrijeme</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($user->purchases as $purchase) : ?>
                    <?php if($purchase->seller->id != null) : ?>
                        <tr>
                            <td><li><a href="/korisnik/profil/<?php echo $purchase->seller->username ?>"><?php echo $purchase->seller->username ?></a></li></td>
                            <td><a href="/knjiga/prikaz/<?php echo $purchase->book->id ?>"><?php echo $purchase->book->deed->title ?></a></td>
                            <td>Kupovina</td>
                            <td><?php echo $purchase->created_on ?></td>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
                <?php foreach($user->sells as $sell) : ?>
                    <tr>
                        <td><li><a href="/korisnik/profil/<?php echo $sell->buyer->username ?>"><?php echo $sell->buyer->username ?></a></li></td>
                        <td><a href="/knjiga/prikaz/<?php echo $sell->book->id ?>"><?php echo $sell->book->deed->title ?></a></td>
                        <td>Prodaja</td>
                        <td><?php echo $sell->created_on ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <div class="col-md-2 column">
    </div>
</div>