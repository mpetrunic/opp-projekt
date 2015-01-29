<div class="page-header">
    <h2>Popis knjiga</h2>
</div>
<?php if($success_message) : ?>
    <div class="alert alert-success">
        <?php echo $success_message ?>
    </div>
<?php endif ?>
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

                    <a href="/knjiga/ukloni/<?php echo $book->id ?>" class="btn btn-danger pull-right">Ukloni</a>
                </div>
                <span class="clearfix borda"></span>
            </article>
        <?php endforeach ?>
    </section>
</div>