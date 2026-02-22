<script type="text/javascript">
    let formChanged = false;

    document.querySelector('form').addEventListener('input', () => {
    formChanged = true;
    });

    window.addEventListener('beforeunload', (e) => {
    if (formChanged) {
        e.preventDefault();
        e.returnValue = '';
    }
    });

    document.querySelector('form').addEventListener('submit', () => {
    formChanged = false;
    });
</script>