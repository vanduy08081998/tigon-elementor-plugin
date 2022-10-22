jQuery(document).ready(function () {
    new jBox('Modal', { attach: '#intro-more', animation: 'tada', getTitle: 'data-jbox-title', width: 350, getContent: 'data-jbox-content', addClass: 'jBox-AnimationDemo', blockScrollAdjust: ['header'] });
});