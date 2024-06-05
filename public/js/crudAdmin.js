window.onload = function() {
    function showDeleteForm(adminId) {
        var form = document.getElementById('delete-form-' + adminId);
        form.style.display = 'block';
    }

    
    window.showDeleteForm = showDeleteForm;
};