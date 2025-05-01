$(document).ready(function () {
    const templates = $('.roller-item');
    let main_index = 0;

    function updateRoller() {
        templates.removeClass('left active right');
        let left_index = (main_index - 1 + templates.length) % templates.length;
        let right_index = (main_index + 1) % templates.length;

        templates.eq(left_index).addClass('left');
        templates.eq(main_index).addClass('active');
        templates.eq(right_index).addClass('right');
    }

    $('.left-arrow').click(function () {
        main_index = (main_index - 1 + templates.length) % templates.length;
        updateRoller();
    });

    $('.right-arrow').click(function () {
        main_index = (main_index + 1) % templates.length;
        updateRoller();
    });

    updateRoller();
});
