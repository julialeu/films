<div class="container">
    <h1 class="text-center">Films</h1>
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
            <ul id="film-list" class="list-group text-center">
                <?php if (!empty($films)): ?>
                    <?php foreach ($films as $film): ?>
                        <li class="list-group-item">
                            <!-- Título de la película -->
                            <span><?php echo htmlspecialchars($film['title'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <!-- Ícono de ojo para mostrar detalles -->
                            <span class="film-item" data-id="<?php echo htmlspecialchars($film['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                            </span>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="list-group-item">No se encontraron películas.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>