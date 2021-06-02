<section>
    <ul class="divided">
        <?php foreach($records as $record): ?>
            <li>
                <article class="post stub">
                    <header>
                        <h3><?=$record->movement_name?> x <?=$record->times?></h3>
                    </header>
                    <span class="timestamp"><?=$record->exercised_at?></span>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>
</section>