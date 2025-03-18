<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Copy URL functionality
function copyUrl() {
    const url = document.getElementById('generatedUrl');
    navigator.clipboard.writeText(url.href);
    alert('URL copied to clipboard!');
}
</script>
</body>
</html>