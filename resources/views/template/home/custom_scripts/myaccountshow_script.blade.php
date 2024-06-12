<script>
        const tableData = document.getElementById('tableData');
        const dataRows = tableData.querySelectorAll('.data-row');
        const seeAllBtn = document.getElementById('seeAllBtn');

        if(dataRows.length <= 10){
            seeAllBtn.style.display = 'none';
        }

        // Initially show only the first 2 rows
        for (let i = 10; i < dataRows.length; i++) {
            dataRows[i].style.display = 'none';
        }

        seeAllBtn.addEventListener('click', function() {
            // Toggle visibility of all rows on button click
            dataRows.forEach(row => {
                row.style.display = ''; // Always set display to empty string (visible)
            });
            seeAllBtn.style.display = 'none';
            // Change button text based on visibility state
            // seeAllBtn.textContent = seeAllBtn.textContent === 'See All' ? 'Hide' : 'See All';
        });
    </script>