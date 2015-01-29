<div class="row clearfix">
    <div class="col-md-2 column">
    </div>
    <div class="col-md-8 column">
        <div class="page-header">
            <h1>Popis prijavljenih klijenata</h1>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Korisnik</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Nadimak</th>
                <th>e-mail</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user) : ?>
                    <tr>
                        <td><li><a href="/korisnik/profil/<?php echo $user->username ?>"><?php echo $user->username ?></a></li></td>
                        <td><?php echo $user->name ?></td>
                        <td><?php echo $user->surname ?></td>
                        <td><?php echo $user->nickname ?></td>
                        <td><?php echo $user->email ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <div class="col-md-2 column">
        </div>
    </div>