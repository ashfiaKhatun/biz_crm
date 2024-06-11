<script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            var input = document.getElementById('searchInput').value.toLowerCase();
            var rows = document.querySelectorAll('#refillTable tbody tr');

            rows.forEach(function(row) {
                var cells = row.querySelectorAll('td');
                var match = false;

                cells.forEach(function(cell) {
                    if (cell.innerText.toLowerCase().includes(input)) {
                        match = true;
                    }
                });

                if (match) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>