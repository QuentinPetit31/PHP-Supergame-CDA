<?php
// Gère l'affichage du dfooter
class ViewFooter {
    
    // Affiche le footer HTML
    public function displayView() {
        ob_start();
?>
            </main>
            <footer>
                <h1>footer</h1>
            </footer>
        </body>
        </html>
<?php
        return ob_get_clean();
    }

}
