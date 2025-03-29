<?php
// Gère l'affichage du header
class ViewHeader {

    // Affiche le header HTML
    public function displayView() {
        ob_start();
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Supergame</title>
        </head>
        <body>
            <header>
                <h1>header</h1>
                <nav></nav>
            </header>
            <main>
<?php
        return ob_get_clean();
    }

}
