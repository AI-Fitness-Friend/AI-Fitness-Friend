<section class="contact-section">
    <div class="card-container">
        <div class="card-row">
        <?php foreach($routines as $routine): ?>
            <div class="card-md-4 mb-3 mb-md-0">
                <a class="block" href="workout/<?=$routine['id']?>">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
                        <i class="icon solid fa-running "></i>
                        <h4 class="text-uppercase m-0"><?=$routine['name']?></h4>
                        <hr class="my-4 "/>
                        <div>
                            <?php foreach($routine['movements'] as $movement): ?>
                                <?=$movement['name']?> X <?=$movement['times']?><br>
                            <?php endforeach; ?>
                            <br>
                        </div>
                        <div class="small text-black-50"><strong><?=$routine['description']?></strong></div>
                    </div>
                </div>
                </a>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    </br>
</section>
