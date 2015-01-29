<div class="row clearfix">
    <div class="col-md-4 column">
    </div>
    <div class="col-md-4 column">
        <div class="page-header">
            <h1>Prijava</h1>
        </div>
        <?php if(isset($error_message)) : ?>
        <div class="alert alert-danger">
                <?php echo $error_message ?>
        </div>
        <?php endif ?>
        <form role="form" action="/prijava/provjeri" method="post">
            <div class="form-group">
                <label for="username">Korisničko ime</label><input type="text" class="form-control" id="username" name="username" content="<?php echo $username ?>" />
            </div>
            <div class="form-group">
                <label for="password">Lozinka</label><input type="password" class="form-control" id="password" name="password" />
            </div>
            <div class="form-group">
                <a href="/"><button type="button" class="btn btn-warning pull-left margin-bot-15">Početna</button></a>
                <button type="submit" class="btn btn-warning pull-right margin-bot-15">Prijava</button>
            </div>
        </form>
    </div>
    <div class="col-md-4 column">
    </div>
</div>
