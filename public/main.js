function datatable(table, url, columns= [], columnDefs = [], responsive = true) {
    $(table).DataTable({
        ordering: true,
        serverSide: true,
        processing: true,
        autoWidth: responsive ? false : true,
        responsive: responsive,
        oLanguage: {sProcessing: loadingSpiner},
        ajax: {
            'url': url,
        },
        drawCallback: function (settings) {
            // bootrap 3 or 4
            $('[data-toggle="tooltip"]').tooltip();
            // bootstrap 5
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        },
        columns: columns,
        columnDefs: columnDefs,
    });
}
