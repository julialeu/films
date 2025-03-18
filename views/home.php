<div class="container">
    <h1>Films</h1>
    <div class="row">
        <!-- Columna con la lista de películas -->
        <div class="col-md-4">
            <ul id="film-list" class="list-group">
                <?php foreach ($films as $film): ?>
                    <li 
                        class="list-group-item film-item" 
                        data-id="<?php echo $film['id']; ?>"
                        style="cursor:pointer;"
                    >
                        <?php echo htmlspecialchars($film['title'], ENT_QUOTES, 'UTF-8'); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- Columna donde se mostrarán los detalles -->
        <div class="col-md-8">
            <div id="film-details">
                <!-- Aquí se inyectarán los detalles via AJAX -->
            </div>
        </div>
    </div>
</div>