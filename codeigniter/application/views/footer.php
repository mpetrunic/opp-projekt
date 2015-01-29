<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <p class="text-muted">
                    <img class="pull-left" id="logo" src="/assets/img/logo.png" width="50px" height="auto" />
                    <?php echo $bookstore->name ?><br>
                    Vlasnik: <?php echo $bookstore->company->name ?><br>
                    Matični broj: <?php echo $bookstore->company->identification_number ?><br>
                    Stranice knjižare izradila grupa O3p
                </p>
            </div>
        </div>
    </div>
</footer>
</div>
<script src="http://code.jquery.com/jquery.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/slick.min.js"></script>
<script src="/assets/js/star-rating.min.js" type="text/javascript"></script>
<script src="/assets/js/fileinput.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.book_slider').slick({
            accessibility: true,
            arrows: true,
            centerMode: true,
            centerPadding: '60px',
            slidesToShow: 4,
            slidesToScroll: 4,
            prevArrow: '<button type="button" data-role="none" class="slick-prev" style="display: block;"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></button>',
            nextArrow: '<button type="button" data-role="none" class="slick-next" style="display: block;"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></button>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $("#star-rating").rating({
            'stars':10,
            'min':0,
            'max':10,
            'step':1,
            'size':'xs',
            'showCaption': true,
            'starCaptions':{
                1: "Ocjena 1",
                2: "Ocjena 2",
                3: "Ocjena 3",
                4: "Ocjena 4",
                5: "Ocjena 5",
                6: "Ocjena 6",
                7: "Ocjena 7",
                8: "Ocjena 8",
                9: "Ocjena 9",
                10: "Ocjena 10"
            },
            'clearCaption': "Nema ocjene"
        });

        $(".file_upload").fileinput({'showUpload':false, 'previewFileType':'any', 'browseLabel':'Odaberi    ...'});
    });
</script>
</body>
</html>