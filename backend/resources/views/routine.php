<section class="contact-section">
<div id="head" style="margin-top: 5%;"><?=$routine->name?></div>
<div id="head" style="margin-top: 5%; font-size: 1rem;"><?=$routine->description?></div>
    <div class="card-container">
        <?php foreach($movements as $movement): ?>
            <div style="margin-left: 33.5%; width:100%; ">  
                <div class="card-md-4 mb-3 mb-md-0">
                    <a class="block" href="/workout/<?=$routine->id?>/<?=$movement->id?>">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="icon solid fa-running "></i>
                            <h4 class="text-uppercase m-0"><?=$movement->name?></h4>
                            <h4 class="text-uppercase m-0">X <?=$movement->times?></h4>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    </br>
</section>