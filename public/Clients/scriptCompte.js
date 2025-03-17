document.addEventListener('DOMContentLoaded', function() {
    // Gestion des onglets
    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Retirer la classe 'active' de tous les onglets
            tabs.forEach(t => t.classList.remove('active'));
            // Ajouter la classe 'active' à l'onglet cliqué
            this.classList.add('active');
            // Afficher/masquer les commandes en fonction de l'onglet
            const tabId = this.getAttribute('data-tab');
            const orders = document.querySelectorAll('.order');
            orders.forEach(order => {
                if (order.getAttribute('data-tab') === tabId) {
                    order.style.display = 'flex';
                } else {
                    order.style.display = 'none';
                }
            });
        });
    });

    // Gestion des détails de la commande
    const detailsLinks = document.querySelectorAll('.details-link');
    detailsLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const orderId = this.getAttribute('data-order-id');
            const detailsDiv = document.getElementById(`details-${orderId}`);
            if (detailsDiv.style.display === 'none') {
                // Simuler des détails de commande (vous pouvez remplacer cela par une requête AJAX)
                detailsDiv.innerHTML = `<p>Détails de la commande ${orderId} : ...</p>`;
                detailsDiv.style.display = 'block';
            } else {
                detailsDiv.style.display = 'none';
            }
        });
    });
});