<div class="row clearfix">
    <div class="page-header">
        <h1>Pretraga</h1>
    </div>
    <?php if(isset($error_message)) : ?>
        <div class="alert alert-danger">
            <?php echo $error_message ?>
        </div>
    <?php endif ?>
    <div class="row">
        <form method="post" action="/knjiga/pretrazi">
            <div class="col-sm-1">

            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <div class="col-xs-5" >
                        <label class="filter-col" for="pref-orderby">Pretraži po:</label>
                    </div>
                    <div class="col-xs-7">
                        <select id="pref-orderby" name="search_field" class="form-control">
                            <option value="naslov">Naslovu</option>
                            <option value="autor">Autoru</option>
                            <option value="zanr">Žanru</option>
                            <option value="godina">Godini</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="input-group">
                    <div class="input-group-btn search-panel">
                    </div>
                    <input type="text" class="form-control" name="search_param" placeholder="Pojam pretraživanja...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
            </span>
                </div>
            </div>
        </form>
    </div>
    <div class="page-header">
        <h2>Rezultat pretrage</h2>
    </div>
    <div class="row">
        <section class="col-xs-12 col-sm-6 col-md-12">
            <?php foreach($books as $book) : ?>
                <article class="search-result row">
                    <div class="col-xs-12 col-sm-12 col-md-3">
                        <a href="/knjiga/prikaz/<?php echo $book->id ?>" title="<?php echo $book->deed->title ?>" class="thumbnail">
                            <img height="180" width="120" src="/assets/img/cover/<?php echo $book->cover ?>" alt="<?php echo $book->deed->title ?>" />
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-7 excerpet">
                        <h3><a href="/knjiga/prikaz/<?php echo $book->id ?>" title=""><?php echo $book->deed->title ?></a></h3>
                        <p><i class="glyphicon glyphicon-user"></i> <span><?php echo $book->deed->author->name ?> <?php echo $book->deed->author->surname ?></span></p>
                        <p><?php echo $book->deed->content ?></p>

                        <a href="/knjiga/prikaz/<?php echo $book->id ?>" class="btn btn-warning pull-right">Detalji</a>
                    </div>
                    <span class="clearfix borda"></span>
                </article>
            <?php endforeach ?>
        </section>
    </div>
</div>