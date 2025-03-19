<div class="container">
    <h1 class="text-center">Films</h1>
    <p class="text-center text-muted">Not quite Rotten Tomatoes, but we try! 🍅</p>
    
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
            <ul id="film-list" class="list-group text-center">
                <?php if (!empty($films)): ?>
                    <?php foreach ($films as $film): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><?php echo htmlspecialchars($film['title'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <span class="film-item" 
                                  data-id="<?php echo htmlspecialchars($film['id'], ENT_QUOTES, 'UTF-8'); ?>"
                                  aria-label="More info about <?php echo htmlspecialchars($film['title'], ENT_QUOTES, 'UTF-8'); ?>"
                                  style="cursor: pointer; margin-left: 10px;">
                                <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                            </span>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="list-group-item text-center">Films not found.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>