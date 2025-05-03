<!-- Bootstrap core JavaScript-->
<script src="{{asset('Admin/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('Admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('Admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('Admin/js/sb-admin-2.min.js')}}"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        // PAGINATION
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            expeditions(page);
        });

        function expeditions(page) {
            $.ajax({
                url: "pagination/pagination-data?page=" + page,
                success: function(res) {
                    $('.table-data').html(res);
                },
            });
        }

        // SEARCHHH
        $(document).on('keyup', '#search', function(e) {
            e.preventDefault();
            fetchExpeditions();
        });

     // Utilisation de la délégation d'événements pour le menu déroulant de statut
    $(document).on('click', '#bulkUpdateStatusDropdown .dropdown-item', function(e) {
        e.preventDefault();
        var selectedStatus = $(this).data('status');
        var selectedExpeditionIds = [];

        console.log('Statut sélectionné:', selectedStatus);

        $('tbody input[type="checkbox"]:checked.row-checkbox').each(function() {
            selectedExpeditionIds.push($(this).val());
        });

        console.log('IDs sélectionnés:', selectedExpeditionIds);

        if (selectedExpeditionIds.length > 0 && selectedStatus) {
            if (confirm('Êtes-vous sûr de vouloir marquer les expéditions sélectionnées comme "' + selectedStatus + '" ?')) {
                $.ajax({
                    url: "{{ route('admin.bulk_update_status') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        status: selectedStatus,
                        expedition_ids: selectedExpeditionIds
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            fetchExpeditions(); // Assurez-vous que cette fonction recharge correctement votre tableau filtré
                        } else {
                            alert('Erreur lors de la mise à jour des statuts.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Une erreur s\'est produite lors de la requête.');
                    }
                });
            }
        } else if (selectedExpeditionIds.length === 0) {
            alert('Veuillez sélectionner au moins une expédition.');
        } else if (!selectedStatus) {
            alert('Veuillez sélectionner un statut dans le menu "ACTIONS".');
        }
    });

        // Logique pour la checkbox "Tout sélectionner"
        $(document).on('change', '#selectAll', function() {
            var isChecked = $(this).prop('checked');
            $('tbody input[type="checkbox"].row-checkbox').prop('checked', isChecked);
        });

        // Logique pour les checkboxes individuelles
        $(document).on('change', 'tbody input[type="checkbox"].row-checkbox', function() {
            var allChecked = $('tbody input[type="checkbox"].row-checkbox:checked').length === $('tbody input[type="checkbox"].row-checkbox').length;
            $('#selectAll').prop('checked', allChecked);
        });

        let selectedStatuses = [];

        // Fonction pour mettre à jour les statuts sélectionnés pour le filtrage
        function updateSelectedStatuses() {
            selectedStatuses = $('.status-filter:checked').map(function() {
                return this.value;
            }).get();
        }

        // Écoute l'événement de changement sur les checkboxes de statut pour le filtrage
        $(document).on('change', '.status-filter', updateSelectedStatuses);

        // Écoute le clic sur le bouton "Appliquer les filtres"
        $(document).on('click', '#applyStatusFilters', function(e) {
            e.preventDefault();
            fetchExpeditions();
        });



        function fetchExpeditions() {
            let search_string = $('#search').val();
            let status_filter = selectedStatuses;
            let conteneur_filter = $('#conteneurs').val();
            let localite_filter = $('#localite').val();
            let year_filter = $('#yearFilter').val(); // Récupérer l'année sélectionnée

            $.ajax({
                type: 'GET',
                url: "{{ route('admin.search') }}",
                data: {
                    search_string: search_string,
                    status: status_filter,
                    conteneurs: conteneur_filter,
                    localite: localite_filter,
                    year: year_filter, // Envoyer l'année au contrôleur
                },
                success: function(res) {
                    $('.table-data').html(res);

                    if (res.status == 'Inexistant') {
                        $('.table-data').html('<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>Aucun résultat trouvé</div></div>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Erreur lors de la récupération des expéditions:", error);
                    // Gérer l'erreur ici si nécessaire
                }
            });
        }

        $(document).on('change', '#yearFilter', function() {
            
            fetchExpeditions();
        });

        $(document).on('change', '#conteneurs, #localite', function() {
            fetchExpeditions();
        });

        $(document).on('click', '#filterButton', function() {
            fetchExpeditions();
        });
    });

    // SCRIPT LIFTR EXPORTATION
    document.addEventListener('DOMContentLoaded', function() {
    const yearFilter = document.getElementById('yearFilter');
    const exportExcelBtn = document.getElementById('exportExcelBtn');

    exportExcelBtn.addEventListener('click', function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien

        const selectedYear = yearFilter.value;

        if (selectedYear && selectedYear !== " ") {
            const exportUrl = "{{ route('export.expeditions', ['annee' => ':year']) }}".replace(':year', selectedYear);
            window.location.href = exportUrl;
        } else {
            alert('Veuillez sélectionner une année avant d\'exporter.');
        }
    });
});
</script>
</script>
<!-- Page level plugins -->
<script src="{{asset('Admin/vendor/chart.js/Chart.min.js')}}"></script>
<script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
<!-- Page level custom scripts -->
<script src="{{asset('Admin/js/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('Admin/js/demo/chart-pie-demo.js')}}"></script>

<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>