// Attend que le contenu du DOM soit entièrement chargé avant d'exécuter le script
document.addEventListener('DOMContentLoaded', function () {

    // --- GESTION DE LA NAVIGATION ---

    const liensNav = document.querySelectorAll('.navigation a');
    const pages = document.querySelectorAll('.page');
    const titrePrincipal = document.querySelector('.en-tete h1');

    // Ajoute un écouteur d'événement sur chaque lien de navigation
    liensNav.forEach(lien => {
        lien.addEventListener('click', function (e) {
            e.preventDefault(); // Empêche le comportement par défaut du lien

            // Récupère l'ID de la section cible depuis l'attribut href
            const cibleId = this.getAttribute('href').substring(1);
            const pageCible = document.getElementById(cibleId);

            // Masque toutes les pages
            pages.forEach(page => {
                page.classList.remove('active');
            });

            // Affiche la page cible
            if (pageCible) {
                pageCible.classList.add('active');
            }

            // Met à jour le titre principal de la page
            titrePrincipal.textContent = this.textContent;

            // Gère la classe 'actif' pour le style du lien de navigation
            document.querySelectorAll('.navigation li').forEach(li => li.classList.remove('actif'));
            this.parentElement.classList.add('actif');
        });
    });

    // --- INITIALISATION DU GRAPHIQUE (Chart.js) ---

    const ctx = document.getElementById('graphiqueReservations').getContext('2d');
    if(ctx) {
        const graphiqueReservations = new Chart(ctx, {
            type: 'bar', // Type de graphique
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Réservations',
                    data: [120, 190, 300, 500, 230, 310, 420, 350, 480, 450, 490, 510], // Données exemples
                    backgroundColor: 'rgba(74, 144, 226, 0.5)',
                    borderColor: 'rgba(74, 144, 226, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false // Cache la légende du dataset
                    }
                }
            }
        });
    }

});

