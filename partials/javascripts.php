<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<!-- jquery  -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<!-- datatables  -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable(); // table id example for datatable 
    });
</script>
<script>
        // Automatically hide the alert after 5 seconds
        setTimeout(function () {
            document.getElementById('alertMessage').style.display = 'none';
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>
</body>

</html>