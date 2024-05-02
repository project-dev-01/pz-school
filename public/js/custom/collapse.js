// First section
$('#collapseButton1').click(function () {
    var icon = $(this).find('i');
    icon.toggleClass('mdi-chevron-up mdi-chevron-down');
    var collapseContent = $(this).closest('.card').find('.collapse');
    collapseContent.toggleClass('show'); // Toggle 'show' class instead of using toggle()
});

// First section
$('#collapseButton2').click(function () {
    var icon = $(this).find('i');
    icon.toggleClass('mdi-chevron-up mdi-chevron-down');
    var collapseContent = $(this).closest('.card').find('.collapse');
    collapseContent.toggleClass('show'); // Toggle 'show' class instead of using toggle()
});
// First section
$('#collapseButton3').click(function () {
    var icon = $(this).find('i');
    icon.toggleClass('mdi-chevron-up mdi-chevron-down');
    var collapseContent = $(this).closest('.card').find('.collapse');
    collapseContent.toggleClass('show'); // Toggle 'show' class instead of using toggle()
});
// First section
$('#collapseButton4').click(function () {
    var icon = $(this).find('i');
    icon.toggleClass('mdi-chevron-up mdi-chevron-down');
    var collapseContent = $(this).closest('.card').find('.collapse');
    collapseContent.toggleClass('show'); // Toggle 'show' class instead of using toggle()
});
// First section
$('#collapseButton5').click(function () {
    var icon = $(this).find('i');
    icon.toggleClass('mdi-chevron-up mdi-chevron-down');
    var collapseContent = $(this).closest('.card').find('.collapse');
    collapseContent.toggleClass('show'); // Toggle 'show' class instead of using toggle()
});
// First section
$('#collapseButton6').click(function () {
    var icon = $(this).find('i');
    icon.toggleClass('mdi-chevron-up mdi-chevron-down');
    var collapseContent = $(this).closest('.card').find('.collapse');
    collapseContent.toggleClass('show'); // Toggle 'show' class instead of using toggle()
});
// First section
$('#collapseButton7').click(function () {
    var icon = $(this).find('i');
    icon.toggleClass('mdi-chevron-up mdi-chevron-down');
    var collapseContent = $(this).closest('.card').find('.collapse');
    collapseContent.toggleClass('show'); // Toggle 'show' class instead of using toggle()
});
$('#collapseButton8').click(function () {
    var icon = $(this).find('i');
    icon.toggleClass('mdi-chevron-up mdi-chevron-down');
    var collapseContent = $(this).closest('.card').find('.collapse');
    collapseContent.toggleClass('show'); // Toggle 'show' class instead of using toggle()
});
$('#collapseButton9').click(function () {
    var icon = $(this).find('i');
    icon.toggleClass('mdi-chevron-up mdi-chevron-down');
    var collapseContent = $(this).closest('.card').find('.collapse');
    collapseContent.toggleClass('show'); // Toggle 'show' class instead of using toggle()
});
// JavaScript code to toggle icon on collapse button click
$('#pastTasks').on('show.bs.collapse', function () {
    // Change the icon to "mdi-chevron-up" when the collapse section is shown
    $(this).prev().find('i').removeClass('mdi-chevron-down').addClass('mdi-chevron-up');
});

$('#pastTasks').on('hide.bs.collapse', function () {
    // Change the icon to "mdi-chevron-down" when the collapse section is hidden
    $(this).prev().find('i').removeClass('mdi-chevron-up').addClass('mdi-chevron-down');
});
document.addEventListener('DOMContentLoaded', function() {
    const collapseLinks = document.querySelectorAll('[data-toggle="collapse"]');

    collapseLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            const chevronIcon = link.querySelector('i');
            chevronIcon.classList.toggle('mdi-chevron-down');
            chevronIcon.classList.toggle('mdi-chevron-up');
        });
    });
});

