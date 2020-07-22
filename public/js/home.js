$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        console.log('clicked !!!!');
        $('#sidebar').toggleClass('active');
    });
});