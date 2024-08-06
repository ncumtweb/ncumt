document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.form-container');
    const links = document.querySelectorAll('#sidebar a');

    function showForm(id) {
        forms.forEach(form => {
            if (form.id === id) {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        });
    }

    links.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const targetId = link.getAttribute('href').substring(1) + '_form';
            showForm(targetId);
        });
    });

    // 预设显示基本资料表单
    showForm('basic_information_form');
});
