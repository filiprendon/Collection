<?php
require_once ('./db.php');

if (isset($_GET['id'])) {
    $pokemon_id = $_GET['id'];
} else {
    header('Location: ./pokemons.php');
    exit();
}

$pokemon = getPokemonById($pokemon_id);
$tipos = selectTipo();
$regiones = selectRegion();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <style>
        .centered-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 90vh;
        }
    </style>
</head>

<body>

    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link" href="pokemons.php">Ver Colección</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="add_card.php">Añadir Carta</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="edit_card.php">Modificar Carta</a>
        </li> -->
    </ul>

    <div class="centered-container">
        <h1 class="mb-4">Editar Pokémon</h1>
        <form action="controller.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $pokemon_id; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del Pokémon"
                    value="<?php echo $pokemon['nombre']; ?>">
            </div>

            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select name="tipo[]" class="form-select" id="tipo" multiple>
                    <?php foreach ($tipos as $tipo) { ?>
                        <option value="<?php echo $tipo['id']; ?>">
                            <?php echo $tipo['nombre']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>



            <div class="mb-3">
                <label for="region_id" class="form-label">Región</label>
                <select name="region_id" class="form-select" id="region_id">
                    <?php foreach ($regiones as $region) { ?>
                        <option value="<?php echo $region['id']; ?>" <?php if ($region['id'] == $pokemon['region_id'])
                               echo 'selected'; ?>>
                            <?php echo $region['nombre']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <div class="form-floating">
                    <textarea class="form-control" name="descripcion" placeholder="Describe al Pokémon"
                        id="descripcion"><?php echo $pokemon['descripcion']; ?></textarea>
                </div>
            </div>

            <div class="mb-3">
                <label for="imagen_url" class="form-label">Foto del Pokémon</label>
                <div class="input-group">
                    <input type="file" class="form-control" name="imagen_url" id="imagen_url">
                    <label class="input-group-text" for="imagen_url">Subir foto</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" name="update">Guardar cambios</button>
            <a href="pokemons.php" class="btn btn-secondary">Cancelar</a>
        </form>

    </div>
</body>

</html>